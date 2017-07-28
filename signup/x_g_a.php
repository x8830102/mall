<? require_once('Connections/sc.php');mysql_query("set names utf8");
header("Content-Type:text/html; charset=utf-8");
date_default_timezone_set('Asia/Taipei');
session_start();
$penl=$_SESSION['penl'];//echo $penl,"@@";exit;
$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");
$sn=$_SESSION['sn'];$surl=$_SESSION['surl'];
if ($sn == "") {header(sprintf("Location: http://".$surl));exit;}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: http://".$surl));exit;}
$name=$row_Recsn['m_name'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$fus=$_SESSION['gfus'];$newnr=$_SESSION['newnr'];$pudid=$_SESSION['pudid'];$vfdcard=$_SESSION['fdcard'];$torg=111;$fnumber=$newnr;
?><script type="text/javascript">document.location.href="x_g_a2.php";</script>
<?php ;exit;?>
<div id="divLoading" style="color:red; position:absolute; top:166px; left:703px;"> <img src="http://cmg588.com/life_link/ajax-loader.gif" border="0" style="vertical-align:middle;padding:6px"/> </div>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td height="100" align="center">&nbsp;</td>
  </tr>
  <tr>

    <td align="center">運算資訊中，請勿關閉或動任何行為…，請稍候...</td>

  </tr>

  <tr>

    <td align="center">進度： 3 / 8</td>

  </tr>

</table>
<?
/************************************************
補球(已另寫)
*************************************************/
    mysql_select_db($database_sc, $sc);//echo "###",$pudid;exit;
    $query_Recapud = sprintf("SELECT * FROM a_pud WHERE id=$pudid");// 
    $Recapud = mysql_query($query_Recapud, $sc) or die(mysql_error());
    $row_Recapud = mysql_fetch_assoc($Recapud);
	$totalRows_Recapud = mysql_num_rows($Recapud);
	$apud_a1=$row_Recapud['fpay1'];
	$apud_a2=$row_Recapud['fpay2'];
	$apud_name=$row_Recapud['name'];
	$apud_a=$row_Recapud['p'];
	$apud_b=$row_Recapud['b'];
	$apud_c=$row_Recapud['c'];
	$apud_d=$row_Recapud['d'];
	$apud_e=$row_Recapud['e'];
	$apud_f=$row_Recapud['f'];
	$apud_g=$row_Recapud['g'];
	$apud_h=$row_Recapud['h'];
	$apud_da=$row_Recapud['d_a'];
	$apud_db=$row_Recapud['d_b'];
	$apud_dc=$row_Recapud['d_c'];
	$apud_dd=$row_Recapud['d_d'];
	$apud_fd=$row_Recapud['fd'];
	$apud_fdm=$row_Recapud['fdm'];
	$apud_ted=$row_Recapud['ted'];
	$apud_ceo=$row_Recapud['ceo'];
	//
	mysql_select_db($database_sc, $sc);$opmid=9;//echo "###",$pudid;exit;
    $query_Recop = sprintf("SELECT * FROM memberdata WHERE m_id=$opmid");// 
    $Recop = mysql_query($query_Recop, $sc) or die(mysql_error());
    $row_Recop = mysql_fetch_assoc($Recop);
	$totalRows_Recop = mysql_num_rows($Recop);
	//
	if ($row_Recop['rat'] >= 2) {
		if ($apud_fd == 1) {
			$opv=2;$opnum="gugold777";$opname="串1";
			while ($opv != 0) {
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
				$fok=0;$fkknum=$fnumber;
		while ($fok == 0) {
			mysql_select_db($database_sc, $sc);
            $query_Recmfd = sprintf("SELECT * FROM fd WHERE number='$fkknum' ORDER BY id");//  DESC
            $Recmfd = mysql_query($query_Recmfd, $sc) or die(mysql_error());
            $row_Recmfd = mysql_fetch_assoc($Recmfd);
	        $totalRows_Recmfd = mysql_num_rows($Recmfd);
	        if ($totalRows_Recmfd != 0) {$mfdcard=$row_Recmfd['card'];$fok=1;
			    } else {
				mysql_select_db($database_sc, $sc);
                $query_Recmfdkk = sprintf("SELECT * FROM memberdata WHERE number='$fnumber'");//  DESC
                $Recmfdkk = mysql_query($query_Recmfdkk, $sc) or die(mysql_error());
                $row_Recmfdkk = mysql_fetch_assoc($Recmfdkk);
	            $totalRows_Recmfdkk = mysql_num_rows($Recmfdkk);
				$fkkname=$row_Recmfdkk['fname'];
				mysql_select_db($database_sc, $sc);
                $query_Recmfdkk2 = sprintf("SELECT * FROM memberdata WHERE m_username='$fkkname'");//  DESC
                $Recmfdkk2 = mysql_query($query_Recmfdkk2, $sc) or die(mysql_error());
                $row_Recmfdkk2 = mysql_fetch_assoc($Recmfdkk2);
	            $totalRows_Recmfdkk2 = mysql_num_rows($Recmfdkk2);
				$fkknum=$row_Recmfdkk2['number'];
			    } 
		    }
			//
			$xgu="";
		$x2=$mfdcard;$xa=0;unset($xbu);$xbi=0;$xbj=0;//echo $x2;exit;
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
            $query_Recxf = sprintf("SELECT * FROM fd WHERE number = '$number' && card='$fdcard' && gtow='$gw'");
            $Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());
            $row_Recxf = mysql_fetch_assoc($Recxf);
            $totalRows_Recxf = mysql_num_rows($Recxf);
		if ($totalRows_Recxf == 0) {
		mysql_select_db($database_sc, $sc);
$insertCommand13="INSERT INTO fd (number, card, name, c_fuser, c_guser, gtow, year, moom, day, end_y, end_m, end_d, date, time) VALUES ('$opnum', '$fdcard', '$opname', '$mfdcard', '$xgu', '$gw', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time')"; 
mysql_query($insertCommand13,$sc);
		}
				//
				$new_rat=$row_Recop['rat']-1;
		        $update11="UPDATE memberdata SET rat=$new_rat WHERE m_id = $opmid";
                mysql_select_db($database_sc, $sc);
                $Result11 = mysql_query($update11, $sc) or die(mysql_error());
				$opv--;
				}
			
	        
			}
		}
