<?php require_once('Connections/sc.php'); ?>

<?php 

mysql_query("set names utf8");

session_start();

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

$fus=$_SESSION['gfus'];$newnr=$_SESSION['newnr'];$pudid=$_SESSION['pudid'];$vfdcard=$_SESSION['fdcard'];

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
<?php //echo "a-f",$pudid;exit;

if ($pudid < 6) {$fdsql="fd";$pcpin=15000;$pcpout=30000;}if ($pudid >= 6) {$fdsql="fd2";$pcpin=150000;$pcpout=300000;}

mysql_select_db($database_sc, $sc);

        $query_Reccd2 = sprintf("SELECT * FROM $fdsql WHERE card = '$vfdcard'");

        $Reccd2 = mysql_query($query_Reccd2, $sc) or die(mysql_error());

        $row_Reccd2 = mysql_fetch_assoc($Reccd2);

        $totalRows_Reccd2 = mysql_num_rows($Reccd2);

$fnumber=$row_Reccd2['number'];//echo "###",$fnumber;

mysql_select_db($database_sc, $sc);

    $query_Recob2 = sprintf("SELECT * FROM memberdata WHERE number='$fnumber'");// 

    $Recob2 = mysql_query($query_Recob2, $sc) or die(mysql_error());

    $row_Recob2 = mysql_fetch_assoc($Recob2);

	$totalRows_Recob2 = mysql_num_rows($Recob2);

$m_nick=$row_Recob2['m_nick'];

mysql_select_db($database_sc, $sc);

    $query_Recapud = sprintf("SELECT * FROM a_pud WHERE id='$pudid'");// 

    $Recapud = mysql_query($query_Recapud, $sc) or die(mysql_error());

    $row_Recapud = mysql_fetch_assoc($Recapud);

	$totalRows_Recapud = mysql_num_rows($Recapud);

$my_fpay=$row_Recapud['my_fpay'];

$my_p=$row_Recapud['my_p'];

$apud_a1=$row_Recapud['fpay1'];

	$apud_a2=$row_Recapud['fpay2'];

	$apud_a=$row_Recapud['p'];

	$apud_b=$row_Recapud['b'];

	$apud_c=$row_Recapud['c'];

	$apud_d=$row_Recapud['d'];

	$apud_e=$row_Recapud['e'];

	$apud_f=$row_Recapud['f'];

//

if ($pudid == 7) {

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

    $update11="UPDATE admin SET fd_box=$new_num_box' WHERE username='$bo'";

    mysql_select_db($database_sc, $sc);

    $Result11 = mysql_query($update11, $sc) or die(mysql_error());

	//公排

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

$insertCommand13="INSERT INTO fd2 (number, card, name, c_fuser, c_guser, gtow, year, moom, day, end_y, end_m, end_d, date, time) VALUES ('$fnumber', '$fdcard', '$m_nick', '$mfdcard', '$xgu', '$gw', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time')"; 

mysql_query($insertCommand13,$sc);

		}

	//gold

	$gold_f=$my_fpay;

	$glevel=2;$at=0;

		$sncode=$fus."-".date("ymdhis");

		$fnote="關係寶物獎勵(".$fdcard.")";

	mysql_select_db($database_sc, $sc);

    $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fus', '$year', '$moom', '$day', '$z', '$gold_f', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 

    mysql_query($insertCommand15,$sc);

	    mysql_select_db($database_sc, $sc);

    $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$fus' && year=$year && moom=$moom && day=$day");

    $Recs = mysql_query($query_Recs, $sc) or die(mysql_error());

    $row_Recs = mysql_fetch_assoc($Recs);

    $totalRows_Recs = mysql_num_rows($Recs);

    if ($totalRows_Recs == 0) {

        mysql_select_db($database_sc, $sc);

        $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level2) VALUES ('$fus', '$year', '$moom', '$day', '$z', '$gold_f')"; 

        mysql_query($insertCommand15,$sc);

        } else {

	        $new_level2=$row_Recs['level2']+$gold_f;

	        $update11="UPDATE gold_sum SET level2= $new_level2 WHERE number = '$fus' && year=$year && moom=$moom && day=$day";

            mysql_select_db($database_sc, $sc);

            $Result11 = mysql_query($update11, $sc) or die(mysql_error());

	        }

		    /*$hd=$gold_f*0.2;

	        mysql_select_db($database_sc, $sc);

            $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$fus' ORDER BY id DESC");

            $Rech = mysql_query($query_Rech, $sc) or die(mysql_error());

            $row_Rech = mysql_fetch_assoc($Rech);

            $totalRows_Rech = mysql_num_rows($Rech);

	        $new_h=$row_Rech['csum']+$hd;

	        $fnotex="關係寶物獎勵(".$fdcard.")";

	        mysql_select_db($database_sc, $sc);

            $insertCommand15="INSERT INTO g_cash (number, cin, csum, note, date, time, sncode) VALUES ('$fus', '$hd', '$new_h', '$fnotex', '$date', '$time', '$sncode')"; 

            mysql_query($insertCommand15,$sc);

			$hd=$gold_f*0.8;

	        mysql_select_db($database_sc, $sc);

            $query_Rech = sprintf("SELECT * FROM c_cash WHERE number = '$my_fuser' ORDER BY id DESC");

            $Rech = mysql_query($query_Rech, $sc) or die(mysql_error());

            $row_Rech = mysql_fetch_assoc($Rech);

            $totalRows_Rech = mysql_num_rows($Rech);

	        $new_h=$row_Rech['csum']+$hd;

	        $fnotex="關係寶物獎勵(".$fdcard.")";

	        mysql_select_db($database_sc, $sc);

            $insertCommand15="INSERT INTO c_cash (number, cin, csum, note, date, time, sncode) VALUES ('$fus', '$hd', '$new_h', '$fnotex', '$date', '$time', '$sncode')"; 

            mysql_query($insertCommand15,$sc);*/

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

	//p-f公司收款	

	mysql_select_db($database_sc, $sc);

    $query_Recpf = sprintf("SELECT * FROM pay_f ORDER BY id DESC");

    $Recpf = mysql_query($query_Recpf, $sc) or die(mysql_error());

    $row_Recpf = mysql_fetch_assoc($Recpf);

    $totalRows_Recpf = mysql_num_rows($Recpf);

    $newpsum=$row_Recpf['psum']+$apud_f;$pat=1;

    mysql_select_db($database_sc, $sc);

    $insertCommand11="INSERT INTO pay_f (pin, psum, number, card, at, date, time) VALUES ('$apud_f', '$newpsum', '$number', '$card', '$pat', '$date', '$time')"; 

    mysql_query($insertCommand11,$sc);

	//p-d 福袋

mysql_select_db($database_sc, $sc);

$query_Recpd = sprintf("SELECT * FROM pay_d ORDER BY id DESC");

$Recpd = mysql_query($query_Recpd, $sc) or die(mysql_error());

$row_Recpd = mysql_fetch_assoc($Recpd);

$totalRows_Recpd = mysql_num_rows($Recpd);

$newcpsum=$row_Recpd['psum']+$apud_b;

mysql_select_db($database_sc, $sc);

$insertCommand13="INSERT INTO pay_d (pin, psum, number, card, at, date, time, year, moom, day) VALUES ('$apud_b', '$newcpsum', '$number', '$card', '$pat', '$date', '$time', '$year', '$moom', '$day')"; 

mysql_query($insertCommand13,$sc);

	//////////

	}

$_SESSION['newfb']=$fdcard;

?><script type="text/javascript">document.location.href="x_add_d.php";</script>