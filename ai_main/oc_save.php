<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
mysql_select_db($database_sc, $sc);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1 ");
$Reclu = mysql_query($query_Reclu, $sc) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
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
$now_datetime=date("Y/m/d H:i:s");
//
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
//
$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
	if ($_POST['see'] == $_POST['sum']) {
        $send=$_POST['send'];$ycard=$_POST['ycard'];$pay=$_POST['pay'];$date=date("Y-m-d");$time=date("H:i:s");
		//支
		mysql_select_db($database_sc, $sc);$myus="boss";
        $query_Recao = sprintf("SELECT * FROM ao_cash WHERE number = '$myus' ORDER BY id DESC");
        $Recao = mysql_query($query_Recao, $sc) or die(mysql_error());
        $row_Recao = mysql_fetch_assoc($Recao);
        $totalRows_Recao = mysql_num_rows($Recao);
		$new_my_sum=$row_Recao['csum']-$pay;
		$my_note="匯出 - 帳號：".$ycard." = ".$pay;
	    mysql_select_db($database_sc, $sc);
        $insertCommand13="INSERT INTO ao_cash (number, cout, csum, note, date, time) VALUES ('$myus', '$pay', '$new_my_sum', '$my_note', '$date', '$time')"; 
        mysql_query($insertCommand13,$sc);
		//收
		mysql_select_db($database_sc, $sc);
        $query_Recym = sprintf("SELECT * FROM memberdata WHERE m_username = '$ycard'");
        $Recym = mysql_query($query_Recym, $sc) or die(mysql_error());
        $row_Recym = mysql_fetch_assoc($Recym);
        $totalRows_Recym = mysql_num_rows($Recym);
		$yus=$row_Recym['number'];
		mysql_select_db($database_sc, $sc);
        $query_Recy = sprintf("SELECT * FROM o_cash WHERE number = '$yus' ORDER BY id DESC");
        $Recy = mysql_query($query_Recy, $sc) or die(mysql_error());
        $row_Recy = mysql_fetch_assoc($Recy);
        $totalRows_Recy = mysql_num_rows($Recy);
		$new_y_sum=$row_Recy['csum']+$pay;
		$y_note="收匯 = ".$pay;
		mysql_select_db($database_sc, $sc);
        $insertCommand13="INSERT INTO o_cash (number, cin, csum, note, date, time) VALUES ('$yus', '$pay', '$new_y_sum', '$y_note', '$date', '$time')"; 
        mysql_query($insertCommand13,$sc);
	    } else {$err="檢查碼不符  !";$send=0;}
}
//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Centre</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E8EFF7;
}
.v1 {
	font-size:28px;
}
.v2 {
	font-size:28px;
	text-align:center
}
.profile2 {	border-radius: 20%;
	border:1px solid #0028E9;
	height: 35px;	
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
.style12 {font-size: 12px;
	line-height: 20px;
	word-spacing: 1px;
	letter-spacing: 1px;
}
.style20 {color: #F78A18; }
.style3 {color: #996633}
.profile21 {
	border-radius: 20%;
	border:1px solid #0028E9;
	height: 35px;	
}
</style>
<script type="text/javascript">
function MM_setTextOfTextfield(objId,x,newText) { //v9.0
  with (document){ if (getElementById){
    var obj = getElementById(objId);} if (obj) obj.value = newText;
  }
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
            <td><span class="style7">
              <?php echo $row_Reclu['name'];?>
您好!</span> <span class="style8">&nbsp;&nbsp;&nbsp;登入帳號：<?php echo $row_Reclu['username'];?></span>&nbsp;&nbsp;【<a href="amss_pas.php">修改密碼</a>】</td>
            <td rowspan="2"><a href="oc_main.php"><img src="images/3.png" alt="登出" title="登出" width="50" height="53" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="505">&nbsp;</td>
        <td width="456" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><hr size="1" noshade="noshade" class="whiteBox" /></td>
      </tr>
      <tr>
        <td height="550" colspan="2" align="center" valign="top"><table width="100%" border="0" cellspacing="15" cellpadding="0">
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="v1"><?php echo $cname;?></td>
          </tr>
          <?php if ($send == 1) {?>
          <tr>
            <td align="center" valign="top" class="v1"><p>*** 完成儲值O幣作業 ***</p>
              <p>帳號【 <a href="oc_mem.php?mc=<?php echo $ycard;?>"><?php echo $ycard;?></a> 】</p></td>
          </tr>
          <?php }?>
          <?php if ($send != 1) {?>
          <tr>
            <td><form id="form2" name="form1" method="post" action="<?php echo $editFormAction; ?>">
              <table width="100%" border="0" cellspacing="10" cellpadding="0">
                <tr>
                  <td height="30" colspan="4" align="center" bgcolor="#FEFEFE" class="v1">儲值 O幣</td>
                  </tr>
                <tr>
                  <td width="18%">&nbsp;</td>
                  <td width="19%" height="30" align="right">&nbsp;</td>
                  <td colspan="2" class="v1"><?php echo $_GET['err'];?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">收值帳號</td>
                  <td colspan="2"><input name="ycard" type="text" class="v2" id="ycard" size="15" />
                    *</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">匯出O幣數值</td>
                  <td colspan="2"><input name="pay" type="text" class="v2" id="pay" size="15" />
                    *</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">&nbsp;</td>
                  <td width="13%"><table width="170" border="1"  cellpadding="0" cellspacing="0" bordercolor="#0028E9">
                    <tr>
                      <td width="63" height="35" align="center" style="color: #0028E9; font-size: 25px;" background="images/7-1.JPG"><?php echo $sum;?></td>
                      </tr>
                    </table></td>
                  <td width="50%"><span style="color: #0028E9">
                    <input name="Submit" type="button" onclick="window.location='mem2.php'" value="刷新驗證碼" />
                    </span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30" align="right">&nbsp;</td>
                  <td colspan="2"><span style="color: #0028E9"><span style="font-size: 10px">*請輸入驗證碼<br />
                    </span>
                    <input name="sum" type="text" class="v2" id="sum" onfocus="MM_setTextOfTextfield('sum','','')" size="10" />
                  </span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="3"><hr /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input name="MM_update" type="hidden" id="MM_update" value="form1" />
                    <input name="see" type="hidden" id="see" value="<?php echo $sum;?>" />
                    <input name="send" type="hidden" id="send" value="1" /></td>
                  <td><input name="button2" type="submit" class="v1" id="button2" value=" 送 出 資 料 " /></td>
                  <td><span class="style3" style="margin:0px; font-size: 18px; font-weight: bold;">
                    <input name="Submit" type="button" class="v1" onclick="window.history.back();" value="回上一頁" />
                  </span></td>
                </tr>
              </table>
            </form></td>
          </tr>
          <?php }?>
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