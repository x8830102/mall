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
$fus=$_SESSION['gfus'];$gus=$_SESSION['ggus'];$card=$_SESSION['gcd'];$pudid=$_SESSION['pudid'];//echo $card;exit;
$tt_q=$_GET['tt_q'];
?>
<div id="divLoading" style="color:red; position:absolute; top:166px; left:703px; width:413px; height:50px;z-order=0">
<img src="../ajax-loader.gif" style="vertical-align:middle;padding:6px"/>
運算資訊中，請勿關閉或動任何行為…，請稍候...
</div>
<?php
//new-p
mysql_select_db($database_kg, $kg);
$query_Reccd = sprintf("SELECT * FROM memberdata WHERE number = '$tt_q' && m_ok=1");
$Reccd = mysql_query($query_Reccd, $kg) or die(mysql_error());
$row_Reccd = mysql_fetch_assoc($Reccd);
$totalRows_Reccd = mysql_num_rows($Reccd);
$ks=$row_Reccd['ks'];
$m_nick=$row_Reccd['m_nick'];
$dgus=$row_Reccd['m_guser3'];
//
mysql_select_db($database_kg, $kg);
$query_Reccd2 = sprintf("SELECT * FROM memberdata WHERE number = '$dgus' && m_ok=1");
$Reccd2 = mysql_query($query_Reccd2, $kg) or die(mysql_error());
$row_Reccd2 = mysql_fetch_assoc($Reccd2);
$totalRows_Reccd2 = mysql_num_rows($Reccd2);
$tt_us=$row_Reccd2['m_guser3'];$tt_a="m_guser3";$tt_a2="gtow3";$tt_b=" && prd3=3";$tt_b2="prd3=3";$tt_b3=" && prd3=3";
//7p-yes
$p_total=0;
mysql_select_db($database_kg, $kg);
$query_Recg = sprintf("SELECT * FROM memberdata WHERE $tt_a = '$tt_us' && m_ok=1 $tt_b");
$Recg = mysql_query($query_Recg, $kg) or die(mysql_error());
$row_Recg = mysql_fetch_assoc($Recg);
$totalRows_Recg = mysql_num_rows($Recg);
if ($totalRows_Recg != 0) {$p_total=$p_total+$totalRows_Recg;
	do {$gusa=$row_Recg['number'];
	mysql_select_db($database_kg, $kg);
    $query_Recg2 = sprintf("SELECT * FROM memberdata WHERE $tt_a = '$gusa' && m_ok=1 $tt_b");
    $Recg2 = mysql_query($query_Recg2, $kg) or die(mysql_error());
    $row_Recg2 = mysql_fetch_assoc($Recg2);
    $totalRows_Recg2 = mysql_num_rows($Recg2);
	if ($totalRows_Recg2 != 0) {$p_total=$p_total+$totalRows_Recg2;}
	} while ($row_Recg = mysql_fetch_assoc($Recg));
	}
