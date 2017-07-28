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
  $le=$_POST['level'];$at=$_POST['at'];$u=$_POST['user'];
  $update11="UPDATE admin SET level=$le,at=$at WHERE username='$u'";
  mysql_select_db($database_kg, $kg);
  $Result11 = mysql_query($update11, $kg) or die(mysql_error());
  

  header(sprintf("Location: ceo_main.php"));
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
            <td width="819" align="center"><span class="style4">變更權限設定</span></td>
            <td width="151" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"><form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
              <table width="700" border="1" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="129" bgcolor="#9FC0E3" class="style4">姓名</td>
                  <td width="130" bgcolor="#9FC0E3" class="style4">聯絡電話</td>
                  <td width="173" bgcolor="#9FC0E3" class="style4">權限層級</td>
                  <td width="243" bgcolor="#9FC0E3" class="style4">核準使用</td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#9FC0E3"><?php echo $row_Recl['name'];?></td>
                  <td align="center" bgcolor="#9FC0E3"><?php echo $row_Recl['phone'];?></td>
                  <td align="center" bgcolor="#9FC0E3"><select name="level" id="level">
                    <option value="0" <?php if ($row_Recl['level'] == 0) {echo "selected='selected'";}?>>請選擇</option>
                    <option value="9" <?php if ($row_Recl['level'] == 9) {echo "selected='selected'";}?>>副總</option>
                    <option value="8" <?php if ($row_Recl['level'] == 8) {echo "selected='selected'";}?>>會計人員</option>
                    <option value="7" <?php if ($row_Recl['level'] == 7) {echo "selected='selected'";}?>>資訊人員</option>
                    <option value="4" <?php if ($row_Recl['level'] == 4) {echo "selected='selected'";}?>>一般行政</option>
                    <!--<option value="6" <?php //if ($row_Recl['level'] == 6) {echo "selected='selected'";}?>>直營店</option>
                    <option value="5" <?php //if ($row_Recl['level'] == 5) {echo "selected='selected'";}?>>加盟單位</option>
                    <option value="3" selected="selected" <?php //if ($row_Recl['level'] == 3) {echo "selected='selected'";}?>>窗口單位</option>-->
                  </select></td>
                  <td align="left" bgcolor="#9FC0E3"><select name="at" id="at">
                    <option value="0" <?php if ($row_Recl['at'] == 0) {echo "selected='selected'";}?>>禁止</option>
                    <option value="1" <?php if ($row_Recl['at'] == 1) {echo "selected='selected'";}?>>執行</option>
                  </select></td>
                </tr>
                <tr>
                  <td colspan="4" align="center" bgcolor="#9FC0E3"><input name="user" type="hidden" id="user" value="<?php echo $row_Recl['username'];?>" />
                    <input type="hidden" name="MM_update" value="form1" />
                    <input type="submit" name="button" id="button" value="儲存" />
                    <span class="style3" style="margin:0px;">
                      <input type="button" name="Submit3" value="回上一頁" onclick="window.history.back();" />
                    </span></td>
                </tr>
              </table>
            </form></td>
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