<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;} else {$sn=$_SESSION['number'];}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: login_mem.php"));exit;}
$name=$row_Recsn['m_name'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
if ($a_pud < 3) {header(sprintf("Location: index.php"));exit;}
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
//
//xf
mysql_select_db($database_sc, $sc);
$query_Recxf = sprintf("SELECT * FROM fd_take WHERE number = '$sn' && at=0 ORDER BY id");// DESC
$Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());
$row_Recxf = mysql_fetch_assoc($Recxf);
$totalRows_Recxf = mysql_num_rows($Recxf);
//fd
mysql_select_db($database_sc, $sc);
$query_Recfd = sprintf("SELECT * FROM fd2 WHERE number = '$sn' ORDER BY id");// DESC
$Recfd = mysql_query($query_Recfd, $sc) or die(mysql_error());
$row_Recfd = mysql_fetch_assoc($Recfd);
$totalRows_Recfd = mysql_num_rows($Recfd);//echo $totalRows_Recfd;exit;
$fd_c=$row_Recfd['card'];
$_SESSION['topfd']=$fd_c;
//
mysql_select_db($database_sc, $sc);
$query_Reccd3 = sprintf("SELECT * FROM fd2 WHERE number = '$sn' && at=1");
$Reccd3 = mysql_query($query_Reccd3, $sc) or die(mysql_error());
$row_Reccd3 = mysql_fetch_assoc($Reccd3);
$totalRows_Reccd3 = mysql_num_rows($Reccd3);//echo $totalRows_Reccd3;exit;
mysql_select_db($database_sc, $sc);
$query_Reccd31 = sprintf("SELECT * FROM fd2 WHERE c_fuser = '$fd_c'");
$Reccd31 = mysql_query($query_Reccd31, $sc) or die(mysql_error());
$row_Reccd31 = mysql_fetch_assoc($Reccd31);
$totalRows_Reccd31 = mysql_num_rows($Reccd31);
$sv=$totalRows_Reccd31-$totalRows_Reccd3;
//if ($_GET['rf'] == "") {$rf=$row_Recfd['card'];} else {$rf=$_GET['rf'];}
if ($_GET['fd_c'] == "") {$fd_c1=$row_Recfd['card'];} else {$fd_c1=$_GET['fd_c'];}//echo $fd_c1;
mysql_select_db($database_sc, $sc);
$query_Recfds = sprintf("SELECT * FROM fd2 WHERE card='$fd_c1'");
$Recfds = mysql_query($query_Recfds, $sc) or die(mysql_error());
$row_Recfds = mysql_fetch_assoc($Recfds);
$totalRows_Recfds = mysql_num_rows($Recfds);//echo $fd_c,"-",$row_Recfds['c_guser'];
if ($fd_c != $fd_c1) {$rf=$row_Recfds['c_guser'];} else {$rf="";}//echo $rf,"9";
$vsn=$row_Recfds['number'];
mysql_select_db($database_sc, $sc);
$query_Recmmm = sprintf("SELECT * FROM memberdata WHERE number='$vsn'");
$Recmmm = mysql_query($query_Recmmm, $sc) or die(mysql_error());
$row_Recmmm = mysql_fetch_assoc($Recmmm);
$totalRows_Recmmm = mysql_num_rows($Recmmm);
//2t_L
mysql_select_db($database_sc, $sc);$gtow2="L";
$query_Recfds2 = sprintf("SELECT * FROM fd2 WHERE c_guser='$fd_c1' && gtow='$gtow2'");
$Recfds2 = mysql_query($query_Recfds2, $sc) or die(mysql_error());
$row_Recfds2 = mysql_fetch_assoc($Recfds2);
$totalRows_Recfds2 = mysql_num_rows($Recfds2);
$fd_c2=$row_Recfds2['card'];
if ($fd_c2 == "") {$fd_c2="xxx";}
$vsn2=$row_Recfds2['number'];
mysql_select_db($database_sc, $sc);
$query_Recmmm2 = sprintf("SELECT * FROM memberdata WHERE number='$vsn2'");
$Recmmm2 = mysql_query($query_Recmmm2, $sc) or die(mysql_error());
$row_Recmmm2 = mysql_fetch_assoc($Recmmm2);
$totalRows_Recmmm2 = mysql_num_rows($Recmmm2);
//2t_R
mysql_select_db($database_sc, $sc);$gtow3="R";
$query_Recfds3 = sprintf("SELECT * FROM fd2 WHERE c_guser='$fd_c1' && gtow='$gtow3'");
$Recfds3 = mysql_query($query_Recfds3, $sc) or die(mysql_error());
$row_Recfds3 = mysql_fetch_assoc($Recfds3);
$totalRows_Recfds3 = mysql_num_rows($Recfds3);//echo $totalRows_Recfds3;
$fd_c3=$row_Recfds3['card'];
if ($fd_c3 == "") {$fd_c3="xxx";}
$vsn3=$row_Recfds3['number'];
mysql_select_db($database_sc, $sc);
$query_Recmmm3 = sprintf("SELECT * FROM memberdata WHERE number='$vsn3'");
$Recmmm3 = mysql_query($query_Recmmm3, $sc) or die(mysql_error());
$row_Recmmm3 = mysql_fetch_assoc($Recmmm3);
$totalRows_Recmmm3 = mysql_num_rows($Recmmm3);
//3t_L
mysql_select_db($database_sc, $sc);$gtow4="L";
$query_Recfds4 = sprintf("SELECT * FROM fd2 WHERE c_guser='$fd_c2' && gtow='$gtow4'");
$Recfds4 = mysql_query($query_Recfds4, $sc) or die(mysql_error());
$row_Recfds4 = mysql_fetch_assoc($Recfds4);
$totalRows_Recfds4 = mysql_num_rows($Recfds4);
$vsn4=$row_Recfds4['number'];
mysql_select_db($database_sc, $sc);
$query_Recmmm4 = sprintf("SELECT * FROM memberdata WHERE number='$vsn4'");
$Recmmm4 = mysql_query($query_Recmmm4, $sc) or die(mysql_error());
$row_Recmmm4 = mysql_fetch_assoc($Recmmm4);
$totalRows_Recmmm4 = mysql_num_rows($Recmmm4);
//3t_R
mysql_select_db($database_sc, $sc);$gtow5="R";
$query_Recfds5 = sprintf("SELECT * FROM fd2 WHERE c_guser='$fd_c2' && gtow='$gtow5'");
$Recfds5 = mysql_query($query_Recfds5, $sc) or die(mysql_error());
$row_Recfds5 = mysql_fetch_assoc($Recfds5);
$totalRows_Recfds5 = mysql_num_rows($Recfds5);
$vsn5=$row_Recfds5['number'];
mysql_select_db($database_sc, $sc);
$query_Recmmm5 = sprintf("SELECT * FROM memberdata WHERE number='$vsn5'");
$Recmmm5 = mysql_query($query_Recmmm5, $sc) or die(mysql_error());
$row_Recmmm5 = mysql_fetch_assoc($Recmmm5);
$totalRows_Recmmm5 = mysql_num_rows($Recmmm5);
//4t_2L
mysql_select_db($database_sc, $sc);$gtow6="L";
$query_Recfds6 = sprintf("SELECT * FROM fd2 WHERE c_guser='$fd_c3' && gtow='$gtow6'");
$Recfds6 = mysql_query($query_Recfds6, $sc) or die(mysql_error());
$row_Recfds6 = mysql_fetch_assoc($Recfds6);
$totalRows_Recfds6 = mysql_num_rows($Recfds6);//echo $totalRows_Recfds6;
$vsn6=$row_Recfds6['number'];
mysql_select_db($database_sc, $sc);
$query_Recmmm6 = sprintf("SELECT * FROM memberdata WHERE number='$vsn6'");
$Recmmm6 = mysql_query($query_Recmmm6, $sc) or die(mysql_error());
$row_Recmmm6 = mysql_fetch_assoc($Recmmm6);
$totalRows_Recmmm6 = mysql_num_rows($Recmmm6);
//4t_2R
mysql_select_db($database_sc, $sc);$gtow7="R";
$query_Recfds7 = sprintf("SELECT * FROM fd2 WHERE c_guser='$fd_c3' && gtow='$gtow7'");
$Recfds7 = mysql_query($query_Recfds7, $sc) or die(mysql_error());
$row_Recfds7 = mysql_fetch_assoc($Recfds7);
$totalRows_Recfds7 = mysql_num_rows($Recfds7);
$vsn7=$row_Recfds7['number'];
mysql_select_db($database_sc, $sc);
$query_Recmmm7 = sprintf("SELECT * FROM memberdata WHERE number='$vsn7'");
$Recmmm7 = mysql_query($query_Recmmm7, $sc) or die(mysql_error());
$row_Recmmm7 = mysql_fetch_assoc($Recmmm7);
$totalRows_Recmmm7 = mysql_num_rows($Recmmm7);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
}
#apDiv1 {
	position:absolute;
	left:450px;
	top:717px;
	width:185px;
	z-index:1;
	height: 184px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
