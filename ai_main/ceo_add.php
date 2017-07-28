<?php require_once('Connections/kg.php');mysql_query("set names utf8"); ?>
<?php
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
//
$FF_flag="MM_insert";
if (isset($_POST[$FF_flag])) {
  $FF_dupKeyRedirect="ceo_add.php?errMsg=這個帳號已經有人申請，請重新輸入";
  $FF_dupKeyUsernameValue = $_POST["username"];
  $FF_dupKeySQL = "SELECT username FROM admin WHERE username='" . $FF_dupKeyUsernameValue . "'";
  mysql_select_db($database_kg, $kg);
  $FF_rsKey=mysql_query($FF_dupKeySQL, $kg) or die(mysql_error());
  if(mysql_num_rows($FF_rsKey) > 0) {
  // the username was found - can not add the requested username
  $FF_qsChar = "?";
  if (strpos($FF_dupKeyRedirect, "?")) $FF_qsChar = "&";
  $FF_dupKeyRedirect = $FF_dupKeyRedirect . $FF_qsChar . "requsername=" . $FF_dupKeyUsernameValue;
  header ("Location: $FF_dupKeyRedirect");
  exit;
  }
  mysql_free_result($FF_rsKey);
}
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  
  if ($_POST['see'] != "" && $_POST['sum'] != "") {
  if ($_POST['see'] == $_POST['sum']) {
  $name=$_POST['name'];$username=$_POST['username'];$passwd=$_POST['passwd'];$email=$_POST['email'];$phone=$_POST['phone'];
  mysql_select_db($database_kg, $kg);
  $insertCommand11="INSERT INTO admin (name, username, passwd, email, phone) VALUES ('$name', '$username', '$passwd', '$email', '$phone')"; 
  mysql_query($insertCommand11,$kg);
  
  $insertGoTo = "ceo_main.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
  } else {$_GET['errMsg'] = "驗證碼資料不對!!!";}
  } else {$_GET['errMsg'] = "資料空白不對!!!";}
}
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
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
.style25 {font-size: 12px}
.style26 {color: #FFFFFF}
.style27 {	color: #FFFFFF;
	font-weight: bold;
}
.style28 {color: #F08FBA}
.style30 {	font-size: 16px;
	font-weight: bold;
}
</style>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_setTextOfTextfield(objId,x,newText) { //v9.0
  with (document){ if (getElementById){
    var obj = getElementById(objId);} if (obj) obj.value = newText;
  }
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
        <td height="350" colspan="2" align="center" valign="top"><table width="760" border="0" align="center" cellpadding="4" cellspacing="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#D4E4F4"><span class="style30">新增管理者帳戶</span></td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="4" cellpadding="0">
                <tr valign="top">
                  <td><table width="98%" border="0" align="center" cellpadding="4" cellspacing="1" class="whiteBox">
                    <tr>
                      <td height="40" align="center" bgcolor="#D4E4F4"><span class="style26">
                        <?php /*start input_input script*/ if (isset($HTTP_GET_VARS['errMsg'])){ ?>
                        </span>
                        <table width="98%" border="0" align="center" cellpadding="4" cellspacing="1">
                          <tr valign="baseline" bgcolor="#CCCCCC">
                            <td width="40" align="center" bgcolor="#990000" class="style3"><span class="style26"><font size="2">注意：</font></span></td>
                            <td class="style3"><font size="2">「<?php echo $HTTP_GET_VARS['requsername']; ?>」<?php echo $HTTP_GET_VARS['errMsg']; ?>或 <a href="#" onclick="window.history.back();">回上一頁</a> 修改。 </font></td>
                          </tr>
                        </table>
                        <span class="style3">
                          <?php } /*end input_input script*/ ?>
                        </span></td>
                    </tr>
                    <tr>
                      <td align="center" bgcolor="#D4E4F4"><form action="<?php echo $editFormAction; ?>" method="post" name="form1" class="style3" id="form1" style="margin:0px;" onsubmit="YY_checkform('form1','username','#q','0','請輸入使用帳號。','name','#q','0','請輸入您的真實姓名。','phone','#q','0','請輸入您的行動電話。','email','#S','2','請輸入您的電子郵件或檢查電子郵件格式。','passwd','#passrecheck','6','請輸入您的密碼或您輸入的密碼二次不同。','passrecheck','#passwd','6','請再輸入一次密碼以供確認。');return document.MM_returnValue">
                        <hr size="1" noshade="noshade" class="whiteBox" />
                        <table width="100%" height="180" border="0" cellpadding="1" cellspacing="0">
                          <tr bgcolor="#80BD00">
                            <td width="321" height="20" bgcolor="#407CAE"><p class="style27"><font size="2">一、帳號資料</font></p></td>
                            <td height="20" colspan="2" bgcolor="#407CAE">&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td height="20" align="right" bgcolor="#F4FA3E"><font size="2">使用帳號：</font></td>
                            <td height="20" colspan="2" bgcolor="#F4FA3E"><font size="2">
                              <input name="username" type="text" id="username" size="18" maxlength="16" />
                              *</font></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="20" align="right" bgcolor="#F4FA3E"><font size="2">密碼：</font></td>
                            <td height="20" colspan="2" bgcolor="#F4FA3E"><font size="2">
                              <input name="passwd" type="password" id="passwd" value="1234" size="18" maxlength="10" />
                              * 預設為「1234」<br />
                              <font size="2"><font size="1" face="Geneva, Arial, Helvetica, sans-serif">請填入10個字元</font></font><font size="1" face="Geneva, Arial, Helvetica, sans-serif">以內的英文字母、數字、以及各種符號組合，但不含空白鍵、及「&quot;」。</font></font></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="20" align="right" bgcolor="#F4FA3E"><font size="2">確認密碼：</font></td>
                            <td height="20" colspan="2" bgcolor="#F4FA3E"><font size="1" face="Geneva, Arial, Helvetica, sans-serif">
                              <input name="passrecheck" type="password" id="passrecheck" value="1234" size="18" maxlength="10" />
                              </font><font size="2"> *</font><font size="1" face="Geneva, Arial, Helvetica, sans-serif"><br />
                                再輸入一次密碼</font></td>
                          </tr>
                          <tr bgcolor="#80BD00">
                            <td height="20" bgcolor="#407CAE"><p class="style27"><font size="2">二、個人資料</font></p></td>
                            <td height="20" colspan="2" bgcolor="#407CAE"><span class="style28"></span></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="20" align="right" bgcolor="#F4FA3E"><span class="style25">名稱：</span></td>
                            <td height="20" colspan="2" bgcolor="#F4FA3E"><font size="2">
                              <input name="name" type="text" id="name" size="18" />
                              * </font></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="20" align="right" bgcolor="#F4FA3E">聯絡電話：</td>
                            <td height="20" colspan="2" bgcolor="#F4FA3E"><font size="2">
                              <input name="phone" type="text" id="phone" size="18" />
                              * </font></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="20" align="right" bgcolor="#F4FA3E"><span class="style25">E-mail：</span></td>
                            <td height="20" colspan="2" bgcolor="#F4FA3E"><font size="2">
                              <input name="email" type="text" id="email" value="xx@xx.xx" />
                              * <br />
                              <font size="2"><font size="1" face="Geneva, Arial, Helvetica, sans-serif">請確定此電子郵件為可使用狀態，以方便未來系統使用，如補寄會員密碼信。</font></font></font></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="20" align="right" valign="top" bgcolor="#F4FA3E">&nbsp;</td>
                            <td width="191" height="20" valign="top" bgcolor="#F4FA3E"><input name="sum" type="text" id="sum" onfocus="MM_setTextOfTextfield('sum','','')" value="請輸入右方數字" />
                              <input name="see" type="hidden" id="see" value="<?php echo $sum;?>" /></td>
                            <td width="408" valign="top" bgcolor="#F4FA3E"><table width="60" border="1" cellpadding="0" cellspacing="0" bordercolor="#006600">
                              <tr>
                                <td align="center"><?php echo $sum;?></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
                        <hr size="1" noshade="noshade" class="whiteBox" />
                        <input type="submit" name="Submit" value="送出申請" />
                        <span class="style3" style="margin:0px;"><span class="style3" style="margin:0px;"><span class="style3" style="margin:0px;">
                          <input type="reset" name="Submit2" value="重設資料" />
                          </span></span></span>
                        <input type="button" name="Submit3" value="回上一頁" onclick="window.history.back();" />
                        <input type="hidden" name="MM_insert" value="form1" />
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