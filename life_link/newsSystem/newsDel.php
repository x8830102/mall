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

if ((isset($HTTP_GET_VARS['news_id'])) && ($HTTP_GET_VARS['news_id'] != "") && (isset($HTTP_GET_VARS['delsure']))) {
  $deleteSQL = sprintf("DELETE FROM newsdata WHERE news_id=%s",
                       GetSQLValueString($HTTP_GET_VARS['news_id'], "int"));

  mysql_select_db($database_connNews, $connNews);
  $Result1 = mysql_query($deleteSQL, $connNews) or die(mysql_error());

  $deleteGoTo = "newsAdmin.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_RecNews = "1";
if (isset($HTTP_GET_VARS['news_id'])) {
  $colname_RecNews = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['news_id'] : addslashes($HTTP_GET_VARS['news_id']);
}
mysql_select_db($database_connNews, $connNews);
$query_RecNews = sprintf("SELECT * FROM newsdata WHERE news_id = %s", $colname_RecNews);
$RecNews = mysql_query($query_RecNews, $connNews) or die(mysql_error());
$row_RecNews = mysql_fetch_assoc($RecNews);
$totalRows_RecNews = mysql_num_rows($RecNews);
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
                <td style="word-break:break-all"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                      <td><font color="#FF0000" size="2"><strong>** 您確定要刪除下列資料？</strong></font></td>
                    </tr>
                  </table>
                  <form name="form1">
                    
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="4">
                      
                      
                      <tr> 
                        <td align="center"> 
                          <table width="100%" border="0" cellpadding="4" cellspacing="1" class="box">
                            <tr valign="baseline" bgcolor="#EEEEEE"> 
                              <td width="100" height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>新聞標題：</strong></font></td>
                              <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<?php echo $row_RecNews['news_title']; ?> 
                                </font></td>
                            </tr>
                            <tr valign="baseline" bgcolor="#EEEEEE"> 
                              <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>新聞類別：</strong></font></td>
                              <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<?php echo $row_RecNews['news_type']; ?> 
                                </font></td>
                            </tr>
                            <tr valign="baseline" bgcolor="#EEEEEE"> 
                              <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>公告日期：</strong></font></td>
                              <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<?php echo $row_RecNews['news_time']; ?> 
                                </font></td>
                            </tr>
                            <tr valign="baseline" bgcolor="#EEEEEE"> 
                              <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>編輯人：</strong></font></td>
                              <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<?php echo $row_RecNews['news_editor']; ?> 
                                </font></td>
                            </tr>
                            <tr valign="baseline" bgcolor="#EEEEEE"> 
                              <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>內容：</strong></font></td>
                              <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<?php echo $row_RecNews['news_content']; ?> 
                                </font></td>
                            </tr>
                          </table>
                          <hr>
                          <input name="delsure" type="hidden" id="delsure" value="1">
                          <input name="news_id" type="hidden" id="news_id" value="<?php echo $row_RecNews['news_id']; ?>">
                          <input type="submit" name="Submit" value="確定刪除">
                          <input name="backurl" type="button" id="backurl" onClick="window.history.back()" value="回上一頁">                          
                          <div align="center"></div></td>
                      </tr>
                    </table>
                  
                    
                    
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
<?php
mysql_free_result($RecNews);
?>
