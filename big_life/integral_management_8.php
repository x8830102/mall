<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;} else {$sn=$_SESSION['number'];}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1 && a_pud >= 6");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: login_mem.php"));exit;}
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
//gm
require_once('Connections/sr.php');
if ($_POST['sd1'] != "" && $_POST['sd2'] != "") {$sd=" && date >= ".$_POST['sd1']." && date <= ".$_POST['sd2'];} else {$sd="";}
mysql_select_db($database_sc, $sc);$s="";
$query_Recgm = sprintf("SELECT * FROM gold_m WHERE number = '$sn' && store <> '$s' $sd ORDER BY id DESC");//
$Recgm = mysql_query($query_Recgm, $sc) or die(mysql_error());
$row_Recgm = mysql_fetch_assoc($Recgm);
$totalRows_Recgm = mysql_num_rows($Recgm);//echo $totalRows_Recgm;
//total
mysql_select_db($database_sc, $sc);$total_p=0;
$query_Recgmt = sprintf("SELECT * FROM gold_m WHERE number = '$sn' && store <> '$s' ORDER BY id DESC");//
$Recgmt = mysql_query($query_Recgmt, $sc) or die(mysql_error());
$row_Recgmt = mysql_fetch_assoc($Recgmt);
$totalRows_Recgmt = mysql_num_rows($Recgmt);
do {$total_p=$total_p+$row_Recgmt['pay_total'];} while ($row_Recgmt = mysql_fetch_assoc($Recgmt));
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>串門子雲端事業</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="jasny-bootstrap/css/jasny-bootstrap.css">
    <link rel="stylesheet" type="text/css" href="icomoon/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="js/map.js"></script>
    <style type="text/css">
    body {
        font-family: "verdana", "微軟正黑體";
        font-weight: 400;
    }
    </style>
    <script>
    function setBlur(obj, target2) {
        var target = document.getElementById(target2);
        if (obj.value.length == obj.getAttribute('maxlength')) {
            target.focus();
        }
        return;
    }
    </script>
</head>

<body>
<?php require_once('adx.php');require_once('phone.php');require_once('desktop.php'); ?>
    <!--↓↓↓↓↓↓↓↓↓↓

                     content

                                    ↓↓↓↓↓↓↓↓↓↓↓-->
