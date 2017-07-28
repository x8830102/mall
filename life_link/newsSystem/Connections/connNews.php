<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connNews = "localhost";
$database_connNews = "cmg58891_a";
$username_connNews = "x8830102";
$password_connNews = "rgn26842";
$connNews = mysql_pconnect($hostname_connNews, $username_connNews, $password_connNews) or die(mysql_error());
?>