if ($p_total == 6) {//升1
	mysql_select_db($database_kg, $kg);
    $query_Rectt = sprintf("SELECT * FROM memberdata WHERE number = '$tt_us' && m_ok=1");
    $Rectt = mysql_query($query_Rectt, $kg) or die(mysql_error());
    $row_Rectt = mysql_fetch_assoc($Rectt);
    $totalRows_Rectt = mysql_num_rows($Rectt);
	$tt_fus=$row_Rectt['m_fuser'];
	$tt_rat=$row_Rectt['rat']+1;
	$tt_card=$row_Rectt['card']."-".$tt_rat;
	//大公排
	$x2=$tt_us;$xa=0;unset($xbu);$xbi=0;$xbj=0;
		while ($xa ==0) {
			mysql_select_db($database_kg, $kg);
            $query_Recx2 = sprintf("SELECT * FROM memberdata WHERE m_guser = '$x2'");
            $Recx2 = mysql_query($query_Recx2, $kg) or die(mysql_error());
            $row_Recx2 = mysql_fetch_assoc($Recx2);
            $totalRows_Recx2 = mysql_num_rows($Recx2);
			if ($totalRows_Recx2 < 2) {$xgu=$x2;$xa=1;} else {do {$xbu[$xbi]=$row_Recx2['number'];$xbi++;} while ($row_Recx2 = mysql_fetch_assoc($Recx2));$x2=$xbu[$xbj];$xbj++;}
			}
		
	//
	mysql_select_db($database_kg, $kg);
        $query_Recgg = sprintf("SELECT * FROM memberdata WHERE m_guser='$xgu'");
        $Recgg = mysql_query($query_Recgg, $kg) or die(mysql_error());
        $row_Recgg = mysql_fetch_assoc($Recgg);
        $totalRows_Recgg = mysql_num_rows($Recgg);
	if ($totalRows_Recgg == 0) {$gw="L";}
	if ($totalRows_Recgg == 1) {$gw="R";}
	//number
	mysql_select_db($database_kg, $kg);$bo="boss";
    $query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");
    $Reci = mysql_query($query_Reci, $kg) or die(mysql_error());
    $row_Reci = mysql_fetch_assoc($Reci);
    $num_box=$row_Reci['num_box'];
    $num_z=$row_Reci['num_z'];
    if(date("m") != $num_z) {
	   $numz=date("m");
	   $update11="UPDATE admin SET num_z=$numz WHERE username='$bo'";
       mysql_select_db($database_kg, $kg);
       $Result11 = mysql_query($update11, $kg) or die(mysql_error());
	   $num_box=1;
	   }
    if ($num_box == 10000) {echo "設定值巳超過9999單號，請洽系統工程師。";exit;}
    if ($num_box < 10) {$number="SN".date("ymd")."000".$num_box;$card=date("ym")."000".$num_box;}
    if ($num_box > 9 && $num_box < 100) {$number="SN".date("ymd")."00".$num_box;$card=date("ym")."00".$num_box;}
    if ($num_box < 1000 && $num_box > 99) {$number="SN".date("ymd")."0".$num_box;$card=date("ym")."0".$num_box;}
	if ($num_box < 10000 && $num_box > 999) {$number="SN".date("ymd").$num_box;$card=date("ym").$num_box;}
	$new_num_box=$num_box+1;
    $update11="UPDATE admin SET num_box=$new_num_box WHERE username='$bo'";
    mysql_select_db($database_kg, $kg);
    $Result11 = mysql_query($update11, $kg) or die(mysql_error());
	//
	$m_nick=$row_Rectt['m_nick'];$m_passwd=$row_Rectt['m_passwd'];$m_passtoo=$row_Rectt['m_passtoo'];$m_fuser=$row_Rectt['m_fuser'];$pudid=$row_Rectt['pudid'];$ks=$row_Rectt['ks'];$m_ok=1;$m_sex=$row_Rectt['m_sex'];
	$m_email=$row_Rectt['m_email'];$note=$row_Rectt['note'];$m_callphone=$row_Rectt['m_callphone'];$prd=1;
	mysql_select_db($database_kg, $kg);
    $insertCommand3="INSERT INTO memberdata (m_nick, card, m_passwd, m_passtoo, number, m_fuser, m_guser, gtow, a_pud, ks, allsum, m_ok, year, moom, day, z, m_sex, m_email, note, m_joinDate, m_callphone, prd, rat, gus, ggtow) VALUES ('$m_nick', '$tt_card', '$m_passwd', '$m_passtoo', '$number', '$fus', '$xgu', '$gw', '$pudid', '$ks', '$ks', '$mok', '$year', '$moom', '$day', '$z', '$m_sex', '$m_email', '$note', '$date', '$m_callphone', '$prd', '$tt_rat', '$xgu', '$gw')"; 
    mysql_query($insertCommand3,$kg);
	$update11="UPDATE memberdata SET rat=$tt_rat WHERE number='$tt_us'";
    mysql_select_db($database_kg, $kg);
    $Result11 = mysql_query($update11, $kg) or die(mysql_error());
	
	
	
	/*
	//公排
	$bw=0;$tt_q=$tt_fus;unset($bus);$bus[0]="";$bi=0;$bki=0;
	while ($bw == 0) {
		mysql_select_db($database_kg, $kg);
        $query_Recgg = sprintf("SELECT * FROM memberdata WHERE $tt_a = '$tt_q' && m_ok=1 $tt_b3");
        $Recgg = mysql_query($query_Recgg, $kg) or die(mysql_error());
        $row_Recgg = mysql_fetch_assoc($Recgg);
        $totalRows_Recgg = mysql_num_rows($Recgg);
		if ($totalRows_Recgg < 2) {
			if ($totalRows_Recgg == 0) {$gw="L";}
			if ($totalRows_Recgg == 1) {$gw="R";}
			
			mysql_select_db($database_kg, $kg);
            $query_Recmm = sprintf("SELECT * FROM memberdata WHERE number='$tt_us'");
            $Recmm = mysql_query($query_Recmm, $kg) or die(mysql_error());
            $row_Recmm = mysql_fetch_assoc($Recmm);
            $totalRows_Recmm = mysql_num_rows($Recmm);
			$rat2=$row_Recmm['$rat']++;
			$update11="UPDATE memberdata SET $tt_b2, $tt_a = '$tt_q', $tt_a2 = '$gw', $rat = $rat2 WHERE number='$tt_us'";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
			*/
			$mlevel=2;
			mysql_select_db($database_kg, $kg);
            $query_Recgg2 = sprintf("SELECT * FROM a_pud WHERE id = $pudid");
            $Recgg2 = mysql_query($query_Recgg2, $kg) or die(mysql_error());
            $row_Recgg2 = mysql_fetch_assoc($Recgg2);
			$mgold=$row_Recgg2['pay3'];
			$mnote="第三局结束后，奖金 = ".$mgold;
			mysql_select_db($database_kg, $kg);
            $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level) VALUES ('$tt_us', '$year', '$moom', '$day', '$z', '$mgold', '$mnote', '$mlevel')"; 
            mysql_query($insertCommand15,$kg);
			//
			$hd=($mgold*0.75)-15;
	mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$tt_us' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']+$hd;
	$mnotex="第三局结束后奖金,扣「商城管理费10%」,扣 「税10%」,扣 「贵金属托管费5%」,扣 「平台系统维护费 15美元」";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cin, csum, note, date, time) VALUES ('$tt_us', '$hd', '$new_h', '$mnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
			//
			$hd2=$row_Recgg2['pay3'];
	mysql_select_db($database_kg, $kg);
    $query_Rech2 = sprintf("SELECT * FROM c_cash WHERE number = '$tt_us' ORDER BY id DESC");
    $Rech2 = mysql_query($query_Rech2, $kg) or die(mysql_error());
    $row_Rech2 = mysql_fetch_assoc($Rech2);
    $totalRows_Rech2 = mysql_num_rows($Rech2);
	$new_h2=$row_Rech2['csum']+$hd2;
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO c_cash (number, cin, csum, note, date, time) VALUES ('$tt_us', '$hd2', '$new_h2', '$mnote', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
			//
	mysql_select_db($database_kg, $kg);
    $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$tt_us' && year=$year && moom=$moom && day=$day");
    $Recs = mysql_query($query_Recs, $kg) or die(mysql_error());
    $row_Recs = mysql_fetch_assoc($Recs);
    $totalRows_Recs = mysql_num_rows($Recs);
	if ($totalRows_Recs == 0) {
		mysql_select_db($database_kg, $kg);
        $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level2) VALUES ('$tt_us', '$year', '$moom', '$day', '$z', '$mgold')"; 
        mysql_query($insertCommand15,$kg);
		} else {
			$new_level1=$row_Recs['level2']+$mgold;
			$update11="UPDATE gold_sum SET level2= $new_level1 WHERE number = '$tt_us' && year=$year && moom=$moom && day=$day";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
			}
//扣回
mysql_select_db($database_kg, $kg);
$query_Recr = sprintf("SELECT * FROM memberdata WHERE number = '$tt_us' && m_ok=1");
$Recr = mysql_query($query_Recr, $kg) or die(mysql_error());
$row_Recr = mysql_fetch_assoc($Recr);
$totalRows_Recr = mysql_num_rows($Recr);
if ($row_Recr['ek'] != 0) {
	if ($row_Recr['ek'] >= $hd) {
		mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$tt_us' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']-$hd;
	$fnotex="回填單奖金扣回";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cout, csum, note, date, time) VALUES ('$tt_us', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	    $new_ek=$row_Recr['ek']-$hd;
			$update11="UPDATE memberdata SET ek=$new_ek WHERE number = '$tt_us'";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
		}
	if ($row_Recr['ek'] < $hd) {
		mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$tt_us' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']-$row_Recr['ek'];
	$fnotex="回填單奖金扣回";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cout, csum, note, date, time) VALUES ('$tt_us', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	    $new_ek=0;
			$update11="UPDATE memberdata SET ek=$new_ek WHERE number = '$tt_us'";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
		}
	}
//p-c
	$pcpin=1000;
mysql_select_db($database_kg, $kg);
$query_Recpc = sprintf("SELECT * FROM pay_c ORDER BY id DESC");
$Recpc = mysql_query($query_Recpc, $kg) or die(mysql_error());
$row_Recpc = mysql_fetch_assoc($Recpc);
$totalRows_Recpc = mysql_num_rows($Recpc);
$newcpsum=$row_Recpc['psum']+$pcpin;
$type_c=1;
mysql_select_db($database_kg, $kg);
$insertCommand13="INSERT INTO pay_c (pin, psum, number, card, at, date, time, year, moom, day, type) VALUES ('$pcpin', '$newcpsum', '$tt_us', '$tt_card', '$pat', '$date', '$time', '$year', '$moom', '$day', '$type_c')"; 
mysql_query($insertCommand13,$kg);
			/*
			$bw=1;
			} else {
				do {$bus[$bi]=$row_Recgg['number'];$bi++;} while ($row_Recgg = mysql_fetch_assoc($Recgg));
				$tt_q=$bus[$bki];$bki++;
				}
		}*/
	}//升1--

?>
<script type="text/javascript">document.location.href="openok.php?newcard=<?php echo $card;?>";</script>
