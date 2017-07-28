<?php require_once('Connections/kg.php');mysql_query("set names utf8"); ?>
<?php
session_start();
if ($_SESSION['ceo'] == "") {header(sprintf("Location: index.php"));exit;}
$ceo=$_SESSION['ceo'];
mysql_select_db($database_kg, $kg);
$query_Reclu = sprintf("SELECT * FROM admin WHERE username = '$ceo' && at=1 && level >= 7");
$Reclu = mysql_query($query_Reclu, $kg) or die(mysql_error());
$row_Reclu = mysql_fetch_assoc($Reclu);
$totalRows_Reclu = mysql_num_rows($Reclu);
if ($totalRows_Reclu == 0) {header(sprintf("Location: index.php"));exit;}
//
mysql_select_db($database_kg, $kg);//$pu="";
$query_Recl = sprintf("SELECT * FROM admin WHERE level < 10  ORDER BY at DESC");//&& pu = '$pu'
$Recl = mysql_query($query_Recl, $kg) or die(mysql_error());
$row_Recl = mysql_fetch_assoc($Recl);
$totalRows_Recl = mysql_num_rows($Recl);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
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
.style2 {font-size: 16px; font-weight: bold; }
.style4 {	font-size: 18px;
	font-weight: bold;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
</style>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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
            <td><span class="style7"> <?php echo $row_Reclu['name'];?> 您好!</span> <span class="style8">&nbsp;&nbsp;&nbsp;登入帳號：<?php echo $row_Reclu['username'];?></span>&nbsp;&nbsp;【<a href="amss_pas.php">修改密碼</a>】</td>
            <td rowspan="2"><a href="ai_in.php"><img src="images/3.png" alt="回管理" title="回管理" width="50" height="53" border="0" /></a></td>
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
        <td colspan="2"><table width="300" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="50">&nbsp;</td>
            <td width="238">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="350" colspan="2" align="center" valign="top"><table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="819" align="center"><span class="style4">權限設定</span></td>
            <td colspan="2" align="center" class="style2"><a href="ceo_add.php">新增管理者</a></td>
          </tr>
          <tr>
            <td align="right">目前管理者共 </td>
            <td width="77" align="center"><?php echo $totalRows_Recl;?></td>
            <td width="74">位</td>
          </tr>
          <tr>
            <td colspan="3" align="center"><table width="900" border="1" cellspacing="3" cellpadding="0">
              <tr>
                <td width="156" align="center" bgcolor="#D4E5F3" class="style4">名稱</td>
                <td width="131" align="center" bgcolor="#D4E5F3" class="style4">聯絡電話</td>
                <td width="141" align="center" bgcolor="#D4E5F3" class="style4">帳號</td>
                <td width="139" align="center" bgcolor="#D4E5F3" class="style4">權限層級</td>
                <td width="91" align="center" bgcolor="#D4E5F3" class="style4">狀況</td>
                <td colspan="3" bgcolor="#D4E5F3">&nbsp;</td>
              </tr>
              <?php if ($totalRows_Recl != 0) {do { ?>
              <tr>
                <td align="center"><?php echo $row_Recl['name'];?></td>
                <td align="center"><?php echo $row_Recl['phone'];?></td>
                <td align="center"><?php echo $row_Recl['username'];?></td>
                <td align="center"><?php switch ($row_Recl['level']) {case '10':echo "董事長";break;case '9':echo "副總";break;case '8':echo "會計人員";break;case '7':echo "資訊人員";break;case '6':echo "直營店";break;case '5':echo "加盟單位";break;case '4':echo "一般行政";break;case '3':echo "窗口單位";break;}if ($row_Recl['level'] == 6) {?>
                  <a href="ceom_main.php?ui=<?php echo $row_Recl['username'];?>">[人員]</a><?php }?></td>
                <td align="center" <?php if ($row_Recl['at'] == 0) {echo "bgcolor='#FF66FF'";}?>><?php switch ($row_Recl['at']) {case '0':echo "禁止";break;case '1':echo "執行";break;}?></td>
                <td width="43" align="left"><a href="ceo_set.php?c=<?php echo $row_Recl['username'];?>">設定</a></td>
                <td width="74" align="left"><a href="ceo_repa.php?c=<?php echo $row_Recl['username'];?>">密碼重設</a></td>
                <td width="80" align="left"><a href="ceo_note.php?c=<?php echo $row_Recl['username'];?>">內容</a></td>
              </tr>
              <?php } while ($row_Recl = mysql_fetch_assoc($Recl)); } else {echo "目前無資訊 ! ! !";}?>
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