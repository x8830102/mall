<?php require_once('Connections/kg.php'); mysql_query("set names utf8");?>
<?php
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
//
mysql_select_db($database_kg, $kg);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1 && level >= 7");
$Reclu = mysql_query($query_Reclu, $kg) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
//
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . $_SERVER['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
 $mi=$HTTP_POST_VARS['mi'];$m_nick=$HTTP_POST_VARS['m_nick'];$m_passwd=$HTTP_POST_VARS['m_passwd'];  
	$update11="UPDATE memberdata SET m_nick='$m_nick', m_passwd='$m_passwd' WHERE m_id = '$mi'";
    mysql_select_db($database_kg, $kg);
    $Result11 = mysql_query($update11, $kg) or die(mysql_error());

  $insertGoTo = "mem_main.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
mysql_select_db($database_kg, $kg);$mi=$_GET['mi'];
$query_Recm = sprintf("SELECT * FROM memberdata WHERE m_id = '$mi'");
$Recm = mysql_query($query_Recm, $kg) or die(mysql_error());
$row_Recm = mysql_fetch_assoc($Recm);
$totalRows_Recm = mysql_num_rows($Recm);
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
.style24 {	color: #996633;
	font-size: 12px;
}
.style25 {font-size: 12px}
.style27 {	color: #FFFFFF;
	font-weight: bold;
}
.style28 {color: #F08FBA}
.style29 {color: #660099;
	font-weight: bold;
}
.style30 {font-family: "新細明體";
	font-size: 18px;
	font-weight: bold;
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
            <td><span class="style7"> <?php echo $row_Reclu['name'];?> 您好!</span> <span class="style8">&nbsp;&nbsp;&nbsp;登入帳號：<?php echo $row_Reclu['username'];?></span>&nbsp;&nbsp;【<a href="amss_pas.php">修改密碼</a>】</td>
            <td rowspan="2"><a href="mem_main.php"><img src="images/3.png" alt="回管理" title="回管理" width="50" height="53" border="0" /></a></td>
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
        <td height="350" colspan="2" align="center" valign="top"><table width="760" border="0" align="center" cellpadding="4" cellspacing="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#C9DEED"><span class="style30">編修會員密碼內容</span></td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="4" cellpadding="0">
                <tr valign="top">
                  <td><table width="98%" border="0" align="center" cellpadding="4" cellspacing="1" class="whiteBox">
                    <tr>
                      <td height="40" align="right" bgcolor="#C9DEED">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" bgcolor="#C9DEED"><form action="<?php echo $editFormAction; ?>" method="post" name="form1" class="style3" id="form1" style="margin:0px;">
                        <table width="100%" height="111" border="0" cellpadding="1" cellspacing="3">
                          <tr bgcolor="#80BD00">
                            <td height="15" bgcolor="#F08FBA"><p class="style27"><font size="2">一、帳號資料</font></p></td>
                            <td width="595" colspan="2" bgcolor="#F08FBA">&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td height="15" align="right" bgcolor="#F5DBE8"><font size="2" class="style24">帳號：</font></td>
                            <td colspan="2" bgcolor="#F5DBE8"><?php echo $row_Recm['card'];?></td>
                          </tr>
                          <tr bgcolor="#80BD00">
                            <td height="15" bgcolor="#F08FBA"><p class="style27"><font size="2">二、資料</font></p></td>
                            <td colspan="2" bgcolor="#F08FBA"><span class="style28"></span></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="15" align="right" bgcolor="#F5DBE8"><span class="style25">名稱：</span></td>
                            <td colspan="2" bgcolor="#F5DBE8"><input name="m_nick" type="text" id="m_nick" value="<?php echo $row_Recm['m_nick'];?>" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="15" align="right" bgcolor="#F5DBE8">密碼：</td>
                            <td colspan="2" bgcolor="#F5DBE8"><input name="m_passwd" type="text" id="m_passwd" value="<?php echo $row_Recm['m_passwd'];?>" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right" bgcolor="#F5DBE8">&nbsp;</td>
                            <td colspan="2" bgcolor="#F5DBE8">&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right" bgcolor="#F5DBE8">&nbsp;</td>
                            <td colspan="2" bgcolor="#F5DBE8">&nbsp;</td>
                          </tr>
                        </table>
                        <hr size="1" noshade="noshade" class="whiteBox" />
                        <span class="style3" style="margin:0px;"><span class="style3" style="margin:0px;">
                          <input name="mi" type="hidden" id="mi" value="<?php echo $mi;?>" />
                          <input name="MM_update" type="hidden" id="MM_update" value="form1" />
                          </span>
                          <input name="button2" type="submit" class="style29" id="button2" value="儲 存 資 料" />
                          </span>
                        <input type="button" name="Submit" value="回上一頁" onclick="window.history.back();" />
                        <br />
                        <br />
                      </form></td>
                    </tr>
                  </table></td>
                  <td width="1" bgcolor="#990000"><img src="images/spacer.gif" width="1" height="1" /></td>
                </tr>
              </table></td>
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