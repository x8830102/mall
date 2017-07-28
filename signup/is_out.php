<?php 


class out
{	//是否出局

	
	function is_out($position,$value){
		include('Connections/sc.php');mysql_query("set names utf8");
		session_start();
		mysql_select_db($database_sc, $sc);
		$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");
		date_default_timezone_set('Asia/Taipei');
		$p_total = 0;
		$meet_the_conditions ="";
		//
		if($value == 0)
		{
			$fposition = floor($position/4);
		}else if($value == 1){
			$fposition = $position;
		}
		//

		
		$objQueue = new Queue;
		$objQueue->EnQueue($fposition);
		$get = $objQueue->DeQueue();
		for($i=1 ;$i<=3 ;$i++)
		{
			$get = $get*2;
			$objQueue->EnQueue($get);
			$get = $get+1;
			$objQueue->EnQueue($get);
			$get = $objQueue->DeQueue();
		}
		$arr = $objQueue->arrQueue;

		for($i=0; $i<count($arr); $i++)
		{
			
			if($i == 0)
			{
				#echo $arr[0];
				$select_isout ="SELECT * FROM fd WHERE filling_position =$arr[$i]";
				$query_isout =mysql_query($select_isout, $sc) or die(mysql_error());
				$row_isout  = mysql_fetch_assoc($query_isout);
				$top_at = $row_isout['at'];
				$top_amount = $row_isout['fd_amount'];
				$top_fuser = $row_isout['c_fuser'];
				$top_card = $row_isout['card'];
				$top_number = $row_isout['number'];
				
				//本身出局 (推薦數 > 出局數)
				if($top_amount == 120000 || $top_amount == 50000 || $top_amout == 21100)
				{
					//5方案者第一次出局要推薦一人才能出局(不可自購)
					if($top_amount == 50000)
					{
						
						//找有無出局分身
						$select_4 ="SELECT * FROM memberdata WHERE number ='$top_number' and assessment=1";
						$query_4 =mysql_query($select_4, $sc) or die(mysql_error());
						$row_4  = mysql_num_rows($query_4);
						//第一次出局
						if($row_4 == 0)
						{
							return false;
						}
						
					}
						//檢查推廣數
						$select_out="SELECT f_tog,number,card FROM memberdata WHERE number IN (SELECT number FROM fd WHERE filling_position =$arr[$i])";
						$query_out =mysql_query($select_out, $sc) or die(mysql_error());
						$row_out = mysql_fetch_assoc($query_out);
						$top_number = $row_out['number'];
						//$top_card = $row_out['card'];
						$top_f_tog = $row_out['f_tog'];//推薦,自購都累計
						
						
						$select_top="SELECT * FROM fd WHERE number='$top_number' and at=1";
						$query_top =mysql_query($select_top, $sc) or die(mysql_error());
						$num_top = mysql_num_rows($query_top);
						//推薦數大於出局次數 或者 自購次數大於出局次數
						
						if($top_f_tog - $num_top >0)
						{
							
							$meet_the_conditions ="ok";
						}
				//自購球 or 出局分身再出局 (推薦數 > 出局數)
				}else if($top_amount == 30000 || $top_amount == -1){
					
					$select_fnumber ="SELECT filling_position FROM fd WHERE card='$top_fuser' ";
					$query_fnumber =mysql_query($select_fnumber, $sc) or die(mysql_error());
					$row_fnumber = mysql_fetch_assoc($query_fnumber);
					$fposition = $row_fnumber['filling_position'];
					$select_out="SELECT f_tog,number FROM memberdata WHERE number IN (SELECT number FROM fd WHERE filling_position =$fposition)";
					$query_out =mysql_query($select_out, $sc) or die(mysql_error());
					$row_out = mysql_fetch_assoc($query_out);
					$top_number = $row_out['number'];
					$top_f_tog = $row_out['f_tog'];

					$select_top="SELECT * FROM fd WHERE number='$top_number' and at=1";
					$query_top =mysql_query($select_top, $sc) or die(mysql_error());
					$num_top = mysql_num_rows($query_top);
						
					if($top_f_tog - $num_top >0)
					{
						$meet_the_conditions ="ok";						
					}else{
						return false;
					}
				//營運球(無條件無局1次)
				}else{
					$select_out="SELECT f_tog,number FROM memberdata WHERE number IN (SELECT number FROM fd WHERE filling_position =$arr[$i])";
					$query_out =mysql_query($select_out, $sc) or die(mysql_error());
					$row_out = mysql_fetch_assoc($query_out);
					$top_number = $row_out['number'];
					$top_f_tog = $row_out['f_tog'];
					$meet_the_conditions ="ok";
				}

			}else{
				
				$select_exist="SELECT * FROM fd WHERE filling_position =$arr[$i]";
				$query_exist = mysql_query($select_exist, $sc) or die(mysql_error());
				$num_exist = mysql_num_rows($query_exist);
			}
			
			if($num_exist >0 && $top_at ==0 && $arr[$i] <= $arr[0]*4+4)
			{
				$p_total++;
			}
		}
		
		
		if($p_total ==6 && $meet_the_conditions =="ok")
		{
			$new_position = $this->complete_out($arr[0],$top_number,$top_card);
			return $new_position;
		}else if($p_total == 6){
			//自動購球事件
			$obj_event = new Promotions;
			$obj_event -> purchase_event($top_number);
			$new_position = $this->complete_out($arr[0],$top_number,$top_card);
			return $new_position;
			
		}else{
			return false;
		}
	}
	//滿足出局
	function complete_out($top_position,$top_number,$top_card)
	{
		
		include('Connections/sc.php');mysql_query("set names utf8");
		date_default_timezone_set('Asia/Taipei');
		mysql_select_db($database_sc, $sc);$bo="boss";

		$query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");

		$Reci = mysql_query($query_Reci, $sc) or die(mysql_error());

		$row_Reci = mysql_fetch_assoc($Reci);

		$num_box=$row_Reci['fd_box'];

		$num_z=$row_Reci['fd_m'];
		$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");
		

		if(date("m") != $num_z) {

		   $numz=date("m");

		   $update11="UPDATE admin SET fd_m=$numz WHERE username='$bo'";

		   mysql_select_db($database_sc, $sc);

		   $Result11 = mysql_query($update11, $sc) or die(mysql_error());

		   $num_box=1;

		}

		if ($num_box == 100000) {echo "設定值巳超過99999單號，請洽系統工程師。";exit;}

		if ($num_box < 10) {$fdnumber="SN".date("ymd")."0000".$num_box;$fdcard="f".date("ym")."0000".$num_box;}

		if ($num_box > 9 && $num_box < 100) {$fdnumber="SN".date("ymd")."000".$num_box;$fdcard="f".date("ym")."000".$num_box;}

		if ($num_box < 1000 && $num_box > 99) {$fdnumber="SN".date("ymd")."00".$num_box;$fdcard="f".date("ym")."00".$num_box;}

		if ($num_box < 10000 && $num_box > 999) {$fdnumber="SN".date("ymd")."0".$num_box;$fdcard="f".date("ym")."0".$num_box;}
		
		if ($num_box < 100000 && $num_box > 9999) {$fdnumber="SN".date("ymd").$num_box;$fdcard="f".date("ym").$num_box;}

		$new_num_box=$num_box+1;

		$update11="UPDATE admin SET fd_box=$new_num_box WHERE username='$bo'";

		mysql_select_db($database_sc, $sc);

		$Result11 = mysql_query($update11, $sc) or die(mysql_error());

		//out
		
		$update11="UPDATE fd SET at=1,note='$fdcard',okdata='$date' WHERE filling_position='$top_position'";

        mysql_select_db($database_sc, $sc);

        $Result11 = mysql_query($update11, $sc) or die(mysql_error());

		//我系大公排
		

		$select_position = "SELECT filling_position,card,name,(SELECT m_username FROM memberdata WHERE number='$top_number') as m_username FROM fd WHERE number ='$top_number' ORDER BY id ASC" ;
		$query_position = mysql_query($select_position, $sc) or die(mysql_error());
		$row_position = mysql_fetch_assoc($query_position);
		$fposition = $row_position["filling_position"];
		$fcard = $row_position["card"];
		$m_nick = $row_position["name"];
		$m_username = $row_position['m_username'];
		
		
		//掃描空位置
		$objQueue = new Queue;
		$filling_position = $fposition;
		do{
			
			if(empty($index))
			{
				$objQueue->EnQueue($filling_position);
				
				
			}else{
				$index = $index*2;
				$objQueue->EnQueue($index);
				$index = $index+1;
				
				$objQueue->EnQueue($index);
				
			}
			
			$index = $objQueue->DeQueue();
			
			$scanning ="SELECT * FROM fd WHERE filling_position = '$index'";
			$query_scanning = mysql_query($scanning, $sc) or die(mysql_error());
			$num_scanning = mysql_num_rows($query_scanning);
			 
		}while ( $num_scanning >0 );
		//
		if($index % 2 ==0){$gw = 'L';}else{$gw = 'R';};
		$nyear = $year +1;
		$gindex = floor($index/2); //上層的位置
		$select_gposition = "SELECT * FROM fd WHERE filling_position ='$gindex'";
		$query_gposition = mysql_query($select_gposition, $sc) or die(mysql_error());
		$row_gposition = mysql_fetch_assoc($query_gposition);
		$g_user = $row_gposition['card']; //上層的card

		$query_Recxf = sprintf("SELECT * FROM fd WHERE number = '$top_number' and card ='$fcard'");

		$Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());

