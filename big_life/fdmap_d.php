<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
$fd_c=$_GET['fd_c'];$kp=$_GET['kp'];
while ($kp != 0) {
	mysql_select_db($database_sc, $sc);
    $query_Recfds = sprintf("SELECT * FROM fd2 WHERE card='$fd_c'");
    $Recfds = mysql_query($query_Recfds, $sc) or die(mysql_error());
    $row_Recfds = mysql_fetch_assoc($Recfds);
    $totalRows_Recfds = mysql_num_rows($Recfds);
	if ($row_Recfds['c_guser'] == $_SESSION['topfd']) {$fd_c=$row_Recfds['c_guser'];break;} else {$fd_c=$row_Recfds['c_guser'];}
	$kp--;
	}
header(sprintf("Location: fdmap.php?fd_c=".$fd_c));exit;
?>