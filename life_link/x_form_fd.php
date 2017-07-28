<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
date_default_timezone_set('Asia/Taipei');
header("Content-Type:text/html; charset=utf-8");
include('if_login.php');
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
$sim=$_POST['sim'];
///////////////
/*$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_insert"])) && ($HTTP_POST_VARS["MM_insert"] == "form1")) {
*/	if ($_POST['see'] == $_POST['sum']) {
	$fdname=$_POST['fdname'];$fu=$_POST['fu'];$gu=$_POST['gu'];$w=$_POST['w'];$number=$_POST['number'];$m_passtoo=$_POST['m_passtoo'];$pudp=17880;
	$date=date("Y-m-d");$time=date("H:i:s");$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$mfu=$_POST['mfu'];$filling_position = $_POST['filling_position'];
		mysql_select_db($database_sc, $sc);
$query_Recfg = sprintf("SELECT * FROM memberdata WHERE number='$number'");
$Recfg = mysql_query($query_Recfg, $sc) or die(mysql_error());
$row_Recfg = mysql_fetch_assoc($Recfg);
$totalRows_Recfg = mysql_num_rows($Recfg);
		$my_fuser=$row_Recfg['m_fuser'];
		$apud=$row_Recfg['a_pud'];
		mysql_select_db($database_sc, $sc);
    $query_Recapud = sprintf("SELECT * FROM a_pud WHERE id=$apud");// 
    $Recapud = mysql_query($query_Recapud, $sc) or die(mysql_error());
    $row_Recapud = mysql_fetch_assoc($Recapud);
	$totalRows_Recapud = mysql_num_rows($Recapud);
	$my_fpay=$row_Recapud['my_fpay'];
	$my_p=$row_Recapud['my_p'];
	$apud_b=$row_Recapud['b'];
	//-ocash
	mysql_select_db($database_sc, $sc);
    $query_Recob = sprintf("SELECT * FROM c_cash WHERE number='$number' ORDER BY id DESC");// 
    $Recob = mysql_query($query_Recob, $sc) or die(mysql_error());
    $row_Recob = mysql_fetch_assoc($Recob);
	$totalRows_Recob = mysql_num_rows($Recob);
	if ($row_Recob['csum'] >= $my_p) {//echo "#",$my_p;exit;
		/*
		
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
		
		$new_ob=$row_Recob['csum']-$my_p;
	    $onote="寶物兌換<br/>編號：".$fdcard;
	    mysql_select_db($database_sc, $sc);
        $insertCommand13="INSERT INTO c_cash (number, cout, csum, note, date, time) VALUES ('$number', '$my_p', '$new_ob', '$onote', '$date', '$time')"; 
        mysql_query($insertCommand13,$sc);
		//
		$nyear=$year+1;
		mysql_select_db($database_sc, $sc);
            $query_Recxf = sprintf("SELECT * FROM fd WHERE number = '$number' && card='$fdcard' && gtow='$w'");
            $Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());
            $row_Recxf = mysql_fetch_assoc($Recxf);
            $totalRows_Recxf = mysql_num_rows($Recxf);
		if ($totalRows_Recxf == 0) {
		mysql_select_db($database_sc, $sc);
$insertCommand13="INSERT INTO fd (name, number, card, c_fuser, c_guser, gtow, year, moom, day, end_y, end_m, end_d, date, time) VALUES ('$fdname', '$number', '$fdcard', '$fu', '$gu', '$w', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time')"; 
mysql_query($insertCommand13,$sc);}
        //
		//p-a公司收款
	$apud_f=$my_p-$apud_b-$my_fpay;
	mysql_select_db($database_sc, $sc);
    $query_Recpa = sprintf("SELECT * FROM pay_a ORDER BY id DESC");
    $Recpa = mysql_query($query_Recpa, $sc) or die(mysql_error());
    $row_Recpa = mysql_fetch_assoc($Recpa);
    $totalRows_Recpa = mysql_num_rows($Recpa);
    $newpsum=$row_Recpa['psum']+$apud_f;$pat=1;
    mysql_select_db($database_sc, $sc);
    $insertCommand11="INSERT INTO pay_a (pin, psum, number, card, at, date, time) VALUES ('$apud_f', '$newpsum', '$number', '$card', '$pat', '$date', '$time')"; 
    mysql_query($insertCommand11,$sc);
		//p-d 福袋
mysql_select_db($database_sc, $sc);
$query_Recpc = sprintf("SELECT * FROM pay_d ORDER BY id DESC");
$Recpc = mysql_query($query_Recpc, $sc) or die(mysql_error());
$row_Recpc = mysql_fetch_assoc($Recpc);
$totalRows_Recpc = mysql_num_rows($Recpc);
$newcpsum=$row_Recpc['psum']+$apud_b;
mysql_select_db($database_sc, $sc);
$insertCommand13="INSERT INTO pay_d (pin, psum, number, card, at, date, time, year, moom, day) VALUES ('$apud_b', '$newcpsum', '$number', '$card', '$pat', '$date', '$time', '$year', '$moom', '$day')"; 
mysql_query($insertCommand13,$sc);
		//fg$1000
		$gold_f=$my_fpay;
		mysql_select_db($database_sc, $sc);
$query_Recfg2 = sprintf("SELECT * FROM memberdata WHERE number='$my_fuser'");
$Recfg2 = mysql_query($query_Recfg2, $sc) or die(mysql_error());
$row_Recfg2 = mysql_fetch_assoc($Recfg2);
$totalRows_Recfg2 = mysql_num_rows($Recfg2);
if ($row_Recfg2['a_pud'] >= 3) {
		$glevel=2;$at=1;
		$sncode=$my_fuser."-".date("ymdhis");
		$fnote="關係福袋獎勵(".$fdcard.")";
	mysql_select_db($database_sc, $sc);
    $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$my_fuser', '$year', '$moom', '$day', '$z', '$gold_f', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
    mysql_query($insertCommand15,$sc);
	    mysql_select_db($database_sc, $sc);
    $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$my_fuser' && year=$year && moom=$moom && day=$day");
    $Recs = mysql_query($query_Recs, $sc) or die(mysql_error());
    $row_Recs = mysql_fetch_assoc($Recs);
    $totalRows_Recs = mysql_num_rows($Recs);
    if ($totalRows_Recs == 0) {
        mysql_select_db($database_sc, $sc);
        $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level2) VALUES ('$my_fuser', '$year', '$moom', '$day', '$z', '$gold_f')"; 
        mysql_query($insertCommand15,$sc);
        } else {
	        $new_level2=$row_Recs['level2']+$gold_f;
	        $update11="UPDATE gold_sum SET level2= $new_level2 WHERE number = '$my_fuser' && year=$year && moom=$moom && day=$day";
            mysql_select_db($database_sc, $sc);
            $Result11 = mysql_query($update11, $sc) or die(mysql_error());
	        }
		    $hd=$gold_f*0.2;
	        mysql_select_db($database_sc, $sc);
            $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$my_fuser' ORDER BY id DESC");
            $Rech = mysql_query($query_Rech, $sc) or die(mysql_error());
            $row_Rech = mysql_fetch_assoc($Rech);
            $totalRows_Rech = mysql_num_rows($Rech);
	        $new_h=$row_Rech['csum']+$hd;
	        $fnotex="關係福袋獎勵(".$fdcard.")";
	        mysql_select_db($database_sc, $sc);
            $insertCommand15="INSERT INTO g_cash (number, cin, csum, note, date, time, sncode) VALUES ('$my_fuser', '$hd', '$new_h', '$fnotex', '$date', '$time', '$sncode')"; 
            mysql_query($insertCommand15,$sc);
			$hd=$gold_f*0.8;
	        mysql_select_db($database_sc, $sc);
            $query_Rech = sprintf("SELECT * FROM c_cash WHERE number = '$my_fuser' ORDER BY id DESC");
            $Rech = mysql_query($query_Rech, $sc) or die(mysql_error());
            $row_Rech = mysql_fetch_assoc($Rech);
            $totalRows_Rech = mysql_num_rows($Rech);
	        $new_h=$row_Rech['csum']+$hd;
	        $fnotex="關係福袋獎勵(".$fdcard.")";
	        mysql_select_db($database_sc, $sc);
            $insertCommand15="INSERT INTO c_cash (number, cin, csum, note, date, time, sncode) VALUES ('$my_fuser', '$hd', '$new_h', '$fnotex', '$date', '$time', '$sncode')"; 
            mysql_query($insertCommand15,$sc);
		/////////////		
	$_SESSION['fu']=$fu;$_SESSION['gu']=$gu;$_SESSION['nsn']=$number;$_SESSION['fdcard']=$fdcard;
	/*$insertGoTo = "x_g_fd.php";
    if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
    header(sprintf("Location: %s", $insertGoTo));
	exit;
	}}*/
	} else {header(sprintf("Location: new_account-5.php?err=串串積分不足30000"));exit;}
	} else {header(sprintf("Location: new_account-5.php?err=檢查碼不符"));exit;}
