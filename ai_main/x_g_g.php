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
$query_Reccd = sprintf("SELECT * FROM memberdata WHERE card = '$card' && m_ok=1");
$Reccd = mysql_query($query_Reccd, $kg) or die(mysql_error());
$row_Reccd = mysql_fetch_assoc($Reccd);
$totalRows_Reccd = mysql_num_rows($Reccd);
$ks=$row_Reccd['ks'];
$m_nick=$row_Reccd['m_nick'];
$m_callphone=$row_Reccd['m_callphone'];
$sz=$row_Reccd['z'];
if (($sz+30) > 365) {$dz2=($sz+30)-365;} else {$dz=$sz+30;}
//同日同一人名下購買七張新單
mysql_select_db($database_kg, $kg);
$query_Reccd2 = sprintf("SELECT * FROM memberdata WHERE m_callphone = '$m_callphone' && m_ok=1");
$Reccd2 = mysql_query($query_Reccd2, $kg) or die(mysql_error());
$row_Reccd2 = mysql_fetch_assoc($Reccd2);
$totalRows_Reccd2 = mysql_num_rows($Reccd2);
unset($au);$aui=0;
do {if (($row_Reccd2['z']+30) > 365) {
	if (($row_Reccd2['z']+30-365) <= $dz2) {
		if (in_array($row_Reccd2['z'],$au) == false) {$au[$aui]=$row_Reccd2['z'];$aui++;}
		}
	} else {
		if ($row_Reccd2['z'] <= $dz) {
			if (in_array($row_Reccd2['z'],$au) == false) {$au[$aui]=$row_Reccd2['z'];$aui++;}
			}
		}
	} while ($row_Reccd2 = mysql_fetch_assoc($Reccd2));
//
for ($aj=0;$aj < count($au);$aj++) {
	$aju=$au[$aj];
	mysql_select_db($database_kg, $kg);
    $query_Reccd3 = sprintf("SELECT * FROM memberdata WHERE m_callphone = '$m_callphone' && m_ok=1 && z=$aju");
    $Reccd3 = mysql_query($query_Reccd3, $kg) or die(mysql_error());
    $row_Reccd3 = mysql_fetch_assoc($Reccd3);
    $totalRows_Reccd3 = mysql_num_rows($Reccd3);
	if ($totalRows_Reccd3 >= 7) {
		mysql_select_db($database_kg, $kg);
        $query_Reccd4 = sprintf("SELECT * FROM 7m WHERE callphone = '$m_callphone' && gv=1");
        $Reccd4 = mysql_query($query_Reccd4, $kg) or die(mysql_error());
        $row_Reccd4 = mysql_fetch_assoc($Reccd4);
        $totalRows_Reccd4 = mysql_num_rows($Reccd4);
		if ($totalRows_Reccd4 == 0) {
			$gv=1;
			mysql_select_db($database_kg, $kg);
            $insertCommand15="INSERT INTO 7m (callphone, gv) VALUES ('$m_callphone', '$gv')"; 
            mysql_query($insertCommand15,$kg);
			}
		}
	}
//--
?>
<script type="text/javascript">document.location.href="x_g_h.php";</script>
