<?php require_once('Connections/sc.php'); ?>
<?php 
//mysql_query("set names utf8");
session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;} else {$sn=$_SESSION['number'];}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: login_mem.php"));exit;}
$name=$row_Recsn['m_name'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
if ($a_pud < 2) {header(sprintf("Location: edit_see.php"));exit;}
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
//oc
mysql_select_db($database_sc, $sc);
$query_Recoc = sprintf("SELECT * FROM o_cash WHERE number = '$sn' ORDER BY id DESC");
$Recoc = mysql_query($query_Recoc, $sc) or die(mysql_error());
$row_Recoc = mysql_fetch_assoc($Recoc);
$totalRows_Recoc = mysql_num_rows($Recoc);
//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//
if ($_GET['fu'] != "") {
	$gu=$_GET['gu'];$fu=$_GET['fu'];$w=$_GET['w'];
	mysql_select_db($database_sc, $sc);
    $query_Recb = sprintf("SELECT * FROM fd WHERE card='$fu'");
    $Recb = mysql_query($query_Recb, $sc) or die(mysql_error());
    $row_Recb = mysql_fetch_assoc($Recb);
    $totalRows_Recb = mysql_num_rows($Recb);
	}
//
mysql_select_db($database_sc, $sc);
$query_Reca = sprintf("SELECT * FROM a_pud WHERE at=1 ORDER BY id");// DESC
$Reca = mysql_query($query_Reca, $sc) or die(mysql_error());
$row_Reca = mysql_fetch_assoc($Reca);
$totalRows_Reca = mysql_num_rows($Reca);
//echo "ext";?>