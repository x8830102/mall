
<nav class="navbar navbar-default visible-xs navbar-fixed-top top-nav-collapse">
        
            <div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
                <div class="side-bar hidden-lg hidden-md hidden-sm">
                    <ul>
                        <li><span style="color: #fff;font-size: 15px">登入時間：<?php echo date("Y-m-d H:i:s");?></span></li>
                        <li class="b-bar">客戶資料</li>
                        <li>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td style="border-top: 0px">系統ID</td>
                                        <td style="border-top: 0px" align="right"><?php echo $card;?></td>
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
                                        <td>名稱或暱稱</td>
                                        <td align="right"><?php echo $nick;?></td>
                                    </tr>
                                    <tr>
                                        <td>商品名稱</td>
                                        <td align="right"><?php echo $row_Rect['name'];?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                        <li>
                            <button type="button" style="background: #555192"><a href="#" style="color:#fff">線上註冊</a></button>
                            <button type="button" style="background: #128289;margin-left: 6px"><a href="#" style="color:#fff">寶物兌換</a></button>
                        </li>
                        <li>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td style="border-top: 0px">註冊積分</td>
                                        <td style="border-top: 0px" align="right"><?php echo number_format($row_Recoc['csum'], 0, '.' ,',');?></td>
                                    </tr>
                                    <tr>
                                        <td>紅利積分</td>
                                        <td align="right"><?php echo number_format($row_Recrc['csum'], 0, '.' ,',');?></td>
                                    </tr>
                                    <tr>
                                        <td>購物積分</td>
                                        <td align="right"><?php echo number_format($row_Recgc['csum'], 0, '.' ,',');?></td>
                                    </tr>
                                    <tr>
                                        <td>串串積分</td>
                                        <td align="right"><?php echo number_format($row_Reccc['csum'], 0, '.' ,',');?></td>
                                    </tr>
                                    <tr>
                                        <td>集滿卡數</td>
                                        <td align="right"><?php echo $totalRows_Recfd2;?></td>
                                    </tr> 
                                    <tr>
                                        
                                        <td colspan="2"><form method="get" action="fd-main.php" target="_top">
                                        福袋樹明細<br/><select name="fd_c" id="fd_c" style="width: 135px; margin-left: 2px" onChange="submit();">
<option value="" selected="selected">請選擇</option>
<?php do {?><option value="<?php echo $row_Recfd3['card'];?>"><?php if ($row_Recfd3['at'] == 1) {echo "[v] ";};echo $row_Recfd3['card'];?></option><?php } while ($row_Recfd3 = mysql_fetch_assoc($Recfd3));?>
                            </select></form></td>
                                    </tr> 
                                </tbody>
                            </table>
                        </li>
                        <li><span style="color: #ab9777;">購買人數競賽</span></li>
                        <li>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="width: 125px; height: 110px; ">
                                               
                                                <div style="margin-top: 5px; margin-left: 10px">
                                                    <div class="circle"></div>
                                                    <div class="circle_min"></div>
                                                    <div class="circle_m_m"></div>
                                                    <span style="position: relative;top: -35px;left: 20px">35/1K</span>
                                                </div>
                                                <div align="center"> <span style="color: #ab9777;font-size:14px">新人購買</span></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="width: 125px; height: 110px; ">
                                                
                                                <div style="margin-top: 5px; margin-left: 10px">
                                                    <div class="circle"></div>
                                                    <div class="circle_min"></div>
                                                    <div class="circle_m_m"></div>
                                                    <span style="position: relative;top: -35px;left: 20px">35/1K</span>
                                                </div>
                                                <div  align="center"><span style="color: #ab9777;font-size:14px">拆福袋數</span></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                        <li style="border-bottom:1px dashed #ab9777"></li>
                        <li><span style="color: #ab9777;">粉絲人數競賽</span></li>
                        <li>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="width: 125px; height: 110px; ">
                                                
                                                <div style="margin-top: 5px; margin-left: 10px">
                                                    <div class="circle"></div>
                                                    <div class="circle_min"></div>
                                                    <div class="circle_m_m"></div>
                                                    <span style="position: relative;top: -35px;left: 20px">35/1K</span>
                                                </div>
                                                <div align="center"><span style="color: #ab9777;font-size:14px">直接粉絲數</span></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="width: 125px; height: 110px; ">
                                                
                                                <div style="margin-top: 5px; margin-left: 10px">
                                                    <div class="circle"></div>
                                                    <div class="circle_min"></div>
                                                    <div class="circle_m_m"></div>
                                                    <span style="position: relative;top: -35px;left: 20px">35/1K</span>
                                                </div>
                                                <div align="center"><span style="color: #ab9777;font-size:14px">間接粉絲數</span></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                        <li class="b-bar">最新公告</li>
                        <li>
                            <div class="new-t">◆至年底前，直接分享好友使用本系統人數達100位者送紅利積分2000點，3代關係團體數達1000位者另贈1.000點。</div>
                            <div class="new-t">◆至年底前，直接分享好友使用本系統人數達100位者送紅利積分2000點，3代關係團體數達1000位者另贈1.000點。</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!--↑↑↑↑↑↑↑↑
                phone 
                                ↑↑↑↑↑↑↑↑ -->
    <!--↓↓↓↓↓↓↓↓↓↓
                Desktop 
                                ↓↓↓↓↓↓↓↓↓↓ -->
    
