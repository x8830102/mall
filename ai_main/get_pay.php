<?php
require_once('Connections/sc.php');mysql_query("set names utf8");
header('Content-Type: text/html;charset=UTF-8');

if(isset($_POST['base'])){
     $base = $_POST['base'];
	 $date1 = $_POST['date1'];
	 $date2 = $_POST['date2'];
      if($base == 'gold_m'){
          if(empty($date1)){
               $SQL="SELECT date,time,number,note,g,level,id FROM $base WHERE at = '1' ORDER BY id desc"; 
          }else{
               $SQL="SELECT date,time,number,note,g,level,id FROM $base WHERE date>='$date1' AND date<='$date2' AND at = '1' ORDER BY id desc"; 
          }
     //echo $base;
     
     mysql_select_db($database_sc, $sc); //開啟資料庫
     $result=mysql_query($SQL, $sc) or die(mysql_error()); //執行 SQL 指令
     $store=array(); //儲存表格內容之陣列
      $x = mysql_numrows($result);
     for ($i=0; $i<mysql_numrows($result); $i++) { //走訪紀錄集 (列)
            
          $row=mysql_fetch_array($result); //取得列陣列
          $date=$row["date"];
          $time=$row["time"];
          $number=$row["number"];
          $note=$row["note"];
          $g=$row["g"];
          $level = $row['level'];
          switch ($level) {
               case '1':
                    $category = '分享';
                    break;
               
               case '2':
                    $category = '輔導';
                    break;
               
               case '3':
                    $category = '教育';
                    break;
               
               case '4':
                    $category = '福袋';
                    break;
               
               case '5':
                    $category = '業績';
                    break;
               
               case '6':
                    $category = '紅利';
                    break;
               
               case '10':
                    $category = '紅利';
                    break;
               
               default:
                    $category = '異常';
                    break;
          }
          $id = $row['id'];
          $member="SELECT * FROM memberdata WHERE number='$number'";
          $mem_result=mysql_query($member, $sc) or die(mysql_error());
          $mem_row=mysql_fetch_array($mem_result);
          $m_username=$mem_row['m_username'];
          $m_nick=$mem_row['m_nick'];
          $store[$i]=array($x ,$date, $time, $m_username, $m_nick, $category, number_format($g), $note); //存入陣列
            $x--;
          } //end of for
     //$arr["aaData"]=$store; 
     echo json_encode($store);  //將陣列轉成 JSON 資料格式傳回


      }else{
          if(empty($date1)){
               $SQL="SELECT date,number,pud_name,pin,pout,psum FROM $base ORDER BY id desc"; 
          }else{
               $SQL="SELECT date,number,pud_name,pin,pout,psum FROM $base WHERE date>='$date1' AND date<='$date2' ORDER BY id desc"; 
          }

     //echo $base;
     
     mysql_select_db($database_sc, $sc); //開啟資料庫
     $result=mysql_query($SQL, $sc) or die(mysql_error()); //執行 SQL 指令
     $store=array(); //儲存表格內容之陣列
      $x = mysql_numrows($result);
     for ($i=0; $i<mysql_numrows($result); $i++) { //走訪紀錄集 (列)
            
          $row=mysql_fetch_array($result); //取得列陣列
          $date=$row["date"];
          $time=$row["time"];
          $number=$row["number"];
          $pud_name=$row["pud_name"];
          $pin=$row["pin"];
            $pout = $row['pout'];
            $psum = $row['psum'];
               $member="SELECT * FROM memberdata WHERE number='$number'";
               $mem_result=mysql_query($member, $sc) or die(mysql_error());
               $mem_row=mysql_fetch_array($mem_result);
               $m_username=$mem_row['m_username'];
               $m_nick=$mem_row['m_nick'];
          $store[$i]=array($x ,$date, $m_username, $m_nick, number_format($pin), number_format($pout), number_format($psum), $pud_name); //存入陣列
            $x--;
          } //end of for
     //$arr["aaData"]=$store; 
     echo json_encode($store);  //將陣列轉成 JSON 資料格式傳回 
      }
}
?>
