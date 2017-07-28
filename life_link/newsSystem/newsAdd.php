<?php require_once('Connections/connNews.php'); mysql_query("set names utf8");?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_insert"])) && ($HTTP_POST_VARS["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO newsdata (news_time, news_type, news_title, news_editor, news_content) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($HTTP_POST_VARS['news_time'], "date"),
                       GetSQLValueString($HTTP_POST_VARS['news_type'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['news_title'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['news_editor'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['news_content'], "text"));

  mysql_select_db($database_connNews, $connNews);
  $Result1 = mysql_query($insertSQL, $connNews) or die(mysql_error());

  $insertGoTo = "newsAdmin.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<html>
<head>
<title>新聞公告系統</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Fireworks MX Dreamweaver MX target.  Created Wed Jan 29 10:17:38 GMT+0800 (￥x￥_?D·CRE?!) 2003-->
<style type="text/css">
<!--
a {
	text-decoration: none;
}
a:hover {
	color: #FF0000;
	text-decoration: underline;
}
a:link {
	font-weight: bold;
	color: #FF3300;
}
a:visited {
	font-weight: bold;
	color: #FF9900;
}
.box {
	border: 1px solid #990066;
}
-->
</style>
<style type="text/css">
<!--
form {
	margin: 0px;
}
-->
</style>
</head>
<body bgcolor="#ffffff">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr> 
          <td width="45"><img name="news_r1_c1" src="images/news_r1_c1.gif" width="45" height="38" border="0" alt=""></td>
          <td valign="bottom" background="images/news_r1_c10.gif">
<table width="100%" height="34" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td><img name="news_r2_c8" src="images/news_r2_c8.gif" width="99" height="19" border="0" alt=""></td>
                <td align="right"><font size="-1">[ <a href="newsAdmin.php">回管理主畫面</a> 
                  ]</font></td>
              </tr>
            </table></td>
          <td width="11"><img name="news_r1_c11" src="images/news_r1_c11.gif" width="11" height="38" border="0" alt=""></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="11" background="images/news_r4_c1.gif">&nbsp;</td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="7" height="8"><img name="news_r4_c2" src="images/news_r4_c2.gif" width="7" height="8" border="0" alt=""></td>
                <td background="images/news_r4_c3.gif"><img src="images/spacer.gif" width="1" height="8"></td>
              </tr>
              <tr> 
                <td height="8" background="images/news_r6_c2.gif">&nbsp;</td>
                <td style="word-break:break-all"><form method="POST" action="<?php echo $editFormAction; ?>" name="form1">
                    <table width="100%" border="0" cellspacing="0" cellpadding="4">
                      <tr> 
                        <td align="center"> <table width="100%" border="0" cellpadding="4" cellspacing="1" class="box">
                            <tr valign="baseline" bgcolor="#EEEEEE"> 
                              <td width="100" height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>新聞標題：</strong></font></td>
                              <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <input name="news_title" type="text" id="news_title">
                                </font></td>
                            </tr>
                            <tr valign="baseline" bgcolor="#EEEEEE"> 
                              <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>新聞類別：</strong></font></td>
                              <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <select name="news_type" id="news_type">
                                <option value="公告" selected>公告
                                <option value="更新">更新
                                <option value="活動">活動
                                <option value="其他">其他                                
                                                                </select>
                                </font></td>
                            </tr>
                            <tr valign="baseline" bgcolor="#EEEEEE"> 
                              <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>公告日期：</strong></font></td>
                              <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <input name="news_time" type="text" id="news_time" value="<?echo date("Y-m-d H:i:s")?>">
                                </font></td>
                            </tr>
                            <tr valign="baseline" bgcolor="#EEEEEE"> 
                              <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>編輯人：</strong></font></td>
                              <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <input name="news_editor" type="text" id="news_editor">
                                </font></td>
                            </tr>
                            <tr valign="baseline" bgcolor="#EEEEEE"> 
                              <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>內容：</strong></font></td>
                              <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <textarea name="news_content" cols="40" rows="5" id="news_content"></textarea>
                                </font></td>
                            </tr>
                          </table>
                          <hr> <input type="submit" name="Submit" value="新增新聞"> 
                          <input type="reset" name="Submit2" value="重設新聞"> <div align="center"></div></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1">
                </form></td>
              </tr>
            </table></td>
          <td width="11" background="images/news_r4_c11.gif">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr> 
          <td width="11"><img name="news_r8_c1" src="images/news_r8_c1.gif" width="11" height="26" border="0" alt=""></td>
          <td background="images/news_r8_c5.gif">&nbsp;</td>
          <td width="11"><img name="news_r8_c11" src="images/news_r8_c11.gif" width="11" height="26" border="0" alt=""></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
