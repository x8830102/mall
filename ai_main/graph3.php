<?php require_once('Connections/kg.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;}
$mem_number=$_SESSION['number'];
mysql_select_db($database_kg, $kg);
$query_Recmem = sprintf("SELECT * FROM memberdata WHERE number = '$mem_number' && m_ok=1");
$Recmem = mysql_query($query_Recmem, $kg) or die(mysql_error());
$row_Recmem = mysql_fetch_assoc($Recmem);
$totalRows_Recmem = mysql_num_rows($Recmem);
if ($totalRows_Recmem == 0) {header(sprintf("Location: login_mem.php"));exit;}
$name=$row_Recmem['m_name'];
$nick=$row_Recmem['m_nick'];
$card=$row_Recmem['card'];
//
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}
else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
  $ip=$_SERVER['REMOTE_ADDR'];
}
$now_datetime=date("Y/m/d H:i:s");$sys_datetime=date("Y-m-d H:i:s");$admin="sys";$sysnote="登入後台管理";
/*mysql_select_db($database_kg, $kg);
$insertCommand3="INSERT INTO main_ip (ip, admin, datetime, note, name, nick, number, card) VALUES ('$ip', '$admin', '$sys_datetime', '$sysnote', '$name', '$nick', '$mem_number', '$card')"; 
mysql_query($insertCommand3,$kg);
*/
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['number'] = NULL;
  unset($_SESSION['number']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
//fm-直推數
mysql_select_db($database_kg, $kg);
$query_Recfm = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$mem_number' && m_ok=1");
$Recfm = mysql_query($query_Recfm, $kg) or die(mysql_error());
$row_Recfm = mysql_fetch_assoc($Recfm);
$totalRows_Recfm = mysql_num_rows($Recfm);
//
if ($_GET['boy'] == "") {$usid=$row_Recmem['m_id'];$di=1;} else {$usid=$_GET['boy'];$di=$_GET['d'];}
mysql_select_db($database_kg, $kg);$aaa=0;
$query_Recb = sprintf("SELECT * FROM memberdata WHERE m_id = $usid && a_pud <> $aaa && prd3=3");// DESC
$Recb = mysql_query($query_Recb, $kg) or die(mysql_error());
$row_Recb = mysql_fetch_assoc($Recb);
$totalRows_Recb = mysql_num_rows($Recb);
$bmem_number=$row_Recb['number'];$b_id=$row_Recb['m_id'];
switch ($row_Recb['m_sex']) {case'F':$ms="W";break;case'M':$ms="M";break;}
$svpic=$ms;
$prd3=3;//echo $prd;exit;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Finemetal AG</title>
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
.profile {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile1 {border-radius: 50%;
    border:1px solid #fff;
}
.profile110 {border-radius: 50%;
    border:1px solid #fff;
}
.profile112 {border-radius: 50%;
    border:1px solid #fff;
}
.profile113 {border-radius: 50%;
    border:1px solid #fff;
}
.profile114 {border-radius: 50%;
    border:1px solid #fff;
}
.profile115 {border-radius: 50%;
    border:1px solid #fff;
}
.profile116 {border-radius: 50%;
    border:1px solid #fff;
}
.profile11611 {border-radius: 50%;
    border:1px solid #fff;
}
.profile116111 {border-radius: 50%;
    border:1px solid #fff;
}
.profile117 {border-radius: 50%;
    border:1px solid #fff;
}
.profile118 {border-radius: 50%;
    border:1px solid #fff;
}
.profile13 {border-radius: 50%;
    border:1px solid #fff;
}
.profile132 {border-radius: 50%;
    border:1px solid #fff;
}
.profile133 {border-radius: 50%;
    border:1px solid #fff;
}
.profile134 {border-radius: 50%;
    border:1px solid #fff;
}
.profile13411 {border-radius: 50%;
    border:1px solid #fff;
}
.profile134111 {border-radius: 50%;
    border:1px solid #fff;
}
.profile13421 {border-radius: 50%;
    border:1px solid #fff;
}
.profile134211 {border-radius: 50%;
    border:1px solid #fff;
}
.profile13431 {border-radius: 50%;
    border:1px solid #fff;
}
.profile134311 {border-radius: 50%;
    border:1px solid #fff;
}
.profile13441 {border-radius: 50%;
    border:1px solid #fff;
}
.profile134411 {border-radius: 50%;
    border:1px solid #fff;
}
.profile135 {border-radius: 50%;
    border:1px solid #fff;
}
.profile136 {border-radius: 50%;
    border:1px solid #fff;
}
.profile137 {border-radius: 50%;
    border:1px solid #fff;
}
.profile138 {border-radius: 50%;
    border:1px solid #fff;
}
.profile139 {border-radius: 50%;
    border:1px solid #fff;
}
.profile151 {border-radius: 50%;
    border:1px solid #fff;
}
.profile152 {border-radius: 50%;
    border:1px solid #fff;
}
.profile15211 {border-radius: 50%;
    border:1px solid #fff;
}
.profile152111 {border-radius: 50%;
    border:1px solid #fff;
}
.profile153 {border-radius: 50%;
    border:1px solid #fff;
}
.profile154 {border-radius: 50%;
    border:1px solid #fff;
}
.profile161 {border-radius: 50%;
    border:1px solid #fff;
}
.profile162 {border-radius: 50%;
    border:1px solid #fff;
}
.profile16211 {border-radius: 50%;
    border:1px solid #fff;
}
.profile162111 {border-radius: 50%;
    border:1px solid #fff;
}
.profile163 {border-radius: 50%;
    border:1px solid #fff;
}
.profile164 {border-radius: 50%;
    border:1px solid #fff;
}
.profile171 {border-radius: 50%;
    border:1px solid #fff;
}
.profile172 {border-radius: 50%;
    border:1px solid #fff;
}
.profile17211 {border-radius: 50%;
    border:1px solid #fff;
}
.profile172111 {border-radius: 50%;
    border:1px solid #fff;
}
.profile173 {border-radius: 50%;
    border:1px solid #fff;
}
.profile174 {border-radius: 50%;
    border:1px solid #fff;
}
.profile18 {border-radius: 50%;
    border:1px solid #fff;
}
.profile19 {border-radius: 50%;
    border:1px solid #fff;
}
.profile5 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile51 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile510 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile511 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile512 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile513 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile51311 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile513111 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile51321 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile513211 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile51331 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile513311 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile51341 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile513411 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile514 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile515 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile516 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile517 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile518 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile518 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile52 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile55 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile56 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5611 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile56111 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5621 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile56211 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5631 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile56311 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5641 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile56411 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile57 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile58 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile59 {border-radius: 25%;
	border:1px solid #0028E9;
}
.v1 {	font-size:28px;
}
.profile53 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile54 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile519 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile520 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile2 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile11 {border-radius: 50%;
    border:1px solid #fff;
}
.profile1181 {border-radius: 50%;
    border:1px solid #fff;
}
.profile131 {border-radius: 50%;
    border:1px solid #fff;
}
.profile1321 {border-radius: 50%;
    border:1px solid #fff;
}
.profile1361 {border-radius: 50%;
    border:1px solid #fff;
}
.profile1371 {border-radius: 50%;
    border:1px solid #fff;
}
.profile1381 {border-radius: 50%;
    border:1px solid #fff;
}
.profile1391 {border-radius: 50%;
    border:1px solid #fff;
}
.profile1541 {border-radius: 50%;
    border:1px solid #fff;
}
.profile1641 {border-radius: 50%;
    border:1px solid #fff;
}
.profile1741 {border-radius: 50%;
    border:1px solid #fff;
}
.profile521 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5110 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5101 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5111 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5151 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5161 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5171 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5181 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5181 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5191 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile521 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5201 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile531 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile541 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile581 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile591 {border-radius: 25%;
	border:1px solid #0028E9;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
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
<style type="text/css">
.profile1182 {border-radius: 50%;
    border:1px solid #fff;
}
.profile11821 {border-radius: 50%;
    border:1px solid #fff;
}
.profile11822 {border-radius: 50%;
    border:1px solid #fff;
}
.profile11823 {border-radius: 50%;
    border:1px solid #fff;
}
</style>
<style type="text/css">
.profile5211 {border-radius: 25%;
	border:1px solid #0028E9;
}
.profile5211 {border-radius: 25%;
	border:1px solid #0028E9;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="360" valign="top" id="d1" style="display: none"><iframe  src="mem_sys.php" name="sys" width="360" height="1000" marginwidth="0" marginheight="0" scrolling="No" frameborder="0"  id="mem_sys"> </iframe></td>
    <td valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="0">
      <tr>
        <td bgcolor="<?php switch ($prd3) {case'1':echo "#FFF";break;case'2':echo "#FFFF66";break;case'3':echo "#FF9900";break;}?>"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="10">
              <tr>
                <td width="200" align="center" >定位 圖 表 &gt;&gt;&gt;</td>
                <?php if ($row_Recmem['a_pud'] != 0) {?><td width="200" align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolor="#55AAFF">
                  <tr>
                    <td width="200" height="43" align="center"><table width="100%" border="1" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="42" align="center"><a href="graph.php">第一局</a></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td><?php }?>
                <?php //if ($row_Recmem['b_pud'] != 0) {?><!--<td width="200" align="center" bgcolor="#55AAFF"><a href="graph2.php">5000 Plan</a></td><?php //}?>
                <?php //if ($row_Recmem['c_pud'] != 0) {?>
                <td width="200" align="center" bgcolor="#55AAFF"><a href="graph3.php">10000 Plan</a></td>--><?php //}?>
                <td width="200" align="right"><table width="100%" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="42" align="center"><a href="graph2.php">第二局</a></td>
                    </tr>
                  </table></td>
                <td width="201"><table width="100%" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="42" align="center"><a href="graph3.php">第三局</a></td>
                    </tr>
                  </table></td>
                <td width="400">&nbsp;</td>
                </tr>
              </table><?php if ($row_Recmem['a_pud'] == 0) {exit;}if ($totalRows_Recb == 0) {exit;}?></td>
            </tr>
          <tr>
            <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" class="v1"><table width="300" border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="153">1000 Plan</td>
                <td width="56" align="center"><?php if ($di != 1) {?>
                  <a href="graph.php"><img src="../cht/mempic/T.png" width="30" /></a>
                  <?php }?></td>
                <td width="51" align="center"><?php if ($di != 1) {?>
                  <a href="javascript:history.back()"><img src="../cht/mempic/R.png" width="33" border="0" /></a>
                  <?php }?></td>
                </tr>
              </table></td>
            </tr>
          <tr>
            <td height="35" align="center" valign="middle"><table width="160" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="160" align="center" valign="middle" bgcolor="<?php if ($di == 1) {echo "#99CCFF";} else {if ($mem_number == $row_Recb['m_fuser']) {echo "#99CCFF";}}?>" class="profile2"><img src="../cht/mempic/<?php echo $svpic;?>.png" width="45" border="0"  class="profile11"/><br />
                  ID：<?php echo $row_Recb['card'];?><br />
                  [ <?php echo $row_Recb['m_nick'];?> ]<br />
                  直推：<?php echo $totalRows_Recfm;?></td>
                </tr>
              </table>
              ( <?php echo $di;?> )</td>
            </tr>
          <tr>
            <td height="35" align="center" valign="middle"><table width="720" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" align="center"><img src="../cht/mempic/d2.png" width="100%" height="25" border="0" /></td>
                </tr>
              <tr>
                <td width="360" align="center" valign="top"><?php //
mysql_select_db($database_kg, $kg);$gtow="L";
$query_Recg1 = sprintf("SELECT * FROM memberdata WHERE m_guser3 = '$bmem_number' && gtow3='$gtow' && prd3 = $prd3 && a_pud != $aaa");
$Recg1 = mysql_query($query_Recg1, $kg) or die(mysql_error());
$row_Recg1 = mysql_fetch_assoc($Recg1);
$totalRows_Recg1 = mysql_num_rows($Recg1);//echo $totalRows_Recg1;
$g1=$row_Recg1['number'];$g1id=$row_Recg1['m_id'];
if ($totalRows_Recg1 != 0) {
//fm
mysql_select_db($database_kg, $kg);
$query_Recfm1 = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$g1' && m_ok=1");
$Recfm1 = mysql_query($query_Recfm1, $kg) or die(mysql_error());
$row_Recfm1 = mysql_fetch_assoc($Recfm1);
$totalRows_Recfm1 = mysql_num_rows($Recfm1);
switch ($row_Recg1['m_sex']) {case'F':$ms="W";break;case'M':$ms="M";break;}
$svpic1=$ms;?>
                  <table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" bgcolor="<?php if ($mem_number == $row_Recg1['m_fuser']) {echo "#99CCFF";}?>" class="profile521"><a href="graph3.php?boy=<?php echo $g1id;?>&amp;d=<?php echo $di+1;?>"><img src="../cht/mempic/<?php echo $svpic1;?>.png" width="45" border="0"  class="profile131"/></a><br />
                        ID：<?php echo $row_Recg1['card'];?><br />
                        [ <?php echo $row_Recg1['m_nick'];?> ]<br />
                        直推：<span class="profile5211"><?php echo $totalRows_Recfm1;?></span></td>
                      </tr>
                    </table>
                  <?php } //else {if ($now_tm >= 0 && $row_Recb['prd'] == 1) {?>
                  <!--<table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" class="profile5110"><a href="account.php?gi=<?php echo $b_id;?>&amp;w=<?php echo $gtow;?>&pudid=1"><img src="mempic/Q.png" width="128" height="128" border="0" /></a></td>
                      </tr>
                    </table>-->
                  <?php //}}?></td>
                <td width="360" align="center" valign="top"><?php //
mysql_select_db($database_kg, $kg);$gtow="R";//echo $bmem_number;
$query_Recg1 = sprintf("SELECT * FROM memberdata WHERE m_guser3 = '$bmem_number' && gtow3='$gtow' && prd3 = $prd3 && a_pud != $aaa");
$Recg1 = mysql_query($query_Recg1, $kg) or die(mysql_error());
$row_Recg1 = mysql_fetch_assoc($Recg1);
$totalRows_Recg1 = mysql_num_rows($Recg1);
$g2=$row_Recg1['number'];$g2id=$row_Recg1['m_id'];
if ($totalRows_Recg1 != 0) {//echo $totalRows_Recg1;//exit;
//fm
mysql_select_db($database_kg, $kg);
$query_Recfm1 = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$g2' && m_ok=1");
$Recfm1 = mysql_query($query_Recfm1, $kg) or die(mysql_error());
$row_Recfm1 = mysql_fetch_assoc($Recfm1);
$totalRows_Recfm1 = mysql_num_rows($Recfm1);
switch ($row_Recg1['m_sex']) {case'F':$ms="W";break;case'M':$ms="M";break;}
$svpic1=$ms;?>
                  <table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" bgcolor="<?php if ($mem_number == $row_Recg1['m_fuser']) {echo "#99CCFF";}?>" class="profile521"><a href="graph3.php?boy=<?php echo $g2id;?>&amp;d=<?php echo $di+1;?>"><img src="../cht/mempic/<?php echo $svpic1;?>.png" width="45" border="0"  class="profile1321"/></a><br />
                        ID：<?php echo $row_Recg1['card'];?><br />
                        [ <?php echo $row_Recg1['m_nick'];?> ]<br />
                        直推：<?php echo $totalRows_Recfm1;?></td>
                      </tr>
                    </table>
                  <?php } //else {if ($now_tm >= 0  && $row_Recb['prd'] == 1) {?>
                  <!--<table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" class="profile5111"><a href="account.php?gi=<?php echo $b_id;?>&amp;w=<?php echo $gtow;?>&pudid=1"><img src="mempic/Q.png" width="128" height="128" border="0" /></a></td>
                      </tr>
                    </table>-->
                  <?php //}}?></td>
                </tr>
              </table></td>
            </tr>
          <tr>
            <td height="35" align="center" valign="middle"><table width="720" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" align="center"><?php if ($g1 !="") {?>
                  ( <?php echo $di+1;?> ) <br />
                  <img src="../cht/mempic/d2.png" width="100%" height="25" border="0" />
                  <?php }?></td>
                <td colspan="2" align="center"><?php if ($g2 !="") {?>
                  ( <?php echo $di+1;?> )<br />
                  <img src="../cht/mempic/d2.png" width="100%" height="25" border="0" />
                  <?php }?></td>
                </tr>
              <tr>
                <td width="360" align="center" valign="top"><?php if ($g1 !="") {
mysql_select_db($database_kg, $kg);$gtow="L";
$query_Recg1 = sprintf("SELECT * FROM memberdata WHERE m_guser3 = '$g1' && gtow3='$gtow' && prd3=$prd3 && a_pud != 0");
$Recg1 = mysql_query($query_Recg1, $kg) or die(mysql_error());
$row_Recg1 = mysql_fetch_assoc($Recg1);
$totalRows_Recg1 = mysql_num_rows($Recg1);
$g3=$row_Recg1['number'];$g3id=$row_Recg1['m_id'];
if ($totalRows_Recg1 != 0) {
//fm
mysql_select_db($database_kg, $kg);
$query_Recfm1 = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$g3' && m_ok=1");
$Recfm1 = mysql_query($query_Recfm1, $kg) or die(mysql_error());
$row_Recfm1 = mysql_fetch_assoc($Recfm1);
$totalRows_Recfm1 = mysql_num_rows($Recfm1);
switch ($row_Recg1['m_sex']) {case'F':$ms="W";break;case'M':$ms="M";break;}
$svpic1=$ms;
?>
                  <table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" bgcolor="<?php if ($mem_number == $row_Recg1['m_fuser']) {echo "#99CCFF";}?>" class="profile581"><a href="graph3.php?boy=<?php echo $g3id;?>&amp;d=<?php echo $di+2;?>"><img src="../cht/mempic/<?php echo $svpic1;?>.png" width="45" border="0"  class="profile1361"/></a><br />
                        ID：<?php echo $row_Recg1['card'];?><br />
                        [ <?php echo $row_Recg1['m_nick'];?> ]<br />
                        直推：<?php echo $totalRows_Recfm1;?></td>
                      </tr>
                    </table>
                  <?php mysql_select_db($database_kg, $kg);
$query_Recg2 = sprintf("SELECT * FROM memberdata WHERE m_guser = '$g3'");
$Recg2 = mysql_query($query_Recg2, $kg) or die(mysql_error());
$row_Recg2 = mysql_fetch_assoc($Recg2);
$totalRows_Recg2 = mysql_num_rows($Recg2);if ($totalRows_Recg2 != 0) {?>
                  <a href="graph3.php?boy=<?php echo $g3id;?>&amp;d=<?php echo $di+2;?>"><img src="../cht/mempic/G.png" height="45" border="0" class="profile1182" /></a>
                  <?php }?>
                  <?php } //else {if ($now_tm >= 0  && $row_Recb['prd'] == 1) {?>
                  <!--<table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" class="profile5151"><a href="account.php?gi=<?php echo $g1id;?>&amp;w=<?php echo $gtow;?>&pudid=1"><img src="mempic/Q.png" width="128" height="128" border="0" /></a></td>
                      </tr>
                    </table>-->
                  <?php }//}}?></td>
                <td width="360" align="center" valign="top"><?php if ($g1 !="") {
mysql_select_db($database_kg, $kg);$gtow="R";
$query_Recg1 = sprintf("SELECT * FROM memberdata WHERE m_guser3 = '$g1' && gtow3='$gtow' && prd3=$prd3 && a_pud != 0");
$Recg1 = mysql_query($query_Recg1, $kg) or die(mysql_error());
$row_Recg1 = mysql_fetch_assoc($Recg1);
$totalRows_Recg1 = mysql_num_rows($Recg1);
$g4=$row_Recg1['number'];$g4id=$row_Recg1['m_id'];
if ($totalRows_Recg1 != 0) {
//fm
mysql_select_db($database_kg, $kg);
$query_Recfm1 = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$g4' && m_ok=1");
$Recfm1 = mysql_query($query_Recfm1, $kg) or die(mysql_error());
$row_Recfm1 = mysql_fetch_assoc($Recfm1);
$totalRows_Recfm1 = mysql_num_rows($Recfm1);
switch ($row_Recg1['m_sex']) {case'F':$ms="W";break;case'M':$ms="M";break;}
$svpic1=$ms;
?>
                  <table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" bgcolor="<?php if ($mem_number == $row_Recg1['m_fuser']) {echo "#99CCFF";}?>" class="profile591"><a href="graph3.php?boy=<?php echo $g4id;?>&amp;d=<?php echo $di+2;?>"><img src="../cht/mempic/<?php echo $svpic1;?>.png" width="45" border="0"  class="profile1371"/></a><br />
                        ID：<?php echo $row_Recg1['card'];?><br />
                        [ <?php echo $row_Recg1['m_nick'];?> ]<br />
                        直推：<?php echo $totalRows_Recfm1;?></td>
                      </tr>
                    </table>
                  <?php mysql_select_db($database_kg, $kg);
$query_Recg2 = sprintf("SELECT * FROM memberdata WHERE m_guser = '$g4'");
$Recg2 = mysql_query($query_Recg2, $kg) or die(mysql_error());
$row_Recg2 = mysql_fetch_assoc($Recg2);
$totalRows_Recg2 = mysql_num_rows($Recg2);if ($totalRows_Recg2 != 0) {?>
                  <a href="graph3.php?boy=<?php echo $g4id;?>&amp;d=<?php echo $di+2;?>"><img src="../cht/mempic/G.png" height="45" border="0" class="profile11821" /></a>
                  <?php }?>
                  <?php } //else {if ($now_tm >= 0  && $row_Recb['prd'] == 1) {?>
                  <!--<table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" class="profile5161"><a href="account.php?gi=<?php echo $g1id;?>&amp;w=<?php echo $gtow;?>&pudid=1"><img src="mempic/Q.png" width="128" height="128" border="0" /></a></td>
                      </tr>
                </table>-->
                  <?php }//}}?></td>
                <td width="360" align="center" valign="top"><?php if ($g2 !="") {
mysql_select_db($database_kg, $kg);$gtow="L";
$query_Recg1 = sprintf("SELECT * FROM memberdata WHERE m_guser3 = '$g2' && gtow3='$gtow' && prd3=$prd3 && a_pud != 0");
$Recg1 = mysql_query($query_Recg1, $kg) or die(mysql_error());
$row_Recg1 = mysql_fetch_assoc($Recg1);
$totalRows_Recg1 = mysql_num_rows($Recg1);
$g5=$row_Recg1['number'];$g5id=$row_Recg1['m_id'];
if ($totalRows_Recg1 != 0) {
//fm
mysql_select_db($database_kg, $kg);
$query_Recfm1 = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$g5' && m_ok=1");
$Recfm1 = mysql_query($query_Recfm1, $kg) or die(mysql_error());
$row_Recfm1 = mysql_fetch_assoc($Recfm1);
$totalRows_Recfm1 = mysql_num_rows($Recfm1);
switch ($row_Recg1['m_sex']) {case'F':$ms="W";break;case'M':$ms="M";break;}
$svpic1=$ms;?>
                  <table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" bgcolor="<?php if ($mem_number == $row_Recg1['m_fuser']) {echo "#99CCFF";}?>" class="profile5101"><a href="graph3.php?boy=<?php echo $g5id;?>&amp;d=<?php echo $di+2;?>"><img src="../cht/mempic/<?php echo $svpic1;?>.png" width="45" border="0"  class="profile1381"/></a><br />
                        ID：<?php echo $row_Recg1['card'];?><br />
                        [ <?php echo $row_Recg1['m_nick'];?> ]<br />
                        直推：<?php echo $totalRows_Recfm1;?></td>
                      </tr>
                    </table>
                  <?php mysql_select_db($database_kg, $kg);
$query_Recg2 = sprintf("SELECT * FROM memberdata WHERE m_guser = '$g5'");
$Recg2 = mysql_query($query_Recg2, $kg) or die(mysql_error());
$row_Recg2 = mysql_fetch_assoc($Recg2);
$totalRows_Recg2 = mysql_num_rows($Recg2);if ($totalRows_Recg2 != 0) {?>
                  <a href="graph3.php?boy=<?php echo $g5id;?>&amp;d=<?php echo $di+2;?>"><img src="../cht/mempic/G.png" height="45" border="0" class="profile11822" /></a>
                  <?php }?>
                  <?php } //else {if ($now_tm >= 0 && $row_Recb['prd'] == 1) {?>
                  <!-- <table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" class="profile5171"><a href="account.php?gi=<?php echo $g2id;?>&amp;w=<?php echo $gtow;?>&pudid=1"><img src="mempic/Q.png" width="128" height="128" border="0" /></a></td>
                      </tr>
                    </table>-->
                  <?php }//}}?></td>
                <td width="360" align="center" valign="top"><?php if ($g2 !="") {
mysql_select_db($database_kg, $kg);$gtow="R";
$query_Recg1 = sprintf("SELECT * FROM memberdata WHERE m_guser3 = '$g2' && gtow3='$gtow' && prd3=$prd3 && a_pud != 0");
$Recg1 = mysql_query($query_Recg1, $kg) or die(mysql_error());
$row_Recg1 = mysql_fetch_assoc($Recg1);
$totalRows_Recg1 = mysql_num_rows($Recg1);
$g6=$row_Recg1['number'];$g6id=$row_Recg1['m_id'];
if ($totalRows_Recg1 != 0) {
//fm
mysql_select_db($database_kg, $kg);
$query_Recfm1 = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$g6' && m_ok=1");
$Recfm1 = mysql_query($query_Recfm1, $kg) or die(mysql_error());
$row_Recfm1 = mysql_fetch_assoc($Recfm1);
$totalRows_Recfm1 = mysql_num_rows($Recfm1);
switch ($row_Recg1['m_sex']) {case'F':$ms="W";break;case'M':$ms="M";break;}
$svpic1=$ms;?>
                  <table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" bgcolor="<?php if ($mem_number == $row_Recg1['m_fuser']) {echo "#99CCFF";}?>" class="profile5181"><a href="graph3.php?boy=<?php echo $g6id;?>&amp;d=<?php echo $di+2;?>"><img src="../cht/mempic/<?php echo $svpic;?>.png" width="45" border="0"  class="profile1391"/></a><br />
                        ID：<?php echo $row_Recg1['card'];?><br />
                        [ <?php echo $row_Recg1['m_nick'];?> ]<br />
                        直推：<?php echo $totalRows_Recfm1;?></td>
                      </tr>
                    </table>
                  <?php mysql_select_db($database_kg, $kg);
$query_Recg2 = sprintf("SELECT * FROM memberdata WHERE m_guser = '$g6'");
$Recg2 = mysql_query($query_Recg2, $kg) or die(mysql_error());
$row_Recg2 = mysql_fetch_assoc($Recg2);
$totalRows_Recg2 = mysql_num_rows($Recg2);if ($totalRows_Recg2 != 0) {?>
                  <a href="graph3.php?boy=<?php echo $g6id;?>&amp;d=<?php echo $di+2;?>"><img src="../cht/mempic/G.png" height="45" border="0" class="profile11823" /></a>
                  <?php }?>
                  <?php } //else {if ($now_tm >= 0 && $row_Recb['prd'] == 1) {?>
                  <!--<table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="160" align="center" valign="middle" class="profile5181"><a href="account.php?gi=<?php echo $g2id;?>&amp;w=<?php echo $gtow;?>&pudid=1"><img src="mempic/Q.png" width="128" height="128" border="0" /></a></td>
                      </tr>
                    </table>-->
                  <?php }//}}?></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>