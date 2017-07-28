<?php require_once('Connections/connNews.php');mysql_query("set names utf8"); ?>
<?php
$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_RecNews = 10;
$pageNum_RecNews = 0;
if (isset($HTTP_GET_VARS['pageNum_RecNews'])) {
  $pageNum_RecNews = $HTTP_GET_VARS['pageNum_RecNews'];
}
$startRow_RecNews = $pageNum_RecNews * $maxRows_RecNews;

mysql_select_db($database_connNews, $connNews);
$query_RecNews = "SELECT * FROM newsdata ORDER BY news_time DESC";
$query_limit_RecNews = sprintf("%s LIMIT %d, %d", $query_RecNews, $startRow_RecNews, $maxRows_RecNews);
$RecNews = mysql_query($query_limit_RecNews, $connNews) or die(mysql_error());
$row_RecNews = mysql_fetch_assoc($RecNews);

if (isset($HTTP_GET_VARS['totalRows_RecNews'])) {
  $totalRows_RecNews = $HTTP_GET_VARS['totalRows_RecNews'];
} else {
  $all_RecNews = mysql_query($query_RecNews);
  $totalRows_RecNews = mysql_num_rows($all_RecNews);
}
$totalPages_RecNews = ceil($totalRows_RecNews/$maxRows_RecNews)-1;

$queryString_RecNews = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecNews") == false && 
        stristr($param, "totalRows_RecNews") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecNews = "&" . implode("&", $newParams);
  }
}
$queryString_RecNews = sprintf("&totalRows_RecNews=%d%s", $totalRows_RecNews, $queryString_RecNews);

$MM_paramName = ""; 

// *** Go To Record and Move To Record: create strings for maintaining URL and Form parameters
// create the list of parameters which should not be maintained
$MM_removeList = "&index=";
if ($MM_paramName != "") $MM_removeList .= "&".strtolower($MM_paramName)."=";
$MM_keepURL="";
$MM_keepForm="";
$MM_keepBoth="";
$MM_keepNone="";
// add the URL parameters to the MM_keepURL string
reset ($HTTP_GET_VARS);
while (list ($key, $val) = each ($HTTP_GET_VARS)) {
	$nextItem = "&".strtolower($key)."=";
	if (!stristr($MM_removeList, $nextItem)) {
		$MM_keepURL .= "&".$key."=".urlencode($val);
	}
}
// add the URL parameters to the MM_keepURL string
if(isset($HTTP_POST_VARS)){
	reset ($HTTP_POST_VARS);
	while (list ($key, $val) = each ($HTTP_POST_VARS)) {
		$nextItem = "&".strtolower($key)."=";
		if (!stristr($MM_removeList, $nextItem)) {
			$MM_keepForm .= "&".$key."=".urlencode($val);
		}
	}
}
// create the Form + URL string and remove the intial '&' from each of the strings
$MM_keepBoth = $MM_keepURL."&".$MM_keepForm;
if (strlen($MM_keepBoth) > 0) $MM_keepBoth = substr($MM_keepBoth, 1);
if (strlen($MM_keepURL) > 0)  $MM_keepURL = substr($MM_keepURL, 1);
if (strlen($MM_keepForm) > 0) $MM_keepForm = substr($MM_keepForm, 1);
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
          <td width="45"><img name="news_r1_c1" src="images/news_r1_c1.gif" width="45" height="38" border="0" alt=""></td>
          <td valign="bottom" background="images/news_r1_c10.gif">
