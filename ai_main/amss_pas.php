<?php require_once('Connections/sc.php'); ?>
<?php
mysql_query("set names utf8");
session_start();$err="";
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
//
mysql_select_db($database_sc, $sc);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1");
$Reclu = mysql_query($query_Reclu, $sc) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
//
$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form2")) {
  if ($_POST['n_pas'] == $_POST['r_pas']) {
  mysql_select_db($database_sc, $sc);$o_pas=$_POST['o_pas'];$us=$_POST['user'];
  $query_Recr = sprintf("SELECT * FROM admin WHERE username = '$us' && passwd = '$o_pas'");
  $Recr = mysql_query($query_Recr, $sc) or die(mysql_error());
  $row_Recr = mysql_fetch_assoc($Recr);
  $totalRows_Recr = mysql_num_rows($Recr);
  if ($totalRows_Recr != 0) {
  /*$updateSQL = sprintf("UPDATE admin SET passwd=%s WHERE username=%s",
                       GetSQLValueString($HTTP_POST_VARS['r_pas'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['user'], "text"));

  mysql_select_db($database_ms, $ms);
  $Result1 = mysql_query($updateSQL, $ms) or die(mysql_error());
*/
$c=$HTTP_POST_VARS['user'];$new_pas=$HTTP_POST_VARS['r_pas'];
$update12="UPDATE admin SET passwd='$new_pas' WHERE username='$c'";
  mysql_select_db($database_sc, $sc);
  $Result12 = mysql_query($update12, $sc) or die(mysql_error());

  $j="pass";$note="您巳完成密码更新。";
  } else {$j="pass";$note="您输入的旧密码不对。";}} else {$j="pass";$note="您输入的密码二次不同。";}
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personnel Bonus System</title>
<style type="text/css">
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
            <td style="font-size: 24px">變 更 密 碼 </td>
            <td rowspan="2"><a href="ai_in.php"><img src="images/3.png" alt="回主頁" title="回主頁" width="50" height="53" border="0" /></a></td>
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
        <td height="350" colspan="2" align="center" valign="middle"><?php if ($j != "pass") {?>
          <form id="form2" name="form2" method="post" action="<?php echo $editFormAction; ?>">
            <table width="500" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td align="right" style="color: #000"><span class="style20">登入帐号：</span></td>
                <td align="left" style="color: #000"><span class="style20"><?php echo $row_Reclu['username'];?></span></td>
              </tr>
              <tr>
                <td width="234" align="right" style="color: #000"><span class="style20">输入旧密码：</span></td>
                <td width="251" align="left" style="color: #000"><input name="o_pas" type="text" id="o_pas" /></td>
              </tr>
              <tr>
                <td align="right" style="color: #000"><span class="style20">输入新密码：</span></td>
                <td align="left" style="color: #000"><input name="n_pas" type="text" id="n_pas" /></td>
              </tr>
              <tr>
                <td align="right" style="color: #000"><span class="style20">再确认一次：</span></td>
                <td align="left" style="color: #000"><input name="r_pas" type="text" id="r_pas" /></td>
              </tr>
              <tr>
                <td align="right" style="color: #000"><span class="style20">
                  <input name="user" type="hidden" id="user" value="<?php echo $row_Reclu['username'];?>" />
                  <input type="hidden" name="MM_update" value="form2" />
                </span></td>
                <td align="left" style="color: #000"><input name="button2" type="submit" id="button2" value="送出" /></td>
              </tr>
            </table>
          </form>
          <?php } else {echo $note;}?></td>
      </tr>
      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>