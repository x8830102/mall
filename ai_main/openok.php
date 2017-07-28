<?php require_once('Connections/kg.php'); ?>
<?php 
session_start();

$newcard=$_GET['newcard'];
mysql_select_db($database_kg, $kg);
$query_Reca = sprintf("SELECT * FROM memberdata WHERE card='$newcard' && m_ok=1");// DESC
$Reca = mysql_query($query_Reca, $kg) or die(mysql_error());
$row_Reca = mysql_fetch_assoc($Reca);
$totalRows_Reca = mysql_num_rows($Reca);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
.v1 {	font-size:28px;
}
.v11 {font-size:22px;
        text-align:center;
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
        <td><table width="100%" border="0" cellspacing="15" cellpadding="0">
          <tr>
            <td colspan="3" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="top" bgcolor="#FFFFFF" class="v1">注册新单作业完成</td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="top" class="v1">*** 新 ID：<?php echo $row_Reca['card'];?> [ <?php echo $row_Reca['m_nick'];?> ] *** </td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="top" class="v1"><hr /></td>
          </tr>
          <tr>
            <td width="44%" align="right" valign="top" class="v1"><span style="color: #0028E9">
              <input name="Submit" type="button" class="v11" onclick="window.location='ai_in.php'" value="回總管理" />
            </span></td>
            <td width="9%" valign="top" class="v1"><span style="color: #0028E9">
              <input name="Submit2" type="button" class="v11" onclick="window.location='account.php'" value="空投註冊" />
            </span></td>
            <td width="47%" valign="top" class="v1"><span style="color: #0028E9">
              <input name="Submit3" type="button" class="v11" onclick="window.location='mem_main.php'" value="查看會員" />
            </span></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>