?>
<script type="text/javascript">document.location.href="x_g_a2.php";</script>
<?php 
exit;
//new-p

mysql_select_db($database_sc, $sc);

$query_Reccd = sprintf("SELECT * FROM memberdata WHERE number = '$newnr' && m_ok=1");

$Reccd = mysql_query($query_Reccd, $sc) or die(mysql_error());

$row_Reccd = mysql_fetch_assoc($Reccd);

$totalRows_Reccd = mysql_num_rows($Reccd);

$ks=$row_Reccd['ks'];

$m_nick=$row_Reccd['m_nick'];

$newnumber=$row_Reccd['number'];

$a_pud=$row_Reccd['a_pud'];

mysql_select_db($database_sc, $sc);

    $query_Recapud = sprintf("SELECT * FROM a_pud WHERE id=$a_pud");// 

    $Recapud = mysql_query($query_Recapud, $sc) or die(mysql_error());

    $row_Recapud = mysql_fetch_assoc($Recapud);

	$totalRows_Recapud = mysql_num_rows($Recapud);

	$my_fpay=$row_Recapud['my_fpay'];

	$my_p=$row_Recapud['my_p'];

//

//$c_guser=$row_Reccd2['c_guser'];

//

if ($row_Reccd['a_pud'] <= 6) {$fdsql="fd";$pcpin=20000;$pcpout=40000;}
if ($row_Reccd['a_pud'] > 11) {$fdsql="fd2";$pcpin=150000;$pcpout=300000;}

