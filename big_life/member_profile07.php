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
    $name=$HTTP_POST_VARS['name'];$user=$HTTP_POST_VARS['user'];$s=$HTTP_POST_VARS['s'];$c=$HTTP_POST_VARS['c'];$callphone=$HTTP_POST_VARS['callphone'];
	$email=$HTTP_POST_VARS['email'];
	//
	$datetime=date("Y-m-d H:i:s");
	$mailtype='Content-Type:text/html;charset=utf-8';
$mailFrom=$email;
$mailTo="t-ser@lifelink.com.tw";
$mailCC="";
$mailBCC="";
$mailSubject="講師認證申請 通知";
$mailContent = "<p>申請者姓名 ：".$name."<br/>會員帳號 ：".$user."<br/>聯絡電話：".$callphone."<br/>E-mail：".$email."<br/>================================<br/><br/>企劃合作名稱 ：".$s."<br/>內容詳述 : ".nl2br($c)."<br/><br/><br/>---   日期 - ".$datetime."  ---</p>";
$maildata = "From:$mailFrom\r\n";
if ($mailCC != '') {
$maildata .= "CC:$mailCC\r\n";
}
if ($mailBCC != '') {
$maildata .= "BCC:$mailBCC\r\n";
}
$maildata .= "$mailtype";
mail($mailTo,$mailSubject,$mailContent,$maildata);
	$send=1;
	} else {$err="檢查碼不符  !";$send=0;}
}
//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
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
            <li> <a href="member_profile06.php"><span>資料驗證</span></a> </li>
            <li class="active"> <a href="member_profile07.php"><span>講師驗證</span></a> </li>
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">講師認證申請</div>
            <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr class="menu-tr">
                        <td class="menu-td">申請人</td>
                        <td>
                            <input name="name" type="text" id="name" value="" placeholder="請輸入真實身份姓名" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>登入帳號</span></td>
                        <td>
                            <input name="user" type="text" id="user" value="<?php echo $row_Recsn['m_username'];?>" placeholder="請輸入網站登入帳號" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>企劃合作名稱</span></td>
                        <td>
                            <input name="s" type="text" id="s" value="" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>內容詳述</td>
                        <td>
                            <textarea name="c" id="c" style="line-height: 16px" rows="3" cols="25" required
                                placeholder=""></textarea>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>行動電話</span></td>
                        <td>
                            <input name="callphone" type="text" id="callphone" value="" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>e-mail</span></td>
                        <td>
                            <input name="email" type="text" id="email" value="" />
                        </td>
                    </tr>
                    <tr class="menu-tr" >
                        <td class="menu-td" ><span>聲明事項</span></td>
                        <td><div style="width: 250px; font-size: 13px;line-height: 16px"> 1、本申請人申請之企劃合作方案需與於實際活動或課程吻合實施，若有不實行為，或利用串門子公司之網路平台工具，從事違法或非法行為，經查證或舉報屬實，本人自負民刑事法律責任，並同意由公司追回已領取之講師積分、佣金領取及取消講師之資格絕無異議。</div></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">請輸入驗證碼</td>
                        <td>
                            <input name="sum" type="text" id="sum" style="min-width: 70px;" size="12" placeholder="請輸入驗證碼">
                            <?php echo $sum;?>
                            <a href="member_profile06.php"><img width="15px" src="img/refresh.png" alt="" style="margin-left: 3px"></a>
                        </td>
                    </tr>
                    <tr class="menu-tr" align="center">
                        <td colspan="2"><input name="MM_update" type="hidden" id="MM_update" value="form1" />
                          <input name="see" type="hidden" id="see" value="<?php echo $sum;?>" />
                          <?php if ($send == 1) {echo " 完成送出申請 ";} else {?>
                          <button type="button" class="menu-but">儲存</button>
                        <?php }?></td>
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
