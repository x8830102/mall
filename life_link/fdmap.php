<?php require_once('Connections/sc.php'); ?>
<?php 
require_once( dirname(dirname(__FILE__)) .'/life_link/class/queue.class.php' );
mysql_query("set names utf8");
session_start();
include('if_login.php');
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
$query_Recfd = sprintf("SELECT * FROM fd WHERE number = '$sn' ORDER BY id");// DESC
$Recfd = mysql_query($query_Recfd, $sc) or die(mysql_error());
$row_Recfd = mysql_fetch_assoc($Recfd);
$totalRows_Recfd = mysql_num_rows($Recfd);//echo $totalRows_Recfd;exit;
$fd_c=$row_Recfd['card'];

$_SESSION['topfd']=$fd_c;
//
mysql_select_db($database_sc, $sc);
$query_Reccd3 = sprintf("SELECT * FROM fd WHERE number = '$sn' && at=1");
$Reccd3 = mysql_query($query_Reccd3, $sc) or die(mysql_error());
$row_Reccd3 = mysql_fetch_assoc($Reccd3);
$totalRows_Reccd3 = mysql_num_rows($Reccd3);//echo $totalRows_Reccd3;exit;
mysql_select_db($database_sc, $sc);
$query_Reccd31 = sprintf("SELECT * FROM fd WHERE c_fuser = '$fd_c'");
$Reccd31 = mysql_query($query_Reccd31, $sc) or die(mysql_error());
$row_Reccd31 = mysql_fetch_assoc($Reccd31);
$totalRows_Reccd31 = mysql_num_rows($Reccd31);
$sv=$totalRows_Reccd31-$totalRows_Reccd3;
//if ($_GET['rf'] == "") {$rf=$row_Recfd['card'];} else {$rf=$_GET['rf'];}
if ($_GET['fd_c'] == "") {$fd_c1=$row_Recfd['card'];} else {$fd_c1=$_GET['fd_c'];}//echo $fd_c1;
mysql_select_db($database_sc, $sc);
$query_Recfds = sprintf("SELECT * FROM fd WHERE card='$fd_c1'");
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
$query_Recfds2 = sprintf("SELECT * FROM fd WHERE c_guser='$fd_c1' && gtow='$gtow2'");
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
$query_Recfds3 = sprintf("SELECT * FROM fd WHERE c_guser='$fd_c1' && gtow='$gtow3'");
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
$query_Recfds4 = sprintf("SELECT * FROM fd WHERE c_guser='$fd_c2' && gtow='$gtow4'");
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
$query_Recfds5 = sprintf("SELECT * FROM fd WHERE c_guser='$fd_c2' && gtow='$gtow5'");
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
$query_Recfds6 = sprintf("SELECT * FROM fd WHERE c_guser='$fd_c3' && gtow='$gtow6'");
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
$query_Recfds7 = sprintf("SELECT * FROM fd WHERE c_guser='$fd_c3' && gtow='$gtow7'");
$Recfds7 = mysql_query($query_Recfds7, $sc) or die(mysql_error());
$row_Recfds7 = mysql_fetch_assoc($Recfds7);
$totalRows_Recfds7 = mysql_num_rows($Recfds7);
$vsn7=$row_Recfds7['number'];
mysql_select_db($database_sc, $sc);
$query_Recmmm7 = sprintf("SELECT * FROM memberdata WHERE number='$vsn7'");
$Recmmm7 = mysql_query($query_Recmmm7, $sc) or die(mysql_error());
$row_Recmmm7 = mysql_fetch_assoc($Recmmm7);
$totalRows_Recmmm7 = mysql_num_rows($Recmmm7);
/////////////////////////////////////////////////

$position = $_GET['position'];

