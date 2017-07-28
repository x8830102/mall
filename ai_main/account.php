<?php require_once('Connections/kg.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();

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

//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
mysql_select_db($database_kg, $kg);
$query_Reca = sprintf("SELECT * FROM a_pud WHERE at=1 ORDER BY p DESC");//
$Reca = mysql_query($query_Reca, $kg) or die(mysql_error());
$row_Reca = mysql_fetch_assoc($Reca);
$totalRows_Reca = mysql_num_rows($Reca);
//
if ($_GET['gi'] != "") {
	$gi=$_GET['gi'];$w=$_GET['w'];
	mysql_select_db($database_kg, $kg);
    $query_Recb = sprintf("SELECT * FROM memberdata WHERE m_id=$gi");
    $Recb = mysql_query($query_Recb, $kg) or die(mysql_error());
    $row_Recb = mysql_fetch_assoc($Recb);
    $totalRows_Recb = mysql_num_rows($Recb);
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
	margin:0;
	padding:0;
	background: #FFF url(minwt_bg.jpg) center center fixed no-repeat;
	-moz-background-size: cover;
	background-size: cover;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
.profile21 {border-radius: 20%;
	border:1px solid #0028E9;
	height: 35px;
	font-size:22px;	
	text-align:center;
}
.v1 {	font-size:22px;
        text-align:center;
}
.v2 {	font-size:22px;
	text-align:right;
}
.v3 {	font-size:22px;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
.v11 {font-size:22px;
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

function MM_setTextOfTextfield(objId,x,newText) { //v9.0
  with (document){ if (getElementById){
    var obj = getElementById(objId);} if (obj) obj.value = newText;
  }
}
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="360" valign="top" id="d1" style="display: none"><iframe  src="mem_sys.php" name="sys" width="360" height="1000" marginwidth="0" marginheight="0" scrolling="No" frameborder="0"  id="mem_sys"> </iframe></td>
    <td valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="0">
      <tr>
        <td height="10" align="right"><span style="color: #0028E9">
          <input name="Submit" type="button" class="v1" onclick="window.location='ai_in.php'" value="回總管理" />
        </span></td>
      </tr>
      <tr>
        <td height="10"><hr></td>
      </tr>
      <tr>
        <td align="center">回填單 - 註冊 Account 1/2</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td><form id="form1" name="form1" method="post" action="open.php"><table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <td height="30" colspan="5" align="center" bgcolor="<?php if ($_GET['err'] != "") {echo "#FF0000";}?>" class="v1"><?php echo $_GET['err'];?></td>
          </tr>
          <tr>
            <td width="18%">&nbsp;</td>
            <td width="19%" height="30" align="right">推薦人 ID</td>
            <td><table width="200" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="30"><input name="fcard" type="text" autocomplete="off" class="v1" id="fcard" value="<?php if ($_GET['fcd'] == "") {echo $row_Recb['card'];} else {echo $_GET['fcd'];}?>" size="15" />
*</td>
              </tr>
            </table></td>
            <td colspan="2"><?php $x1card=$_GET['fcd'];mysql_select_db($database_kg, $kg);//echo $x1card;
    $query_Recx1 = sprintf("SELECT * FROM memberdata WHERE card='$x1card'");
    $Recx1 = mysql_query($query_Recx1, $kg) or die(mysql_error());
    $row_Recx1 = mysql_fetch_assoc($Recx1);
    $totalRows_Recx1 = mysql_num_rows($Recx1);echo $row_Recx1['m_nick'];?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td height="30" align="right">安置人 ID</td>
            <td><input name="gcard" type="text" autocomplete="off" class="v1" id="gcard" value="<?php if ($_GET['gcard'] == "") {echo $row_Recb['card'];} else {echo $_GET['gcard'];}?>" size="15" />
              *</td>
            <td><?php $x2card=$_GET['gcard'];mysql_select_db($database_kg, $kg);
    $query_Recx2 = sprintf("SELECT * FROM memberdata WHERE card='$x2card'");
    $Recx2 = mysql_query($query_Recx2, $kg) or die(mysql_error());
    $row_Recx2 = mysql_fetch_assoc($Recx2);
    $totalRows_Recx2 = mysql_num_rows($Recx2);echo $row_Recx2['m_nick'];?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td height="30" align="right">方位</td>
            <td><select name="gtow" class="v3" id="gtow">
              <?php if ($_GET['gi'] == "" && $_GET['gtow'] == "") {?>
              <option value="L" selected="selected">左</option>
              <option value="R">右</option>
              <?php } else {?>
              <option value="<?php if ($_GET['gtow'] == "") {echo $w;} else {echo $_GET['gtow'];$w=$_GET['gtow'];}?>">
                <?php switch ($w) {case'L':echo "左";break;case'R':echo "右";break;}?>
                </option>
              <?php }?>
            </select>
              *</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td height="30" align="right">选择产品</td>
            <td colspan="3"><select name="pudid" class="v3" id="pudid">
              <?php if ($_GET['pudid'] == "") {do {?>
              <option value="<?php echo $row_Reca['id'];?>" selected="<?php if ($row_Reca['p'] == 1000) {echo "selected";}?>"><?php echo $row_Reca['name'];?></option>
              <?php } while ($row_Reca = mysql_fetch_assoc($Reca));} else {?>
              <option value="<?php echo $_GET['pudid'];?>">
                <?php $pi=$_GET['pudid'];mysql_select_db($database_kg, $kg);
$query_Reca2 = sprintf("SELECT * FROM a_pud WHERE id=$pi");
$Reca2 = mysql_query($query_Reca2, $kg) or die(mysql_error());
$row_Reca2 = mysql_fetch_assoc($Reca2);echo $row_Reca2['name'];?>
                </option>
              <?php }?>
            </select>
              *</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td height="30" align="right">&nbsp;</td>
            <td width="15%"><span style="color: #0028E9"><span style="font-size: 10px">*请输入验证码<br />
              </span>
              <input name="sum2" type="text" autocomplete="off" class="v1" id="sum2" onfocus="MM_setTextOfTextfield('sum2','','')" size="15" />
              </span></td>
            <td width="13%"><span style="color: #0028E9"> </span>
              <table width="170" border="1"  cellpadding="0" cellspacing="0" bordercolor="#0028E9">
                <tr>
                  <td width="63" height="35" align="center" style="color: #fff; font-size: 25px;" background="../eng/images/7-1.JPG"><?php echo $sum;?></td>
                  </tr>
                </table></td>
            <td width="35%"><span style="color: #0028E9">
              <input name="Submit4" type="button" class="v1" onclick="window.location='account.php'" value="刷新验证码" />
              </span></td>
          </tr>
          <tr>
            <td colspan="5"><hr /></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td><span style="color: #FEDB4D">
              <input name="see2" type="hidden" id="see2" value="<?php echo $sum;?>" />
            </span></td>
            <td><input name="button" type="submit" class="v1" id="button" value=" 下一步 " /></td>
            <td colspan="2"><span style="color: #0028E9">
              <input name="Submit2" type="button" class="v11" onclick="window.location='mem_main.php'" value=" 查询會員 " />
            </span></td>
          </tr>
        </table></form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>