if ($row_Reccd['a_pud'] == 5) {

	$wi=2;$fd_t_card=$vfdcard;

	while ($wi != 0) {

		mysql_select_db($database_sc, $sc);

        $query_Reccd2 = sprintf("SELECT * FROM $fdsql WHERE card = '$fd_t_card'");

        $Reccd2 = mysql_query($query_Reccd2, $sc) or die(mysql_error());

        $row_Reccd2 = mysql_fetch_assoc($Reccd2);

        $totalRows_Reccd2 = mysql_num_rows($Reccd2);

		$fd_t_card=$row_Reccd2['c_guser'];

		$wi--;

		}

	//

	$tt_us=$fd_t_card;$keyok=0;

	//7p-yes

$p_total=0;

mysql_select_db($database_sc, $sc);

$query_Recg = sprintf("SELECT * FROM $fdsql WHERE c_guser = '$tt_us'");

$Recg = mysql_query($query_Recg, $sc) or die(mysql_error());

$row_Recg = mysql_fetch_assoc($Recg);

$totalRows_Recg = mysql_num_rows($Recg);

if ($totalRows_Recg != 0) {$p_total=$p_total+$totalRows_Recg;

	do {$gusa=$row_Recg['card'];

	mysql_select_db($database_sc, $sc);

    $query_Recg2 = sprintf("SELECT * FROM $fdsql WHERE c_guser = '$gusa'");

    $Recg2 = mysql_query($query_Recg2, $sc) or die(mysql_error());

    $row_Recg2 = mysql_fetch_assoc($Recg2);

    $totalRows_Recg2 = mysql_num_rows($Recg2);

	if ($totalRows_Recg2 != 0) {$p_total=$p_total+$totalRows_Recg2;}

	} while ($row_Recg = mysql_fetch_assoc($Recg));

	}//echo "ok",$p_total;exit;

	//pf

	if ($p_total == 6) {

	mysql_select_db($database_sc, $sc);

        $query_Reccd2 = sprintf("SELECT * FROM $fdsql WHERE card = '$tt_us'");

        $Reccd2 = mysql_query($query_Reccd2, $sc) or die(mysql_error());

        $row_Reccd2 = mysql_fetch_assoc($Reccd2);

        $totalRows_Reccd2 = mysql_num_rows($Reccd2);

		$c_num=$row_Reccd2['number'];

		$fname=$row_Reccd2['name'];

		$cid=$row_Reccd2['id'];

mysql_select_db($database_sc, $sc);

$query_Reccd3 = sprintf("SELECT * FROM $fdsql WHERE number = '$c_num' && at=1");

$Reccd3 = mysql_query($query_Reccd3, $sc) or die(mysql_error());

$row_Reccd3 = mysql_fetch_assoc($Reccd3);

$totalRows_Reccd3 = mysql_num_rows($Reccd3);

mysql_select_db($database_sc, $sc);

$query_Reccd31 = sprintf("SELECT * FROM $fdsql WHERE c_fuser = '$tt_us'");

$Reccd31 = mysql_query($query_Reccd31, $sc) or die(mysql_error());

$row_Reccd31 = mysql_fetch_assoc($Reccd31);

$totalRows_Reccd31 = mysql_num_rows($Reccd31);

if ($totalRows_Reccd31 > $totalRows_Reccd3) {$keyok=1;} else {

	mysql_select_db($database_sc, $sc);

    $query_Recob2 = sprintf("SELECT * FROM memberdata WHERE number='$c_num'");// 

    $Recob2 = mysql_query($query_Recob2, $sc) or die(mysql_error());

    $row_Recob2 = mysql_fetch_assoc($Recob2);

	$totalRows_Recob2 = mysql_num_rows($Recob2);

	$cfu=$row_Recob2['m_fuser'];

	if ($row_Recob2['st'] == 1) {

	mysql_select_db($database_sc, $sc);

    $query_Recob = sprintf("SELECT * FROM c_cash WHERE number='$c_num' ORDER BY id DESC");// 

    $Recob = mysql_query($query_Recob, $sc) or die(mysql_error());

    $row_Recob = mysql_fetch_assoc($Recob);

	$totalRows_Recob = mysql_num_rows($Recob);

	$fdp=$my_p;

	if ($row_Recob['csum'] >= $fdp) {

		$new_ob=$row_Recob['csum']-$fdp;

	$onote="(換)自動扣值";

	mysql_select_db($database_sc, $sc);

    $insertCommand13="INSERT INTO c_cash (number, cout, csum, note, date, time) VALUES ('$c_num', '$fdp', '$new_ob', '$onote', '$date', '$time')"; 

    mysql_query($insertCommand13,$sc);

	    //f-gold

		$my_fuser=$cfu;

		mysql_select_db($database_sc, $sc);

$query_Recfg2 = sprintf("SELECT * FROM memberdata WHERE number='$my_fuser'");

$Recfg2 = mysql_query($query_Recfg2, $sc) or die(mysql_error());

$row_Recfg2 = mysql_fetch_assoc($Recfg2);

$totalRows_Recfg2 = mysql_num_rows($Recfg2);

if ($row_Recfg2['a_pud'] >= 5) {

		$glevel=2;$at=0;$gold_f=$my_fpay;

		$sncode=$my_fuser."-".date("ymdhis");

		$fnote="關係卡獎勵(".$fdcard.")";

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

		    /*$hd=$gold_f*0.2;

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

            mysql_query($insertCommand15,$sc);*/

        }

		//

		$keyok=1;

		}

	}}

	}//echo $p_total,"@!@",$keyok;exit;

	//

	if ($p_total == 6 && $keyok == 1) {//出局

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

	/*	//out

		$update11="UPDATE fd SET at=1,fnumber='$fdcard' WHERE id=$cid";

        mysql_select_db($database_sc, $sc);

        $Result11 = mysql_query($update11, $sc) or die(mysql_error());
*/
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

$insertCommand13="INSERT INTO $fdsql (name, number, card, c_fuser, c_guser, gtow, year, moom, day, end_y, end_m, end_d, date, time) VALUES ('$fname', '$c_num', '$fdcard', '$tt_us', '$xgu', '$gw', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time')"; 

mysql_query($insertCommand13,$sc);

		}
/*
        //in

		$pat=1;

mysql_select_db($database_sc, $sc);

$query_Recpc = sprintf("SELECT * FROM pay_d ORDER BY id DESC");

$Recpc = mysql_query($query_Recpc, $sc) or die(mysql_error());

$row_Recpc = mysql_fetch_assoc($Recpc);

$totalRows_Recpc = mysql_num_rows($Recpc);

$newcpsum=$row_Recpc['psum']+$pcpin;

mysql_select_db($database_sc, $sc);

$insertCommand13="INSERT INTO pay_d (pin, psum, number, card, at, date, time, year, moom, day) VALUES ('$pcpin', '$newcpsum', '$c_num', '$fdcard', '$pat', '$date', '$time', '$year', '$moom', '$day')"; 

mysql_query($insertCommand13,$sc);
*/
		//out

mysql_select_db($database_sc, $sc);

$query_Recpc = sprintf("SELECT * FROM pay_b ORDER BY id DESC");

$Recpc = mysql_query($query_Recpc, $sc) or die(mysql_error());

$row_Recpc = mysql_fetch_assoc($Recpc);

$totalRows_Recpc = mysql_num_rows($Recpc);

$newcpsum=$row_Recpc['psum']-$pcpout;

mysql_select_db($database_sc, $sc);

$insertCommand13="INSERT INTO pay_b (pout, psum, number, card, at, date, time, year, moom, day) VALUES ('$pcpin', '$newcpsum', '$c_num', '$fdcard', '$pat', '$date', '$time', '$year', '$moom', '$day')"; 

mysql_query($insertCommand13,$sc);

        //

		$level=2;$gold_f=$pcpout;

		$fnote="開福袋積分#".$tt_us."";

			$sncode=$c_num.date("ymdhis");

	        mysql_select_db($database_sc, $sc);

            $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, date, time, sncode) VALUES ('$c_num', '$year', '$moom', '$day', '$z', '$gold_f', '$fnote', '$level', '$date', '$time', '$sncode')"; 

            mysql_query($insertCommand15,$sc);

		//

		mysql_select_db($database_sc, $sc);

    $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$tt_us' && year=$year && moom=$moom && day=$day");

    $Recs = mysql_query($query_Recs, $sc) or die(mysql_error());

    $row_Recs = mysql_fetch_assoc($Recs);

    $totalRows_Recs = mysql_num_rows($Recs);

    if ($totalRows_Recs == 0) {

        mysql_select_db($database_sc, $sc);

        $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level2) VALUES ('$tt_us', '$year', '$moom', '$day', '$z', '$gold_f')"; 

        mysql_query($insertCommand15,$sc);

        } else {

	        $new_level1=$row_Recs['level2']+$gold_f;

	        $update11="UPDATE gold_sum SET level1= $new_level1 WHERE number = '$tt_us' && year=$year && moom=$moom && day=$day";

            mysql_select_db($database_sc, $sc);

            $Result11 = mysql_query($update11, $sc) or die(mysql_error());

	        }

		