<div class="cut-navbar col-lg-7 col-md-7 col-sm-7 col-xs-11  col-lg-offset-2">
    <ul class="cut-page">
        <?php if ($a_pud >= 2) {?><li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >系統註冊</span></a></li>
            </ul>
        </li><? }?>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="member_profile01.php"><span class="icon-c hidden-xs" style="margin-right: 5px"></span><span>基本資料</span></a></li>
                <li></li>
            </ul>
        </li>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line_active">
                <li class="cust-but"><a href="integral_management_1.php"><span class="icon-d hidden-xs" style="margin-right: 5px"></span><span>積分管理</span></a></li>
                <li></li>
            </ul>
        </li>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="fan_management_1.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>粉絲管理</span></a></li>
                <li></li>
            </ul>
        </li>
    </ul>
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <li> <a href="integral_management_1.php"><span>註冊積分</span></a> </li>
            <li> <a href="integral_management_2.php"><span>串串積分</span></a> </li>
            <li> <a href="integral_management_3.php"><span>購物積分</span></a> </li>
            <li> <a href="integral_management_4.php"><span>紅利積分</span></a> </li>
            <li> <a href="integral_management_5.php"><span>所得積分</span></a> </li>
            <li> <a href="integral_management_6.php"><span>積分消費</span></a> </li>
            <li> <a href="integral_management_7.php"><span>講師積分</span></a> </li>
            <li class="active"> <a href="integral_management_8.php"><span>積分兌換</span></a> </li>
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9"><? echo "此功能不開放";exit;?>
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">積分兌換管理</div>
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr class="menu-tr">
                        <td colspan="2" width="400px" style="line-height: 16px">
                            <div style="margin-bottom: 10px">申請流程：</div>
                            <div>1.凡是系統使用者經由口碑相傳而產生推廣買賣行為時，公司發給推廣者積分以示獎勵，此積分可於串門子網路平台購物上使用，亦可向公司申報佣金所得兌換。</div>
                            <div>2.欲申請者，請填妥金額，以利積分轉出作業，並以千元為單位</div>
                            <div>3.申請作業於每月 1~5號(撥款日為15號)、16~20號(撥款日為30號)</div>
                            <div>4.請將銀行資料確實輸入填寫，認證完整上傳成功，方可申請佣金給付。</div>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td ">佣金申請金額</td>
                        <td class="card">
                            <input type=text name=pan_no1 size=4 value="" maxlength=1 onKeyUp="setBlur(this,'pan_no2');">百萬
                            <input type=text name=pan_no2 size=4 value="" maxlength=1 onKeyUp="setBlur(this,'pan_no3');">十萬
                            <input type=text name=pan_no3 size=4 value="" maxlength=1 onKeyUp="setBlur(this,'pan_no4');">萬
                            <input type=text name=pan_no4 size=4 value="" maxlength=1>千
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td ">付款金額</td>
                        <td>
                            <input type="text" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="ann-t">
                            <div style=";line-height: 1px;margin-top: 14px; color: red">★佣金申請公司需預扣綜合所得申報與酌收手續費合計15%。</div>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">轉出串串積分</td>
                        <td>
                            <input type="text" placeholder="">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">二級密碼</td>
                        <td>
                            <input type="password" placeholder="請輸入二級密碼" size="12">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">驗證碼</td>
                        <td>
                            <input type="text" placeholder="請輸入驗證碼" size="12" style="min-width: 70px;">
                            <a href="#"><img width="70px" src="img/verification.png" alt="" style="margin-left:5px "></a>
                            <a href="#"><img width="15px" src="img/refresh.png" alt="" style="margin-left: 3px"></a>
                        </td>
                    </tr>
                    <tr class="menu-tr" align="center">
                        <td colspan="2">
                            <a href="new_account-3.php">
                                <button type="button" class="menu-but">送出</button>
                            </a>
                            <button type="button" class="menu-but" style="margin-left: 6px">取消</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="  margin-top: 10px" class="table-responsive ">
            <div class="inquire">
                <ul>
                    <li>查詢日期</li>
                    <li>
                        <input type="date">
                    </li>
                    <li>起至</li>
                    <li>
                        <input type="date">
                    </li>
                    <li>
                        <a href="#">
                            <button type="button" class="inquire-but">查詢</button>
                        </a>
                    </li>
                </ul>
            </div>
            <table class="integral-tb table" width="100%" style="min-width: 100%">
                <tbody>
                    <tr class="integral-frist-tr">
                        <td style="width: 3%;border-top: 0px ">#</td>
                        <td style="width: 15%;border-top: 0px">申請日期時間</td>
                        <td style="width: 15%;border-top: 0px">申請金額</td>
                        <td style="width: 15%;border-top: 0px">預扣稅金與費用</td>
                        <td style="width: 15%;border-top: 0px">轉出串串積分</td>
                        <td style="width: 15%;border-top: 0px">狀態</td>
                        <td style="width: 15%;border-top: 0px">撥款日期</td>
                        <td style="width: 7%;border-top: 0px">備註</td>
                    </tr>
                    <tr class="integral-tr">
                        <td>125</td>
                        <td>
                            <span>10,000</span>
                        </td>
                        <td><span>10,000</span></td>
                        <td><span>0</span></td>
                        <td><span>25,600,000</span></td>
                        <td><span>25,600,000</span></td>
                        <td>
                            <div>註冊扣值, (小資創業家</div>
                            <div>帳號：11111</div>
                        </td>
                        <td></td>
                    </tr>
                    <tr class="integral-tr">
                        <td>126</td>
                        <td>
                            <span>10,000</span>
                        </td>
                        <td><span>10,000</span></td>
                        <td><span>0</span></td>
                        <td><span>25,600,000</span></td>
                        <td><span>25,600,000</span></td>
                        <td>
                            <div>註冊扣值, (小資創業家</div>
                            <div>帳號：11111</div>
                        </td>
                        <td></td>
                    </tr>
                    <tr class="integral-tr">
                        <td>127</td>
                        <td>
                            <span>10,000</span>
                        </td>
                        <td><span>10,000</span></td>
                        <td><span>0</span></td>
                        <td><span>25,600,000</span></td>
                        <td><span>25,600,000</span></td>
                        <td>
                            <div>註冊扣值, (小資創業家</div>
                            <div>帳號：11111</div>
                        </td>
                        <td></td>
                    </tr>
                    <tr class="integral-tr">
                        <td>128</td>
                        <td>
                            <span>10,000</span>
                        </td>
                        <td><span>10,000</span></td>
                        <td><span>0</span></td>
                        <td><span>25,600,000</span></td>
                        <td><span>25,600,000</span></td>
                        <td>
                            <div>註冊扣值, (小資創業家</div>
                            <div>帳號：11111</div>
                        </td>
                        <td></td>
                    </tr>
                    <tr class="integral-tr">
                        <td>129</td>
                        <td>
                            <span>10,000</span>
                        </td>
                        <td><span>10,000</span></td>
                        <td><span>0</span></td>
                        <td><span>25,600,000</span></td>
                        <td><span>25,600,000</span></td>
                        <td>
                            <div>註冊扣值, (小資創業家</div>
                            <div>帳號：11111</div>
                        </td>
                        <td></td>
                    </tr>
                    <tr class="integral-tr">
                        <td>130</td>
                        <td>
                            <span>10,000</span>
                        </td>
                        <td><span>10,000</span></td>
                        <td><span>0</span></td>
                        <td><span>25,600,000</span></td>
                        <td><span>25,600,000</span></td>
                        <td>
                            <div>註冊扣值, (小資創業家</div>
                            <div>帳號：11111</div>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
