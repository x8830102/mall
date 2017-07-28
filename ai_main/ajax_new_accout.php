<?php
require_once('Connections/sc.php');mysql_query("set names utf8"); 

mysql_select_db($database_sc, $sc);
$fuser = $_POST["fu"];
$select_number = "SELECT number,a_pud from memberdata where m_username='$fuser'";
$query_number = mysql_query($select_number,$sc);
$row_number = mysql_fetch_assoc($query_number);
session_start();
$_SESSION['number'] = $row_number["number"];
$a_pud = $row_number['a_pud'];
if($a_pud <2)
{
	echo "推薦人等級不足";
}else{
	echo $row_number["number"];
}

?>