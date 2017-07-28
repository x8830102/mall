<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<title>無標題文件</title>
<style type="text/css">
.v3 {font-size:14px;
}
</style>
</head>

<body>
<h3 align="center">身 份 證 圖 上 傳 系 統 </h3>
<hr />
<form action="b_add.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><p>選擇上傳檔案：
        
      </p>
      <p>
        <input name="MAX_FILE_SIZE" type="hidden" id="MAX_FILE_SIZE" value="10000000000" />
        <input name="myfile" type="file" class="v3" id="myfile" />
        <input name="Submit" type="submit" class="v3" value="送出" />
        <span style="color: #0028E9">
        <input name="Submit4" type="button" class="v3" onclick="window.location='member_profile06.php'" value=" 取消 " />
      </span></p></td>
    </tr>
  </table>
</form>
</body>
</html>
