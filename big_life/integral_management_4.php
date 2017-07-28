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
$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
	
    $myus=$HTTP_POST_VARS['number'];$passtoo=$HTTP_POST_VARS['passtoo'];$note2=$_POST['note2'];
	$pay=$HTTP_POST_VARS['pay'];$yuser=strtoupper(trim($HTTP_POST_VARS['yuser']));
	$date=date("Y-m-d");$time=date("H:i:s");
	if ($_POST['see'] == $_POST['sum']) {
	//
    mysql_select_db($database_sc, $sc);
    $query_Recmem2 = sprintf("SELECT * FROM memberdata WHERE number = '$myus' && m_passtoo='$passtoo' && m_ok=1");
    $Recmem2 = mysql_query($query_Recmem2, $sc) or die(mysql_error());
    $row_Recmem2 = mysql_fetch_assoc($Recmem2);
    $totalRows_Recmem2 = mysql_num_rows($Recmem2);
	if ($totalRows_Recmem2 != 0) {
		//
        mysql_select_db($database_sc, $sc);
        $query_Recoc2 = sprintf("SELECT * FROM r_cash WHERE number = '$myus' ORDER BY id DESC");
        $Recoc2 = mysql_query($query_Recoc2, $sc) or die(mysql_error());
        $row_Recoc2 = mysql_fetch_assoc($Recoc2);
        $totalRows_Recoc2 = mysql_num_rows($Recoc2);
		if ($row_Recoc2['csum'] >= $pay) {
			mysql_select_db($database_sc, $sc);
            $query_Recmem3 = sprintf("SELECT * FROM memberdata WHERE m_username = '$yuser' && m_ok=1");
            $Recmem3 = mysql_query($query_Recmem3, $sc) or die(mysql_error());
            $row_Recmem3 = mysql_fetch_assoc($Recmem3);
            $totalRows_Recmem3 = mysql_num_rows($Recmem3);
			if ($totalRows_Recmem3 != 0) {
				$yus=$row_Recmem3['number'];
				mysql_select_db($database_sc, $sc);
                $query_Recoc3 = sprintf("SELECT * FROM r_cash WHERE number = '$yus' ORDER BY id DESC");
                $Recoc3 = mysql_query($query_Recoc3, $sc) or die(mysql_error());
                $row_Recoc3 = mysql_fetch_assoc($Recoc3);
                $totalRows_Recoc3 = mysql_num_rows($Recoc3);
				//支
				$new_my_sum=$row_Recoc2['csum']-$pay;
				$my_note="紅利積分轉出給帳號:".$yuser."/".$row_Recmem3['m_nick'];
			    mysql_select_db($database_sc, $sc);
                $insertCommand13="INSERT INTO r_cash (number, cout, csum, note, note2, date, time) VALUES ('$myus', '$pay', '$new_my_sum', '$my_note', '$note2', '$date', '$time')"; 
                mysql_query($insertCommand13,$sc);
				//收
				$new_y_sum=$row_Recoc3['csum']+$pay;
				$y_note="收到來自[ ".$row_Recmem2['m_nick']." ]的紅利積分";
				mysql_select_db($database_sc, $sc);
                $insertCommand13="INSERT INTO r_cash (number, cin, csum, note, note2, date, time) VALUES ('$yus', '$pay', '$new_y_sum', '$y_note', '$note2', '$date', '$time')"; 
                mysql_query($insertCommand13,$sc);
				$send=1;$err="完成轉出";
	            } else {$err="查無此轉出 ID  !";$send=0;}
	        } else {$err="扣值不足  !";$send=0;}
	} else {$err="
二级密码不對  !";$send=0;}
	} else {$err="驗證碼錯誤  !";$send=0;}
}
//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//
mysql_select_db($database_sc, $sc);
$query_Recocz = sprintf("SELECT * FROM r_cash WHERE number = '$sn' ORDER BY id DESC");
$Recocz = mysql_query($query_Recocz, $sc) or die(mysql_error());
$row_Recocz = mysql_fetch_assoc($Recocz);
$totalRows_Recocz = mysql_num_rows($Recocz);
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
            <li class="active"> <a href="integral_management_4.php"><span>紅利積分</span></a> </li>
            <li> <a href="integral_management_5.php"><span>積分來源</span></a> </li>
            <li> <a href="integral_management_6.php"><span>積分消費</span></a> </li>
            <li> <a href="integral_management_7.php"><span>講師積分</span></a> </li>
            <li> <a href="integral_management_8.php"><span>積分兌換</span></a> </li>
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">紅利積分管理</div>
            <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <!--<tr class="menu-tr">
                      <td colspan="2" align="center"><span style="color: #F00"><?php //echo $err;?></span></td>
                    </tr>-->
                    <tr class="menu-tr">
                        <td colspan="2"><span>紅利積分結餘</span><span style="color: red;margin-left: 15px"><?php $pc=$row_Recocz['csum']+0;$pc2=number_format($pc, 0, '.' ,',');echo $pc2;?></span></td>
                    </tr><?php //if ($pc != 0) {?>
                    <!--<tr class="menu-tr">
                        <td class="menu-td">轉出點數</td>
                        <td>
                            <input name="pay" type="text" id="pay" placeholder="">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">轉至會員帳號</td>
                        <td>
                            <input name="yuser" type="text" id="yuser" placeholder="請輸入電話或暱稱或公司行號">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">備註</td>
                        <td>
                            <input name="note2" type="text" id="note2" placeholder="">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">二級密碼</td>
                        <td>
                            <input name="passtoo" type="password" id="passtoo" size="12" placeholder="密碼預設123456"><input name="see" type="hidden" id="see" value="<?php echo $sum;?>" />
                                  <input name="number" type="hidden" id="number" value="<?php //echo $row_Recsn['number'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">驗證碼</td>
                        <td>
                            <input name="sum" type="text" id="sum" style="min-width: 70px;" size="12" placeholder="請輸入驗證碼">
                            <?php //echo $sum;?>
                            <a href="integral_management_4.php"><img width="15px" src="img/refresh.png" alt="" style="margin-left: 3px"></a>
                        </td>
                    </tr>
                    <tr class="" align="center">
                        <td colspan="2">
                        <?php //if ($send == 1) {echo " 完成轉出 ";} else {?>
                                  
                                  <input type="submit" name="button" id="button" class="inquire-but"  value="轉出GO">
                                  <?php //}} else {echo "轉出功能暫停"; }?>
                                    <input name="MM_update" type="hidden" id="MM_update" value="form1" />
                        </td>
                    </tr>-->
                </tbody>
            </table></form>
        </div>
        <form id="form2" name="form2" method="get" action="integral_management_4.php">
        <div style="  margin-top: 10px" class="table-responsive ">
            
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
                
            </div><?php //