		$row_Recxf = mysql_fetch_assoc($Recxf);

		$totalRows_Recxf = mysql_num_rows($Recxf);
		$amount = $row_Recxf['fd_amount'];
		
			//
		

			mysql_select_db($database_sc, $sc);
			//營運球限出局一次 amount = 0 = 營運球
			if($amount ==0)
			{
				$fd_amount = -1;
				$insertCommand13="INSERT INTO fd (number, card, name, c_fuser, c_guser, gtow, filling_position, fd_amount, year, moom, day, end_y, end_m, end_d, at, date, time) VALUES ('$top_number', '$fdcard', '$m_nick', '$fcard', '$g_user', '$gw', '$index','$fd_amount', '$year', '$moom', '$day', '$nyear', '$moom', '$day', 1, '$date', '$time')"; 
				mysql_query($insertCommand13,$sc);
			}else{
				$fd_amount = -1;
				$insertCommand13="INSERT INTO fd (number, card, name, c_fuser, c_guser, gtow, filling_position, fd_amount, year, moom, day, end_y, end_m, end_d, at, date, time) VALUES ('$top_number', '$fdcard', '$m_nick', '$fcard', '$g_user', '$gw', '$index','$fd_amount', '$year', '$moom', '$day', '$nyear', '$moom', '$day', 0, '$date', '$time')"; 
				mysql_query($insertCommand13,$sc);
			}
			//入單補營運球
			if(!empty($index))
			{
				$promotions_odj = new Promotions;
				$promotions_odj->join_event($index);
			}
			 
