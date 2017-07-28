<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
include('if_login.php');
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
if ($a_pud < 2) {header(sprintf("Location: index.php"));exit;}
//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//
if ($_GET['fu'] != "") {
	$gu=$_GET['gu'];$fu=$_GET['fu'];$w=$_GET['w'];
	mysql_select_db($database_sc, $sc);
    $query_Recb = sprintf("SELECT * FROM fd WHERE card='$fu'");
    $Recb = mysql_query($query_Recb, $sc) or die(mysql_error());
    $row_Recb = mysql_fetch_assoc($Recb);
    $totalRows_Recb = mysql_num_rows($Recb);
	}
//
mysql_select_db($database_sc, $sc);
$query_Reca = sprintf("SELECT * FROM a_pud WHERE at=1 ORDER BY id");// DESC
$Reca = mysql_query($query_Reca, $sc) or die(mysql_error());
$row_Reca = mysql_fetch_assoc($Reca);
$totalRows_Reca = mysql_num_rows($Reca);
//
mysql_select_db($database_sc, $sc);
$query_Recocz = sprintf("SELECT * FROM o_cash WHERE number = '$sn' ORDER BY id DESC");
$Recocz = mysql_query($query_Recocz, $sc) or die(mysql_error());
$row_Recocz = mysql_fetch_assoc($Recocz);
$totalRows_Recocz = mysql_num_rows($Recocz);
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>串門子雲端事業</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <link rel="icon" href="img/life_link.jpg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/dragdealer.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="jasny-bootstrap/css/jasny-bootstrap.css">
    <link rel="stylesheet" type="text/css" href="icomoon/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="js/map.js"></script>
	<script src="js/dragdealer.js"></script>
    <style type="text/css">
    body {
        font-family: "verdana", "微軟正黑體";
        font-weight: 400;
    }
    </style>
<script type="text/javascript">
$(document).ready(function(){
    $('#fuser2, #fuser').keyup(function(){
        if($('#fuser2').val() == $('#fuser').val()){
            $('.percent').hide();
        }else{
            $('.percent').show();
        }
    });
    var aa = new Dragdealer('just-a-slider',{
        animationCallback: function(x, y) {
			var a =10-Math.round(x * 10);
			var b = Math.round(x * 10,-1); 
			$('#just-a-slider .value').text(a + '/' + b+"➢" );
			var businessRatio = [10-Math.round(x * 10),Math.round(x * 10)];
			$('#businessRatio').val(businessRatio);
      }
    });
	$("#abc").click(function(){
		aa.disabled=true;
	})
    $('.percent').hide();
});
$(function(){
    $("#notpayput").blur(function(){
		var selectBox = document.getElementById("pudid");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		if(selectedValue == 5)
		{
			
			var pay = $("#notpayput").val();

			if(pay<30000){
				$("#warring").html('輸入金額不可小於3,0000!');
				$("#button").attr("disabled","disabled");
				$("#notpayput").focus();
			}else if(pay >50000){
				$("#warring").html('輸入金額錯誤!');
				$("#button").attr("disabled","disabled");
				$("#notpayput").focus();
			}else{
				$("#warring").html('');
				$("#button").attr("disabled",false);
			}
		}else if(selectedValue ==7){
			var pay = $("#notpayput").val();
			if(pay<30000){
				$("#warring").html('輸入金額不可小於30,000!');
				$("#button").attr("disabled","disabled");
				$("#notpayput").focus();
			}else if(pay > 120000){
				$("#warring").html('輸入金額錯誤!');
				$("#button").attr("disabled","disabled");
				$("#notpayput").focus();
			}else{
				$("#warring").html('');
				$("#button").attr("disabled",false);
			}
		}
    })
	var selectBox = document.getElementById("pudid");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var err = "<?php echo $_GET['err'];?>";
	var username = "<?php echo $username;?>";
	var elite = document.getElementById("Elite_project");
	if(err && username=="peggy" && selectedValue >=5)
	{
		elite.style.display="";
	}
})
function aa(){
	var nopay = document.getElementById("notpay");
	if(nopay.checked)
	{
		document.getElementById("notpayput").style.display="";
	}else{
		document.getElementById("notpayput").style.display="none";
	}
}
function elite(){
	var selectBox = document.getElementById("pudid");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

	var elite = document.getElementById("Elite_project");
	var username = "<?php echo $username;?>";
	if(selectedValue == 5 || selectedValue ==7)
	{
	if(username == "peggy" || username =="terry888" || username=="sunny")
		{
			elite.style.display="";
		}
	}else{
		elite.style.display="none";	
	}
	
}
</script>
</head>

<body>
<?php require_once('adx.php');require_once('phone.php');require_once('desktop.php'); ?>
    <!--↓↓↓↓↓↓↓↓↓↓

                     content

                                    ↓↓↓↓↓↓↓↓↓↓↓-->