if ($_GET['sd1'] != "") {
	$sd1=$_GET['sd1'];$sd2=$_GET['sd2'];
	$key="SELECT * FROM r_cash WHERE number = '$sn' && date >= '$sd1' && date <= '$sd2' ORDER BY id DESC";
	} else {$key="SELECT * FROM r_cash WHERE number = '$sn' ORDER BY id DESC";}
//
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recoc = 10;
$pageNum_Recoc = 0;
if (isset($_GET['pageNum_Recoc'])) {
  $pageNum_Recoc = $_GET['pageNum_Recoc'];
}
$startRow_Recoc = $pageNum_Recoc * $maxRows_Recoc;

mysql_select_db($database_sc, $sc);$n="NULL";
$query_Recoc = $key;// 
$query_limit_Recoc = sprintf("%s LIMIT %d, %d", $query_Recoc, $startRow_Recoc, $maxRows_Recoc);
$Recoc = mysql_query($query_limit_Recoc, $sc) or die(mysql_error());
$row_Recoc = mysql_fetch_assoc($Recoc);

if (isset($_GET['totalRows_Recoc'])) {
  $totalRows_Recoc = $_GET['totalRows_Recoc'];
} else {
  $all_Recoc = mysql_query($query_Recoc);
  $totalRows_Recoc = mysql_num_rows($all_Recoc);
}
$totalPages_Recoc = ceil($totalRows_Recoc/$maxRows_Recoc)-1;

$queryString_Recoc = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recoc") == false && 
        stristr($param, "totalRows_Recoc") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recoc = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recoc = sprintf("&totalRows_Recoc=%d%s", $totalRows_Recoc, $queryString_Recoc);
//?>
            <table class="integral-tb table" width="100%" style="min-width: 100%">
                <tbody>
                    <tr class="integral-frist-tr">
                        <td style="width: 3%;border-top: 0px ">#</td>
                        <td style="width: 12%;border-top: 0px">日期時間</td>
                        <td style="width: 15%;border-top: 0px">轉入</td>
                        <td style="width: 15%;border-top: 0px">轉出</td>
                        <td style="width: 15%;border-top: 0px">結餘</td>
                        <td style="width: 20%;border-top: 0px">備註1.</td>
                        <td style="width: 20%;border-top: 0px">備註2.</td>
                    </tr>
                    <?php $pj=$_GET['pj']+0;if ($totalRows_Recoc != 0) {do {$pj++;?><tr class="integral-tr">
                        <td><?php echo $pj;?></td>
                        <td>
                            <ul>
                                <li> <span><?php echo $row_Recoc['date'];?></span> </li>
                                <li><span><?php echo $row_Recoc['time'];?></span></li>
                            </ul>
                        </td>
                        <td><span><?php $pi=$row_Recoc['cin']+0;$pi2=number_format($pi, 0, '.' ,',');echo $pi2;?></span></td>
                        <td><span><?php $po=$row_Recoc['cout']+0;$po2=number_format($po, 0, '.' ,',');echo $po2;?></span></td>
                        <td><span><?php $pc=$row_Recoc['csum']+0;$pc2=number_format($pc, 0, '.' ,',');echo $pc2;?></span></td>
                        <td><?php echo $row_Recoc['note'];?></td>
                        <td><?php echo $row_Recoc['note2'];?></td>
                    </tr><?php } while ($row_Recoc = mysql_fetch_assoc($Recoc));} else {echo "no date";}?>
                </tbody>
            </table>
        </div></form>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
