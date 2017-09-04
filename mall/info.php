<?php
	/*$pdo = new PDO("mysql:host=localhost;dbname=twliveli_a;charset=utf8","twlivelinkcom","rgn26842");
	//number
	    $query_Reci = $pdo ->query("SELECT * FROM admin WHERE username='boss'");
	    $num_query= $query_Reci->fetch();
	    $num_box=$num_query['num_box'];
	    $num_z=$num_query['num_z'];
	    if(date("m") != $num_z) {
		   $numz=date("m");
		   $update11= $pdo ->query("UPDATE admin SET num_z=$numz WHERE username='boss'");
		   $num_box=1;
		   }
	    if ($num_box == 10000) {echo "設定值巳超過9999單號，請洽系統工程師。";exit;}
	    if ($num_box < 10) {$number="SN".date("ymd")."000".$num_box;$card=date("ym")."000".$num_box;}
	    if ($num_box > 9 && $num_box < 100) {$number="SN".date("ymd")."00".$num_box;$card=date("ym")."00".$num_box;}
	    if ($num_box < 1000 && $num_box > 99) {$number="SN".date("ymd")."0".$num_box;$card=date("ym")."0".$num_box;}
		if ($num_box < 10000 && $num_box > 999) {$number="SN".date("ymd").$num_box;$card=date("ym").$num_box;}
		$new_num_box=$num_box+1;
	    $update11 = $pdo->query("UPDATE admin SET num_box=$new_num_box WHERE username='boss'");
	    print_r($num_query);
	    echo $num_query['num_box']."/".$num_query['num_z'];*/

	phpinfo(); 
	/*$pdo = new PDO("mysql:host=localhost;dbname=cmg58891_a;charset=utf8","cmg58891","rgn26842");
	$stmt = $pdo->query("SELECT m_email,number FROM memberdata");
	$check = $stmt->fetchAll():
	foreach($check as $check){
		print_r($check['m_email']);
		echo "/";
		print_r($check['number']);
		echo "<br>";
		$pdo_oc = new PDO("mysql:host=localhost;dbname=twlifeli_ocmall;charset=utf8","twlifelinkcom","rgn26842");
		$stmt2 = $pdo_oc->query("UPDATE oc_customer SET number ='".$check['number']."' WHERE email ='".$check['m_email']."'");
	}*/

	//insert username
	/*$pdo = new PDO("mysql:host=localhost;dbname=cmg58891_a;charset=utf8","cmg58891","rgn26842");
	$stmt = $pdo->query("SELECT m_username,number FROM memberdata");
	$check = $stmt->fetchAll();
	foreach($check as $check){
		print_r($check['m_username']);
		echo "/";
		print_r($check['number']);
		echo "<br>";
		$pdo_oc = new PDO("mysql:host=localhost;dbname=twlifeli_ocmall;charset=utf8","twlifelinkcom","rgn26842");
		$stmt2 = $pdo_oc->query("UPDATE oc_customer SET m_username ='".$check['m_username']."' WHERE number ='".$check['number']."'");
	}

	$pdo = NULL;*/

	/*密碼加密*/
	
	/* for salt */
	
	/*$pdo = new PDO("mysql:host=localhost;dbname=twlifeli_ocmall;charset=utf8","twlifelinkcom","rgn26842");
	for($i=1; $i < 1430; $i++){
		$stmt = $pdo->prepare("UPDATE oc_customer SET salt ='".substr(md5(uniqid(rand(), true)), 0, 9)."' WHERE customer_id = ?");
		$stmt->bindParam(1, $i);
		$stmt-> execute();
	}
	

	/* for encrypt */
	/*$pdo = new PDO("mysql:host=localhost;dbname=twlifeli_ocmall;charset=utf8","twlifelinkcom","rgn26842");*/
	/*for($i=1; $i < 1430; $i++){
		$stmt = $pdo->prepare("SELECT salt, password,customer_id FROM oc_customer");
		$stmt-> execute();
		$result = $stmt->fetchAll();	
	}
	foreach($result as $result){
		echo $result['salt'].'/';
		echo $result['password'].'<br>';
		$encrypt = $pdo->prepare("UPDATE oc_customer SET password ='".sha1($result['salt'] . sha1($result['salt'] . sha1($result['password'])))."' WHERE customer_id = '".$result['customer_id']."'");
		$encrypt->execute();
	}

	print_r($stmt);
	if($stmt->errorCode()){
		print_r($stmt->errorInfo());
	}
	$pdo = NULL;*/
?>