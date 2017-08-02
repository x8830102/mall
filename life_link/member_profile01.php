<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
include('if_login.php');
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
//
mysql_select_db($database_sc, $sc);
$query_Recsn2 = sprintf("SELECT * FROM bank WHERE number = '$sn' ORDER BY id DESC");//
$Recsn2 = mysql_query($query_Recsn2, $sc) or die(mysql_error());
$row_Recsn2 = mysql_fetch_assoc($Recsn2);
$totalRows_Recsn2 = mysql_num_rows($Recsn2);
$sql = $pdo_cmg->query("SELECT *,SUM(`arrears`)AS blance FROM `pay_ar` WHERE `number` = '$sn'");
$result = $sql->fetch();
$blance = abs($result['blance']);
$number = $result['number'];

?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>串門子雲端事業</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <link rel="icon" href="img/life_link.jpg" type="image/x-icon" />
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
<div class="cut-navbar col-lg-7 col-md-7 col-sm-7 col-xs-11 col-lg-offset-2 col-sm-offset-1">
    <ul class="cut-page">
        <?php if ($a_pud >= 2) {?><li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >註冊會員</span></a></li>
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
        <?php if ($a_pud >= 2) {?><li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="fan_management_2.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>會員管理</span></a></li>
                <li></li>
            </ul>
        </li><? }?>
    </ul>
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <li class="active"> <a href="member_profile01.php"><span>資料確認</span></a> </li>
            <li> <a href="member_profile02.php"><span>資料修改</span></a> </li>
            <li> <a href="member_profile03.php"><span>密碼修改</span></a> </li>
            <li> <a href="member_profile04.php"><span>二級修改</span></a> </li>
            <li> <a href="member_profile05.php"><span>E-mail修改</span></a> </li>
            <li> <a href="member_profile06.php"><span>資料驗證</span></a> </li>
            <!--<li> <a href="member_profile07.php"><span>講師驗證</span></a> </li>-->
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">個人資料確認</div>
            <table align="center" cellpadding="10" cellspacing="3" width="80%" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr class="menu-tr">
                        <td width="35%">購買日期</td>
                        <td colspan="2"><?php echo $row_Recsn['date'],"  ",$row_Recsn['time'];?></td>
                    </tr>
                    
                    <tr class="menu-tr">
                        <td>登入帳號</td>
                        <td colspan="2"><?php echo $row_Recsn['m_username'];?></td>
                    </tr>
                    <tr class="menu-tr">
                        <td>名稱或暱稱</td>
                        <td colspan="2"><?php echo $row_Recsn['m_nick'];?></td>
                    </tr>
                    <?php if ($a_pud >= 2) {?><tr class="menu-tr">
                        <td><span>性別</span></td>
                        <td colspan="2"><span><?php switch ($row_Recsn['m_sex']) {case'M':echo "男";break;case'F':echo "女";break;};?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>生日</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn['m_birthday'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>國籍</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn2['coc'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>聯絡手機</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn['m_callphone'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>e-mail</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn['m_email'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>郵遞區號</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn['m_addnum'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>地址</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn['m_address'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td>姓（英文）</td>
                        <td colspan="2"><?php echo $row_Recsn2['last_name'];?></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>名（英文）</span></td>
                        <td colspan="2"><span></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>中文姓名</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn2['first_name'];?></span></td>
                    </tr>
                    
                    <tr class="menu-tr">
                        <td><span>護照/身分證</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn2['sid'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>護照/身分證上傳</span></td>
                        <td width="17%"><span><?php if ($row_Recsn2['sid_pic'] == "") {echo "無資料";} else {echo "上傳完成";};?></span></td>
                        <td width="48%"><?php if ($row_Recsn2['sid_pic'] != "") {?>
                  <input name="Submit" type="button" class="menu-but" onclick="window.location='sid_pic/<?php echo $row_Recsn2['sid_pic'];?>'" target="_blank" value=" 查 看 " />
                  <?php }?></td>
                    </tr>
                    
                    <tr class="menu-tr">
                      <td>發票開立</td>
                      <td colspan="2"><?php switch ($row_Recsn['as_at']) {case'1':echo "捐贈";break;case'2':echo "二聯";break;case'3':echo "三聯";break;};?></td>
                    </tr>
                    <tr class="menu-tr">
                        <td>發票收件人</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="menu-tr">
                      <td>統一編號</td>
                      <td colspan="2"><?php echo $row_Recsn['as_number'];?></td>
                    </tr>
                    <tr class="menu-tr">
                      <td>公司名稱</td>
                      <td colspan="2"><?php echo $row_Recsn['as_name'];?></td>
                    </tr>
                    <tr class="menu-tr">
                        <td>發票載具</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="menu-tr">
                        <td>發票贈與</td>
                        <td colspan="2"></td>
                    </tr>
					<tr class="menu-tr">
                        <td>積分狀況</td>
                        <td colspan="2"><Span style="font-weight: bold;<?if(empty($number) || $blance==0 ){echo "color:green";}else{echo "color:red";}?>"><?if(empty($number) || $blance==0){echo "無欠款";}else {echo "欠款(目前剩餘:".$blance.")";}?></Span></td>
                    </tr><? }?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if ($a_pud >= 3) {?><div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">銀行資料確認</div>
            <table align="center" cellpadding="10" cellspacing="3" width="80%" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr class="menu-tr">
                        <td width="35%">帳戶名稱</td>
                        <td colspan="2">
                            <span><?php echo $row_Recsn2['b_name'];?></span>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>銀行名稱</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn2['b_bank'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>分行名稱</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn2['b_ad'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>支行名稱</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn2['b_ad2'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>銀行帳號</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn2['b_num'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>銀戶幣別</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn2['cod'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>銀行代號</span></td>
                        <td colspan="2"><span><?php echo $row_Recsn2['b_bank_a'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>銀行地址</span></td>
                        <td colspan="2"><span></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>銀行電話/傳真</span></td>
                        <td colspan="2"><span></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>存摺上傳</span></td>
                        <td width="20%"><span><?php if ($row_Recsn2['b_pic'] == "") {echo "無資料";} else {echo "上傳完成";};?></span></td>
                        <td width="45%"><?php if ($row_Recsn2['b_pic'] != "") {?>
                  <input name="Submit2" type="button" class="menu-but" onclick="window.location='b_pic/<?php echo $row_Recsn2['b_pic'];?>'" value=" 查 看 " />
                  <?php }?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div><? }?>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