#apDiv0 {
	position:absolute;
	left:63px;
	top:822px;
	width:311px;
	height:87px;
	z-index:2;
}
#apDiv2 {
	position:absolute;
	left:177px;
	top:440px;
	width:210px;
	height:132px;
	z-index:3;
}
#apDiv3 {
	position:absolute;
	left:864px;
	top:579px;
	width:210px;
	height:125px;
	z-index:4;
}
#apDiv4 {
	position:absolute;
	left:247px;
	top:129px;
	width:202px;
	height:116px;
	z-index:5;
}
#apDiv5 {
	position:absolute;
	left:664px;
	top:352px;
	width:192px;
	height:204px;
	z-index:6;
}
#apDiv6 {
	position:absolute;
	left:1070px;
	top:184px;
	width:188px;
	height:121px;
	z-index:7;
}
#apDiv7 {
	position:absolute;
	left:1184px;
	top:468px;
	width:239px;
	height:151px;
	z-index:8;
}
li {list-style-type:none;}
</style>
</head>

<body>
<div id="apDiv0"><a href="new_account-4.php" target="_top"><img src="img/fdmap_h.png" width="72" height="72" border="0" /></a>
<?php if ($rf != "") {?>
  <a href="fdmap_d.php?fd_c=<?php echo $row_Recfds['card'];?>&amp;kp=2"><img src="img/fdmap_ff.png" width="72" height="72" border="0" /></a>
<a href="fdmap_d.php?fd_c=<?php echo $row_Recfds['card'];?>&kp=1"><img src="img/fdmap_f.png" width="72" height="72" border="0" /></a>
<?php }?></div>
<div id="apDiv1">
<ul>
   <li><img src="img/<?php if ($totalRows_Recfds == 0) {echo "fdbox1.png";}if ($totalRows_Recfds == 1) {if ($row_Recfds['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.gif";}}?>" width="104" border="0" /></li>
   <li><table width="111" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="85" height="45" valign="middle" background="img/<?php if ($row_Recfds['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>" style="color: #FFF"><?php echo $row_Recfds['card'],"<br/>名:",$row_Recfds['name'];?></td>
  </tr>
