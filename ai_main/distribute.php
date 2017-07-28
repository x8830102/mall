<?php
/**
*每月10號發送業績分紅
*/
	/*get from pay_c*/
	$pdo = new PDO("mysql:host=localhost;dbname=cmg58891_a;charset=utf8","cmg58891_a","cmg911com",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
	$stmt = $pdo->query("SELECT psum, `date`,(SELECT psum FROM pay_c order BY id desc LIMIT 1) AS real_psum FROM  `pay_c` WHERE `DATE` < ( NOW( ) - INTERVAL 10 DAY ) ORDER BY `DATE` DESC LIMIT 1");
	$pay_c = $stmt->fetch();
	$bouns = $pay_c['psum'];
	$psum = $pay_c['real_psum']; 

	/*select from fd*/
	$stmt = $pdo->query("SELECT `number`, count(`number`) AS ownball,`name` ,(SELECT count(`number`) FROM fd WHERE fd_amount = 120000 || fd_amount = 30000 || fd_amount = 23600) AS allball FROM `fd` WHERE fd_amount = 120000 || fd_amount = 30000 || fd_amount = 23600 GROUP BY `number`");
	$fd = $stmt->fetchAll();


	foreach($fd as $fd){

		
		/*send to gold_m*/
		$stmt = $pdo->prepare("INSERT INTO gold_m(  `number` , YEAR, moom, DAY , z, g, note, level,at, sncode,  `date` ,  `time` ) VALUE( ?, YEAR( NOW( ) ) , MONTH( NOW( ) ) , DAY( NOW( ) ) , ?, ROUND(?, 0), ?, 5,1, ?, SYSDATE( ) , CURTIME( ) )");
		$stmt->bindParam(1, $number);
		$stmt->bindParam(2, $dateyear);
		$stmt->bindParam(3, $g);
		$stmt->bindParam(4, $note);
		$stmt->bindParam(5, $sncode);
		/*send to pay_c*/
		$stmt_c = $pdo->prepare("INSERT INTO pay_c(pout, psum, `number`, `date`, `time`, year, moom, day, pud_name) VALUE (?, ?, ?, SYSDATE( ) , CURTIME( ), YEAR( NOW( ) ) , MONTH( NOW( ) ) , DAY( NOW( ) ) , ?)");
		$stmt_c->bindParam(1, $g);
		$stmt_c->bindParam(2, $psum);
		$stmt_c->bindParam(3, $number);
		$stmt_c->bindParam(4, $note);

		/*csum info from g_cash*/
		$stmt_gcash = $pdo->query("SELECT csum FROM g_cash WHERE `number` = '".$fd['number']."' ORDER BY id desc limit 1");
		$gcash = $stmt_gcash->fetch();
		if(!empty($gcash)){
			$gsum = $gcash['csum'];
			$stmt_gcash = $pdo->prepare("INSERT INTO g_cash(`number`, cin, csum, note, `date`, `time`) VALUE(?, ?, ?, ?, SYSDATE( ) , CURTIME( ))");
			$stmt_gcash->bindParam(1, $number);
			$stmt_gcash->bindParam(2, $gg);
			$stmt_gcash->bindParam(3, $gsum);
			$stmt_gcash->bindParam(4, $note);
			//echo 'YES'.$gsum.'/'.$fd['number'].'<br>';
			
		}else{
			$gsum =0;
			$stmt_gcash = $pdo->prepare("INSERT INTO g_cash(`number`, cin, csum, note, `date`, `time`) VALUE(?, ?, ?, ?, SYSDATE( ) , CURTIME( ))");
			$stmt_gcash->bindParam(1, $number);
			$stmt_gcash->bindParam(2, $gg);
			$stmt_gcash->bindParam(3, $gsum);
			$stmt_gcash->bindParam(4, $note);
			//echo 'NO'.$gcash['csum']."/".$fd['number'].'<br>';
		}
		/*csum info from c_cash*/
		$stmt_ccash = $pdo->query("SELECT csum FROM c_cash WHERE `number` = '".$fd['number']."' ORDER BY id desc limit 1");
			$ccash = $stmt_ccash->fetch();
		if(!empty($ccash)){
			$csum = $ccash['csum'];
			$stmt_ccash = $pdo->prepare("INSERT INTO c_cash(`number`, cin, csum, note, `date`, `time`) VALUE(?, ?, ?, ?, SYSDATE( ) , CURTIME( ))");
			$stmt_ccash->bindParam(1, $number);
			$stmt_ccash->bindParam(2, $cg);
			$stmt_ccash->bindParam(3, $csum);
			$stmt_ccash->bindParam(4, $note);
		}else{
			$csum=0;
			$stmt_ccash = $pdo->prepare("INSERT INTO c_cash(`number`, cin, csum, note, `date`, `time`) VALUE(?, ?, ?, ?, SYSDATE( ) , CURTIME( ))");
			$stmt_ccash->bindParam(1, $number);
			$stmt_ccash->bindParam(2, $cg);
			$stmt_ccash->bindParam(3, $csum);
			$stmt_ccash->bindParam(4, $note);
		}
		$number = $fd['number'];
		$name =$fd['name'];
		$dateyear = date('z');
		$g = floor(($bouns*$fd['ownball']/$fd['allball']));
		$psum = $psum - $g;
		$gg = floor(($g/10*2));
		$cg = floor(($g/10*8));
		$gsum = floor($gsum + ($g/10*2));
		$csum = floor($csum + ($g/10*8));
		$note = "業績分紅:<br>名稱:".$name;
		$sncode = $number."-".date("ymdhis");
		//echo $number."/".$gg."/".$note."/".$gsum."<br>";

		
		$stmt-> execute();
		$stmt_c-> execute();
		$stmt_gcash-> execute();
		$stmt_ccash-> execute();
		
	}


	$pdo = NULL;
?>