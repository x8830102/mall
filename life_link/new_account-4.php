<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
include('if_login.php');
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
if ($a_pud < 4) {header(sprintf("Location: index.php"));exit;}
//xf
mysql_select_db($database_sc, $sc);
$query_Recxf = sprintf("SELECT * FROM fd_take WHERE number = '$sn' && at=0 ORDER BY id");// DESC
$Recxf = mysql_query($query_Recxf, $sc) or die(mysql_error());
$row_Recxf = mysql_fetch_assoc($Recxf);
$totalRows_Recxf = mysql_num_rows($Recxf);
//fd
mysql_select_db($database_sc, $sc);
$query_Recfd = sprintf("SELECT * FROM fd WHERE number = '$sn' ORDER BY id");// DESC
$Recfd = mysql_query($query_Recfd, $sc) or die(mysql_error());
$row_Recfd = mysql_fetch_assoc($Recfd);
$totalRows_Recfd = mysql_num_rows($Recfd);//echo $totalRows_Recfd;exit;
$fd_c=$row_Recfd['card'];
//$o_position = $row_Recfd['filling_position'];
//
mysql_select_db($database_sc, $sc);
$query_Reccd3 = sprintf("SELECT * FROM fd WHERE number = '$sn' && at=1");
$Reccd3 = mysql_query($query_Reccd3, $sc) or die(mysql_error());
$row_Reccd3 = mysql_fetch_assoc($Reccd3);
$totalRows_Reccd3 = mysql_num_rows($Reccd3);//echo $totalRows_Reccd3;exit;
mysql_select_db($database_sc, $sc);
$query_Reccd31 = sprintf("SELECT f_tog FROM memberdata WHERE number = '$sn'");
$Reccd31 = mysql_query($query_Reccd31, $sc) or die(mysql_error());
$row_Reccd31 = mysql_fetch_assoc($Reccd31);
$totalRows_Reccd31 = mysql_num_rows($Reccd31);//echo $totalRows_Reccd31,">",$totalRows_Reccd3;
$f_tog = $row_Reccd31['f_tog'];
$sv=$f_tog-$totalRows_Reccd3;
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
    body {
        font-family: "verdana", "微軟正黑體";
        font-weight: 400;
    }
	.dv {
		width:150px;
		}
    @media (max-width: 1383px){
    .top-bar,.member-bar {
        width: calc(100% + 100px)
    }
    }
    @media (max-width: 1225px){
    .top-bar,.member-bar {
        width: calc(100% + 120px)
    }
    }
    @media (max-width: 1199px){
    .top-bar,.member-bar {
        width: calc(100% + 235px)
    }
    }
    @media (max-width: 1150px){
    .top-bar,.member-bar {
        width: calc(100% + 260px)
    }
    }
    @media (max-width: 1104px){
    .top-bar,.member-bar {
        width: calc(100% + 280px)
    }
    }
     @media (max-width: 1073px){
    .top-bar,.member-bar {
        width: calc(100% + 335px)
    }
    }
    @media (max-width: 1024px){
    .top-bar,.member-bar {
        width: calc(100% + 335px)
    }
    }
    @media (max-width: 1000px){
    .top-bar,.member-bar {
        width: calc(100% + 335px)
    }
    }
    @media (max-width: 900px){
    .top-bar,.member-bar {
        width: calc(100% + 400px)
    }
    }
    @media (max-width: 950px){
    .top-bar,.member-bar {
        width: calc(100% + 400px)
    }
    }
    @media (max-width: 840px){
    .top-bar,.member-bar {
        width: calc(100% + 500px)
    }
    }
    @media (max-width: 771px){
    .top-bar,.member-bar {
        width: calc(100% + 500px)
    }
    }
    @media (max-width: 769px){
    .top-bar,.member-bar {
        width: calc(100% + 500px)
    }
    }

    @media (max-width: 840px) {
        .v11 {
            width: 145px
        }
    }
    
    </style>
</head>

<body>
<?php require_once('adx.php');require_once('phone.php');require_once('desktop.php'); ?>
    <!--↓↓↓↓↓↓↓↓↓↓

                     content

                                    ↓↓↓↓↓↓↓↓↓↓↓-->
<div class="cut-navbar col-lg-8 col-md-7 col-sm-7 col-xs-11 col-lg-offset-2 col-sm-offset-1">
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
                <li class="cust-but"><a href="fan_management_1.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>會員管理</span></a></li>
                <li></li>
            </ul>
        </li>
    </ul>
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <li> <a href="new_account-1.php"><span>註冊新帳戶</span></a> </li>
            <li class="active"> <a href="new_account-4.php"><span>福袋兌換</span></a> </li>
           
        </ul>
    </div>
