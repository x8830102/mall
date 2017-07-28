<?php require_once('Connections/sc.php'); 
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
//$fus=$_SESSION['gfus'];$gus=$_SESSION['ggus'];$card=$_SESSION['newcd'];$pudid=$_SESSION['pudid'];//echo $vfdcard;exit;
$fus=$_SESSION['gfus'];$newnr=$_SESSION['newnr'];$pudid=$_SESSION['pudid'];$vfdcard=$_SESSION['fdcard'];
?>
<div id="divLoading" style="color:red; position:absolute; top:166px; left:703px; width:478px; height:50px;z-order=0">
<img src="../ajax-loader.gif" style="vertical-align:middle;padding:6px"/>
運算資訊中，請勿關閉或動任何行為…，請稍候...
</div>
<table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><img src="img/life-link_logo.png" width="228" height="82" border="0"></td>
  </tr>
  <tr>
    <td align="center">進度： 7 / 7</td>
  </tr>
</table>
<script type="text/javascript">document.location.href="/life_link/new_account-3.php?newid=<?php echo $newnr;?>";</script>
<?php exit;?>
<?php
/*******************************************
檢查出局(已另寫)
********************************************/ 
$re_c=0;

mysql_select_db($database_sc, $sc);
$query_Reccd = sprintf("SELECT * FROM memberdata WHERE number='$fus'");
$Reccd = mysql_query($query_Reccd, $sc) or die(mysql_error());
$row_Reccd = mysql_fetch_assoc($Reccd);
$totalRows_Reccd = mysql_num_rows($Reccd);//echo $fus,"###",$totalRows_Reccd;exit;
if ($totalRows_Reccd != 0 && $row_Reccd['f_tog'] == 2) {
		$fdsql="fd";
        //
		mysql_select_db($database_sc, $sc);
        $query_Recfd = sprintf("SELECT * FROM $fdsql WHERE number='$fus' && at=0 ORDER BY id");// DESC 
        $Recfd = mysql_query($query_Recfd, $sc) or die(mysql_error());
        $row_Recfd = mysql_fetch_assoc($Recfd);
	    $totalRows_Recfd = mysql_num_rows($Recfd);
		if ($totalRows_Recfd != 0) {
		$tt_us=$row_Recfd['card'];
		$c_num=$row_Recfd['number'];
        $fname=$row_Recfd['name'];
		$tid=$row_Recfd['id'];
		//fd-number
	mysql_select_db($database_sc, $sc);$bo="boss";
    $query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");
    $Reci = mysql_query($query_Reci, $sc) or die(mysql_error());
    $row_Reci = mysql_fetch_assoc($Reci);
    $num_box=$row_Reci['fd_box'];
    $num_z=$row_Reci['fd_m'];
    if(date("m") != $num_z) {
	   $numz=date("m");
	   $update11="UPDATE admin SET fd_m='$numz' WHERE username='$bo'";
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
    $update11="UPDATE admin SET fd_box='$new_num_box' WHERE username='$bo'";
    mysql_select_db($database_sc, $sc);
    $Result11 = mysql_query($update11, $sc) or die(mysql_error());
		//我系大公排
	    $xgu="";
		$x2=$tt_us;$xa=0;unset($xbu);$xbi=0;$xbj=0;//echo $x2;exit;
		while ($xa == 0) {
			mysql_select_db($database_sc, $sc);
            $query_Recx2 = sprintf("SELECT * FROM $fdsql WHERE c_guser = '$x2' ORDER BY gtow");
            $Recx2 = mysql_query($query_Recx2, $sc) or die(mysql_error());
            $row_Recx2 = mysql_fetch_assoc($Recx2);
            $totalRows_Recx2 = mysql_num_rows($Recx2);
			if ($totalRows_Recx2 < 2) {$xgu=$x2;$xa=1;} else {do {$xbu[$xbi]=$row_Recx2['card'];$xbi++;} while ($row_Recx2 = mysql_fetch_assoc($Recx2));$x2=$xbu[$xbj];$xbj++;}
			}
		//}//echo $xgu;exit;
	//
	mysql_select_db($database_sc, $sc);
        $query_Recgg = sprintf("SELECT * FROM $fdsql WHERE c_guser='$xgu'");
        $Recgg = mysql_query($query_Recgg, $sc) or die(mysql_error());
        $row_Recgg = mysql_fetch_assoc($Recgg);
        $totalRows_Recgg = mysql_num_rows($Recgg);
	if ($totalRows_Recgg == 0) {$gw="L";} else {if ($row_Recgg['gtow'] == "L") {$gw="R";} else {$gw="L";}}
	//if ($totalRows_Recgg == 0) {$gw="L";}
	//if ($totalRows_Recgg == 1) {$gw="R";}
		//
		$nyear=$year+1;
		mysql_select_db($database_sc, $sc);
            $query_Recxf = sprintf("SELECT * FROM $fdsql WHERE number = '$c_num' && card='$fdcard' && gtow='$gw'");
            $Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());
            $row_Recxf = mysql_fetch_assoc($Recxf);
            $totalRows_Recxf = mysql_num_rows($Recxf);
		if ($totalRows_Recxf == 0) {
		mysql_select_db($database_sc, $sc);
		$insertCommand13="INSERT INTO $fdsql (name, number, card, c_fuser, c_guser, gtow, year, moom, day, end_y, end_m, end_d, date, time, fnumber) VALUES ('$fname', '$c_num', '$fdcard', '$tt_us', '$xgu', '$gw', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time', '問號變數2?')"; 
		mysql_query($insertCommand13,$sc);}
		//
		$apud_b=20000;$pud_name="贈送福卡";
		mysql_select_db($database_sc, $sc);
    $query_Recpb = sprintf("SELECT * FROM pay_b ORDER BY id DESC");
    $Recpb = mysql_query($query_Recpb, $sc) or die(mysql_error());
    $row_Recpb = mysql_fetch_assoc($Recpb);
    $totalRows_Recpb = mysql_num_rows($Recpb);
    $newpsum=$row_Recpb['psum']+$apud_b;$pat=1;
    mysql_select_db($database_sc, $sc);
    $insertCommand11="INSERT INTO pay_b (pin, psum, number, card, at, date, time, pud_name) VALUES ('$apud_b', '$newpsum', '$c_num', '$fdcard', '$pat', '$date', '$time', '$pud_name')"; 
    mysql_query($insertCommand11,$sc);
		//
		$new_f_tog=0;
		$update11="UPDATE memberdata SET f_tog='$new_f_tog' WHERE number = '$fus'";
        mysql_select_db($database_sc, $sc);
        $Result11 = mysql_query($update11, $sc) or die(mysql_error());
		$re_c=1;
        }
	}
//
if ($re_c == 1) {?><script type="text/javascript">document.location.href="x_g_d.php";</script><? }
if ($re_c == 0) {?>
<script type="text/javascript">document.location.href="/life_link/new_account-3.php?newid=<?php echo $newnr;?>";</script>
<?php exit;?>
<!--
<script type="text/javascript">document.location.href="x_g_c.php";</script>
<?php };exit;?>-->