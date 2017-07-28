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
//業績分紅
//v1
$fa=0;$fb=$gus;
while ($fa ==0) {
	mysql_select_db($database_kg, $kg);
    $query_Recfmem = sprintf("SELECT * FROM memberdata WHERE number='$fb'");// 
    $Recfmem = mysql_query($query_Recfmem, $kg) or die(mysql_error());
    $row_Recfmem = mysql_fetch_assoc($Recfmem);
	$new_gv=$row_Recfmem['gv']++;
	$update11="UPDATE memberdata SET gv=$new_gv WHERE number = '$fb'";
    mysql_select_db($database_kg, $kg);
    $Result11 = mysql_query($update11, $kg) or die(mysql_error());
	if ($new_gv == 88) {
		$gold_vk=(1000*88)*0.01;
		//
		$glevel=4;
		$fnote="業績分紅 1%奖金";
	    mysql_select_db($database_kg, $kg);
        $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level) VALUES ('$fb', '$year', '$moom', '$day', '$z', '$gold_fk', '$fnote', '$glevel')"; 
        mysql_query($insertCommand15,$kg);
		//
		$hd=$gold_vk*0.75;
	mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$fb' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']+$hd;
	$fnotex="業績分紅 1%奖金,扣「商城管理费10%」,扣 「税10%」,扣 「贵金属托管费5%」";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cin, csum, note, date, time) VALUES ('$fb', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
		//
	$hd2=$gold_f;
	mysql_select_db($database_kg, $kg);
    $query_Rech2 = sprintf("SELECT * FROM c_cash WHERE number = '$fb' ORDER BY id DESC");
    $Rech2 = mysql_query($query_Rech2, $kg) or die(mysql_error());
    $row_Rech2 = mysql_fetch_assoc($Rech2);
    $totalRows_Rech2 = mysql_num_rows($Rech2);
	$new_h2=$row_Rech2['csum']+$hd2;
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO c_cash (number, cin, csum, note, date, time) VALUES ('$fb', '$hd2', '$new_h2', '$mnote', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
		//
		mysql_select_db($database_kg, $kg);
        $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$fb' && year=$year && moom=$moom && day=$day");
        $Recs = mysql_query($query_Recs, $kg) or die(mysql_error());
        $row_Recs = mysql_fetch_assoc($Recs);
        $totalRows_Recs = mysql_num_rows($Recs);
	    if ($totalRows_Recs == 0) {
		    mysql_select_db($database_kg, $kg);
            $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level4) VALUES ('$fb', '$year', '$moom', '$day', '$z', '$gold_vk')"; 
            mysql_query($insertCommand15,$kg);
		    } else {
			  $new_level4=$row_Recs['level4']+$gold_vk;
			  $update11="UPDATE gold_sum SET level4= $new_level4 WHERE number = '$fb' && year=$year && moom=$moom && day=$day";
              mysql_select_db($database_kg, $kg);
              $Result11 = mysql_query($update11, $kg) or die(mysql_error());
			  }
		}
	if ($new_gv == 228) {
		$gold_vk=(1000*228)*0.02;
		//
		$glevel=4;
		$fnote="業績分紅-2%奖金";
	    mysql_select_db($database_kg, $kg);
        $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level) VALUES ('$fb', '$year', '$moom', '$day', '$z', '$gold_fk', '$fnote', '$glevel')"; 
        mysql_query($insertCommand15,$kg);
		//
		$hd=$gold_vk*0.75;
	mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$fb' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']+$hd;
	$fnotex="業績分紅 1%奖金,扣「商城管理费10%」,扣 「税10%」,扣 「贵金属托管费5%」";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cin, csum, note, date, time) VALUES ('$fb', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
		//
		mysql_select_db($database_kg, $kg);
        $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$fb' && year=$year && moom=$moom && day=$day");
        $Recs = mysql_query($query_Recs, $kg) or die(mysql_error());
        $row_Recs = mysql_fetch_assoc($Recs);
        $totalRows_Recs = mysql_num_rows($Recs);
	    if ($totalRows_Recs == 0) {
		    mysql_select_db($database_kg, $kg);
            $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level4) VALUES ('$fb', '$year', '$moom', '$day', '$z', '$gold_vk')"; 
            mysql_query($insertCommand15,$kg);
		    } else {
			  $new_level4=$row_Recs['level4']+$gold_vk;
			  $update11="UPDATE gold_sum SET level4= $new_level4 WHERE number = '$fb' && year=$year && moom=$moom && day=$day";
              mysql_select_db($database_kg, $kg);
              $Result11 = mysql_query($update11, $kg) or die(mysql_error());
			  }
		}
	if ($new_gv == 338) {
		$gold_vk=(1000*338)*0.03;
		//
		$glevel=4;
		$fnote="業績分紅-3%奖金";
	    mysql_select_db($database_kg, $kg);
        $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level) VALUES ('$fb', '$year', '$moom', '$day', '$z', '$gold_fk', '$fnote', '$glevel')"; 
        mysql_query($insertCommand15,$kg);
		//
		$hd=$gold_vk*0.75;
	mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$fb' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']+$hd;
	$fnotex="業績分紅 1%奖金,扣「商城管理费10%」,扣 「税10%」,扣 「贵金属托管费5%」";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cin, csum, note, date, time) VALUES ('$fb', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	//
	$hd2=$gold_vk;
	mysql_select_db($database_kg, $kg);
    $query_Rech2 = sprintf("SELECT * FROM c_cash WHERE number = '$fb' ORDER BY id DESC");
    $Rech2 = mysql_query($query_Rech2, $kg) or die(mysql_error());
    $row_Rech2 = mysql_fetch_assoc($Rech2);
    $totalRows_Rech2 = mysql_num_rows($Rech2);
	$new_h2=$row_Rech2['csum']+$hd2;
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO c_cash (number, cin, csum, note, date, time) VALUES ('$fb', '$hd2', '$new_h2', '$mnote', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
		//
		mysql_select_db($database_kg, $kg);
        $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$fb' && year=$year && moom=$moom && day=$day");
        $Recs = mysql_query($query_Recs, $kg) or die(mysql_error());
        $row_Recs = mysql_fetch_assoc($Recs);
        $totalRows_Recs = mysql_num_rows($Recs);
	    if ($totalRows_Recs == 0) {
		    mysql_select_db($database_kg, $kg);
            $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level4) VALUES ('$fb', '$year', '$moom', '$day', '$z', '$gold_vk')"; 
            mysql_query($insertCommand15,$kg);
		    } else {
			  $new_level4=$row_Recs['level4']+$gold_vk;
			  $update11="UPDATE gold_sum SET level4= $new_level4 WHERE number = '$fb' && year=$year && moom=$moom && day=$day";
              mysql_select_db($database_kg, $kg);
              $Result11 = mysql_query($update11, $kg) or die(mysql_error());
			  }
		}
	$fb=$row_Recfmem['m_guser'];
	if ($fb == "x") {$fa=1;}
	}
