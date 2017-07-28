<?php
include($_SERVER['DOCUMENT_ROOT']."/mall/pdo_cmg.php");
class Distribution{

	function shopping($PV ,$fstore ,$number){
		/*****
		PV : 店家讓利*50%
		fstore : 店家推薦人number
		number : 買家 number
		******/
		include($_SERVER['DOCUMENT_ROOT']."/mall/pdo_cmg.php");
		$Store = floor($PV * 0.05);
		$Self = floor($PV * 0.3);
		$Three = floor($PV * 0.15);
		$Six = floor($PV * 0.15);
		$National = floor($PV * 0.05);
		$Charity = floor($PV * 0.1);
		$Business = floor($PV * 0.15);
		$Other = floor($PV * 0.05);
		
		/*Store_recommend_feedback*/
		$fstore_cash = $pdo->prepare("SELECT csum FROM c_cash WHERE number='$fstore' ORDER By id DESC");
		$result = $fstore_cash->feach();
		$cash =$result['csum'];
		
		$store_feedback = $pdo_cmg->prepare("INSER INTO c_cash(number,cin,csum,note,date,time,)VALUES('$fstore',?,?,'引薦積分回饋',?,?)");
		$store_feedback->bindParam(1, $Store);
		$store_feedback->bindParam(2, $cash);
		$store_feedback->bindParam(3, $date);
		$store_feedback->bindParam(4, $time);
		
		$store_gold_m = $pdo_cmg->prepare("INSER INTO gold_m(number,year,moom,day,z,g,note,level,at,sncode,date,time)VALUES('$fstore',?,?,?,?,?,'引薦積分回饋','6','1',?,?,?)");
		$store_gold_m->bindParam(1,$year);
		$store_gold_m->bindParam(2, $moom);
		$store_gold_m->bindParam(3, $day);
		$store_gold_m->bindParam(4, $z);
		$store_gold_m->bindParam(5, $Store);
		$store_gold_m->bindParam(6, $sncode);
		$store_gold_m->bindParam(7, $date);
		$store_gold_m->bindParam(8, $time);
		
		
		/*self_feedback*/
		$self_feedback = $pdo_cmg->prepare("INSER INTO gold_m(number,year,moom,day,z,g,note,level,at,sncode,date,time)VALUES('$number',?,?,?,?,?,'自我消費回饋','7','0',?,?,?)");
		$self_feedback->bindParam(1,$year);
		$self_feedback->bindParam(2, $moom);
		$self_feedback->bindParam(3, $day);
		$self_feedback->bindParam(4, $z);
		$self_feedback->bindParam(5, $Self);
		$self_feedback->bindParam(6, $sncode);
		$self_feedback->bindParam(7, $date);
		$self_feedback->bindParam(8, $time);
		
		/*Tree_feedback*/
		for($i=0 ;$i<=2;$i++)
		{
			$Tree_feedback = $pdo_cmg->query("SELECT m_fuser,m_guser FROM memberdata WHERE number='$number'");
			$result = $Tree_feedback->feach();
			$a = $result['m_guser'];
			if(empty($a))
			{
				$a = $result['m_fuser'];
			}
			$arr[$i] = $a;
			$number = $a;
		}
		
		
		

	
		
	}


}
for($i=0 ;$i<=2;$i++)
{
	$Tree_feedback = $pdo_cmg->query("SELECT m_fuser,m_guser FROM memberdata WHERE number='SN1612300264'");
	$result = $Tree_feedback->feach();
	$a = $result['m_guser'];
	if(empty($a))
	{
		$a = $result['m_fuser'];
	}
	$arr[$i] = $a;
	$number = $a;
	
}
print_r($arr);
?>