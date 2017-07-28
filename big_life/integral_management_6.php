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
//gm
require_once('Connections/sr.php');
if ($_POST['sd1'] != "" && $_POST['sd2'] != "") {$sd=" && date >= ".$_POST['sd1']." && date <= ".$_POST['sd2'];} else {$sd="";}
mysql_select_db($database_sc, $sc);$s="";
$query_Recgm = sprintf("SELECT * FROM gold_m WHERE number = '$sn' && store <> '$s' $sd ORDER BY id DESC");//
$Recgm = mysql_query($query_Recgm, $sc) or die(mysql_error());
$row_Recgm = mysql_fetch_assoc($Recgm);
$totalRows_Recgm = mysql_num_rows($Recgm);//echo $totalRows_Recgm;
//total
mysql_select_db($database_sc, $sc);$total_p=0;
$query_Recgmt = sprintf("SELECT * FROM gold_m WHERE number = '$sn' && store <> '$s' ORDER BY id DESC");//
$Recgmt = mysql_query($query_Recgmt, $sc) or die(mysql_error());
$row_Recgmt = mysql_fetch_assoc($Recgmt);
$totalRows_Recgmt = mysql_num_rows($Recgmt);
do {$total_p=$total_p+$row_Recgmt['pay_total'];} while ($row_Recgmt = mysql_fetch_assoc($Recgmt));
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
    body {
        font-family: "verdana", "微軟正黑體";
        font-weight: 400;
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
        <?php if ($a_pud >= 2) {?><li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >系統註冊</span></a></li>
            </ul>
        </li><? }?>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="member_profile01.php"><span class="icon-c hidden-xs" style="margin-right: 5px"></span><span>基本資料</span></a></li>
                <li></li>
            </ul>
        </li>
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line_active">
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
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <li> <a href="integral_management_1.php"><span>註冊積分</span></a> </li>
            <li> <a href="integral_management_2.php"><span>串串積分</span></a> </li>
            <li> <a href="integral_management_3.php"><span>購物積分</span></a> </li>
            <li> <a href="integral_management_4.php"><span>紅利積分</span></a> </li>
            <li> <a href="integral_management_5.php"><span>積分來源</span></a> </li>
            <li class="active"> <a href="integral_management_6.php"><span>積分消費</span></a> </li>
            <li> <a href="integral_management_7.php"><span>講師積分</span></a> </li>
            <li> <a href="integral_management_8.php"><span>積分兌換</span></a> </li>
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">積分消費管理</div>
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr class="">
                        <td colspan="2"><span>消費累積</span><span style="color: red;margin-left: 15px"><? echo $total_p;?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="  margin-top: 10px" class="table-responsive ">
            <form id="form2" name="form2" method="post" action="integral_management_6.php">
            <div class="inquire">
                <ul>
                    <li>查詢日期</li>
                    <li>
                        <input name="sd1" type="date" id="bookdate" value="<?php echo $_GET['sd1'];?>" size="15" placeholder="2014-09-18" />
                    </li>
                    <li>起至</li>
                    <li>
                        <input name="sd2" type="date" id="bookdate2" value="<?php echo $_GET['sd2'];?>" size="15" placeholder="2014-09-18" />
                    </li>
                    <li>
                        <input type="submit" name="button" id="button" class="inquire-but" value="查詢">
                    </li>
                </ul>
            </div></form>
            <table class="integral-tb table" width="100%" style="min-width: 100%">
                <tbody>
                    <tr class="integral-frist-tr">
                        <td width="6%" style="width: 2%;border-top: 0px ">#</td>
                        <td width="11%" style="width: 15%;border-top: 0px">消費 日期/時間</td>
                        <td width="10%" style="width: 10%;border-top: 0px"> 店名</td>
                        <td width="10%" style="width: 10%;border-top: 0px">單筆金額</td>
                        <td width="10%" style="width: 10%;border-top: 0px">串串積分 </td>
                        <td width="15%" style="width: 15%;border-top: 0px">購物積分 </td>
                        <td width="15%" style="width: 15%;border-top: 0px">紅利積分</td>
                        <td width="15%" style="width: 15%;border-top: 0px">應付金額</td>
                        <td width="15%" style="width: 15%;border-top: 0px">付款方式</td>
                        <td width="8%" style="width: 8%;border-top: 0px">備註</td>
                    </tr>
                    <?php if ($totalRows_Recgm != 0) {do {$store=$row_Recgm['store'];$sa_id=$row_Recgm['sa_id'];
mysql_select_db($database_sr, $sr);
$query_Recu = sprintf("SELECT * FROM wp_users WHERE user_login = '$store'");//
$Recu = mysql_query($query_Recu, $sr) or die(mysql_error());
$row_Recu = mysql_fetch_assoc($Recu);
$uid=$row_Recu['ID'];
mysql_select_db($database_sr, $sr);
$query_Recua = sprintf("SELECT * FROM wp_usermeta WHERE user_id=$uid && meta_key='primary_blog'");//
$Recua = mysql_query($query_Recua, $sr) or die(mysql_error());
$row_Recua = mysql_fetch_assoc($Recua);
$bid=$row_Recua['meta_value'];$pm="wp_".$bid."_postmeta";
mysql_select_db($database_sr, $sr);
$query_Recpm = sprintf("SELECT * FROM $pm WHERE post_id = $sa_id && meta_key = '_order_total'");//
$Recpm = mysql_query($query_Recpm, $sr) or die(mysql_error());
$row_Recpm = mysql_fetch_assoc($Recpm);
$total=$row_Recpm['meta_value'];
mysql_select_db($database_sr, $sr);
$query_Recpm2 = sprintf("SELECT * FROM $pm WHERE post_id = $sa_id && meta_key = 'r'");//
$Recpm2 = mysql_query($query_Recpm2, $sr) or die(mysql_error());
$row_Recpm2 = mysql_fetch_assoc($Recpm2);
$r=$row_Recpm2['meta_value'];
mysql_select_db($database_sr, $sr);
$query_Recpm3 = sprintf("SELECT * FROM $pm WHERE post_id = $sa_id && meta_key = 'g'");//
$Recpm3 = mysql_query($query_Recpm3, $sr) or die(mysql_error());
$row_Recpm3 = mysql_fetch_assoc($Recpm3);
$g=$row_Recpm3['meta_value'];
mysql_select_db($database_sr, $sr);
$query_Recpm4 = sprintf("SELECT * FROM $pm WHERE post_id = $sa_id && meta_key = 'c'");//
$Recpm4 = mysql_query($query_Recpm4, $sr) or die(mysql_error());
$row_Recpm4 = mysql_fetch_assoc($Recpm4);
$c=$row_Recpm4['meta_value'];
mysql_select_db($database_sr, $sr);
$query_Recpm5 = sprintf("SELECT * FROM $pm WHERE post_id = $sa_id && meta_key = 'pay_total'");//
$Recpm5 = mysql_query($query_Recpm5, $sr) or die(mysql_error());
$row_Recpm5 = mysql_fetch_assoc($Recpm5);
$pay_total=$row_Recpm5['meta_value'];
mysql_select_db($database_sr, $sr);
$query_Recpm6 = sprintf("SELECT * FROM $pm WHERE post_id = $sa_id && meta_key = '_payment_method_title'");//
$Recpm6 = mysql_query($query_Recpm6, $sr) or die(mysql_error());
$row_Recpm6 = mysql_fetch_assoc($Recpm6);
$payment_title=$row_Recpm6['meta_value'];
mysql_select_db($database_sr, $sr);
$query_Recpm7 = sprintf("SELECT * FROM $pm WHERE post_id = $sa_id && meta_key = '_billing_company'");//
$Recpm7 = mysql_query($query_Recpm7, $sr) or die(mysql_error());
$row_Recpm7 = mysql_fetch_assoc($Recpm7);
$billing_company=$row_Recpm7['meta_value'];
					?><tr class="integral-tr">
                        <td><? echo $sa_id;?></td>
                        <td>
                            <ul>
                                <li> <span><? echo $row_Recgm['date'];?></span> </li>
                                <li><span><? echo $row_Recgm['time'];?></span></li>
                            </ul>
                        </td>
                        <td><span><? echo $store;?></span></td>
                        <td><span><? echo $total;?></span></td>
                        <td><span><? echo $c;?></span></td>
                        <td><span><? echo $g;?></span></td>
                        <td><span><? echo $r;?></span></td>
                        <td><span><? echo $pay_total;?></span></td>
                        <td><span><? echo $payment_title;?></span></td>
                        <td><span><? echo $billing_company;?></span></td>
                    </tr><?php } while ($row_Recgm = mysql_fetch_assoc($Recgm));} else {echo "no date";}?>
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
