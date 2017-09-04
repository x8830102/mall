<?php
class Distribution{

	function shopping($PV ,$fstore ,$number){
		/*****
		PV : 店家讓利*50%
		fstore : 店家推薦人number
		number : 買家 number
		******/

		include("pdo_cmg.php");
		header("Content-Type:text/html; charset=utf-8");
		$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");
		$Store = floor($PV * 0.05);
		$Self = floor($PV * 0.3);
		$Three = floor($PV * 0.05); //3代
		$Six = floor($PV * 0.05); //6代
		$National = floor($PV * 0.05);
		$Charity = floor($PV * 0.1);
		$Business = floor($PV * 0.15);
		$Other = floor($PV * 0.05);

		/*Store_recommend_feedback*/
		$fstore_cash = $pdo_cmg->query("SELECT csum FROM c_cash WHERE number='$fstore' ORDER By id DESC");
		$result = $fstore_cash->fetch();
		$cash =$result['csum']+$Store;

		$store_feedback = $pdo_cmg->prepare("INSERT INTO c_cash(number,cin,csum,note,date,time)VALUES('$fstore',?,?,'引薦積分回饋',SYSDATE(),CURTIME())");
		$store_feedback->bindParam(1, $Store);
		$store_feedback->bindParam(2, $cash);

		
		$store_gold_m = $pdo_cmg->prepare("INSERT INTO gold_m(number,year,moom,day,z,g,note,level,at,date,time)VALUES('$fstore',?,?,?,?,?,'引薦積分回饋','6','1',?,?)");
		$store_gold_m->bindParam(1, $year);
		$store_gold_m->bindParam(2, $moom);
		$store_gold_m->bindParam(3, $day);
		$store_gold_m->bindParam(4, $z);
		$store_gold_m->bindParam(5, $Store);
		$store_gold_m->bindParam(6, $date);
		$store_gold_m->bindParam(7, $time);
		
		
		/*self_feedback*/
		$self_feedback = $pdo_cmg->prepare("INSERT INTO gold_m(number,year,moom,day,z,g,note,level,at,date,time)VALUES('$number',?,?,?,?,?,'自我消費回饋','7','0',?,?)");
		$self_feedback->bindParam(1,$year);
		$self_feedback->bindParam(2, $moom);
		$self_feedback->bindParam(3, $day);
		$self_feedback->bindParam(4, $z);
		$self_feedback->bindParam(5, $Self);
		$self_feedback->bindParam(6, $date);
		$self_feedback->bindParam(7, $time);
		
		/*Three_feedback*/
		for($i=0 ;$i<=2;$i++)
		{
			$Three_feedback = $pdo_cmg->query("SELECT m_fuser,m_guser FROM memberdata WHERE number='$number'");
			$result = $Three_feedback->fetch();
			$a = $result['m_guser'];
			
			if(empty($a))
			{
				$a = $result['m_fuser'];
			}
			$Three_feedback = $pdo_cmg->prepare("INSERT INTO gold_m(number,year,moom,day,z,g,note,level,at,date,time)VALUES('$a',?,?,?,?,?,'鐵粉消費回饋','8','0',?,?)");
			$Three_feedback->bindParam(1,$year);
			$Three_feedback->bindParam(2, $moom);
			$Three_feedback->bindParam(3, $day);
			$Three_feedback->bindParam(4, $z);
			$Three_feedback->bindParam(5, $Three);
			$Three_feedback->bindParam(6, $date);
			$Three_feedback->bindParam(7, $time);
			$three_arr[$i] = $a;
			$number = $a;
			$Three_feedback-> execute();

		}
		
		/*six_feedback*/
		for($i=0 ;$i<=2;$i++)
		{
			if($number == "sn333"){
				$six_feedback = $pdo_cmg->prepare("INSERT INTO gold_m(number,year,moom,day,z,g,note,level,at,date,time)VALUES('$number',?,?,?,?,?,'粉絲消費回饋','9','0',?,?)");
				$six_feedback->bindParam(1,$year);
				$six_feedback->bindParam(2, $moom);
				$six_feedback->bindParam(3, $day);
				$six_feedback->bindParam(4, $z);
				$six_feedback->bindParam(5, $Six);
				$six_feedback->bindParam(6, $date);
				$six_feedback->bindParam(7, $time);
				$six_feedback-> execute();
				continue;
			}
			$six_feedback = $pdo_cmg->query("SELECT m_fuser,m_guser FROM memberdata WHERE number='$number'");
			$result = $six_feedback->fetch();
			$a = $result['m_guser'];
			if(empty($a))
			{
				$a = $result['m_fuser'];
			}
			$six_feedback = $pdo_cmg->prepare("INSERT INTO gold_m(number,year,moom,day,z,g,note,level,at,date,time)VALUES('$a',?,?,?,?,?,'粉絲消費回饋','9','0',?,?)");
			$six_feedback->bindParam(1, $year);
			$six_feedback->bindParam(2, $moom);
			$six_feedback->bindParam(3, $day);
			$six_feedback->bindParam(4, $z);
			$six_feedback->bindParam(5, $Six);
			$six_feedback->bindParam(6, $date);
			$six_feedback->bindParam(7, $time);
			$sit_arr[$i] = $a;
			$number = $a;
			$six_feedback-> execute();
			
		}
		//水庫
		/*National_feedback*/
		$nb_query = $pdo_cmg ->query("SELECT psum FROM pay_nb ORDER By id DESC");
		$result = $nb_query->fetch();
		$nbps = $result['psum']+$National;
		
		$National_feedback = $pdo_cmg->prepare("INSERT INTO pay_nb(pin,psum,number,at,date,time,pud_name)VALUES(?,?,?,'1',?,?,'全國商城分紅')");
		$National_feedback->bindParam(1,$National);
		$National_feedback->bindParam(2, $nbps);
		$National_feedback->bindParam(3, $number);
		$National_feedback->bindParam(4, $date);
		$National_feedback->bindParam(5, $time);
		
		/*Charity_fund*/
		$cf_query = $pdo_cmg->query("SELECT psum FROM pay_cf ORDER By id DESC");
		$result = $cf_query->fetch();
		$cfps = $result['psum']+$Charity;
		
		$Charity_fund = $pdo_cmg->prepare("INSERT INTO pay_cf(pin,psum,number,at,date,time,pud_name)VALUES(?,?,?,'1',?,?,'公益希望基金')");
		$Charity_fund->bindParam(1,$Charity);
		$Charity_fund->bindParam(2, $cfps);
		$Charity_fund->bindParam(3, $number);
		$Charity_fund->bindParam(4, $date);
		$Charity_fund->bindParam(5, $time);
		
		/*Business_feedback*/
		$bb_query = $pdo_cmg->query("SELECT psum FROM pay_bb ORDER By id DESC");
		$result = $bb_query->fetch();
		$bbps = $result['psum']+$Business;
		
		$Business_feedback = $pdo_cmg->prepare("INSERT INTO pay_bb(pin,psum,number,at,date,time,pud_name)VALUES(?,?,?,'1',?,?,'福利-業務分紅')");
		$Business_feedback->bindParam(1,$Business);
		$Business_feedback->bindParam(2, $bbps);
		$Business_feedback->bindParam(3, $number);
		$Business_feedback->bindParam(4, $date);
		$Business_feedback->bindParam(5, $time);
		
		/*other_feedback*/
		$of_query = $pdo_cmg->query("SELECT psum FROM pay_of ORDER By id DESC");
		$result = $of_query->fetch();
		$ofps = $result['psum']+$Other;
		
		$other_feedback = $pdo_cmg->prepare("INSERT INTO pay_of(pin,psum,number,at,date,time,pud_name)VALUES(?,?,?,'1',?,?,'其他用途提撥')");
		$other_feedback->bindParam(1,$Other);
		$other_feedback->bindParam(2, $ofps);
		$other_feedback->bindParam(3, $number);
		$other_feedback->bindParam(4, $date);
		$other_feedback->bindParam(5, $time);
		
		
		$store_feedback-> execute();
		$store_gold_m-> execute();
		$self_feedback-> execute();
		$National_feedback-> execute();
		$Charity_fund-> execute();
		$Business_feedback-> execute();
		$other_feedback-> execute();
		$pdo = NULL;
	}


}

$d  = new Distribution;
$d->shopping(500,'SN1612300264','SN1612300263');
?>