<?php 
require_once('Connections/kg.php');mysql_query("set names utf8");
require_once('Connections/sc.php');mysql_query("set names utf8"); 
 ?>
<?php
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$tname = $_POST['TT'];
	if(isset($tname)){
		mysql_select_db($database_sc, $sc);
		$sql3 = "SELECT * FROM memberdata WHERE m_username = '$tname' ";
		$con3 = mysql_query($sql3, $sc) or die(mysql_error());
		$row3 = mysql_fetch_assoc($con3);
		$tname = $row3['m_nick'];
		echo $tname;exit;
	}
}else{
	
mysql_select_db($database_sc, $sc);
$query_Reca = sprintf("SELECT * FROM a_pud WHERE at=1 ORDER BY id");// DESC
$Reca = mysql_query($query_Reca, $sc) or die(mysql_error());
$row_Reca = mysql_fetch_assoc($Reca);
$totalRows_Reca = mysql_num_rows($Reca);



//
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>串門子雲端事業</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style type="text/css">
        body{
            font-family:"verdana","微軟正黑體" ; font-weight:400;
        }
    .v2 {font-size:20px;
	text-align:left;
	border:1px solid #ADADAD;
}
    </style>
<script type="text/javascript">
$(function(){
    $("#notpayput").keyup(function(){
        var pay = $("#notpayput").val();
        if(pay<30000){
            $("#warring").html('輸入金額不可小於3,0000');
			$("#button").prop("disabled",true);
            $("#notpayput").focus();
        }else{
            $("#warring").html('');
            $("#button").prop("disabled",false);
        }
    })
    
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

function bb(){
	var fuser =$("#fuser").val();
	$.ajax({
		type: "POST",
		url: "ajax_new_accout.php",
		dataType: "text",
		data: {
			fu :fuser
			
		},
		success: function(dd) {
			switch (dd){
				case "推薦人等級不足":
					$("#warring").css("display","");
					$("#warring").html("推薦人等級不足");
					$("#button").prop("disabled",true);
					break;
				default:
					$("#warring").css("display","none");
					$("#fnumber").val(dd);
					$("#snumber").val(dd);
					$("#button").prop("disabled",false);
					break;
			}
			
		}
	})
}
function elite(){
	var selectBox = document.getElementById("pudid");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

	var elite = document.getElementById("Elite_project");

	if(selectedValue == 5)
	{
		elite.style.display="";
	}else{
		elite.style.display="none";
	}
	
}
//Tname
function up(){
	//T推薦人
	var TT = $("#Tname").val();
	$.ajax({
		url: "",
		data: {TT:TT},
		type:"POST",
		dataType:'text',

		success: function(data){
				$("#smallT").val(data);
				$("#TT").val(data);
		}
	})
}
</script>
</head>

<body>

    <!--↓↓↓↓↓↓↓↓↓↓

                     content

                                    ↓↓↓↓↓↓↓↓↓↓↓-->
<div class="cut-navbar col-lg-7 col-md-7 col-sm-7 col-xs-11 col-lg-offset-2 col-sm-offset-1">
    
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">註冊新會員</div>
            <form id="form1" name="form1" method="post" action="/cmg/life_link/x_form.php">
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr class="menu-tr">
                      <td colspan="2"  align="center"><span id="warring"style="color: #F00"><?php echo $_GET['err'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
						 <td width="110" class="menu-td">推薦人帳號</td>
						<td>
                            <input name="fuser" type="text" id="fuser" name="fuser"value="" onkeyup="bb()"/>
                        </td>
                      
                        <td>
                            <span><?php echo $newuser;?></span>
							
                        
                        <input name="st2" type="hidden" id="st2" value="1" />
                        <input name="fnumber" type="hidden" id="fnumber" value="" />	<!--推薦人num-->
						<input name="snumber" type="hidden" id="snumber" value="" />	<!--推薦人num-->
                        <?php 
						session_start();
						
						//echo $_SESSION['number'];
						?>
                        
                        
                        
                        <span class="style3" style="margin:0px; font-size: 18px; font-weight: bold;">
                        <input type="hidden" name="MM_insert" value="form1" />
                        <span style="color: #FEDB4D">
                        <input name="see" type="hidden" id="see" value="<?php echo $sum;?>" /> <!-- 驗證碼 ?-->
                        <input name="ter" type="hidden" id="ter" value="<?php echo $ter;?>">	<!-- 未知 ?-->
                        </span></span></td>
                    </tr>
					<tr class="menu-tr">
					  <td width="110" class="menu-td">設定登入帳號</td>
						<td>
                            <input name="newuser" type="text" id="newuser" value="" />
                        </td>
					</tr>
					<tr class="menu-tr">
					
						<td  class="menu-td">T登入帳號</td>
						<td>
							<input type="text" id="Tname" name="Tname" style="height: 25px;padding-left: 5px;" placeholder="請輸入講師帳號" autocomplete="off" onkeyup="up()">
							<input type="text" id="smallT" readonly="readonly" style="width:100px;min-width:0px !important;height: 25px;padding-left: 5px;background: black;color: #fff;"></span>
						</td>
					</tr>
					<tr class="menu-tr">
                        <td class="menu-td">名稱或暱稱</td>
                        <td>
                            <input name="nick" type="text" id="nick" value="" >
                        </td>
                    </tr>
					<tr class="menu-tr">
                        <td class="menu-td">E-mail</td>
                        <td>
                            <input name="email" type="text" id="email" value="" />
                        </td>
                    </tr>
					<tr class="menu-tr">
                        <td class="menu-td">行動電話</td>
                        <td>
                            <input maxlength="10" name="callphone" type="tel" id="callphone" value="" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>商品名稱</span></td>
                        <td>
							<select name="pudid" id="pudid" onclick='elite()' class="menu-select">
								 <?php do {
								  $id = $row_Reca['id'];
							  ?>
							  
                              <option value="<?php echo $row_Reca['id'];?>" <?php if ($_GET['pudid'] == $row_Reca['id']) {echo "selected='selected'";}?>><?php echo $row_Reca['name'],"  ,  $ ",number_format($row_Reca['p'], 0, '.' ,',')," /年繳 ";?></option>
                              <?php } while ($row_Reca = mysql_fetch_assoc($Reca));?>
                            </select>
						</td>
                    </tr>
					<tr>
						<td>
						</td>
						<td  id="Elite_project" class="menu-tr" style="display:none">
							<label for="notpay" style="font-weight:normal;padding-left: 5px;"></label>
							<input style="height:13px;" type="checkbox"  id="notpay" onClick="aa();"/>菁英衝刺專案
							<input type="text" id="notpayput" name="notpay" value="" style="min-width: 0px !important;width: 127px;display:none" placeholder=""/><br><span id="warring" style="color: red;"></span>
							
						</td>
					</tr>
                    <!--<tr class="menu-tr">
                      <td class="menu-td">課程講師</td>
                      <td><?php echo $ter;?></td>
                    </tr>-->
                    
                    <tr class="menu-tr">
                        <td class="menu-td">新註冊登入密碼</td>
                        <td>
                            <input name="newpasswd" type="text" id="newpasswd" value="<?php if ($_GET['newpasswd'] != "") {echo $_GET['newpasswd'];} else {echo "123456";}?>" placeholder="密碼預設123456">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">新註冊二級密碼</td>
                        <td>
                            <input name="newpasstoo" type="text" id="newpasstoo" value="<?php if ($_GET['newpasstoo'] != "") {echo $_GET['newpasstoo'];} else {echo "123456";}?>" placeholder="密碼預設123456">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">國籍</td>
                        <td>
                            <select name="coc" id="coc" class="menu-select">
                                <option value="TW"  style="padding-left: 15px">台灣(TAIWAN) </option>
                                <option value="CN">中國(CHINA)</option>
                                <option value="US">美國(UNITED STATES) </option>
                                <option value="SG">新加坡(Singapore) </option>
                                <option value="MY">馬來西亞(Malaysia) </option>
                                <option value="HK">香港(HK)</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">性別</td>
                        <td>
                            <select name="m_sex" class="menu-select" id="m_sex">
                        <option value="F">女</option>
                        <option value="M">男</option>
                      </select>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">生日</td>
                        <td>
                            <input name="birthday" type="date" id="bookdate" value="" size="15" placeholder="2014-09-18" />
                        </td>
                    </tr>
                    
                    <tr align="center">
                        <td colspan="2">
                            <input type="submit" name="button" id="button" disabled="true" class="menu-but" value="確認">
                            <input name="Submit4" type="button" class="menu-but" onclick="window.location='new_account.php'" value=" 取消 " />
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
<?php }