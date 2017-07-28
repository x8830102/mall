<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");require_once('Connections/sr.php');
/*session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;} else {$sn=$_SESSION['number'];}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1 && a_pud < 6");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: login_mem.php"));exit;}
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];*/
//
$newnr=$_GET['newid'];//$vfdcard=$_SESSION['fdcard'];
mysql_select_db($database_sc, $sc);
$query_Reccd = sprintf("SELECT * FROM memberdata WHERE number = '$newnr' && m_ok=1");
$Reccd = mysql_query($query_Reccd, $sc) or die(mysql_error());
$row_Reccd = mysql_fetch_assoc($Reccd);
$totalRows_Reccd = mysql_num_rows($Reccd);
$apudid=$row_Reccd['a_pud'];
$mfus=$row_Reccd['m_fuser'];
$sr_user=$row_Reccd['m_username'];
//
mysql_select_db($database_sc, $sc);
$query_Reccdf = sprintf("SELECT * FROM memberdata WHERE number = '$mfus'");
$Reccdf = mysql_query($query_Reccdf, $sc) or die(mysql_error());
$row_Reccdf = mysql_fetch_assoc($Reccdf);
$totalRows_Reccdf = mysql_num_rows($Reccdf);
$mfna=$row_Reccdf['m_username'];//echo $mfna;
//
mysql_select_db($database_sc, $sc);
$query_Reca = sprintf("SELECT * FROM a_pud WHERE id='$apudid'");// ORDER BY id DESC
$Reca = mysql_query($query_Reca, $sc) or die(mysql_error());
$row_Reca = mysql_fetch_assoc($Reca);
$totalRows_Reca = mysql_num_rows($Reca);
//
if ($apudid <= 7) {$sqlfd="fd";}if ($apudid >= 8) {$sqlfd="fd2";}
mysql_select_db($database_sc, $sc);
    $query_Recb = sprintf("SELECT * FROM $sqlfd WHERE number='$newnr' ORDER BY id");
    $Recb = mysql_query($query_Recb, $sc) or die(mysql_error());
    $row_Recb = mysql_fetch_assoc($Recb);
    $totalRows_Recb = mysql_num_rows($Recb);
///////////////////
/*
$fus=$_SESSION['gfus'];
mysql_select_db($database_sc, $sc);
$query_Recsnf = sprintf("SELECT * FROM memberdata WHERE number = '$fus'");//
$Recsnf = mysql_query($query_Recsnf, $sc) or die(mysql_error());
$row_Recsnf = mysql_fetch_assoc($Recsnf);
$totalRows_Recsnf = mysql_num_rows($Recsnf);
$fusername=$row_Recsnf['m_username'];
*/
mysql_select_db($database_sr, $sr);
$query_Recsr = sprintf("SELECT * FROM wp_users WHERE user_login='$sr_user'");// ORDER BY id DESC
$Recsr = mysql_query($query_Recsr, $sr) or die(mysql_error());
$row_Recsr = mysql_fetch_assoc($Recsr);
$totalRows_Recsr = mysql_num_rows($Recsr);
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>串門子雲端事業</title><meta http-equiv="refresh" content="60">

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
<?php require_once('adx.php');//require_once('phone.php');require_once('desktop.php'); ?>
 <div class="top-bar visible-xs">
        <div class="top_img col-lg-3 col-md-3 col-sm-4 col-xs-12" align="center">
            <a href="index.php"><img src="img/life-link_logo.png" width="230px" alt="串門子雲端"></a>
        </div>
    </div>
    <!--↓↓↓↓↓↓↓↓↓↓

                     content

                                    ↓↓↓↓↓↓↓↓↓↓↓-->
