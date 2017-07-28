<?php require_once('Connections/sc.php'); mysql_query("set names utf8");?>
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
<title>無標題文件</title>
<style type="text/css">
.style14 {font-size: 12px;
	font-family: "新細明體";
	color: #999999;
}
.style17 {font-size: 12px;
	color: #666666;
	font-weight: bold;
}
.style7 {color: #660099;
	font-weight: bold;
}
.style8 {color: #0000FF;
	font-weight: bold;
}
.whiteBox {border: 1px solid #FFFFFF;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style12 {font-size: 12px;
	line-height: 20px;
	word-spacing: 1px;
	letter-spacing: 1px;
}
.style201 {color: #F78A18; }
.style171 {font-size: 22px; line-height: 20px; word-spacing: 1px; letter-spacing: 1px; }
.style181 {font-size: 22px; line-height: 20px; word-spacing: 1px; letter-spacing: 1px; color: #0000FF; }
a:link {
	color: #00F;
}
a:visited {
	color: #00F;
}
a:hover {
	color: #F90;
}
a:active {
	color: #F00;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
</style>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
</head>

<body>
<table width="1000" border="3" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="150" colspan="2" valign="top" background="images/2.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="29%" height="81">&nbsp;</td>
            <td width="58%">&nbsp;</td>
            <td width="13%">&nbsp;</td>
          </tr>
          <tr>
            <td height="51">&nbsp;</td>
            <td><span class="style7"> <?php echo $row_Reclu['name'];?> 您好!</span> <span class="style8">&nbsp;&nbsp;&nbsp;登入帳號：<?php echo $row_Reclu['username'];?></span>&nbsp;&nbsp;</td>
            <td rowspan="2"><a href="ai_in.php"><img src="images/3.png" alt="回管理" title="回管理" width="50" height="53" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="712"><table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_a.php'" value="收單金" /></td>
            <td ><input name="Submit" type="button" class="style171" onclick="window.location='pay_b.php'" value="福袋金" /></td>
            <td ><input name="Submit" type="button" class="style171" onclick="window.location='pay_c.php'" value="靜態基金" /></td>
            <td ><input name="Submit" type="button" class="style171" onclick="window.location='pay_d.php'" value="行銷費用" /></td>
            <td ><input name="Submit" type="button" class="style171" onclick="window.location='pay_e.php'" value="愛心基金" /></td>
            <td ><input name="Submit" type="button" class="style171" onclick="window.location='pay_f.php'" value="運作金" /></td>
            <td ><input name="Submit" type="button" class="style171" onclick="window.location='pay_da.php'" value="營所稅" /></td>
            <td ><input name="Submit4" type="button" class="style171" onclick="window.location='pay_db.php'" value="金流管費" /></td>
            <td ><input name="Submit" type="button" class="style171" onclick="window.location='pay_dc.php'" value="系統管費" /></td>
            <td ><input name="Submit" type="button" class="style171" onclick="window.location='pay_dd.php'" value="人事管費" /></td>
            <td ><input name="Submit" type="button" class="style181" onclick="window.location='pay_z.php'" value="損益表" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_j.php'" value="特別分紅" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_k.php'" value="業務分紅" /></td>
          </tr>
        </table></td>
        <td width="288" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><hr size="1" noshade="noshade" class="whiteBox" /></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td><a href="print_2.php">列印</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="350" colspan="2" align="center" valign="top"><table width="1198" border="0" align="center" cellpadding="0" cellspacing="1">
          <tr>
            <td height="30" colspan="2" align="center" bgcolor="#46A0EC" class="style21">資產表</td>
            <td colspan="2" align="center" bgcolor="#46A0EC" class="style21">負債表</td>
            </tr>
          <tr>
            <td width="194" height="30" align="right" bgcolor="#CCCCFF" class="style21">收單金 (營收) </td>
            <td width="396" align="left" bgcolor="#CCCCFF" class="style21"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_a, 0, '.' ,',');?></td>
            <td width="214" align="right" bgcolor="#CCCCCC" class="style21">福袋金 </td>
            <td width="389" bgcolor="#CCCCCC"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_b, 0, '.' ,',');?></td>
          </tr>
          <tr>
            <td height="30" align="right" bgcolor="#CCCCFF" class="style21">禮品保管金</td>
            <td align="left" bgcolor="#CCCCFF" class="style21"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_g, 0, '.' ,',');?></td>
            <td align="right" bgcolor="#CCCCCC" class="style21">靜態基金</td>
            <td bgcolor="#CCCCCC"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_c, 0, '.' ,',');?></td>
          </tr>
          <tr>
            <td height="30" align="right" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="left" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="right" bgcolor="#CCCCCC" class="style21">行銷費用</td>
            <td bgcolor="#CCCCCC"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_d, 0, '.' ,',');?></td>
          </tr>
          <tr>
            <td height="30" align="right" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="left" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="right" bgcolor="#CCCCCC" class="style21">愛心基金</td>
            <td bgcolor="#CCCCCC"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_e, 0, '.' ,',');?></td>
          </tr>
          <tr>
            <td height="30" align="right" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="left" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="right" bgcolor="#CCCCCC" class="style21">運作金</td>
            <td bgcolor="#CCCCCC"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_f, 0, '.' ,',');?></td>
          </tr>
          <tr>
            <td height="30" align="right" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="left" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="right" bgcolor="#CCCCCC" class="style21">營所稅</td>
            <td bgcolor="#CCCCCC"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_da, 0, '.' ,',');?></td>
          </tr>
          <tr>
            <td height="30" align="right" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="left" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="right" bgcolor="#CCCCCC" class="style21">金統管費</td>
            <td bgcolor="#CCCCCC"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_db, 0, '.' ,',');?></td>
          </tr>
          <tr>
            <td height="30" align="right" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="left" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="right" bgcolor="#CCCCCC" class="style21">系統管費</td>
            <td bgcolor="#CCCCCC"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_dc, 0, '.' ,',');?></td>
          </tr>
          <tr>
            <td height="30" align="right" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="left" bgcolor="#CCCCFF" class="style21">&nbsp;</td>
            <td align="right" bgcolor="#CCCCCC" class="style21">人事管費</td>
            <td bgcolor="#CCCCCC"> &nbsp;&nbsp;&nbsp;$ <?php echo number_format($total_dd, 0, '.' ,',');?></td>
          </tr>
          <tr>
            <td height="30" colspan="4" align="right" bgcolor="#FFFFFF" class="style21">&nbsp;</td>
            </tr>
          <tr>
            <td height="30" colspan="4" align="left" bgcolor="#FFFFFF" class="style21">總資產 =  $ <?php echo number_format(($total_a+$total_g), 0, '.' ,',');?></td>
          </tr>
          <tr>
            <td height="30" colspan="4" align="left" bgcolor="#FFFFFF" class="style21">資產負債結餘 = $ <?php echo number_format(($total_a+$total_g-$total_b-$total_c-$total_d-$total_e-$total_f-$total_da-$total_db-$total_dc-$total_dd), 0, '.' ,',');?></td>
          </tr>
          </table></td>
      </tr>
      
      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>