$data = array();
if(empty($position) || $position =="undefined")
{
	
	$position = $row_Recfd['filling_position'];
	$objQueue = new Queue;
	$arr = array();
	
	$select_fd = "SELECT * FROM fd WHERE filling_position='$position'";
	$query_fd = mysql_query($select_fd, $sc) or die(mysql_error());
	$row_fd = mysql_fetch_assoc($query_fd);
	$data[0] = $row_fd;
	for($i=0 ;$i<7 ;$i++)
	{
		$position = $position*2;
		$objQueue->EnQueue($position);
		$position = $position+1;
		$objQueue->EnQueue($position);
		$position = $objQueue->DeQueue();
		$arr[$i] = $position;
	}
}else{
	$_SESSION['original'] = $position;
	$objQueue = new Queue;
	$arr = array();
	
	$select_fd = "SELECT * FROM fd WHERE filling_position='$position'";
	$query_fd = mysql_query($select_fd, $sc) or die(mysql_error());
	$row_fd = mysql_fetch_assoc($query_fd);
	$data[0] = $row_fd;
	for($i=0 ;$i<7 ;$i++)
	{
		$position = $position*2;
		$objQueue->EnQueue($position);
		$position = $position+1;
		$objQueue->EnQueue($position);
		$position = $objQueue->DeQueue();		
		$arr[$i] = $position;
	}
	
}
//

for($j=0 ;$j<count($arr); $j++)
{
	$select_fd = "SELECT * FROM fd WHERE filling_position=$arr[$j]";
	$query_fd = mysql_query($select_fd, $sc) or die(mysql_error());
	$row_fd = mysql_fetch_assoc($query_fd);
	$num_fd = mysql_num_rows($query_fd);
	$num_arr[0] = 1;
	$num_arr[$j+1] = $num_fd;
	
	
	$data[$j+1] = $row_fd;
}


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
	left:249px;
	top:633px;
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
	left:66px;
	top:713px;
	height:87px;
	z-index:2;
}
#apDiv2 {
	position:absolute;
	left:498px;
	top:265px;
	width:210px;
	height:132px;
	z-index:3;
}
#apDiv3 {
	position:absolute;
	left:330px;
	top:340px;
	width:210px;
	height:125px;
	z-index:4;
}
#apDiv4 {
	position:absolute;
	left:726px;
	top:182px;
	width:202px;
	height:116px;
	z-index:5;
}
#apDiv5 {
	position:absolute;
	left:602px;
	top:87px;
	width:192px;
	height:204px;
	z-index:6;
}
#apDiv6 {
	position:absolute;
	left:260px;
	top:130px;
	width:188px;
	height:121px;
	z-index:7;
}
#apDiv7 {
	position:absolute;
	left:69px;
	top:265px;
	width:239px;
	height:151px;
	z-index:8;}
.menu ul {border: 0px}
.menu li {
	list-style-type:none;
	margin-top: 0px
}
.fdmap  {
    position: relative;
    margin-right: auto;
    margin-left: -76px;
    margin-top: -14px
}
.fdmap_img {
	width: 100%;
	height: auto;
	z-index: 1;
}
.fdmap_pin {
	position: absolute;
	height: 100%;
	width: 100%;
	top: 0;
	left: 0;
}
/*.fdmap_but {
	width: 20%;
	
}
.fdmap_box {
	width: 5.75em
}
@media (max-width: 500px){
	.fdmap_box {
		width: 2.75em
	}
}
.fdmap_box_self {
	width: 8.725em
}*/
.float >li {
	margin-top: 10px
}
/*@media (max-width: 1200px) {
	.fdmarks_self {
		display: none;
		}
	}

@media (max-width: 1200px) {
	.fdmark_self {
		width: 20px;
		height: 20px;
		border-radius: 100%;
		background: #CC5D4C;
		cursor: pointer
	}
	.fdmark_self:hover .fdmarks_self {
		display: block;
		position: absolute;
		top: 0px;
		z-index: 999
	}
}
@media (max-width: 1200px) {
	.fdmarks {
		display: none;
		}
	}
@media (max-width: 1200px) {
	.fdmark {
		width: 20px;
		height: 20px;
		border-radius: 100%;
		background: #000;
		cursor: pointer
	}
	.fdmark:hover .fdmarks {
		display: block;
		position: absolute;
		top: 0px;
		z-index: 999
	}
}*/
</style>

</head>

<body>
<div class="fdmap">
<div align="left">
	<img src="img/fdmap.png" alt=""  width="1000px" />
</div>

