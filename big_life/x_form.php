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
$sim=$HTTP_POST_VARS['sim'];
    //
	$ter=$HTTP_POST_VARS['ter'];$fuser=$HTTP_POST_VARS['fuser'];$fnumber=$HTTP_POST_VARS['fnumber'];$newuser=$HTTP_POST_VARS['newuser'];$m_passwd=$HTTP_POST_VARS['newpasswd'];$m_passtoo=$HTTP_POST_VARS['newpasstoo'];$mok=1;
	$coc=$HTTP_POST_VARS['coc'];$m_sex=$HTTP_POST_VARS['m_sex'];$m_birthday=$HTTP_POST_VARS['birthday'];$m_callphone=$HTTP_POST_VARS['callphone'];$m_email=$HTTP_POST_VARS['email'];$m_nick=$HTTP_POST_VARS['nick'];
	$pudid=$HTTP_POST_VARS['pudid'];$pud_p=$HTTP_POST_VARS['pud_p'];$pud_n=$HTTP_POST_VARS['pud_n'];$snumber=$HTTP_POST_VARS['snumber'];$b_pud=$HTTP_POST_VARS['b_pud']+0;
	mysql_select_db($database_sc, $sc);//echo "###",$pudid;exit;
    $query_Recapud = sprintf("SELECT * FROM a_pud WHERE id=$pudid");// 
    $Recapud = mysql_query($query_Recapud, $sc) or die(mysql_error());
    $row_Recapud = mysql_fetch_assoc($Recapud);
	$totalRows_Recapud = mysql_num_rows($Recapud);
	$apud_a1=$row_Recapud['fpay1'];
	$apud_a2=$row_Recapud['fpay2'];
	$apud_a=$row_Recapud['p'];
	$apud_b=$row_Recapud['b'];
	$apud_c=$row_Recapud['c'];
	$apud_d=$row_Recapud['d'];
	$apud_e=$row_Recapud['e'];
	$apud_f=$row_Recapud['f'];
	//switch ($pudid) {case'1':$fpay=0;break;case'2':$fpay=5;break;case'3':if ($b_pud == 0) {$fpay=15;}if ($b_pud == 1) {$fpay=18;}if ($b_pud == 2) {$fpay=24;};break;case'4':$fpay=18;break;case'5':$fpay=24;break;case'6':$fpay=24;break;}
	//
	if ($HTTP_POST_VARS['nick'] != "") {
	if ($HTTP_POST_VARS['callphone'] != "") {
	if ($HTTP_POST_VARS['email'] != "") {
	if ($HTTP_POST_VARS['see'] == $HTTP_POST_VARS['sum']) {
	$st=$HTTP_POST_VARS['st'];$st2=$HTTP_POST_VARS['st2'];$st3=$HTTP_POST_VARS['st3'];
	if ($st2 == 1) {
    
	//$m_nick=$HTTP_POST_VARS['m_nick'];$note=$HTTP_POST_VARS['note'];
	$date=date("Y-m-d");$time=date("H:i:s");$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");/*
	//-ocash
	mysql_select_db($database_sc, $sc);
    $query_Recob = sprintf("SELECT * FROM o_cash WHERE number='$snumber' ORDER BY id DESC");// 
    $Recob = mysql_query($query_Recob, $sc) or die(mysql_error());
    $row_Recob = mysql_fetch_assoc($Recob);
	$totalRows_Recob = mysql_num_rows($Recob);
	if ($row_Recob['csum'] >= $pud_p) {
		$new_ob=$row_Recob['csum']-$pud_p;
	$onote="註冊扣值, (".$pud_n.")<br/>帳號：".$newuser;
	mysql_select_db($database_sc, $sc);
    $insertCommand13="INSERT INTO o_cash (number, cout, csum, note, date, time) VALUES ('$snumber', '$pud_p', '$new_ob', '$onote', '$date', '$time')"; 
    mysql_query($insertCommand13,$sc);
		} else {
			header(sprintf("Location: new_account-1.php?err=我的註冊積分不足"));
			exit;
			}
	//-b_pud
	if ($b_pud != 0) {
		mysql_select_db($database_sc, $sc);
$query_Recb = sprintf("SELECT * FROM b_pud WHERE id=$b_pud");
$Recb = mysql_query($query_Recb, $sc) or die(mysql_error());
$row_Recb = mysql_fetch_assoc($Recb);
$totalRows_Recb = mysql_num_rows($Recb);
$pud_bp=$row_Recb['p'];
		//
	mysql_select_db($database_sc, $sc);
    $query_Recob = sprintf("SELECT * FROM o_cash WHERE number='$snumber' ORDER BY id DESC");// 
    $Recob = mysql_query($query_Recob, $sc) or die(mysql_error());
    $row_Recob = mysql_fetch_assoc($Recob);
	$totalRows_Recob = mysql_num_rows($Recob);
	if ($row_Recob['csum'] >= $pud_bp) {
		$new_ob=$row_Recob['csum']-$pud_bp;
	$onote=$newuser."註冊加購商品扣值, <br/>品名：".$row_Recb['name'];
	mysql_select_db($database_sc, $sc);
    $insertCommand13="INSERT INTO o_cash (number, cout, csum, note, date, time) VALUES ('$snumber', '$pud_bp', '$new_ob', '$onote', '$date', '$time')"; 
    mysql_query($insertCommand13,$sc);
		} else {
			header(sprintf("Location: new_account-1.php?err=我的註冊積分不足"));
			exit;
			}
	}
	//number
	mysql_select_db($database_sc, $sc);$bo="boss";
    $query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");
    $Reci = mysql_query($query_Reci, $sc) or die(mysql_error());
    $row_Reci = mysql_fetch_assoc($Reci);
    $num_box=$row_Reci['num_box'];
    $num_z=$row_Reci['num_z'];
    if(date("m") != $num_z) {
	   $numz=date("m");
	   $update11="UPDATE admin SET num_z=$numz WHERE username='$bo'";
       mysql_select_db($database_sc, $sc);
       $Result11 = mysql_query($update11, $sc) or die(mysql_error());
	   $num_box=1;
	   }
    if ($num_box == 10000) {echo "設定值巳超過9999單號，請洽系統工程師。";exit;}
    if ($num_box < 10) {$number="SN".date("ymd")."000".$num_box;$card=date("ym")."000".$num_box;}
    if ($num_box > 9 && $num_box < 100) {$number="SN".date("ymd")."00".$num_box;$card=date("ym")."00".$num_box;}
    if ($num_box < 1000 && $num_box > 99) {$number="SN".date("ymd")."0".$num_box;$card=date("ym")."0".$num_box;}
	if ($num_box < 10000 && $num_box > 999) {$number="SN".date("ymd").$num_box;$card=date("ym").$num_box;}
	$new_num_box=$num_box+1;
    $update11="UPDATE admin SET num_box=$new_num_box WHERE username='$bo'";
    mysql_select_db($database_sc, $sc);
    $Result11 = mysql_query($update11, $sc) or die(mysql_error());
	//
	mysql_select_db($database_sc, $sc);
    $insertCommand3="INSERT INTO memberdata (m_nick, card, m_username, m_passwd, m_passtoo, number, m_fuser, a_pud, b_pud, ks, m_ok, year, moom, day, z, m_sex, m_email, m_joinDate, m_callphone, st, date, time, fpay) VALUES ('$m_nick', '$card', '$newuser', '$m_passwd', '$m_passtoo', '$number', '$fnumber', '$pudid', '$b_pud', '$pud_p', '$mok', '$year', '$moom', '$day', '$z', '$m_sex', '$m_email', '$date', '$m_callphone', '$st', '$date', '$time', '$fpay')"; 
    mysql_query($insertCommand3,$sc);
	//
	mysql_select_db($database_sc, $sc);
    $insertCommand3="INSERT INTO bank (number, coc, phone, email) VALUES ('$number', '$coc', '$m_callphone', '$m_email')"; 
    mysql_query($insertCommand3,$sc);
	//infd
	if ($pudid >= 3) {
		//fd-number
	mysql_select_db($database_sc, $sc);$bo="boss";
    $query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");
    $Reci = mysql_query($query_Reci, $sc) or die(mysql_error());
    $row_Reci = mysql_fetch_assoc($Reci);
    $num_box=$row_Reci['fd_box'];
    $num_z=$row_Reci['fd_m'];
    if(date("m") != $num_z) {
	   $numz=date("m");
	   $update11="UPDATE admin SET fd_m=$numz WHERE username='$bo'";
       mysql_select_db($database_sc, $sc);
       $Result11 = mysql_query($update11, $sc) or die(mysql_error());
	   $num_box=1;
	   }
    if ($num_box == 10000) {echo "設定值巳超過9999單號，請洽系統工程師。";exit;}
    if ($num_box < 10) {$fdnumber="SN".date("ymd")."000".$num_box;$fdcard="f".date("ym")."000".$num_box;}
    if ($num_box > 9 && $num_box < 100) {$fdnumber="SN".date("ymd")."00".$num_box;$fdcard="f".date("ym")."00".$num_box;}
    if ($num_box < 1000 && $num_box > 99) {$fdnumber="SN".date("ymd")."0".$num_box;$fdcard="f".date("ym")."0".$num_box;}
	if ($num_box < 10000 && $num_box > 999) {$fdnumber="SN".date("ymd").$num_box;$fdcard="f".date("ym").$num_box;}
	$new_num_box=$num_box+1;
    $update11="UPDATE admin SET fd_box=$new_num_box WHERE username='$bo'";
    mysql_select_db($database_sc, $sc);
    $Result11 = mysql_query($update11, $sc) or die(mysql_error());
		//我系大公排
		if ($pudid < 6) {
			mysql_select_db($database_sc, $sc);
            $query_Recmfd = sprintf("SELECT * FROM fd WHERE number='$fnumber' ORDER BY id");//  DESC
            $Recmfd = mysql_query($query_Recmfd, $sc) or die(mysql_error());
            $row_Recmfd = mysql_fetch_assoc($Recmfd);
	        $totalRows_Recmfd = mysql_num_rows($Recmfd);
	        if ($totalRows_Recmfd != 0) {$mfdcard=$row_Recmfd['card'];} else {$mfdcard="f333";} 
			$xgu="";
		$x2=$mfdcard;$xa=0;unset($xbu);$xbi=0;$xbj=0;//echo $x2;exit;
		while ($xa == 0) {
			mysql_select_db($database_sc, $sc);
            $query_Recx2 = sprintf("SELECT * FROM fd WHERE c_guser = '$x2' ORDER BY gtow");
            $Recx2 = mysql_query($query_Recx2, $sc) or die(mysql_error());
            $row_Recx2 = mysql_fetch_assoc($Recx2);
            $totalRows_Recx2 = mysql_num_rows($Recx2);
			if ($totalRows_Recx2 < 2) {$xgu=$x2;$xa=1;} else {do {$xbu[$xbi]=$row_Recx2['card'];$xbi++;} while ($row_Recx2 = mysql_fetch_assoc($Recx2));$x2=$xbu[$xbj];$xbj++;}
			}
	        mysql_select_db($database_sc, $sc);
            $query_Recgg = sprintf("SELECT * FROM fd WHERE c_guser='$xgu'");
            $Recgg = mysql_query($query_Recgg, $sc) or die(mysql_error());
            $row_Recgg = mysql_fetch_assoc($Recgg);
            $totalRows_Recgg = mysql_num_rows($Recgg);
	        if ($totalRows_Recgg == 0) {$gw="L";} else {if ($row_Recgg['gtow'] == "L") {$gw="R";} else {$gw="L";}}
			$nyear=$year+1;
		    mysql_select_db($database_sc, $sc);
            $query_Recxf = sprintf("SELECT * FROM fd WHERE number = '$number' && card='$fdcard' && gtow='$gw'");
            $Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());
            $row_Recxf = mysql_fetch_assoc($Recxf);
            $totalRows_Recxf = mysql_num_rows($Recxf);
		if ($totalRows_Recxf == 0) {
		mysql_select_db($database_sc, $sc);
$insertCommand13="INSERT INTO fd (number, card, name, c_fuser, c_guser, gtow, year, moom, day, end_y, end_m, end_d, date, time) VALUES ('$number', '$fdcard', '$m_nick', '$mfdcard', '$xgu', '$gw', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time')"; 
mysql_query($insertCommand13,$sc);
		}
			}
		if ($pudid >= 6) {
			mysql_select_db($database_sc, $sc);
            $query_Recmfd = sprintf("SELECT * FROM fd2 WHERE number='$fnumber' ORDER BY id");//  DESC
            $Recmfd = mysql_query($query_Recmfd, $sc) or die(mysql_error());
            $row_Recmfd = mysql_fetch_assoc($Recmfd);
	        $totalRows_Recmfd = mysql_num_rows($Recmfd);
	        if ($totalRows_Recmfd != 0) {$mfdcard=$row_Recmfd['card'];} else {$mfdcard="d333";} 
			$xgu="";
		$x2=$mfdcard;$xa=0;unset($xbu);$xbi=0;$xbj=0;//echo $x2;exit;
		while ($xa == 0) {
			mysql_select_db($database_sc, $sc);
            $query_Recx2 = sprintf("SELECT * FROM fd2 WHERE c_guser = '$x2' ORDER BY gtow");
            $Recx2 = mysql_query($query_Recx2, $sc) or die(mysql_error());
            $row_Recx2 = mysql_fetch_assoc($Recx2);
            $totalRows_Recx2 = mysql_num_rows($Recx2);
			if ($totalRows_Recx2 < 2) {$xgu=$x2;$xa=1;} else {do {$xbu[$xbi]=$row_Recx2['card'];$xbi++;} while ($row_Recx2 = mysql_fetch_assoc($Recx2));$x2=$xbu[$xbj];$xbj++;}
			}
	        mysql_select_db($database_sc, $sc);
            $query_Recgg = sprintf("SELECT * FROM fd2 WHERE c_guser='$xgu'");
            $Recgg = mysql_query($query_Recgg, $sc) or die(mysql_error());
            $row_Recgg = mysql_fetch_assoc($Recgg);
            $totalRows_Recgg = mysql_num_rows($Recgg);
	        if ($totalRows_Recgg == 0) {$gw="L";} else {if ($row_Recgg['gtow'] == "L") {$gw="R";} else {$gw="L";}}
			$nyear=$year+1;
		    mysql_select_db($database_sc, $sc);
            $query_Recxf = sprintf("SELECT * FROM fd2 WHERE number = '$number' && card='$fdcard' && gtow='$gw'");
            $Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());
            $row_Recxf = mysql_fetch_assoc($Recxf);
            $totalRows_Recxf = mysql_num_rows($Recxf);
		if ($totalRows_Recxf == 0) {
		mysql_select_db($database_sc, $sc);
$insertCommand13="INSERT INTO fd2 (number, card, name, c_fuser, c_guser, gtow, year, moom, day, end_y, end_m, end_d, date, time) VALUES ('$number', '$fdcard', '$m_nick', '$mfdcard', '$xgu', '$gw', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time')"; 
mysql_query($insertCommand13,$sc);
		}
			}
		//////
		}//3
	//營業收款
	mysql_select_db($database_sc, $sc);
    $query_Recpa = sprintf("SELECT * FROM pay_a ORDER BY id DESC");
    $Recpa = mysql_query($query_Recpa, $sc) or die(mysql_error());
    $row_Recpa = mysql_fetch_assoc($Recpa);
    $totalRows_Recpa = mysql_num_rows($Recpa);
    $newpsum=$row_Recpa['psum']+$apud_a;$pat=1;
    mysql_select_db($database_sc, $sc);
    $insertCommand11="INSERT INTO pay_a (pin, psum, number, card, at, date, time) VALUES ('$apud_a', '$newpsum', '$number', '$card', '$pat', '$date', '$time')"; 
    mysql_query($insertCommand11,$sc);
	//p-f公司收款	//if ($pudid >= 3) {$papin=$pud_p-9000;} else {$papin=$pud_p;}
	mysql_select_db($database_sc, $sc);
    $query_Recpf = sprintf("SELECT * FROM pay_f ORDER BY id DESC");
    $Recpf = mysql_query($query_Recpf, $sc) or die(mysql_error());
    $row_Recpf = mysql_fetch_assoc($Recpf);
    $totalRows_Recpf = mysql_num_rows($Recpf);
    $newpsum=$row_Recpf['psum']+$apud_f;$pat=1;
    mysql_select_db($database_sc, $sc);
    $insertCommand11="INSERT INTO pay_a (pin, psum, number, card, at, date, time) VALUES ('$apud_f', '$newpsum', '$number', '$card', '$pat', '$date', '$time')"; 
    mysql_query($insertCommand11,$sc);
	//p-b
	mysql_select_db($database_sc, $sc);
    $query_Recpb = sprintf("SELECT * FROM pay_b ORDER BY id DESC");
    $Recpb = mysql_query($query_Recpb, $sc) or die(mysql_error());
    $row_Recpb = mysql_fetch_assoc($Recpb);
    $totalRows_Recpb = mysql_num_rows($Recpb);
    $newpsum=$row_Recpb['psum']+$apud_c;$pat=1;
    mysql_select_db($database_sc, $sc);
    $insertCommand11="INSERT INTO pay_b (pin, psum, number, card, at, date, time) VALUES ('$apud_c', '$newpsum', '$number', '$card', '$pat', '$date', '$time')"; 
    mysql_query($insertCommand11,$sc);
	//p-c
	mysql_select_db($database_sc, $sc);
    $query_Recpc = sprintf("SELECT * FROM pay_c ORDER BY id DESC");
    $Recpc = mysql_query($query_Recpc, $sc) or die(mysql_error());
    $row_Recpc = mysql_fetch_assoc($Recpc);
    $totalRows_Recpc = mysql_num_rows($Recpc);
    $newpsum=$row_Recpc['psum']+$apud_d;$pat=1;
    mysql_select_db($database_sc, $sc);
    $insertCommand11="INSERT INTO pay_c (pin, psum, number, card, at, date, time) VALUES ('$apud_d', '$newpsum', '$number', '$card', '$pat', '$date', '$time')"; 
    mysql_query($insertCommand11,$sc);
	//p-e
	mysql_select_db($database_sc, $sc);
    $query_Recpe = sprintf("SELECT * FROM pay_e ORDER BY id DESC");
    $Recpe = mysql_query($query_Recpe, $sc) or die(mysql_error());
    $row_Recpe = mysql_fetch_assoc($Recpe);
    $totalRows_Recpe = mysql_num_rows($Recpe);
    $newpsum=$row_Recpe['psum']+$apud_e;$pat=1;
    mysql_select_db($database_sc, $sc);
    $insertCommand11="INSERT INTO pay_e (pin, psum, number, card, at, date, time) VALUES ('$apud_e', '$newpsum', '$number', '$card', '$pat', '$date', '$time')"; 
    mysql_query($insertCommand11,$sc);
	//p-d 福袋
	if ($pudid >= 3) {
	//$pcpin=$apud_b;
mysql_select_db($database_sc, $sc);
$query_Recpd = sprintf("SELECT * FROM pay_d ORDER BY id DESC");
$Recpd = mysql_query($query_Recpd, $sc) or die(mysql_error());
$row_Recpd = mysql_fetch_assoc($Recpd);
$totalRows_Recpd = mysql_num_rows($Recpd);
$newcpsum=$row_Recpd['psum']+$apud_b;
mysql_select_db($database_sc, $sc);
$insertCommand13="INSERT INTO pay_d (pin, psum, number, card, at, date, time, year, moom, day) VALUES ('$apud_b', '$newcpsum', '$number', '$card', '$pat', '$date', '$time', '$year', '$moom', '$day')"; 
mysql_query($insertCommand13,$sc);
	}
	*/
	$_SESSION['gfus']=$fnumber;$_SESSION['newnr']=$number;$_SESSION['pudid']=$pudid;$_SESSION['fdcard']=$fdcard;
	/*$insertGoTo = "openok.php?newcard=".$card;
	$insertGoTo = "x_g_p.php";
    if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));*/
	//header(sprintf("Location: http://lifelink.laiwii.com/x_g_p.php"));exit;
	} else {header(sprintf("Location: new_account-2.php?err=請勾同意條約&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"));exit;}
	} else {header(sprintf("Location: new_account-2.php?err=檢查碼不符&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"));exit;}
	} else {header(sprintf("Location: new_account-2.php?err=信箱不可空&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"));exit;}
	} else {header(sprintf("Location: new_account-2.php?err=電話不可空&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"));exit;}
	} else {header(sprintf("Location: new_account-2.php?err=購買者名稱不可空&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid."&nick=".$m_nick."&newpasswd=".$m_passwd."&newpasstoo=".$m_passtoo."&coc=".$coc."&m_sex=".$m_sex."&birthday=".$m_birthday."&callphone=".$m_callphone."&email=".$m_email."&b_pud=".$b_pud."&sim=1"));exit;}
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
        body{
            font-family:"verdana","微軟正黑體" ; font-weight:400;
        }
    </style>
</head>

<body>
 <?php require_once('adx.php'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="50" align="center"><br>
    啟 動 系 統 註 冊<br>
    <br></td>
  </tr>
  <tr>
    <td align="center"><form action="http://biglife.laiwii.com/x_g_p.php" method="post" name="form1" id="form1">
        <input name="sn" type="hidden" id="sn" value="<?php echo $sn;?>">
        <input name="ter" type="hidden" id="ter" value="<?php echo $ter;?>">
        <input name="fuser" type="hidden" id="fuser" value="<?php echo $fuser;?>">
        <input name="fnumber" type="hidden" id="fnumber" value="<?php echo $fnumber;?>">
        <input name="newuser" type="hidden" id="newuser" value="<?php echo $newuser;?>">
        <input name="m_passwd" type="hidden" id="m_passwd" value="<?php echo $m_passwd;?>">
        <input name="m_passtoo" type="hidden" id="m_passtoo" value="<?php echo $m_passtoo;?>">
        <input name="mok" type="hidden" id="mok" value="<?php echo $mok;?>">
        <input name="coc" type="hidden" id="coc" value="<?php echo $coc;?>">
        <input name="m_sex" type="hidden" id="m_sex" value="<?php echo $m_sex;?>">
        <input name="m_birthday" type="hidden" id="m_birthday" value="<?php echo $m_birthday;?>">
        <input name="m_callphone" type="hidden" id="m_callphone" value="<?php echo $m_callphone;?>">
        <input name="m_email" type="hidden" id="m_email" value="<?php echo $m_email;?>">
        <input name="m_nick" type="hidden" id="m_nick" value="<?php echo $m_nick;?>">
        <input name="pudid" type="hidden" id="pudid" value="<?php echo $pudid;?>">
        <input name="pud_p" type="hidden" id="pud_p" value="<?php echo $pud_p;?>">
        <input name="pud_n" type="hidden" id="pud_n" value="<?php echo $pud_n;?>">
        <input name="snumber" type="hidden" id="snumber" value="<?php echo $snumber;?>">
        <input name="b_pud" type="hidden" id="b_pud" value="<?php echo $b_pud;?>">
        <input name="st" type="hidden" id="st" value="<?php echo $st;?>">
        <input name="st2" type="hidden" id="st2" value="<?php echo $st2;?>">
        <input name="st3" type="hidden" id="st3" value="<?php echo $st3;?>">
      <table width="200" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><input type="submit" name="button" id="button" value=" 確定 "></td>
          <td align="center"><a href="index.php">取消</a></td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p></td>
  </tr>
</table>

</body>
</html>