<div class="cut-navbar col-lg-7 col-md-7 col-sm-7 col-xs-11 col-lg-offset-2 col-sm-offset-1" style="top: 0px">
    <ul class="cut-page">
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line_active">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >註冊會員</span></a></li>
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
                <li class="cust-but"><a href="fan_management_2.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>會員管理</span></a></li>
                <li></li>
            </ul>
        </li>
    </ul>
    <div class="menu col-lg-11 col-xs-11" align="center">
  <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">註冊新會員</div>
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr>
                        <td colspan="2" class="oder-suce">註冊新單作業完成</td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">使用者名</td>
                        <td  class="menu-td">
                            <span><?php echo $row_Reccd['m_nick'];?></span>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>登入帳號</span></td>
                        <td  class="menu-td"><span><?php echo $row_Reccd['m_username'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>E-mail</span></td>
                        <td  class="menu-td"><span><?php echo $row_Reccd['m_email'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>商品名稱</span></td>
                        <td  class="menu-td"><span><?php echo $row_Reca['name'];?>-<?php echo $row_Reca['p'];?>/年費</span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>完成註冊時間</span></td>
                        <td  class="menu-td"><span><?php echo $row_Reccd['date'],"  ",$row_Reccd['time'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>發票開立</span></td>
                        <td  class="menu-td"><span><?php switch ($row_Reccd['as_at']) {case'1':echo "捐贈";break;case'2':echo "二聯";break;case'3':echo "三聯";break;};?></span></td>
                    </tr>
                    <?php if ($row_Reccd['as_at'] == 3) {?>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>統一編號</span></td>
                        <td  class="menu-td"><span><?php echo $row_Reccd["as_number"];?></span></td>
                    </tr>
                   <tr class="menu-tr">
                        <td class="menu-td"><span>公司名稱</span></td>
                        <td  class="menu-td"><span><?php echo $row_Reccd["as_name"];?></span></td>
                    </tr>
                    <? }?>

                    <tr class="menu-tr">
                        <td class="menu-td"><span>福袋編號</span></td>
                        <td  class="menu-td"><span><?php if ($totalRows_Recb == 0) {echo "無";} else {echo $row_Recb['card'];}?></span></td>
                    </tr>
                    
                    <?php 
					$kk2="http://lifelink.com.tw/BtoC-signup.php";$kk="http://".$mfna.".lifelink.cc/Cup-signup.php";
					if ($apudid == 2) {$aul=$kk;}if ($apudid == 3) {$aul=$kk;}if ($apudid == 4 || $apudid == 0) {$aul=$kk2;}if ($apudid == 5 || $apudid == 7) {$aul=$kk2;}?>
                    <tr style="text-align: center;"><?php //if ($apudid >= 3) {echo "myFunction()";}if ($apudid == 2) {echo "myFunction2()";}?>
                      <td colspan="2"  class="menu-tr"><?php //if ($totalRows_Recsr == 0) {?>
                        <form action="<? echo $aul;?>" method="post" name="form1" target="_blank" id="form1">
                          <input name="fname" type="hidden" id="fname" value="<?php echo $mfna;?>">
						  <input name="fn" type="hidden" id="fn" value="<?php echo $mfna;?>">
                          <input name="n_email" type="hidden" id="n_email" value="<?php echo $row_Reccd['m_email'];?>">
                          <input name="n_name" type="hidden" id="n_name" value="<?php echo $row_Reccd['m_username'];?>">
                          <input type="submit" name="button" id="button" class="menu-but" value="馬上設定自己的網站">
                        
                        </form>
                        <!--<button class="menu-but" onclick="<? echo $aul;?>">馬上設定自己的網站</button><? //}?>-->

<script>
function myFunction() {
    window.open("http://lifelink.com.tw/BtoC-signup.php?un=<?php echo $row_Reccd['m_username'];?>&em=<?php echo $row_Reccd['m_email'];?>&fn=<?php echo $mfna;?>");
}
function myFunction2() {
    window.open("http://<?php echo $mfna;?>.lifelink.cc/Cup-signup.php?un=<?php echo $row_Reccd['m_username'];?>&em=<?php echo $row_Reccd['m_email'];?>&fn=<?php echo $mfna;?>");
}
function myFunction3() {
    window.open("http://cmg588.com/life_link/fdmap_d.php?fd_c=<?php echo $row_Recb['card'];?>&kp=2");
}
</script></td>
                    </tr>
                    <tr style="text-align: center;">
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr style="text-align: center;">
                        <td colspan="2">
                            <?php if ($totalRows_Recsr != 0) {if ($apudid == 5 || $apudid == 7) {?><input name="Submit4" type="button" class="menu-but" onclick="myFunction3()" value=" 查看福袋位置 " /><? }} else {echo "請馬上設定自己的網站，去完成所有作業流程";}?>
                            
                        </td>
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