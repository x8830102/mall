<?php require_once('Connections/sc.php');require_once('Connections/sr.php');require_once('Connections/tw.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
include('if_login.php');
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
$sim=$_POST['sim'];
    //
	$ter=$_POST['ter'];$fuser=$_POST['fuser'];$fnumber=$_POST['fnumber'];$newuser=$_POST['newuser'];$m_passwd=$_POST['newpasswd'];$m_passtoo=$_POST['newpasstoo'];$mok=1;
	$coc=$_POST['coc'];$m_sex=$_POST['m_sex'];$m_birthday=$_POST['birthday'];$m_callphone=$_POST['callphone'];$m_email=$_POST['email'];$m_nick=$_POST['nick'];
	$pudid=$_POST['pudid'];$pud_p=$_POST['pud_p'];$snumber=$_POST['snumber'];$b_pud=$_POST['b_pud']+0;
	$as_at=$_POST['as_at'];$as_number=$_POST['as_number'];$as_name=$_POST['as_name'];$notpay =$_POST["notpay"];$Tname=$_POST['Tname'];

	$fuser=$_POST['fuser'];
	$fuser2=$_POST['fuser2'];
	$businessRatio=$_POST['businessRatio'];
	$districtRatio=$_POST['districtRatio'];
	$district =$_POST['district'];
	
	//
	if ($_POST['nick'] != "") {
	if ($_POST['callphone'] != "") {
	if ($_POST['email'] != "") {
	if ($_POST['see'] == $_POST['sum']) {
	$st=$_POST['st'];$st2=$_POST['st2'];$st3=$_POST['st3'];
	if ($st2 == 1) {
    
	//$m_nick=$HTTP_POST_VARS['m_nick'];$note=$HTTP_POST_VARS['note'];
	$date=date("Y-m-d");$time=date("H:i:s");$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");

$_SESSION['gfus']=$fnumber;$_SESSION['newnr']=$number;$_SESSION['pudid']=$pudid;$_SESSION['fdcard']=$fdcard;
//
$emailat=0;
mysql_select_db($database_sc, $sc);
$select_tname = sprintf("SELECT number FROM memberdata WHERE m_username='$Tname'");
$query_tname = mysql_query($select_tname, $sc) or die(mysql_error());
$row_tname = mysql_fetch_assoc($query_tname);
$Tnumber = $row_tname['number'];

$query_Recm1 = sprintf("SELECT * FROM memberdata WHERE m_email='$m_email'");
$Recm1 = mysql_query($query_Recm1, $sc) or die(mysql_error());
$row_Recm1 = mysql_fetch_assoc($Recm1);
$totalRows_Recm1 = mysql_num_rows($Recm1);
if ($totalRows_Recm1 == 1) {$emailat=1;}
mysql_select_db($database_sr, $sr);
$query_Recm2 = sprintf("SELECT * FROM wp_users WHERE user_email='$m_email'");
$Recm2 = mysql_query($query_Recm2, $sr) or die(mysql_error());
$row_Recm2 = mysql_fetch_assoc($Recm2);
$totalRows_Recm2 = mysql_num_rows($Recm2);
if ($totalRows_Recm2 == 1) {$emailat=1;}
mysql_select_db($database_tw, $tw);
$query_Recm3 = sprintf("SELECT * FROM wp_users WHERE user_email='$m_email'");
$Recm3 = mysql_query($query_Recm3, $tw) or die(mysql_error());
$row_Recm3 = mysql_fetch_assoc($Recm3);
$totalRows_Recm3 = mysql_num_rows($Recm3);

if ($totalRows_Recm3 == 1) {$emailat=1;}
/*if ($emailat == 1) {header(sprintf("Location: new_account-2.php?err=信箱已有登請重新輸入&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"."&as_number=".$as_number."&as_name=".$as_name));exit;}*/
	} else {header(sprintf("Location: new_account-2.php?err=請勾同意條約&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"."&as_number=".$as_number."&as_name=".$as_name));exit;}
	} else {header(sprintf("Location: new_account-2.php?err=檢查碼不符&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"."&as_number=".$as_number."&as_name=".$as_name));exit;}
	} else {header(sprintf("Location: new_account-2.php?err=信箱不可空&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"."&as_number=".$as_number."&as_name=".$as_name));exit;}
	} else {header(sprintf("Location: new_account-2.php?err=電話不可空&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"."&as_number=".$as_number."&as_name=".$as_name));exit;}
	} else {header(sprintf("Location: new_account-2.php?err=購買者名稱不可空&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"."&as_number=".$as_number."&as_name=".$as_name));exit;}
//
mysql_select_db($database_sc, $sc);
$query_Recem = sprintf("SELECT * FROM memberdata WHERE m_email='$m_email'");
$Recem = mysql_query($query_Recem, $sc) or die(mysql_error());
$row_Recem = mysql_fetch_assoc($Recem);
$totalRows_Recem = mysql_num_rows($Recem);
if ($totalRows_Recem != 0) {header(sprintf("Location: new_account-2.php?err=信箱已有登記&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"."&as_number=".$as_number."&as_name=".$as_name));exit;}
$re_d="new_account-2.php?err=再次確認資料&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"."&as_number=".$as_number."&as_name=".$as_name;
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
        body{
            font-family:"verdana","微軟正黑體" ; font-weight:400;
        }
    </style>
    <style>
		body {
			background: #cfcfcf;

		}
		.order {
			background: #fff;
			box-shadow: 0px 0px 10px 2px #b2b2b2;
			min-height: 420px;
			border-radius: 10px;
			margin: 15px 22px;
			padding: 60px 
		}
		.order_contain {

		}
		.order li {
			line-height: 40px;
			margin-top: 10px
		}
		.order a {
			color: #949494;

		}

		#button {
			background: #44cf33;
			border-radius: 4px;
			color: #fff;
			border: 0px;
			width: 200px;
			height: 30px;
			line-height: 30px;
			transition: all 0.5s;
			
		}
		#button:hover {
			box-shadow: 3px 2px 0px #2a7d1f
		}
		.xform_but {
			border-radius: 4px;
			background: #bcbcbc;
			color: #fff;
			border: 0px;
			width: 200px;
			height: 30px;
			line-height: 30px;
			transition: all 0.5s;
		}
		.xform_but:hover {
			box-shadow: 3px 2px 0px #676767
		}
    </style>