<div class="fdmap_pin"></div>
<div id="apDiv0">
	<a href="new_account-4.php?position=<?php echo $row_Recfd['filling_position'];?>" target="_top">
		<img src="img/fdmap_h.png" class="fdmap_but" border="0" />
	</a>
	
	<?php if ($_GET['position'] != $row_Recfd['filling_position'] ) {?>
	<a href="new_account-4.php?position=<?php if(floor($_GET['position']/4)<$row_Recfd['filling_position']){echo $row_Recfd['filling_position'];}else{echo floor($_GET['position']/4);};?>"><img src="img/fdmap_ff.png" class="fdmap_but" border="0" />
	</a>
	<a href="new_account-4.php?position=<?php if(floor($_GET['position']/2)<$row_Recfd['filling_position']){echo $row_Recfd['filling_position'];}else{echo floor($_GET['position']/2);};?>"><img src="img/fdmap_f.png" class="fdmap_but" border="0" />
	</a>
	<?php }else{?>
		<img src="img/fdmap_ff_g.png" class="fdmap_but" border="0" width="45px"  />
		<img src="img/fdmap_f_g.png" class="fdmap_but" border="0" width="45px" />
	<?php }?>

</div>
<div id="apDiv1">
<ul class="float" style="border: 0px">
   <li><img src="img/<?php if ($num_arr[0] == 0) {echo "fdbox1.png";}if ($num_arr[0] == 1) {if ($data[0][at] == 0) {echo "fdbox5.png";} else {echo "fdbox4.gif";}}?>" class="fdmap_box_self" border="0" /></li>
   
	
			<!--<li style="background-color:<?php if ($data[0][number] == $sn) {echo "#ff3c00";} else {echo "#646464";}?> ;color:#fff; ">
			<?php if($row_Recfds['card'] !=''){
								echo "<span style='padding:5px;'>".$data[0][card]."</span>";
			}?>
			</li>
			<li style="background-color:<?php if ($row_Recfds6['number'] == $sn) {echo "#ad3c00";} else {echo "#323232";}?> ;color:#fff; ">
			<?php if($row_Recfds['name'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds['name']."</span>";
			}?>
			</li>-->
			<li class="fdmark_self">
				
				   <table width="85" border="0" cellspacing="0" cellpadding="0" class="fdmarks_self">
					  <tr>
						<td width="85" height="45" valign="middle" background="img/<?php if ($data[0][number] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>" style="color: #FFF;padding: 0px 5px"><?php echo "<div align='center';>",$data[0][card],"</div><div align='center'>名:",$data[0][name],"<div>";?>
						</td>
					  </tr>
					</table>
				
			</li>
	


</ul>
</div>
<div id="apDiv2">
<ul class="float" style="border: 0px">
   <li><a href="<?php if ($num_arr[1] == 0) {if ($num_arr[0] == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$data[0][card],"&amp;w=",$gtow2,"&vf=",$data[0]['card']."&position=".$arr[0];}}if ($num_arr[1] == 1) {echo "new_account-4.php?position=".$data[1][filling_position];}?>"><img src="img/<?php if ($num_arr[1] == 0) {if ($num_arr[0] == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($num_arr[1] == 1) {if ($data[1][at] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" class="fdmap_box" border="0" /></a></li>
 
			<!--<li style="background-color:<?php if ($row_Recfds2['number'] == $sn) {echo "#ff3c00";} else {echo "#646464";}?> ;color:#fff; "><?php if($row_Recfds6['card'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds2['card']."</span>";
			}?>
			</li>
			<li style="background-color:<?php if ($row_Recfds2['number'] == $sn) {echo "#ad3c00";} else {echo "#323232";}?> ;color:#fff; "><?php if($row_Recfds6['name'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds2['name']."</span>";
			}?>
			</li>-->
			<li class="fdmark">
				<table width="85" border="0" cellspacing="0" cellpadding="0" class="fdmarks ">
  <tr>
    <td width="85" height="45" valign="middle"<?php if ($num_arr[1] != 0) {?> background="img/<?php if ($data[1][number] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>"<? }?> style="color: #FFF;padding: 0px 5px"><?php echo "<div align='center'>",$data[1][card],"</div><div align='center'>",$data[1][name],"<div>";?></td>
  </tr>
</table>

			</li>
	
  
