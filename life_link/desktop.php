<?
//type
$type=$row_Recsn['a_pud'];
mysql_select_db($database_sc, $sc);
$query_Rect = sprintf("SELECT * FROM a_pud WHERE id = $type");//
$Rect = mysql_query($query_Rect, $sc) or die(mysql_error());
$row_Rect = mysql_fetch_assoc($Rect);
$totalRows_Rect = mysql_num_rows($Rect);
//oc-
mysql_select_db($database_sc, $sc);
$query_Recoc = sprintf("SELECT * FROM o_cash WHERE number = '$sn' ORDER BY id DESC");
$Recoc = mysql_query($query_Recoc, $sc) or die(mysql_error());
$row_Recoc = mysql_fetch_assoc($Recoc);
$totalRows_Recoc = mysql_num_rows($Recoc);
//cc-
mysql_select_db($database_sc, $sc);
$query_Reccc = sprintf("SELECT * FROM c_cash WHERE number = '$sn' ORDER BY id DESC");
$Reccc = mysql_query($query_Reccc, $sc) or die(mysql_error());
$row_Reccc = mysql_fetch_assoc($Reccc);
$totalRows_Reccc = mysql_num_rows($Reccc);
//gc-
mysql_select_db($database_sc, $sc);
$query_Recgc = sprintf("SELECT * FROM g_cash WHERE number = '$sn' ORDER BY id DESC");
$Recgc = mysql_query($query_Recgc, $sc) or die(mysql_error());
$row_Recgc = mysql_fetch_assoc($Recgc);
$totalRows_Recgc = mysql_num_rows($Recgc);
//rc-
mysql_select_db($database_sc, $sc);
$query_Recrc = sprintf("SELECT * FROM r_cash WHERE number = '$sn' ORDER BY id DESC");
$Recrc = mysql_query($query_Recrc, $sc) or die(mysql_error());
$row_Recrc = mysql_fetch_assoc($Recrc);
$totalRows_Recrc = mysql_num_rows($Recrc);
//
mysql_select_db($database_sc, $sc);
$query_Recfd = sprintf("SELECT * FROM fd WHERE number = '$sn'  ORDER BY card DESC");
$Recfd = mysql_query($query_Recfd, $sc) or die(mysql_error());
$row_Recfd = mysql_fetch_assoc($Recfd);
$totalRows_Recfd = mysql_num_rows($Recfd);
//
mysql_select_db($database_sc, $sc);
$query_Recfd2 = sprintf("SELECT * FROM fd WHERE number = '$sn' && at=1");
$Recfd2 = mysql_query($query_Recfd2, $sc) or die(mysql_error());
$row_Recfd2 = mysql_fetch_assoc($Recfd2);
$totalRows_Recfd2 = mysql_num_rows($Recfd2);
//
mysql_select_db($database_sc, $sc);
$query_Recfd3 = sprintf("SELECT * FROM fd WHERE number = '$sn'  ORDER BY card DESC");
$Recfd3 = mysql_query($query_Recfd3, $sc) or die(mysql_error());
$row_Recfd3 = mysql_fetch_assoc($Recfd3);
$totalRows_Recfd3 = mysql_num_rows($Recfd3);
//
mysql_select_db($database_sc, $sc);$lag="cht";//WHERE lag='$lag'
$query_Recnews = sprintf("SELECT * FROM newsdata  ORDER BY news_id DESC");
$Recnews = mysql_query($query_Recnews, $sc) or die(mysql_error());
$row_Recnews = mysql_fetch_assoc($Recnews);
$totalRows_Recnews = mysql_num_rows($Recnews);
//
mysql_select_db($database_sc, $sc);
$query_Recli = sprintf("SELECT * FROM gold_m WHERE number='$sn' && at=0");
$Recli = mysql_query($query_Recli, $sc) or die(mysql_error());
$row_Recli = mysql_fetch_assoc($Recli);
$totalRows_Recli = mysql_num_rows($Recli);
$tli=$totalRows_Recli;//echo $tli;
$li_total=0;
do {$li_total=$li_total+$row_Recli['g'];} while ($row_Recli = mysql_fetch_assoc($Recli));
//
mysql_select_db($database_sc, $sc);
$query_Recgm = sprintf("SELECT * FROM gold_m WHERE number = '$sn' && at=0");
$Recgm = mysql_query($query_Recgm, $sc) or die(mysql_error());
$row_Recgm = mysql_fetch_assoc($Recgm);
$totalRows_Recgm = mysql_num_rows($Recgm);
//six post
mysql_select_db($database_sc, $sc);
$query_Recmemp = sprintf("SELECT * FROM memberdata WHERE m_fuser = '$sn' && a_pud >= 4");
$Recmemp = mysql_query($query_Recmemp, $sc) or die(mysql_error());
$row_Recmemp = mysql_fetch_assoc($Recmemp);
$totalRows_Recmemp = mysql_num_rows($Recmemp);
//
mysql_select_db($database_sc, $sc);
$query_Rece = sprintf("SELECT * FROM pay_e ORDER BY id DESC");
$Rece = mysql_query($query_Rece, $sc) or die(mysql_error());
$row_Rece = mysql_fetch_assoc($Rece);
$totalRows_Rece = mysql_num_rows($Rece);
$query = $pdo_cmg->query("SELECT * FROM pay_cf ORDER BY id DESC");
$result_cf = $query->fetch();

