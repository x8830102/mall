<?php require_once('Connections/kg.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;}
$mem_number=$_SESSION['number'];
mysql_select_db($database_kg, $kg);
$query_Recmem = sprintf("SELECT * FROM memberdata WHERE number = '$mem_number' && m_ok=1");
$Recmem = mysql_query($query_Recmem, $kg) or die(mysql_error());
$row_Recmem = mysql_fetch_assoc($Recmem);
$totalRows_Recmem = mysql_num_rows($Recmem);
if ($totalRows_Recmem == 0) {header(sprintf("Location: login_mem.php"));exit;}
$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");
?>
<div id="divLoading" style="color:red; position:absolute; top:166px; left:703px; width:413px; height:50px;z-order=0">
<img src="../ajax-loader.gif" style="vertical-align:middle;padding:6px"/>
運算資訊中，請勿關閉或動任何行為…，請稍候...
</div>
<?php
//
$fus=$_SESSION['gfus'];$gus=$_SESSION['ggus'];$card=$_SESSION['gcd'];$pudid=$_SESSION['pudid'];//echo $card;exit;
mysql_select_db($database_kg, $kg);
$query_Reccd = sprintf("SELECT * FROM memberdata WHERE number = '$fus' && m_ok=1");
$Reccd = mysql_query($query_Reccd, $kg) or die(mysql_error());
$row_Reccd = mysql_fetch_assoc($Reccd);
$totalRows_Reccd = mysql_num_rows($Reccd);
$ks=$row_Reccd['ks'];
$m_nick=$row_Reccd['m_nick'];
$m_callphone=$row_Reccd['m_callphone'];
//7m-2
mysql_select_db($database_kg, $kg);
        $query_Reccd5 = sprintf("SELECT * FROM 7m WHERE callphone = '$m_callphone' && gv=2");
        $Reccd5 = mysql_query($query_Reccd5, $kg) or die(mysql_error());
        $row_Reccd5 = mysql_fetch_assoc($Reccd5);
        $totalRows_Reccd5 = mysql_num_rows($Reccd5);
//首月，同一星期內直推三個人
mysql_select_db($database_kg, $kg);
$query_Reccd2 = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$fus' && m_ok=1");
$Reccd2 = mysql_query($query_Reccd2, $kg) or die(mysql_error());
$row_Reccd2 = mysql_fetch_assoc($Reccd2);
$totalRows_Reccd2 = mysql_num_rows($Reccd2);
unset($au);$aui=0;
do {if (in_array($row_Reccd2['number'],$au) == false) {$au[$aui]=$row_Reccd2['number'];$aui++;}
	} while ($row_Reccd2 = mysql_fetch_assoc($Reccd2));
//1
$sz=$row_Reccd['z'];
if (($sz+7) > 365) {$dz2=($sz+7)-365;} else {$dz=$sz+7;}
$s_total=0;
for ($aj=0;$aj < count($au);$aj++) {
	$aju=$au[$aj];
	mysql_select_db($database_kg, $kg);
    $query_Reccd3 = sprintf("SELECT * FROM memberdata WHERE number = '$aju' && m_ok=1");
    $Reccd3 = mysql_query($query_Reccd3, $kg) or die(mysql_error());
    $row_Reccd3 = mysql_fetch_assoc($Reccd3);
    $totalRows_Reccd3 = mysql_num_rows($Reccd3);
	if (($sz+7) > 365) {
		if ($row_Reccd3['z'] <= $dz2 && $row_Reccd3['z'] >= 1) {$s_total++;}
		} else {
			if ($row_Reccd3['z'] <= $dz && $row_Reccd3['z'] >= $sz) {$s_total++;}
			}
	}
if ($s_total >= 3 && $totalRows_Reccd5 < 888) {
	    	$gv=2;
			mysql_select_db($database_kg, $kg);
            $insertCommand15="INSERT INTO 7m (callphone, gv) VALUES ('$m_callphone', '$gv')"; 
            mysql_query($insertCommand15,$kg);
	}
//2
$sz_2=$row_Reccd['z']+7;
if (($sz_2+7) > 365) {$dz2=($sz_2+7)-365;} else {$dz=$sz_2+7;}
$s_total=0;
for ($aj=0;$aj < count($au);$aj++) {
	$aju=$au[$aj];
	mysql_select_db($database_kg, $kg);
    $query_Reccd3 = sprintf("SELECT * FROM memberdata WHERE number = '$aju' && m_ok=1");
    $Reccd3 = mysql_query($query_Reccd3, $kg) or die(mysql_error());
    $row_Reccd3 = mysql_fetch_assoc($Reccd3);
    $totalRows_Reccd3 = mysql_num_rows($Reccd3);
	if (($sz+7) > 365) {
		if ($row_Reccd3['z'] <= $dz2 && $row_Reccd3['z'] >= 1) {$s_total++;}
		} else {
			if ($row_Reccd3['z'] <= $dz && $row_Reccd3['z'] >= $sz_2) {$s_total++;}
			}
	}
if ($s_total >= 3 && $totalRows_Reccd5 < 888) {
	    	$gv=2;
			mysql_select_db($database_kg, $kg);
            $insertCommand15="INSERT INTO 7m (callphone, gv) VALUES ('$m_callphone', '$gv')"; 
            mysql_query($insertCommand15,$kg);
	}
//3
$sz_3=$row_Reccd['z']+14;
if (($sz_3+7) > 365) {$dz2=($sz_3+7)-365;} else {$dz=$sz_3+7;}
$s_total=0;
for ($aj=0;$aj < count($au);$aj++) {
	$aju=$au[$aj];
	mysql_select_db($database_kg, $kg);
    $query_Reccd3 = sprintf("SELECT * FROM memberdata WHERE number = '$aju' && m_ok=1");
    $Reccd3 = mysql_query($query_Reccd3, $kg) or die(mysql_error());
    $row_Reccd3 = mysql_fetch_assoc($Reccd3);
    $totalRows_Reccd3 = mysql_num_rows($Reccd3);
	if (($sz+7) > 365) {
		if ($row_Reccd3['z'] <= $dz2 && $row_Reccd3['z'] >= 1) {$s_total++;}
		} else {
			if ($row_Reccd3['z'] <= $dz && $row_Reccd3['z'] >= $sz_3) {$s_total++;}
			}
	}
if ($s_total >= 3 && $totalRows_Reccd5 < 888) {
	    	$gv=2;
			mysql_select_db($database_kg, $kg);
            $insertCommand15="INSERT INTO 7m (callphone, gv) VALUES ('$m_callphone', '$gv')"; 
            mysql_query($insertCommand15,$kg);
	}
//4
$sz_4=$row_Reccd['z']+21;
if (($sz_4+7) > 365) {$dz2=($sz_4+7)-365;} else {$dz=$sz_4+7;}
$s_total=0;
for ($aj=0;$aj < count($au);$aj++) {
	$aju=$au[$aj];
	mysql_select_db($database_kg, $kg);
    $query_Reccd3 = sprintf("SELECT * FROM memberdata WHERE number = '$aju' && m_ok=1");
    $Reccd3 = mysql_query($query_Reccd3, $kg) or die(mysql_error());
    $row_Reccd3 = mysql_fetch_assoc($Reccd3);
    $totalRows_Reccd3 = mysql_num_rows($Reccd3);
	if (($sz+7) > 365) {
		if ($row_Reccd3['z'] <= $dz2 && $row_Reccd3['z'] >= 1) {$s_total++;}
		} else {
			if ($row_Reccd3['z'] <= $dz && $row_Reccd3['z'] >= $sz_4) {$s_total++;}
			}
	}
if ($s_total >= 3 && $totalRows_Reccd5 < 888) {
	    	$gv=2;
			mysql_select_db($database_kg, $kg);
            $insertCommand15="INSERT INTO 7m (callphone, gv) VALUES ('$m_callphone', '$gv')"; 
            mysql_query($insertCommand15,$kg);
	}

//--
?>
<script type="text/javascript">document.location.href="x_g_a.php";</script>
