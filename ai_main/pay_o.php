<?php require_once('Connections/sc.php');mysql_query("set names utf8"); ?>
<?php
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
mysql_select_db($database_sc, $sc);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1 && level >= 7");
$Reclu = mysql_query($query_Reclu, $sc) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
//
$currentPage = $_SERVER["PHP_SELF"];
$maxRows_Recl = 30;
$pageNum_Recl = 0;
if (isset($_GET['pageNum_Recl'])) {
  $pageNum_Recl = $_GET['pageNum_Recl'];
}
$startRow_Recl = $pageNum_Recl * $maxRows_Recl;
$fg="";
//if ($row_Reclu['level'] == 6) {$au="&& admin = '".$ceo."'";} else {$au="";}
//if ($_GET['k1'] == "") {$key="SELECT * FROM memberdata WHERE m_fuser <> '$fg'  && m_ok >= 0 ".$au." ORDER BY card DESC";} 
//if ($_GET['k1'] != "") {$ke1=$_GET['k1'];$ke2=$_GET['k2'];$key="SELECT * FROM memberdata WHERE m_fuser <> '$fg' && m_ok >= 0 ".$au." && ".$ke1." LIKE '%%".$ke2."%%' ORDER BY card DESC";}
//投資人資料
$key="SELECT * FROM  cmg_investment ORDER BY serial_no asc";
mysql_select_db($database_sc, $sc);
$query_Recl = sprintf($key);
$query_limit_Recl = sprintf("%s LIMIT %d, %d", $query_Recl, $startRow_Recl, $maxRows_Recl);
$Recl = mysql_query($query_limit_Recl, $sc) or die(mysql_error());
$row_Recl = mysql_fetch_assoc($Recl);
//

//投資總額
$select_dividend = "SELECT sum(invest_amount) as dividend FROM cmg_investment";
$query_dividend = mysql_query($select_dividend, $sc);
$row_dividend = mysql_fetch_assoc($query_dividend);
$dividend = $row_dividend['dividend'];
//
if (isset($_GET['totalRows_Recl'])) {
  $totalRows_Recl = $_GET['totalRows_Recl'];
} else {
  $all_Recl = mysql_query($query_Recl);
  $totalRows_Recl = mysql_num_rows($all_Recl);
}
$totalPages_Recl = ceil($totalRows_Recl/$maxRows_Recl)-1;
$queryString_Recl = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recl") == false && 
        stristr($param, "totalRows_Recl") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recl = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recl = sprintf("&totalRows_Recl=%d%s", $totalRows_Recl, $queryString_Recl);
//營運球資訊
mysql_select_db($database_sc, $sc);
$select_ball = "SELECT * FROM operation_ball  ORDER BY id ASC";
$query_ball = mysql_query($select_ball, $sc) or die(mysql_error());
$row_ball = mysql_fetch_assoc($query_ball);
$num_ball = mysql_num_rows($query_ball);
///

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>無標題文件</title>