<table width="100%" height="34" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td><img name="news_r2_c8" src="images/news_r2_c8.gif" width="99" height="19" border="0" alt=""></td>
                <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> Records <?php echo ($startRow_RecNews + 1) ?> to <?php echo min($startRow_RecNews + $maxRows_RecNews, $totalRows_RecNews) ?> of <?php echo $totalRows_RecNews ?> &nbsp;</font></td>
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
                      <td align="right"><font size="2"> [ <a href="newsAdd.php">新增新聞公告</a> 
                        ][ <a href="../../ai_main/ai_in.php">離開管理畫面</a> ]</font></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    
                    
                    
                    
                    
                    <tr>
                      <td> <?php if ($totalRows_RecNews > 0) { // Show if recordset not empty ?>
                        <table width="100%" border="0" cellpadding="4" cellspacing="1" class="box">
                          <tr valign="baseline" bgcolor="#990066">
                            <td width="100" height="20"><strong><font color="#FFFFFF" size="2">公告日期</font></strong></td>
                            <td height="20"><strong><font color="#FFFFFF" size="2">公告標題</font></strong></td>
                            <td width="80" height="20" align="center"><strong><font color="#FFFFFF" size="2">新聞編輯</font></strong></td>
                          </tr>
                          <?php do { ?>
                          <tr valign="baseline" bgcolor="#EEEEEE">
                            <td height="20"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_RecNews['news_time']; ?>&nbsp;</font></td>
                            <td height="20"><font color="#FF3300" size="-1" face="Verdana, Arial, Helvetica, sans-serif">[<?php echo $row_RecNews['news_type']; ?>]&nbsp;<strong><?php echo $row_RecNews['news_title']; ?></strong></font></td>
                            <td height="20" align="center"><font color="#666666" size="-1" face="Verdana, Arial, Helvetica, sans-serif">[ <a href="newsUpdate.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."news_id=".$row_RecNews['news_id'] ?>">修改</a> ]
                            [ <a href="newsDel.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."news_id=".$row_RecNews['news_id'] ?>">刪除</a> ] </font></td>
                          </tr>
                          <?php } while ($row_RecNews = mysql_fetch_assoc($RecNews)); ?>
                        </table>
                        <?php } // Show if recordset not empty ?></td>
                    </tr>
                  </table>
                  
                  
                  
                  
                  <?php if ($totalRows_RecNews == 0) { // Show if recordset empty ?>
                  <table width="100%" height="40" border="0" cellpadding="4" cellspacing="0">
                    <tr>
                      <td align="center"><font color="#990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>目前資料庫中沒有任何新聞公告的資料！</strong></font></td>
                    </tr>
                  </table>
                  <?php } // Show if recordset empty ?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>
                        <table border="0" width="50%" align="center">
                          <tr>
                            <td width="23%" align="center">
                              <?php if ($pageNum_RecNews > 0) { // Show if not first page ?>
                              <a href="<?php printf("%s?pageNum_RecNews=%d%s", $currentPage, 0, $queryString_RecNews); ?>"><img src="First.gif" border=0></a>
                              <?php } // Show if not first page ?>
                            </td>
                            <td width="31%" align="center">
                              <?php if ($pageNum_RecNews > 0) { // Show if not first page ?>
                              <a href="<?php printf("%s?pageNum_RecNews=%d%s", $currentPage, max(0, $pageNum_RecNews - 1), $queryString_RecNews); ?>"><img src="Previous.gif" border=0></a>
                              <?php } // Show if not first page ?>
                            </td>
                            <td width="23%" align="center">
                              <?php if ($pageNum_RecNews < $totalPages_RecNews) { // Show if not last page ?>
                              <a href="<?php printf("%s?pageNum_RecNews=%d%s", $currentPage, min($totalPages_RecNews, $pageNum_RecNews + 1), $queryString_RecNews); ?>"><img src="Next.gif" border=0></a>
                              <?php } // Show if not last page ?>
                            </td>
                            <td width="23%" align="center">
                              <?php if ($pageNum_RecNews < $totalPages_RecNews) { // Show if not last page ?>
                              <a href="<?php printf("%s?pageNum_RecNews=%d%s", $currentPage, $totalPages_RecNews, $queryString_RecNews); ?>"><img src="Last.gif" border=0></a>
                              <?php } // Show if not last page ?>
                            </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table> </td>
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
