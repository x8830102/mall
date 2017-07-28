<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
mysql_select_db($database_sc, $sc);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1 ");
$Reclu = mysql_query($query_Reclu, $sc) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
//
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}
else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
  $ip=$_SERVER['REMOTE_ADDR'];
}
$now_datetime=date("Y/m/d H:i:s");
//

//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//
//
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecProduct = 10;
$pageNum_RecProduct = 0;
if (isset($_GET['pageNum_RecProduct'])) {
  $pageNum_RecProduct = $_GET['pageNum_RecProduct'];
}
$startRow_RecProduct = $pageNum_RecProduct * $maxRows_RecProduct;

mysql_select_db($database_sc, $sc);$bsn="boss";
$query_RecProduct = "SELECT * FROM g_cash WHERE cout = 0 ORDER BY id DESC";// 
$query_limit_RecProduct = sprintf("%s LIMIT %d, %d", $query_RecProduct, $startRow_RecProduct, $maxRows_RecProduct);
$RecProduct = mysql_query($query_limit_RecProduct, $sc) or die(mysql_error());
$row_RecProduct = mysql_fetch_assoc($RecProduct);

if (isset($_GET['totalRows_RecProduct'])) {
  $totalRows_RecProduct = $_GET['totalRows_RecProduct'];
} else {
  $all_RecProduct = mysql_query($query_RecProduct);
  $totalRows_RecProduct = mysql_num_rows($all_RecProduct);
}
$totalPages_RecProduct = ceil($totalRows_RecProduct/$maxRows_RecProduct)-1;

$queryString_RecProduct = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecProduct") == false && 
        stristr($param, "totalRows_RecProduct") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecProduct = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecProduct = sprintf("&totalRows_RecProduct=%d%s", $totalRows_RecProduct, $queryString_RecProduct);
