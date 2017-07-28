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
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['number'] = NULL;
  unset($_SESSION['number']);
	
  $logoutGoTo = "login_mem.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
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
//type
$type=$row_Recsn['a_pud'];
mysql_select_db($database_sc, $sc);
$query_Rect = sprintf("SELECT * FROM a_pud WHERE id = $type");//
$Rect = mysql_query($query_Rect, $sc) or die(mysql_error());
$row_Rect = mysql_fetch_assoc($Rect);
$totalRows_Rect = mysql_num_rows($Rect);
//oc-
mysql_select_db($database_sc, $sc);
$query_Recoc = sprintf("SELECT * FROM o_cash WHERE number = '$sn' ORDER BY id DESC");
$Recoc = mysql_query($query_Recoc, $sc) or die(mysql_error());
$row_Recoc = mysql_fetch_assoc($Recoc);
$totalRows_Recoc = mysql_num_rows($Recoc);
//cc-
mysql_select_db($database_sc, $sc);
$query_Reccc = sprintf("SELECT * FROM c_cash WHERE number = '$sn' ORDER BY id DESC");
$Reccc = mysql_query($query_Reccc, $sc) or die(mysql_error());
$row_Reccc = mysql_fetch_assoc($Reccc);
$totalRows_Reccc = mysql_num_rows($Reccc);
//gc-
mysql_select_db($database_sc, $sc);
$query_Recgc = sprintf("SELECT * FROM g_cash WHERE number = '$sn' ORDER BY id DESC");
$Recgc = mysql_query($query_Recgc, $sc) or die(mysql_error());
$row_Recgc = mysql_fetch_assoc($Recgc);
$totalRows_Recgc = mysql_num_rows($Recgc);
//rc-
mysql_select_db($database_sc, $sc);
$query_Recrc = sprintf("SELECT * FROM r_cash WHERE number = '$sn' ORDER BY id DESC");
$Recrc = mysql_query($query_Recrc, $sc) or die(mysql_error());
$row_Recrc = mysql_fetch_assoc($Recrc);
$totalRows_Recrc = mysql_num_rows($Recrc);
//
mysql_select_db($database_sc, $sc);
$query_Recfd = sprintf("SELECT * FROM fd WHERE number = '$sn'  ORDER BY card DESC");
$Recfd = mysql_query($query_Recfd, $sc) or die(mysql_error());
$row_Recfd = mysql_fetch_assoc($Recfd);
$totalRows_Recfd = mysql_num_rows($Recfd);
//
mysql_select_db($database_sc, $sc);
$query_Recfd2 = sprintf("SELECT * FROM fd WHERE number = '$sn' && at=1");
$Recfd2 = mysql_query($query_Recfd2, $sc) or die(mysql_error());
$row_Recfd2 = mysql_fetch_assoc($Recfd2);
$totalRows_Recfd2 = mysql_num_rows($Recfd2);
//
mysql_select_db($database_sc, $sc);
$query_Recfd3 = sprintf("SELECT * FROM fd WHERE number = '$sn'  ORDER BY card DESC");
$Recfd3 = mysql_query($query_Recfd3, $sc) or die(mysql_error());
$row_Recfd3 = mysql_fetch_assoc($Recfd3);
$totalRows_Recfd3 = mysql_num_rows($Recfd3);
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
 <?php require_once('adx.php'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="50" align="center"><br>
    登 出 系 統<br>
    <br></td>
  </tr>
  <tr>
    <td align="center"><table width="200" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><a href="<?php echo $logoutAction ?>">確定</a></td>
        <td align="center"><a href="index.php">取消</a></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>