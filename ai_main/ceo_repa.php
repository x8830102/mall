<?php require_once('Connections/kg.php'); mysql_query("set names utf8");?>
<?php
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
//
$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
  $passwd=$HTTP_POST_VARS["passwd"];$c=$_GET['c'];
  $update11="UPDATE admin SET passwd=$passwd WHERE username='$c'";
  mysql_select_db($database_kg, $kg);
  $Result11 = mysql_query($update11, $kg) or die(mysql_error());
  

  header(sprintf("Location: adceo.php"));
}
//
mysql_select_db($database_kg, $kg);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1 && level >= 7");
$Reclu = mysql_query($query_Reclu, $kg) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
//
mysql_select_db($database_kg, $kg);$a=$_GET['c'];
$query_Recl = sprintf("SELECT * FROM admin WHERE username = '$a'");
$Recl = mysql_query($query_Recl, $kg) or die(mysql_error());
$row_Recl = mysql_fetch_assoc($Recl);
$totalRows_Recl = mysql_num_rows($Recl);
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
.style2 {font-size: 16px; font-weight: bold; }
.style4 {	font-size: 18px;
	font-weight: bold;
}
.style3 {color: #996633}
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
            <td><span class="style7"> <?php echo $row_Reclu['name'];?> 您好!</span> <span class="style8">&nbsp;&nbsp;&nbsp;登入帳號：<?php echo $row_Reclu['username'];?></span>&nbsp;&nbsp;【<a href="amss_pas.php">修改密碼</a>】</td>
            <td rowspan="2"><a href="ceo_main.php"><img src="images/3.png" alt="回管理" title="回管理" width="50" height="53" border="0" /></a></td>
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
        <td colspan="2"><table width="300" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="50">&nbsp;</td>
            <td width="238">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="350" colspan="2" align="center" valign="top"><table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="819" align="center"><span class="style4">密碼重設</span></td>
            <td width="151" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"><form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
              <table width="700" border="1" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="129" bgcolor="#C8DBEB" class="style4">姓名</td>
                  <td width="130" bgcolor="#C8DBEB" class="style4">聯絡電話</td>
                  <td width="173" bgcolor="#C8DBEB" class="style4">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center"><?php echo $row_Recl['name'];?></td>
                  <td align="center"><?php echo $row_Recl['phone'];?></td>
                  <td align="center" class="style4">重設密碼值為：「1234」</td>
                </tr>
                <tr>
                  <td colspan="3" align="center"><input name="passwd" type="hidden" id="passwd" value="1234" />
                    <input name="user" type="hidden" id="user" value="<?php echo $_GET['c'];?>" />
                    <input type="hidden" name="MM_update" value="form1" />
                    <input type="submit" name="button" id="button" value="確定重設密碼" />
                    <span class="style3" style="margin:0px;">
                      <input type="button" name="Submit3" value="回上一頁" onclick="window.history.back();" />
                    </span></td>
                </tr>
              </table>
            </form></td>
          </tr>
        </table>
          <p>&nbsp;</p></td>
      </tr>
      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>