//
//扣回
mysql_select_db($database_kg, $kg);
$query_Recr = sprintf("SELECT * FROM memberdata WHERE number = '$fb' && m_ok=1");
$Recr = mysql_query($query_Recr, $kg) or die(mysql_error());
$row_Recr = mysql_fetch_assoc($Recr);
$totalRows_Recr = mysql_num_rows($Recr);
if ($row_Recr['ek'] != 0) {
	if ($row_Recr['ek'] >= $hd) {
		mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$fb' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']-$hd;
	$fnotex="回填單奖金扣回";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cout, csum, note, date, time) VALUES ('$fb', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	   // if ($row_Reccd['ks'] == 0) {
			$new_ek=$row_Recr['ek']-$hd;
			$update11="UPDATE memberdata SET ek=$new_ek WHERE number = '$fb'";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
		    //}
		}
	if ($row_Recr['ek'] < $hd) {
		mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$fb' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']-$row_Recr['ek'];//if ($row_Reccd['ks'] == 0) {$new_h=$row_Rech['csum']-$row_Recr['ek'];} else {$new_h=$row_Rech['csum']-$hd;}//
	$fnotex="回填單奖金扣回";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cout, csum, note, date, time) VALUES ('$fb', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	  //  if ($row_Reccd['ks'] == 0) {
			$new_ek=0;
			$update11="UPDATE memberdata SET ek=$new_ek WHERE number = '$fb'";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
		   // }
		}
	}
//--
?>
<script type="text/javascript">document.location.href="x_g_g.php";</script>
