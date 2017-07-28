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
//
//gold-f
	$f1us=$fus;$glevel=1;
	$gold_f=$ks*0.1;
	    mysql_select_db($database_kg, $kg);
        $query_Recfmem = sprintf("SELECT * FROM memberdata WHERE number='$f1us'");// 
        $Recfmem = mysql_query($query_Recfmem, $kg) or die(mysql_error());
        $row_Recfmem = mysql_fetch_assoc($Recfmem);
	$femail=$row_Recfmem['m_email'];
	$fnote="新单推荐奖金=100, ID：".$card."[".$m_nick."]";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level) VALUES ('$f1us', '$year', '$moom', '$day', '$z', '$gold_f', '$fnote', '$glevel')"; 
    mysql_query($insertCommand15,$kg);
	//
	$hd=$gold_f*0.75;
	mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$f1us' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']+$hd;
	$fnotex="新单推荐奖金=100, ID：".$card."[".$m_nick."],扣「商城管理费10%」,扣 「税10%」,扣 「贵金属托管费5%」";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cin, csum, note, date, time) VALUES ('$f1us', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	//
	$hd2=$gold_f;
	mysql_select_db($database_kg, $kg);
    $query_Rech2 = sprintf("SELECT * FROM c_cash WHERE number = '$f1us' ORDER BY id DESC");
    $Rech2 = mysql_query($query_Rech2, $kg) or die(mysql_error());
    $row_Rech2 = mysql_fetch_assoc($Rech2);
    $totalRows_Rech2 = mysql_num_rows($Rech2);
	$new_h2=$row_Rech2['csum']+$hd2;
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO c_cash (number, cin, csum, note, date, time) VALUES ('$f1us', '$hd2', '$new_h2', '$mnote', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	//
	mysql_select_db($database_kg, $kg);
    $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$f1us' && year=$year && moom=$moom && day=$day");
    $Recs = mysql_query($query_Recs, $kg) or die(mysql_error());
    $row_Recs = mysql_fetch_assoc($Recs);
    $totalRows_Recs = mysql_num_rows($Recs);
	if ($totalRows_Recs == 0) {
		mysql_select_db($database_kg, $kg);
        $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level1) VALUES ('$f1us', '$year', '$moom', '$day', '$z', '$gold_f')"; 
        mysql_query($insertCommand15,$kg);
		} else {
			$new_level1=$row_Recs['level1']+$gold_f;
			$update11="UPDATE gold_sum SET level1= $new_level1 WHERE number = '$f1us' && year=$year && moom=$moom && day=$day";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
			}
//扣回
mysql_select_db($database_kg, $kg);
$query_Recr = sprintf("SELECT * FROM memberdata WHERE number = '$f1us' && m_ok=1");
$Recr = mysql_query($query_Recr, $kg) or die(mysql_error());
$row_Recr = mysql_fetch_assoc($Recr);
$totalRows_Recr = mysql_num_rows($Recr);
if ($row_Recr['ek'] != 0) {
	if ($row_Recr['ek'] >= $hd) {
		mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$f1us' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']-$hd;
	$fnotex="回填單奖金扣回";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cout, csum, note, date, time) VALUES ('$f1us', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	    //if ($row_Reccd['ks'] == 0) {
		    $new_ek=$row_Recr['ek']-$hd;
			$update11="UPDATE memberdata SET ek=$new_ek WHERE number = '$f1us'";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
		    //}
		}
	if ($row_Recr['ek'] < $hd) {
		mysql_select_db($database_kg, $kg);
    $query_Rech = sprintf("SELECT * FROM g_cash WHERE number = '$f1us' ORDER BY id DESC");
    $Rech = mysql_query($query_Rech, $kg) or die(mysql_error());
    $row_Rech = mysql_fetch_assoc($Rech);
    $totalRows_Rech = mysql_num_rows($Rech);
	$new_h=$row_Rech['csum']-$row_Recr['ek'];//if ($row_Reccd['ks'] == 0) {$new_h=$row_Rech['csum']-$row_Recr['ek'];} else {$new_h=$row_Rech['csum']-$hd;}
	$fnotex="回填單奖金扣回";
	mysql_select_db($database_kg, $kg);
    $insertCommand15="INSERT INTO g_cash (number, cout, csum, note, date, time) VALUES ('$f1us', '$hd', '$new_h', '$fnotex', '$date', '$time')"; 
    mysql_query($insertCommand15,$kg);
	    //if ($row_Reccd['ks'] == 0) {    
			$new_ek=0;
			$update11="UPDATE memberdata SET ek=$new_ek WHERE number = '$f1us'";
            mysql_select_db($database_kg, $kg);
            $Result11 = mysql_query($update11, $kg) or die(mysql_error());
		   // }
		}
	}
	//$fnote="新单推荐奖金,ID：".$card."[".$m_nick."]";
	/*
			$mailtype='Content-Type:text/html;charset=utf-8';
            $mailFrom="service@cfdgold.com";
            $mailTo=$femail;
            $mailCC="";
            $mailBCC="";
            $mailSubject="CFD貴金屬互助社區 - [奖金]通知";
            $mailContent = "<table width='360' border='1' cellspacing='0' cellpadding='0'>
  <tr>
    <td height='300' valign='top'><table width='100%' border='0' cellspacing='2' cellpadding='0'>
      <tr>
        <td><img src='http://cfdgold.com/cfd/cht/images/1-3.png' width='360' height='105' border='0' /></td>
      </tr>
      <tr>
        <td align='right'><a href='http://cfdgold.com'> http://cfdgold.com</a></td>
      </tr>
      <tr>
        <td>".date("Y/m/d H:i:s")."</td>
      </tr>
      <tr>
        <td>「獎金收入」通知 ：</td>
      </tr>
      <tr>
        <td><table width='150' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td><hr></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>".$fnote."</td>
      </tr>
      <tr>
        <td>$ ".$gold_f."</td>
      </tr>
      <tr>
        <td><a href='http://cfdgold.com/cfd/cht/goldsee.php?u=".$f1us."&amp;y=".$year."&amp;m=".$moom."&amp;d=".$day."'>&lt;&lt; 查看獎金表 &gt;&gt;</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align='right'>---   CFD貴金屬互助社區 - 祝您平安順心  ---</td>
      </tr>
    </table></td>
  </tr>
</table>";
            $maildata = "From:$mailFrom\r\n";
            if ($mailCC != '') {
                $maildata .= "CC:$mailCC\r\n";
                }
            if ($mailBCC != '') {
                $maildata .= "BCC:$mailBCC\r\n";
                }
            $maildata .= "$mailtype";
            mail($mailTo,$mailSubject,$mailContent,$maildata);
	*/
//header(sprintf("Location: x_g_b.php"));exit;
?>
<script type="text/javascript">document.location.href="x_g_d.php";</script>
