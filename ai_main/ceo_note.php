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
mysql_select_db($database_kg, $kg);$c=$_GET['c'];
$query_Recm = sprintf("SELECT * FROM admin WHERE username = '$c'");
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
.style30 {	font-family: "新細明體";
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
                <td align="center" bgcolor="#B1CCE6"><span class="style30">管理者內容</span></td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="4" cellpadding="0">
                <tr valign="top">
                  <td><table width="98%" border="0" align="center" cellpadding="4" cellspacing="1" class="whiteBox">
                    <tr>
                      <td height="40" align="right" bgcolor="#B1CCE6"><a href="ceo_fix.php?c=<?php echo $row_Recm['username'];?>">編輯內容</a></td>
                    </tr>
                    <tr>
                      <td align="center" bgcolor="#B1CCE6"><form action="<?php echo $editFormAction; ?>" method="post" name="form1" class="style3" id="form1" style="margin:0px;" onsubmit="YY_checkform('form1','m_username','#q','0','請輸入使用帳號。','m_name','#q','0','請輸入您的真實姓名。','m_callphone','#q','0','請輸入您的行動電話。','m_fuser','#q','0','請輸入您的介紹人行動電話。','m_address','#q','0','請輸入您的地址。','m_birthday','#^\([0-9]{4}\)\\-\([0-9][0-9]\)\\-\([0-9][0-9]\)$#3#2#1','3','請輸入您的生日，格式YYY-MM-DD。','m_email','#S','2','請輸入您的電子郵件或檢查電子郵件格式。','m_passwd','#passrecheck','6','請輸入您的密碼或您輸入的密碼二次不同。','passrecheck','#m_passwd','6','請再輸入一次密碼以供確認。');return document.MM_returnValue">
                        <table width="100%" height="111" border="0" cellpadding="1" cellspacing="3">
                          <tr bgcolor="#80BD00">
                            <td height="15" bgcolor="#F08FBA"><p class="style27"><font size="2">一、帳號資料</font></p></td>
                            <td width="595" colspan="2" bgcolor="#F08FBA">&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td height="15" align="right" bgcolor="#F5DBE8"><font size="2" class="style24">帳號：</font></td>
                            <td colspan="2" bgcolor="#F5DBE8"><?php echo $row_Recm['username'];?></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="15" align="right" bgcolor="#F5DBE8"><font size="2" class="style24">密碼：</font></td>
                            <td colspan="2" bgcolor="#F5DBE8"><?php echo $row_Recm['passwd'];?></td>
                          </tr>
                          <tr bgcolor="#80BD00">
                            <td height="15" bgcolor="#F08FBA"><p class="style27"><font size="2">二、資料</font></p></td>
                            <td colspan="2" bgcolor="#F08FBA"><span class="style28"></span></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="15" align="right" bgcolor="#F5DBE8">名稱：</td>
                            <td colspan="2" bgcolor="#F5DBE8"><?php echo $row_Recm['name'];?></td>
                          </tr>
                          <tr valign="baseline">
                            <td height="15" align="right" bgcolor="#F5DBE8">聯絡電話：</td>
                            <td colspan="2" bgcolor="#F5DBE8"><?php echo $row_Recm['phone'];?></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right" bgcolor="#F5DBE8"><span class="style25">E-mail：</span></td>
                            <td colspan="2" bgcolor="#F5DBE8"><?php echo $row_Recm['email'];?></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right" bgcolor="#F5DBE8">地址：</td>
                            <td colspan="2" bgcolor="#F5DBE8"><?php echo $row_Recm['addr'];?></td>
                          </tr>
                        </table>
                        <hr size="1" noshade="noshade" class="whiteBox" />
                        <input type="button" name="Submit3" value="回上一頁" onclick="self.location.href='ceo_main.php'" />
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