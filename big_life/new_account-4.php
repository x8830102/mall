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
if ($a_pud < 3) {header(sprintf("Location: index.php"));exit;}
//xf
mysql_select_db($database_sc, $sc);
$query_Recxf = sprintf("SELECT * FROM fd_take WHERE number = '$sn' && at=0 ORDER BY id");// DESC
$Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());
$row_Recxf = mysql_fetch_assoc($Recxf);
$totalRows_Recxf = mysql_num_rows($Recxf);
//fd
mysql_select_db($database_sc, $sc);
$query_Recfd = sprintf("SELECT * FROM fd WHERE number = '$sn' ORDER BY id");// DESC
$Recfd = mysql_query($query_Recfd, $sc) or die(mysql_error());
$row_Recfd = mysql_fetch_assoc($Recfd);
$totalRows_Recfd = mysql_num_rows($Recfd);//echo $totalRows_Recfd;exit;
$fd_c=$row_Recfd['card'];
//
mysql_select_db($database_sc, $sc);
$query_Reccd3 = sprintf("SELECT * FROM fd WHERE number = '$sn' && at=1");
$Reccd3 = mysql_query($query_Reccd3, $sc) or die(mysql_error());
$row_Reccd3 = mysql_fetch_assoc($Reccd3);
$totalRows_Reccd3 = mysql_num_rows($Reccd3);//echo $totalRows_Reccd3;exit;
mysql_select_db($database_sc, $sc);
$query_Reccd31 = sprintf("SELECT * FROM fd WHERE c_fuser = '$fd_c'");
$Reccd31 = mysql_query($query_Reccd31, $sc) or die(mysql_error());
$row_Reccd31 = mysql_fetch_assoc($Reccd31);
$totalRows_Reccd31 = mysql_num_rows($Reccd31);
$sv=$totalRows_Reccd31-$totalRows_Reccd3;
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
    body {
        font-family: "verdana", "微軟正黑體";
        font-weight: 400;
    }
	.dv {
		width:150 px;
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
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line_active">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >系統註冊</span></a></li>
            </ul>
        </li>
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
            <ul class="cut-line">
                <li class="cust-but"><a href="fan_management_1.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>粉絲管理</span></a></li>
                <li></li>
            </ul>
        </li>
    </ul>
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <li> <a href="new_account-1.php"><span>註冊新帳戶</span></a> </li>
            <li class="active"> <a href="new_account-4.php"><span>寶物兌換</span></a> </li>
           
        </ul>
    </div>
    <div  class="menu col-lg-12 col-xs-12" align="center">
        <div align="center">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-top: 15px">
                <form method="get" action="new_account-4.php" target="_top">
                寶物明細
                            <select name="fd_c" class="v11" onchange="submit();">
                              <option value="" selected="selected">請選擇</option>
                              <?php do {?>
                              <option value="<?php echo $row_Recfd['card'];?>" <?php //if ($row_Recfd['card'] == $_POST['fd_c']) {echo "selected='selected'";}?>>
                                <?php if ($row_Recfd['at'] == 1) {echo "✔&nbsp;";} else {echo "&nbsp;&nbsp;&nbsp;";};echo $row_Recfd['card'],"&nbsp;&nbsp;&nbsp;";?><?php $p_total=0;
$tt_us=$row_Recfd['card'];
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
echo $p_total;?> / 6
                                </option>
                              <?php } while ($row_Recfd = mysql_fetch_assoc($Recfd));?>
                            </select>
                          </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-top: 15px">
                <form method="get" action="new_account-4.php" target="_top">已滿寶物數
                            <select name="fd_c" class="v11" onchange="submit();">
                              
                              <?php if ($totalRows_Recxf != 0) {do {?>
                              <option value="<?php echo $row_Recxf['fcard'];?>" <?php //if ($row_Recfd['card'] == $_POST['fd_c']) {echo "selected='selected'";}?>>
                                <?php echo $row_Recxf['fcard'];?>
                                </option>
                              <?php } while ($row_Recxf = mysql_fetch_assoc($Recxf));} else {?><option value="" selected="selected">無</option><?php }?>
                            </select>
                          </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-top: 15px">可用次數
                <?php echo $sv;?>
            </div>
        </div>
    </div>
    <? if ($_GET['err'] != "") {?><span style="color: #900"><?php echo "錯誤訊息： ",$_GET['err'];?></span><? }?>
    <div class="menu col-lg-12 col-xs-12" align="center">
        <?php require_once('fdmap.php');?>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