			//從組織營運扣款
			$pout = 40000;
			
			$query_Recpd = sprintf("SELECT * FROM pay_b ORDER BY id DESC");

			$Recpd = mysql_query($query_Recpd, $sc) or die(mysql_error());

			$row_Recpd = mysql_fetch_assoc($Recpd);

			$totalRows_Recpd = mysql_num_rows($Recpd);
			
			$newcpsum=$row_Recpd['psum']-$pout;
			$pud_name = "集滿福袋($m_username)";
			mysql_select_db($database_sc, $sc);

			$insertCommand13="INSERT INTO pay_b (pout, psum, number, card, at, date, time, pud_name) VALUES ('$pout', '$newcpsum', '$top_number', '$top_card', '$pat', '$date', '$time', '$pud_name')"; 
			/////
			
			mysql_query($insertCommand13,$sc);
			//gold_m
			$note = "集滿福袋獎勵積分<br/>帳號：$m_username";
			$sncode = $top_number."-".date("ymdhis");
			$glevel = 4;
			$inserBonus ="INSERT INTO gold_m(number, year, moom, day, z, g, note, level, sncode, at, date, time) VALUES ('$top_number', '$year', '$moom', '$day', '$z', '$pout', '$note', '$glevel', '$sncode', 0, '$date', '$time')";
			mysql_query($inserBonus,$sc);
			//
			$obj_reservoir = new Reservoir();
			$obj_reservoir->ball($index);
		
		 
		return $index;
	}
}


?>