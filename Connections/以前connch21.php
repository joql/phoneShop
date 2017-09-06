<?php error_reporting(E_ALL & ~E_NOTICE);
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connch21 = "my9063650.xincache1.cn";
$database_connch21 = "my9063650";
$username_connch21 = "my9063650";
$password_connch21 = "N9b6z9K7";
$connch21 = mysql_connect($hostname_connch21, $username_connch21, $password_connch21) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_query("SET NAMES 'UTF8'");
date_default_timezone_set('PRC') or die('时区设置失败，请联系管理员！')
?>