<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
date_default_timezone_set('Asia/Taipei');
header("Content-Type:text/html; charset=utf-8");
if ($_SESSION['sn'] == "") {header(sprintf("Location: /life_link/index.php"));exit;} else {$sn=$_SESSION['sn'];}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: /life_link/index.php"));exit;}
$name=$row_Recsn['m_name'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");
//$fus=$_SESSION['gfus'];$gus=$_SESSION['ggus'];$card=$_SESSION['newcd'];$pudid=$_SESSION['pudid'];
$fus=$_SESSION['gfus'];$newnr=$_SESSION['newnr'];$pudid=$_SESSION['pudid'];$vfdcard=$_SESSION['fdcard'];//echo "##b-",$vfdcard;exit;
?>
<div id="divLoading" style="color:red; position:absolute; top:166px; left:703px;"> <img src="http://cmg588.com/life_link/ajax-loader.gif" border="0" style="vertical-align:middle;padding:6px"/> </div>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td height="100" align="center">&nbsp;</td>
  </tr>
  <tr>

    <td align="center">運算資訊中，請勿關閉或動任何行為…，請稍候...</td>

  </tr>

  <tr>

    <td align="center">進度： 4 / 7</td>

  </tr>

</table>
<script type="text/javascript">document.location.href="x_g_b.php";</script>
<?php exit;?>
<?php 
/******************************************
舊的入單程式?
*******************************************/
//new-p
mysql_select_db($database_sc, $sc);
$query_Reccd = sprintf("SELECT * FROM fd WHERE card='$vfdcard'");
$Reccd = mysql_query($query_Reccd, $sc) or die(mysql_error());
$row_Reccd = mysql_fetch_assoc($Reccd);
$totalRows_Reccd = mysql_num_rows($Reccd);
$c_num=$row_Reccd['number'];
$fname=$row_Reccd['name'];
$tt_us=$row_Reccd['card'];
$tid=$row_Reccd['id'];
mysql_select_db($database_sc, $sc);
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
	$apud_da=$row_Recapud['d_a'];
	$apud_db=$row_Recapud['d_b'];
	$apud_dc=$row_Recapud['d_c'];
	$apud_dd=$row_Recapud['d_d'];
	$my_fpay=$row_Recapud['my_fpay'];
	$my_p=$row_Recapud['my_p'];

if ($pudid == 3) {
	//oc-in
		$ocin=50000;
		$onote="新單購分";
		mysql_select_db($database_sc, $sc);
        $insertCommand13="INSERT INTO o_cash (number, cin, csum, note, date, time) VALUES ('$newnr', '$ocin', '$ocin', '$onote', '$date', '$time')"; 
        mysql_query($insertCommand13,$sc);
		$wi=2;
	while ($wi != 0) {
		//oc-out
		$ocout=25000;
		$onote="新單福卡";
		mysql_select_db($database_sc, $sc);
        $query_Recob = sprintf("SELECT * FROM o_cash WHERE number='$newnr' ORDER BY id DESC");// 
        $Recob = mysql_query($query_Recob, $sc) or die(mysql_error());
        $row_Recob = mysql_fetch_assoc($Recob);
	    $totalRows_Recob = mysql_num_rows($Recob);
		$new_oc=$row_Recob['csum']-25000;
		mysql_select_db($database_sc, $sc);
        $insertCommand13="INSERT INTO o_cash (number, cout, csum, note, date, time) VALUES ('$newnr', '$ocout', '$new_oc', '$onote', '$date', '$time')"; 
        mysql_query($insertCommand13,$sc);
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
	    $xgu="";
		$x2=$vfdcard;$xa=0;unset($xbu);$xbi=0;$xbj=0;//echo $x2;exit;
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
            $query_Recxf = sprintf("SELECT * FROM fd WHERE number = '$c_num' && card='$fdcard' && gtow='$gw'");
            $Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());
            $row_Recxf = mysql_fetch_assoc($Recxf);
            $totalRows_Recxf = mysql_num_rows($Recxf);
		if ($totalRows_Recxf == 0) {
		mysql_select_db($database_sc, $sc);
$insertCommand13="INSERT INTO fd (name, number, card, c_fuser, c_guser, gtow, year, moom, day, end_y, end_m, end_d, date, time ,fnumber) VALUES ('$fname', '$c_num', '$fdcard', '$tt_us', '$xgu', '$gw', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time', '問號?')"; 
mysql_query($insertCommand13,$sc);
		}
		//
		mysql_select_db($database_sc, $sc);
    $query_Recpb = sprintf("SELECT * FROM pay_b ORDER BY id DESC");
    $Recpb = mysql_query($query_Recpb, $sc) or die(mysql_error());
    $row_Recpb = mysql_fetch_assoc($Recpb);
    $totalRows_Recpb = mysql_num_rows($Recpb);
	$pud_name="自購福卡";
    $newpsum=$row_Recpb['psum']+$apud_b;$pat=1;
    mysql_select_db($database_sc, $sc);
    $insertCommand11="INSERT INTO pay_b (pin, psum, number, card, at, date, time, pud_name) VALUES ('$apud_b', '$newpsum', '$c_num', '$fdcard', '$pat', '$date', '$time', '$pud_name')"; 
    mysql_query($insertCommand11,$sc);	
	    mysql_select_db($database_sc, $sc);
    $query_Recpe = sprintf("SELECT * FROM pay_e ORDER BY id DESC");
    $Recpe = mysql_query($query_Recpe, $sc) or die(mysql_error());
    $row_Recpe = mysql_fetch_assoc($Recpe);
    $totalRows_Recpe = mysql_num_rows($Recpe);
    $newpsum=$row_Recpe['psum']+$apud_e;$pat=1;
    mysql_select_db($database_sc, $sc);
    $insertCommand11="INSERT INTO pay_e (pin, psum, number, card, at, date, time, pud_name) VALUES ('$apud_e', '$newpsum', '$c_num', '$fdcard', '$pat', '$date', '$time', '$pud_name')"; 
    mysql_query($insertCommand11,$sc);	
		$apud_fx=25000-20000-2500-100;
		mysql_select_db($database_sc, $sc);
    $query_Recpf = sprintf("SELECT * FROM pay_f ORDER BY id DESC");
    $Recpf = mysql_query($query_Recpf, $sc) or die(mysql_error());
    $row_Recpf = mysql_fetch_assoc($Recpf);
    $totalRows_Recpf = mysql_num_rows($Recpf);
    $newpsum=$row_Recpf['psum']+$apud_fx;$pat=1;
    mysql_select_db($database_sc, $sc);
    $insertCommand11="INSERT INTO pay_f (pin, psum, number, card, at, date, time, pud_name) VALUES ('$apud_fx', '$newpsum', '$c_num', '$fdcard', '$pat', '$date', '$time', '$pud_name')"; 
    mysql_query($insertCommand11,$sc);
		/*
		$glevel=2;$at=0;$gold_f=$my_fpay;$my_fuser=$fus;
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
		*/
		//
		$wi--;
		}
	}
	
//////////////////////////////////////
//////////////////////////////////////	
?>