</ul>
</div>
<div id="apDiv3">
<ul class="float" style="border: 0px">
   <li><a href="<?php if ($num_arr[2] == 0) {if ($num_arr[0] == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$data[0][card],"&amp;w=",$gtow3,"&vf=",$row_Recfds['card']."&position=".$arr[1];}}if ($num_arr[2] == 1) {echo "new_account-4.php?position=".$data[2][filling_position];}?>"><img src="img/<?php if ($num_arr[2] == 0) {if ($num_arr[0] == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($num_arr[2] == 1) {if ($data[2]['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" class="fdmap_box" border="0" /></a></li>

			<!--<li style="background-color:<?php if ($row_Recfds3['number'] == $sn) {echo "#ff3c00";} else {echo "#646464";}?> ;color:#fff; "><?php if($row_Recfds6['card'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds3['card']."</span>";
			}?>
			</li>
			<li style="background-color:<?php if ($row_Recfds3['number'] == $sn) {echo "#ad3c00";} else {echo "#323232";}?> ;color:#fff; "><?php if($row_Recfds6['name'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds3['name']."</span>";
			}?>
			</li>-->
			<li class="fdmark">
				<table width="85" border="0" cellspacing="0" cellpadding="0" class="fdmarks">
  <tr>
    <td width="85" height="45" valign="middle"<?php if ($num_arr[2] != 0) {?> background="img/<?php if ($data[2]['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>"<? }?> style="color: #FFF;padding: 0px 5px"><?php echo "<div align='center'>",$data[2]['card'],"</div><div align='center'>",$data[2]['name'],"<div>";?></td>
  </tr>
</table>
			</li>

</ul>
</div>
<div id="apDiv4">
<ul class="float" style="border: 0px">
   <li><a href="<?php if ($num_arr[3] == 0) {if ($num_arr[1] == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$data[1][card],"&amp;w=",$gtow4,"&vf=",$row_Recfds['card']."&position=",$arr[2];}}if ($num_arr[3] == 1) {echo "new_account-4.php?position=".$data[3][filling_position];}?>"><img src="img/<?php if ($num_arr[3] == 0) {if ($num_arr[1] == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($num_arr[3] == 1) {if ($data[3]['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" class="fdmap_box" border="0" /></a></li>

			<!--<li style="background-color:<?php if ($row_Recfds4['number'] == $sn) {echo "#ff3c00";} else {echo "#646464";}?> ;color:#fff; "><?php if($row_Recfds4['card'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds6['card']."</span>";
			}?>
			</li>
			<li style="background-color:<?php if ($row_Recfds4['number'] == $sn) {echo "#ad3c00";} else {echo "#323232";}?> ;color:#fff; "><?php if($row_Recfds6['name'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds4['name']."</span>";
			}?>
			</li>-->
			<li class="fdmark">
				<table width="85" border="0" cellspacing="0" cellpadding="0" class="fdmarks">
  <tr>
    <td width="85" height="45" valign="middle"<?php if ($num_arr[3] != 0) {?> background="img/<?php if ($data[3]['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>"<? }?> style="color: #FFF;padding: 0px 5px"><?php echo "<div align='center'>",$data[3]['card'],"</div><div align='center'>",$data[3]['name'],"<div>";?></td>
  </tr>
</table>
</li>

   
</ul>
</div>
<div id="apDiv5">
<ul class="float" style="border: 0px">
   <li><a href="<?php if ($num_arr[4] == 0) {if ($num_arr[1] == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$data[1][card],"&amp;w=",$gtow5,"&vf=",$data[0]['card']."&position=".$arr[3];}}if ($num_arr[4] == 1) {echo "new_account-4.php?position=".$data[4][filling_position];}?>"><img src="img/<?php if ($num_arr[4] == 0) {if ($num_arr[1] == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($num_arr[4] == 1) {if ($data[4]['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" class="fdmap_box" border="0" /></a></li>

			<!--<li style="background-color:<?php if ($row_Recfds5['number'] == $sn) {echo "#ff3c00";} else {echo "#646464";}?> ;color:#fff; "><?php if($row_Recfds5['card'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds5['card']."</span>";
			}?>
			</li>
			<li style="background-color:<?php if ($row_Recfds6['number'] == $sn) {echo "#ad3c00";} else {echo "#323232";}?> ;color:#fff; "><?php if($row_Recfds6['name'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds5['name']."</span>";
			}?>
			</li>-->
			<li class="fdmark">
				<table width="85" border="0" cellspacing="0" cellpadding="0" class="fdmarks">
  <tr>
    <td width="85" height="45" valign="middle"<?php if ($num_arr[4] != 0) {?> background="img/<?php if ($data[4]['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>"<? }?> style="color: #FFF;padding: 0px 5px"><?php echo "<div align='center'>",$data[4]['card'],"</div><div align='center'>",$data[4]['name'],"<div>";?></td>
  </tr>