<div  class="menu col-lg-12 col-xs-12" >
        <div >
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-top: 15px">
                <form method="get" action="new_account-4.php" target="_top">
                集點卡明細

                <?php

                ?>
                            <select name="position" class="v11" onchange="submit();">
                              <option value="" selected="selected">
                              <?php if(isset($_GET['position'])){//選到的打勾
                                    $position = $_GET['position'];
                                    mysql_select_db($database_sc, $sc);
                                    $sql = "SELECT * FROM fd WHERE filling_position ='$position'";
                                    $conn = mysql_query($sql, $sc) or die(mysql_error());
                                    $row = mysql_fetch_assoc($conn);
                                    $tt_us = $row['card'];

                                    $pp_total=0;//出局
                                    $query_Recg = sprintf("SELECT * FROM fd WHERE c_guser = '$tt_us'");//上層的card
                                    $Recg = mysql_query($query_Recg, $sc) or die(mysql_error());
                                    $row_Recg = mysql_fetch_assoc($Recg);
                                    $totalRows_Recg = mysql_num_rows($Recg);//echo $totalRows_Recg;exit;
                                    $pp_total=$pp_total+$totalRows_Recg;
                                    if ($totalRows_Recg != 0) {
                                        do {
                                            $gusa=$row_Recg['card'];
                                            $query_Recg2 = sprintf("SELECT * FROM fd WHERE c_guser = '$gusa'");
                                            $Recg2 = mysql_query($query_Recg2, $sc) or die(mysql_error());
                                            $row_Recg2 = mysql_fetch_assoc($Recg2);
                                            $totalRows_Recg2 = mysql_num_rows($Recg2);
                                            if ($totalRows_Recg2 != 0) {$pp_total=$pp_total+$totalRows_Recg2;}
                                        } while ($row_Recg = mysql_fetch_assoc($Recg));
                                    }
                                    echo "✔&nbsp".$tt_us."&nbsp;&nbsp;&nbsp;".$pp_total;?> / 6
                                <?php
                                } else {
                                    echo "&nbsp;&nbsp;&nbsp"."請選擇";
                                };?></option>
                              <?php do {?>
                              <option value="<?php echo $row_Recfd['filling_position'];?>" <?php //if ($row_Recfd['card'] == $_POST['fd_c']) {echo "selected='selected'";}?>>
                                <?php if ($row_Recfd['at'] == 1) {
                                    /*echo "✔&nbsp;"*/echo "&nbsp;&nbsp;&nbsp;";
                                } else {
                                    echo "&nbsp;&nbsp;&nbsp;";
                                };echo $row_Recfd['card'],"&nbsp;&nbsp;&nbsp;";?>
                                <?php
                                    $p_total=0;
                                    $tt_us=$row_Recfd['card'];
                                    mysql_select_db($database_sc, $sc);
                                    $query_Recg = sprintf("SELECT * FROM fd WHERE c_guser = '$tt_us'");
                                    $Recg = mysql_query($query_Recg, $sc) or die(mysql_error());
                                    $row_Recg = mysql_fetch_assoc($Recg);
                                    $totalRows_Recg = mysql_num_rows($Recg);
                                    $p_total=$p_total+$totalRows_Recg;
                                    if ($totalRows_Recg != 0) {
                                    	do {$gusa=$row_Recg['card'];
                                        $query_Recg2 = sprintf("SELECT * FROM fd WHERE c_guser = '$gusa'");
                                        $Recg2 = mysql_query($query_Recg2, $sc) or die(mysql_error());
                                        $row_Recg2 = mysql_fetch_assoc($Recg2);
                                        $totalRows_Recg2 = mysql_num_rows($Recg2);
                                    	if ($totalRows_Recg2 != 0) {$p_total=$p_total+$totalRows_Recg2;}
                                    	} while ($row_Recg = mysql_fetch_assoc($Recg));
                                    	}
                                    echo $p_total;?> / 6
                              </option>
                              <?php } while ($row_Recfd = mysql_fetch_assoc($Recfd));?>
                            </select>
              </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-top: 15px">
                <form method="get" action="new_account-4.php" target="_top">福袋查詢
                        <select name="position" class="v11" onchange="submit();">
                            <option value="" selected="selected">
                                <?php 
                                if(isset($_GET['position'])){//選到的打勾
                                    $position = $_GET['position'];
                                    mysql_select_db($database_sc, $sc);
                                    $sql = "SELECT * FROM fd WHERE filling_position ='$position'";//用位置去取得card
                                    $conn = mysql_query($sql, $sc) or die(mysql_error());
                                    $row = mysql_fetch_assoc($conn);
                                    $fianum = $row['number'];
                                    $card = $row['card'];

                                    //取得帳號/暱稱/card
                                    $sql2 = sprintf("SELECT * FROM memberdata WHERE number = '$fianum'");
                                    $conn2 = mysql_query($sql2, $sc) or die(mysql_error());
                                        for($k=0;$k<mysql_numrows($conn2);$k++){
                                            $row2 = mysql_fetch_assoc($conn2);
                                            $m_username = $row2['m_username'];
                                            $m_nick = $row2['m_nick'];
                                        }
                                    
                                    echo "✔&nbsp".$m_username."/".$m_nick."/".$card."&nbsp&nbsp&nbsp".$pp_total."/ 6";
                                } else {
                                    echo "&nbsp;&nbsp;&nbsp"."請選擇";
                                }?>
                            </option>

                            <?php 
                            //推薦人顯示在福袋查詢
                            mysql_select_db($database_sc, $sc);
                            $query_Reckk = sprintf("SELECT * FROM fd WHERE c_fuser = '$fd_c'");
                            $Reckk = mysql_query($query_Reckk, $sc) or die(mysql_error());
                            for($i=0;$i<mysql_numrows($Reckk);$i++){
                                $row_Reckk = mysql_fetch_assoc($Reckk);
                                $fianum = $row_Reckk['number'];
                                $card =$row_Reckk['card'];
                                    //取得帳號/暱稱/card/數量
                                    //數量
                                    $ppp_total=0;
                                    mysql_select_db($database_sc, $sc);
                                    $query_Recg = sprintf("SELECT * FROM fd WHERE c_guser = '$card'");
                                    $Recg = mysql_query($query_Recg, $sc) or die(mysql_error());
                                    $row_Recg = mysql_fetch_assoc($Recg);
                                    $totalRows_Recg = mysql_num_rows($Recg);
                                    $ppp_total=$ppp_total+$totalRows_Recg;
                                    if ($totalRows_Recg != 0) {
                                        do {$gusa=$row_Recg['card'];
                                        $query_Recg2 = sprintf("SELECT * FROM fd WHERE c_guser = '$gusa'");
                                        $Recg2 = mysql_query($query_Recg2, $sc) or die(mysql_error());
                                        $row_Recg2 = mysql_fetch_assoc($Recg2);
                                        $totalRows_Recg2 = mysql_num_rows($Recg2);
                                        if ($totalRows_Recg2 != 0) {$ppp_total=$ppp_total+$totalRows_Recg2;}
                                        } while ($row_Recg = mysql_fetch_assoc($Recg));
                                    }
                                    //帳號/暱稱
                                    $query_Recfia2 = sprintf("SELECT * FROM memberdata WHERE number = '$fianum'");
                                    $Recfia2 = mysql_query($query_Recfia2, $sc) or die(mysql_error());
                                    for($k=0;$k<mysql_numrows($Recfia2);$k++){
                                        $row_Recfia2 = mysql_fetch_assoc($Recfia2);
                                        $m_username = $row_Recfia2['m_username'];
                                        $m_nick = $row_Recfia2['m_nick'];
                                        ?>
                                        <option value="<?php echo $row_Reckk['filling_position'];?>">
                                            <?php echo $m_username."/".$m_nick."/".$card."&nbsp&nbsp&nbsp".$ppp_total."/ 6";?>
                                        </option>
                                    <?php
                                    }
                            }?>
                        </select>
              </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-top: 15px">
                <form method="get" action="new_account-4.php" target="_top">未兌換福袋通知
                <?php
                //推薦數
                $tog = "SELECT * FROM memberdata WHERE number = '$sn' ";
                $con_tog = mysql_query($tog, $sc) or die(mysql_error());
                $row_tog = mysql_fetch_assoc($con_tog);
                $f_tog = $row_tog['f_tog'];

                $query_Recfd2 = sprintf("SELECT * FROM fd WHERE number = '$sn' ORDER BY id DESC");//最新一筆樹
                $Recfd2 = mysql_query($query_Recfd2, $sc) or die(mysql_error());
                $row_Recfd2 = mysql_fetch_assoc($Recfd2);
                $n_position = $row_Recfd2['filling_position'];

                //判斷是否出局
                $isout = "SELECT * FROM fd WHERE filling_position ='$n_position'";
                $oconn = mysql_query($isout, $sc) or die(mysql_error());
                $orow = mysql_fetch_assoc($oconn);
                $n_us = $orow['card'];
                $n_total=0;//出局
                $query_n = sprintf("SELECT * FROM fd WHERE c_guser = '$n_us'");//上層的card
                $n = mysql_query($query_n, $sc) or die(mysql_error());
                $row_n = mysql_fetch_assoc($n);
                $totalRows_n = mysql_num_rows($n);
                $n_total=$n_total+$totalRows_n;
                if ($totalRows_n != 0) {
                    do {
                        $ngusa=$row_n['card'];
                        $query_n2 = sprintf("SELECT * FROM fd WHERE c_guser = '$ngusa'");
                        $n2 = mysql_query($query_n2, $sc) or die(mysql_error());
                        $row_n2 = mysql_fetch_assoc($n2);
                        $totalRows_n2 = mysql_num_rows($n2);
                        if ($totalRows_n2 != 0) {$n_total=$n_total+$totalRows_n2;}
                    } while ($row_n = mysql_fetch_assoc($n));
                }
                ?>
                            <select name="fd_c" class="v11" onchange="submit();">
                              
                                <?php if ($f_tog == 0 && $n_total == 6){?>
                                    <option value=""><?php echo $n_total." /6"?></option>
                                <?php } else {?><option value="" selected="selected">無</option><?php }?>
                            </select>
              </form>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-top: 15px">可兌換餘數
                <?php echo $sv;?>
            </div>
        </div>
    </div>
    <? if ($_GET['err'] != "") {?><span style="color: #900"><?php echo "錯誤訊息： ",$_GET['err'];?></span><? }?>
    <div class="menu col-lg-12 col-xs-12" align="center">
        <?php require_once('fdmap.php');?>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
