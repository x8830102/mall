<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
include('if_login.php');
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
//
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>串門子雲端事業</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <link rel="icon" href="img/life_link.jpg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="jasny-bootstrap/css/jasny-bootstrap.css">
    <link rel="stylesheet" type="text/css" href="icomoon/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="js/map.js"></script>
    <style type="text/css">
        body{
            font-family:"verdana","微軟正黑體" ; font-weight:400;
        }
    </style>
</head>

<body>
<?php require_once('adx.php');require_once('phone.php');require_once('desktop.php'); ?>
    <!--↓↓↓↓↓↓↓↓↓↓

                     content

                                    ↓↓↓↓↓↓↓↓↓↓↓-->
<div class="cut-navbar col-lg-7 col-md-7 col-sm-7 col-xs-11 col-lg-offset-2 col-sm-offset-1">
    <ul class="cut-page">
        <?php if ($a_pud >= 2) {?><li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >註冊會員</span></a></li>
            </ul>
        </li><? }?>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="member_profile01.php"><span class="icon-c hidden-xs" style="margin-right: 5px"></span><span>基本資料</span></a></li>
                <li></li>
            </ul>
        </li>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="integral_management_1.php"><span class="icon-d hidden-xs" style="margin-right: 5px"></span><span>積分管理</span></a></li>
                <li></li>
            </ul>
        </li>
        <?php if ($a_pud >= 2) {?><li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line_active">
                <li class="cust-but"><a href="fan_management_2.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>會員管理</span></a></li>
                <li></li>
            </ul>
        </li><? }?>
    </ul>
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <!--<li> <a href="fan_management_1.php"><span>所有會員粉絲</span></a> </li>-->
            <li class="active"> <a href="fan_management_2.php"><span>直接會員</span></a> </li>
          
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">直接會員管理</div>
            <table width="300" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td></td>
    <td></td>
  </tr>
</table>
        </div>
        <form id="form2" name="form2" method="get" action="fan_management_2.php">
        <div style="  margin-top: 10px" class="table-responsive ">
            
          <div class="inquire col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left">
            <table class="search">
                    <tbody>
                        <tr>
                            <td>查詢日期</td>
                            <td></td>
                            <td>起至</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input name="sd1" type="date" id="bookdate" value="<?php echo $_GET['sd1'];?>" size="15" placeholder="2014-09-18" /></td>
                            <td width="10px"></td>
                            <td><input name="sd2" type="date" id="bookdate2" value="<?php echo $_GET['sd2'];?>" size="15" placeholder="2014-09-18" /></td>
                            <td>
                                
                                <input type="submit" name="button" id="button" class="inquire-but hidden-xs" value="查詢">
                                    
                                
                            </td>
                        </tr>
                        <tr style="height: 5px">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                        <td  colspan="3">
                        <input type="submit" name="button" id="button" class="inquire-but visible-xs" value="查詢" style="width: 100%"> 
                        </td>
                        </tr>
                    </tbody>
                </table>
                <div>*「集點卡進度」欄位，指該會員最早之一張未領福袋的集點卡進度。</div>  
            </div><?php //
if ($_GET['sd1'] != "") {
	$sd1=$_GET['sd1'];$sd2=$_GET['sd2'];
	$key="SELECT * FROM memberdata WHERE m_fuser = '$sn' && date >= '$sd1' && date <= '$sd2' && a_pud>2 ORDER BY m_id DESC";
	} else {$key="SELECT * FROM memberdata WHERE m_fuser = '$sn' && a_pud>2 ORDER BY m_id DESC";}// DESC
//
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recoc = 1000;
$pageNum_Recoc = 0;
if (isset($_GET['pageNum_Recoc'])) {
  $pageNum_Recoc = $_GET['pageNum_Recoc'];
}
$startRow_Recoc = $pageNum_Recoc * $maxRows_Recoc;

mysql_select_db($database_sc, $sc);$n="NULL";
$query_Recoc = $key;// 
$query_limit_Recoc = sprintf("%s LIMIT %d, %d", $query_Recoc, $startRow_Recoc, $maxRows_Recoc);
$Recoc = mysql_query($query_limit_Recoc, $sc) or die(mysql_error());
$row_Recoc = mysql_fetch_assoc($Recoc);

if (isset($_GET['totalRows_Recoc'])) {
  $totalRows_Recoc = $_GET['totalRows_Recoc'];
} else {
  $all_Recoc = mysql_query($query_Recoc);
  $totalRows_Recoc = mysql_num_rows($all_Recoc);
}
$totalPages_Recoc = ceil($totalRows_Recoc/$maxRows_Recoc)-1;