?>
<div class="member-bar hidden-xs">
        <ul class="drop-down-menu">
            <li class="login-t hidden-xs"> <span>登入時間：<?php echo date("Y-m-d H:i:s");?></span></li>
            <li class="col-lg-6 col-md-4 col-sm-3 col-xs-4"></li>
            <li class="member-info"><span  style="margin-right: 2px;"><img src="img/coin-1.png" width="14px" alt=""><?php echo number_format($li_total, 0, '.' ,',');?></span></li>
            <li class="member-info"><?php echo $username;?> 您好</li>
            <li class="member-info"> <a href="logout.php">會員登出</a></li>
        </ul>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4">
        <div class="side-bar hidden-xs ">
            <table class=" table ld" style="margin-bottom: 8px">
                <tr>
                    <td style="border-top: 0px;color: #C98C9C;font-size: 13px"><img src="img/love-01.png" width="13px" style="margin-top: -2px" alt=""> 累積愛心公益基金</td>
                    <td  style="border-top: 0px;color: #C98C9C;font-size: 13px" align="right"><?php echo number_format($row_Rece['psum'], 0, '.' ,',');?></td>
                </tr>
				<tr>
                    <td style="border-top: 0px;color: #C98C9C;font-size: 13px"><img src="img/love2-01.png" width="13px" style="margin-top: -2px" alt=""> 累計公益希望基金</td>
                    <td  style="border-top: 0px;color: #C98C9C;font-size: 13px" align="right"><?php echo number_format($result_cf['psum'], 0, '.' ,',');?></td>
                </tr>
            </table>

            <ul>
                <li style="margin-top: 0" class="b-bar">客戶資料</li>
                <li>
                  <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td style="border-top: 0px">暱稱</td>
                        <td style="border-top: 0px" align="right"><?php echo $nick;?></td>
                      </tr>
                      <tr>
                        <td>登入帳號</td>
                        <td align="right"><?php echo $username;?></td>
                      </tr>
                      <tr>
                        <td>啟用日期</td>
                        <td align="right"><?php echo $row_Recsn['m_joinDate'];?></td>
                      </tr>
                      <tr>
                        <td>帳號期限</td>
                        <td align="right"><?php $date =$row_Recsn['date']; $ed = date("Y-m-d",strtotime("$date +1 year +10 Day")); echo $ed;?></td>
                      </tr>
                      <tr>
                        <td>商品名稱</td>
                        <td align="right"><?php echo $row_Rect['name'];?></td>
                      </tr>
                    </tbody>
                  </table>
                </li>
                <li>
                    <?php if ($a_pud >= 2) {?><button type="button" class="sidebtn01"><a href="new_account-1.php" style="color:#fff">線上註冊</a></button><? }?>
                    <?php if ($a_pud >=4 ) {?><button type="button" class="sidebtn02"><a href="new_account-4.php" style="color:#fff">兌換福袋</a></button><? } else {?><button type="button" class="sidebtn02" style="background: #eee;color: #fff;cursor:no-drop">兌換福袋</button><? }?>
                </li>
                <li>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td >註冊積分</td>
                                <td align="right"><?php echo number_format($row_Recoc['csum'], 0, '.' ,',');?></td>
                            </tr>
                            <tr>
                                <td>紅利積分</td>
                                <td align="right"><?php echo number_format($row_Recrc['csum'], 0, '.' ,',');?></td>
                            </tr>
                            <tr>
                                <td>消費積分</td>
                                <td align="right"><?php echo number_format($row_Recgc['csum'], 0, '.' ,',');?></td>
                            </tr>
                            <tr>
                                <td>串串積分</td>
                                <td align="right"><?php echo number_format($row_Reccc['csum'], 0, '.' ,',');?></td>
                            </tr>
                            <?php /*if ($a_pud >= 6) {?><tr>
                              <td>分紅累計</td>
                              <td align="right"><?php echo $row_Recsn['allsum'];?></td>
                            </tr><? }?>
                            <?php */if ($a_pud >= 5) {?><tr>
                                <td>集滿卡數</td>
                                <td align="right"><?php echo $totalRows_Recfd2;?></td>
                            </tr>
                            <!--<tr>
                                <td>系統分享</td>
                                <td align="right"><?php //echo $row_Recsn['f_tog'];?> / 2</td>
                            </tr>-->
                            <tr>
                                <td>集點卡明細</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border:0px;">
                                    <form method="get" action="new_account-4.php" target="_top">
                                        <select name="fd_c" id="fd_c" style="width: 100%; margin-left: 2px" onChange="submit();">
<option value="" selected="selected">請選擇</option>
<?php do {?><option value="<?php echo $row_Recfd3['card'];?>"><?php if ($row_Recfd3['at'] == 1) {echo "✔&nbsp;";} else {echo "&nbsp;&nbsp;&nbsp;";};echo $row_Recfd3['card'],"&nbsp;&nbsp;&nbsp;";?><?php $p_total=0;
$tt_us=$row_Recfd3['card'];
mysql_select_db($database_sc, $sc);
$query_Recg = sprintf("SELECT * FROM fd WHERE c_guser = '$tt_us'");
$Recg = mysql_query($query_Recg, $sc) or die(mysql_error());
$row_Recg = mysql_fetch_assoc($Recg);
$totalRows_Recg = mysql_num_rows($Recg);$p_total=$p_total+$totalRows_Recg;
if ($totalRows_Recg != 0) {
	do {$gusa=$row_Recg['card'];
	mysql_select_db($database_sc, $sc);
    $query_Recg2 = sprintf("SELECT * FROM fd WHERE c_guser = '$gusa'");
    $Recg2 = mysql_query($query_Recg2, $sc) or die(mysql_error());
    $row_Recg2 = mysql_fetch_assoc($Recg2);
    $totalRows_Recg2 = mysql_num_rows($Recg2);
	if ($totalRows_Recg2 != 0) {$p_total=$p_total+$totalRows_Recg2;}
	} while ($row_Recg = mysql_fetch_assoc($Recg));
	}
echo $p_total;?> / 6</option><?php } while ($row_Recfd3 = mysql_fetch_assoc($Recfd3));?>
                            </select></form>
                                </td>
                            </tr><? }?>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
          </li>
                            <?php if ($a_pud >= 3) {?><table width="100%" >
                                <tbody>
                                    <tr class="circle_table" align="center">
                                        <td  style="border-top: 0px; padding: 6px;color: #fff; line-height: 12px;border-radius: 20px">推廣大放送</td>
                                    </tr>
                                    <tr align="center">
                                        <td style="color:#04469b;margin-top: 3px "><?php if ($totalRows_Recmemp < 6) {?>差 <?php echo 6-$totalRows_Recmemp;?> 人就可領獎唷<?php } else {echo "達成領獎";}?></td>
                                    </tr>   
                                </tbody>
                            </table>
                            <table style="margin-bottom: 20px; margin-top: 10px;">
                                <tbody>
                                    <tr>
                                        <td colspan="2" width="227px" height="160px" align="center">
                                        <div class="set_point">
                                            <div id="triangle-2" class="triangle-2" style="border-top: 80px solid #<?php if ($totalRows_Recmemp >= 1) {echo "ff4553";} else {echo "dedddd";}?>"></div>
                                            <div id="triangle-1" class="triangle-1" style="border-bottom: 80px solid #<?php if ($totalRows_Recmemp >= 2) {echo "9389d1";} else {echo "dedddd";}?>"> </div>
                                            <div id="triangle-6" class="triangle-6" style="border-top: 80px solid #<?php if ($totalRows_Recmemp >= 3) {echo "00c9dd";} else {echo "dedddd";}?>"> </div>
                                            <div id="triangle-5" class="triangle-5" style="border-bottom: 80px solid #<?php if ($totalRows_Recmemp >= 4) {echo "9fcc00";} else {echo "dedddd";}?>;"></div>
                                            <div id="triangle-4" class="triangle-4" style="border-top: 80px solid #<?php if ($totalRows_Recmemp >= 5) {echo "ffc44f";} else {echo "dedddd";}?>"> </div>
                                            <div id="triangle-3" class="triangle-3" style="border-bottom: 80px solid #<?php if ($totalRows_Recmemp >= 6) {echo "ff6b33";} else {echo "dedddd";}?>"> </div>
                                        </div>  
                                            
                                         
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="prompt">                         
                            <span style="background: #04469b; border-radius: 5px;width: 5px;height: 5px;color: #fff">&nbsp!&nbsp</span>推薦6人使用致富家專案送平板電腦<br/>獎勵期間：即日起至2017-04-30
                            </div>
                    <table class="table" style="">
                        <tbody>

                            <tr>
                                <td colspan="2"></td>
                            </tr>
                            <tr align="center">
                                <td class="circle_table" style="border:0px;color: #fff;border-radius: 10px;padding: 1px">累積再贈送</td>
                                <td rowspan="3" style="text-align: center;border:0px;"><img height="100%" src="img/silver.png"></td>
                            </tr>
                            <tr>
                                <td style="border: 0px;">目前累積人數：</td>
                            </tr>
                            <tr>
                                <td style="border: 0px;height: 28px">123人</td>
                            </tr>

                        </tbody>
                    </table><? }?>

                <!--<li class="b-bar "><a href="#">操作手冊</a>
            </li>-->
                <li class="b-bar">最新公告</li>
                <li>
                    
                    <?php $nsi=2;do {if ($nsi == 0) {break;}?><div class="new-t">◆<a href="new.php?news_id=<?php echo $row_Recnews['news_id']; ?>"><?php echo $row_Recnews['news_content'];?></a></div><?php $nsi--;} while ($row_Recnews = mysql_fetch_assoc($Recnews));?>
                  <div class="new-t">◆更多訊息.....</div>
                    <?php /*if ($totalRows_Recgm != 0) {?>
<iframe width="0" height="0" src="http://lifelink.cc/mus.mp3" frameborder="0" allowfullscreen></iframe><audio controls="controls" height="30" width="30" style="visibility: hidden;">
  <source src="http://lifelink.cc/mus.mp3" type="audio/mp3" /><source src="http://lifelink.cc/mus.ogg" type="audio/ogg" /><embed height="30" width="30" src="http://lifelink.cc/mus.mp3" /></audio><? }*/?>
                </li>
            </ul>
        </div>
    </div>