<link rel="stylesheet" type="text/css" href="include/css/table.css">
<link rel="stylesheet" type="text/css" href="include/css/modal.css">
<script src="include/js/jquery-3.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
.style14 {font-size: 12px;
	font-family: "新細明體";
	color: #999999;
}
.style17 {font-size: 12px;
	color: #666666;
	font-weight: bold;
}
.style7 {color: #660099;
	font-weight: bold;
}
.style8 {color: #0000FF;
	font-weight: bold;
}
.whiteBox {border: 1px solid #FFFFFF;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style12 {font-size: 12px;
	line-height: 20px;
	word-spacing: 1px;
	letter-spacing: 1px;
}
.style201 {color: #F78A18; }
.style171 {font-size: 22px; line-height: 20px; word-spacing: 1px; letter-spacing: 1px; }
.style181 {font-size: 22px; line-height: 20px; word-spacing: 1px; letter-spacing: 1px; color: #0000FF; }
a:link {
	color: #00F;
}
a:visited {
	color: #00F;
}
a:hover {
	color: #F90;
}
a:active {
	color: #F00;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}

.modal-content{
	width:450px; 
	height:180px;
	margin-right: 110px;
	text-align:center;
	vertical-align:middle;
	border:solid 2px #fff;	
	}
.modal-body span{
	line-height:28px;
}
/* 讓table-cell下的所有元素都居中 */
.modal-content *{ vertical-align:middle;}
</style>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function ch(){
	var fuser = $("#fuser").val();
	var user_name = $("#user_name").val();
	var operation_amount = $("#operation_amount").val();
	$.ajax({
		type: "POST",
		url: "ajax_operation_check.php",
		dataType: "json",
		data:{
			a:fuser,
			b:user_name,
			c:operation_amount,
		},
		success:function(data){
			fuser = data["a"];
			user_name = data["b"];
			operation_amount = data["c"];
			var num = data["d"];
			
			if(fuser =="")
			{
				$("#error").css("display","block");
				$("#error").text("推薦人不可為空!");
			}else if(num ==0){
				$("#error").css("display","block");
				$("#error").text("推薦人輸入錯誤!");
			}else if(user_name ==""){
				$("#error").css("display","block");
				$("#error").text("投資人不可為空!");
			}else if(operation_amount ==""){
				$("#error").css("display","block");
				$("#error").text("投資金額不可為空!");
			}else if(isNaN(operation_amount)){
				$("#error").css("display","block");
				$("#error").text("投資金只能有數字!");
			}else{
				$("#form1").submit();
			}
			
			
		}
	})
	
}
</script>
</head>

<body>
<table width="1000" border="3" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="150" colspan="2" valign="top" background="images/2.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="29%" height="81">&nbsp;</td>
            <td width="58%">&nbsp;</td>
            <td width="13%">&nbsp;</td>
          </tr>
          <tr>
            <td height="51">&nbsp;</td>
            <td><span class="style7"> <?php echo $row_Reclu['name'];?> 您好!</span> <span class="style8">&nbsp;&nbsp;&nbsp;登入帳號：<?php echo $row_Reclu['username'];?></span>&nbsp;&nbsp;</td>
            <td rowspan="2"><a href="ai_in.php"><img src="images/3.png" alt="回管理" title="回管理" width="50" height="53" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="288" align="right"><table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>                       
            <!--<td width="5%" ><input name="Submit3" type="button" class="style181" onclick="window.location='pay_o.php'" value="投資人" /></td>
            <td width="95%" ><input name="Submit3" type="button" class="style171" onclick="window.location='pay_p.php'" value="營運球" /></td>-->
			<td width="95%" ><input name="Submit3" type="button" class="style171" value="投資" data-toggle="modal" data-target="#myModal"/><a href=""></td>
			<div id="a" class="attention td_block" style="display:inline;">
				<!-- Modal -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
					<!-- Modal content-->
						<div class="modal-content" style="">
							<div class="modal-body">
							
								<form action="investment_in.php"  id="form1" method="post">
								<span style='color:red;font-size:14px;display:none;' id="error"></span>
								
								
								<span>推薦人:</span><input type="text" id="fuser" name="fuser" value="" style="width: 100px;"/><br>
								<span>投資人姓名:</span><input type="text" id="user_name" name="user_name"value="" style="width: 100px;"/><br>
								
								<span>金額:</span><input type="text" id="operation_amount" name="operation_amount"value="" style="width: 100px;"/><br>
								
								</form>
							
							</div>
							<div class="modal-footer">
								<button type='button' class="btn btn-default"  value='' onclick="ch();" >確定</button>
							</div>
								
						</div>
					</div>
				</div>
			</div>
						
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr>
              <td width="73%">*** 營運球資訊= <? echo $num_ball;?>，目前累計投資金額 = <?php echo number_format($dividend, 0, '.' ,',');?></td>
              <td width="27%"><a href="print_1.php?p=a">列印</a></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="350" colspan="2" align="center" valign="top"><table width="1000" border="0" align="center" cellpadding="0" cellspacing="1">
          <tr>
            <td width="267" height="30" align="center" bgcolor="#46A0EC" class="style21">營運帳號</td>
            <td width="213" align="center" bgcolor="#46A0EC" class="style21">金額</td>
            <td width="213" align="center" bgcolor="#46A0EC" class="style21">營運球</td>
          </tr>
        <?php 
			if ($totalRows_Recl != 0) 
			{
				do{ 
					$invest_name=$row_Recl['investor_name'];
					$invest_number = $row_Recl['investor_id'];
					$invest_amount = $row_Recl['invest_amount'];
					$invest_no = $row_Recl['serial_no'];
					
					
					$select_investor_ball = "SELECT * FROM operation_ball WHERE number ='$invest_number' and investor_no='$invest_no'";
					$query_investor_ball = mysql_query($select_investor_ball, $sc);
					$row_investor_ball =  mysql_fetch_assoc($query_investor_ball);
					$num_investor_ball = mysql_num_rows($query_investor_ball);
					
					$select_use_ball = "SELECT * FROM operation_ball WHERE number ='$invest_number' and investor_no='$invest_no' and use_status=1";
					$query_use_ball = mysql_query($select_use_ball, $sc);
					$row_use_ball =  mysql_fetch_assoc($query_use_ball);
					$num_use_ball = mysql_num_rows($query_use_ball);
		?>
          <tr>
            <td height="39" align="center" bgcolor="#99FFCC">姓名：<?php echo $invest_name,"<br/>";?></td>
            <td align="center" bgcolor="#99FFCC">$<?php echo number_format($invest_amount, 0, '.' ,',');?></td>
            <td width="500" align="center" bgcolor="#99FFCC"><?php echo $num_use_ball."/".$num_investor_ball;?></td>
          </tr>
          <?php } while ($row_Recl = mysql_fetch_assoc($Recl)); } else {echo "目前無資訊 ! ! !";}?>
        </table>
          <br />
          <table border="0" width="50%" align="right">
            <tr>
              <td width="23%" align="center" class="style12"><?php if ($pageNum_Recl > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_Recl=%d%s", $currentPage, 0, $queryString_Recl); ?>" class="style201">第一頁</a>
                <?php } // Show if not first page ?></td>
              <td width="31%" align="center" class="style12"><?php if ($pageNum_Recl > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_Recl=%d%s", $currentPage, max(0, $pageNum_Recl - 1), $queryString_Recl); ?>" class="style201">上一頁</a>
                <?php } // Show if not first page ?></td>
              <td width="23%" align="center" class="style12"><?php if ($pageNum_Recl < $totalPages_Recl) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_Recl=%d%s", $currentPage, min($totalPages_Recl, $pageNum_Recl + 1), $queryString_Recl); ?>">下一頁</a>
                <?php } // Show if not last page ?></td>
              <td width="23%" align="center" class="style12"><?php if ($pageNum_Recl < $totalPages_Recl) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_Recl=%d%s", $currentPage, $totalPages_Recl, $queryString_Recl); ?>">最後一頁</a>
                <?php } // Show if not last page ?></td>
            </tr>
            <tr>
              <td colspan="4" align="center" class="style12"><table width="500" border="0" align="right" cellpadding="0" cellspacing="5">
                <tr>
                  <?php $cno=0;$pag=ceil($totalRows_Recl/30);$pai=1;$pb=0;while ($pag != 0) {?>
                  <td width="40" align="center"><?php if (($_GET['pageNum_Recl']+1) == $pai) {echo "[",$pai,"]";} else {?>
                    <a href="mem_main.php?pageNum_Recl=<?php echo $pb;?>"><?php echo $pai,".";?></a>
                    <?php }?></td>
                  <?php $pag--;$pai++;$pb++;$cno++;if($cno%10==0){echo "</tr><tr>";}}?>
                </tr>
              </table></td>
              </tr>
          </table></td>
      </tr>
      
      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>