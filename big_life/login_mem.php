<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
//if ($_SESSION['sn'] == "") {header(sprintf("Location: err.php"));exit;} else {$sn=$_SESSION['sn'];}
//
$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}
if ((isset($HTTP_POST_VARS["MM_insert"])) && ($HTTP_POST_VARS["MM_insert"] == "form1")) {
if ($_POST['sum'] != "") {
if ($_POST['card'] != "") {
if ($_POST['passwd'] != "") {
if ($_POST['see'] == $_POST['sum']) {
$card = strtoupper(trim($_POST['card']));$passwd = $_POST['passwd'];$fm = $_POST['sum'];$fe = $_POST['see'];$snv=$_POST['sn'];$ads=$_POST['ads'];
if ($ads == 0) {$ads2=" && a_pud = 1";$wto="../life_link/index.php";} else {$ads2=" && a_pud >= 6";$wto="index.php";}
mysql_select_db($database_sc, $sc);
$query_Recf = sprintf("SELECT * FROM memberdata WHERE m_username = '$card' && m_passwd = '$passwd' && m_ok = 1 $ads2");//
$Recf = mysql_query($query_Recf, $sc) or die(mysql_error());
$row_Recf = mysql_fetch_assoc($Recf);
$totalRows_Recf = mysql_num_rows($Recf);//echo $totalRows_Recf,"-",$fm,"-",$fe;exit;
if ($totalRows_Recf != 0 && $fm == $fe) {//echo "ok";exit;
$_SESSION['mem'] = $row_Recf['m_username'];
$_SESSION['number'] = $row_Recf['number'];
$_SESSION['MM_Username'] = $row_Recf['m_id'];
$name=$row_Recf['m_name'];
$nick=$row_Recf['m_nick'];
$card=$row_Recf['card'];
$sn=$row_Recf['number'];
//
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}
else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
  $ip=$_SERVER['REMOTE_ADDR'];
}
$now_datetime=date("Y/m/d H:i:s");$sys_datetime=date("Y-m-d H:i:s");$admin="sys";$sysnote="登入管理者介面";
mysql_select_db($database_sc, $sc);
$insertCommand3="INSERT INTO main_ip (ip, admin, datetime, note, name, nick, number, card) VALUES ('$ip', '$admin', '$sys_datetime', '$sysnote', '$name', '$nick', '$sn', '$card')"; 
mysql_query($insertCommand3,$sc);
header(sprintf("Location: $wto"));
exit;
} else {$a = "會員資料不對(設定帳號、登入密碼、非己位階)!!!";}
//
} else {$a="驗證碼不符!!!";}
} else {$a="密碼不可空白!!!";}
} else {$a="卡號不可空白!!!";}
} else {$a="驗證碼不可空白!!!";}
}
/*
if ($_SESSION['sn'] == "") {header(sprintf("Location: err.php"));exit;} else {$sn=$_SESSION['sn'];}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok = 1");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: err.php"));exit;}
*/
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>串門子雲端事業使用者登入</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
    body {
        font-family: "verdana", "微軟正黑體";
        font-weight: 400;
    }
    </style>
</head>

<body>
    <div class="index_img" align="center">
        
        <div class="col-lg-3  col-md-4  col-sm-5  col-xs-10 offset">
            <div class="member">
                <img width="100%" src="img/logo-01.png" alt="live link" >
                <div class="contain ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  member-l">
                    <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
                        <div style="text-align: center;"><img width="70px" src="img/crown-01.png" alt="" style="margin:10px"></div>
                        <ul class="left_text">
                            <li class="custom">
                                <input type="radio" name="ads" class="custom_li" value="0"><span>粉絲</span>
                            </li>
                            <li class="custom">
                                <input type="radio" name="ads" class="custom_li" value="1"><span>VIP</span>
                            </li>
                            
                            <li>登入帳號</li>
                            <li>
                                <input name="card" type="text" style="min-width: 200px; height: 25px">
                            </li>
                            <li>密碼</li>
                            <li>
                                <input name="passwd" type="password" style="min-width: 200px; height: 25px">
                            </li>
                            <li>
                                <?php echo $sum;?><a href="login_mem.php"><button type="button" class="but" style="width: 97px;">刷新驗證碼</button></a>
                            </li>
                            <li>驗證碼&nbsp;&nbsp;&nbsp;<span style="color: #F00"><? echo $a;?></span></li>
                            <li>
                              <input name="sum" type="text" style="width: 90px; height: 25px">
                                <input type="submit" class="but" name="button" id="button" value="登入">
                                <input type="hidden" name="MM_insert" value="form1" />
                                <input name="see" type="hidden" id="see" value="<?php echo $sum;?>" />
                                <a href="forget.php"><button type="button" class="but" style="margin-left: 5px;">忘記密碼</button></a>
                            </li>
                        </ul>
                    </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
