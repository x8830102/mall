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
//領導獎
//v1
$fa=0;$fb=$fus;
while ($fa ==0) {
	mysql_select_db($database_kg, $kg);
    $query_Recfmem = sprintf("SELECT * FROM memberdata WHERE number='$fb'");// 
    $Recfmem = mysql_query($query_Recfmem, $kg) or die(mysql_error());
    $row_Recfmem = mysql_fetch_assoc($Recfmem);
	$new_fv=$row_Recfmem['fv']++;
	$update11="UPDATE memberdata SET fv=$new_fv WHERE number = '$fb'";
    mysql_select_db($database_kg, $kg);
    $Result11 = mysql_query($update11, $kg) or die(mysql_error());
	$fb=$row_Recfmem['m_fuser'];
	if ($fb == "x") {$fa=1;}
	}
//v2
mysql_select_db($database_kg, $kg);
$query_Rech = sprintf("SELECT * FROM memberdata WHERE m_ok=1 ORDER BY m_id");// DESC
$Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
$row_Rech = mysql_fetch_assoc($Rech);
$totalRows_Rech = mysql_num_rows($Rech);
do {if ($row_Rech['fv'] >= 28) {
	$vus=$row_Rech['number'];
	$fk=($row_Rech['fk']+1)*4;
	//sum-v
	$vus2=$vus;unset($vuu);$ui=0;
	mysql_select_db($database_kg, $kg);
    $query_Recv = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$vus2' && m_ok=1");
    $Recv = mysql_query($query_Recv, $kg) or die(mysql_error());
    $row_Recv = mysql_fetch_assoc($Recv);
    $totalRows_Recv = mysql_num_rows($Recv);
	if ($totalRows_Recv != 0) {
		do {$vuu[$ui] = $row_Recv['number'];$ui++;} while ($row_Recv = mysql_fetch_assoc($Recv));
		}
	$uj=0;$vus2=$vuu[$uj];
	while ($vus2 != "") {
		mysql_select_db($database_kg, $kg);
        $query_Recv = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$vus2' && m_ok=1");
        $Recv = mysql_query($query_Recv, $kg) or die(mysql_error());
        $row_Recv = mysql_fetch_assoc($Recv);
        $totalRows_Recv = mysql_num_rows($Recv);
		if ($totalRows_Recv != 0) {do {$vuu[$ui] = $row_Recv['number'];$ui++;} while ($row_Recv = mysql_fetch_assoc($Recv));}
		$uj++;
		$vus2=$vuu[$uj];
		}
	//
	$fk_total=0;
	for ($uk=0;$uk < count($vuu);$uk++) {
		$vus3=$vuu[$uk];
		mysql_select_db($database_kg, $kg);
        $query_Reck = sprintf("SELECT * FROM memberdata WHERE number='$vus3'");// DESC
        $Reck = mysql_query($query_Reck, $kg) or die(mysql_error());
        $row_Reck = mysql_fetch_assoc($Reck);
        $totalRows_Reck = mysql_num_rows($Reck);
		if ($row_Reck['prd'] >= 2) {$fk_total++;}
		}
	//ok
	$gold_fk=($row_Rech['fk']*20)+180;
	if ($gold_fk > 580) {$gold_fk=580;}
	if ($fk_total >= $fk) {
		//
		$new_fk=$row_Rech['fk']++;
		$update11="UPDATE memberdata SET fk=$new_fk WHERE number = '$vus'";
        mysql_select_db($database_kg, $kg);
        $Result11 = mysql_query($update11, $kg) or die(mysql_error());
		//
		$glevel=3;
		$fnote="領導獎-奖金";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level) VALUES ('$vus', '$year', '$moom', '$day', '$z', '$gold_fk', '$fnote', '$glevel')"; 
    mysql_query($insertCommand15,$kg);
		//
		$hd=$gold_fk*0.75;
	mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$vus' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']+$hd;
	$fnotex="領導獎-奖金,扣「商城管理费10%」,扣 「税10%」,扣 「贵金属托管费5%」";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cin, csum, note, date, time) VALUES ('$vus', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	//
	$hd2=$gold_fk;
	mysql_select_db($database_kg, $kg);
    $query_Rech2 = sprintf("SELECT * FROM c_cash WHERE number = '$vus' ORDER BY id DESC");
    $Rech2 = mysql_query($query_Rech2, $kg) or die(mysql_error());
    $row_Rech2 = mysql_fetch_assoc($Rech2);
    $totalRows_Rech2 = mysql_num_rows($Rech2);
	$new_h2=$row_Rech2['csum']+$hd2;
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO c_cash (number, cin, csum, note, date, time) VALUES ('$vus', '$hd2', '$new_h2', '$mnote', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
		//
		mysql_select_db($database_kg, $kg);
    $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$vus' && year=$year && moom=$moom && day=$day");
    $Recs = mysql_query($query_Recs, $kg) or die(mysql_error());
    $row_Recs = mysql_fetch_assoc($Recs);
    $totalRows_Recs = mysql_num_rows($Recs);
	if ($totalRows_Recs == 0) {
		mysql_select_db($database_kg, $kg);
        $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level3) VALUES ('$vus', '$year', '$moom', '$day', '$z', '$gold_fk')"; 
        mysql_query($insertCommand15,$kg);
		} else {
			$new_level3=$row_Recs['level3']+$gold_fk;
			$update11="UPDATE gold_sum SET level3= $new_level3 WHERE number = '$vus' && year=$year && moom=$moom && day=$day";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
			}
		}
	}
	} while ($row_Rech = mysql_fetch_assoc($Rech));
//
//扣回
mysql_select_db($database_kg, $kg);
$query_Recr = sprintf("SELECT * FROM memberdata WHERE number = '$vus' && m_ok=1");
$Recr = mysql_query($query_Recr, $kg) or die(mysql_error());
$row_Recr = mysql_fetch_assoc($Recr);
$totalRows_Recr = mysql_num_rows($Recr);
if ($row_Recr['ek'] != 0) {
	if ($row_Recr['ek'] >= $hd) {
		mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$vus' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']-$hd;
	$fnotex="回填單奖金扣回";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cout, csum, note, date, time) VALUES ('$vus', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	    //if ($row_Reccd['ks'] == 0) {
		    $new_ek=$row_Recr['ek']-$hd;
			$update11="UPDATE memberdata SET ek=$new_ek WHERE number = '$vus'";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
		    //}
		}
	if ($row_Recr['ek'] < $hd) {
		mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$vus' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']-$row_Recr['ek'];//if ($row_Reccd['ks'] == 0) {$new_h=$row_Rech['csum']-$row_Recr['ek'];} else {$new_h=$row_Rech['csum']-$hd;}//
	$fnotex="回填單奖金扣回";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cout, csum, note, date, time) VALUES ('$vus', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	    //if ($row_Reccd['ks'] == 0) {
			$new_ek=0;
			$update11="UPDATE memberdata SET ek=$new_ek WHERE number = '$vus'";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
		    //}
		}
	}
//--
?>
<script type="text/javascript">document.location.href="x_g_e.php";</script>
