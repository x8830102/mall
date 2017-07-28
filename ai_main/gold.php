<?php require_once('Connections/kg.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();

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
$now_datetime=date("Y/m/d H:i:s");$sys_datetime=date("Y-m-d H:i:s");$admin="sys";$sysnote="登入後台管理";
mysql_select_db($database_kg, $kg);
$insertCommand3="INSERT INTO main_ip (ip, admin, datetime, note, name, nick, number, card) VALUES ('$ip', '$admin', '$sys_datetime', '$sysnote', '$name', '$nick', '$mem_number', '$card')"; 
mysql_query($insertCommand3,$kg);
//
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['number'] = NULL;
  unset($_SESSION['number']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
//

//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//
//
$mem_number=$_GET['n'];//echo $mem_number;
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecProduct = 31;
$pageNum_RecProduct = 0;
if (isset($_GET['pageNum_RecProduct'])) {
  $pageNum_RecProduct = $_GET['pageNum_RecProduct'];
}
$startRow_RecProduct = $pageNum_RecProduct * $maxRows_RecProduct;

mysql_select_db($database_kg, $kg);
$query_RecProduct = "SELECT * FROM gold_sum WHERE number = '$mem_number' ORDER BY id DESC";// 
$query_limit_RecProduct = sprintf("%s LIMIT %d, %d", $query_RecProduct, $startRow_RecProduct, $maxRows_RecProduct);
$RecProduct = mysql_query($query_limit_RecProduct, $kg) or die(mysql_error());
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
mysql_select_db($database_kg, $kg);
$query_Recg = sprintf("SELECT * FROM memberdata WHERE number = '$mem_number'");
$Recg = mysql_query($query_Recg, $kg) or die(mysql_error());
$row_Recg = mysql_fetch_assoc($Recg);
$totalRows_Recg = mysql_num_rows($Recg);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Finemetal AG</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin:0;
	padding:0;
	background-image: url(top/1.jpg);
	background-repeat: repeat;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
.profile21 {border-radius: 20%;
	border:1px solid #0028E9;
	height: 35px;	
}
.style3 {color: #996633}
.v1 {	font-size:28px;
}
.v2 {	font-size:28px;
	text-align:right;
}
.v3 {	border-radius: 0%;
	border:1px solid #0028E9;
	height: 30px;
	font-size:25px;
	text-align:center;
}
</style>
<script>
var isShow = false;
function change() {
	if(!isShow) {
		isShow = true;
		document.getElementById('d1').style.display='';
		document.getElementById('a2').setAttribute('src', '../cht/images/5-2.png');//innerText = "<img src='images/5-2.png'>";//document.write('<img src="images/logo.png">');
	}
	else {
		isShow = false;
		document.getElementById('d1').style.display='none';
		document.getElementById('a2').setAttribute('src', '../cht/images/5-1.png');
	}			
}
</script>
<style type="text/css">
.style12 {font-size: 12px;
	line-height: 20px;
	word-spacing: 1px;
	letter-spacing: 1px;
}
.style20 {color: #F78A18; }
</style>
<style type="text/css">
a:link {
	color: #FFF;
}
a:visited {
	color: #FFF;
}
a:hover {
	color: #FFF;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="360" valign="top" id="d1" style="display: none"><iframe  src="mem_sys.php?n=<?php echo $mem_number;?>" name="sys" width="360" height="1000" marginwidth="0" marginheight="0" scrolling="No" frameborder="0"  id="mem_sys"> </iframe></td>
    <td valign="top" background="../cht/top/1.jpg"><table width="100%" border="0" cellspacing="10" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="5%"><a id="a1" href="javascript:;" onclick="change()"><img id="a2" src="../cht/images/5-1.png" width="58" height="35" border="0" /></a></td>
            <td width="84%" valign="bottom"><table width="950" border="0" cellspacing="0" cellpadding="0" background="images/b10.png">
              <tr>                </tr>
              </table>
              <span style="color: #FFF">ID : <?php echo $row_Recg['card']," | ",$row_Recg['m_nick'];?></span>
              <table width="950" border="0" cellspacing="0" cellpadding="0" background="images/b10.png">
                <tr>                </tr>
              </table>
              <table width="950" border="0" cellspacing="0" cellpadding="0" background="images/b10.png">
                <tr>                </tr>
                </table></td>
            <td width="11%" align="right"><a href="mem_main.php"><img src="images/3.png" alt="回管理" title="回管理" width="50" height="53" border="0" /></a></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10"><hr></td>
      </tr>
      <tr>
        <td><table width="900" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="color: #FFF">&nbsp;</td>
          </tr>
          </table></td>
      </tr>
      <tr>
        <td><table width="1000" border="1" cellspacing="0" cellpadding="0" bordercolor="#996600">
          <tr>
            <td width="100" height="30" align="center" bgcolor="#996600" style="color: #FFF">日期</td>
            <td width="100" align="center" bgcolor="#996600" style="color: #FFF">推薦奖</td>
            <td width="100" align="center" bgcolor="#996600" style="color: #FFF">满局奖</td>
            <td width="100" align="center" bgcolor="#996600" style="color: #FFF">領導獎</td>
            <td width="100" align="center" bgcolor="#996600" style="color: #FFF">業績分紅</td>
            </tr>
          <?php $coi=0;if ($totalRows_RecProduct != 0) {do {$g_total=0;?><tr>
            <td height="30" align="center" style="color: #FFF"><?php echo $row_RecProduct['year'],"/",$row_RecProduct['moom'],"/",$row_RecProduct['day'];?></td>
            <td align="center" style="color: #FFF"><a href="gold_note.php?lv=1&amp;y=<?php echo $row_RecProduct['year'];?>&amp;m=<?php echo $row_RecProduct['moom'];?>&amp;d=<?php echo $row_RecProduct['day'];?>">
              <?php $g_total=$g_total+$row_RecProduct['level1'];echo $row_RecProduct['level1'];?>
            </a></td>
            <td align="center" style="color: #FFF"><a href="gold_note.php?lv=2&amp;y=<?php echo $row_RecProduct['year'];?>&amp;m=<?php echo $row_RecProduct['moom'];?>&amp;d=<?php echo $row_RecProduct['day'];?>">
              <?php $g_total=$g_total+$row_RecProduct['level2'];echo $row_RecProduct['level2'];?>
            </a></td>
            <td align="center" style="color: #FFF"><a href="gold_note.php?lv=3&amp;y=<?php echo $row_RecProduct['year'];?>&amp;m=<?php echo $row_RecProduct['moom'];?>&amp;d=<?php echo $row_RecProduct['day'];?>">
              <?php $g_total=$g_total+$row_RecProduct['level3'];echo $row_RecProduct['level3'];?>
            </a></td>
            <td align="center" style="color: #FFF"><a href="gold_note.php?lv=4&amp;y=<?php echo $row_RecProduct['year'];?>&amp;m=<?php echo $row_RecProduct['moom'];?>&amp;d=<?php echo $row_RecProduct['day'];?>">
              <?php $g_total=$g_total+$row_RecProduct['level4'];echo $row_RecProduct['level4'];?>
            </a></td>
            </tr>
          <?php if ($coi == 0) {$coi=1;} else {$coi=0;}} while ($row_RecProduct = mysql_fetch_assoc($RecProduct)); } else {echo "no data";}?>
        </table></td>
      </tr>
      <tr>
        <td><table width="900" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" style="color: #FFF"><table border="0" width="50%" align="center">
              <tr>
                <td width="23%" align="center" class="style12"><?php if ($pageNum_RecProduct > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_RecProduct=%d%s", $currentPage, 0, $queryString_RecProduct); ?>" class="style20"><img src="../cht/images/Kombine_toolbar_006.png" width="36" border="0" /></a>
                  <?php } // Show if not first page ?></td>
                <td width="31%" align="center" class="style12"><?php if ($pageNum_RecProduct > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_RecProduct=%d%s", $currentPage, max(0, $pageNum_RecProduct - 1), $queryString_RecProduct); ?>" class="style20"><img src="../cht/images/Kombine_toolbar_001.png" width="32" border="0" /></a>
                  <?php } // Show if not first page ?></td>
                <td width="31%" align="center" class="style12"><table width="40" border="0" cellspacing="3" cellpadding="0">
                  <tr>
                    <?php $pag=ceil($totalRows_RecProduct/10);$pai=1;$pb=0;while ($pag != 0) {?>
                    <td width="40" align="center" style="color: #FC0"><a href="mem3.php?pageNum_RecProduct=<?php echo $pb;?>&amp;ap=<?php echo $ceo;?>"><?php echo $pai,".";?></a></td>
                    <?php $pag--;$pai++;$pb++;}?>
                    </tr>
                  </table></td>
                <td width="23%" align="center" class="style12"><?php if ($pageNum_RecProduct < $totalPages_RecProduct) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_RecProduct=%d%s", $currentPage, min($totalPages_RecProduct, $pageNum_RecProduct + 1), $queryString_RecProduct); ?>"><img src="../cht/images/Kombine_toolbar_002.png" width="32" border="0" /></a>
                  <?php } // Show if not last page ?></td>
                <td width="23%" align="center" class="style12"><?php if ($pageNum_RecProduct < $totalPages_RecProduct) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_RecProduct=%d%s", $currentPage, $totalPages_RecProduct, $queryString_RecProduct); ?>"><img src="../cht/images/Kombine_toolbar_003.png" width="36" border="0" /></a>
                  <?php } // Show if not last page ?></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>