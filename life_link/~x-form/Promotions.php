<?php
	class Promotions
	{
		function promoting_event($position,$newposition){
			//推廣補球
			date_default_timezone_set('Asia/Taipei');
			include('Connections/sc.php');mysql_query("set names utf8");
			$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");$nyear = $year +1;
			mysql_select_db($database_sc, $sc);
			$scanning ="SELECT * FROM fd WHERE c_fuser = (select card FROM fd WHERE filling_position = '$position') and fd_amount>=49980";
			$query_scanning = mysql_query($scanning, $sc) or die(mysql_error());
			$num_scanning = mysql_num_rows($query_scanning);
			
			if($num_scanning>1)
			{	//查看營運球夠不夠
				$select_operation_ball ="SELECT * FROM operation_ball WHERE use_status=0 ORDER BY id ASC";
				$query_operation_ball = mysql_query($select_operation_ball,$sc);
				$row_operation_ball = mysql_fetch_assoc($query_operation_ball);
				$num_ball = mysql_num_rows($query_operation_ball);
				
				if($num_ball <=0)
				{
					//球不夠 資金還有
					$select_balnce ="SELECT * FROM cmg_investment WHERE op_balance != 0";
					$query_balnce = mysql_query($select_balnce,$sc);
					$num_balnce = mysql_num_rows($query_balnce);
					if($num_balnce > 0)
					{
						include(dirname(dirname(__FILE__))."/assign_ball.php");
					}
					//
				}
				$select_operation_ball ="SELECT * FROM operation_ball WHERE use_status=0 ORDER BY id ASC";
				$query_operation_ball = mysql_query($select_operation_ball,$sc);
				$row_operation_ball = mysql_fetch_assoc($query_operation_ball);
				$num_ball = mysql_num_rows($query_operation_ball);
				if($num_ball > 0)
				{
					$obcard = $row_operation_ball['card'];
					$obnumber = $row_operation_ball['number'];
					$obfd_amount = $row_operation_ball['ball_amount'];
					$obfnumber = $row_operation_ball['fnumber'];
					
					
					$objQueue = new Queue;
					do{
					
						if(empty($obindex))
						{
							$objQueue->EnQueue($position);
							
							
						}else{
							$obindex = $obindex*2;
							$objQueue->EnQueue($obindex);
							$obindex = $obindex+1;
							
							$objQueue->EnQueue($obindex);
						
						}
						
						 $obindex = $objQueue->DeQueue();
						
						 $scanning ="SELECT * FROM fd WHERE filling_position = '$obindex'";
						 $query_scanning = mysql_query($scanning, $sc) or die(mysql_error());
						 $num_scanning = mysql_num_rows($query_scanning);
						 if($num_scanning <= 0)
						 {
							 
							$top_index = floor($obindex/2);
							$scanning_top ="SELECT * FROM fd WHERE filling_position = '$top_index'";
							$query_scanning_top = mysql_query($scanning_top, $sc) or die(mysql_error());
							$row_scanning_top = mysql_fetch_assoc($query_scanning_top);
							$top_amount = $row_scanning_top['fd_amount'];
							if($top_amount != 0)
							{
								$promoting_ok = 1;
							}
						 }
					}while ( empty($promoting_ok));
					
					//上層位置
					$gobindex = floor($obindex/2); 
					$select_gposition = "SELECT * FROM fd WHERE filling_position ='$gobindex'";
					$query_gposition = mysql_query($select_gposition, $sc) or die(mysql_error());
					$row_gposition = mysql_fetch_assoc($query_gposition);
					$g_user = $row_gposition['card']; //上層的card
					//echo $obindex;
					
					if($obindex % 2 ==0){$obgw = 'L';}else{$obgw = 'R';};
					
					$insert_operation_ball="INSERT INTO fd (number, card, name, c_guser, gtow, filling_position, fd_amount, year, moom, day, end_y, end_m, end_d, date, time, note) VALUES ('$obnumber', '$obcard', '$obfnick', '$g_user', '$obgw', '$obindex',0, '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time', '推廣補球')"; 
					mysql_query($insert_operation_ball,$sc);
					//check out
						$objout = new out;
						
						do{
							if(empty($i))
							{
								$loop_out = $objout->is_out($obindex,0);
							}else{
								$loop_out = $objout->is_out($loop_out,0);
							}
							$i++;
						}while($loop_out);
					//
					$update_operation_ball="UPDATE operation_ball SET use_status=1,filling_date='$date' WHERE card ='$obcard'";
					$query_operation_ball = mysql_query($update_operation_ball,$sc);
					//營運球推薦人獎金
					$select_obfnumber = "SELECT m_username FROM memberdata WHERE number=(SELECT number FROM fd WHERE filling_position=$newposition)";
					$query_obfnumber = mysql_query($select_obfnumber, $sc) or die(mysql_error());
					$row_obfnumber = mysql_fetch_assoc($query_obfnumber);
					$obusername = $row_obfnumber['m_username'];
					
					$note ="串愛積分<br>帳號:".$obusername;
					$sncode = $obfnumber."-".date("ymdhis");
					$insert_gold_m = "INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$obfnumber', '$year', '$moom', '$day', '$z', '3000', '$note', '1', '0', '$date', '$time', '$sncode')";
					$query_gold_m = mysql_query($insert_gold_m,$sc);
					//
				}
			}
		}
		/////新單送球
		function join_event($newposition)
		{
			date_default_timezone_set('Asia/Taipei');
			include('Connections/sc.php');mysql_query("set names utf8");
			$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");$nyear = $year +1;
			mysql_select_db($database_sc, $sc);
			//查看營運球夠不夠
			$select_operation_ball ="SELECT * FROM operation_ball WHERE use_status=0 ORDER BY id ASC";
			$query_operation_ball = mysql_query($select_operation_ball,$sc);
			$row_operation_ball = mysql_fetch_assoc($query_operation_ball);
			$num_ball = mysql_num_rows($query_operation_ball);
			if($num_ball <=0)
			{
				//球不夠 資金夠
				$select_balnce ="SELECT * FROM cmg_investment WHERE op_balance != 0";
				$query_balnce = mysql_query($select_balnce,$sc);
				$num_balnce = mysql_num_rows($query_balnce);
				if($num_balnce > 0)
				{
					include($_SERVER['DOCUMENT_ROOT']."/ai_main/assign_ball.php");
				}
				//
			}
			$select_operation_ball ="SELECT * FROM operation_ball WHERE use_status=0 ORDER BY id ASC";
			$query_operation_ball = mysql_query($select_operation_ball,$sc);
			$row_operation_ball = mysql_fetch_assoc($query_operation_ball);
			$num_ball = mysql_num_rows($query_operation_ball);
			if($num_ball > 0)
			{
				$obcard = $row_operation_ball['card']; //球自己的card
				$obnumber = $row_operation_ball['number'];
				$obfd_amount = $row_operation_ball['ball_amount'];
				$obfnumber = $row_operation_ball['fnumber'];//營運球推薦人
				
				
				
				$objQueue = new Queue;
				do{
					if(empty($obindex))
					{
						$objQueue->EnQueue($newposition);
						
						
					}else{
						$obindex = $obindex*2;
						$objQueue->EnQueue($obindex);
						$obindex = $obindex+1;
						
						$objQueue->EnQueue($obindex);
					
					}
					
					$obindex = $objQueue->DeQueue();
					//echo $obindex;
					$scanning ="SELECT * FROM fd WHERE filling_position = '$obindex'";
					$query_scanning = mysql_query($scanning, $sc) or die(mysql_error());
					$num_scanning = mysql_num_rows($query_scanning);
					if($num_scanning <= 0)
					{
						/*補右邊*/
						if($obindex %2 !=1)
						{
							$obindex = $obindex +1;
							$join_ok = 1;
						}
						//
					}
				
				}while (empty($join_ok));
				if($obindex % 2 ==0){$obgw = 'L';}else{$obgw = 'R';};
				
				$gobindex = floor($obindex/2); 
				$select_gposition = "SELECT * FROM fd WHERE filling_position ='$gobindex'";
				$query_gposition = mysql_query($select_gposition, $sc) or die(mysql_error());
				$row_gposition = mysql_fetch_assoc($query_gposition);
				$top_card = $row_gposition['card']; //上層的card
				
				$insert_operation_ball="INSERT INTO fd (number, card, c_guser, gtow, filling_position, fd_amount, year, moom, day, end_y, end_m, end_d, date, time, note) VALUES ('$obnumber', '$obcard', '$top_card', '$obgw', '$obindex',0, '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time', '新單補球')"; 
				mysql_query($insert_operation_ball,$sc);
				//check out
				$objout = new out;
				do{
					
					if(empty($j))
					{
						//echo $obindex."123";
						$loop_out = $objout->is_out($obindex,0);
					}else{
						
						$loop_out = $objout->is_out($loop_out,0);
					}
					$j++;
				}while($loop_out);
				//
				
				$update_operation_ball="UPDATE operation_ball SET use_status=1,filling_date='$date' WHERE card ='$obcard'";
				$query_operation_ball = mysql_query($update_operation_ball,$sc);
				$obj_reservoir = new Reservoir();
				$obj_reservoir->ball($obindex);
			}
			
		}
		//自動購球
		function purchase_event($number){
			date_default_timezone_set('Asia/Taipei');
			include('Connections/sc.php');mysql_query("set names utf8");
			require_once( $_SERVER['DOCUMENT_ROOT'] .'/life_link/class/queue.class.php' );
			$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");$nyear = $year +1;
			//自購球金額
		
			$query_Recapud = sprintf("SELECT * FROM a_pud WHERE id=5");
			$Recapud = mysql_query($query_Recapud, $sc) or die(mysql_error());
			$row_Recapud = mysql_fetch_assoc($Recapud);
			$my_p = $row_Recapud['my_p'];
			$select_st = "SELECT * FROM memberdata WHERE number = '$number'";
			$query_st = mysql_query($select_st, $sc) or die(mysql_error());
			$row_st = mysql_fetch_assoc($query_st);
			$top_fuser = $row_st['m_fuser'];
			$top_a_pupd = $row_st['a_pud'];
			$top_card = $row_st['card'];
			$top_st = $row_st['st'];
			$top_assessment =$row_st['assessment'];
			//
			
			$select_c = "SELECT * FROM c_cash WHERE number = '$number' ORDER BY id DESC";
			$query_c = mysql_query($select_c, $sc) or die(mysql_error());
			$row_c = mysql_fetch_assoc($query_c);
			$top_c_cash = $row_c['csum'];
			
			//自動購買球達成出局
			if($top_c_cash >= $my_p && $top_st == 1 && $top_assessment == 1)
			{
				$bo="boss";

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

				if ($num_box == 100000) {echo "設定值巳超過9999單號，請洽系統工程師。";exit;}

				if ($num_box < 10) {$fdnumber="SN".date("ymd")."0000".$num_box;$fdcard="f".date("ym")."0000".$num_box;}

				if ($num_box > 9 && $num_box < 100) {$fdnumber="SN".date("ymd")."000".$num_box;$fdcard="f".date("ym")."000".$num_box;}

				if ($num_box < 1000 && $num_box > 99) {$fdnumber="SN".date("ymd")."00".$num_box;$fdcard="f".date("ym")."00".$num_box;}

				if ($num_box < 10000 && $num_box > 999) {$fdnumber="SN".date("ymd")."0".$num_box;$fdcard="f".date("ym")."0".$num_box;}

				if ($num_box < 100000 && $num_box > 9999) {$fdnumber="SN".date("ymd").$num_box;$fdcard="f".date("ym").$num_box;}

				$new_num_box=$num_box+1;

				$update11="UPDATE admin SET fd_box=$new_num_box WHERE username='$bo'";

				mysql_select_db($database_sc, $sc);

				$Result11 = mysql_query($update11, $sc) or die(mysql_error());
				//我系大公排
	
				$select_position = "SELECT * FROM fd WHERE number ='$number'  ORDER BY id ASC" ;
				$query_position = mysql_query($select_position, $sc) or die(mysql_error());
				$row_position = mysql_fetch_assoc($query_position);
				$fposition = $row_position["filling_position"];
				$fcard = $row_position["card"];
				$m_nick = $row_position["name"];
				
				
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
				
				
				
					//
				if ($totalRows_Recxf == 0) {
					
					mysql_select_db($database_sc, $sc);
					
					$fd_amount = $my_p;
					$insertCommand13="INSERT INTO fd (number, card, name, c_fuser, c_guser, gtow, filling_position, fd_amount, year, moom, day, end_y, end_m, end_d, at, date, time, fnumber) VALUES ('$number', '$fdcard', '$m_nick', '$fcard', '$g_user', '$gw', '$index','$fd_amount', '$year', '$moom', '$day', '$nyear', '$moom', '$day', 0, '$date', '$time', '自動購球')"; 
					mysql_query($insertCommand13,$sc);
					$objout = new out;
					do{
						if(empty($x))
						{
							$loop_out = $objout->is_out($index,0);
						}else{
							$loop_out = $objout->is_out($loop_out,0);
						}
						$x++;
					}while($loop_out);
					
					$query_Recmem_f = sprintf("SELECT * FROM memberdata WHERE number='$number'");
					$Recmem_f = mysql_query($query_Recmem_f, $sc) or die(mysql_error());
					$row_Recmem_f = mysql_fetch_assoc($Recmem_f);
					$totalRows_Recmem_f = mysql_num_rows($Recmem_f);
					$new_f_tog=$row_Recmem_f['f_tog']+1;
					$update11="UPDATE memberdata SET f_tog='$new_f_tog' WHERE number = '$number'";
					mysql_select_db($database_sc, $sc);
					$Result11 = mysql_query($update11, $sc) or die(mysql_error());
					
					//扣串串
					$top_c_cash = $top_c_cash - $my_p;
					$note = "出局自動補福袋";
					$insert_c = "INSERT INTO c_cash (number,cout,csum,note,date,time) VALUES ('$number','$my_p','$top_c_cash','$note','$date','$time')";
					$query_insertc = mysql_query($insert_c, $sc);
					//
					//自購金額入水庫
					$obj_reservoir = new reservoir;
					$obj_reservoir->oneself_purchase($top_fuser,$number,$top_card,$top_a_pupd);
					//
				}

			}
		}
	}
?>