</table>
</li>
</ul>
</div>
<div id="apDiv2">
<ul>
   <li><a href="<?php if ($totalRows_Recfds2 == 0) {if ($totalRows_Recfds == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$fd_c1,"&amp;w=",$gtow2,"&vf=",$row_Recfds['card'];}}if ($totalRows_Recfds2 == 1) {echo "fdmap.php?fd_c=",$row_Recfds2['card'],"&rf=",$row_Recfds['card'];}?>"><img src="img/<?php if ($totalRows_Recfds2 == 0) {if ($totalRows_Recfds == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($totalRows_Recfds2 == 1) {if ($row_Recfds2['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" width="104" border="0" /></a></li>
   <li><table width="111" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="85" height="45" valign="middle" background="img/<?php if ($row_Recfds2['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>" style="color: #FFF"><?php echo $row_Recfds2['card'],"<br/>",$row_Recfds2['name'];?></td>
  </tr>
</table>
</li>
</ul>
</div>
<div id="apDiv3">
<ul>
   <li><a href="<?php if ($totalRows_Recfds3 == 0) {if ($totalRows_Recfds == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$fd_c1,"&amp;w=",$gtow3,"&vf=",$row_Recfds['card'];}}if ($totalRows_Recfds3 == 1) {echo "fdmap.php?fd_c=",$row_Recfds3['card'],"&rf=",$row_Recfds['card'];}?>"><img src="img/<?php if ($totalRows_Recfds3 == 0) {if ($totalRows_Recfds == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($totalRows_Recfds3 == 1) {if ($row_Recfds3['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" width="104" border="0" /></a></li>
   <li><table width="111" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="85" height="45" valign="middle" background="img/<?php if ($row_Recfds3['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>" style="color: #FFF"><?php echo $row_Recfds3['card'],"<br/>",$row_Recfds3['name'];?></td>
  </tr>
