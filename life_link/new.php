<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;} else {$sn=$_SESSION['number'];}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1 && a_pud < 6");//
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
$totalRows_Reccd31 = mysql_num_rows($Reccd31);//echo $totalRows_Reccd31,">",$totalRows_Reccd3;
$sv=$totalRows_Reccd31-$totalRows_Reccd3;
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
<div class="cut-navbar col-lg-8 col-md-7 col-sm-7 col-xs-11 col-lg-offset-1 col-sm-offset-1">
<div  class="menu col-lg-12 col-xs-12" >
        <?php require_once('newsSystem/newshow.php');?>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