<div class="cut-navbar col-lg-7 col-md-7 col-sm-7 col-xs-11 col-lg-offset-2 col-sm-offset-1">
    <ul class="cut-page">
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line_active">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >註冊會員</span></a></li>
            </ul>
        </li>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="member_profile01.php"><span class="icon-c hidden-xs" style="margin-right: 5px"></span><span>基本資料</span></a></li>
                <li></li>
            </ul>
        </li>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="integral_management_1.php"><span class="icon-d hidden-xs" style="margin-right: 5px"></span><span>積分管理</span></a></li>
                <li></li>
            </ul>
        </li>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="fan_management_2.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>會員管理</span></a></li>
                <li></li>
            </ul>
        </li>
    </ul>
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <li class="active"> <a href="new_account-1.php"><span>註冊新帳戶</span></a> </li>
            <?php if ($a_pud >= 4) {?><li> <a href="new_account-4.php"><span>福袋兌換</span></a></li><?php }?>
          
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">註冊新會員</div>
            <form id="form1" name="form1" method="get" action="new_account-2.php" autocomplete="off">
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 60px 12px 30px ">
                <tbody>
                    <tr class="menu-tr">
                      <td colspan="2" align="center"><span style="color: #F00"><?php echo $_GET['err'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>註冊積分餘額</span></td>
                        <td><span style="color: red;"><?php $pc=$row_Recocz['csum']+0;$pc2=number_format($pc, 0, '.' ,',');echo $pc2;?></span></td>
                    </tr>
                    <!--<tr class="menu-tr">
                      <td class="menu-td">課程講師編號</td>
                      <td><input name="ter" type="text" id="ter" value="<?php //if ($_GET['ter'] == "") {echo "A00";} else {echo $_GET['ter'];}?>"></td>
                    </tr>-->
					
                   <tr class="menu-tr">
                        <td class="menu-td">推廣者帳號A</td>
                        <td>
                            <input name="fuser" type="text" id="fuser" value="<?php if ($_GET['fuser'] == "") {echo $row_Recsn['m_username'];} else {echo $_GET['fuser'];}?>">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                      <td colspan="2" class="ann-t">
						<div class="ann-a" >*至少需要四個字元，僅限字母與數字</div>
					  </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">推廣者帳號</td>
                        <td>
                            <input name="fuser2" type="text" id="fuser2" value="<?php if ($_GET['fuser'] == "") {echo $row_Recsn['m_username'];} else {echo $_GET['fuser'];}?>">
                        </td>
                    </tr>
                    <tr class="percent menu-tr">
                        <td class="menu-td">積分配比</td>
							
						 <td class="menu-td">
							<input name="businessRatio" type="hidden" id="businessRatio" value="" />
                            <div id="just-a-slider" class="dragdealer bar" >
                                <div class="handle red-bar" style="">
                                    <span class="value"></span>
                                </div>
                            </div>
							<input name="abc" type="button" id="abc" value="確認" />
                        </td>
                    </tr>
					
                        
                        
                       
                        <td colspan="2" class="ann-t">
                            <div class="ann-a">*至少需要四個字元，僅限字母與數字</div>
                        </td>
                    </tr>
                    
                    <tr class="menu-tr">
                        <td class="menu-td">店家帳號網址設定</td>
                        <td>
                            <input name="newuser" type="text" id="newuser" value="<?php if ($_GET['newuser'] != "") {echo $_GET['newuser'];} else {echo "";}?>" size="12" maxlength="13" placeholder=" ">
                        </td>
                    </tr>
                    <tr >
                        <td  class="ann-t" colspan="2">
                            <div class="ann-a" style="margin-top:-7px;font-size: 12px;font-weight: 600;color:#F00;line-height: 27px">此為店家網址之名稱，設定後不能更改</div>
                        </td>
                           
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">上架系統購買專案</td>
                        <td><?php if ($totalRows_Reca != 0) {?>
                            <select name="pudid"  id="pudid" onclick='elite()' class="menu-select">
							<?php if($username == "peggy88" || $username =="sunny" || $username=="terry888")
							{?>
								<option value="0">產官公學專案,$0/年繳
							<?php 
							}?>
							
							  
                              <?php do {
								  $id = $row_Reca['id'];
							  ?>
							  
                              <option value="<?php echo $row_Reca['id'];?>" <?php if ($_GET['pudid'] == $row_Reca['id']) {echo "selected='selected'";}?>><?php echo $row_Reca['name'],"  ,  $ ",number_format($row_Reca['p'], 0, '.' ,',')," /年繳 ";?></option>
                              <?php } while ($row_Reca = mysql_fetch_assoc($Reca));?>
							  <?php
							 if($username == "sunny")
							{?>
								<option value="8">總裁贏家分紅專案*
							<?php 
							}?>
                            </select><? } else {echo "暫停作業";}?>
							
                        </td>
                    </tr>
					<tr id="Elite_project" class="menu-tr" style="display:none">
						<td>
						</td>
						<td>
							<input style="height:13px;" type="checkbox"  id="notpay" onClick="aa();"/><span>福音專案</span>
							<input type="number" id="notpayput" name="notpay" value="" style="min-width: 0px !important;width: 127px;display:none" placeholder=""/><br><span id="warring" style="color: red;"></span>
						</td>
					</tr>
                    <tr class="menu-tr">
                        <td class="menu-td">二級密碼</td>
                        <td>
                            <input name="passtoo" type="password" id="passtoo" size="12" placeholder="請輸入二級密碼">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><input name="see" type="hidden" id="see" value="<?php echo $sum;?>">
                  驗證碼</td>
                        <td>
                            <input name="sum" type="text" id="sum" style="min-width: 90px;" size="12" placeholder="請輸入驗證碼">
                            <span style="padding: 2px; border: 1px solid #000"><?php echo $sum;?></span>
                            <a href="new_account-1.php"><img width="21px" src="img/refresh.png" alt="" style="margin-left: 3px"></a>
                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="2">
                            <?php if ($totalRows_Reca != 0) {?><input type="submit" name="button" id="button" class="menu-but"  value="下一步"><? } else {echo "暫停作業";}?>
                            <input name="Submit4" type="button" class="menu-but" onclick="window.location='index.php'" value=" 取消 " />
                        </td>
                    </tr>
                </tbody>
            </table></form>
        </div>
    </div>
</div>
 
    <!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
