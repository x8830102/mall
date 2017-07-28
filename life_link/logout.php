<?php require_once('Connections/sc.php'); ?>
<?php 
mysql_query("set names utf8");
session_start();
if ($_SESSION['number'] == "") {header(sprintf("Location: login_mem.php"));exit;} else {$sn=$_SESSION['number'];}


//
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $user = $_SESSION['mem'];
  header("Location:http://lifelink.cc/logout_s.php?m=$user");
  exit;
}


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
        body{
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

    #button {
      background: #395ee6;
      border-radius: 4px;
      color: #fff;
      border: 0px;
      width: 200px;
      height: 30px;
      line-height: 30px;
      transition: all 0.5s;
      
    }
    #button:hover {
      box-shadow: 3px 2px 0px #1f2c7d
    }
    .xform_but {
            border-radius: 4px;
            background: #bcbcbc;
            color: #fff;
            border: 0px;
            width: 200px;
            height: 30px;
            line-height: 30px;
            transition: all 0.5s;
        }
        .xform_but:hover {
            box-shadow: 3px 2px 0px #676767
        }
    </style>
</head>

<body>
<div class="order">
  <div class="col-lg-4 col-md-4" align="center">
    <img src="img/life-link_logo.png" alt="">
  </div>
  <div class="col-lg-4 col-md-4" align="center">
    <h3>確定登出嗎？</h3>
  </div>
  <div class="col-lg-4 col-md-4" align="center">
    <ul>
      <li style="margin-top: 20px"><a href="<?php echo $logoutAction ?>"><button type="button" id="button">確定</button></a></li>
      <li style="margin-top:-2px ">
      <input name="Submit4" type="button" onclick="window.location='index.php'" value=" 繼續瀏覽網站 " class="xform_but" /></li>
    </ul>
  </div>
</div>


</body>
</html>