</table>
</li>
</ul>
</div>
<div id="apDiv4">
<ul>
   <li><a href="<?php if ($totalRows_Recfds4 == 0) {if ($totalRows_Recfds2 == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$fd_c2,"&amp;w=",$gtow4,"&vf=",$row_Recfds['card'];}}if ($totalRows_Recfds4 == 1) {echo "fdmap.php?fd_c=",$row_Recfds4['card'],"&rf=",$row_Recfds2['card'];}?>"><img src="img/<?php if ($totalRows_Recfds4 == 0) {if ($totalRows_Recfds2 == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($totalRows_Recfds4 == 1) {if ($row_Recfds4['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" width="104" border="0" /></a></li>
   <li><table width="111" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="85" height="45" valign="middle" background="img/<?php if ($row_Recfds4['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>" style="color: #FFF"><?php echo $row_Recfds4['card'],"<br/>",$row_Recfds4['name'];?></td>
  </tr>
</table>
</li>
</ul>
</div>
<div id="apDiv5">
<ul>
   <li><a href="<?php if ($totalRows_Recfds5 == 0) {if ($totalRows_Recfds2 == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$fd_c2,"&amp;w=",$gtow5,"&vf=",$row_Recfds['card'];}}if ($totalRows_Recfds5 == 1) {echo "fdmap.php?fd_c=",$row_Recfds5['card'],"&rf=",$row_Recfds2['card'];}?>"><img src="img/<?php if ($totalRows_Recfds5 == 0) {if ($totalRows_Recfds2 == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($totalRows_Recfds5 == 1) {if ($row_Recfds4['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" width="104" border="0" /></a></li>
   <li><table width="111" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="85" height="45" valign="middle" background="img/<?php if ($row_Recfds5['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>" style="color: #FFF"><?php echo $row_Recfds5['card'],"<br/>",$row_Recfds5['name'];?></td>
  </tr>
</table>
</li>
</ul>
</div>
<div id="apDiv6">
<ul>
   <li><a href="<?php if ($totalRows_Recfds6 == 0) {if ($totalRows_Recfds3 == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$fd_c3,"&amp;w=",$gtow6,"&vf=",$row_Recfds['card'];}}if ($totalRows_Recfds6 == 1) {echo "fdmap.php?fd_c=",$row_Recfds6['card'],"&rf=",$row_Recfds3['card'];}?>"><img src="img/<?php if ($totalRows_Recfds6 == 0) {if ($totalRows_Recfds3 == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($totalRows_Recfds6 == 1) {if ($row_Recfds4['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" width="104" border="0" /></a></li>
   <li><table width="111" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="85" height="45" valign="middle" background="img/<?php if ($row_Recfds6['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>" style="color: #FFF"><?php echo $row_Recfds6['card'],"<br/>",$row_Recfds6['name'];?></td>
  </tr>
</table>
</li>
</ul>
</div>
<div id="apDiv7">
<ul>
   <li><a href="<?php if ($totalRows_Recfds7 == 0) {if ($totalRows_Recfds3 == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$fd_c3,"&amp;w=",$gtow7,"&vf=",$row_Recfds['card'];}}if ($totalRows_Recfds7 == 1) {echo "fdmap.php?fd_c=",$row_Recfds7['card'],"&rf=",$row_Recfds3['card'];}?>"><img src="img/<?php if ($totalRows_Recfds7 == 0) {if ($totalRows_Recfds3 == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($totalRows_Recfds7 == 1) {if ($row_Recfds4['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" width="104" border="0" /></a></li>
   <li><table width="111" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="85" height="45" valign="middle" background="img/<?php if ($row_Recfds7['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>" style="color: #FFF"><?php echo $row_Recfds7['card'],"<br/>",$row_Recfds7['name'];?></td>
  </tr>
</table>
</li>
</ul>
</div>
<table width="1500" height="928" border="0" cellspacing="0" cellpadding="0" background="img/fdmap.png">
  <tr>
    <td height="929">&nbsp;</td>
  </tr>
</table>
</body>
</html>