$queryString_Recoc = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recoc") == false && 
        stristr($param, "totalRows_Recoc") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recoc = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recoc = sprintf("&totalRows_Recoc=%d%s", $totalRows_Recoc, $queryString_Recoc);
//?>
            <table class="integral-tb table" width="100%" style="min-width: 100%" >
                <tbody>
                    <tr class="integral-frist-tr" align="center">
                        <td align="left" style="width: 3%;border-top: 0px ">#</td>
                        <td align="left" style="width: 12%;border-top: 0px">註冊日期時間</td>
                        <td align="left" style="width: 15%;border-top: 0px">帳號/名稱</td>
                      <td style="width: 15%;border-top: 0px;">產品</td>
                        <td style="width: 15%;border-top: 0px;">集點卡進度</td>
                        <td style="width: 15%;border-top: 0px;">集點卡數量</td>
                    </tr>
                    <?php $pj=$_GET['pj']+0;$fid=$totalRows_Recoc;if ($totalRows_Recoc != 0) {do {$pj++;?><tr class="integral-tr">
                        <td><?php echo $fid; $fid--;?></td>
                        <td>
                            <ul>
                                <li> <span><?php echo $row_Recoc['date'];?></span> </li>
                                <li><span><?php echo $row_Recoc['time'];?></span></li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li> <span>帳:<?php echo $row_Recoc['m_username'];?></span> </li>
                                <li><span>名:<?php echo $row_Recoc['m_nick'];?></span></li>
                            </ul>
                        </td>
                        <td align="center"><?php $type=$row_Recoc['a_pud'];
mysql_select_db($database_sc, $sc);
$query_Rect = sprintf("SELECT * FROM a_pud WHERE id = $type");//
$Rect = mysql_query($query_Rect, $sc) or die(mysql_error());
$row_Rect = mysql_fetch_assoc($Rect);
$totalRows_Rect = mysql_num_rows($Rect);echo $row_Rect['name'];?></td>
                      <td align="center"><span><?php if ($row_Recoc['a_pud'] >= 5) {$us2=$row_Recoc['number'];mysql_select_db($database_sc, $sc);
$query_Recfb2 = sprintf("SELECT * FROM fd WHERE number = '$us2' && at=0 ORDER BY id");//
$Recfb2 = mysql_query($query_Recfb2, $sc) or die(mysql_error());
$row_Recfb2 = mysql_fetch_assoc($Recfb2);
$totalRows_Recfb2 = mysql_num_rows($Recfb2);
$tt_us=$row_Recfb2['card'];
$p_total=0;
mysql_select_db($database_sc, $sc);
$query_Recg = sprintf("SELECT * FROM fd WHERE c_guser = '$tt_us'");
$Recg = mysql_query($query_Recg, $sc) or die(mysql_error());
$row_Recg = mysql_fetch_assoc($Recg);
$totalRows_Recg = mysql_num_rows($Recg);
if ($totalRows_Recg != 0) {$p_total=$p_total+$totalRows_Recg;
	do {$gusa=$row_Recg['card'];
	mysql_select_db($database_sc, $sc);
    $query_Recg2 = sprintf("SELECT * FROM fd WHERE c_guser = '$gusa'");
    $Recg2 = mysql_query($query_Recg2, $sc) or die(mysql_error());
    $row_Recg2 = mysql_fetch_assoc($Recg2);
    $totalRows_Recg2 = mysql_num_rows($Recg2);
	if ($totalRows_Recg2 != 0) {$p_total=$p_total+$totalRows_Recg2;}
	} while ($row_Recg = mysql_fetch_assoc($Recg));
	}
echo $p_total;?> / 6<?php } else {echo "無";}?></span></td>
                    <td align="center"><span><?php 
					      mysql_select_db($database_sc, $sc);
                          $query_Recfb3 = sprintf("SELECT * FROM fd WHERE number = '$us2' && at=1");//
                          $Recfb3 = mysql_query($query_Recfb3, $sc) or die(mysql_error());
                          $row_Recfb3 = mysql_fetch_assoc($Recfb3);
                          $totalRows_Recfb3 = mysql_num_rows($Recfb3);
				  echo $totalRows_Recfb3;?></span></td>
                        </tr><?php if ($pk == 0) {$pk++;} else {$pk=0;}} while ($row_Recoc = mysql_fetch_assoc($Recoc));} else {echo "無資料";}?>
                </tbody>
            </table>
        </div></form>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
