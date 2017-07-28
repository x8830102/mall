<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;} else {$sn=$_SESSION['number'];}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1 && a_pud >= 6");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: login_mem.php"));exit;}
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
$sim=$HTTP_POST_VARS['sim'];
///////////////
	if ($_POST['see'] == $_POST['sum']) {
	$fdname=$HTTP_POST_VARS['fdname'];$fu=$HTTP_POST_VARS['fu'];$gu=$HTTP_POST_VARS['gu'];$w=$HTTP_POST_VARS['w'];$number=$HTTP_POST_VARS['number'];$m_passtoo=$HTTP_POST_VARS['m_passtoo'];$pudp=178800;
	$date=date("Y-m-d");$time=date("H:i:s");$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$mfu=$HTTP_POST_VARS['mfu'];
		mysql_select_db($database_sc, $sc);
$query_Recfg = sprintf("SELECT * FROM memberdata WHERE number='$number'");
$Recfg = mysql_query($query_Recfg, $sc) or die(mysql_error());
$row_Recfg = mysql_fetch_assoc($Recfg);
$totalRows_Recfg = mysql_num_rows($Recfg);
		$my_fuser=$row_Recfg['m_fuser'];
		$apud=$row_Recfg['a_pud'];
		mysql_select_db($database_sc, $sc);
    $query_Recapud = sprintf("SELECT * FROM a_pud WHERE id=$apud");// 
    $Recapud = mysql_query($query_Recapud, $sc) or die(mysql_error());
    $row_Recapud = mysql_fetch_assoc($Recapud);
	$totalRows_Recapud = mysql_num_rows($Recapud);
	$my_fpay=$row_Recapud['my_fpay'];
	$my_p=$row_Recapud['my_p'];
	$apud_b=$row_Recapud['b'];
	//-ocash
	mysql_select_db($database_sc, $sc);//echo $sn,"!!";exit;
    $query_Recob = sprintf("SELECT * FROM c_cash WHERE number='$number' ORDER BY id DESC");// 
    $Recob = mysql_query($query_Recob, $sc) or die(mysql_error());
    $row_Recob = mysql_fetch_assoc($Recob);
	$totalRows_Recob = mysql_num_rows($Recob);//echo $row_Recob['csum'],"@@";exit;
	if ($row_Recob['csum'] >= $my_p) {
		
	} else {header(sprintf("Location: new_account-4.php?err=串串積分不足178800"));exit;}
	} else {header(sprintf("Location: new_account-4.php?err=檢查碼不符"));exit;}
//}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>串門子雲端事業</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="jasny-bootstrap/css/jasny-bootstrap.css">
    <link rel="stylesheet" type="text/css" href="icomoon/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="js/map.js"></script>
    <style type="text/css">
        body{
            font-family:"verdana","微軟正黑體" ; font-weight:400;
        }
    </style>
</head>

<body>
 <?php require_once('adx.php'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="50" align="center"><br>
    啟 動 系 統 註 冊<br>
    <br></td>
  </tr>
  <tr>
    <td align="center"><form action="http://biglife.laiwii.com/x_g_p_fd.php" method="post" name="form1" id="form1">
        <input name="sn" type="hidden" id="sn" value="<?php echo $sn;?>">
        <input name="fdname" type="hidden" id="fdname" value="<?php echo $fdname;?>">
        <input name="fu" type="hidden" id="fu" value="<?php echo $fu;?>">
        <input name="gu" type="hidden" id="gu" value="<?php echo $gu;?>">
        <input name="w" type="hidden" id="w" value="<?php echo $w;?>">
        <input name="number" type="hidden" id="number" value="<?php echo $number;?>">
        <input name="m_passtoo" type="hidden" id="m_passtoo" value="<?php echo $m_passtoo;?>">
        <input name="pudp" type="hidden" id="pudp" value="<?php echo $pudp;?>">
        
      <table width="200" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><input type="submit" name="button" id="button" value=" 確定 "></td>
          <td align="center"><a href="index.php">取消</a></td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p></td>
  </tr>
</table>

</body>
</html>