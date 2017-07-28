<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;} else {$sn=$_SESSION['number'];}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1 && a_pud >= 6");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: login_mem.php"));exit;}
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
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<div class="cut-navbar col-lg-7 col-md-7 col-sm-7 col-xs-11  col-lg-offset-2">
    <ul class="cut-page">
        <?php if ($a_pud >= 2) {?><li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >系統註冊</span></a></li>
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
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line_active">
                <li class="cust-but"><a href="fan_management_1.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>粉絲管理</span></a></li>
                <li></li>
            </ul>
        </li>
    </ul>
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <li> <a href="fan_management_1.php"><span>粉絲人數管理</span></a> </li>
            <li> <a href="fan_management_2.php"><span>推廣數管理</span></a> </li>
            <li class="active"> <a href="fan_management_3.php"><span>寶物數管理</span></a> </li>
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">兌換尋寶圖寶物集點情形管理</div>
            <table align="center" cellpadding="10" cellspacing="3">
                <tbody>
                    <tr class="menu-tr">
                        <td class="menu-td"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div><?php //
if ($_GET['sd1'] != "") {
	$sd1=$_GET['sd1'];$sd2=$_GET['sd2'];
	$key="SELECT * FROM fd2 WHERE number = '$sn' && date >= '$sd1' && date <= '$sd2' ORDER BY id DESC";
	} else {$key="SELECT * FROM fd2 WHERE number = '$sn' ORDER BY id DESC";}
//
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recoc = 10;
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
        <div style="  margin-top: 10px" class="table-responsive ">
            <table class="integral-tb table" width="100%" style="min-width: 100%">
                <tbody>
                    <tr class="integral-frist-tr">
                        <td style="width: 5%;border-top: 0px ">#</td>
                        <td style="width: 15%;border-top: 0px">註冊日期時間</td>
                        <td style="width: 15%;border-top: 0px">寶物編號</td>
                        <td style="width: 15%;border-top: 0px">尋寶進度</td>
                        <td style="width: 10%;border-top: 0px">開寶箱</td>
                        <td style="width: 15%;border-top: 0px">新寶物編號</td>
                        <td style="width: 15%;border-top: 0px">完成日期</td>
                        <td style="width: 10%;border-top: 0px">備註</td>
                    </tr>
                    <?php $pj=$_GET['pj']+0;if ($totalRows_Recoc != 0) {do {$pj++;?><tr class="integral-tr">
                        <td><?php echo $pj;?></td>
                        <td>
                            <ul>
                                <li> <span><?php echo $row_Recoc['date'];?></span> </li>
                                <li><span><?php echo $row_Recoc['time'];?></span></li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li> <span><?php echo $row_Recoc['card'],"<br/>",$row_Recoc['name'];?></span> </li>
                                <li><span></span></li>
                            </ul>
                        </td>
                        <td><span><?php $p_total=0;
$tt_us=$row_Recoc['card'];
mysql_select_db($database_sc, $sc);
$query_Recg = sprintf("SELECT * FROM fd WHERE c_guser = '$tt_us'");
$Recg = mysql_query($query_Recg, $sc) or die(mysql_error());
$row_Recg = mysql_fetch_assoc($Recg);
$totalRows_Recg = mysql_num_rows($Recg);$p_total=$p_total+$totalRows_Recg;
if ($totalRows_Recg != 0) {
	do {$gusa=$row_Recg['card'];
	mysql_select_db($database_sc, $sc);
    $query_Recg2 = sprintf("SELECT * FROM fd WHERE c_guser = '$gusa'");
    $Recg2 = mysql_query($query_Recg2, $sc) or die(mysql_error());
    $row_Recg2 = mysql_fetch_assoc($Recg2);
    $totalRows_Recg2 = mysql_num_rows($Recg2);
	if ($totalRows_Recg2 != 0) {$p_total=$p_total+$totalRows_Recg2;}
	} while ($row_Recg = mysql_fetch_assoc($Recg));
	}
echo $p_total;?> / 6</span></td>
                        <td><?php if ($row_Recoc['at'] == 1) {echo "✔";}?></td>
                      <td><?php echo $row_Recoc['fnumber'];?></td>
                        <td><span><?php echo $row_Recoc['okdata'];?></span></td>
                        <td><?php echo $row_Recoc['note'];?></td>
                    </tr><?php } while ($row_Recoc = mysql_fetch_assoc($Recoc));} else {echo "no date";}?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
