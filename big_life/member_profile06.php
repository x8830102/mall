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
//
$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
	if ($_POST['see'] == $_POST['sum']) {
    $bid=$HTTP_POST_VARS['bid'];$b_name=$HTTP_POST_VARS['b_name'];$b_bank=$HTTP_POST_VARS['b_bank'];$b_ad=$HTTP_POST_VARS['b_ad'];$b_ad2=$HTTP_POST_VARS['b_ad2'];
	$b_num=$HTTP_POST_VARS['b_num'];$cod=$HTTP_POST_VARS['cod'];$b_bank_a=$HTTP_POST_VARS['b_bank_a'];
	//
	$update11="UPDATE bank SET b_name='$b_name', b_bank='$b_bank', b_ad='$b_ad', b_ad2='$b_ad2', b_num='$b_num', cod='$cod', b_bank_a='$b_bank_a' WHERE id = $bid";
        mysql_select_db($database_sc, $sc);
        $Result11 = mysql_query($update11, $sc) or die(mysql_error());
		//$insertGoTo = "mem1.php";
        //header(sprintf("Location: %s", $insertGoTo));
	$send=1;
	} else {$err="檢查碼不符  !";$send=0;}
}
//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//
mysql_select_db($database_sc, $sc);
$query_Recsn2 = sprintf("SELECT * FROM bank WHERE number = '$sn' ORDER BY id DESC");//
$Recsn2 = mysql_query($query_Recsn2, $sc) or die(mysql_error());
$row_Recsn2 = mysql_fetch_assoc($Recsn2);
$totalRows_Recsn2 = mysql_num_rows($Recsn2);
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
            <ul class="cut-line_active">
                <li class="cust-but"><a href="member_profile01.php"><span class="icon-c hidden-xs" style="margin-right: 5px"></span><span>基本資料</span></a></li>
                <li></li>
            </ul>
        </li>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
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
            <li> <a href="member_profile01.php"><span>資料確認</span></a> </li>
            <li> <a href="member_profile02.php"><span>資料修改</span></a> </li>
            <li> <a href="member_profile03.php"><span>密碼修改</span></a> </li>
            <li> <a href="member_profile04.php"><span>二級修改</span></a> </li>
            <li> <a href="member_profile05.php"><span>E-mail修改</span></a> </li>
            <li class="active"> <a href="member_profile06.php"><span>資料驗證</span></a> </li>
            <!--<li> <a href="member_profile07.php"><span>講師驗證</span></a> </li>-->
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">資料驗證</div>
            <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr class="menu-tr">
                      <td colspan="2" align="center"><span style="color: #F00"><?php echo $err;?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">銀行戶名</td>
                        <td>
                            <input name="b_name" type="text" id="b_name" value="<?php echo $row_Recsn2['b_name'];?>" />
                    <input name="bid" type="hidden" id="bid" value="<?php echo $row_Recsn2['id'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>銀行名稱</span></td>
                        <td>
                            <input name="b_bank" type="text" id="b_bank" value="<?php echo $row_Recsn2['b_bank'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>分行名稱</span></td>
                        <td>
                            <input name="b_ad" type="text" id="b_ad" value="<?php echo $row_Recsn2['b_ad'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>支行名稱</span></td>
                        <td>
                            <input name="b_ad2" type="text" id="b_ad2" value="<?php echo $row_Recsn2['b_ad2'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>銀行帳號</span></td>
                        <td>
                            <input name="b_num" type="text" id="b_num" value="<?php echo $row_Recsn2['b_num'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>銀行帳號幣別</span></td>
                        <td>
                            <select name="cod"  id="cod">
                      <option value="USD" <?php if ($row_Recsn2['cod'] == "USD") {echo "selected='selected'";}?>>USD</option>
                      <option value="JPY" <?php if ($row_Recsn2['cod'] == "JPY") {echo "selected='selected'";}?>>JPY</option>
                      <option value="HKD" <?php if ($row_Recsn2['cod'] == "HKD") {echo "selected='selected'";}?>>HKD</option>
                      <option value="TWD" <?php if ($row_Recsn2['cod'] == "TWD") {echo "selected='selected'";}?>>TWD</option>
                      <option value="SGD" <?php if ($row_Recsn2['cod'] == "SGD") {echo "selected='selected'";}?>>SGD</option>
                      <option value="CNY" <?php if ($row_Recsn2['cod'] == "CNY") {echo "selected='selected'";}?>>CNY</option>
                      <option value="MYR" <?php if ($row_Recsn2['cod'] == "MYR") {echo "selected='selected'";}?>>MYR</option>
                  </select>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>銀行代號</span></td>
                        <td>
                            <input name="b_bank_a" type="text" id="b_bank_a" value="<?php echo $row_Recsn2['b_bank_a'];?>" />
                        </td>
                    </tr>
                    <!--<tr class="menu-tr">
                        <td><span>銀行地址</span></td>
                        <td>
                            <input name="" type="text" value="" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>銀行電話/傳真</span></td>
                        <td>
                            <input name="" type="text" value="" />
                        </td>
                    </tr>-->
                    <tr class="menu-tr">
                        <td class="menu-td"><span>存摺上傳</span></td>
                        <td><?php if ($row_Recsn2['b_pic'] == "") {echo "無資料";} else {echo "上傳完成";};?>
                    <button type="button" class="menu-but" style="margin-left:5px; " onclick="window.location='b_uload.php'">更正</button>
                      <?php if ($row_Recsn2['b_pic'] != "") {?><button type="button" class="menu-but" style="margin-left:5px; " onclick="window.location='b_pic/<?php echo $row_Recsn2['b_pic'];?>'">查看</button><?php }?>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">二級密碼</td>
                        <td>
                            <input name="m_passtoo" type="password" id="m_passtoo" size="12" placeholder="">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">請輸入驗證碼</td>
                        <td>
                            <input name="sum" type="text" id="sum" style="min-width: 70px;" size="12" placeholder="請輸入驗證碼">
                            <?php echo $sum;?>
                            <a href="member_profile06.php"><img width="15px" src="img/refresh.png" alt="" style="margin-left: 3px"></a>
                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="2">
                            <input name="MM_update" type="hidden" id="MM_update" value="form1" />
                      <input name="see" type="hidden" id="see" value="<?php echo $sum;?>" />
                      <?php if ($send == 1) {echo " 完成儲存 ";} else {?>
                      <input type="submit" name="button" id="button" class="menu-but"  value="儲存">
                      <?php }?>
                        </td>
                    </tr>
                </tbody>
            </table></form>
        </div>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
