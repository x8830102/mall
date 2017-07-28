<?php require_once('Connections/kg.php'); ?>
<?php
mysql_query("set names utf8");
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
mysql_select_db($database_kg, $kg);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1 && level >= 4");
$Reclu = mysql_query($query_Reclu, $kg) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
//
$currentPage = $_SERVER["PHP_SELF"];
$maxRows_Recl = 10;
$pageNum_Recl = 0;
if (isset($_GET['pageNum_Recl'])) {
  $pageNum_Recl = $_GET['pageNum_Recl'];
}
$startRow_Recl = $pageNum_Recl * $maxRows_Recl;
$fg="";
//if ($row_Reclu['level'] == 6) {$au="&& admin = '".$ceo."'";} else {$au="";}
if ($_GET['k1'] == "") {$key="SELECT * FROM memberdata WHERE m_fuser <> '$fg'  && m_ok >= 0 ".$au." ORDER BY m_id DESC";} 
if ($_GET['k1'] != "") {$ke1=$_GET['k1'];$ke2=$_GET['k2'];$key="SELECT * FROM memberdata WHERE m_fuser <> '$fg' && m_ok >= 0 ".$au." && ".$ke1." LIKE '%%".$ke2."%%' ORDER BY m_id DESC";}


mysql_select_db($database_kg, $kg);
$query_Recl = sprintf($key);
$query_limit_Recl = sprintf("%s LIMIT %d, %d", $query_Recl, $startRow_Recl, $maxRows_Recl);
$Recl = mysql_query($query_limit_Recl, $kg) or die(mysql_error());
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
        <td width="425"><form action="mem_main.php" method="get" name="form6" id="form6">
          查詢分類：
              <select name="k1" id="k1">
              <option value="m_username">帳號</option>
              <option value="m_nick">暱稱</option>
              <!--<option value="m_name">姓名</option>
              <option value="m_callphone">行動電話</option>-->
            <?php $ri=0;while ($tr !=0) {
		mysql_data_seek($Recr,(int)$ri);
              $rowss = mysql_fetch_row($Recr);
		      mysql_select_db($database_csf, $csf);?>
            <?php $tr--;$ri++;}?>
        </select> 
            <input type="text" name="k2" id="k2" />
<input type="submit" name="button6" id="button6" value="送出" />
        </form></td>
        <td width="575" align="right"><table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
			<td width="48%" align="right"><input name="Submit3" type="button" class="style181" onclick="window.location='tree.php'" value="查看組織圖" /></td>
            <td width="48%" align="right"><input name="Submit3" type="button" class="style181" onclick="window.location='mem_main.php'" value="查看全部" /></td>
			<td width="48%" align="right"><input name="Submit3" type="button" class="style181" onclick="window.location='new_account.php'" value="新增帳號" /></td>
            <td width="20%">&nbsp;</td>
            <td width="32%"><!--<input name="Submit" type="button" class="style171" onclick="window.location='account.php'" value="空投新單" />--></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><hr size="1" noshade="noshade" class="whiteBox" /></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="350" colspan="2" align="center" valign="top"><table width="1000" border="1" align="center" cellpadding="0" cellspacing="3">
          <tr>
            <td width="244" height="30" align="center" bgcolor="#46A0EC" class="style21">會員</td>
            <?php if ($row_Reclu['level'] >= 8) {?>
            <?php }?>
            <td width="247" align="center" bgcolor="#46A0EC" class="style21">&nbsp;</td>
            <td width="154" align="center" bgcolor="#46A0EC" class="style21">&nbsp;</td>
            <td width="201" align="center" bgcolor="#46A0EC" class="style21">回填單值 &gt; 0</td>
            <td colspan="2" bgcolor="#46A0EC">&nbsp;</td>
          </tr>
          <?php if ($totalRows_Recl != 0) {do { ?>
          <tr>
            <td bgcolor="#99FFCC">帳號：<?php echo $row_Recl['m_username'];?><br />
登入碼：<a href="fix_pass.php?mi=<?php echo $row_Recl['m_id'];?>"><?php echo $row_Recl['m_passwd'];?></a><br />
二級碼：<a href="fix_passtoo.php?mi=<?php echo $row_Recl['m_id'];?>"><?php echo $row_Recl['m_passtoo'];?></a></td>
            <td bgcolor="#99FFCC">暱稱：<?php echo $row_Recl['m_nick'];?> / <?php echo $row_Recl['note'];?><br />
              產品：<?php $ap=$row_Recl['a_pud'];mysql_select_db($database_kg, $kg);
$query_Recap = sprintf("SELECT * FROM a_pud WHERE id = $ap");
$Recap = mysql_query($query_Recap, $kg) or die(mysql_error());
$row_Recap = mysql_fetch_assoc($Recap);
$totalRows_Recap = mysql_num_rows($Recap);echo $row_Recap['name'];?></td>
            <td bgcolor="#99FFCC">&nbsp;</td>
            <td bgcolor="#99FFCC"><?php echo $row_Recl['ek'];?></td>
            <td width="67" height="39" align="center" bgcolor="#99FFCC">&nbsp;</td>
            <td width="52" align="center" bgcolor="#99FFCC"><a href="gold.php?n=<?php echo $row_Recl['number'];?>">資訊</a></td>
          </tr>
          <?php } while ($row_Recl = mysql_fetch_assoc($Recl)); } else {echo "查詢項目：",$qq,"的「",$ke2,"」，目前無資訊 ! ! !";}?>
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
              <td colspan="4" align="center" class="style12"><table width="300" border="0" align="right" cellpadding="0" cellspacing="5">
                <tr>
                  <?php $cno=0;$pag=ceil($totalRows_Recl/10);$pai=1;$pb=0;while ($pag != 0) {?>
                  <td width="5" align="center"><?php if (($_GET['pageNum_Recl']+1) == $pai) {echo "[",$pai,"]";} else {?>
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