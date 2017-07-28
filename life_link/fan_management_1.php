<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
include('if_login.php');
$username=$row_Recsn['m_username'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
$a_pud=$row_Recsn['a_pud'];
//
unset($fmu,$id2);$fmi=0;$fmi2=1;$fmk=0;
$fmu[0]=$row_Recsn['m_username'];
$id2[0]=$row_Recsn['m_id'];
while ($fmk != 1) {
	$fmj=$fmu[$fmi];
	mysql_select_db($database_sc, $sc);
    $query_Recfmu = sprintf("SELECT * FROM memberdata WHERE fname = '$fmj' ORDER BY m_id ASC");//
    $Recfmu = mysql_query($query_Recfmu, $sc) or die(mysql_error());
    $row_Recfmu = mysql_fetch_assoc($Recfmu);
    $totalRows_Recfmu = mysql_num_rows($Recfmu);//echo $totalRows_Recfmu;exit;
	if ($totalRows_Recfmu != 0) {
		do {
            $fma=$row_Recfmu['m_username'];
            $get_id=$row_Recfmu['m_id'];
            if (in_array($fma,$fmu) == false) {
                $fmu[$fmi2]=$fma;
                $id2[$fmi2]=$get_id;
                $fmi2++;
            }
        } while($row_Recfmu = mysql_fetch_assoc($Recfmu));
		}
	$fmi++;
	if ($fmu[$fmi] == "") {$fmk=1;}
	}
$fmu_total=count($fmu);
//asort($fmu);echo $fmu[0];
//$ss=count($fmu)-1;
//
    $ffsn=$row_Recsn['m_username'];
    mysql_select_db($database_sc, $sc);
    $query_Recfmu2 = sprintf("SELECT * FROM memberdata WHERE fname = '$ffsn'");//
    $Recfmu2 =  mysql_query($query_Recfmu2, $sc) or die(mysql_error());
    $row_Recfmu2 = mysql_fetch_assoc($Recfmu2);
    $totalRows_Recfmu2 = mysql_num_rows($Recfmu2);//echo $totalRows_Recfmu2;
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
            <li> <a href="integral_management_5.php"><span>所有積分</span></a> </li>
            <li> <a href="integral_management_6.php"><span>消費明細</span></a> </li>
            <li> <a href="fan_management_3.php"><span>集點卡數</span></a> </li>
            <li class="active"> <a href="fan_management_1.php"><span>所有粉絲</span></a> </li>
            <!--<li> <a href="fan_management_2.php"><span>直接會員</span></a> </li>-->

        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
      <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">所有會員粉絲管理</div>
            <table width="300" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td></td>
    <td></td>
  </tr>
</table>
        </div>
        <form id="form2" name="form2" method="get" action="fan_management_1.php">
        <?php //
if ($_GET['sd1'] != "") {
	$sd1=$_GET['sd1'];$sd2=$_GET['sd2'];
	$key="SELECT * FROM memberdata WHERE m_fuser = '$sn' && date >= '$sd1' && date <= '$sd2' ORDER BY m_id DESC";
	} else {$key="SELECT * FROM memberdata WHERE m_fuser = '$sn' ORDER BY m_id DESC";}

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
$ss=$totalRows_Recoc;

//unset($uf);$ui=0;$ut=$sn;$uj=0;//echo $ut;exit;
//$all_total=count($uf);//echo $all_total;exit;?>
<!--<div style="  margin-top: 10px" class="table-responsive ">
          <div class="inquire col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left">
                <table class="search">
                    <tbody>
                        <tr>
                            <td>查詢日期</td>
                            <td></td>
                            <td>起至</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input name="sd1" type="date" id="bookdate" value="<?php echo $_GET['sd1'];?>" size="15" placeholder="2014-09-18" /></td>
                            <td width="10px"></td>
                            <td><input name="sd2" type="date" id="bookdate2" value="<?php echo $_GET['sd2'];?>" size="15" placeholder="2014-09-18" /></td>
                            <td>
                                
                                <input type="submit" name="button" id="button" class="inquire-but hidden-xs" value="查詢">
                                    
                                
                            </td>
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
            </div>-->
    <table class="integral-tb table" width="100%" style="min-width: 100%" >
        <tbody>
            <tr align="center">
              <td colspan="2" align="left" style="width: 3%;border-top: 0px ">總粉絲： <?php echo $fmu_total;//,"<br/>直接會員粉絲:",$totalRows_Recoc;?></td>
              <td colspan="3" align="left" style="width: 20%;border-top: 0px">* 包含未付費會員<br/></td>
              <td width="25%" align="center" style="width: 15%;border-top: 0px;">&nbsp;</td>
              <td width="22%" align="center" style="width: 20%;border-top: 0px">&nbsp;</td>
            </tr>
            <tr class="integral-frist-tr" align="center">
                <td width="5%" align="left" style="width: 3%;border-top: 0px ">#</td>
              <td width="14%" align="left" style="width: 12%;border-top: 0px">註冊日期時間</td>
              <td width="7%" align="left" style="border-top: 0px">&nbsp;</td>
              <td width="17%" align="left" style="width: 15%;border-top: 0px">名稱</td>
              <td width="10%" style="width: 15%;border-top: 0px;">間接粉絲</td>
                <td style="width: 15%;border-top: 0px;">關係粉絲</td>
                <td style="width: 20%;border-top: 0px"></td>
            </tr>
			<DIV class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php 
					$pagecount = floor($fmu_total/10)+1;
					$page = $_GET['pageNum_Recoc'] <= 0 || $_GET['pageNum_Recoc'] >= $pagecount ? 0 : $_GET['pageNum_Recoc'];
					$pageNum = $page > $pagecount-5 ? $pagecount : ($page+1)+5;
					$pageNum2 = $page < 5 ? 1 : ($page+1)-5;
					$previous  = $page<= 0 ? 0 : $page-1;
					$next = $page >= $pagecount-1 ? $pagecount-1 :$page+1;

					echo "<a href='fan_management_1.php?pageNum_Recoc=".$previous."'>上一頁</a>";
					for($i=$pageNum2 ;$i<=$pageNum;$i++)
					{
						if($i == $page+1)
						{
							echo "[ <a href='fan_management_1.php?pageNum_Recoc=".($i-1)."'>$i</a> ]";
						}else{
							echo " <a href='fan_management_1.php?pageNum_Recoc=".($i-1)."'>$i</a>" ;
						}
					}
					echo "<a href='fan_management_1.php?pageNum_Recoc=".$next."'>下一頁</a>";
				?>
			</DIV>
			<?php
            array_multisort($id2,SORT_ASC,SORT_NUMERIC);//陣列排序
			if ($fmu_total > 1) {
				$ss=$fmu_total-$page*10-1;//krsort($fmu);
				$a = 0;
				while ($a < 10 && !empty($id2[$ss])) {
					//for ($fi=1;$fi < count($fmu);$fi++) {
					$fia=$id2[$ss];
					
					$a++;
					mysql_select_db($database_sc, $sc);
					$query_Recoc = sprintf("SELECT * FROM memberdata WHERE m_id = '$fia'");//
					$Recoc =  mysql_query($query_Recoc, $sc) or die(mysql_error());
					$row_Recoc = mysql_fetch_assoc($Recoc);
					$totalRows_Recoc = mysql_num_rows($Recoc);
					$apud=$row_Recoc['a_pud'];
					mysql_select_db($database_sc, $sc);
					$query_Recap = sprintf("SELECT * FROM a_pud WHERE id = $apud");//
					$Recap = mysql_query($query_Recap, $sc) or die(mysql_error());
					$row_Recap = mysql_fetch_assoc($Recap);
					$totalRows_Recap = mysql_num_rows($Recap);
					?><tr class="integral-tr">
						<td><?php echo $ss; $ss--;?></td>
						<td>
							<ul>
								<li> <span><?php echo $row_Recoc['date'];?></span> </li>
								<li><span><?php echo $row_Recoc['time'];?></span></li>
							</ul>
						</td>
						<td align="center"><img src="http://lifelink.cc/wp-content/themes/the-rex/custom/img/<? echo $row_Recap['pic'];?>" alt="store" width="45"></td>
						<td>
							<ul>
								<li> <span>帳:<?php echo $row_Recoc['m_username'];?></span> </li>
								<li><span>名:<?php echo $row_Recoc['m_nick'];?></span></li>
							</ul>
						</td>
						<td align="center"><span><?php $us2=$row_Recoc['m_username'];mysql_select_db($database_sc, $sc);
							$query_Recfb2 = sprintf("SELECT * FROM memberdata WHERE fname = '$us2'");//
							$Recfb2 = mysql_query($query_Recfb2, $sc) or die(mysql_error());
							$row_Recfb2 = mysql_fetch_assoc($Recfb2);
							$totalRows_Recfb2 = mysql_num_rows($Recfb2);echo $totalRows_Recfb2;?></span>
						</td>
						<td align="center"><span><?php $fb3_total=0;
						  if ($totalRows_Recfb2 != 0) {
							  do {$us3=$row_Recfb2['m_username'];
								  mysql_select_db($database_sc, $sc);
								  $query_Recfb3 = sprintf("SELECT * FROM memberdata WHERE fname = '$us3'");//
								  $Recfb3 = mysql_query($query_Recfb3, $sc) or die(mysql_error());
								  $row_Recfb3 = mysql_fetch_assoc($Recfb3);
								  $totalRows_Recfb3 = mysql_num_rows($Recfb3);
								  $fb3_total=$fb3_total+$totalRows_Recfb3;
								  } while ($row_Recfb2 = mysql_fetch_assoc($Recfb2));
						  }
						  echo $fb3_total;?></span>
						</td>
					</tr><?php 
				}
			} else {echo "無資料";}?>
        </tbody>
    </table>
	<DIV class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php 
			$pagecount = floor($fmu_total/10)+1;
			$page = $_GET['pageNum_Recoc'] < 0 || $_GET['pageNum_Recoc'] > $pagecount ? 0 : $_GET['pageNum_Recoc'];
			$pageNum = $page > $pagecount-5 ? $pagecount : ($page+1)+5;
			$pageNum2 = $page < 5 ? 1 : ($page+1)-5;
			$previous  = $page<= 0 ? 0 : $page-1;
			$next = $page >= $pagecount-1 ? $pagecount-1 :$page+1;

			echo "<a href='fan_management_1.php?pageNum_Recoc=".$previous."'>上一頁</a>";
			for($i=$pageNum2 ;$i<=$pageNum;$i++)
			{
				if($i == $page+1)
				{
					echo "[ <a href='fan_management_1.php?pageNum_Recoc=".($i-1)."'>$i</a> ]";
				}else{
					echo " <a href='fan_management_1.php?pageNum_Recoc=".($i-1)."'>$i</a>" ;
				}
			}
			echo "<a href='fan_management_1.php?pageNum_Recoc=".$next."'>下一頁</a>";
		?>
	</DIV>
  </div></form>
    </div>
</div>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
