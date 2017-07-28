<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();//echo "###",$_SESSION['sn'];exit;
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

    <td align="center">進度： 2 / 7</td>

  </tr>

</table>
<?php //echo "f";exit;
//newcard
$fus=$_SESSION['gfus'];$newnr=$_SESSION['newnr'];$pudid=$_SESSION['pudid'];$fdcard=$_SESSION['fdcard'];
mysql_select_db($database_sc, $sc);
$query_Reccd = sprintf("SELECT * FROM memberdata WHERE number = '$newnr' && m_ok=1");
$Reccd = mysql_query($query_Reccd, $sc) or die(mysql_error());
$row_Reccd = mysql_fetch_assoc($Reccd);
$totalRows_Reccd = mysql_num_rows($Reccd);
$ks=$row_Reccd['ks'];
$m_username=$row_Reccd['m_username'];
$phone=$row_Reccd['m_callphone'];
$mmnum=$row_Reccd['number'];//echo $phone;exit;
//

unset($apudg);
    mysql_select_db($database_sc, $sc);
    $query_Recapud = sprintf("SELECT * FROM a_pud WHERE id=$pudid");// 
    $Recapud = mysql_query($query_Recapud, $sc) or die(mysql_error());
    $row_Recapud = mysql_fetch_assoc($Recapud);
	$totalRows_Recapud = mysql_num_rows($Recapud);
	$apud_a1=$row_Recapud['fpay1'];
	$apud_a2=$row_Recapud['fpay2'];
	$apud_b=$row_Recapud['b'];
	$apud_c=$row_Recapud['c'];
	$apud_d=$row_Recapud['d'];
	$apud_e=$row_Recapud['e'];
	$apud_f=$row_Recapud['f'];
	$apudg[1]=$row_Recapud['fpay1'];
	$apudg[2]=$row_Recapud['fpay2'];
//gold-f
$fzus=$fus;$glevel=1;$at=0;
$fti=2;$ftf=1;$fj=1;
while ($fti != 0) {
	mysql_select_db($database_sc, $sc);
    $query_Recft = sprintf("SELECT * FROM memberdata WHERE number='$fzus'");// 
    $Recft = mysql_query($query_Recft, $sc) or die(mysql_error());
    $row_Recft = mysql_fetch_assoc($Recft);
	$totalRows_Recft = mysql_num_rows($Recft);
    $ft_apud=$row_Recft['a_pud'];
	if ($ft_apud > $ftf) {
		//allsum
		$new_allsum=$row_Recft['allsum']+$apudg[$fj];
		$update11="UPDATE memberdata SET allsum=$new_allsum WHERE number = '$fzus'";
        mysql_select_db($database_sc, $sc);
        $Result11 = mysql_query($update11, $sc) or die(mysql_error());
		//goldf
        /*
		$gold_f=$apudg[$fj];
	    $fnote="新單註冊(".$row_Recapud['name']."),<br/> 帳號：".$m_username;
	    $sncode=$fzus."-".date("ymdhis");
	    mysql_select_db($database_sc, $sc);
        $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fzus', '$year', '$moom', '$day', '$z', '$gold_f', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
        mysql_query($insertCommand15,$sc);*/
	    //
	mysql_select_db($database_sc, $sc);
    $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$fzus' && year=$year && moom=$moom && day=$day");
    $Recs = mysql_query($query_Recs, $sc) or die(mysql_error());
    $row_Recs = mysql_fetch_assoc($Recs);
    $totalRows_Recs = mysql_num_rows($Recs);
    if ($totalRows_Recs == 0) {
        mysql_select_db($database_sc, $sc);
        $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level1) VALUES ('$fzus', '$year', '$moom', '$day', '$z', '$gold_f')"; 
        mysql_query($insertCommand15,$sc);
        } else {
	        $new_level1=$row_Recs['level1']+$gold_f;
	        $update11="UPDATE gold_sum SET level1= $new_level1 WHERE number = '$fzus' && year=$year && moom=$moom && day=$day";
            mysql_select_db($database_sc, $sc);
            $Result11 = mysql_query($update11, $sc) or die(mysql_error());
	        }
		//
		///////////////發$
        /*$hd=$gold_f*0.2;
	        mysql_select_db($database_sc, $sc);
            $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$fzus' ORDER BY id DESC");
            $Rech = mysql_query($query_Rech, $sc) or die(mysql_error());
            $row_Rech = mysql_fetch_assoc($Rech);
            $totalRows_Rech = mysql_num_rows($Rech);
	        $new_h=$row_Rech['csum']+$hd;
	        $fnotex="新單註冊(".$row_Recapud['name']."),<br/> 帳號：".$m_username;
	        mysql_select_db($database_sc, $sc);
            $insertCommand15="INSERT INTO g_cash (number, cin, csum, note, date, time, sncode) VALUES ('$fzus', '$hd', '$new_h', '$fnotex', '$date', '$time', '$sncode')"; 
            mysql_query($insertCommand15,$sc);
        $hd=$gold_f*0.8;
	        mysql_select_db($database_sc, $sc);
            $query_Rech = sprintf("SELECT * FROM c_cash WHERE number = '$fzus' ORDER BY id DESC");
            $Rech = mysql_query($query_Rech, $sc) or die(mysql_error());
            $row_Rech = mysql_fetch_assoc($Rech);
            $totalRows_Rech = mysql_num_rows($Rech);
	        $new_h=$row_Rech['csum']+$hd;
	        $fnotex="新單註冊(".$row_Recapud['name']."),<br/> 帳號：".$m_username;
	        mysql_select_db($database_sc, $sc);
            $insertCommand15="INSERT INTO c_cash (number, cin, csum, note, date, time, sncode) VALUES ('$fzus', '$hd', '$new_h', '$fnotex', '$date', '$time', '$sncode')"; 
            mysql_query($insertCommand15,$sc);
		*/
		$fj++;$fti--;
		}
	$ftf=$ft_apud;
	if ($row_Recft['m_fuser'] == ""){break;} else {$fzus=$row_Recft['m_fuser'];}
	}
//echo "f@!@";exit;
///////
?>
<script type="text/javascript">document.location.href="x_g_a2.php";</script>
<?php exit;?>