<div class="col-lg-2 col-md-4 col-sm-4">
        <div class="side-bar hidden-xs ">
            <ul>
                <li style="margin-top: 0" class="b-bar">客戶資料</li>
                <li>
      <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td style="border-top: 0px">系統ID</td>
                                <td style="border-top: 0px" align="right">16080010</td>
                            </tr>
                            <tr>
                                <td>登入帳號</td>
                                <td align="right">0971129588</td>
                            </tr>
                            <tr>
                                <td>購買日期</td>
                                <td align="right">2016/8/25</td>
                            </tr>
                            <tr>
                                <td>名稱或暱稱</td>
                                <td align="right">碳佐麻里</td>
                            </tr>
                            <tr>
                                <td>商品名稱</td>
                                <td align="right">實體店面</td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li>
                    <button type="button" style="background: #555192"><a href="#" style="color:#fff">線上註冊</a></button>
                    <button type="button" style="background: #128289;margin-left: 6px"><a href="#" style="color:#fff">寶物兌換</a></button>
                </li>
                <li>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td style="border-top: 0px">註冊積分</td>
                                <td style="border-top: 0px" align="right">1,996,049,000
                                </td>
                            </tr>
                            <tr>
                                <td>紅利積分</td>
                                <td align="right">200,000,000
                                </td>
                            </tr>
                            <tr>
                                <td>購物積分</td>
                                <td align="right">66,000</td>
                            </tr>
                            <tr>
                                <td>串串積分</td>
                                <td align="right">7,801,440</td>
                            </tr>
                                    <tr>
                                        <td>集滿卡數</td>
                                        <td align="right">9</td>
                                    </tr> 
                                    <tr>
                                        <td colspan="2">福袋樹明細<br><select name="pudid" id="pudidss" style="width: 135px; margin-left: 2px">
                                <option value="2"></option>
                                <option value="3"></option>
                                <option value="4"></option>
                                <option value="5"></option>
                            </select></td>
                                       
                                    </tr> 
                        </tbody>
                    </table>
                </li>

                <li><span style="color: #ab9777;">購買人數競賽</span></li>
                <li>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <div style="width: 125px; height: 110px; ">
                                        
                                        <div style="margin-top: 5px; margin-left: 10px">
                                            <div class="circle"></div>
                                            <div class="circle_min"></div>
                                            <div class="circle_m_m"></div>
                                            <span style="position: relative;top: -35px;left: 20px">35/1K</span>
                                        </div>
                                        <div align="center"><span style="color: #ab9777;font-size:14px">新人購買</span></div>
                                    </div>
                                </td>
                                <td>
                                    <div style="width: 125px; height: 110px; ">
                                        
                                        <div style="margin-top: 5px; margin-left: 10px">
                                            <div class="circle"></div>
                                            <div class="circle_min"></div>
                                            <div class="circle_m_m"></div>
                                            <span style="position: relative;top: -35px;left: 20px">35/1K</span>
                                        </div>
                                        <div align="center"><span style="color: #ab9777;font-size:14px">拆福袋數</span></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li style="border-bottom:1px dashed #ab9777"></li>
                <li ><span style="color: #ab9777;">粉絲人數競賽</span></li>
                <li>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <div style="width: 125px; height: 110px; ">
                                        
                                        <div style="margin-top: 5px; margin-left: 10px">
                                            <div class="circle"></div>
                                            <div class="circle_min"></div>
                                            <div class="circle_m_m"></div>
                                            <span style="position: relative;top: -35px;left: 20px">35/1K</span>
                                        </div>
                                        <div align="center"><span style="color: #ab9777;font-size:14px">直接粉絲數</span></div>
                                    </div>
                                </td>
                                <td>
                                    <div style="width: 125px; height: 110px; ">
                                      
                                        <div style="margin-top: 5px; margin-left: 10px">
                                            <div class="circle"></div>
                                            <div class="circle_min"></div>
                                            <div class="circle_m_m"></div>
                                            <span style="position: relative;top: -35px;left: 20px">35/1K</span>
                                        </div>
                                        <div align="center">  <span style="color: #ab9777;font-size:14px">間接粉絲數</span></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li class="b-bar">最新公告</li>
                <li>
                    <div class="new-t">◆至年底前，直接分享好友使用本系統人數達100位者送紅利積分2000點，3代關係團體數達1000位者另贈1.000點。</div>
                    <div class="new-t">◆至年底前，直接分享好友使用本系統人數達100位者送紅利積分2000點，3代關係團體數達1000位者另贈1.000點。</div>
                </li>
            </ul>
        </div>
    </div>