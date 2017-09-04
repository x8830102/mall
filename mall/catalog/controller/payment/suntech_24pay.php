<?php

class ControllerPaymentSuntech24Pay extends Controller
{
    private $payment = 'suntech_24pay';
    private $order_init_status = 1;

    // 訂單送出前 , 清空購物車 , 建立訂單
    public function saveOrder()
    {
        $data = array();

        $data['action'] = $this->config->get($this->payment . '_test_mode') ? 'https://test.esafe.com.tw/Service/Etopm.aspx' : 'https://www.esafe.com.tw/Service/Etopm.aspx';

        // Load language
        $this->language->load('payment/' . $this->payment);
        // Load Order Model
        $this->load->model('checkout/order');

        $order_init_status = $this->order_init_status; // pending

        $account = $this->config->get($this->payment . '_account');
        $password = $this->config->get($this->payment . '_password');
        $order_id = $this->session->data['order_id'];

        $this->load->model('checkout/order');
        $this->load->model('payment/' . $this->payment);
        $order_info = $this->model_checkout_order->getOrder($order_id);
        $payment_model = 'model_payment_' . $this->payment;
        $shipment = isset($_POST['ship']) ? $_POST['ship'] : '';

        try {
            $include_result = $this->$payment_model->includeSunPay();
            if (!$include_result) {
                throw new Exception("Can't load sunpay model");
            }

            $total_amount = intval($this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false));
            $show = SunPayFactory::newSunPay($this->payment, $shipment);

            // 更新訂單運送方式、運費及目的地(暫不更新金額)
            if ($show->sendField['CargoFlag'] == 1) {
                $total_amount = $this->$payment_model->setOrderTotalsWithSunShip($order_id, $total_amount);
            }

            // 設定共用欄位
            $show->sendField['web'] = $this->config->get($this->payment . '_account');
            $show->sendField['MN'] = $total_amount;
            $show->sendField['OrderInfo'] = '';
            $show->sendField['Td'] = $this->session->data['order_id'];
            $show->sendField['sna'] = html_entity_decode($order_info['payment_lastname'] . ' ' . $order_info['payment_firstname'], ENT_QUOTES, 'UTF-8');
            $show->sendField['sdt'] = $order_info['telephone'];
            $show->sendField['email'] = $order_info['email'];
            $show->sendField['note1'] = $order_id;
            // 設定額外欄位
            $NewDate = Date('Ymd', strtotime("+" . $this->config->get($this->payment . '_duedays') . " days"));
            $this->session->data['payment_duedate'] = $NewDate;
            $show->sendExtendField['DueDate'] = $NewDate;
            $show->sendExtendField['UserNo'] = $order_info['customer_id'];
            $show->sendExtendField['ProductName1'] = $this->config->get($this->payment . '_product_name');
            $data['parameters'] = $show->checkOut($password);

        } catch (Exception $e) {
            $this->session->data['error'] = $e->getMessage();
            $checkout_url = $this->url->link('checkout/checkout', '', 'SSL');
            $this->response->redirect($checkout_url);
        }

