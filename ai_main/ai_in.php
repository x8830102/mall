<?php require_once('Connections/kg.php');mysql_query("set names utf8"); ?>
<?php
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  $_SESSION['ceo'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['ceo']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
$ceo=$_SESSION['ceo'];
mysql_select_db($database_kg, $kg);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1 ");
$Reclu = mysql_query($query_Reclu, $kg) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
//
mysql_select_db($database_kg, $kg);$wg="boss";$dz=(int)date("z");$dh=(int)date("H");$di=(int)date("i");$dy=(int)date("Y");$dm=(int)date("m");$dd=(int)date("d");
$query_Recw = sprintf("SELECT * FROM admin WHERE username = '$wg' && at=1");
$Recw = mysql_query($query_Recw, $kg) or die(mysql_error());
$row_Recw = mysql_fetch_assoc($Recw);
$totalRows_Recw = mysql_num_rows($Recw);
//if ($dd == 1 && $row_Recw['end_z'] != $dz) {header(sprintf("Location: ../../x_moom_end.php"));exit;}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>行政管理</title>
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
body {
	background-image: url(../p_pic/9.jpg);
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>

<body onload="MM_preloadImages('images/ct1-1.png','images/ct2-1.png','images/ct7-1.png','images/ct9-1.png','images/ct10-1.png','images/bt6-1.png')">
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
            <td><span class="style7">
              <?php echo $row_Reclu['name'];?>
您好!</span> <span class="style8">&nbsp;&nbsp;&nbsp;登入帳號：<?php echo $row_Reclu['username'];?></span>&nbsp;&nbsp;【<a href="amss_pas.php">修改密碼</a>】</td>
            <td rowspan="2"><a href="<?php echo $logoutAction ?>"><img src="images/3.png" alt="登出" title="登出" width="50" height="53" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="505">&nbsp;</td>
        <td width="456" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><hr size="1" noshade="noshade" class="whiteBox" /></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="350" colspan="2" align="center" valign="middle">
		<?php if ($row_Reclu['level'] >= 4) {?><table width="950" border="0" align="center" cellpadding="0" cellspacing="20">
          <tr>
            <?php if ($row_Reclu['level'] == 4 xor $row_Reclu['level'] == 10) {?><td width="200"><a href="../../life_link/newsSystem/newsAdmin.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','images/bt6-1.png',1)"><img src="images/bt6.png" name="Image7" width="200" height="192" border="0" id="Image7" /></a></td><?php }?>
            <?php if ($row_Reclu['level'] >= 4) {?><td width="200"><a href="mem_main.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image16','','images/ct2-1.png',1)"><img src="images/ct2.png" name="Image16" width="200" height="192" border="0" id="Image16" /></a></td><?php }?>
            <?php if ($row_Reclu['level'] >= 8) {?><td width="200"><a href="oc_main.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image15','','images/ct7-1.png',1)"><img src="images/ct7.png" name="Image15" width="200" height="192" border="0" id="Image15" /></a></td><?php }?>
            <?php if ($row_Reclu['level'] == 10) {?><td width="250"><a href="ceo_main.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/ct1-1.png',1)"><img src="images/ct1.png" name="Image5" width="200" height="192" border="0" id="Image5" /></a></td><?php }?>
          </tr>
          </table><?php }?>
          <?php if ($row_Reclu['level'] >= 8) {?>
          <table width="950" border="0" align="center" cellpadding="0" cellspacing="20">
            <tr>
              <?php if ($row_Reclu['level'] == 7 xor $row_Reclu['level'] == 10) {?>
              <td width="200"><a href="pay_a.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/ct9-1.png',1)"><img src="images/ct9.png" name="Image6" width="200" height="192" border="0" id="Image6" /></a></td>
              <?php }?>
              <?php if ($row_Reclu['level'] == 7 xor $row_Reclu['level'] == 10) {?><td width="200"><!--<a href="pay_b.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','images/ct10-1.png',1)"><img src="images/ct10.png" name="Image7" width="200" height="192" border="0" id="Image7" /></a>--><a href="pay_o.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','images/ct11-1.png',1)"><img src="images/ct11.png" name="Image1" width="200" height="192" border="0" id="Image1" /></a></td><?php }?>
              <td width="200">&nbsp;</td>
              <td width="250">&nbsp;</td>
            </tr>
          </table>
          <?php }?></td>
      </tr>
      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Reclu);
?>