//
$r_total=0;
mysql_select_db($database_sc, $sc);
$query_Recoc = sprintf("SELECT * FROM g_cash WHERE cout = 0 ORDER BY id DESC");
$Recoc = mysql_query($query_Recoc, $sc) or die(mysql_error());
$row_Recoc = mysql_fetch_assoc($Recoc);
$totalRows_Recoc = mysql_num_rows($Recoc);
if ($totalRows_Recoc != 0) {
	do {$r_total+=$row_Recoc['cin'];} while ($row_Recoc = mysql_fetch_assoc($Recoc));
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Centre</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E8EFF7;
}
.v1 {
	font-size:28px;
}
.profile2 {	border-radius: 20%;
	border:1px solid #0028E9;
	height: 35px;	
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style12 {font-size: 12px;
	line-height: 20px;
	word-spacing: 1px;
	letter-spacing: 1px;
}
.style20 {color: #F78A18; }
.style171 {font-size: 22px; line-height: 20px; word-spacing: 1px; letter-spacing: 1px; }
.style181 {font-size: 22px; line-height: 20px; word-spacing: 1px; letter-spacing: 1px; color: #0000FF; }
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
            <td><span class="style7">
              <?php echo $row_Reclu['name'];?>
您好!</span> <span class="style8">&nbsp;&nbsp;&nbsp;登入帳號：<?php echo $row_Reclu['username'];?></span>&nbsp;&nbsp;</td>
            <td rowspan="2"><a href="ai_in.php"><img src="images/3.png" alt="登出" title="登出" width="50" height="53" border="0" /></a></td>
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
        <td colspan="2"><table width="100" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='r_cash.php'" value="紅利積分" /></td>
            <td ><input name="Submit" type="button" class="style181" onclick="window.location='g_cash.php'" value="消費積分" /></td>
            <td ><input name="Submit" type="button" class="style171" onclick="window.location='c_cash.php'" value="串串積分" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="550" colspan="2" align="center" valign="top"><table width="100%" border="0" cellspacing="15" cellpadding="0">
          <tr>
            <td width="39%" valign="top"><hr /></td>
          </tr>
          <tr>
            <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" class="v1">紅利積分</td>
          </tr>
          <tr>
            <td valign="top"><table width="800" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#55AAFF">
              <tr>
                <td height="35" colspan="3" align="center" bgcolor="#55AAFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>發出統計： <? echo number_format($r_total, 0, '.' ,',');?></td>
                    <td align="right"><!--<table width="200" border="0" align="right" cellpadding="0" cellspacing="10">
                      <tr>
                        <td width="180" height="25" align="center" bgcolor="#FFFFFF"><a href="oc_save.php">儲值匯出</a></td>
                      </tr>
                    </table>--></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="170" height="35" align="center" bgcolor="#FFFFFF">日期</td>
                <td width="120" align="center" bgcolor="#FFFFFF">積分</td>
                <td width="290" align="center" bgcolor="#FFFFFF">摘要</td>
              </tr>
              <?php $coi=0;if ($totalRows_RecProduct != 0) {do {?>
              <tr>
                <td bgcolor="<?php if ($coi == 0) {echo "#E8EFF7";} else {echo "#55AAFF";}?>"><?php echo $row_RecProduct['date'];?>  <?php echo $row_RecProduct['time'];?></td>
                <td bgcolor="<?php if ($coi == 0) {echo "#E8EFF7";} else {echo "#55AAFF";}?>"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td align="right"><?php echo $row_RecProduct['cin']+0;?></td>
                    </tr>
                </table></td>
                <td bgcolor="<?php if ($coi == 0) {echo "#E8EFF7";} else {echo "#55AAFF";}?>">* <?php echo $row_RecProduct['note'];?></td>
              </tr>
              <?php if ($coi == 0) {$coi=1;} else {$coi=0;}} while ($row_RecProduct = mysql_fetch_assoc($RecProduct)); }?>
            </table></td>
          </tr>
          <tr>
            <td valign="top"><hr></td>
          </tr>
          <tr>
            <td valign="top"><table border="0" width="50%" align="center">
              <tr>
                <td width="23%" align="center" class="style12"><?php if ($pageNum_RecProduct > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_RecProduct=%d%s", $currentPage, 0, $queryString_RecProduct); ?>" class="style20"><img src="../cht/topb/1-6-1.png" width="50" border="0" /></a>
                  <?php } // Show if not first page ?></td>
                <td width="31%" align="center" class="style12"><?php if ($pageNum_RecProduct > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_RecProduct=%d%s", $currentPage, max(0, $pageNum_RecProduct - 1), $queryString_RecProduct); ?>" class="style20"><img src="../cht/topb/1-6-3.png" width="50" border="0" /></a>
                  <?php } // Show if not first page ?></td>
                <td width="31%" align="center" class="style12"><table width="40" border="0" cellspacing="3" cellpadding="0">
                  <tr>
                    <?php $pag=ceil($totalRows_RecProduct/10);$pai=1;$pb=0;while ($pag != 0) {?>
                    <td width="40" align="center" style="color: #FC0"><a href="oc_main.php?pageNum_RecProduct=<?php echo $pb;?>&amp;ap=<?php echo $ceo;?>"><?php echo $pai,".";?></a></td>
                    <?php $pag--;$pai++;$pb++;}?>
                  </tr>
                </table></td>
                <td width="23%" align="center" class="style12"><?php if ($pageNum_RecProduct < $totalPages_RecProduct) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_RecProduct=%d%s", $currentPage, min($totalPages_RecProduct, $pageNum_RecProduct + 1), $queryString_RecProduct); ?>"><img src="../cht/topb/1-6-4.png" width="50" border="0" /></a>
                  <?php } // Show if not last page ?></td>
                <td width="23%" align="center" class="style12"><?php if ($pageNum_RecProduct < $totalPages_RecProduct) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_RecProduct=%d%s", $currentPage, $totalPages_RecProduct, $queryString_RecProduct); ?>"><img src="../cht/topb/1-6-2.png" width="50" border="0" /></a>
                  <?php } // Show if not last page ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><table border="0" align="center">
          <tr>
            <td><span class="style17"><span class="style14">Copyright(C)2016 版權所有. All rights   reserved.&nbsp;&nbsp;    本站建議使用 Internet Explorer 瀏覽器 最佳瀏覽畫面1024*768</span><span class="style14"> <a href="http://laiwii.com/0986002868" target="_blank"> 昇恫資訊 製作設計</a></span>.</span></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>