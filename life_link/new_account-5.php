<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
include('if_login.php');
$name=$row_Recsn['m_name'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$_SESSION['vf']=$_GET['vf'];
$a_pud=$row_Recsn['a_pud'];
//type
$type=$row_Recsn['a_pud'];
mysql_select_db($database_sc, $sc);
$query_Rect2 = sprintf("SELECT * FROM a_pud WHERE id = $a_pud");//
$Rect2 = mysql_query($query_Rect2, $sc) or die(mysql_error());
$row_Rect2 = mysql_fetch_assoc($Rect2);
$totalRows_Rect2 = mysql_num_rows($Rect2);
if ($row_Rect2['myfd'] == 0) {header(sprintf("Location: new_account-4.php?err=無換卡權限"));exit;}
//if ($a_pud < 3) {header(sprintf("Location: index.php"));exit;}
//

//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//
$fu=$_GET['fu'];$gu=$_GET['gu'];$w=$_GET['w'];$_SESSION['g_card']=$gu;
//fu
mysql_select_db($database_sc, $sc);
$assessment ="SELECT * FROM memberdata WHERE number ='$sn' and assessment=1";
$query_ass = mysql_query($assessment,$sc);
$num_ass = mysql_num_rows($query_ass);
if ($num_ass == 0) {header(sprintf("Location: new_account-4.php?err=權限不足"));exit;}

$query_Recfd = sprintf("SELECT * FROM fd WHERE card = '$fu'");
$Recfd = mysql_query($query_Recfd, $sc) or die(mysql_error());
$row_Recfd = mysql_fetch_assoc($Recfd);
$totalRows_Recfd = mysql_num_rows($Recfd);
if ($totalRows_Recfd == 0) {header(sprintf("Location: new_account-4.php?err=無根福袋"));exit;}
$fu_number=$row_Recfd['number'];
//gu
mysql_select_db($database_sc, $sc);
$query_Recfd2 = sprintf("SELECT * FROM fd WHERE card = '$gu'");
$Recfd2 = mysql_query($query_Recfd2, $sc) or die(mysql_error());
$row_Recfd2 = mysql_fetch_assoc($Recfd2);
$totalRows_Recfd2 = mysql_num_rows($Recfd2);
if ($totalRows_Recfd2 == 0) {header(sprintf("Location: new_account-4.php?err=無相鄰福袋"));exit;}
//w
mysql_select_db($database_sc, $sc);
$query_Recfd2 = sprintf("SELECT * FROM fd WHERE c_guser = '$gu' && gtow='$w'");
$Recfd2 = mysql_query($query_Recfd2, $sc) or die(mysql_error());
$row_Recfd2 = mysql_fetch_assoc($Recfd2);
$totalRows_Recfd2 = mysql_num_rows($Recfd2);
if ($totalRows_Recfd2 != 0) {header(sprintf("Location: new_account-4.php?err=福袋位已有"));exit;}
//lc
mysql_select_db($database_sc, $sc);
$query_Recol = sprintf("SELECT * FROM c_cash WHERE number = '$sn' ORDER BY id DESC");
$Recol = mysql_query($query_Recol, $sc) or die(mysql_error());
$row_Recol = mysql_fetch_assoc($Recol);
$totalRows_Recol = mysql_num_rows($Recol);
if ($row_Recol['csum'] < 30000) {header(sprintf("Location: new_account-4.php?err=福袋扣值串串積分不足"));exit;}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>串門子雲端事業</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <link rel="icon" href="img/life_link.jpg" type="image/x-icon" />
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
            <li> <a href="new_account-1.php"><span>註冊新帳戶</span></a> </li>
            <li  class="active"> <a href="new_account-4.php"><span>福袋兌換</span></a></li>
              
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">福袋兌換</div>
            <form id="form1" name="form1" method="post" action="x_form_fd.php"><table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 60px auto 30px ">
                <tbody>
                    <tr>
                        <td colspan="2" class="ann-t">
                            <div style="line-height: 1px; color: red">★限本登入帳戶福袋兌換</div>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td ><span>目前串串積分</span></td>
                        <td><span style="color: red;"><?php echo number_format($row_Recol['csum'], 0, '.' ,',');?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td><span>兌換福袋積分</span></td>
                        <td><span >30,000<!--<br>與寶物 <?php //echo $gu;?> 相鄰<br/>寶物根 <?php //echo $fu;?></span>--></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">二級密碼</td>
                        <td>
                            <input name="m_passtoo" type="password" id="m_passtoo" size="12" placeholder="請輸入二級密碼">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">驗證碼</td>
                        <td>
                            <input name="sum" type="text" id="sum" style="min-width: 90px;" size="12" placeholder="請輸入驗證碼">
                            <span style="padding: 2px; border: 1px solid #000"><?php echo $sum;?></span>
                            <!--<a href="new_account-5.php"><img width="21px" src="img/refresh.png" alt="" style="margin-left: 3px"></a>-->
                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="2">
                            <input type="submit" name="button" id="button" class="menu-but"  value="確認">
                            <input name="Submit4" type="button" class="menu-but" onclick="window.location='new_account-4.php?fd_c=<?php echo $_GET['gu'];?>'" value=" 取消 " />
                        </td>
                    </tr>
                    <tr class="menu-tr" align="center">
                      <td colspan="2"><span style="color: #F00"><span class="style3" style="margin:0px; font-size: 18px; font-weight: bold;">
                        <input type="hidden" name="MM_insert" value="form1" />
                        <input name="see" type="hidden" id="see" value="<?php echo $sum;?>" />
                        <input name="fu" type="hidden" id="fu" value="<?php echo $fu;?>" />
                        <input name="gu" type="hidden" id="gu" value="<?php echo $gu;?>" />
                        <input name="w" type="hidden" id="w" value="<?php echo $w;?>" />
                        <input name="number" type="hidden" id="number" value="<?php echo $sn;?>" />
                        <input name="fdname" type="hidden" id="fdname" value="<?php echo $nick;?>" />
						<input name="filling_position" type="hidden" id="filling_position" value="<?php echo $_GET['position'];?>" />
                        <input name="mfu" type="hidden" id="mfu" value="<?php echo $row_Recsn['m_fuser'];?>" />
                      <?php echo $_GET['err'];?></span></td>
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