</table>

			</li>

</ul>
</div>
<div id="apDiv6">
<ul class="float" style="border: 0px">
   <li><a href="<?php if ($num_arr[5] == 0) {if ($num_arr[2] == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$data[2][card],"&amp;w=",$gtow6,"&vf=",$data[0]['card']."&position=".$arr[4];}}if ($num_arr[5] == 1) {echo "new_account-4.php?position=".$data[5][filling_position];}?>"><img src="img/<?php if ($num_arr[5] == 0) {if ($num_arr[2] == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($num_arr[5] == 1) {if ($data[5]['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" class="fdmap_box" border="0" /></a>
   </li>
   <!--<li>
		<ul>
			<li style="background-color:<?php if ($row_Recfds6['number'] == $sn) {echo "#ff3c00";} else {echo "#646464";}?> ;color:#fff; "><?php if($row_Recfds6['card'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds6['card']."</span>";
			}?>
			</li>
			<li style="background-color:<?php if ($row_Recfds6['number'] == $sn) {echo "#ad3c00";} else {echo "#323232";}?> ;color:#fff; "><?php if($row_Recfds6['name'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds6['name']."</span>";
			}?>
			</li>
		</ul>
	</li>-->
	
		<li class="fdmark"> 
			<table width="85" border="0" cellspacing="0" cellpadding="0" class="fdmarks">
  <tr>
    <td width="85" height="45" valign="middle"<?php if ($num_arr[5] != 0) {?> background="img/<?php if ($data[5]['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>"<? }?> style="color: #FFF;padding: 0px 5px"><?php echo "<div align='center'>",$data[5]['card'],"</div><div align='center'>",$data[5]['name'],"<div>";?></td>
  </tr>
</table>
		</li>
	
</ul>
</div>
<div id="apDiv7">
<ul class="float" style="border: 0px">
   <li><a href="<?php if ($num_arr[6] == 0) {if ($num_arr[2] == 0) {echo "#";} else {echo "new_account-5.php?fu=",$fd_c,"&amp;gu=",$data[2][card],"&amp;w=",$gtow7,"&vf=",$data[0]['card']."&position=".$arr[5];}}if ($num_arr[6] == 1) {echo "new_account-4.php?position=".$data[6][filling_position];}?>"><img src="img/<?php if ($num_arr[6] == 0) {if ($num_arr[2] == 0) {echo "fdbox1.png";} else {echo "fdbox2.png";}}if ($num_arr[6] == 1) {if ($data[6]['at'] == 0) {echo "fdbox3.png";} else {echo "fdbox4.png";}}?>" class="fdmap_box" border="0" /></a></li>

			<!--<li style="background-color:<?php if ($row_Recfds7['number'] == $sn) {echo "#ff3c00";} else {echo "#646464";}?> ;color:#fff; "><?php if($row_Recfds7['card'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds7['card']."</span>";
			}?>
			</li>
			<li style="background-color:<?php if ($row_Recfds7['number'] == $sn) {echo "#ad3c00";} else {echo "#323232";}?> ;color:#fff; "><?php if($row_Recfds7['name'] !=''){
								echo "<span style='padding:5px;'>".$row_Recfds7['name']."</span>";
			}?>
			</li>-->
			<li class="fdmark">
				<table width="85" border="0" cellspacing="0" cellpadding="0" class="fdmarks">
  <tr>
    <td width="85" height="45" valign="middle"<?php if ($num_arr[6] != 0) {?> background="img/<?php if ($data[6]['number'] == $sn) {echo "fdmap_x1.png";} else {echo "fdmap_x0.png";}?>"<? }?> style="color: #FFF;padding: 0px 5px"><?php echo "<div align='center'>",$data[6]['card'],"</div><div align='center'>",$data[6]['name'],"<div>";?></td>
  </tr>
</table>
			</li>

</ul>
</div>

</div>
</body>
</html>