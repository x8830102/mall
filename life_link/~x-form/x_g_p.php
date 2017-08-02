<? 
require_once('Connections/sc.php');mysql_query("set names utf8");
require_once( dirname(dirname(__FILE__)) .'/class/queue.class.php' );
require_once( 'is_out.php' );
require_once( 'Promotions.php' );
require_once( 'Reservoir.php');


session_start();
ob_start();
date_default_timezone_set('Asia/Taipei');
$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");
$sn=$_POST['sn'];//echo $sn;exit;
if ($sn == "") {header(sprintf("Location: /life_link/index.php"));exit;}
mysql_select_db($database_sc, $sc);

$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: /life_link/index.php"));exit;}
$name=$row_Recsn['m_name'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<div id="divLoading" style="color:red; position:absolute; top:166px; left:703px;">

<img src="http://cmg588.com/life_link/ajax-loader.gif" border="0" style="vertical-align:middle;padding:6px"/>



</div>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td height="100" align="center">&nbsp;</td>
  </tr>
  <tr>

    <td align="center">運算資訊中，請勿關閉或動任何行為…，請稍候...</td>

  </tr>

  <tr>

    <td align="center">進度： 準備開始</td>

  </tr>

</table>

<?php 
	$ter=$_POST['ter'];
	$fuser=$_POST['fuser'];
	$fnumber=$_POST['fnumber'];
	$newuser=$_POST['newuser'];
	$m_passwd=$_POST['m_passwd'];
	$m_passtoo=$_POST['m_passtoo'];$mok=1;
	$coc=$_POST['coc'];
	$m_sex=$_POST['m_sex'];
	$m_birthday=$_POST['birthday'];
	$m_callphone=$_POST['m_callphone'];
	$m_email=$_POST['m_email'];
	$m_nick=$_POST['m_nick'];
	$Tnumber=$_POST['Tnumber'];
	$pudid=$_POST['pudid'];
	$snumber=$_POST['snumber'];
	$b_pud=$_POST['b_pud']+0;
    $as_at=$_POST['as_at'];
	$as_number=$_POST['as_number'];
	$as_name=$_POST['as_name'];
	$notpay =$_POST["notpay"];
	$district=$_POST['district'];
	$fuser2=$_POST['fuser2'];
	$businessRatio=$_POST['businessRatio'];
	$districtRatio=$_POST['districtRatio'];
	mysql_select_db($database_sc, $sc);//echo "###",$pudid;exit;

	if(!empty($fuser2))
	{
		$query = "SELECT * FROM memberdata WHERE m_username = '$fuser2' ";
		$result = mysql_query($query, $sc) or die(mysql_error());
		$resultRow = mysql_fetch_assoc($result);
		$fuser2 = $resultRow['number'];
	}
	$query_Recapud = sprintf("SELECT * FROM a_pud WHERE id='$pudid'");// 
	$Recapud = mysql_query($query_Recapud, $sc) or die(mysql_error());
	$row_Recapud = mysql_fetch_assoc($Recapud);
	$totalRows_Recapud = mysql_num_rows($Recapud);

	
	$pud_p = $row_Recapud['af'];
	$apud_a=$row_Recapud['p'];
	$pud_name = $row_Recapud['name'];
	$fd = $row_Recapud['fd'];
	//

	$date=date("Y-m-d");$time=date("H:i:s");$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");

	//number

	mysql_select_db($database_sc, $sc);$bo="boss";

    $query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");

    $Reci = mysql_query($query_Reci, $sc) or die(mysql_error());

    $row_Reci = mysql_fetch_assoc($Reci);

    $num_box=$row_Reci['num_box'];

    $num_z=$row_Reci['num_z'];

    if(date("m") != $num_z) {

	   $numz=date("m");

	   $update11="UPDATE admin SET num_z='$numz' WHERE username='$bo'";

       mysql_select_db($database_sc, $sc);

       $Result11 = mysql_query($update11, $sc) or die(mysql_error());

	   $num_box=1;

	   }

    if ($num_box == 100000) {echo "設定值巳超過99999單號，請洽系統工程師。";exit;}

    if ($num_box < 10) {$number="SN".date("ymd")."0000".$num_box;$card=date("ym")."0000".$num_box;}

    if ($num_box > 9 && $num_box < 100) {$number="SN".date("ymd")."000".$num_box;$card=date("ym")."000".$num_box;}

    if ($num_box < 1000 && $num_box > 99) {$number="SN".date("ymd")."00".$num_box;$card=date("ym")."00".$num_box;}

	if ($num_box < 10000 && $num_box > 999) {$number="SN".date("ymd")."0".$num_box;$card=date("ym")."0".$num_box;}

	if ($num_box < 100000 && $num_box > 9999) {$number="SN".date("ymd").$num_box;$card=date("ym").$num_box;}
	$new_num_box=$num_box+1;

    $update11="UPDATE admin SET num_box='$new_num_box' WHERE username='$bo'";

    mysql_select_db($database_sc, $sc);

    $Result11 = mysql_query($update11, $sc) or die(mysql_error());

	//

	mysql_select_db($database_sc, $sc);

	if(!empty($notpay))
	{	/*特殊入單(未繳費)
		*	$notpa			已付款金額
		*	$notpay_c		負數欠款
		*	$notpay_cout	正數欠款
		*
		*/
		
		mysql_select_db($database_sc, $sc);
		$onote="註冊扣值(".$pud_name.")<br/>帳號：".$newuser;
		$notpay_c = $notpay - $apud_a-3000;
		$notpay_cout = $apud_a - $notpay+3000;
		$sncode=$number."-".date("ymdhis");
		
		$query_Recob = sprintf("SELECT * FROM o_cash WHERE number='$snumber' ORDER BY id DESC");// 
		$Recob = mysql_query($query_Recob, $sc) or die(mysql_error());
		$row_Recob = mysql_fetch_assoc($Recob);
		$totalRows_Recob = mysql_num_rows($Recob);
		
		if ($row_Recob['csum'] >= $notpay) {
			$new_ob=$row_Recob['csum']-$notpay;
			$onote="註冊扣值, (".$pud_name.")<br/>帳號：".$newuser;
			mysql_select_db($database_sc, $sc);
			$insertCommand13="INSERT INTO o_cash (number, cout, csum, note, date, time) VALUES ('$snumber', '$notpay', '$new_ob', '$onote', '$date', '$time')"; 
			mysql_query($insertCommand13,$sc);
			$c_note = "補福音積分".number_format($notpay_cout)."<br>行政事務費3,000";
			/*$insert_c_cash="INSERT INTO c_cash (number, cout, csum, note, date, time, sncode) VALUES ('$number', '$notpay_cout', '$notpay_c','$c_note', '$date', '$time', '$sncode')";
			mysql_query($insert_c_cash,$sc);*/
			$insert_ar="INSERT INTO pay_ar (number, arrears, Tnumber, date) VALUES ('$number', '$notpay_c', '$Tnumber', '$date')";
			mysql_query($insert_ar,$sc);
			
		} else {
			header(sprintf("Location: /life_link/new_account-1.php?err=我的註冊積分不足"));
			exit;
		}
		
	}else{
		
		//正常入單 扣關係人註冊積分
		$query_Recob = sprintf("SELECT * FROM o_cash WHERE number='$snumber' ORDER BY id DESC");// 
		$Recob = mysql_query($query_Recob, $sc) or die(mysql_error());
		$row_Recob = mysql_fetch_assoc($Recob);
		$totalRows_Recob = mysql_num_rows($Recob);
		$o_csum = $row_Recob['csum'];
		if(empty($o_csum)){$o_csum = 0;}
		if ($o_csum >= $apud_a) {
			$new_ob=$o_csum-$apud_a;
			$onote="註冊扣值, (".$pud_name.")<br/>帳號：".$newuser;

			mysql_select_db($database_sc, $sc);
			$insertCommand13="INSERT INTO o_cash (number, cout, csum, note, date, time) VALUES ('$snumber', '$pud_p', '$new_ob', '$onote', '$date', '$time')"; 
			mysql_query($insertCommand13,$sc);
			
			$insertCommand3="INSERT INTO memberdata (fname, m_nick, card, m_username, m_passwd, m_passtoo, number, m_fuser, a_pud, b_pud, ks, m_ok, year, moom, day, z, m_sex, m_email, m_joinDate, m_callphone, st, date, time, fpay, as_at, as_number, as_name) VALUES ('$fuser', '$m_nick', '$card', '$newuser', '$m_passwd', '$m_passtoo', '$number', '$fnumber', '$pudid', '$b_pud', '$pud_p', '$mok', '$year', '$moom', '$day', '$z', '$m_sex', '$m_email', '$date', '$m_callphone', '$st', '$date', '$time', '$fpay', '$as_at', '$as_number', '$as_name')"; 

			mysql_query($insertCommand3,$sc);
			//
			if($pudid == 7 || $pudid == 9 || $pudid == 10){
				$update11="UPDATE memberdata SET assessment=1 WHERE number = '$number'";
				mysql_select_db($database_sc, $sc);
				$Result11 = mysql_query($update11, $sc) or die(mysql_error());
			}
		} else {
			header(sprintf("Location: /life_link/new_account-1.php?err=我的註冊積分不足"));
			exit;
		}
	}
	
  

	//Add to oc
		$salt = substr(md5(uniqid(rand(), true)), 0, 9);
		$pdo = new PDO("mysql:host=localhost;dbname=twlifeli_ocmall;charset=utf8","twlifelinkcom","rgn26842");
		$check = $pdo->query("SELECT email FROM oc_customer WHERE email = '$m_email' ");
		$check = $check->fetch();
		if(empty($check)){
			$query = $pdo->query("INSERT oc_customer SET 
				customer_group_id = '1',
				number = '$number',
				m_username = '$newuser',
				firstname = '$m_nick',
				email = '$m_email',
				password = '".sha1($salt . sha1($salt . sha1($m_passwd)))."',
				salt = '$salt',
				status = '1',
				approved = '1',
				date_added = NOW() ");
		}
		
		if($pudid > 1){
			$check = $pdo->query("SELECT email FROM oc_user WHERE email = '$m_email' ");
			$check = $check->fetch();
			if(empty($check)){
				$query = $pdo->query("INSERT oc_user SET 
					user_group_id = '50',
					username = '$newuser',
					password = '".sha1($salt . sha1($salt . sha1($m_passwd)))."',
					salt = '$salt',
					lastname = '$m_nick',
					email = '$m_email',
					status = '1',
					date_added = NOW()");
				$query = $pdo->query("INSERT oc_vendors SET 
					vendor_name = '$m_nick',
					lastname = '$m_nick',
					email = '$m_email',
					country_id = '206',
					commission_id = '0',
					product_limit_id = '$pudid',
					user_id = (SELECT user_id FROM oc_user WHERE email = '$m_email'),
					date_add = NOW()");
				$query = $pdo->query("UPDATE oc_user SET vendor_permission = (SELECT vendor_id FROM oc_vendors WHERE email = '$m_email') WHERE email = '$m_email'");
			}
		}
		$pdo = NULL;

	    //enc oc
		
		
	/**進水庫
	* number	新單編號
	* card		新單card
	* pudid		新單專案
	* Tnumber 	講師
	* notpay	欠款(已付數目)
	* fuser2	業務2
	* businessRatio	業務配比
	* districtRatio	行政區配比
	* district	行政區(場地)
	**/
	$obj_reservoir = new reservoir;
	$total = $obj_reservoir->new_in($number,$card,$pudid,$Tnumber,$notpay,$fuser2,$businessRatio,$districtRatio,$district);
	//
    //
	$gk=3;unset($gg);$gg=array(300,150,100);$gi=0;$ga=$newuser;$date=date("Y-m-d");$time=date("H:i:s");
	while ($gk != 0) {
		mysql_select_db($database_sc, $sc);
        $query_Recb3 = sprintf("SELECT * FROM memberdata WHERE m_username = '$ga'");
        $Recb3 = mysql_query($query_Recb3, $sc) or die(mysql_error());
        $row_Recb3 = mysql_fetch_assoc($Recb3);
        $totalRows_Recb3 = mysql_num_rows($Recb3);
	    $bnum=$row_Recb3['number'];//echo $bnum;exit;
		mysql_select_db($database_sc, $sc);
        $query_Recr2 = sprintf("SELECT * FROM r_cash WHERE number = '$bnum' ORDER BY id DESC");
        $Recr2 = mysql_query($query_Recr2, $sc) or die(mysql_error());
        $row_Recr2 = mysql_fetch_assoc($Recr2);
        $totalRows_Recr2 = mysql_num_rows($Recr2);
		$ggv=$gg[$gi];if ($totalRows_Recr2 != 0) {$gs=$row_Recr2['csum'];} else {$gs=0;}
		$new_ggv=$gs+$ggv;//echo $ggv,"##",$gs,"<br/>";
		$y_note="新註冊贈紅利<br/>帳號：".$newuser;
		$sncode=$bnum."-".date("ymdhis");

		$gold_f=$ggv;$glevel=10;$at=1;
	    $fnote="新註冊贈紅利<br/>帳號：".$newuser;
	    
        $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$bnum', '$year', '$moom', '$day', '$z', '$gold_f', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
        mysql_query($insertCommand15,$sc);
		
		$query_r = sprintf("SELECT * FROM gold_m WHERE number = '$bnum' ORDER BY id DESC");//
        $Recbr = mysql_query($query_r, $sc) or die(mysql_error());
        $row_Recbr = mysql_fetch_assoc($Recbr);
		$gold_id =$row_Recbr['id'];
		
		$insertCommand13="INSERT INTO r_cash (number, cin, csum, note, date, time, gold_id) VALUES ('$bnum', '$ggv', '$new_ggv', '$y_note', '$date', '$time', '$gold_id')"; 
        mysql_query($insertCommand13,$sc);
		$gk--;$gi++;if ($row_Recb3['fname'] != "") {$ga=$row_Recb3['fname'];} else {break;}
		}
	//
	
	mysql_select_db($database_sc, $sc);

    $insertCommand3="INSERT INTO bank (number, coc, phone, email) VALUES ('$number', '$coc', '$m_callphone', '$m_email')"; 

    mysql_query($insertCommand3,$sc);

	//推薦人考核通過
	if($pudid >=4)
	{
		$update11="UPDATE memberdata SET assessment=1 WHERE number = '$fnumber'";
		mysql_select_db($database_sc, $sc);
		$Result11 = mysql_query($update11, $sc) or die(mysql_error());

	}
	
	//infd
	if ($pudid >= 5 ) {
	//推薦累計
	mysql_select_db($database_sc, $sc);
	$query_Recmem_f = sprintf("SELECT * FROM memberdata WHERE m_username='$fuser'");
	$Recmem_f = mysql_query($query_Recmem_f, $sc) or die(mysql_error());
	$row_Recmem_f = mysql_fetch_assoc($Recmem_f);
	$totalRows_Recmem_f = mysql_num_rows($Recmem_f);
	$new_f_tog=$row_Recmem_f['f_tog']+1;
	$update11="UPDATE memberdata SET f_tog='$new_f_tog' WHERE m_username = '$fuser'";
	mysql_select_db($database_sc, $sc);
	$Result11 = mysql_query($update11, $sc) or die(mysql_error());
	//
			//fd-number

		//我系大公排

	if ($pudid >= 5 && $fd == 1) {
		
		mysql_select_db($database_sc, $sc);$bo="boss";

		$query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");

		$Reci = mysql_query($query_Reci, $sc) or die(mysql_error());

		$row_Reci = mysql_fetch_assoc($Reci);

		$num_box=$row_Reci['fd_box'];

		$num_z=$row_Reci['fd_m'];

		if(date("m") != $num_z) {

		   $numz=date("m");

		   $update11="UPDATE admin SET fd_m='$numz' WHERE username='$bo'";

		   mysql_select_db($database_sc, $sc);

		   $Result11 = mysql_query($update11, $sc) or die(mysql_error());

		   $num_box=1;

		   }

		if ($num_box == 100000) {echo "設定值巳超過99999單號，請洽系統工程師。";exit;}

		if ($num_box < 10) {$fdnumber="SN".date("ymd")."0000".$num_box;$fdcard="f".date("ym")."0000".$num_box;}

		if ($num_box > 9 && $num_box < 100) {$fdnumber="SN".date("ymd")."00".$num_box;$fdcard="f".date("ym")."000".$num_box;}

		if ($num_box < 1000 && $num_box > 99) {$fdnumber="SN".date("ymd")."00".$num_box;$fdcard="f".date("ym")."00".$num_box;}

		if ($num_box < 10000 && $num_box > 999) {$fdnumber="SN".date("ymd")."0".$num_box;$fdcard="f".date("ym")."0".$num_box;}

		if ($num_box < 100000 && $num_box > 9999) {$fdnumber="SN".date("ymd").$num_box;$fdcard="f".date("ym").$num_box;}

		$new_num_box=$num_box+1;

		$update11="UPDATE admin SET fd_box='$new_num_box' WHERE username='$bo'";

		mysql_select_db($database_sc, $sc);

		$Result11 = mysql_query($update11, $sc) or die(mysql_error());

			//推薦人位置
			
			$select_position = "SELECT * FROM fd WHERE number ='$fnumber'  ORDER BY id ASC" ;
			$query_position = mysql_query($select_position, $sc) or die(mysql_error());
			$row_position = mysql_fetch_assoc($query_position);
			$fposition = $row_position["filling_position"];
			$fcard = $row_position["card"];
			//判斷入單位置
			$m_fuser = $fnumber;
			/*do{
				$select_position = "SELECT * FROM fd WHERE number ='$m_fuser'" ;
				$query_position = mysql_query($select_position, $sc) or die(mysql_error());
				$row_position = mysql_fetch_assoc($query_position);
				$fposition = $row_position["filling_position"];
				$fcard = $row_position["card"];
				if(empty($fposition))
				{
					$select_position = "SELECT * FROM memberdata WHERE number ='$m_fuser'" ;
					$query_position = mysql_query($select_position, $sc) or die(mysql_error());
					$row_position = mysql_fetch_assoc($query_position);
					$m_fuser = $row_position["m_fuser"];
					$m_guser = $row_position["m_guser"];
					if(empty($m_fuser)){
						$m_fuser = $m_guser;
					}
				}
			}while(empty($fposition));*/
			//
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
			
			
			if($index % 2 ==0){$gw = 'L';}else{$gw = 'R';};
			$nyear = $year +1;
			$gindex = floor($index/2); //上層的位置
			$select_gposition = "SELECT * FROM fd WHERE filling_position ='$gindex'";
			$query_gposition = mysql_query($select_gposition, $sc) or die(mysql_error());
			$row_gposition = mysql_fetch_assoc($query_gposition);
			$g_user = $row_gposition['card']; //上層的card
			
			$query_Recxf = sprintf("SELECT * FROM fd WHERE number = '$number' && card='$fdcard' && gtow='$gw'");

            $Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());

            $row_Recxf = mysql_fetch_assoc($Recxf);

            $totalRows_Recxf = mysql_num_rows($Recxf);
		//
		if ($totalRows_Recxf == 0) {
			//新人福袋
			$fd_amount = $apud_a;
			$insertCommand13="INSERT INTO fd (number, card, name, c_fuser, c_guser, gtow, filling_position, fd_amount, year, moom, day, end_y, end_m, end_d, date, time) VALUES ('$number', '$fdcard', '$m_nick', '$fcard', '$g_user', '$gw', '$index','$fd_amount', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time')"; 
			mysql_query($insertCommand13,$sc);
			//入單 out
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
			//

			//入單補營運球
			if(!empty($index))
			{
				$promotions_odj = new Promotions;
				$promotions_odj->join_event($index);
			}
			//
			//推廣補球
			/*$promotions_odj = new Promotions;
			if(!empty($p_position) && !empty($index))
			{
				$promotions_odj-> promoting_event($p_position,$index);

			}*/
			/////
			
		}
///////////////////////
	}
	
	}//3
	
	ob_end_flush();
///////////////////////////////////////////////////////
	$_SESSION['sn']=$sn;$_SESSION['gfus']=$fnumber;$_SESSION['newnr']=$number;$_SESSION['pudid']=$pudid;$_SESSION['fdcard']=$fdcard;
	
	?>

<script type="text/javascript">document.location.href="x_g_f.php";</script>