<?php require_once('Connections/sc.php');mysql_query("set names utf8"); ?>
<?php
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
mysql_select_db($database_sc, $sc);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1 && level >= 7");
$Reclu = mysql_query($query_Reclu, $sc) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
//
$currentPage = $_SERVER["PHP_SELF"];
$maxRows_Recl = 30;
$pageNum_Recl = 0;
if (isset($_GET['pageNum_Recl'])) {
  $pageNum_Recl = $_GET['pageNum_Recl'];
}
$startRow_Recl = $pageNum_Recl * $maxRows_Recl;
$fg="";
//if ($row_Reclu['level'] == 6) {$au="&& admin = '".$ceo."'";} else {$au="";}
//if ($_GET['k1'] == "") {$key="SELECT * FROM memberdata WHERE m_fuser <> '$fg'  && m_ok >= 0 ".$au." ORDER BY card DESC";} 
//if ($_GET['k1'] != "") {$ke1=$_GET['k1'];$ke2=$_GET['k2'];$key="SELECT * FROM memberdata WHERE m_fuser <> '$fg' && m_ok >= 0 ".$au." && ".$ke1." LIKE '%%".$ke2."%%' ORDER BY card DESC";}
$key="SELECT * FROM pay_o ORDER BY id DESC";

mysql_select_db($database_sc, $sc);
$query_Recl = sprintf($key);
$query_limit_Recl = sprintf("%s LIMIT %d, %d", $query_Recl, $startRow_Recl, $maxRows_Recl);
$Recl = mysql_query($query_limit_Recl, $sc) or die(mysql_error());
$row_Recl = mysql_fetch_assoc($Recl);

if (isset($_GET['totalRows_Recl'])) {
  $totalRows_Recl = $_GET['totalRows_Recl'];
} else {
  $all_Recl = mysql_query($query_Recl);
  $totalRows_Recl = mysql_num_rows($all_Recl);
}
$totalPages_Recl = ceil($totalRows_Recl/$maxRows_Recl)-1;
$queryString_Recl = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recl") == false && 
        stristr($param, "totalRows_Recl") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recl = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recl = sprintf("&totalRows_Recl=%d%s", $totalRows_Recl, $queryString_Recl);
//
mysql_select_db($database_sc, $sc);
$query_Reclu2 = sprintf("SELECT * FROM memberdata WHERE number = 'gugold777'");
$Reclu2 = mysql_query($query_Reclu2, $sc) or die(mysql_error());
$row_Reclu2 = mysql_fetch_assoc($Reclu2);
$totalRows_Reclu2 = mysql_num_rows($Reclu2);
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
.style12 {font-size: 12px;
	line-height: 20px;
	word-spacing: 1px;
	letter-spacing: 1px;
}
.style201 {color: #F78A18; }
.style171 {font-size: 22px; line-height: 20px; word-spacing: 1px; letter-spacing: 1px; }
.style181 {font-size: 22px; line-height: 20px; word-spacing: 1px; letter-spacing: 1px; color: #0000FF; }
a:link {
	color: #00F;
}
a:visited {
	color: #00F;
}
a:hover {
	color: #F90;
}
a:active {
	color: #F00;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
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
            <td><span class="style7"> <?php echo $row_Reclu['name'];?> 您好!</span> <span class="style8">&nbsp;&nbsp;&nbsp;登入帳號：<?php echo $row_Reclu['username'];?></span>&nbsp;&nbsp;</td>
            <td rowspan="2"><a href="ai_in.php"><img src="images/3.png" alt="回管理" title="回管理" width="50" height="53" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="288" align="right"><table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <td width="5%" ><input name="Submit3" type="button" class="style181" onclick="window.location='pay_o.php'" value="股利" /></td>
            <td width="95%" ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_p.php'" value="公司股利" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><hr size="1" noshade="noshade" class="whiteBox" /></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td width="73%">*** 營運球資訊= <? echo $row_Reclu2['rat']," / ",$row_Reclu2['rat2'];?>，目前累計股利 = <?php echo number_format($row_Recl['psum'], 0, '.' ,',');?></td>
              <td width="27%"><a href="print_1.php?p=a">列印</a></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="350" colspan="2" align="center" valign="top"><table width="1000" border="0" align="center" cellpadding="0" cellspacing="1">
          <tr>
            <td width="267" height="30" align="center" bgcolor="#46A0EC" class="style21">營運帳號</td>
            <td width="213" align="center" bgcolor="#46A0EC" class="style21">金額</td>
            <td bgcolor="#46A0EC">&nbsp;</td>
          </tr>
          <?php if ($totalRows_Recl != 0) {do { $msn=$row_Recl['number'];
		  mysql_select_db($database_sc, $sc);
$query_Recm = sprintf("SELECT * FROM memberdata WHERE number = '$msn'");
$Recm = mysql_query($query_Recm, $sc) or die(mysql_error());
$row_Recm = mysql_fetch_assoc($Recm);
$totalRows_Recm = mysql_num_rows($Recm);?>
          <tr>
            <td height="39" bgcolor="#99FFCC">帳號：<?php echo $row_Recm['m_username'],"<br/>";?></td>
            <td align="center" bgcolor="#99FFCC">$              <?php if ($row_Recl['pin'] != 0) {echo $row_Recl['pin'];} else {echo "- ",$row_Recl['pout'];}?></td>
            <td width="500" align="right" bgcolor="#99FFCC"><?php echo $row_Recl['date'];?>  <?php echo $row_Recl['time'];?></td>
          </tr>
          <?php } while ($row_Recl = mysql_fetch_assoc($Recl)); } else {echo "目前無資訊 ! ! !";}?>
        </table>
          <br />
          <table border="0" width="50%" align="right">
            <tr>
              <td width="23%" align="center" class="style12"><?php if ($pageNum_Recl > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_Recl=%d%s", $currentPage, 0, $queryString_Recl); ?>" class="style201">第一頁</a>
                <?php } // Show if not first page ?></td>
              <td width="31%" align="center" class="style12"><?php if ($pageNum_Recl > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_Recl=%d%s", $currentPage, max(0, $pageNum_Recl - 1), $queryString_Recl); ?>" class="style201">上一頁</a>
                <?php } // Show if not first page ?></td>
              <td width="23%" align="center" class="style12"><?php if ($pageNum_Recl < $totalPages_Recl) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_Recl=%d%s", $currentPage, min($totalPages_Recl, $pageNum_Recl + 1), $queryString_Recl); ?>">下一頁</a>
                <?php } // Show if not last page ?></td>
              <td width="23%" align="center" class="style12"><?php if ($pageNum_Recl < $totalPages_Recl) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_Recl=%d%s", $currentPage, $totalPages_Recl, $queryString_Recl); ?>">最後一頁</a>
                <?php } // Show if not last page ?></td>
            </tr>
            <tr>
              <td colspan="4" align="center" class="style12"><table width="500" border="0" align="right" cellpadding="0" cellspacing="5">
                <tr>
                  <?php $cno=0;$pag=ceil($totalRows_Recl/30);$pai=1;$pb=0;while ($pag != 0) {?>
                  <td width="40" align="center"><?php if (($_GET['pageNum_Recl']+1) == $pai) {echo "[",$pai,"]";} else {?>
                    <a href="mem_main.php?pageNum_Recl=<?php echo $pb;?>"><?php echo $pai,".";?></a>
                    <?php }?></td>
                  <?php $pag--;$pai++;$pb++;$cno++;if($cno%10==0){echo "</tr><tr>";}}?>
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