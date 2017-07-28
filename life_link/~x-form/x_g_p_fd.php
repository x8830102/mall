<? 
require_once('Connections/sc.php');mysql_query("set names utf8");
require_once( dirname(dirname(__FILE__)) .'/class/queue.class.php' );
require_once( 'Reservoir.php');
require_once( 'Promotions.php' );
require_once( 'is_out.php' );
session_start();

date_default_timezone_set('Asia/Taipei');
header("Content-Type:text/html; charset=utf-8");
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

<? $fdname=$_POST['fdname'];$fu=$_POST['fu'];$gu=$_POST['gu'];$w=$_POST['w'];$number=$_POST['number'];$m_passtoo=$_POST['m_passtoo'];$pudp=$_POST['pudp'];
	$date=date("Y-m-d");$time=date("H:i:s");$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$mfu=$_POST['mfu'];$filling_position = $_POST['filling_position'];
		
		//
		mysql_select_db($database_sc, $sc);
		$query_Recfg = sprintf("SELECT * FROM memberdata WHERE number='$number'");
		$Recfg = mysql_query($query_Recfg, $sc) or die(mysql_error());
		$row_Recfg = mysql_fetch_assoc($Recfg);
		$totalRows_Recfg = mysql_num_rows($Recfg);
		$my_fuser=$row_Recfg['m_fuser'];		
		$apud=$row_Recfg['a_pud'];
		$select_Ffd="SELECT * FROM fd WHERE number = '$number'";
		$query_Ffd = mysql_query($select_Ffd, $sc) or die(mysql_error());
		$row_Ffd = mysql_fetch_assoc($query_Ffd);
		$my_position = $row_Ffd['filling_position'];
		
		mysql_select_db($database_sc, $sc);
    $query_Recapud = sprintf("SELECT * FROM a_pud WHERE id=$apud");// 
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
	$apud_da=$row_Recapud['d_a'];
	$apud_db=$row_Recapud['d_b'];
	$apud_dc=$row_Recapud['d_c'];
	$apud_dd=$row_Recapud['d_d'];
	$my_fpay=$row_Recapud['my_fpay'];
	$my_p=$row_Recapud['my_p'];

	//-ocash
	mysql_select_db($database_sc, $sc);
    $query_Recob = sprintf("SELECT * FROM c_cash WHERE number='$number' ORDER BY id DESC");// 
    $Recob = mysql_query($query_Recob, $sc) or die(mysql_error());
    $row_Recob = mysql_fetch_assoc($Recob);
	$totalRows_Recob = mysql_num_rows($Recob);
	if ($row_Recob['csum'] >= $my_p) {	//1
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
    if ($num_box == 10000) {echo "設定值巳超過9999單號，請洽系統工程師。";exit;}
    if ($num_box < 10) {$fdnumber="SN".date("ymd")."000".$num_box;$fdcard="f".date("ym")."000".$num_box;}
    if ($num_box > 9 && $num_box < 100) {$fdnumber="SN".date("ymd")."00".$num_box;$fdcard="f".date("ym")."00".$num_box;}
    if ($num_box < 1000 && $num_box > 99) {$fdnumber="SN".date("ymd")."0".$num_box;$fdcard="f".date("ym")."0".$num_box;}
	if ($num_box < 10000 && $num_box > 999) {$fdnumber="SN".date("ymd").$num_box;$fdcard="f".date("ym").$num_box;}
	$new_num_box=$num_box+1;
    $update11="UPDATE admin SET fd_box=$new_num_box WHERE username='$bo'";
    mysql_select_db($database_sc, $sc);
    $Result11 = mysql_query($update11, $sc) or die(mysql_error());
	    //
		$new_ob=$row_Recob['csum']-$my_p;
	    $onote="福卡兌換<br/>編號：".$fdcard;
	    mysql_select_db($database_sc, $sc);
        $insertCommand13="INSERT INTO c_cash (number, cout, csum, note, date, time) VALUES ('$number', '$my_p', '$new_ob', '$onote', '$date', '$time')"; 
        mysql_query($insertCommand13,$sc);
		//
		$nyear=$year+1;
		mysql_select_db($database_sc, $sc);
            $query_Recxf = sprintf("SELECT * FROM fd WHERE number = '$number' && card='$fdcard' && gtow='$w'");
            $Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());
            $row_Recxf = mysql_fetch_assoc($Recxf);
            $totalRows_Recxf = mysql_num_rows($Recxf);
		if ($totalRows_Recxf == 0) {
		mysql_select_db($database_sc, $sc);
		$insertCommand13="INSERT INTO fd (name, number, card, c_fuser, c_guser, gtow, filling_position, fd_amount, year, moom, day, end_y, end_m, end_d, date, time, fnumber) VALUES ('$fdname', '$number', '$fdcard', '$fu', '$gu', '$w', '$filling_position',' $my_p', '$year', '$moom', '$day', '$nyear', '$moom', '$day', '$date', '$time', '自購球')"; 
		mysql_query($insertCommand13,$sc);}
		//入單 out
			$objout = new out;
			do{
				if(empty($s))
				{
					$loop_out = $objout->is_out($my_position ,1);
				}else{
					$loop_out = $objout->is_out($loop_out,1);
				}
				$s++;
			}while($loop_out);
			//
		//check out

		do{
			if(empty($x))
			{
				$loop_out = $objout->is_out($filling_position,0);
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
		//
        //自購金額入水庫
		$obj_reservoir = new reservoir;
		$obj_reservoir->oneself_purchase($my_fuser,$number,$card,$apud);
		//
	}
	
		/////////////		
	$_SESSION['fu']=$fu;$_SESSION['gu']=$gu;$_SESSION['nsn']=$number;$_SESSION['fdcard']=$fdcard;$_SESSION['vf']=$fdcard;
	
	$_SESSION['sn']=$sn;

	?>
<script type="text/javascript">document.location.href="x_g_fd.php";</script>