//}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>串門子雲端事業</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
            font-family:"verdana","微軟正黑體" ; font-weight:400;background: #cfcfcf;
        }
        .order {
            background: #fff;
            box-shadow: 0px 0px 10px 2px #b2b2b2;
            min-height: 220px;
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
    <form action="~x-form/x_g_p_fd.php" method="post" name="form1" id="form1">
        <input name="sn" type="hidden" id="sn" value="<?php echo $sn;?>">
        <input name="fdname" type="hidden" id="fdname" value="<?php echo $fdname;?>">
        <input name="fu" type="hidden" id="fu" value="<?php echo $fu;?>">
        <input name="gu" type="hidden" id="gu" value="<?php echo $gu;?>">
        <input name="w" type="hidden" id="w" value="<?php echo $w;?>">
		<input name="filling_position" type="hidden" id="filling_position" value="<?php echo $filling_position;?>">
        <input name="number" type="hidden" id="number" value="<?php echo $number;?>">
        <input name="m_passtoo" type="hidden" id="m_passtoo" value="<?php echo $m_passtoo;?>">
        <input name="pudp" type="hidden" id="pudp" value="<?php echo $pudp;?>">
        <div class="col-lg-4 col-md-4 order_contain" align="center"><img src="img/life-link_logo.png" alt=""></div>
        <div class="col-lg-4 col-md-4" align="center"><h3 style="font-size: 21px">您確定獲取此福袋卡?</h3></div>
        <div class="col-lg-4 col-md-4" align="center">
        <ul>
            <li style="margin-top: 20px"><input type="submit" name="button" id="button" value=" 確定 "></li>
            <li style="margin-top:-2px "> <input name="Submit4" type="button" onclick="window.location='new_account-1.php'" value=" 取消 " class="xform_but" /></li>
        </ul>   
    </div>
   
      
  </form>
    </div>

</body>
</html>