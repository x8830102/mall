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
	if ($_POST['see'] == $_POST['sum']) {
    $bid=$HTTP_POST_VARS['bid'];$last_name=$HTTP_POST_VARS['last_name'];$first_name=$HTTP_POST_VARS['first_name'];$coc=$HTTP_POST_VARS['coc'];$sid=$HTTP_POST_VARS['sid'];
	$number=$HTTP_POST_VARS['number'];$m_nick=$HTTP_POST_VARS['m_nick'];$m_sex=$HTTP_POST_VARS['m_sex'];$m_birthday=$_POST['birthday'];//$HTTP_POST_VARS['mby']."-".$HTTP_POST_VARS['mbm']."-".$HTTP_POST_VARS['mbd'];
	$m_callphone=$HTTP_POST_VARS['m_callphone'];$m_addnum=$HTTP_POST_VARS['m_addnum'];$m_address=$HTTP_POST_VARS['m_address'];$st=$HTTP_POST_VARS['st'];
	//
		$update11="UPDATE memberdata SET m_nick='$m_nick', m_sex='$m_sex', m_birthday='$m_birthday', m_callphone='$m_callphone', m_addnum='$m_addnum', m_address='$m_address', st=$st WHERE number = '$number'";
        mysql_select_db($database_sc, $sc);
        $Result11 = mysql_query($update11, $sc) or die(mysql_error());//echo $bid;exit;
	//
	$update11="UPDATE bank SET last_name='$last_name', first_name='$first_name', coc='$coc', sid='$sid' WHERE id = $bid";
        mysql_select_db($database_sc, $sc);
        $Result11 = mysql_query($update11, $sc) or die(mysql_error());//echo "bankok-";
		//$insertGoTo = "mem1.php";
        //header(sprintf("Location: %s", $insertGoTo));
	$send=1;
	} else {$err="檢查碼不符  !";$send=0;}
}
//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//
mysql_select_db($database_sc, $sc);
$query_Recsn2 = sprintf("SELECT * FROM bank WHERE number = '$sn' ORDER BY id DESC");//
$Recsn2 = mysql_query($query_Recsn2, $sc) or die(mysql_error());
$row_Recsn2 = mysql_fetch_assoc($Recsn2);
$totalRows_Recsn2 = mysql_num_rows($Recsn2);
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
	.v2 {
	font-size:16px;
	text-align:center;
	border:1px solid #ADADAD;
	vertical-align: text-bottom;
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
            <ul class="cut-line_active">
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
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <li> <a href="member_profile01.php"><span>資料確認</span></a> </li>
            <li class="active"> <a href="member_profile02.php"><span>資料修改</span></a> </li>
            <li> <a href="member_profile03.php"><span>密碼修改</span></a> </li>
            <li> <a href="member_profile04.php"><span>二級修改</span></a> </li>
            <li> <a href="member_profile05.php"><span>E-mail修改</span></a> </li>
            <li> <a href="member_profile06.php"><span>資料驗證</span></a> </li>
            <!--<li> <a href="member_profile07.php"><span>講師驗證</span></a> </li>-->
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">資料修改</div>
            <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr class="menu-tr">
                      <td colspan="2" align="center"><span style="color: #F00"><span style="color: #66A5DA">
                      <input name="number" type="hidden" id="number" value="<?php echo $row_Recsn['number'];?>" />
                      </span><?php echo $err;?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">姓（英文）</td>
                        <td>
                            <input name="last_name" type="text" class="menu-select" id="last_name" value="<?php echo $row_Recsn2['last_name'];?>" />
          <input name="bid" type="hidden" id="bid" value="<?php echo $row_Recsn2['id'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">名（英文）</td>
                        <td>
                            <input name="first_name" type="text" class="menu-select" id="first_name" value="<?php echo $row_Recsn2['first_name'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">中文姓名</td>
                        <td>
                            <input name="m_nick" type="text" class="menu-select" id="m_nick" value="<?php echo $row_Recsn['m_nick'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">性別</td>
                        <td>
                            <select name="m_sex" class="menu-select" id="m_sex">
          <option value="F" <?php if ($row_Recsn['m_sex'] == "F") {echo "selected='selected'";}?>>女</option>
          <option value="M" <?php if ($row_Recsn['m_sex'] == "M") {echo "selected='selected'";}?>>男</option>
        </select>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>出生年月</span></td>
                        <td>
                            <input name="birthday" type="date" class="menu-select" id="bookdate" value="<?php echo $row_Recsn['m_birthday'];?>" size="15" placeholder="<?php echo $row_Recsn['m_birthday'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">國籍</td>
                        <td>
                            <select name="coc" class="menu-select" id="coc">
            <option value="US">US</option>
            <option value="CN">CN</option>
            <option value="TW" selected="selected">TW</option>
            <option value="HK">HK</option>
            <option value="SG">SG</option>
            <option value="MY">MY</option>
          </select>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>護照/身分證</span></td>
                        <td>
                            <input name="sid" type="text" class="menu-select" id="sid" value="<?php echo $row_Recsn2['sid'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                      <td height="40" valign="middle" class="menu-td"><span>護照/身分證上傳</span></td>
                        <td valign="middle"><?php if ($row_Recsn2['sid_pic'] == "") {echo "無資料";} else {echo "上傳完成";};?>
          <button type="button" class="menu-but" onClick="window.location='sid_uload.php'">修 正</button>
          <?php if ($row_Recsn2['sid_pic'] != "") {?>
          <button type="button" class="menu-but" onClick="window.location='sid_pic/<?php echo $row_Recsn2['sid_pic'];?>'">查 看</button>
          <?php }?></td>
                  </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>聯絡手機</span></td>
                        <td>
                            <input name="m_callphone" type="text" class="menu-select" id="m_callphone" value="<?php echo $row_Recsn['m_callphone'];?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>郵遞區號</span></td>
                        <td>
                            <input name="m_addnum" type="text" class="menu-select" id="m_addnum" value="<?php echo $row_Recsn['m_addnum'];?>" size="12" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>地址</span></td>
                        <td>
                            <input name="m_address" type="text" class="menu-select" id="m_address" value="<?php echo $row_Recsn['m_address'];?>" size="45" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>兌換自動扣積分</span></td>
                        <td>
                            <select name="st" class="v2" id="st">
          <option value="0" <?php if ($row_Recsn['st'] == "0") {echo "selected='selected'";}?>>未同意</option>
          <option value="1" <?php if ($row_Recsn['st'] == "1") {echo "selected='selected'";}?>>巳同意</option>
        </select>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">請輸入驗證碼</td>
                        <td>
                            <input name="sum" type="text" class="v2" id="sum" size="12" />
                            <?php echo $sum;?>
                            <a href="member_profile02.php"><img width="15px" src="img/refresh.png" alt="" style="margin-left: 3px"></a>
                        </td>
                    </tr>
                    <tr align="center">
                        <td height="40" colspan="2" valign="middle"><?php if ($send == 1) {echo " 完成儲存 ";} else {?>
                          <input type="submit" name="button" id="button" class="menu-but"  value="儲存">
                            <?php }?><input name="MM_update" type="hidden" id="MM_update" value="form1" /><input name="see" type="hidden" id="see" value="<?php echo $sum;?>" />
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
