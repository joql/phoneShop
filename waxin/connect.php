﻿<?php
header("Content-type: text/html; charset=utf-8");
session_start();
$host="my9063650.xincache1.cn";
$db_user="my9063650";
$db_pass="N9b6z9K7";
$db_name="my9063650";
$timezone="Asia/Shanghai";

$link=mysql_connect($host,$db_user,$db_pass);
mysql_select_db($db_name,$link);
mysql_query("SET names UTF8");

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone); //北京时间
?>
