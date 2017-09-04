<?php

class SunPayFactory
{
    public static function newSunPay($payment, $shipment = null, $installments = '')
    {
        switch ($payment) {
            case 'suntech_unionpay':
            case 'suntech_buysafe':
                return new BuySafe($payment, $shipment, $installments);
                break;
            case 'suntech_webatm':
                return new WebATM($shipment);
                break;
            case 'suntech_sunship':
                return new SunShip();
                break;
            case 'suntech_24pay':
                return new Pay24($shipment);
                break;
            case 'suntech_paycode':
                return new PayCode($shipment);
                break;
            default:
                throw new Exception('Undefined payment');
        }
    }
}

Abstract class SunPay
{
    public $sendField = array();
    public $sendExtendField = array();

    function __construct()
    {
        $this->sendField = array(
            'web' => '',
            'MN' => '',
            'OrderInfo' => '',
            'Td' => '',
            'sna' => '',
            'sdt' => '',
            'email' => '',
            'note1' => '',
            'note2' => '',
            'CargoFlag' => 0,
            'StoreID' => '',
            'StoreName' => '',
            'ChkValue' => ''
        );
    }

    function setCargoFlag($shipment_text)
    {
        if ($shipment_text == 'ship') {
            $this->sendField['CargoFlag'] = 1;
        }
    }

    function setChkValue($transaction_pwd)
    {
        $chk_value = $this->sendField['web'] . $transaction_pwd . $this->sendField['MN'];
        if (isset($this->sendExtendField['Term']) && $this->sendExtendField['Term'] != '') {
            $chk_value = $chk_value . $this->sendExtendField['Term'];
        }
        $this->sendField['ChkValue'] = EncryptChkValue::getValue($chk_value);
    }

    function checkOutHtmlParameters($webPwd)
    {
        $this->setChkValue($webPwd);
        $encode_parameters = array();
        $parameters = array_merge($this->sendField, $this->sendExtendField);
        foreach ($parameters as $key => $parameter) {
            $encode_parameters[$key] = urlencode($parameter);
        }
        return $encode_parameters;
    }

    function verifyCallBack($chkValue)
    {
        if ($_POST['ChkValue'] != $chkValue) {
            return false;
        }
        return true;
    }
}


class BuySafe extends SunPay
{
    private $payment, $installments;
    public $sendExtendField = array(
        'Card_Type' => 0,
        'Country_Type' => '',
        'Term' => '',
    );

    function __construct($payment, $shipment = null, $installments = '')
    {
        parent::__construct();
        $this->payment = $payment;
        $this->installments = $installments;
        $this->setCargoFlag($shipment);

        if ($this->payment == 'suntech_buysafe') {
            if (!in_array($this->installments, array('', '3', '6', '12', '18', '24'))) {
                throw new Exception('installments exception');
            }
            $this->sendExtendField['Term'] = $this->installments;
        } elseif ($this->payment == 'suntech_unionpay') {
            $this->sendExtendField['Card_Type'] = 1;
        }
    }

    public function CallBack($webPwd)
    {
        $call_back_by_shipment = false;
        $errorCode = $_POST['errcode'];

        if ($_POST['MN']) {
            $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['MN'] . $errorCode;
            if ($_POST['CargoNo'] != '') {
                $chkValue = $chkValue . $_POST['CargoNo'];
            }
        } else {
            $call_back_by_shipment = true;
            $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['StoreType'];
        }

        $chkValue = EncryptChkValue::getValue($chkValue);
        $response['chkValue'] = $this->verifyCallBack($chkValue);
        $response['shipment'] = $call_back_by_shipment;
        return $response;
    }
}

class WebATM extends SunPay
{
    public $sendExtendField = array();

    function __construct($shipment = null)
    {
        parent::__construct();
        $this->setCargoFlag($shipment);
    }

    public function CallBack($webPwd)
    {
        $call_back_by_shipment = false;
        $errorCode = $_POST['errcode'];
        $sendType = $_POST['SendType'];

        if ($sendType == 2) {
            $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['MN'] . $errorCode;
            if ($_POST['CargoNo'] != '') {
                $chkValue = $chkValue . $_POST['CargoNo'];
            }
        } elseif ($sendType == "" || $sendType == 1) {
            $call_back_by_shipment = true;
            $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['StoreType'];
        } else {
            throw new Exception('SendType mismatch');
        }

        $chkValue = EncryptChkValue::getValue($chkValue);
        $response['chkValue'] = $this->verifyCallBack($chkValue);
        $response['shipment'] = $call_back_by_shipment;
        return $response;
    }
}

