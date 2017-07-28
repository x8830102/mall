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
if ($a_pud < 2) {header(sprintf("Location: index.php"));exit;}
//

//test
$passtoo=$_GET['passtoo'];$fuser=$_GET['fuser'];$pudid=$_GET['pudid'];$newuser=strtolower(trim($_GET['newuser']));//echo $newuser;
if ($_GET['sim'] != 1) {
if ($_GET['see'] != $_GET['sum']) {header(sprintf("Location: new_account-1.php?err=驗證碼錯誤&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid));exit;}
}

//
if ($_GET['sim'] != 1) {
mysql_select_db($database_sc, $sc);
$query_Recs = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_passtoo='$passtoo'");
$Recs = mysql_query($query_Recs, $sc) or die(mysql_error());
$row_Recs = mysql_fetch_assoc($Recs);
$totalRows_Recs = mysql_num_rows($Recs);
if ($totalRows_Recs == 0) {header(sprintf("Location: new_account-1.php?err=我的二級密碼錯誤&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid));exit;}
}
//

mysql_select_db($database_sc, $sc);
$query_Recm = sprintf("SELECT * FROM memberdata WHERE m_username = '$fuser' && m_ok=1");
$Recm = mysql_query($query_Recm, $sc) or die(mysql_error());
$row_Recm = mysql_fetch_assoc($Recm);
$totalRows_Recm = mysql_num_rows($Recm);
if ($totalRows_Recm == 0) {header(sprintf("Location: new_account-1.php?err=此介紹人帳號錯誤&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid));exit;}
$fnumber=$row_Recm['number'];
//
if ($newuser && !preg_match ("/^[a-z0-9]+$/i", $newuser)) {header(sprintf("Location: new_account-1.php?err=此購買者帳號輸入格式只能是英文或數字&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid));exit;}
if ($newuser != "") {
mysql_select_db($database_sc, $sc);
$query_Recmn = sprintf("SELECT * FROM memberdata WHERE m_username = '$newuser' && m_ok=1");
$Recmn = mysql_query($query_Recmn, $sc) or die(mysql_error());
$row_Recmn = mysql_fetch_assoc($Recmn);
$totalRows_Recmn = mysql_num_rows($Recmn);
if ($totalRows_Recmn != 0) {header(sprintf("Location: new_account-1.php?err=已有此購買者帳號&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid));exit;}
} else {header(sprintf("Location: new_account-1.php?err=此購買者帳號輸入格式只能是英文或數字&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid));exit;}
//

mysql_select_db($database_sc, $sc);
$query_Recgd3 = sprintf("SELECT * FROM a_pud WHERE id=$pudid");// ORDER BY p DESC
$Recgd3 = mysql_query($query_Recgd3, $sc) or die(mysql_error());
$row_Recgd3 = mysql_fetch_assoc($Recgd3);
$totalRows_Recgd3 = mysql_num_rows($Recgd3);
$pud_p=$row_Recgd3['p'];
//oc
mysql_select_db($database_sc, $sc);
$query_Recoc = sprintf("SELECT * FROM o_cash WHERE number = '$sn' ORDER BY id DESC");
$Recoc = mysql_query($query_Recoc, $sc) or die(mysql_error());
$row_Recoc = mysql_fetch_assoc($Recoc);
$totalRows_Recoc = mysql_num_rows($Recoc);
if ($row_Recoc['csum'] < $pud_p) {header(sprintf("Location: new_account-1.php?err=我的註冊積分不足&fuser=".$fuser."&newuser=".$newuser."&pudid=".$pudid));exit;}
//
$i = 6;$pd[0] = 0;	$sum = "";
while ($i != 0) {$md = rand(0, 9);if (in_array($md, $pd) == false) {$pd[$i] = $md;$i--;}}
$j = 6;while ($j != 0) {$sum = $sum.(int)$pd[$j];$j--;}
//
mysql_select_db($database_sc, $sc);
$query_Recb = sprintf("SELECT * FROM b_pud ORDER BY id");// DESC
$Recb = mysql_query($query_Recb, $sc) or die(mysql_error());
$row_Recb = mysql_fetch_assoc($Recb);
$totalRows_Recb = mysql_num_rows($Recb);
//
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
        body{
            font-family:"verdana","微軟正黑體" ; font-weight:400;
        }
    .v2 {font-size:20px;
	text-align:left;
	border:1px solid #ADADAD;
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
        <li class="col-lg-3 col-md-3 col-xs-3">
            <ul class="cut-line_active">
                <li class="cust-but"><a href="new_account-1.php"><span class="icon-f hidden-xs " style="margin-right: 5px"></span><span >系統註冊</span></a></li>
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
                <li class="cust-but"><a href="fan_management_1.php"><span class="icon-e hidden-xs" style="margin-right: 5px"></span><span>粉絲管理</span></a></li>
                <li></li>
            </ul>
        </li>
    </ul>
    <div class="cut-navbar-menu col-lg-12 col-xs-12">
        <ul>
            <li class="active"> <a href="#"><span>註冊新帳戶</span></a> </li>
        </ul>
    </div>
    <div class="menu col-lg-11 col-xs-11" align="center">
        <div style=" border: 1px solid #b6c9d9">
            <div class="menu-text col-lg-12 col-md-12 col-xs-12">註冊新帳戶</div>
            <form id="form1" name="form1" method="post" action="x_form.php">
            <table align="center" cellpadding="10" cellspacing="3" class="menu-table" style="margin: 50px auto 30px ">
                <tbody>
                    <tr class="menu-tr">
                      <td colspan="2" align="center"><span style="color: #F00"><?php echo $_GET['err'];?></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">設定登入帳號</td>
                        <td>
                            <span><?php echo $newuser;?></span>
                        <input name="newuser" type="hidden" id="newuser" value="<?php echo $newuser;?>" />
                        <input name="fuser" type="hidden" id="fuser" value="<?php echo $fuser;?>" />
                        <input name="fnumber" type="hidden" id="fnumber" value="<?php echo $fnumber;?>" />
                        <input name="snumber" type="hidden" id="snumber" value="<?php echo $sn;?>" />
                        <input name="pudid" type="hidden" id="pudid" value="<?php echo $pudid;?>" />
                        <input name="pud_p" type="hidden" id="pud_p" value="<?php echo $pud_p;?>" />
                        <input name="pud_n" type="hidden" id="pud_n" value="<?php echo $row_Recgd3['name'];?>" />
                        <span class="style3" style="margin:0px; font-size: 18px; font-weight: bold;">
                        <input type="hidden" name="MM_insert" value="form1" />
                        <span style="color: #FEDB4D">
                        <input name="see" type="hidden" id="see" value="<?php echo $sum;?>" />
                        <input name="ter" type="hidden" id="ter" value="<?php echo $ter;?>">
                        </span></span></td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td"><span>商品名稱</span></td>
                        <td><span><?php echo $row_Recgd3['name']," / ",number_format($row_Recgd3['p'], 0, '.' ,',');?></span></td>
                    </tr>
                    <!--<tr class="menu-tr">
                      <td class="menu-td">課程講師</td>
                      <td><?php echo $ter;?></td>
                    </tr>-->
                    <tr class="menu-tr">
                        <td class="menu-td">名稱或暱稱</td>
                        <td>
                            <input name="nick" type="text" id="nick" value="<?php if ($_GET['nick'] != "") {echo $_GET['nick'];}?>" placeholder="設定個人暱稱或公司行號名稱">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">登入密碼</td>
                        <td>
                            <input name="newpasswd" type="text" id="newpasswd" value="<?php if ($_GET['newpasswd'] != "") {echo $_GET['newpasswd'];} else {echo "123456";}?>" placeholder="密碼預設123456">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">二級密碼</td>
                        <td>
                            <input name="newpasstoo" type="text" id="newpasstoo" value="<?php if ($_GET['newpasstoo'] != "") {echo $_GET['newpasstoo'];} else {echo "123456";}?>" placeholder="密碼預設123456">
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">國籍</td>
                        <td>
                            <select name="coc" id="coc" style="width: 200px; margin-left: 2px; font-size: 14px" class="menu-select">
                                <option value="TW" <?php if ($_GET['coc'] == "TW") {echo "selected='selected'";}?> style="background-image: url(img/tw.jpg);padding-left: 15px">台灣(TAIWAN) </option>
                                <option value="CN" <?php if ($_GET['coc'] == "CN") {echo "selected='selected'";}?>>中國(CHINA)</option>
                                <option value="US" <?php if ($_GET['coc'] == "US") {echo "selected='selected'";}?>>美國(UNITED STATES) </option>
                                <option value="SG" <?php if ($_GET['coc'] == "SG") {echo "selected='selected'";}?>>新加坡(Singapore) </option>
                                <option value="MY" <?php if ($_GET['coc'] == "MY") {echo "selected='selected'";}?>>馬來西亞(Malaysia) </option>
                                <option value="HK" <?php if ($_GET['coc'] == "HK") {echo "selected='selected'";}?>>香港(HK)</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">性別</td>
                        <td>
                            <select name="m_sex" class="menu-select" id="m_sex">
                        <option value="F" <?php if ($_GET['m_sex'] == "F") {echo "selected='selected'";}?>>女</option>
                        <option value="M" <?php if ($_GET['m_sex'] == "M") {echo "selected='selected'";}?>>男</option>
                      </select>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">生日</td>
                        <td>
                            <input name="birthday" type="date" id="bookdate" value="<?php if ($_GET['birthday'] != "") {echo $_GET['birthday'];}?>" size="15" placeholder="2014-09-18" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">行動電話</td>
                        <td>
                            <input name="callphone" type="text" id="callphone" value="<?php if ($_GET['callphone'] != "") {echo $_GET['callphone'];}?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">E-mail</td>
                        <td>
                            <input name="email" type="text" id="email" value="<?php if ($_GET['email'] != "") {echo $_GET['email'];}?>" />
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">加購商品</td>
                        <td><?php if ($pudid >= 3) {?>
                          <select name="b_pud" id="b_pud">
                            <option value="0">請選擇</option>
                            <?php do {?>
                            <option value="<?php echo $row_Recb['id'];?>" <?php if ($_GET['b_pud'] == $row_Recb['id']) {echo "selected='selected'";}?>><?php echo $row_Recb['name'],"， $ ",number_format($row_Recb['p'], 0, '.' ,',')," /年 ";?></option>
                            <?php } while ($row_Recb = mysql_fetch_assoc($Recb));?>
                            <option value="0" <?php if ($_GET['b_pud'] == 0) {echo "selected='selected'";}?>>不要</option>
                          </select>
                          * 您可加購商品
                        <?php }?></td>
                    </tr>
                    <tr class="menu-tr">
                      <td colspan="2" align="left">
                            <ul>
                                <li><input name="st" type="radio" id="radio" value="1" checked="checked"  style="min-width: 50px"/>同意&nbsp;&nbsp;兌獎自動扣分</li>
                                <li><input type="radio" name="st" id="radio2" value="0"  style="min-width: 50px"/>不同意</li>
                            </ul>
                      </td>
                    </tr>
                    <tr class="menu-tr">
                        <td colspan="2" align="left">
                            <ul>
                                <li>
                                    <input type="radio" name="st2" value="1" style="min-width: 50px">同意&nbsp;&nbsp;<a id="myBtn"><span>會員使用條款協議與隱私政策</span></a> 
                                </li>
                                <li>
                                    <input type="radio" name="st2" value="0" style="min-width: 50px">不同意
                                </li>
                                <li>
                                    
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr class="menu-tr">
                        <td class="menu-td">驗證碼</td>
                        <td>
                            <input name="sum" type="text" id="sum" style="min-width: 70px;" size="12" placeholder="請輸入驗證碼">
                            <?php echo $sum;?>
                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="2">
                            <input type="submit" name="button" id="button" class="menu-but"  value="確認">
                            <input name="Submit4" type="button" class="menu-but" onclick="window.location='index.php'" value=" 取消 " />
                        </td>
                    </tr>
                </tbody>
            </table></form>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="contract">
                <div>
                    <button type="button" class="close treaty-close" data-dismiss="modal" style="font-size: 20px">X</button>
                    <h1><span> LIFE LINK串門子雲盟事業 </span><br><span>申請會員用戶協議</span></h1>
                    <h3>親愛的朋友您好：</h3>
                    <p>歡迎您加入「串門子雲盟事業」成為會員，串門子雲盟事業是一個結合產、官、工、學、個人與商家的社群+商務整合平台，當您選擇加入「串門子雲盟事業」成為會員時，即視為您已閱讀、瞭解並同意接受「串門子雲盟事業的會員規約」之全部內容，若您不同意，請立即登出並停止使用本網站所提供之任何會員服務。串門子雲盟事業股份有限公司有權於任何時間修改或變更本會員規約之內容，您若於修改或變更後繼續使用「串門子雲盟事業」之服務，即視為您已閱讀、瞭解並同意接受該等修改或變更後之內容。
                        <br>
                        <br>（以下您以「本人」簡稱；串門子雲盟事業股份有限公司經營之「串門子雲盟事業」以「本網站」簡稱。）</p>
                    <h4>第一條：本網站告知事項</h4>
                    <ol type="1" style="list-style-type:decimal; margin-left: 20px">
                        <li>本網站是一個社群加商務的整合平台，網站管理員有權限針對平台上的文章、會員進行管理，並查看您在平台上公開發佈的所有</li>
                        <li>本網站的服務對象需年滿16歲。</li>
                        <li>本網站根據個人資料保護法第八條規定，公告以下告知事項：</li>
                        <li>蒐集目的：人力仲介管理、會員服務與管理。 </li>
                        <li>個人資料類別：識別類、特徵類、家庭情形、社會情況、教育、技術或其他專業、受僱情形。</li>
                        <li>個人資料利用期間：本網站存續期間。</li>
                        <li>個人資料利用對象：本網站及利用本網站服務之會員或商家。</li>
                        <li>個人資料利用地區：利用對象不限所在地區。 </li>
                        <li>個人資料利用方法：網際網路、電子郵件、簡訊、書面及傳真。</li>
                        <li>當事人依個人資料保護法第三條規定得行使之權利及方式：當事人得於本網站自行處理修改密碼、隱私及帳戶設定、修改基本資料，以及編輯或刪除分享之內容。</li>
                        <li>當事人得於非假日時間與本網站服務專員連絡或留言訊息，我們將與你聯絡。</li>
                        <li>除非經由您的同意或其他法令之特別規定，本網站絕不會將您的個人資料揭露於第三方或使用於搜集目的以外之其他用途。但依法配合司法檢調單位提供使用者個人資料以協助司法調查則不在此限。</li>
                    </ol>
                    <h4>第二條：本網站提供之會員服務</h4>
                    <ol type="1" style="list-style-type:decimal; margin-left: 20px">
                        <li>個人資料查詢與記錄：本條所稱「個人資料查詢與記錄」是指當本人完成會員資料登錄及成功送出後，本網站之電腦系統將會依照本人在本網站提供之個人資料及修改予以紀錄</li>
                        <li>會員訊息服務：本條所稱「會員訊息服務」是指本網站得依本人之設定，以電子郵件方式、平台網站方式、推播方式或APP，寄送相關之互聯網資訊、商家資訊、平台各專業入口之文章資訊或會員互動等通知訊息予本人。</li>
                        <li>評量測驗施測：本條所稱「評量測驗施測」是指本人在本網站之頁面上施測評量測驗，本網站將對本人施測之結果，留存於資料庫。</li>
                        <li> 串連第三方網站或開發商：本條所稱「串連第三方網站或開發商」是指本網站提供之服務內容，可能包含連結到第三方網站或提供由第三方程式開發人員開發之平台應用程式，本人必須自行評估是否要使用此串連服務，對於本人使用此串連服務，本人須自行承擔風險。本網站可利用第三方網站收集的互動資料(如：年齡、性別和興趣)作為網站營運之應用。</li>
                        <li>會員互動服務：本網站沒有義務介入本人與其他會員之間之爭執，亦不會因此而關閉本人或其他會員之帳戶，除非本人或會員違反本網站之使用規範或情節重大。</li>
                    </ol>
                    <h4>第三條：本人個資管理及維護</h4>
                    <p>本人同意將本人於本網站填寫及留存之會員個人資料，無償且不附帶任何條件提供予本網站蒐集、處理、國際傳輸及利用：</p>
                    <ol type="1" style="list-style-type:decimal; margin-left: 20px">
                        <li>作為會員辨識及發送訊息（包括求才廠商或人力仲介業者連繫訊息）之用。</li>
                        <li>作為統計與分析之用，例如：針對會員男女分佈、年齡、學歷、職務、地區、興趣、嗜好等為研究。分析結果之呈現方式僅有整體之數據及說明文字，除供內部研究外，本網站得視需要對外公布該等數據及說明文字，但不涉及特定個人資料之公開。</li>
                        <li>作為接收串門子雲盟事業股份有限公司或相關企業之各項服務與資訊之用。</li>
                        <li>其他另經過本人以書面、電子郵件、傳真、網頁點選按鈕同意之利用。 </li>
                        <li>除個人資料的維護與記錄外，本網站沒有義務儲存、維護或備份本人所使用或發表的任何內容。</li>
                    </ol>
                    <h4>第四條：會員注意事項</h4>
                    <p>為了使用本網站提供之會員服務，本人同意以下事項：</p>
                    <ol type="1" style="list-style-type:decimal; margin-left: 20px">
                        <li>一人限申請使用一個帳號。</li>
                        <li>依本服務註冊表之提示提供本人正確、最新及完整之資料。</li>
                        <li>維持並更新本人資料，確保其為正確、最新及完整。若本人提供任何錯誤或不實資料，本網站有權暫停或終止本人之帳號，並拒絕本人使用會員服務之全部或一部分。</li>
                        <li>如果本人不同意本網站之會員規約，則不應登錄成為本網站會員或使用本網站之任何服務。</li>
                        <li>本人同意且了解，不得與他人共用同一帳戶，亦不得將登入本網站之帳號及密碼提供或透露予任何第三人，任何第三人因獲悉本人帳號密碼而登入本人帳戶所發生之任何問題，概由本人自行承擔所有後果。</li>
                        <li>本人不得將此網站所提供之系統服務用於結合充當自身或他人不合法或非法之組織運作的工具，或假藉本網站或本公司之名為己有或聯盟關係詐騙欺瞞他人財物，若有觸犯法律之民刑事責任應自行負責，概與本公司無關。</li>
                    </ol>
                    <h4>第五條：本網站安全維護</h4>
                    <ol type="1" style="list-style-type:decimal; margin-left: 20px">
                        <li>本人同意不得於本網站騷擾、恐嚇其他會員或從事任何非法、違反公序良俗之行為。</li>
                        <li>本人同意不上傳病毒或其他攻擊程式碼。</li>
                        <li>本人同意未經本網站事前書面同意，不得發布任何他人之個人聯絡資訊。</li>
                        <li>本人同意不發佈任何誹謗侵害他人名譽或為謠言、猜測、捏造不實言論等行為。</li>
                        <li>本人同意不在本網站從事任何銷售或多層次傳銷或與發表與主題無關的商業廣告行為。</li>
                        <li>本人同意不會進行任何會導致本網站關閉、超載、損害正常運作或外觀之行為。</li>
                        <li>本人同意不得於本網站公開蒐集其他使用者之聯絡資訊。</li>
                    </ol>
                    <h4>第六條：保護其他人權利</h4>
                    <ol type="1" style="list-style-type:decimal; margin-left: 20px">
                        <li>本人同意不會在本網站張貼任何侵犯、揭露他人隱私或純屬他人私領域之言論或物品。</li>
                        <li>對於本人張貼的任何內容或資料若有違反本網站政策或會員規約，本人同意本網站有權逕行移除。若經本網站通知仍未改善者，本網站有權停止本人繼續使用本網站之權利。</li>
                        <li>本人同意且了解，若本人須蒐集部份會員資料，本人必須事先徵得該會員之同意，並明確表示是本人（而非本網站）蒐集其個人資料，並明確告知蒐集後之處理與利用方式。</li>
                        <li>本人同意不會亦不得誘使他人於本網站，發布其個人身分證明文件或敏感性個人資料。</li>
                        <li>本人同意且了解，若因本人未遵守本網站會員規約，致侵害他人權益或造成本網站之損害（包括且不限於商譽之損害），本人同意負擔所有相關之損害賠償或回復原狀之責任。</li>
                    </ol>
                    <h4>第七條：本網站之免責約定</h4>
                    <ol type="1" style="list-style-type:decimal; margin-left: 20px">
                        <li>本人明瞭於本網站發布之內容或資料，若非本人所獨立創作或是任何人得公開使用之著作，而是重製或引用他人享有著作權之著作時，本人應注意著作權法之合理使用規範，若生爭議，本人除應立即刪除涉有侵害他人著作權之內容或資料外，並應主動與他人協商解決，本網站對此不負任何賠償責任。</li>
                        <li>本人明瞭本人經由本網站取得之資訊或建議，本網站並不擔保其為完全正確無誤。本網站對於本服務所提供之資訊或建議有權隨時修改或刪除。</li>
                        <li>本網站隨時會與廠商等第三人（「內容提供者」）合作，由其提供包括新聞、各類促銷、訊息、電子報等不同內容供本網站刊登，本網站對其所提供之內容並不做實質之審查或修改，對該內容之正確真偽亦不負任何責任。對該內容之正確真偽，須由本人自行判斷之。</li>
                        <li>本人明瞭在本網站瀏覽到的所有廣告內容、文字與圖片之說明、展示樣品或其他銷售資訊，均由各該廣告商所設計與提出。本人需自行斟酌與判斷該廣告之正確性與可信度。本網站僅接受委託予以刊登，不對前述廣告內容負擔保責任。</li>
                        <li>本人同意不對本網站或串門子雲盟事業股份有限公司或相關企業就以上情形之發生為民事損害賠償之請求，亦不任意公開散佈有損本網站、串門子雲盟事業股份有限公司或相關企業負責人、董監事、受僱人商譽或名譽之言論或文字。</li>
                    </ol>
                    <h4>第七條：本網站之免責約定</h4>
                    <p>本人同意若發生違反以上各項約定，經查明屬實者，本網站得取消本人之會員資格，並拒絕本人爾後使用本網站各項服務之權利。另本人若違反第六條、第七條之約定者，本網站可將本人之姓氏、會員代碼或暱稱及事實經過公告於本網站。</p>
                    <p>本人同意若本人違反本網站之使用條款或服務規範，本網站有權逕行移除您所發布的內容，並視情況停止您使用本網站服務的權利。</p>
                    <h4>第九條：隱私權保護政策</h4>
                    <p>本網站之隱私權保護政策準用串門子雲盟事業股份有限公司隱私權保護政策辦理，本人明瞭該隱私權保護政策亦構成本會員規約之一部份。</p>
                    <h4>第十條：準據法及管轄法院</h4>
                    <p>本會員規約之解釋與適用，以中華民國法律為準據法。本人與串門子雲盟事業股份有限公司共同約定，若因使用本網站發生爭議而有訴訟之必要時，雙方合意以台灣台南地方法院為第一審管轄法院。</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#myBtn").click(function() {
            $("#myModal").modal();
        });
        $("#myBtn02").click(function() {
            $("#myModal02").modal();
        });
        $("#myBtn03").click(function() {
            $("#myModal03").modal();
        });

    });
    </script>
<!--↑↑↑↑↑↑↑↑
                    content
                                    ↑↑↑↑↑↑↑↑↑↑ -->
</body>
</html>
