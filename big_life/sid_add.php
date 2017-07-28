<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;} else {$sn=$_SESSION['number'];}
mysql_select_db($database_sc, $sc);
$query_Recsn = sprintf("SELECT * FROM memberdata WHERE number = '$sn' && m_ok >= 1");//
$Recsn = mysql_query($query_Recsn, $sc) or die(mysql_error());
$row_Recsn = mysql_fetch_assoc($Recsn);
$totalRows_Recsn = mysql_num_rows($Recsn);
if ($totalRows_Recsn == 0) {header(sprintf("Location: login_mem.php"));exit;}
$name=$row_Recsn['m_name'];
$nick=$row_Recsn['m_nick'];
$card=$row_Recsn['card'];
/*mysql_select_db($database_sc, $sc);
$query_Recmem = sprintf("SELECT * FROM memberdata WHERE number = '$u' && m_ok=1");
$Recmem = mysql_query($query_Recmem, $sc) or die(mysql_error());
$row_Recmem = mysql_fetch_assoc($Recmem);
$totalRows_Recmem = mysql_num_rows($Recmem);
$card=$row_Recmem['card'];
	echo "檔案名稱：".$_FILES['myfile']['name']."<br>";
	echo "檔案大小：".$_FILES['myfile']['size']."<br>";
	echo "檔案格式：".$_FILES['myfile']['type']."<br>";
	echo "暫存名稱：".$_FILES['myfile']['tmp_name']."<br>";
	echo "錯誤代碼：".$_FILES['myfile']['error']."<br>";*/

	if($_FILES['myfile']['error'] > 0){
		switch($_FILES['myfile']['error']){
			case 1 : die("檔案大小超出 php.ini:upload_max_filesize 限制");
			case 2 : die("檔案大小超出 MAX_FILE_SIZE 限制");
			case 3 : die("檔案僅被部分上傳");
			case 4 : die("檔案未被上傳");
		}
	}	
	
		if(is_uploaded_file($_FILES['myfile']['tmp_name'])){
		$DestDIR = "sid_pic";
		//if(!is_dir($DestDIR) || !is_writeable($DestDIR))
			//die("目錄不存在或無法寫入");

		$File_Extension = explode(".", $_FILES['myfile']['name']); 
		$File_Extension = $File_Extension[count($File_Extension)-1]; 
		$ServerFilename =$card."_".date("YmdHis") . "." . $File_Extension;
		copy($_FILES['myfile']['tmp_name'] , $DestDIR . "/" . $ServerFilename );
	}	
/*
mysql_select_db($database_ms, $ms);
$query_Recpt = sprintf("SELECT * FROM pic_top WHERE id=$pti");
$Recpt = mysql_query($query_Recpt, $ms) or die(mysql_error());
$row_Recpt = mysql_fetch_assoc($Recpt);
$totalRows_Recpt = mysql_num_rows($Recpt);
$old_pic=$row_Recpt['pic'];
//
$Filename="" . $old_pic;
if(file_exists($Filename))
unlink($Filename);
*/
$update11="UPDATE bank SET sid_pic='$ServerFilename' WHERE number = '$sn'";
mysql_select_db($database_sc, $sc);
$Result11 = mysql_query($update11, $sc) or die(mysql_error());
//
header(sprintf("Location: member_profile02.php"));exit;
?>