</head>

<body>
<div class="order">
<form action="~x-form/x_g_p.php" method="post" name="form1" id="form1">
        <input name="sn" type="hidden"  id="sn" value="<?php echo $sn;?>">
        <input name="ter" type="hidden"  id="ter" value="<?php echo $ter;?>">
        <input name="fuser" type="text"  id="fuser" value="<?php echo $fuser;?>">
		<input name="fuser2" type="text" id="fuser2" value="<?php echo $fuser2;?>" />
        <input name="businessRatio" type="hidden" id="businessRatio" value="<?php echo $businessRatio;?>" />
        <input name="districtRatio" type="hidden" id="districtRatio" value="<?php echo $districtRatio;?>" />
		<input name="district" type="hidden"  id="district" value="<?php echo $district;?>">
        <input name="fnumber" type="hidden"  id="fnumber" value="<?php echo $fnumber;?>">
        <input name="newuser" type="hidden"  id="newuser" value="<?php echo $newuser;?>">
		<input name="notpay" type="hidden"  id="notpay" value="<?php echo $notpay;?>">
        <input name="m_passwd" type="hidden"  id="m_passwd" value="<?php echo $m_passwd;?>">
        <input name="m_passtoo" type="hidden" id="m_passtoo" value="<?php echo $m_passtoo;?>">
        <input name="mok" type="hidden"  id="mok" value="<?php echo $mok;?>">
        <input name="coc" type="hidden"  id="coc" value="<?php echo $coc;?>">
        <input name="m_sex" type="hidden" id="m_sex" value="<?php echo $m_sex;?>">
        <input name="m_birthday" type="hidden"  id="m_birthday" value="<?php echo $m_birthday;?>">
        <input name="m_callphone" type="hidden" id="m_callphone" value="<?php echo $m_callphone;?>">
        <input name="m_email" type="hidden"  id="m_email" value="<?php echo $m_email;?>">
        <input name="m_nick" type="hidden"  id="m_nick" value="<?php echo $m_nick;?>">
        <input name="pudid" type="hidden"  id="pudid" value="<?php echo $pudid;?>">
        <input name="snumber" type="hidden"  id="snumber" value="<?php echo $snumber;?>">
        <input name="b_pud" type="hidden" id="b_pud" value="<?php echo $b_pud;?>">
        <input name="st" type="hidden"  id="st" value="<?php echo $st;?>">
        <input name="st2" type="hidden"  id="st2" value="<?php echo $st2;?>">
        <input name="st3" type="hidden"  id="st3" value="<?php echo $st3;?>">
        <input name="as_at" type="hidden"  id="as_at" value="<?php echo $as_at;?>">
        <input name="as_number" type="hidden"  id="as_number" value="<?php echo $as_number;?>">
        <input name="as_name" type="hidden"  id="as_name" value="<?php echo $as_name;?>">
		<input name="Tnumber" type="hidden"  id="Tnumber" value="<?php echo $Tnumber;?>">

        <div class="col-lg-4 col-md-4 order_contain" align="center"><img src="img/life-link_logo.png" alt=""></div>
		<div class="col-lg-4 col-md-4" align="center"><h3>開通信箱<br/>
		    <span style="font-size: 10px"><?php echo $m_email;?></span><br/><br/>購買系統真實範例查詢 &nbsp;&nbsp;&nbsp;<a href="http://demo2.lifelink.cc">系統demo</a><br/><br/>
            注意：本系統屬於智慧財產性質，經線上註冊完成，即視為已拆封使用不得退還。<br/><br/>確定送出新單嗎？</h3></div>
		<div class="col-lg-4 col-md-4" align="center">
		<ul>
			<li style="margin-top: 20px"><input type="submit" name="button" id="button" value=" 確定 "></li>
			<li style="margin-top:-2px "><input type ="button" onclick="window.location='<? echo $re_d;?>'" value="不，仍有資料尚未確認" class="xform_but"></input></li>
		</ul>	
	</div>

</form>
	</div>	
 

</body>
</html>