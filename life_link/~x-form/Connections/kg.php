<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_kg = "localhost";
$database_kg = "cmg58891_a";
$username_kg = "cmg58891_a";
$password_kg = "cmg911com";
$kg = mysql_pconnect($hostname_kg, $username_kg, $password_kg) or trigger_error(mysql_error(),E_USER_ERROR); 
?>