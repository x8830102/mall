<?php
/**
*每半年審核專案5W的推薦人數
*1.找出所有5W及欠款會員
*2.將所有5W及欠款會員審核狀態改變為0
*3.找出在半年裡推薦超過三人者狀態再改為1
*
*/
require_once('Connections/sc.php');
mysql_select_db($database_sc, $sc);
date_default_timezone_set('Asia/Taipei');


/*$update = "UPDATE memberdata SET assessment = 0 WHERE a_pud=5";
mysql_query($update,$sc);
*/
$query = $pdo_cmg->query("select `pay_ar`.* ,`memberdata`.`assessment` FROM `pay_ar` INNER JOIN `memberdata` ON `memberdata`.`number` = `pay_ar`.`number` where `memberdata`.`assessment` = 1 group by `pay_ar`.`number` HAVING SUM(`pay_ar`.`arrears`) <0 ORDER BY `pay_ar`.`id` ASC");
$result = $query->fetchAll();
$data = array();
$i = 0;
foreach($result as $result)
{
	$number = $result['number'];
	$data[$i] = $result['number'];
	$i++;
}
$query = $pdo_cmg->query("SELECT * FROM `memberdata` WHERE `a_pud` > 3 and `a_pud` <7");
$result = $query->fetchAll();
foreach($result as $result)
{
	$number = $result['number'];
	if(!in_array($number,$data))
	{
		$data[$i] = $number;
		$i++;
	}
	
	
}
for($j=0; $j<count($data); $j++)
{
	$number = $data[$j];
	$result = $pdo_cmg->prepare("UPDATE `memberdata` SET `assessment` = 0 WHERE `number` = '$number'");
	$result->execute();

	$sql = $pdo_cmg->query("SELECT `card` FROM `fd` WHERE `number` = '$number'");
	$result = $sql->fetch();
	$card = $result['card'];
	$today = date("Y-m-d");
	$ed = date("Y-m-d",strtotime("$today -6 month"));
	//有推薦21100的單 (amanda 推薦 baby1314520)
	$sql = $pdo_cmg->query("SELECT * FROM fd WHERE date>'$ed' and date < '$today' and c_fuser ='$card' and fd_amount>=21100");
	$count = $sql->rowCount();
	if($count >= 3)
	{
		$result = $pdo_cmg->prepare("UPDATE `memberdata` SET `assessment` = 1 WHERE `number` = '$number'");
		$result->execute();
	}	
}
/*
for($i=0; $i<$num_mem; $i++)
{
	$number = $row_mem['number'];

	$select = "SELECT card FROM fd WHERE number='$number' ORDER BY id ASC";
	$query = mysql_query($select,$sc);
	$row = mysql_fetch_assoc($query);
	$num = mysql_num_rows($query);
	$card = $row['card'];
	$today = date("Y-m-d");
	$ed = date("Y-m-d",strtotime("$today -6 month"));

	$select_fd = "SELECT * FROM fd WHERE date>$ed and date < $today and c_fuser ='$card' and fd_amount>=49980";
	$query_fd = mysql_query($select_fd,$sc);
	$row_fd = mysql_fetch_assoc($query_fd);
	$num_fd = mysql_num_rows($query_fd);
	if($num >3)
	{
		$update = "UPDATE memberdata SET assessment = 1 WHERE number='$number'";
		mysql_query($update,$sc);
	}
	$row_mem = mysql_fetch_assoc($query_mem);
}*/

?>
