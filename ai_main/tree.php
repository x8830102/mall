<?php

require_once('Connections/sc.php');mysql_query("set names utf8");
require_once( dirname(dirname(__FILE__)) .'/life_link/class/queue.class.php' );
header("Content-Type:text/html; charset=utf-8");
mysql_select_db($database_sc, $sc);


$position = $_GET['position'];
$data = array();
//抓關係(下)

if(empty($position) || $position =="undefined")
{
	
	$position = 1;
	$objQueue = new Queue;
	$arr = array();
	
	$select_fd = "SELECT * FROM fd WHERE filling_position='$position'";
	$query_fd = mysql_query($select_fd, $sc) or die(mysql_error());
	$row_fd = mysql_fetch_assoc($query_fd);
	$data[0] = $row_fd;
	for($i=0 ;$i<14 ;$i++)
	{
		$position = $position*2;
		$objQueue->EnQueue($position);
		$position = $position+1;
		$objQueue->EnQueue($position);
		$position = $objQueue->DeQueue();
		$arr[$i] = $position;
	}
}else{
	$objQueue = new Queue;
	$arr = array();
	
	$select_fd = "SELECT * FROM fd WHERE filling_position='$position'";
	$query_fd = mysql_query($select_fd, $sc) or die(mysql_error());
	$row_fd = mysql_fetch_assoc($query_fd);
	$data[0] = $row_fd;
	for($i=0 ;$i<14 ;$i++)
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

for($j=0 ;$j<=count($arr); $j++)
{
	$select_fd = "SELECT * FROM fd WHERE filling_position='$arr[$j]'";
	$query_fd = mysql_query($select_fd, $sc) or die(mysql_error());
	$row_fd = mysql_fetch_assoc($query_fd);
	
	$data[$j+1] = $row_fd;
}



?>
<head>

<style type="text/css">
/*Now the CSS*/
* {margin: 0; padding: 0;}

.tree ul {
	padding-top: 20px; position: relative;
	
	
}

.tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
	
	
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 1px solid #ccc;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #ccc;
	width: 0; height: 20px;
}

.tree li a{
	border: 1px solid #ccc;
	padding: 5px 10px;
	text-decoration: none;
	color: #666;
	font-family: arial, verdana, tahoma;
	font-size: 11px;
	display: inline-block;
	
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
	background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
}


</style>
<script>
function set(dd){
	var po = document.getElementById("position");
	po.value=dd;
	document.getElementById("form").submit();
	
}
	
</script>
</head>
<!--
We will create a family tree using just CSS(3)
The markup will be simple nested lists
-->
<h2 style="text-align:center;">組織圖</h2>
<hr>
<div class="tree" style="margin-left: auto;margin-right: auto;width: 840px;display: flex;">
<form id="form" action="" method="get">
	<ul>
		<li>
			<?php 
			/*for($i= ; $i<count($arr);$i++)
			{
				if($i ==0)
				{
					echo "<a href='' ";
					if(empty($data[$i][name])&&!empty($data[$i][card])){ echo "style='background:skyblue;color:#fff;";}
					echo " onclick='set(".$data[$i][filling_position].")'>".$data[$i][name]."<br>".$data[$i][card]."<br>".$data[$i][filling_position]."</a>";
				}else if($i % 4 )
				
				
			}*/
				
				
			?>
			<a href="#" <?php if($data[0][fd_amount] =='0' ){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[0][filling_position];?>)"><?php echo $data[0][name]."<br>".$data[0][card]."<br>".$data[0][filling_position]."<br>".$data[0][fd_amount];?></a>
			<ul>
				<li>
					<a href="#" <?php if($data[1][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[1][filling_position];?>)"><?php echo $data[1][name]."<br>".$data[1][card]."<br>".$data[1][filling_position]."<br>".$data[1][fd_amount];?></a>
					<ul>
						<li>
							<a href="#" <?php if($data[3][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[3][filling_position];?>)"><?php echo $data[3][name]."<br>".$data[3][card]."<br>".$data[3][filling_position]."<br>".$data[3][fd_amount];?></a>
							<ul>
								<li>
									<a href="#" <?php if($data[7][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[7][filling_position];?>)"><?php echo $data[7][name]."<br>".$data[7][card]."<br>".$data[7][filling_position]."<br>".$data[7][fd_amount];?></a>
								</li>
								<li>
									<a href="#" <?php if($data[8][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[8][filling_position];?>)"><?php echo $data[8][name]."<br>".$data[8][card]."<br>".$data[8][filling_position]."<br>".$data[8][fd_amount];?></a>
								</li>
							</ul>
						</li>
						
						<li>
							<a href="#" <?php if($data[4][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[4][filling_position];?>)"><?php echo $data[4][name]."<br>".$data[4][card]."<br>".$data[4][filling_position]."<br>".$data[4][fd_amount];?></a>
							<ul>
								<li>
									<a href="#" <?php if($data[9][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[9][filling_position];?>)"><?php echo $data[9][name]."<br>".$data[9][card]."<br>".$data[9][filling_position]."<br>".$data[9][fd_amount];?></a>
								</li>
								<li>
									<a href="#" <?php if($data[10][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[10][filling_position];?>)"><?php echo $data[10][name]."<br>".$data[10][card]."<br>".$data[10][filling_position]."<br>".$data[10][fd_amount];?></a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<li>
					<a href="#" <?php if($data[2][fd_amount] =='0' ){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[2][filling_position];?>)"><?php echo $data[2][name]."<br>".$data[2][card]."<br>".$data[2][filling_position]."<br>".$data[2][fd_amount];?></a>
					<ul>
						<li>
							<a href="#" <?php if($data[5][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?>  onclick="set(<?php echo $data[5][filling_position];?>)"><?php echo $data[5][name]."<br>".$data[5][card]."<br>".$data[5][filling_position]."<br>".$data[5][fd_amount];?></a>
							<ul>
								<li>
									<a href="#" <?php if($data[11][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[11][filling_position];?>)"><?php echo $data[11][name]."<br>".$data[11][card]."<br>".$data[11][filling_position]."<br>".$data[11][fd_amount];?></a>
								</li>
								<li>
									<a href="#" <?php if($data[12][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[12][filling_position];?>)"><?php echo $data[12][name]."<br>".$data[12][card]."<br>".$data[12][filling_position]."<br>".$data[12][fd_amount];?></a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#" <?php if($data[6][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[6][filling_position];?>)"><?php echo $data[6][name]."<br>".$data[6][card]."<br>".$data[6][filling_position]."<br>".$data[6][fd_amount];?></a>
							<ul>
								<li>
									<a href="#" <?php if($data[13][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[13][filling_position];?>)"><?php echo $data[13][name]."<br>".$data[13][card]."<br>".$data[13][filling_position]."<br>".$data[13][fd_amount];?></a>
								</li>
								<li>
									<a href="#" <?php if($data[14][fd_amount] =='0'){echo "style='background:skyblue;color:#fff;'";}?> onclick="set(<?php echo $data[14][filling_position];?>)"><?php echo $data[14][name]."<br>".$data[14][card]."<br>".$data[14][filling_position]."<br>".$data[14][fd_amount];?></a>
								</li>
							</ul>
						</li>
			
					</ul>
				</li>
			</ul>
		</li>
	</ul>
	<input type="hidden" value="" id="position" name="position">
	<input type='button' onclick="set(<?php echo floor($_GET['position']/2);?>)"style="margin: 20px;background: #fff;border: 1px solid;padding: 3px;" value="回上頁"/>
	<a href="mem_main.php">回到後台</a>
</div>