class SunShip extends SunPay
{
    public $sendExtendField = array();

    public function CallBack($webPwd)
    {
        $call_back_by_paid = false;
        $call_back_by_shipment = false;
        $errorCode = isset($_POST['errcode']) ? $_POST['errcode'] : '';
        $sendType = isset($_POST['SendType']) ? $_POST['SendType'] : '';

        if ($sendType == 2) {
            $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['MN'] . $errorCode . $_POST['CargoNo'];
        } elseif ($sendType == "" || $sendType == 1) {
            if ($errorCode != '') {
                $call_back_by_paid = true;
                $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['MN'] . $errorCode;
            } elseif (isset($_POST['StoreType'])) {
                $call_back_by_shipment = true;
                $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['StoreType'];
            } else {
                throw new Exception('Unknown callback');
            }
        } else {
            throw new Exception('SendType mismatch');
        }

        $chkValue = EncryptChkValue::getValue($chkValue);
        $response['chkValue'] = $this->verifyCallBack($chkValue);
        $response['paid'] = $call_back_by_paid && $response['chkValue'];
        $response['shipment'] = $call_back_by_shipment && $response['chkValue'];
        return $response;
    }
}

class Pay24 extends SunPay
{
    private $shipment;
    public $sendExtendField = array(
        'DueDate' => '',
        'UserNo' => '',
        'ProductName1' => '',
        'ProductPrice1' => 0,
        'ProductQuantity1' => 1,
    );

    function __construct($shipment = null)
    {
        parent::__construct();
        $this->setCargoFlag($shipment);
    }

    public function checkOut($webPwd)
    {
        $this->sendExtendField['ProductPrice1'] = $this->sendField['MN'];
        return $this->checkOutHtmlParameters($webPwd);
    }

    public function CallBack($webPwd)
    {
        $call_back_by_paid = false;
        $call_back_by_shipment = false;
        $errorCode = isset($_POST['errcode']) ? $_POST['errcode'] : '';
        $sendType = isset($_POST['SendType']) ? $_POST['SendType'] : '';

        if ($sendType == 2) {
            $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['MN'] . $_POST['EntityATM'];
        } elseif ($sendType == "" || $sendType == 1) {
            if ($errorCode) {
                $call_back_by_paid = true;
                $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['MN'] . $errorCode;
                if ($_POST['CargoNo'] != '') {
                    $chkValue = $chkValue . $_POST['CargoNo'];
                }
            } else {
                $call_back_by_shipment = true;
                $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['StoreType'];
            }
        } else {
            throw new Exception('SendType mismatch');
        }

        $chkValue = EncryptChkValue::getValue($chkValue);
        $response['chkValue'] = $this->verifyCallBack($chkValue);
        $response['paid'] = $call_back_by_paid && $response['chkValue'];
        $response['shipment'] = $call_back_by_shipment && $response['chkValue'];
        return $response;
    }
}

class PayCode extends SunPay
{
    private $shipment;
    public $sendExtendField = array(
        'DueDate' => '',
        'UserNo' => '',
        'BillDate' => ''
    );

    function __construct($shipment = null)
    {
        parent::__construct();
        $this->setCargoFlag($shipment);
    }

    public function CallBack($webPwd)
    {
        $call_back_by_paid = false;
        $call_back_by_shipment = false;
        $errorCode = isset($_POST['errcode']) ? $_POST['errcode'] : '';
        $sendType = isset($_POST['SendType']) ? $_POST['SendType'] : '';

        if ($sendType == 2) {
            $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['MN'] . $_POST['paycode'];
        } elseif ($sendType == "" || $sendType == 1) {
            if ($errorCode) {
                $call_back_by_paid = true;
                $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['MN'] . $errorCode;
                if ($_POST['CargoNo'] != '') {
                    $chkValue = $chkValue . $_POST['CargoNo'];
                }
            } else {
                $call_back_by_shipment = true;
                $chkValue = $_POST['web'] . $webPwd . $_POST['buysafeno'] . $_POST['StoreType'];
            }
        } else {
            throw new Exception('SendType mismatch');
        }

        $chkValue = EncryptChkValue::getValue($chkValue);
        $response['chkValue'] = $this->verifyCallBack($chkValue);
        $response['paid'] = $call_back_by_paid && $response['chkValue'];
        $response['shipment'] = $call_back_by_shipment && $response['chkValue'];
        return $response;
    }
}

class EncryptChkValue
{
    static function getValue($check_value)
    {
        return strtoupper(sha1($check_value));
    }
}