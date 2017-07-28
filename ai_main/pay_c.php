<?php require_once('Connections/sc.php'); mysql_query("set names utf8");?>
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
$key="SELECT * FROM pay_c ORDER BY id DESC";

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
mysql_select_db($database_sc, $sc);$b=0;
$query_Reci = sprintf("SELECT * FROM pay_c WHERE pin <> $b");
$Reci = mysql_query($query_Reci, $sc) or die(mysql_error());
$row_Reci = mysql_fetch_assoc($Reci);
$totalRows_Reci = mysql_num_rows($Reci);
if ($totalRows_Reci != 0) {
	$total_i=0;
	do {$total_i=$total_i+$row_Reci['pin'];} while ($row_Reci = mysql_fetch_assoc($Reci));
	}
//
mysql_select_db($database_sc, $sc);
$query_Reco = sprintf("SELECT * FROM pay_c WHERE pout <> $b");
$Reco = mysql_query($query_Reco, $sc) or die(mysql_error());
$row_Reco = mysql_fetch_assoc($Reco);
$totalRows_Reco = mysql_num_rows($Reco);
if ($totalRows_Reco != 0) {
	$total_o=0;
	do {$total_o=$total_o+$row_Reco['pout'];} while ($row_Reco = mysql_fetch_assoc($Reco));
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<link rel="stylesheet" href="include/css/jquery.dataTables.min.css">
<script src="include/js/jquery-3.1.1.min.js"></script>
<script src="include/js/jquery.dataTables.min.js"></script>
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
#custTable td{
    text-align :center;
}
</style>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}


$(document).ready(function() {
  base = $(".style181").attr("data-value");
    $.ajax({
        type: "POST",
        url: "http://www.lifelinkvip.com/ai_main/get_pay.php",
        data: {base:base},
        dataType: "json",
        success: function(resultData) {//alert(resultData);
        var opt={"oLanguage":{"sUrl":"dataTables.zh-tw.txt"},
               "bJQueryUI":true,
               "bProcessing":true,//如需要一些時間處理時, 表格上會顯示"處理中 ..."
               "scrollY": 450,//卷軸
               "scrollCollapse": true,
               "destroy":true,
			   "order":[[ 0,  "DESC"]],
               "aoColumns":[{"sTitle":"序"},
                          {"sTitle":"購買日期"},
                          {"sTitle":"時間"},
                          {"sTitle":"登入帳號"},
                          {"sTitle":"暱稱"},
                          {"sTitle":"產品配套"},
                          {"sTitle":"營收金額"}],
               "aaData": resultData
               };         
         $("#custTable").dataTable(opt);
         }
    });
});
</script>
</head>

<body>
<table>
  <tr>
    <td><table >
      <tr>
        <td background="images/2.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
        <td width="712"><table>
          <tr>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_a.php'" value="營收金額" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_da.php'" value="各項稅務" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_db.php'" value="金流刷卡" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_dc.php'" value="系統建置" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_dd.php'" value="人事管銷" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_e.php'" value="愛心基金" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_i.php'" value="分享積分" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_b.php'" value="福袋積分" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_g.php'" value="產品成本" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_h.php'" value="促銷獎勵" /></td>
            <td ><input name="Submit3" type="button" class="style181" onclick="window.location='pay_c.php'" data-value="pay_c" value="靜態分紅" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_j.php'" value="車屋/旅遊" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_k.php'" value="內勤福利" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_d.php'" value="組織運作" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_f.php'" value="經銷商" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_l.php'" value="核心運作" /></td>
            <td ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_m.php'" value="公司運作" /></td>
            
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><hr size="1" noshade="noshade" class="whiteBox" /></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td width="75%">*** 結餘 =
                <?php $a=$total_i-$total_o;echo number_format($a, 0, '.' ,',')?></td>
              <td width="25%"><a href="print_1.php?p=b">列印</a></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td>
          <table id="custTable" class="display" ></table>
          <br />
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>