<?php require_once('Connections/kg.php'); ?>
<?php
session_start();

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER)) {
  $editFormAction .= "?" . $_SERVER['QUERY_STRING'];
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
if ($_POST['see'] != "" && $_POST['sum'] != "") {
if ($_POST['see'] == $_POST['sum']) {
$user = $_POST['user'];$pass = $_POST['pass'];$fm = $_POST['sum'];$fe = $_POST['see'];

mysql_select_db($database_kg, $kg);
$query_Recf = sprintf("SELECT * FROM admin WHERE username = '$user' && passwd = '$pass' && at=1");
$Recf = mysql_query($query_Recf, $kg) or die(mysql_error());
$row_Recf = mysql_fetch_assoc($Recf);
$totalRows_Recf = mysql_num_rows($Recf);//echo $totalRows_Recf,"-",$fm,"-",$fe;exit;
if ($totalRows_Recf != 0 && $fm == $fe) {//echo "ok";exit;
$_SESSION['ceo'] = $row_Recf['username'];
$_SESSION['MM_Username'] = $row_Recf['user'];
header(sprintf("Location: ai_in.php"));
exit;
} else {$a = "資料不對!!!";}
}
}}
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>行政管理</title>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
}
.style2 {font-weight: bold}
.style14 {	font-size: 12px;
	font-family: "新細明體";
	color: #999999;
}
.style15 {font-size: 12px;
	color: #666666;
	font-weight: bold;
}
body {
	background-image: url(../ms/a_pic/1-2.png);
	background-repeat: repeat;
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table border="0" align="center">
      <tr>
        <td height="147"><table width="970" height="83" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="300" valign="top" background="images/csf_t2.png"><form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
      <p>&nbsp;</p>
      <table width="722" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="474" background="images/1.png"><table width="300" border="0" cellpadding="0" cellspacing="5">
            <tr>
              <td height="35" align="right"><span class="style2">管理者帳號：</span></td>
              <td width="195"><input name="user" type="text" id="user" size="16" autocomplete="off" /></td>
            </tr>
            <tr>
              <td height="35" align="right"><span class="style2">管理者密碼：</span></td>
              <td><input name="pass" type="password" id="pass" size="16" autocomplete="off" /></td>
            </tr>
            <tr>
              <td height="35" align="right">&nbsp;</td>
              <td><table width="60" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#006600">
                <tr>
                  <td align="center"><?php echo $sum;?></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td width="149" height="35" align="right" class="style2">檢驗號碼：</td>
              <td><input name="sum" type="text" id="sum" size="16" autocomplete="off" /></td>
            </tr>
            <tr>
              <td height="35" align="right" class="style2"><span style="margin:0px;">
              <input type="hidden" name="MM_insert" value="form1" />
              </span>
                <input name="see" type="hidden" id="see" value="<?php echo $sum;?>" /></td>
              <td><input name="button" type="submit" class="style2" id="button" value="送出管理者驗證" /></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><span class="style2"><?php echo $a;?></span></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
            </form></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center"><span class="style15"><span class="style14">Copyright(C)2016 版權所有. All rights   reserved.&nbsp;&nbsp; </span></span></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
