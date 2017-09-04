<?php 
	$pdo = new PDO("mysql:host=localhost;dbname=twliveli_a;charset=utf8","twlivelinkcom","ccimizj588");
	$stmt = $pdo->prepare("SELECT m_email,m_username FROM memberdata WHERE  m_username = ?");
	$stmt->bindParam(1, $username);
	$username = 'vege';
	$stmt-> execute();
	$check = $stmt->fetch();
	print_r($check['m_username']);
	echo "/";
	print_r($check['m_email']);
	$pdo = NULL;

	/*密碼加密*/
	
	/* for salt */
	/*
	$pdo = new PDO("mysql:host=localhost;dbname=twlifeli_ocmall;charset=utf8","twlifelinkcom","rgn26842");
	for($i=1; $i < 1201; $i++){
		$stmt = $pdo->prepare("UPDATE oc_customer SET salt ='".substr(md5(uniqid(rand(), true)), 0, 9)."' WHERE customer_id = ?");
		$stmt->bindParam(1, $i);
		$stmt-> execute();
	}*/
	

	/* for encrypt */
	/*for($i=1; $i < 1201; $i++){
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