/*
		$hd=$pcpin*0.2;

	mysql_select_db($database_sc, $sc);

    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$c_num' ORDER BY id DESC");

    $Rech = mysql_query($query_Rech, $sc) or die(mysql_error());

    $row_Rech = mysql_fetch_assoc($Rech);

    $totalRows_Rech = mysql_num_rows($Rech);

	$new_h=$row_Rech['csum']+$hd;

	$fnotex="開福袋積分, <br/>福袋ID：".$tt_us;

	mysql_select_db($database_sc, $sc);

    $insertCommand15="INSERT INTO g_cash (number, cin, csum, note, date, time, sncode) VALUES ('$c_num', '$hd', '$new_h', '$fnotex', '$date', '$time', '$sncode')"; 

    mysql_query($insertCommand15,$sc);

	        //

			$hd=$pcpin*0.8;

	mysql_select_db($database_sc, $sc);

    $query_Rech = sprintf("SELECT * FROM c_cash WHERE number = '$c_num' ORDER BY id DESC");

    $Rech = mysql_query($query_Rech, $sc) or die(mysql_error());

    $row_Rech = mysql_fetch_assoc($Rech);

    $totalRows_Rech = mysql_num_rows($Rech);

	$new_h=$row_Rech['csum']+$hd;

	$fnotex="開福袋積分, <br/>福袋ID：".$tt_us;

	mysql_select_db($database_sc, $sc);

    $insertCommand15="INSERT INTO c_cash (number, cin, csum, note, date, time, sncode) VALUES ('$c_num', '$hd', '$new_h', '$fnotex', '$date', '$time', '$sncode')"; 

    mysql_query($insertCommand15,$sc);*/

		//$torg=111;

		} else {//send take

			$torg=0;

			if ($p_total == 6) {

				mysql_select_db($database_sc, $sc);

                $insertCommand15="INSERT INTO fd_take (number, name, fcard, date, time, fdsql) VALUES ('$c_num', '$fname', '$tt_us', '$date', '$time', '$fdsql')"; 

                mysql_query($insertCommand15,$sc);

				}

			}

	} else {$torg=0;}//echo $a_pud,"#",$torg;exit;

//if ($torg == 0) {?><script type="text/javascript">document.location.href="x_g_a2.php";</script>
<!--
<?php //} else {$_SESSION['fdcard']=$fdcard;?><script type="text/javascript">document.location.href="x_g_a.php";</script><?php //}?>
-->
<?php exit;?>