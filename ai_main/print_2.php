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
mysql_select_db($database_sc, $sc);
$query_Reca = sprintf("SELECT * FROM pay_a ORDER BY id DESC");
$Reca = mysql_query($query_Reca, $sc) or die(mysql_error());
$row_Reca = mysql_fetch_assoc($Reca);
$totalRows_Reca = mysql_num_rows($Reca);
$total_a=$row_Reca['psum'];
//
mysql_select_db($database_sc, $sc);
$query_Recb = sprintf("SELECT * FROM pay_b ORDER BY id DESC");
$Recb = mysql_query($query_Recb, $sc) or die(mysql_error());
$row_Recb = mysql_fetch_assoc($Recb);
$totalRows_Recb = mysql_num_rows($Recb);
$total_b=$row_Recb['psum'];
//
mysql_select_db($database_sc, $sc);
$query_Recc = sprintf("SELECT * FROM pay_c ORDER BY id DESC");
$Recc = mysql_query($query_Recc, $sc) or die(mysql_error());
$row_Recc = mysql_fetch_assoc($Recc);
$totalRows_Recc = mysql_num_rows($Recc);
$total_c=$row_Recc['psum'];
//
mysql_select_db($database_sc, $sc);
$query_Recd = sprintf("SELECT * FROM pay_d ORDER BY id DESC");
$Recd = mysql_query($query_Recd, $sc) or die(mysql_error());
$row_Recd = mysql_fetch_assoc($Recd);
$totalRows_Recd = mysql_num_rows($Recd);
$total_d=$row_Recd['psum'];
//
mysql_select_db($database_sc, $sc);
$query_Rece = sprintf("SELECT * FROM pay_e ORDER BY id DESC");
$Rece = mysql_query($query_Rece, $sc) or die(mysql_error());
$row_Rece = mysql_fetch_assoc($Rece);
$totalRows_Rece = mysql_num_rows($Rece);
$total_e=$row_Rece['psum'];
//
mysql_select_db($database_sc, $sc);
$query_Recf = sprintf("SELECT * FROM pay_f ORDER BY id DESC");
$Recf = mysql_query($query_Recf, $sc) or die(mysql_error());
$row_Recf = mysql_fetch_assoc($Recf);
$totalRows_Recf = mysql_num_rows($Recf);
$total_f=$row_Recf['psum'];
//
mysql_select_db($database_sc, $sc);
$query_Recg = sprintf("SELECT * FROM pay_g ORDER BY id DESC");
$Recg = mysql_query($query_Recg, $sc) or die(mysql_error());
$row_Recg = mysql_fetch_assoc($Recg);
$totalRows_Recg = mysql_num_rows($Recg);
$total_g=$row_Recg['psum'];
//
mysql_select_db($database_sc, $sc);
$query_Recda = sprintf("SELECT * FROM pay_da ORDER BY id DESC");
$Recda = mysql_query($query_Recda, $sc) or die(mysql_error());
$row_Recda = mysql_fetch_assoc($Recda);
$totalRows_Recda = mysql_num_rows($Recda);
$total_da=$row_Recda['psum'];
//
mysql_select_db($database_sc, $sc);
$query_Recdb = sprintf("SELECT * FROM pay_db ORDER BY id DESC");
$Recdb = mysql_query($query_Recdb, $sc) or die(mysql_error());
$row_Recdb = mysql_fetch_assoc($Recdb);
$totalRows_Recdb = mysql_num_rows($Recdb);
$total_db=$row_Recdb['psum'];
//
mysql_select_db($database_sc, $sc);
$query_Recdc = sprintf("SELECT * FROM pay_dc ORDER BY id DESC");
$Recdc = mysql_query($query_Recdc, $sc) or die(mysql_error());
$row_Recdc = mysql_fetch_assoc($Recdc);
$totalRows_Recdc = mysql_num_rows($Recdc);
$total_dc=$row_Recdc['psum'];
//
mysql_select_db($database_sc, $sc);
$query_Recdd = sprintf("SELECT * FROM pay_dd ORDER BY id DESC");
$Recdd = mysql_query($query_Recdd, $sc) or die(mysql_error());
$row_Recdd = mysql_fetch_assoc($Recdd);
$totalRows_Recdd = mysql_num_rows($Recdd);
$total_dd=$row_Recdd['psum'];
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
    <td align="center" class="style21">損益表 列印</td>
    <td align="center" class="style21"><input type ="button" onclick="javascript:window.print()" value="資料列印"></input></td>
    <td align="center" class="style21"><input type ="button" onclick="history.back()" value="離開"></input></td>
  </tr>
