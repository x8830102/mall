<?php require_once('Connections/kg.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
$mem_number=$_GET['n'];
mysql_select_db($database_kg, $kg);
$query_Recmem = sprintf("SELECT * FROM memberdata WHERE number = '$mem_number' && m_ok=1");
$Recmem = mysql_query($query_Recmem, $kg) or die(mysql_error());
$row_Recmem = mysql_fetch_assoc($Recmem);
$totalRows_Recmem = mysql_num_rows($Recmem);
/*
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
$now_datetime=date("Y/m/d H:i:s");$sys_datetime=date("Y-m-d H:i:s");$admin="sys";$sysnote="登入後台管理";
mysql_select_db($database_kg, $kg);
$insertCommand3="INSERT INTO main_ip (ip, admin, datetime, note, name, nick, number, card) VALUES ('$ip', '$admin', '$sys_datetime', '$sysnote', '$name', '$nick', '$mem_number', '$card')"; 
mysql_query($insertCommand3,$kg);
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
}*/
//in-ip
mysql_select_db($database_kg, $kg);$ipnote="登入後台管理";
$query_Recip = sprintf("SELECT * FROM main_ip WHERE number = '$mem_number' && note='$ipnote' ORDER BY id DESC");
$Recip = mysql_query($query_Recip, $kg) or die(mysql_error());
$row_Recip = mysql_fetch_assoc($Recip);
$totalRows_Recip = mysql_num_rows($Recip);
//fm-直推數
mysql_select_db($database_kg, $kg);
$query_Recfm = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$mem_number' && m_ok=1");
$Recfm = mysql_query($query_Recfm, $kg) or die(mysql_error());
$row_Recfm = mysql_fetch_assoc($Recfm);
$totalRows_Recfm = mysql_num_rows($Recfm);
//7p-yes
$p_total=0;
mysql_select_db($database_kg, $kg);
$query_Recg = sprintf("SELECT * FROM memberdata WHERE m_guser = '$mem_number' && m_ok=1");
$Recg = mysql_query($query_Recg, $kg) or die(mysql_error());
$row_Recg = mysql_fetch_assoc($Recg);
$totalRows_Recg = mysql_num_rows($Recg);
if ($totalRows_Recg != 0) {$p_total=$p_total+$totalRows_Recg;
	do {$gusa=$row_Recg['number'];
	mysql_select_db($database_kg, $kg);
    $query_Recg2 = sprintf("SELECT * FROM memberdata WHERE m_guser = '$gusa' && m_ok=1");
    $Recg2 = mysql_query($query_Recg2, $kg) or die(mysql_error());
    $row_Recg2 = mysql_fetch_assoc($Recg2);
    $totalRows_Recg2 = mysql_num_rows($Recg2);
	if ($totalRows_Recg2 != 0) {$p_total=$p_total+$totalRows_Recg2;}
	} while ($row_Recg = mysql_fetch_assoc($Recg));
	}

//allsum-po[x]
$a=0;unset($pus);$pus[0]="";$pa=0;$pb=0;$pkus=$mem_number;$a_total=0;
while ($a != 1) {
      mysql_select_db($database_kg, $kg);
      $query_Recp = sprintf("SELECT * FROM memberdata WHERE gus = '$pkus'");
      $Recp = mysql_query($query_Recp, $kg) or die(mysql_error());
      $row_Recp = mysql_fetch_assoc($Recp);
      $tp = mysql_num_rows($Recp);$i=0;
	  do {$dd=$row_Recp['number'];
		if (in_array($dd,$pus) == false) {$pus[$pa]=$dd;$pa++;} 
	  } while ($row_Recp = mysql_fetch_assoc($Recp));
	  if ($pus[$pb] != "") {$pkus=$pus[$pb];$pb++;} else {$a=1;}
}
$a_total=count($pus);
//oc-开 户 积 分
mysql_select_db($database_kg, $kg);
$query_Recoc = sprintf("SELECT * FROM o_cash WHERE number = '$mem_number' ORDER BY id DESC");
$Recoc = mysql_query($query_Recoc, $kg) or die(mysql_error());
$row_Recoc = mysql_fetch_assoc($Recoc);
$totalRows_Recoc = mysql_num_rows($Recoc);
//cc-總 积 分
mysql_select_db($database_kg, $kg);
$query_Reccc = sprintf("SELECT * FROM c_cash WHERE number = '$mem_number' ORDER BY id DESC");
$Reccc = mysql_query($query_Reccc, $kg) or die(mysql_error());
$row_Reccc = mysql_fetch_assoc($Reccc);
$totalRows_Reccc = mysql_num_rows($Reccc);
//gc-電子錢包
mysql_select_db($database_kg, $kg);
$query_Recgc = sprintf("SELECT * FROM g_cash WHERE number = '$mem_number' ORDER BY id DESC");
$Recgc = mysql_query($query_Recgc, $kg) or die(mysql_error());
$row_Recgc = mysql_fetch_assoc($Recgc);
$totalRows_Recgc = mysql_num_rows($Recgc);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Finemetal AG</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	font-size:12px;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
.h1 {
	color:#F90;
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

<body onload="MM_preloadImages('images/b6-1.png','images/b9-1.png')">
<table width="360" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1000" valign="top" bgcolor="#333333"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><img src="../cht/top/CFD-LOGO80.gif" height="80" border="0" /></td>
      </tr>
      <tr>
        <td height="35" align="center" bgcolor="#FF9900">登入时间 : <?php echo $row_Recip['datetime'];?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="15" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="../cht/images/5-3.png" width="329" height="35" border="0" /></td>
              </tr>
              <tr>
                <td height="15" bgcolor="#FFFFFF"><hr width="90%" class="h1"></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50%">ID 帐号 : </td>
                    <td width="50%" align="right"><?php echo $row_Recmem['card'];?> / <?php echo $row_Recmem['m_nick'];?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="15" bgcolor="#FFFFFF"><hr width="90%" class="h1"/></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50%">注册日期 : </td>
                    <td width="50%" align="right"><?php echo $row_Recmem['m_joinDate'];?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="15" bgcolor="#FFFFFF"><hr width="90%" class="h1"/></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50%">昵称 : </td>
                    <td width="50%" align="right"><?php echo $row_Recmem['m_nick'];?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="15" bgcolor="#FFFFFF"><hr width="90%" class="h1"/></td>
              </tr>
              <tr>
                <td height="15" bgcolor="#FFFFFF"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50%">总积分 : </td>
                    <td width="50%" align="right"><?php echo $row_Reccc['csum']+0;?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="15" bgcolor="#FFFFFF"><hr width="90%" class="h1"/></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50%">开户积分 : </td>
                    <td width="50%" align="right"><?php echo $row_Recoc['csum']+0;?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="15" bgcolor="#FFFFFF"><hr width="90%" class="h1"/></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50%">贵金属分 : </td>
                    <td width="50%" align="right"><?php echo $row_Recgc['csum']+0;?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="15" bgcolor="#FFFFFF"><hr width="90%" class="h1"/></td>
              </tr>
              <tr>
                <td height="10" bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
              <tr>
                <td height="35" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
                  <tr>
                    <td width="11%" align="center"><img src="../cht/images/5-5.png" width="20" height="26" border="0" /></td>
                    <td width="28%">直推 : (<?php echo $totalRows_Recfm;?>)</td>
                    <td width="61%" align="right"><table width="160" border="1" cellspacing="0" cellpadding="0" bordercolor="#000">
                      <tr>
                        <td bgcolor="#CCCCCC" background="../cht/images/5-8.png"><img src="../cht/images/vf.png" width="<?php if ($totalRows_Recfm > 2) {$tfm=2;} else {$tfm=$totalRows_Recfm;};echo $tfm/2*160;?>" height="18" /></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><img src="../cht/mempic/m19-1.png" height="26" /></td>
                    <td>總人數：</td>
                    <td align="right"><?php echo $a_total;?></td>
                  </tr>
                  <tr>
                    <td><img src="../cht/images/5-6.png" width="30" height="27" border="0" /></td>
                    <td>进度 :</td>
                    <td align="right"><?php echo $p_total;?> / 6</td>
                  </tr>
                  <tr>
                    <td valign="top"><img src="../cht/images/5-7.png" width="27" height="30" border="0" /><br />
                      局 数:</td>
                    <td colspan="2" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="55%" align="right">1000Plan ( <?php echo $row_Recmem['rat'];?> )</td>
                        <td width="45%"><table width="180" border="1" cellspacing="0" cellpadding="0" bordercolor="#CC33CC">
                          <tr>
                            <td width="60" height="20" align="center" valign="middle"><?php if ($row_Recmem['prd'] >= 1) {?>
                              <img src="../cht/images/5-9.png" width="24" height="18" border="0" />
                              <?php }?></td>
                            <td width="60" align="center" valign="middle" bgcolor="#FFFF66"><?php if ($row_Recmem['prd'] >= 2) {?>
                              <img src="../cht/images/5-9.png" width="24" height="18" border="0" />
                              <?php }?></td>
                            <td width="60" align="center" valign="middle" bgcolor="#FF9900"><?php if ($row_Recmem['prd'] >= 3) {?>
                              <img src="../cht/images/5-9.png" width="24" height="18" border="0" />
                              <?php }?></td>
                            </tr>
                          </table></td>
                        </tr>
                      <!--<tr>
                        <td align="right">5000Plan ( <?php //echo $row_Recmem['rat2'];?> )</td>
                        <td><table width="180" border="1" cellspacing="0" cellpadding="0" bordercolor="#CC33CC">
                          <tr>
                            <td width="60" height="20" align="center" valign="middle"><?php //if ($row_Recmem['prd2'] >= 1) {?>
                              <img src="images/5-9.png" width="24" height="18" border="0" />
                              <?php //}?></td>
                            <td width="60" align="center" valign="middle" bgcolor="#FFFF66"><?php //if ($row_Recmem['prd2'] >= 2) {?>
                              <img src="images/5-9.png" width="24" height="18" border="0" />
                              <?php //}?></td>
                            <td width="60" align="center" valign="middle" bgcolor="#FF9900"><?php //if ($row_Recmem['prd2'] >= 3) {?>
                              <img src="images/5-9.png" width="24" height="18" border="0" />
                              <?php //}?></td>
                            </tr>
                          </table></td>
                        </tr>
                      <tr>
                        <td align="right">10000Plan ( <?php echo $row_Recmem['rat3'];?> )</td>
                        <td><table width="180" border="1" cellspacing="0" cellpadding="0" bordercolor="#CC33CC">
                          <tr>
                            <td width="60" height="20" align="center" valign="middle"><?php if ($row_Recmem['prd3'] >= 1) {?>
                              <img src="images/5-9.png" width="24" height="18" border="0" />
                              <?php }?></td>
                            <td width="60" align="center" valign="middle" bgcolor="#FFFF66"><?php if ($row_Recmem['prd3'] >= 2) {?>
                              <img src="images/5-9.png" width="24" height="18" border="0" />
                              <?php }?></td>
                            <td width="60" align="center" valign="middle" bgcolor="#FF9900"><?php if ($row_Recmem['prd3'] >= 3) {?>
                              <img src="images/5-9.png" width="24" height="18" border="0" />
                              <?php }?></td>
                            </tr>
                          </table></td>
                        </tr>-->
                    </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="10" bgcolor="#FFFFFF"><hr width="90%" class="h1"/></td>
              </tr>
              <tr>
                <td height="35" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td width="3%"><img src="../cht/mempic/t2.png" height="35" border="0" /></td>
                    <td width="61%">首月，同日同一人名下購買七張新單，送2克賀利氏鑄造9999.9 金幣一枚，名額不限。</td>
                    <td width="36%" align="right"><?php mysql_select_db($database_kg, $kg);
        $query_Reck1 = sprintf("SELECT * FROM 7m WHERE callphone = '$m_callphone' && gv=1");
        $Reck1 = mysql_query($query_Reck1, $kg) or die(mysql_error());
        $row_Reck1 = mysql_fetch_assoc($Reck1);
        $totalRows_Reck1 = mysql_num_rows($Reck1);
		if ($totalRows_Reck1 == 0) {echo "目前未得奖!!!";} else {echo "恭喜您中奖,",$totalRows_Reck1,"枚";}?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="10" bgcolor="#FFFFFF"><hr width="90%" class="h1"/></td>
              </tr>
              <tr>
                <td height="35" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td width="3%"><img src="../cht/mempic/t2.png" height="35" border="0" /></td>
                    <td width="61%">首月，同一星期內直推三個人，送1克賀利氏鑄造9999.9 金幣一枚。名額為首 888 枚。</td>
                    <td width="36%" align="right"><?php mysql_select_db($database_kg, $kg);
        $query_Reck2 = sprintf("SELECT * FROM 7m WHERE callphone = '$m_callphone' && gv=1");
        $Reck2 = mysql_query($query_Reck2, $kg) or die(mysql_error());
        $row_Reck2 = mysql_fetch_assoc($Reck2);
        $totalRows_Reck2 = mysql_num_rows($Reck2);
		if ($totalRows_Reck2 == 0) {echo "目前未得奖!!!";} else {echo "恭喜您中奖, ",$totalRows_Reck2,"枚";}?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="../cht/images/5-4.png" width="329" height="35" border="0" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>