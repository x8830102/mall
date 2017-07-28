<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>串門子銀行存摺上傳系統</title>
 <link rel="icon" href="img/life_link.jpg" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="jasny-bootstrap/css/jasny-bootstrap.css">
<link rel="stylesheet" type="text/css" href="icomoon/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<style type="text/css">
body {
  font-family:"verdana","微軟正黑體" ; font-weight:400;
  background: #cfcfcf;
}

.order {
      background: #fff;
      box-shadow: 0px 0px 10px 2px #b2b2b2;
      min-height: 220px;
      border-radius: 10px;
      margin: 15px 22px;
      padding: 60px 
    }
.order li {
      line-height: 40px;
      margin-top: 10px
    }
    .order a {
      color: #949494;

    }

.button {
  background: #cc9933;
  border-radius: 4px;
  color: #fff;
  border: 0px;
  width: 200px;
  height: 26px;
  line-height: 26px;
  transition: all 0.5s;
  
}
.button:hover {
  box-shadow: 3px 2px 0px #967026
}
.sid {

  width: 230px;
  height: 30px
}
</style>
</head>

<body>
<div class="order">
  <div class="col-lg-4 col-md-4" align="center">
    <img src="img/life-link_logo.png" alt="">
  </div>
<form action="b_add.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<div class="col-lg-4 col-md-4" align="center">
    <ul>
      <li><h3 align="center">銀行存摺上傳系統 </h3></li>
      <li>選擇上傳檔案</li>
      <li><input name="MAX_FILE_SIZE" type="hidden" id="MAX_FILE_SIZE" value="10000000000" />
            <input name="myfile" type="file" class="sid" id="myfile" /> <span style="color: #0028E9"></span></li>
    </ul>
  </div>
  <div class="col-lg-4 col-md-4" align="center">
     <ul>

      <li style="margin-top: 20px">
      <input name="Submit" type="submit" class="button" value="確定" />
      </li>
      <li style="margin-top:-8px "><input name="Submit4" type="button" class="button " onclick="window.location='member_profile06.php'" value="取消 " />
          </li>
    </ul>
  </div>
  </div>

</form>
</body>
</html>
