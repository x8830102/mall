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
//
$newnr=$_GET['newid'];$fdcard=$_SESSION['fdcard'];
mysql_select_db($database_sc, $sc);
$query_Reccd = sprintf("SELECT * FROM memberdata WHERE number = '$newnr' && m_ok=1");
$Reccd = mysql_query($query_Reccd, $sc) or die(mysql_error());
$row_Reccd = mysql_fetch_assoc($Reccd);
$totalRows_Reccd = mysql_num_rows($Reccd);
$apudid=$row_Reccd['a_pud'];
$mfus=$row_Reccd['m_fuser'];
//
mysql_select_db($database_sc, $sc);
$query_Reccdf = sprintf("SELECT * FROM memberdata WHERE number = '$mfus'");
$Reccdf = mysql_query($query_Reccdf, $sc) or die(mysql_error());
$row_Reccdf = mysql_fetch_assoc($Reccdf);
$totalRows_Reccdf = mysql_num_rows($Reccdf);
$mfna=$row_Reccdf['m_username'];
//
mysql_select_db($database_sc, $sc);
$query_Reca = sprintf("SELECT * FROM a_pud WHERE id=$apudid");// ORDER BY id DESC
$Reca = mysql_query($query_Reca, $sc) or die(mysql_error());
$row_Reca = mysql_fetch_assoc($Reca);
$totalRows_Reca = mysql_num_rows($Reca);
//
if ($apudid < 6) {$sqlfd="fd";}if ($apudid >= 6) {$sqlfd="fd2";}
mysql_select_db($database_sc, $sc);
    $query_Recb = sprintf("SELECT * FROM $sqlfd WHERE number='$newnr' ORDER BY id");
    $Recb = mysql_query($query_Recb, $sc) or die(mysql_error());
    $row_Recb = mysql_fetch_assoc($Recb);
    $totalRows_Recb = mysql_num_rows($Recb);
///////////////////
$fus=$_SESSION['gfus'];
mysql_select_db($database_sc, $sc);
$query_Recsnf = sprintf("SELECT * FROM memberdata WHERE number = '$fus'");//
$Recsnf = mysql_query($query_Recsnf, $sc) or die(mysql_error());
$row_Recsnf = mysql_fetch_assoc($Recsnf);
$totalRows_Recsnf = mysql_num_rows($Recsnf);
$fusername=$row_Recsnf['m_username'];
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
<?php require_once('adx.php');require_once('phone.php');require_once('desktop.php'); ?>
    <!--↓↓↓↓↓↓↓↓↓↓

                     content

                                    ↓↓↓↓↓↓↓↓↓↓↓-->
<div class="cut-navbar col-lg-7 col-md-7 col-sm-7 col-xs-11  col-lg-offset-2">
    <ul class="cut-page">
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line_active">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >系統註冊</span></a></li>
                <li></li>
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
                <li class="cust-but"><a href="fan_management_1.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>粉絲管理</span></a></li>
                <li></li>
            </ul>
        </li>
    </ul>
    <div class="menu col-lg-11 col-xs-11" align="center">
  <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">註冊新帳戶</div>
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr>
                        <td colspan="2" class="oder-suce">註冊新單作業完成</td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">使用者名</td>
                        <td>
                            <span><?php echo $row_Reccd['m_nick'];?></span>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>登入帳號</span></td>
                        <td><span><?php echo $row_Reccd['m_username'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>E-mail</span></td>
                        <td><span><?php echo $row_Reccd['m_email'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>商品名稱</span></td>
                        <td><span><?php echo $row_Reca['name'];?>,年費：<?php echo $row_Reca['p'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>完成註冊時間</span></td>
                        <td><span><?php echo $row_Reccd['date'],"  ",$row_Reccd['time'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>福袋編號</span></td>
                        <td><span><?php if ($totalRows_Recb == 0) {echo "無";} else {echo $row_Recb['card'];}?></span></td>
                    </tr>
                    <tr style="text-align: center;">
                        <td colspan="2">
                            <?php if ($apudid > 2) {if ($apudid >= 6) {?><input name="Submit4" type="button" class="menu-but" onclick="myFunction3()" value=" 查看寶物位置 " /><? } else {echo "請登出，福袋區「登入」查看";}}?>
                            
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr style="text-align: center;">
                      <td colspan="2"  class="menu-tr"><button onclick="myFunction()">馬上設定自己的網站</button>

<script>
function myFunction() {
    window.open("http://lifelink.com.tw/wp-signup.php?un=<?php echo $row_Reccd['m_username'];?>&em=<?php echo $row_Reccd['m_email'];?>&fn=<?php echo $mfna;?>");
}
function myFunction2() {
    window.open("http://<?php echo $mfna;?>.lifelink.cc/wp-signup.php?un=<?php echo $row_Reccd['m_username'];?>&em=<?php echo $row_Reccd['m_email'];?>&fn=<?php echo $mfna;?>");
}
function myFunction3() {
    window.open("http://cmg588.com/big_life/new_account-4.php?fd_c=<?php echo $row_Recb['card'];?>");
}
</script></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
 
    <!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
<?php ?>