        // Add Order History
        $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $order_init_status, $this->language->get('text_order_checkout') . ', ' . $this->language->get('text_title'), true);
        // 清空購物車
        if ($this->cart->hasProducts()) {
            $this->cart->clear();
        }

        # Get the template
        $config_template = $this->config->get('config_template');
        if (file_exists(DIR_TEMPLATE . $config_template)) {
            $payment_template = $config_template;
        } else {
            $payment_template = 'default';
        }
        $payment_template .= (strpos(VERSION, '2.2.') !== false) ? '/payment/sunpay.tpl' : '/template/payment/sunpay.tpl';

        $this->response->setOutput($this->load->view($payment_template, $data));
    }

    public function index()
    {
        $payment_type = $this->payment;
        $this->language->load('payment/' . $payment_type);

        $data['button_confirm'] = $this->language->get('button_confirm');

        $action_url = $this->url->link('payment/' . $payment_type . '/saveOrder', '', 'SSL');
        $data['action'] = $action_url;
        $data['payment'] = $payment_type;

        $cargo_option = $this->config->get($this->payment . '_cargo_option');
        $data['cargo_option'] = $cargo_option;
        $data['cargo_text'] = $this->language->get('cargo_text');

        # Get the template
        $config_template = $this->config->get('config_template');
        if (file_exists(DIR_TEMPLATE . $config_template)) {
            $payment_template = $config_template;
        } else {
            $payment_template = 'default';
        }
        $payment_template .= (strpos(VERSION, '2.2.') !== false) ? '/payment/suntech.tpl' : '/template/payment/suntech.tpl';

        return $this->load->view($payment_template, $data);
    }

    // 交易成功接收網址 or 交易失敗接收網址
    public function callback()
    {
        $payment_type = $this->payment;
        try {
            $this->language->load('payment/' . $payment_type);
            $this->load->model('checkout/order');
            $this->load->model('payment/' . $payment_type);
            $data = $this->request->post;
            $pwd = $this->config->get($payment_type . '_password');
            $data['continue'] = $this->url->link('checkout/checkout', '', 'SSL');
            $data['heading_title'] = $this->language->get('heading_title_error');
            $payment_model = 'model_payment_' . $payment_type;
            $include_result = $this->$payment_model->includeSunPay();
            if (!$include_result) {
                throw new Exception("Can't load sunpay model");
            }
            $show = SunPayFactory::newSunPay($this->payment);
            $response = $show->CallBack($pwd);

            if (!$response['chkValue']) {
                throw new Exception('chkValue mismatch');
            }

            $order_id = $data['Td'];
            $order_info = $this->model_checkout_order->getOrder($order_id);

            if ($response['shipment']) {   //物流回傳
                if ($_POST["StoreType"] == '1010') { //用戶已領
                    $finish_status = 5;
                } elseif ($_POST["StoreType"] == '101') { //抵達門市
                    $finish_status = 3;
                } else {
                    $finish_status = $this->config->get($payment_type . '_order_status_id');
                }
                $message = $this->language->get('text_shippingmsg') . urldecode($_POST["StoreMsg"]) . (($_POST["StoreType"] != '') ? sprintf($this->language->get('text_ship_code'), $_POST["StoreType"]) : '');
                $this->model_checkout_order->addOrderHistory($order_id, $finish_status, $message, true);
                echo '0000';
                exit;
            } else {
                if ($response['paid']) { //繳費回傳
                    if ($data['errcode'] != '00') {
                        if ($order_info['order_status_id'] == $this->order_init_status) {
                            $message = sprintf($this->language->get('text_failure_notify') . '', $data['buysafeno'], $data['errcode'] . ((isset($data['errmsg']) ? '/' . urldecode($data['errmsg']) : '')));
                            $this->model_checkout_order->addOrderHistory($order_id, 10, $message, true);
                        }
                    } else {
                        $message = sprintf($this->language->get('text_success_notify') . '', $data['buysafeno']);
                        $message .= $this->language->get('pay_type_' . $data['PayType']);
                        if ($data['CargoNo'] != '') {
                            $message .= sprintf($this->language->get('text_success_ship'), $data['CargoNo'], $data['CargoNo']);
                            $shipping_info = array(
                                'shipping_address_2' => sprintf($this->language->get('cargo_msg'), urldecode($data['StoreName']), $data['StoreID'])
                            );
                            $this->$payment_model->setOrderInfo($order_id, $shipping_info);
                        }
                        if ($order_info['order_status_id'] == $this->order_init_status) {
                            $this->model_checkout_order->addOrderHistory($order_id, $this->config->get($payment_type . '_order_status_id'), $message, true);
                        }
                    }
                    echo '0000';
                    exit;
                } else {   //建立訂單(即時回傳)
                    $NewDate = '';
                    if (isset($this->session->data['payment_duedate'])) {
                        $NewDate = ' ' . substr($this->session->data['payment_duedate'], 0, 4) . '/' . substr($this->session->data['payment_duedate'], 4, 2) . '/' . substr($this->session->data['payment_duedate'], 6, 2) . ' ';
                        unset($this->session->data['payment_duedate']);
                    }
                    $data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
                    $message = sprintf($this->language->get('text_order_received'), $data['buysafeno'], $NewDate, $data['EntityATM']);
                    $this->model_checkout_order->addOrderHistory($order_id, $order_info['order_status_id'], $message, true);
                    // 後台寫入 barcode 資訊
                    // $message = sprintf($this->language->get('text_order_barcode'), urldecode($_POST["buysafeno"]), urldecode($_POST["BarcodeA"]), urldecode($_POST["BarcodeB"]), urldecode($_POST["BarcodeC"]),urldecode($_POST["PostBarcodeA"]),urldecode($_POST["PostBarcodeB"]),urldecode($_POST["PostBarcodeC"]), urldecode($_POST["EntityATM"]));
                    // $this->model_checkout_order->addOrderHistory($order_id, $order_info['order_status_id'], $message, false);
                    $data['text_response'] = $this->language->get('text_response');
                    $data['text_message'] = $this->language->get('text_callback');
                    $data['text_message_wait'] = sprintf($this->language->get('text_callback_wait'), $this->url->link('checkout/success'));
                    $data['continue'] = $this->url->link('checkout/success', '', 'SSL');
                }   //建立訂單(即時回傳)
            }
        } catch (Exception $e) {
            $this->session->data['error'] = $e->getMessage();
            $checkout_url = $this->url->link('checkout/checkout', '', 'SSL');
            $this->response->redirect($checkout_url);
        }

        $data['charset'] = $this->language->get('charset');
        $data['language'] = $this->language->get('code');
        $data['direction'] = $this->language->get('direction');

        // 整合首頁的樣板
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));

        if (isset($this->request->get['route'])) {
            $this->document->addLink(HTTP_SERVER, 'canonical');
        }

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        # Get the template
        $config_template = $this->config->get('config_template');
        if (file_exists(DIR_TEMPLATE . $config_template)) {
            $payment_template = $config_template;
        } else {
            $payment_template = 'default';
        }
        $payment_template .= (strpos(VERSION, '2.2.') !== false) ? '/payment/suntech_result.tpl' : '/template/payment/suntech_result.tpl';

        $this->response->setOutput($this->load->view($payment_template, $data));
    }
}
