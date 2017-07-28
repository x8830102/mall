<? 
header("Content-Type:text/html; charset=utf-8");
date_default_timezone_set('Asia/Taipei');
require_once('Connections/sc.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/life_link/~x-form/is_out.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/life_link/~x-form/Promotions.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/life_link/~x-form/Reservoir.php');
require_once( $_SERVER['DOCUMENT_ROOT'] .'/life_link/class/queue.class.php' );
mysql_query("set names utf8");
session_start();
$penl=$_POST['penl'];
$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");
$sn=$_POST['sn'];$surl=$_POST['surl'];$_SESSION['surl']=$surl;//echo $sn;exit;

if ($sn == "") {header(sprintf("Location: http://".$surl));exit;}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: http://".$surl));exit;}
$name=$row_Recsn['m_name'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$fuser=$_POST['fuser'];//推薦人number

$fnumber=$_POST['fnumber'];
$newuser=$_POST['newuser'];
$m_email=$_POST['m_email'];
$m_nick=$_POST['m_nick'];
$fname=$_POST['fname'];
$fpays=$_POST['fpay'];
$pudid=$_POST['pudid'];
$pud_p=$_POST['pud_p'];
$pud_n=$_POST['pud_n'];
$as_at=$_POST['as_at'];
$as_number=$_POST['as_number'];
$as_name=$_POST['as_name'];
$note=$_POST['note'];
$_SESSION['notes']=$note;
$Tnumber =$_POST['Tnumber'];
$m_passwd=123456;
$m_passtoo=123456;
$mok=1;
$st=1;
$snumber=$_POST['sn'];
$b_pud=$_POST['b_pud']+0;
$notpay = $_POST['notpay'];

?>
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
<?  //exit;// 
	mysql_select_db($database_sc, $sc);//echo "###",$pudid;exit;
    $query_Recapud = sprintf("SELECT * FROM a_pud WHERE id=$pudid");// 
    $Recapud = mysql_query($query_Recapud, $sc) or die(mysql_error());
    $row_Recapud = mysql_fetch_assoc($Recapud);
	$totalRows_Recapud = mysql_num_rows($Recapud);
	$apud_a1=$row_Recapud['fpay1'];
	$apud_a2=$row_Recapud['fpay2'];
	$apud_a=$row_Recapud['p'];
	$apud_b=$row_Recapud['b'];
	$apud_c=$row_Recapud['c'];
	$apud_d=$row_Recapud['d'];
	$apud_e=$row_Recapud['e'];
	$apud_f=$row_Recapud['f'];
	$apud_g=$row_Recapud['g'];
	$apud_da=$row_Recapud['d_a'];
	$apud_db=$row_Recapud['d_b'];
	$apud_dc=$row_Recapud['d_c'];
	$apud_dd=$row_Recapud['d_d'];
	$apud_fd=$row_Recapud['fd'];
	$apud_fdm=$row_Recapud['fdm'];
	$apud_ted=$row_Recapud['ted'];
	$apud_ceo=$row_Recapud['ceo'];
	
//st
mysql_select_db($database_sc, $sc);
        $query_Recnm = sprintf("SELECT * FROM memberdata WHERE m_username = '$newuser'");//
        $Recnm = mysql_query($query_Recnm, $sc) or die(mysql_error());
        $row_Recnm = mysql_fetch_assoc($Recnm);
        $totalRows_Recnm = mysql_num_rows($Recnm);//echo $totalRows_Recnm,"@@";//exit;
//新單
if ($totalRows_Recnm == 0) {
	//number
	mysql_select_db($database_sc, $sc);$bo="boss";
    $query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");
    $Reci = mysql_query($query_Reci, $sc) or die(mysql_error());
    $row_Reci = mysql_fetch_assoc($Reci);
    $num_box=$row_Reci['num_box'];
    $num_z=$row_Reci['num_z'];
    if(date("m") != $num_z) {
	   $numz=date("m");
	   $update11="UPDATE admin SET num_z=$numz WHERE username='$bo'";
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
    $update11="UPDATE admin SET num_box=$new_num_box WHERE username='$bo'";
    mysql_select_db($database_sc, $sc);
    $Result11 = mysql_query($update11, $sc) or die(mysql_error());
//
	mysql_select_db($database_sc, $sc);
    $insertCommand3="INSERT INTO memberdata (fname, m_nick, card, m_username, m_passwd, m_passtoo, number, m_fuser, a_pud, b_pud, ks, m_ok, year, moom, day, z, m_email, m_joinDate, st, date, time, fpay, as_at, as_number, as_name) VALUES ('$fname', '$m_nick', '$card', '$newuser', '$m_passwd', '$m_passtoo', '$number', '$fnumber', '$pudid', '$b_pud', '$pud_p', '$mok', '$year', '$moom', '$day', '$z', '$m_email', '$date', '$st', '$date', '$time', '$fpay', '$as_at', '$as_number', '$as_name')"; 
    mysql_query($insertCommand3,$sc);

    //Add to oc
	/*$salt = substr(md5(uniqid(rand(), true)), 0, 9);
	$pdo = new PDO("mysql:host=localhost;dbname=twlifeli_ocmall;charset=utf8","twlifelinkcom","rgn26842");
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
	if($pudid > 1){
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
	}
	$pdo = NULL;*/

    //enc oc

	$gk=4;unset($gg);$gg=array(300,150,100);$gi=0;$ga=$newuser;$date=date("Y-m-d");$time=date("H:i:s");$ganame=$newuser;
	while ($gk != 0) {
		mysql_select_db($database_sc, $sc);
        $query_Recb3 = sprintf("SELECT * FROM memberdata WHERE m_username = '$ga'");//
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
		$y_note=$ganame."<br/>新註冊贈紅利".$ggv;
	    mysql_select_db($database_sc, $sc);
        $insertCommand13="INSERT INTO r_cash (number, cin, csum, note, date, time) VALUES ('$bnum', '$ggv', '$new_ggv', '$y_note', '$date', '$time')"; 
        mysql_query($insertCommand13,$sc);
		//goldf
		$gold_f=$ggv;$glevel=10;$at=1;
	    $fnote="新註冊(".$apud_name."),<br/> 帳號：".$newuser;
	    $sncode=$fzus."-".date("ymdhis");
	    mysql_select_db($database_sc, $sc);
        $insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$bnum', '$year', '$moom', '$day', '$z', '$gold_f', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
        mysql_query($insertCommand15,$sc);
	    //
	mysql_select_db($database_sc, $sc);
    $query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$bnum' && year=$year && moom=$moom && day=$day");
    $Recs = mysql_query($query_Recs, $sc) or die(mysql_error());
    $row_Recs = mysql_fetch_assoc($Recs);
    $totalRows_Recs = mysql_num_rows($Recs);
    if ($totalRows_Recs == 0) {
        mysql_select_db($database_sc, $sc);
        $insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level1) VALUES ('$bnum', '$year', '$moom', '$day', '$z', '$gold_f')"; 
        mysql_query($insertCommand15,$sc);
        } else {
	        $new_level1=$row_Recs['level1']+$gold_f;
	        $update11="UPDATE gold_sum SET level1= $new_level1 WHERE number = '$bnum' && year=$year && moom=$moom && day=$day";
            mysql_select_db($database_sc, $sc);
            $Result11 = mysql_query($update11, $sc) or die(mysql_error());
	        }
		$gk--;$gi++;if ($row_Recb3['fname'] != "") {$ga=$row_Recb3['fname'];} else {break;}
		}
	//
	mysql_select_db($database_sc, $sc);
    $insertCommand3="INSERT INTO bank (number, coc, phone, email) VALUES ('$number', '$coc', '$m_callphone', '$m_email')"; 
    mysql_query($insertCommand3,$sc);
} else { //升 舊單

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
	
	//推薦人考核通過
	if($pudid >=4)
	{
		$update11="UPDATE memberdata SET assessment=1 WHERE number = '$fnumber'";
		mysql_select_db($database_sc, $sc);
		$Result11 = mysql_query($update11, $sc) or die(mysql_error());
	}
	//
	if($pudid == 7 || $pudid == 9 || $pudid == 10){
		$update11="UPDATE memberdata SET assessment=1 WHERE m_username = '$newuser'";
		mysql_select_db($database_sc, $sc);
		$Result11 = mysql_query($update11, $sc) or die(mysql_error());
	}
	//
	$_SESSION['old_aid']=$row_Recnm['a_pud'];
	$up_y=$year+1;
	$number=$row_Recnm['number'];
	//
	$update11="UPDATE memberdata SET a_pud=$pudid, year=$year, moom=$moom, day=$day, z=$z, date='$date', time='$time' ,m_fuser='$fuser' WHERE m_username='$newuser'";
	mysql_select_db($database_sc, $sc);
	$Result11 = mysql_query($update11, $sc) or die(mysql_error());

	//infd
	if ($apud_fd == 1) {
	if($pudid >=5)
	{
		//推薦累計
		mysql_select_db($database_sc, $sc);
		$query_Recmem_f = sprintf("SELECT * FROM memberdata WHERE number='$fuser'");
		$Recmem_f = mysql_query($query_Recmem_f, $sc) or die(mysql_error());
		$row_Recmem_f = mysql_fetch_assoc($Recmem_f);
		$totalRows_Recmem_f = mysql_num_rows($Recmem_f);
		$new_f_tog=$row_Recmem_f['f_tog']+1;
		$update11="UPDATE memberdata SET f_tog='$new_f_tog' WHERE number = '$fuser'";
		mysql_select_db($database_sc, $sc);
		$Result11 = mysql_query($update11, $sc) or die(mysql_error());
		//
		//fd-number
		mysql_select_db($database_sc, $sc);$bo="boss";
		$query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");
		$Reci = mysql_query($query_Reci, $sc) or die(mysql_error());
		$row_Reci = mysql_fetch_assoc($Reci);
		$num_box=$row_Reci['fd_box'];
		$num_z=$row_Reci['fd_m'];
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
		$Result11 = mysql_query($update11, $sc) or die(mysql_error());//echo "##".$fnumber."##";exit;
		
		//我系大公排
		if ($pudid <= 10) {
			//推薦人位置
			
			$select_position = "SELECT * FROM fd WHERE number ='$fnumber'  ORDER BY id ASC" ;
			$query_position = mysql_query($select_position, $sc) or die(mysql_error());
			$row_position = mysql_fetch_assoc($query_position);
			$p_position = $row_position["filling_position"];
			//判斷入單位置
			/*$m_fuser = $fuser;
			do{
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
           $filling_position = $p_position;

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
           //echo "##".$fuser."##";exit;
           //echo $index."<br>";
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
           $insertCommand13="INSERT INTO fd (number, card, name, c_fuser, c_guser, gtow, filling_position, fd_amount, year, moom, day, end_y, end_m, end_d, date, time, note) VALUES ('$number', '$fdcard', '$m_nick', '$fcard', '$g_user', '$gw', '$index','$fd_amount', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time', '新人福袋')"; 
           mysql_query($insertCommand13,$sc);
		   //入單 out
			/*$objout = new out;
			do{
				if(empty($s))
				{
					$loop_out = $objout->is_out($fposition,1);
				}else{
					$loop_out = $objout->is_out($loop_out,1);
				}
				$s++;
			}while($loop_out);*/
			//
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
			
          }
		}
	}

	}

}

//進水庫

	$obj_reservoir = new reservoir;
	$obj_reservoir->new_in($number,$card,$pudid,$Tnumber,$notpay,$fuser,"10,0","10,0","");
//
	$_SESSION['sn']=$sn;$_SESSION['gfus']=$fnumber;$_SESSION['newnr']=$number;$_SESSION['pudid']=$pudid;$_SESSION['fdcard']=$fdcard;$_SESSION['penl']=$penl;
	
	?><script type="text/javascript">document.location.href="x_g_f.php";</script>
<? exit;?>