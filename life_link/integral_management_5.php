<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
include('if_login.php');
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$number=$row_Recsn['number'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
$investment_query = $pdo_cmg ->query("SELECT investor_id FROM cmg_investment WHERE refer_member_id='$number'");
$result = $investment_query->rowCount();


//
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
    </style>
</head>

<body>
<?php require_once('adx.php');require_once('phone.php');require_once('desktop.php'); ?>
    <!--↓↓↓↓↓↓↓↓↓↓

                     content

                                    ↓↓↓↓↓↓↓↓↓↓↓-->
<div class="cut-navbar col-lg-7 col-md-7 col-sm-7 col-xs-11 col-lg-offset-2 col-sm-offset-1">
    <ul class="cut-page">
        <?php if ($a_pud >= 2) {?><li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >註冊會員</span></a></li>
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
        <?php if ($a_pud >= 2) {?><li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line">
                <li class="cust-but"><a href="fan_management_2.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>會員管理</span></a></li>
                <li></li>
            </ul>
        </li><? }?>
    </ul>
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <li> <a href="integral_management_1.php"><span>註冊積分</span></a> </li>
            <li> <a href="integral_management_2.php"><span>串串積分</span></a> </li>
            <li> <a href="integral_management_3.php"><span>消費積分</span></a> </li>
            <li> <a href="integral_management_4.php"><span>紅利積分</span></a> </li>
            <li class="active"> <a href="integral_management_5.php"><span>所有積分</span></a> </li>
            <li> <a href="integral_management_6.php"><span>消費明細</span></a> </li>
            <li> <a href="fan_management_3.php"><span>集點卡數</span></a> </li>
            <li> <a href="fan_management_1.php"><span>所有粉絲</span></a> </li>
           <!-- <li> <a href="integral_management_7.php"><span>講師積分</span></a> </li>
            <li> <a href="integral_management_8.php"><span>積分兌換</span></a> </li>-->
            
        </ul>
  </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">積分來源查詢</div>
            <table width="300" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td></td>
    <td></td>
  </tr>
</table>

    </div>
    
        <div style="  margin-top: 10px" class="table-responsive ">
            <div class="inquire col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left">
                <form id="form2" name="form2" method="post" action="integral_management_5.php">
                <table  class="search" style="margin-bottom: 15px">
                    <tbody>
                        <tr>
                            <td>查詢積分</td>
                            <td style="width: 12px"></td>
                            <td><select name="st"  id="st">                            
                            <option value="level=0" <?php if ($_POST['st'] == "" Xor $_POST['st'] == "level=0") {echo "selected='selected'";}?>>所有積分來源明細</option>
                            <?php if ($a_pud >= 2) 
							{
								if($_GET['st']){$_POST['st'] = $_GET['st'];echo $_POST['st'];}
							?>
								<option value="level=1" <?php if ($_POST['st'] == "level=1") {echo "selected='selected'";}?>>專案推廣積分回饋明細</option>
								<option value="level=2" <?php if ($_POST['st'] == "level=2") {echo "selected='selected'";}?>>協助推廣積分回饋明細</option>
								<option value="level=3" <?php if ($_POST['st'] == "level=3") {echo "selected='selected'";}?>>講師專案解說積分明細</option><? 
							}
							?>
                            <option value="level=4" <?php if ($_POST['st'] == "level=4") {echo "selected='selected'";}?>>福袋禮讚積分回饋明細</option>
                            <option value="level=5" <?php if ($_POST['st'] == "level=5") {echo "selected='selected'";}?>>系統銷售分紅回饋明細</option>
							
                            <option value="level=6" <?php if ($_POST['st'] == "level=6") {echo "selected='selected'";}?>>店家引薦積分回饋明細</option>
							<option value="level=7" <?php if ($_POST['st'] == "level=7") {echo "selected='selected'";}?>>自我消費積分回饋明細</option>
							<option value="level=8" <?php if ($_POST['st'] == "level=8") {echo "selected='selected'";}?>>鐵粉消費積分回饋明細</option>
							
							<option value="level=9" <?php if ($_POST['st'] == "level=9") {echo "selected='selected'";}?>>粉絲消費積分回饋明細</option>
							<option value="level=10" <?php if ($_POST['st'] == "level=10") {echo "selected='selected'";}?>>粉絲推廣紅利贈點明細</option>
							<option value="level=11" <?php if ($_POST['st'] == "level=11") {echo "selected='selected'";}?>>全國商城分紅回饋明細</option>
							<option value="level=12" <?php if ($_POST['st'] == "level=12") {echo "selected='selected'";}?>>商城廣告收益回饋明細</option>
							<?php
							if(!empty($result))
							{
								?>
								<option value="level=17" <?php if ($_POST['st'] == "level=17") {echo "selected='selected'";}?>>特別專案明細</option>
							<?php
							}
							?>
                          </select></td>
                        </tr>
                    </tbody>
                </table>
                <table class="search">
                    <tbody>
                        <tr>
                            <td>查詢日期</td>
                            <td></td>
                            <td>起至</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input name="sd1" type="date" id="bookdate" value="<?php echo $_POST['sd1'];?>" size="15" placeholder="2014-09-18" /></td>
                            <td width="10px"></td>
                            <td><input name="sd2" type="date" id="bookdate2" value="<?php echo $_POST['sd2'];?>" size="15" placeholder="2014-09-18" /></td>
                            <td><input type="submit" name="button" id="button" class="inquire-but hidden-xs" value="查詢"></td>
                        </tr>
                        <tr style="height: 5px">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                        <td  colspan="3">
                        <input type="submit" name="button" id="button" class="inquire-but visible-xs" value="查詢" style="width: 100%"> 
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
			
<?php //
if ($_POST['st'] != "level=0") {if ($_POST['st'] != "") {$st=" && ".$_POST['st'];} else {$st="";}} else {$st="";}
if ($_POST['sd1'] != "") {$sd=" && date >= '".$_POST['sd1']."' && date <= '".$_POST['sd2']."'";} else {$sd="";}
//echo $st,"###",$sd;exit;
$key="SELECT * FROM gold_m WHERE number='$sn' $st $sd ORDER BY id DESC";
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
	?>
	<DIV class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php 
		
			if($totalRows_Recoc % 10 ==0)
			{
				$pagecount = floor($totalRows_Recoc/10);
			}else{
				$pagecount = floor($totalRows_Recoc/10+1);
			}
			
			$page = $_GET['pageNum_Recoc'] <= 0 || $_GET['pageNum_Recoc'] >= $pagecount ? 0 : $_GET['pageNum_Recoc'];
			$pageNum = $page > $pagecount-5 ? $pagecount : ($page+1)+5;
			$pageNum2 = $page < 5 ? 1 : ($page+1)-5;
			$previous  = $page<= 0 ? 0 : $page-1;
			$next = $page >= $pagecount-1 ? $pagecount-1 :$page+1;

			echo "<a href='integral_management_5.php?pageNum_Recoc=".$previous."&st=".$_POST['st']."'>上一頁</a>";
			for($i=$pageNum2 ;$i<=$pageNum;$i++)
			{
				if($i == $page+1)
				{
					echo "[ <a href='integral_management_5.php?pageNum_Recoc=".($i-1)."&st=".$_POST['st']."'>$i</a> ]";
				}else{
					echo " <a href='integral_management_5.php?pageNum_Recoc=".($i-1)."&st=".$_POST['st']."'>$i</a>" ;
				}
			}
			echo "<a href='integral_management_5.php?pageNum_Recoc=".$next."&st=".$_POST['st']."'>下一頁</a>";
		?>
	</DIV>
            <table class="integral-tb table" width="100%" style="min-width: 100%">
                <tbody>
                    <tr class="integral-frist-tr" align="center">
                        <td align="left" style="width: 3%;border-top: 0px ">#</td>
                      <td align="left" style="width: 12%;border-top: 0px">日期時間</td>
                      <td style="width: 15%;border-top: 0px;">所有積分</td>
                        <td style="width: 15%;border-top: 0px;">串串積分</td>
                        <td style="width: 15%;border-top: 0px;">消費積分 </td>
                        <td style="width: 20%;border-top: 0px;">紅利積分</td>
                        <td style="width: 20%;border-top: 0px">備註</td>
                    </tr>
                    <?php $pj=$_GET['pj']+0;$gid=$totalRows_Recoc; if ($totalRows_Recoc != 0) {do {$pj++;$gold_id=$row_Recoc['id'];$dd=$row_Recoc['date'];
//c
mysql_select_db($database_sc, $sc);
$query_Recc = sprintf("SELECT * FROM c_cash WHERE number = '$sn' && gold_id='$gold_id' ORDER BY id DESC");
$Recc = mysql_query($query_Recc, $sc) or die(mysql_error());
$row_Recc = mysql_fetch_assoc($Recc);
$totalRows_Recc = mysql_num_rows($Recc);
//g
mysql_select_db($database_sc, $sc);
$query_Recg = sprintf("SELECT * FROM g_cash WHERE number = '$sn' && gold_id='$gold_id' ORDER BY id DESC");
$Recg = mysql_query($query_Recg, $sc) or die(mysql_error());
$row_Recg = mysql_fetch_assoc($Recg);
$totalRows_Recg = mysql_num_rows($Recg);
//r

mysql_select_db($database_sc, $sc);
$query_Recr = sprintf("SELECT * FROM r_cash WHERE number = '$sn' && gold_id='$gold_id' ORDER BY id DESC");
$Recr = mysql_query($query_Recr, $sc) or die(mysql_error());
$row_Recr = mysql_fetch_assoc($Recr);
$totalRows_Recr = mysql_num_rows($Recr);?><tr class="integral-tr">
                        <td><?php echo $gid-$_GET['pageNum_Recoc']*10; $gid--;?></td>
                        <td>
                            <ul>
                                <li> <span><?php echo $row_Recoc['date'];?></span> </li>
                                <li><span><?php echo $row_Recoc['time'];?></span></li>
                            </ul>
                        </td>
                        <td align="right"><span><?php $ocg=$row_Recoc['g']+0;echo number_format($ocg, 0, '.' ,',');?></span></td>
                        <td align="right"><span><?php $pc=$row_Recc['cin']+0;$pc2=number_format($pc, 0, '.' ,',');echo $pc2;?></span></td>
                        <td align="right"><span><?php $pg=$row_Recg['cin']+0;$pg2=number_format($pg, 0, '.' ,',');echo $pg2;?></span></td>
                        <td align="right"><?php $pr=$row_Recr['cin']+0;$pr2=number_format($pr, 0, '.' ,',');echo $pr2;?></td>
                        <td align="left"><?php echo $row_Recoc['note'];?></td>
                    </tr><?php } while ($row_Recoc = mysql_fetch_assoc($Recoc));} else {echo "無資料";}?>
                </tbody>
            </table></form>
			<DIV class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php 
					if($totalRows_Recoc % 10 ==0)
					{
						$pagecount = floor($totalRows_Recoc/10);
					}else{
						$pagecount = floor($totalRows_Recoc/10+1);
					}
					$page = $_GET['pageNum_Recoc'] <= 0 || $_GET['pageNum_Recoc'] >= $pagecount ? 0 : $_GET['pageNum_Recoc'];
					$pageNum = $page > $pagecount-5 ? $pagecount : ($page+1)+5;
					$pageNum2 = $page < 5 ? 1 : ($page+1)-5;
					$previous  = $page<= 0 ? 0 : $page-1;
					$next = $page >= $pagecount-1 ? $pagecount-1 :$page+1;

					echo "<a href='integral_management_5.php?pageNum_Recoc=".$previous."'>上一頁</a>";
					for($i=$pageNum2 ;$i<=$pageNum;$i++)
					{
						if($i == $page+1)
						{
							echo "[ <a href='integral_management_5.php?pageNum_Recoc=".($i-1)."'>$i</a> ]";
						}else{
							echo " <a href='integral_management_5.php?pageNum_Recoc=".($i-1)."'>$i</a>" ;
						}
					}
					echo "<a href='integral_management_5.php?pageNum_Recoc=".$next."'>下一頁</a>";
				?>
			</DIV>
        </div>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
