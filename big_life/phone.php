    <nav class="navbar navbar-default visible-xs navbar-fixed-top top-nav-collapse">
        <div class="container-fluid col-xs-12">
            <div class=" navbar-default navbar-fixed-top" align="">
                <div class="navbar-header">
                    <div class="col-xs-12 xs-top-img">
                        <img src="img/life-link_logo.png" width="180px" alt="串門子雲端">
                    </div>
                    <button type="botton" class="navbar-toggle " data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" style="margin-left:15px;top: -90px ">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="member-bar" style="margin-top: -61px">
                        <ul class="drop-down-menu">
                            <li class="login-t hidden-xs"> <span>登入時間： <?php echo date("Y-m-d H:i:s");?></span></li>
                            <li class="col-lg-7 col-md-6 col-sm-4 col-xs-3"></li>
                            <li class="member-info "><a href="#">操作手冊<span class="icon-a"></span></a>
                                <ul>
                                    <li> <a href="#">操作手冊</a></li>
                                    <li> <a href="#">操作手冊</a></li>
                                    <li> <a href="#">操作手冊</a></li>
                                </ul>
                            </li>
                            <li class="member-info"><span class="icon-b" style="margin-right: 2px;">0</span></li>
                            <li class="member-info"><span class="icon-a"><a href="member_profile01.php"><?php echo $nick;?> 您好</a></span>
                                <ul>
                                    <li> <a href="index.php">會員中心</a></li>
                                    <li> <a href="logout.php">會員登出</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
                <div class="side-bar hidden-lg hidden-md hidden-sm">
                    <ul>
                        <li><span style="color: #fff;font-size: 15px">登入時間：<br>2016-07-22 09:12:50</span></li>
                        <li class="b-bar">客戶資料</li>
                        <li>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td style="border-top: 0px">使用者名</td>
                                        <td style="border-top: 0px" align="right"><?php echo $nick;?></td>
                                    </tr>
                                    <tr>
                                        <td>登入帳號</td>
                                        <td align="right"><?php echo $username;?></td>
                                    </tr>
                                    <tr>
                                        <td>購買日期</td>
                                        <td align="right"><?php echo $row_Recsn['date'];?></td>
                                    </tr>
                                    <tr>
                                        <td>帳號期限</td>
                                        <td align="right"><?php echo ($row_Recsn['year']+1),"-",$row_Recsn['moom'],"-",$row_Recsn['day'];?></td>
                                    </tr>
                                    <tr>
                                        <td>商品名稱</td>
                                        <td align="right"><?php echo $row_Rect['name'];?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                        <li>
                            <?php if ($a_pud >= 2) {?><button type="button" class="sidebtn01"><a href="new_account-1.php" style="color:#fff">線上註冊</a></button><?php }?>
                            <?php if ($a_pud >= 3) {?><button type="button" class="sidebtn02"><a href="new_account-4.php" style="color:#fff">兌換福袋</a></button><?php }?>
                        </li>
                        <li>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td style="border-top: 0px">註冊積分</td>
                                        <td style="border-top: 0px" align="right"><?php echo number_format($row_Recoc['csum'], 0, '.' ,',');?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>紅利積分</td>
                                        <td align="right"><?php echo number_format($row_Recrc['csum'], 0, '.' ,',');?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>購物積分</td>
                                        <td align="right"><?php echo number_format($row_Recgc['csum'], 0, '.' ,',');?></td>
                                    </tr>
                                    <tr>
                                        <td>串串積分</td>
                                        <td align="right"><?php echo number_format($row_Reccc['csum'], 0, '.' ,',');?></td>
                                    </tr>
                                    <?php if ($a_pud >= 6) {?><tr>
                              <td style="color: #F00">獲利計分</td>
                              <td align="right" style="color: #F00"><?php echo number_format($row_Recsn['allsum'], 0, '.' ,',');?> / 40萬</td>
                            </tr><? }?>
                                    <tr>
                                        <td>集滿卡數</td>
                                        <td align="right"><?php echo $totalRows_Recfd2;?></td>
                                    </tr> 
                                    <tr>
                                        <td>寶物明細</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border:0px;"><form method="get" action="new_account-4.php" target="_top">
                                        <select name="fd_c" id="fd_c"  style="width: 100%;font-size: 15px;height: 21px;" onChange="submit();">
<option value="" selected="selected">請選擇</option>
<?php do {?><option value="<?php echo $row_Recfd['card'];?>"><?php if ($row_Recfd['at'] == 1) {echo "✔&nbsp;";} else {echo "&nbsp;&nbsp;&nbsp;";};echo $row_Recfd['card'];?></option><?php } while ($row_Recfd = mysql_fetch_assoc($Recfd));?>
                            </select></form>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>紅利福利</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="box-shadow" style="border:0px">
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 50%;"></div>
                                        </div>
                                        <span style="margin-left: 50px;">8,899/600,000</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                            <table class="circle_table">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="border-top: 0px; padding: 6px;color: #fff; line-height: 12px;">推廣大放送:差一人就可領獎唷</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="margin-bottom: 20px; margin-top: 10px;">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div style="width: 120px; height: 125px;">
                                                <div style="margin-top: 5px; margin-left: 50px">
                                                    <div class="table_circle"></div>
                                                    <div class="circle1"></div>
                                                    <div class="circle2"></div>
                                                    <div class="circle3"></div>
                                                    <div class="circle4"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>累積再贈送</td>
                                        <td rowspan="3" style="text-align: right;"><img align="center" style="height: 100%;" src="img/gold.png"></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; width: 120px;">目前累積人數：</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0px;">123人</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                    </tr>
                                </tbody>
                            </table>
                        <li class="b-bar">最新公告</li>
                        <li>
                            <div class="new-t">◆自註冊日起30天內，凡推廣水晶方案系列4組以上並註冊成功，即贈Apple ipd乙台。</div>
                            <div class="new-t">◆競賽加碼送：自即日起累計至2016年底，推廣累積人數前3名者，加碼贈送Apple筆電乙台。</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>