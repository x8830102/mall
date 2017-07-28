<?php require_once('Connections/sc.php');mysql_query("set names utf8");
include('Connections/sr.php');mysql_query("set names utf8");
include('Connections/tw.php');mysql_query("set names utf8");
session_start();
include('if_login.php');
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
	if ($_POST['new_passwd'] == $_POST['r_passwd']) {
    $number=$HTTP_POST_VARS['number'];$m_passwd=$HTTP_POST_VARS['m_passwd'];$new_passwd=$HTTP_POST_VARS['new_passwd'];$r_passwd=$HTTP_POST_VARS['r_passwd'];
	//
	mysql_select_db($database_sc, $sc);
    $query_Recmem2 = sprintf("SELECT * FROM memberdata WHERE m_passwd = '$m_passwd' && number='$number'");
    $Recmem2 = mysql_query($query_Recmem2, $sc) or die(mysql_error());
    $row_Recmem2 = mysql_fetch_assoc($Recmem2);
    $totalRows_Recmem2 = mysql_num_rows($Recmem2);
	if ($totalRows_Recmem2 != 0) {
		$update11="UPDATE memberdata SET m_passwd='$new_passwd' WHERE number = '$number'";
        mysql_select_db($database_sc, $sc);
        $Result11 = mysql_query($update11, $sc) or die(mysql_error());
        $pas = MD5($new_passwd);
        mysql_select_db($database_tw, $tw);
        $up_pass="UPDATE wp_users SET user_pass='$pas' WHERE user_login = '$username'";
        $query_pass = mysql_query($up_pass,$tw)or die(mysql_error());
        
        mysql_select_db($database_sr, $sr);
        $up_pass="UPDATE wp_users SET user_pass='$pas' WHERE user_login = '$username'";
        $query_pass = mysql_query($up_pass,$sr)or die(mysql_error());

        $salt = substr(md5(uniqid(rand(), true)), 0, 9);
        $pdo = new PDO("mysql:host=localhost;dbname=twlifeli_ocmall;charset=utf8","twlifelinkcom","rgn26842");
        $query = $pdo->query("UPDATE oc_customer SET password = '".sha1($salt . sha1($salt . sha1($new_passwd)))."', salt = '$salt' WHERE m_username = '$username'");
		$send=1;
		} else {$err="舊密碼不符  !";$send=0;}
	//
		
		//$insertGoTo = "mem1.php";
        //header(sprintf("Location: %s", $insertGoTo));
	} else {$err="二次確認新密碼不符  !";$send=0;}
	} else {$err="檢查碼不符  !";$send=0;}
}

//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//
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
            <li> <a href="member_profile01.php"><span>資料確認</span></a> </li>
            <li> <a href="member_profile02.php"><span>資料修改</span></a> </li>
            <li class="active"> <a href="member_profile03.php"><span>密碼修改</span></a> </li>
            <li> <a href="member_profile04.php"><span>二級修改</span></a> </li>
            <li> <a href="member_profile05.php"><span>E-mail修改</span></a> </li>
            <li> <a href="member_profile06.php"><span>資料驗證</span></a> </li>
            <!--<li> <a href="member_profile07.php"><span>講師驗證</span></a> </li>-->
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">密碼修改</div>
            <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr class="menu-tr">
                      <td colspan="2" align="center"><span style="color: #F00"><?php echo $err;?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>暱稱</span></td>
                        <td><span><?php echo $nick;?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>登入帳號</span></td>
                        <td><span><?php echo $row_Recsn['m_username'];?>
                    <input name="number" type="hidden" id="number" value="<?php echo $row_Recsn['number'];?>" /></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">原始密碼</td>
                        <td>
                            <input name="m_passwd" type="password" id="m_passwd" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">新設密碼</td>
                        <td>
                            <input name="new_passwd" type="password" id="new_passwd" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">確認新密碼</td>
                        <td>
                            <input name="r_passwd" type="password" id="r_passwd" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">驗證碼</td>
                        <td><input name="sum" type="text" placeholder="請輸入驗證碼" style="min-width: 70px;" id="sum" size="12" />
                            <span style="padding: 2px; border: 1px solid #000"><?php echo $sum;?></span>
                            <a href="member_profile03.php"><img width="15px" src="img/refresh.png" alt="" style="margin-left: 3px"></a>
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
