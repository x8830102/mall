<?php require_once('Connections/connNews.php'); mysql_query("set names utf8");?>
<?php
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
</head>
<body bgcolor="#ffffff">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr> 
          <td width="45">&nbsp;</td>
          <td valign="bottom" background="images/news_r1_c10.gif">
<table width="100%" height="34" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
            </table></td>
          <td width="11">&nbsp;</td>
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
                      <td><table width="100%" border="0" cellpadding="4" cellspacing="1" class="box">
                          <tr valign="baseline" bgcolor="#EEEEEE"> 
                            <td width="100" height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>新聞標題：</strong></font></td>
                            <td height="20"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&nbsp;[<?php echo $row_RecNews['news_type']; ?>]</strong> 
                              <strong><font size="3"><?php echo $row_RecNews['news_title']; ?></font></strong></font></td>
                          </tr>
                          <tr valign="baseline" bgcolor="#EEEEEE"> 
                            <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>公告時間：</strong></font></td>
                            <td height="20"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<?php echo $row_RecNews['news_time']; ?></font></td>
                          </tr>
                          <tr valign="baseline" bgcolor="#EEEEEE"> 
                            <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>編輯人：</strong></font></td>
                            <td height="20"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<?php echo $row_RecNews['news_editor']; ?></font></td>
                          </tr>
                          <tr valign="baseline" bgcolor="#EEEEEE"> 
                            <td height="20" align="right" bgcolor="#990099"><font color="#FFFFFF" size="2"><strong>新聞內容：</strong></font></td>
                            <td height="20"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<?php echo nl2br(htmlspecialchars($row_RecNews['news_content'])); ?></font></td>
                          </tr>
                        </table>
                        <hr>
                        <div align="center"><font size="2"><!--[ <a href="news.php">回主畫面</a> 
                          ]--></font></div></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="11" background="images/news_r4_c11.gif">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr> 
          <td width="11">&nbsp;</td>
          <td background="images/news_r8_c5.gif">&nbsp;</td>
          <td width="11">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($RecNews);
?>
