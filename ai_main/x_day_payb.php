<?php require_once('Connections/sc.php'); 
$nyear=date("Y");$nmoom=date("m");$nday=date("d");
//
mysql_select_db($database_sc, $sc);
$query_Reca = sprintf("SELECT * FROM pay_b WHERE at=1");
$Reca = mysql_query($query_Reca, $sc) or die(mysql_error());
$row_Reca = mysql_fetch_assoc($Reca);
$totalRows_Reca = mysql_num_rows($Reca);
do {$number=$row_Reca['number'];
    $dd=$row_Reca['day'];
	
	} while ($row_Reca = mysql_fetch_assoc($Reca));
?>