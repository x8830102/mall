<?php require_once('Connections/sc.php');mysql_query("set names utf8"); ?>
<?php
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
mysql_select_db($database_sc, $sc);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1 && level >= 7");
$Reclu = mysql_query($query_Reclu, $sc) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
//
$p=$_GET['p'];
switch ($p) {
  case'a':$pa="pay_a";$pb="營收金額";break;
  case'da':$pa="pay_da";$pb="各項稅務";break;
  case'db':$pa="pay_db";$pb="金流刷卡";break;
  case'dc':$pa="pay_dc";$pb="系統建置";break;
  case'dd':$pa="pay_dd";$pb="人事管銷";break;
  case'e':$pa="pay_e";$pb="愛心基金";break;
  case'i':$pa="pay_i";$pb="分享積分";break;
  case'b':$pa="pay_b";$pb="福袋積分";break;
  case'g':$pa="pay_g";$pb="產品成本";break;
  case'h':$pa="pay_h";$pb="促銷獎勵";break;
  case'c':$pa="pay_c";$pb="靜態基金";break;
  case'j':$pa="pay_j";$pb="車屋/旅遊";break;
  case'k':$pa="pay_k";$pb="組織運作";break;
  case'd':$pa="pay_d";$pb="行銷費用";break;
  case'f':$pa="pay_f";$pb="員工福利";break;
}
mysql_select_db($database_sc, $sc);
$query_Recl = sprintf("SELECT * FROM $pa ORDER BY id DESC");//ORDER BY id DESC && admin='$ceo'
$Recl = mysql_query($query_Recl, $sc) or die(mysql_error());
$row_Recl = mysql_fetch_assoc($Recl);
$totalRows_Recl = mysql_num_rows($Recl);//$ttc=$totalRows_Reccgn;$tti=0;
//
mysql_select_db($database_sc, $sc);$b=0;
$query_Reci = sprintf("SELECT * FROM $pa WHERE pin <> $b");
$Reci = mysql_query($query_Reci, $sc) or die(mysql_error());
$row_Reci = mysql_fetch_assoc($Reci);
$totalRows_Reci = mysql_num_rows($Reci);
if ($totalRows_Reci != 0) {
	$total_i=0;
	do {$total_i=$total_i+$row_Reci['pin'];} while ($row_Reci = mysql_fetch_assoc($Reci));
	}
//
mysql_select_db($database_sc, $sc);
$query_Reco = sprintf("SELECT * FROM $pa WHERE pout <> $b");
$Reco = mysql_query($query_Reco, $sc) or die(mysql_error());
$row_Reco = mysql_fetch_assoc($Reco);
$totalRows_Reco = mysql_num_rows($Reco);
if ($totalRows_Reco != 0) {
	$total_o=0;
	do {$total_o=$total_o+$row_Reco['pout'];} while ($row_Reco = mysql_fetch_assoc($Reco));
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>print</title>
<style type="text/css">
<!--
.style5 {color: #FFFFFF; font-size: 18px; }
.style7 {	color: #660099;
	font-weight: bold;
}
.style8 {	color: #0000FF;
	font-weight: bold;
}
.style14 {	font-size: 12px;
	font-family: "新細明體";
	color: #999999;
}
.style15 {color: #336600; font-size: 18px; }
.style16 {color: #336600; font-size: 18px; font-weight: bold; }
a:link {
	color: #336600;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #336600;
}
a:hover {
	text-decoration: none;
	color: #FF9900;
}
a:active {
	text-decoration: none;
}
.style17 {font-size: 12px;
	color: #666666;
	font-weight: bold;
}
.whiteBox {	border: 1px solid #FFFFFF;
}
.whiteBox1 {border: 1px solid #330;
}
.style3 {color: #996633}
.style19 {color: #000000}
a {
	font-size: 18px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
</head>

<body onload="MM_preloadImages('images/b4_1.png')">

<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" class="style21"><?php echo $pb;?> 列印</td>
    <td align="center" class="style21"><input type ="button" onclick="javascript:window.print()" value="資料列印"></input></td>
    <td align="center" class="style21"><input type ="button" onclick="history.back()" value="離開"></input></td>
  </tr>
  <tr>
    <td align="left" class="style21">*** 進 = <?php echo number_format($total_i, 0, '.' ,',');?> &amp;出 = <?php echo number_format($total_o, 0, '.' ,',');?> , 結餘 =
    <?php $a=$total_i-$total_o;echo number_format($a, 0, '.' ,',')?></td>
    <td align="center" class="style21">&nbsp;</td>
    <td align="center" class="style21">&nbsp;</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td width="267" height="30" align="center" bgcolor="#CCCCCC" class="style21">編號 / 名</td>
    <td width="213" align="center" bgcolor="#CCCCCC" class="style21">金額</td>
    <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <?php if ($totalRows_Recl != 0) {do { $msn=$row_Recl['number'];
		  mysql_select_db($database_sc, $sc);
$query_Recm = sprintf("SELECT * FROM memberdata WHERE number = '$msn'");
$Recm = mysql_query($query_Recm, $sc) or die(mysql_error());
$row_Recm = mysql_fetch_assoc($Recm);
$totalRows_Recm = mysql_num_rows($Recm);?>
  <tr>
    <td height="39">帳號：<?php echo $row_Recm['m_username'],"<br/>";?>暱名：<?php echo $row_Recm['m_nick'];?></td>
    <td align="center">$ <?php if ($row_Recl['pin'] != 0) {echo $row_Recl['pin'];} else {echo "- ",$row_Recl['pout'];}?></td>
    <td width="500" align="right"><?php echo $row_Recl['date'];?> <?php echo $row_Recl['time'];?></td>
  </tr>
  <tr>
    <td height="10" colspan="3"><hr></td>
  </tr>
  <?php } while ($row_Recl = mysql_fetch_assoc($Recl)); } else {echo "目前無資訊 ! ! !";}?>
</table>
<br />
</body>
</html>
