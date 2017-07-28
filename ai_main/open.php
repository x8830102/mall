<?php require_once('Connections/kg.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();

$now_datetime=date("Y/m/d H:i:s");$sys_datetime=date("Y-m-d H:i:s");$admin="sys";$sysnote="登入後台管理";
/*mysql_select_db($database_kg, $kg);
$insertCommand3="INSERT INTO main_ip (ip, admin, datetime, note, name, nick, number, card) VALUES ('$ip', '$admin', '$sys_datetime', '$sysnote', '$name', '$nick', '$mem_number', '$card')"; 
mysql_query($insertCommand3,$kg);
*/

//
$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_insert"])) && ($HTTP_POST_VARS["MM_insert"] == "form1")) {
	if ($_POST['see'] == $_POST['sum']) {
    $coc=$HTTP_POST_VARS['coc'];
	$number=$HTTP_POST_VARS['number'];$card=$HTTP_POST_VARS['card'];
	//
	$fus=$HTTP_POST_VARS['fus'];//$f_pud=$HTTP_POST_VARS['f_pud'];
	$gus=$HTTP_POST_VARS['gus'];$gtow=$HTTP_POST_VARS['gtow'];$pudid=$HTTP_POST_VARS['pudid'];$ek=$HTTP_POST_VARS['ek'];
	$ks=$HTTP_POST_VARS['ks'];$m_sex=$HTTP_POST_VARS['m_sex'];
	$m_nick=$HTTP_POST_VARS['m_nick'];$m_email=$HTTP_POST_VARS['email'];$note=$HTTP_POST_VARS['note'];$m_passwd="m123";$m_passtoo="m123";$mok=1;$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");
	$date=date("Y-m-d");$time=date("H:i:s");$year=date("Y");$moom=date("m");$day=date("d");$m_callphone=$_POST['phone'];if ($ek == 1) {$eks=$ks+50;} else {$eks=0;}
	//-ocash
	$ot=1050;
	if ($ek == 0) {
	mysql_select_db($database_kg, $kg);
    $query_Recob = sprintf("SELECT * FROM o_cash WHERE number='$fus' ORDER BY id DESC");// 
    $Recob = mysql_query($query_Recob, $kg) or die(mysql_error());
    $row_Recob = mysql_fetch_assoc($Recob);
	$totalRows_Recob = mysql_num_rows($Recob);
	if ($row_Recob['csum'] >= $ot) {
		$new_ob=$row_Recob['csum']-$ot;
	$onote="推荐开户扣值, ID：".$card;
	mysql_select_db($database_kg, $kg);
    $insertCommand13="INSERT INTO o_cash (number, cout, csum, note, date, time) VALUES ('$fus', '$ot', '$new_ob', '$onote', '$date', '$time')"; 
    mysql_query($insertCommand13,$kg);
		} else {
			header(sprintf("Location: account.php?err=推薦人開戶積分不足&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));
			exit;
			}
	
	}
	//
	$rd=1;
	if ($pudid == 1) {$rat=1;
	mysql_select_db($database_kg, $kg);
    $insertCommand3="INSERT INTO memberdata (m_nick, card, m_passwd, m_passtoo, number, m_fuser, m_guser, gtow, a_pud, ks, allsum, m_ok, year, moom, day, z, m_sex, m_email, note, m_joinDate, m_callphone, prd, rat, ek, gus, ggtow) VALUES ('$m_nick', '$card', '$m_passwd', '$m_passtoo', '$number', '$fus', '$gus', '$gtow', '$pudid', '$ks', '$ks', '$mok', '$year', '$moom', '$day', '$z', '$m_sex', '$m_email', '$note', '$date', '$m_callphone', '$rd', '$rat', '$eks', '$gus', '$gtow')"; 
    mysql_query($insertCommand3,$kg);
	}
	if ($pudid == 2) {$rat2=1;
	mysql_select_db($database_kg, $kg);
    $insertCommand3="INSERT INTO memberdata (m_nick, card, m_passwd, m_passtoo, number, m_fuser, m_guser2, gtow2, b_pud, ks, allsum, m_ok, year, moom, day, z, m_sex, m_email, note, m_joinDate, m_callphone, prd2, rat2, ek, gus) VALUES ('$m_nick', '$card', '$m_passwd', '$m_passtoo', '$number', '$fus', '$gus', '$gtow', '$pudid', '$ks', '$ks', '$mok', '$year', '$moom', '$day', '$z', '$m_sex', '$m_email', '$note', '$date', '$m_callphone', '$rd', '$rat2', '$eks', '$gus')"; 
    mysql_query($insertCommand3,$kg);
	}
	if ($pudid == 3) {$rat3=1;
	mysql_select_db($database_kg, $kg);
    $insertCommand3="INSERT INTO memberdata (m_nick, card, m_passwd, m_passtoo, number, m_fuser, m_guser3, gtow3, c_pud, ks, allsum, m_ok, year, moom, day, z, m_sex, m_email, note, m_joinDate, m_callphone, prd3, rat3, ek, gus) VALUES ('$m_nick', '$card', '$m_passwd', '$m_passtoo', '$number', '$fus', '$gus', '$gtow', '$pudid', '$ks', '$ks', '$mok', '$year', '$moom', '$day', '$z', '$m_sex', '$m_email', '$note', '$date', '$m_callphone', '$rd', '$rat3', '$eks', '$gus')"; 
    mysql_query($insertCommand3,$kg);
	}
	//
	mysql_select_db($database_kg, $kg);
    $insertCommand3="INSERT INTO bank (number, coc, phone, email) VALUES ('$number', '$coc', '$m_callphone', '$m_email')"; 
    mysql_query($insertCommand3,$kg);
	
	//p-a
	mysql_select_db($database_kg, $kg);
    $query_Recpa = sprintf("SELECT * FROM pay_a ORDER BY id DESC");
    $Recpa = mysql_query($query_Recpa, $kg) or die(mysql_error());
    $row_Recpa = mysql_fetch_assoc($Recpa);
    $totalRows_Recpa = mysql_num_rows($Recpa);
    $newpsum=$row_Recpa['psum']+$ks;$pat=1;
    mysql_select_db($database_kg, $kg);
    $insertCommand11="INSERT INTO pay_a (pin, psum, number, card, at, date, time) VALUES ('$ks', '$newpsum', '$number', '$card', '$pat', '$date', '$time')"; 
    mysql_query($insertCommand11,$kg);
	//p-c
	$pcpin=$ks*0.9;
mysql_select_db($database_kg, $kg);
$query_Recpc = sprintf("SELECT * FROM pay_c ORDER BY id DESC");
$Recpc = mysql_query($query_Recpc, $kg) or die(mysql_error());
$row_Recpc = mysql_fetch_assoc($Recpc);
$totalRows_Recpc = mysql_num_rows($Recpc);
$newcpsum=$row_Recpc['psum']+$pcpin;
mysql_select_db($database_kg, $kg);
$insertCommand13="INSERT INTO pay_c (pin, psum, number, card, at, date, time, year, moom, day) VALUES ('$pcpin', '$newcpsum', '$number', '$card', '$pat', '$date', '$time', '$year', '$moom', '$day')"; 
mysql_query($insertCommand13,$kg);
	//
	$_SESSION['gfus']=$fus;$_SESSION['ggus']=$gus;$_SESSION['gcd']=$card;$_SESSION['number']=$mem_number;$_SESSION['pudid']=$pudid;
	//$insertGoTo = "openok.php?newcard=".$card;
	$insertGoTo = "x_g_f.php?newcard=".$card;
    if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
	exit;
	} else {header(sprintf("Location: account.php?err=檢查碼不符"));exit;}
}
//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//number
	mysql_select_db($database_kg, $kg);$bo="boss";
    $query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");
    $Reci = mysql_query($query_Reci, $kg) or die(mysql_error());
    $row_Reci = mysql_fetch_assoc($Reci);
    $num_box=$row_Reci['num_box'];
    $num_z=$row_Reci['num_z'];
    if(date("m") != $num_z) {
	   $numz=date("m");
	   $update11="UPDATE admin SET num_z=$numz WHERE username='$bo'";
       mysql_select_db($database_kg, $kg);
       $Result11 = mysql_query($update11, $kg) or die(mysql_error());
	   $num_box=1;
	   }
    if ($num_box == 10000) {echo "設定值巳超過9999單號，請洽系統工程師。";exit;}
    if ($num_box < 10) {$number="SN".date("ymd")."000".$num_box;$card=date("ym")."000".$num_box;}
    if ($num_box > 9 && $num_box < 100) {$number="SN".date("ymd")."00".$num_box;$card=date("ym")."00".$num_box;}
    if ($num_box < 1000 && $num_box > 99) {$number="SN".date("ymd")."0".$num_box;$card=date("ym")."0".$num_box;}
	if ($num_box < 10000 && $num_box > 999) {$number="SN".date("ymd").$num_box;$card=date("ym").$num_box;}
	$new_num_box=$num_box+1;
    $update11="UPDATE admin SET num_box=$new_num_box WHERE username='$bo'";
    mysql_select_db($database_kg, $kg);
    $Result11 = mysql_query($update11, $kg) or die(mysql_error());
//
$fcard= strtoupper(trim($_POST['fcard']));//echo $fcard;exit;
$gcard= strtoupper(trim($_POST['gcard']));
$gtow=$_POST['gtow'];
$pudid=$_POST['pudid'];
$gt=$_POST['gt'];
//$ot=$_POST['ot'];
if ($_POST['see2'] != $_POST['sum2']) {header(sprintf("Location: account.php?err=校验码不匹配&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;}
$gcard= strtoupper(trim($_POST['gcard']));
//
mysql_select_db($database_kg, $kg);
$query_Recff = sprintf("SELECT * FROM memberdata WHERE card='$fcard' && m_ok=1");// ORDER BY p DESC
$Recff = mysql_query($query_Recff, $kg) or die(mysql_error());
$row_Recff = mysql_fetch_assoc($Recff);
$totalRows_Recff = mysql_num_rows($Recff);
//
switch ($pudid) {
	case'1':if ($row_Recff['a_pud'] == 0) {header(sprintf("Location: account.php?err=没有权限打开1000计划产品&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;} else {
		mysql_select_db($database_kg, $kg);
        $query_Recgd = sprintf("SELECT * FROM memberdata WHERE card='$gcard' && a_pud != 0 && m_ok=1");// ORDER BY p DESC
        $Recgd = mysql_query($query_Recgd, $kg) or die(mysql_error());
        $row_Recgd = mysql_fetch_assoc($Recgd);
        $totalRows_Recgd = mysql_num_rows($Recgd);$ot=1000;
        if ($totalRows_Recgd == 0) {header(sprintf("Location: account.php?err=没有这样的安置位置&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;}
		};break;
	case'2':if ($row_Recff['b_pud'] == 0) {header(sprintf("Location: account.php?err=没有权限打开5000计划产品&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;} else {
		mysql_select_db($database_kg, $kg);
        $query_Recgd = sprintf("SELECT * FROM memberdata WHERE card='$gcard' && b_pud != 0 && m_ok=1");// ORDER BY p DESC
        $Recgd = mysql_query($query_Recgd, $kg) or die(mysql_error());
        $row_Recgd = mysql_fetch_assoc($Recgd);
        $totalRows_Recgd = mysql_num_rows($Recgd);$ot=5000;
        if ($totalRows_Recgd == 0) {header(sprintf("Location: account.php?err=没有这样的安置位置&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;}
		};break;
	case'3':if ($row_Recff['b_pud'] == 0) {header(sprintf("Location: account.php?err=没有权限打开10000计划产品&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;} else {
		mysql_select_db($database_kg, $kg);
        $query_Recgd = sprintf("SELECT * FROM memberdata WHERE card='$gcard' && c_pud != 0 && m_ok=1");// ORDER BY p DESC
        $Recgd = mysql_query($query_Recgd, $kg) or die(mysql_error());
        $row_Recgd = mysql_fetch_assoc($Recgd);
        $totalRows_Recgd = mysql_num_rows($Recgd);$ot=10000;
        if ($totalRows_Recgd == 0) {header(sprintf("Location: account.php?err=没有这样的安置位置&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;}
		};break;
	}
//
if ($totalRows_Recff == 0) {header(sprintf("Location: account.php?err=没有这样的直推人ID&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;}
//$gtow=$_POST['gtow'];
switch ($gtow) {case'L':$sgs="Left";break;case'R':$sgs="right";break;}$cnum=$row_Recgd['number'];
mysql_select_db($database_kg, $kg);
$query_Recgd2 = sprintf("SELECT * FROM memberdata WHERE m_guser='$cnum' && m_ok=1 && gtow='$gtow'");// ORDER BY p DESC
$Recgd2 = mysql_query($query_Recgd2, $kg) or die(mysql_error());
$row_Recgd2 = mysql_fetch_assoc($Recgd2);
$totalRows_Recgd2 = mysql_num_rows($Recgd2);//echo $totalRows_Recgd2;exit;
if ($totalRows_Recgd2 != 0) {header(sprintf("Location: account.php?err=This position「 ".$sgs." 」It has been&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;}
//$pudid=$_POST['pudid'];
mysql_select_db($database_kg, $kg);
$query_Recgd3 = sprintf("SELECT * FROM a_pud WHERE id=$pudid");// ORDER BY p DESC
$Recgd3 = mysql_query($query_Recgd3, $kg) or die(mysql_error());
$row_Recgd3 = mysql_fetch_assoc($Recgd3);
$totalRows_Recgd3 = mysql_num_rows($Recgd3);
//if ($_POST['gt'] > ($row_Recgd3['pv']/2)) {header(sprintf("Location: account.php?err=G幣值不可大於產品值一半&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;}
/*$ot=$_POST['ot'];
mysql_select_db($database_kg, $kg);
$query_Recgd4 = sprintf("SELECT * FROM o_cash WHERE number='$mem_number' ORDER BY id DESC");// 
$Recgd4 = mysql_query($query_Recgd4, $kg) or die(mysql_error());
$row_Recgd4 = mysql_fetch_assoc($Recgd4);
$totalRows_Recgd4 = mysql_num_rows($Recgd4);
if ($ot > ($row_Recgd4['csum']+0)) {header(sprintf("Location: account.php?err=Insufficient account stored value&gcard=".$gcard."&gtow=".$gtow."&pudid=".$pudid."&gt=".$gt."&ot=".$ot));exit;}

mysql_select_db($database_kg, $kg);
$query_Reca = sprintf("SELECT * FROM a_pud ORDER BY p");// DESC
$Reca = mysql_query($query_Reca, $kg) or die(mysql_error());
$row_Reca = mysql_fetch_assoc($Reca);
$totalRows_Reca = mysql_num_rows($Reca);*/
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin:0;
	padding:0;
	background: #FFF url(minwt_bg.jpg) center center fixed no-repeat;
	-moz-background-size: cover;
	background-size: cover;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
</style>
<script>
var isShow = false;
function change() {
	if(!isShow) {
		isShow = true;
		document.getElementById('d1').style.display='';
		document.getElementById('a2').setAttribute('src', 'images/5-2.png');//innerText = "<img src='images/5-2.png'>";//document.write('<img src="images/logo.png">');
	}
	else {
		isShow = false;
		document.getElementById('d1').style.display='none';
		document.getElementById('a2').setAttribute('src', 'images/5-1.png');
	}			
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="360" valign="top" id="d1" style="display: none"><iframe  src="mem_sys.php" name="sys" width="360" height="1000" marginwidth="0" marginheight="0" scrolling="No" frameborder="0"  id="mem_sys"> </iframe></td>
    <td valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="0">
      <tr>
        <td height="10"><hr></td>
      </tr>
      <tr>
        <td align="center">回填單 - 註冊 Account 2/2</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><span class="v1"><?php echo $err;?></span></td>
      </tr>
      <tr>
        <td align="center"><table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <td width="20%">&nbsp;</td>
            <td width="17%" align="right">新單卡號 ID</td>
            <td width="12%" align="center"><?php echo $card;?></td>
            <td width="51%"><form id="form2" name="form2" method="post" action="">
              <input name="fcard" type="hidden" id="fcard" value="<?php echo $fcard;?>" />
              <input name="gcard" type="hidden" id="gcard" value="<?php echo $gcard;?>" />
              <input name="gtow" type="hidden" id="gtow" value="<?php echo $gtow;?>" />
              <input name="pudid" type="hidden" id="pudid" value="<?php echo $pudid;?>" />
              <input name="sum2" type="hidden" id="sum2" value="<?php echo $sum2;?>" />
              <input name="see2" type="hidden" id="see2" value="<?php echo $see2;?>" />
              <input name="gt" type="hidden" id="gt" value="<?php echo $gt;?>" />
              <span style="color: #0028E9">
              <input name="Submit" type="submit" onclick="window.location='open.php'" value="改下一号次" />
              </span>
            </form></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
              <table width="100%" border="0" cellspacing="10" cellpadding="0">
                <tr>
                  <td width="20%">&nbsp;</td>
                  <td width="17%" height="30" align="right">推薦人 ID</td>
                  <td bgcolor="#55AAFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="30" align="center" bgcolor="#55AAFF"><?php echo $row_Recff['card'];?></td>
                      </tr>
                    </table></td>
                  <td colspan="2"><?php echo $row_Recff['m_nick'];?>
                    <input name="fus" type="hidden" id="fus" value="<?php echo $row_Recff['number'];?>" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">安置位 ID</td>
                  <td bgcolor="#55AAFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="30" align="center" bgcolor="#55AAFF"><?php echo $row_Recgd['card'];?></td>
                      </tr>
                    </table></td>
                  <td colspan="2"><?php echo $row_Recgd['m_nick'];?><input name="gus" type="hidden" id="gus" value="<?php echo $row_Recgd['number'];?>" />
                    [ <?php switch ($gtow) {case'L':echo "left";break;case'R':echo "right";break;}?> ]
                    <input name="gtow" type="hidden" id="gtow" value="<?php echo $gtow;?>" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">新單產品</td>
                  <td align="center" bgcolor="#55AAFF"><?php echo $row_Recgd3['name'];?></td>
                  <td colspan="2"><input name="number" type="hidden" id="number" value="<?php echo $number;?>" />
                  <input name="card" type="hidden" id="card" value="<?php echo $card;?>" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" colspan="4" align="right"><hr></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right"><input name="pudid" type="hidden" id="pudid" value="<?php echo $pudid;?>" />
                    <input name="ks" type="hidden" id="ks" value="<?php echo $row_Recgd3['pv'];?>" /></td>
                  <td colspan="3" class="v1">新單資訊</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">暱稱</td>
                  <td colspan="3"><input name="m_nick" type="text" class="v1" id="m_nick" size="15" />
                    *</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">性別</td>
                  <td colspan="3"><select name="m_sex" class="v1" id="m_sex">
                    <option value="F">女</option>
                    <option value="M">男</option>
                    </select></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right" valign="top">備註</td>
                  <td colspan="3"><textarea name="note" id="note" cols="45" rows="5"></textarea></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" colspan="4"><hr></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30">&nbsp;</td>
                  <td colspan="3" class="v1">真實資料</td>
                </tr>
                <!--<tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">姓(英文)</td>
                  <td colspan="3" class="v1"><input name="last_name" type="text" class="v1" id="last_name" size="20" />
* </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">名(英文)</td>
                  <td colspan="3" class="v1"><input name="first_name" type="text" class="v1" id="first_name" size="20" />
*</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">中文姓名</td>
                  <td colspan="3" class="v1"><input name="name" type="text" class="v1" id="name" size="20" />
*</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">生日</td>
                  <td colspan="3" class="v1"><input name="birthday" type="text" class="v1" id="birthday" value="例：1911-01-01" size="15" />
*</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">戶照/身分證號</td>
                  <td colspan="3" class="v1"><input name="sid" type="text" class="v1" id="sid" size="20" />
*</td>
                </tr>-->
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right"> 國籍</td>
                  <td colspan="3" class="v1"><select name="coc" id="coc">
                    <option value="US" selected="selected">US</option>
                    <option value="CN">CN</option>
                    <option value="TW">TW</option>
                    <option value="HK">HK</option>
                    <option value="SG">SG</option>
                    <option value="MY">MY</option>
                  </select> 
                  *</td>
                </tr>
                
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">電話</td>
                  <td colspan="3" class="v1"><input name="phone" type="text" class="v1" id="phone" size="20" />
*</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">電子信箱</td>
                  <td colspan="3" class="v1"><input name="email" type="text" class="v1" id="email" value="xx@xx.xx" size="40" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">&nbsp;</td>
                  <td colspan="3" class="v1"><input name="ek" type="checkbox" id="ek" value="1" />
                    (回填單) 無入會金，獎金扣回制</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">&nbsp;</td>
                  <td width="15%"><span style="color: #0028E9"><span style="font-size: 10px">*please enter verification code<br />
                  </span>
                      <input name="sum" type="text" autocomplete="off" class="profile21" id="sum" onfocus="MM_setTextOfTextfield('sum','','')" />
                  </span></td>
                  <td width="13%"><span style="color: #0028E9">
                    </span>
                    <table width="170" border="1"  cellpadding="0" cellspacing="0" bordercolor="#0028E9">
                      <tr>
                        <td width="63" height="35" align="center" style="color: #fff; font-size: 25px;" background="../eng/images/7-1.JPG"><?php echo $sum;?></td>
                      </tr>
                    </table></td>
                  <td width="35%">&nbsp;</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="4"><hr /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><span class="style3" style="margin:0px; font-size: 18px; font-weight: bold;">
                    <input type="hidden" name="MM_insert" value="form1" />
                    <span style="color: #FEDB4D">
                      <input name="see" type="hidden" id="see" value="<?php echo $sum;?>" />
                    </span></span></td>
                  <td><input name="button" type="submit" class="v1" id="button" value="送出" /></td>
                  <td colspan="2"><span class="style3" style="margin:0px; font-size: 18px; font-weight: bold;">
                    <input name="Submit3" type="button" class="v1" onclick="window.history.back();" value="上一步" />
                    </span></td>
                  </tr>
                </table>
          </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>