</table>
<table width="1198" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td height="30" colspan="2" align="center" bgcolor="#CCCCCC" class="style21">資產表</td>
    <td colspan="2" align="center" bgcolor="#CCCCCC" class="style21">負債表</td>
  </tr>
  <tr>
    <td width="194" height="30" align="right" class="style21">收單金 (營收) </td>
    <td width="396" align="left" class="style21">&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_a, 0, '.' ,',');?></td>
    <td width="214" align="right" class="style21">福袋金 </td>
    <td width="389">&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_b, 0, '.' ,',');?></td>
  </tr>
  <tr>
    <td height="30" align="right" class="style21">禮品保管金</td>
    <td align="left" class="style21">&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_g, 0, '.' ,',');?></td>
    <td align="right" class="style21">靜態基金</td>
    <td>&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_c, 0, '.' ,',');?></td>
  </tr>
  <tr>
    <td height="30" align="right" class="style21">&nbsp;</td>
    <td align="left" class="style21">&nbsp;</td>
    <td align="right" class="style21">行銷費用</td>
    <td>&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_d, 0, '.' ,',');?></td>
  </tr>
  <tr>
    <td height="30" align="right" class="style21">&nbsp;</td>
    <td align="left" class="style21">&nbsp;</td>
    <td align="right" class="style21">愛心基金</td>
    <td>&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_e, 0, '.' ,',');?></td>
  </tr>
  <tr>
    <td height="30" align="right" class="style21">&nbsp;</td>
    <td align="left" class="style21">&nbsp;</td>
    <td align="right" class="style21">運作金</td>
    <td>&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_f, 0, '.' ,',');?></td>
  </tr>
  <tr>
    <td height="30" align="right" class="style21">&nbsp;</td>
    <td align="left" class="style21">&nbsp;</td>
    <td align="right" class="style21">營所稅</td>
    <td>&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_da, 0, '.' ,',');?></td>
  </tr>
  <tr>
    <td height="30" align="right" class="style21">&nbsp;</td>
    <td align="left" class="style21">&nbsp;</td>
    <td align="right" class="style21">金統管費</td>
    <td>&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_db, 0, '.' ,',');?></td>
  </tr>
  <tr>
    <td height="30" align="right" class="style21">&nbsp;</td>
    <td align="left" class="style21">&nbsp;</td>
    <td align="right" class="style21">系統管費</td>
    <td>&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_dc, 0, '.' ,',');?></td>
  </tr>
  <tr>
    <td height="30" align="right" class="style21">&nbsp;</td>
    <td align="left" class="style21">&nbsp;</td>
    <td align="right" class="style21">人事管費</td>
    <td>&nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_dd, 0, '.' ,',');?></td>
  </tr>
  <tr>
    <td height="30" colspan="4" align="right" bgcolor="#FFFFFF" class="style21"><hr></td>
  </tr>
  <tr>
    <td height="30" colspan="4" align="left" bgcolor="#FFFFFF" class="style21">總資產 =  $ <?php echo number_format(($total_a+$total_g), 0, '.' ,',');?></td>
  </tr>
  <tr>
    <td height="30" colspan="4" align="left" bgcolor="#FFFFFF" class="style21">資產負債結餘 = $ <?php echo number_format(($total_a+$total_g-$total_b-$total_c-$total_d-$total_e-$total_f-$total_da-$total_db-$total_dc-$total_dd), 0, '.' ,',');?></td>
  </tr>
</table>
<br />
</body>
</html>
