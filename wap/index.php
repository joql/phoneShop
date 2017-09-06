<?php require_once('../Connections/connch21.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Recordset1 = 18;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sj ORDER BY info_time DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$maxRows_Recordset2 = 8;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = "SELECT * FROM kuhua ORDER BY info_time DESC";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $connch21) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

$maxRows_Recordset3 = 8;
$pageNum_Recordset3 = 0;
if (isset($_GET['pageNum_Recordset3'])) {
  $pageNum_Recordset3 = $_GET['pageNum_Recordset3'];
}
$startRow_Recordset3 = $pageNum_Recordset3 * $maxRows_Recordset3;

mysql_select_db($database_connch21, $connch21);
$query_Recordset3 = "SELECT * FROM cpai ORDER BY info_time DESC";
$query_limit_Recordset3 = sprintf("%s LIMIT %d, %d", $query_Recordset3, $startRow_Recordset3, $maxRows_Recordset3);
$Recordset3 = mysql_query($query_limit_Recordset3, $connch21) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);

if (isset($_GET['totalRows_Recordset3'])) {
  $totalRows_Recordset3 = $_GET['totalRows_Recordset3'];
} else {
  $all_Recordset3 = mysql_query($query_Recordset3);
  $totalRows_Recordset3 = mysql_num_rows($all_Recordset3);
}
$totalPages_Recordset3 = ceil($totalRows_Recordset3/$maxRows_Recordset3)-1;

$maxRows_Rec_tjian = 6;
$pageNum_Rec_tjian = 0;
if (isset($_GET['pageNum_Rec_tjian'])) {
  $pageNum_Rec_tjian = $_GET['pageNum_Rec_tjian'];
}
$startRow_Rec_tjian = $pageNum_Rec_tjian * $maxRows_Rec_tjian;

mysql_select_db($database_connch21, $connch21);
$query_Rec_tjian = "SELECT * FROM news WHERE bigtype = '1' and smalltype='推荐用户1' ORDER BY news_id DESC";
$query_limit_Rec_tjian = sprintf("%s LIMIT %d, %d", $query_Rec_tjian, $startRow_Rec_tjian, $maxRows_Rec_tjian);
$Rec_tjian = mysql_query($query_limit_Rec_tjian, $connch21) or die(mysql_error());
$row_Rec_tjian = mysql_fetch_assoc($Rec_tjian);

if (isset($_GET['totalRows_Rec_tjian'])) {
  $totalRows_Rec_tjian = $_GET['totalRows_Rec_tjian'];
} else {
  $all_Rec_tjian = mysql_query($query_Rec_tjian);
  $totalRows_Rec_tjian = mysql_num_rows($all_Rec_tjian);
}
$totalPages_Rec_tjian = ceil($totalRows_Rec_tjian/$maxRows_Rec_tjian)-1;

$maxRows_Rec_tjian2 = 6;
$pageNum_Rec_tjian2 = 0;
if (isset($_GET['pageNum_Rec_tjian2'])) {
  $pageNum_Rec_tjian2 = $_GET['pageNum_Rec_tjian2'];
}
$startRow_Rec_tjian2 = $pageNum_Rec_tjian2 * $maxRows_Rec_tjian2;

mysql_select_db($database_connch21, $connch21);
$query_Rec_tjian2 = "SELECT * FROM news WHERE bigtype = '1' and smalltype='推荐用户2' ORDER BY news_id DESC";
$query_limit_Rec_tjian2 = sprintf("%s LIMIT %d, %d", $query_Rec_tjian2, $startRow_Rec_tjian2, $maxRows_Rec_tjian2);
$Rec_tjian2 = mysql_query($query_limit_Rec_tjian2, $connch21) or die(mysql_error());
$row_Rec_tjian2 = mysql_fetch_assoc($Rec_tjian2);

if (isset($_GET['totalRows_Rec_tjian2'])) {
  $totalRows_Rec_tjian2 = $_GET['totalRows_Rec_tjian2'];
} else {
  $all_Rec_tjian2 = mysql_query($query_Rec_tjian2);
  $totalRows_Rec_tjian2 = mysql_num_rows($all_Rec_tjian2);
}
$totalPages_Rec_tjian2 = ceil($totalRows_Rec_tjian2/$maxRows_Rec_tjian2)-1;

$maxRows_Rec_tjian3 = 6;
$pageNum_Rec_tjian3 = 0;
if (isset($_GET['pageNum_Rec_tjian3'])) {
  $pageNum_Rec_tjian3 = $_GET['pageNum_Rec_tjian3'];
}
$startRow_Rec_tjian3 = $pageNum_Rec_tjian3 * $maxRows_Rec_tjian3;

mysql_select_db($database_connch21, $connch21);
$query_Rec_tjian3 = "SELECT * FROM news WHERE bigtype = '1' and smalltype='推荐用户3' ORDER BY news_id DESC";
$query_limit_Rec_tjian3 = sprintf("%s LIMIT %d, %d", $query_Rec_tjian3, $startRow_Rec_tjian3, $maxRows_Rec_tjian3);
$Rec_tjian3 = mysql_query($query_limit_Rec_tjian3, $connch21) or die(mysql_error());
$row_Rec_tjian3 = mysql_fetch_assoc($Rec_tjian3);

if (isset($_GET['totalRows_Rec_tjian3'])) {
  $totalRows_Rec_tjian3 = $_GET['totalRows_Rec_tjian3'];
} else {
  $all_Rec_tjian3 = mysql_query($query_Rec_tjian3);
  $totalRows_Rec_tjian3 = mysql_num_rows($all_Rec_tjian3);
}
$totalPages_Rec_tjian3 = ceil($totalRows_Rec_tjian3/$maxRows_Rec_tjian3)-1;

$maxRows_Rec_gogao = 6;
$pageNum_Rec_gogao = 0;
if (isset($_GET['pageNum_Rec_gogao'])) {
  $pageNum_Rec_gogao = $_GET['pageNum_Rec_gogao'];
}
$startRow_Rec_gogao = $pageNum_Rec_gogao * $maxRows_Rec_gogao;

mysql_select_db($database_connch21, $connch21);
$query_Rec_gogao = "SELECT * FROM news WHERE bigtype = '2' and smalltype='本站公告' ORDER BY news_id DESC";
$query_limit_Rec_gogao = sprintf("%s LIMIT %d, %d", $query_Rec_gogao, $startRow_Rec_gogao, $maxRows_Rec_gogao);
$Rec_gogao = mysql_query($query_limit_Rec_gogao, $connch21) or die(mysql_error());
$row_Rec_gogao = mysql_fetch_assoc($Rec_gogao);

if (isset($_GET['totalRows_Rec_gogao'])) {
  $totalRows_Rec_gogao = $_GET['totalRows_Rec_gogao'];
} else {
  $all_Rec_gogao = mysql_query($query_Rec_gogao);
  $totalRows_Rec_gogao = mysql_num_rows($all_Rec_gogao);
}
$totalPages_Rec_gogao = ceil($totalRows_Rec_gogao/$maxRows_Rec_gogao)-1;

$maxRows_Rec_halp1 = 6;
$pageNum_Rec_halp1 = 0;
if (isset($_GET['pageNum_Rec_halp1'])) {
  $pageNum_Rec_halp1 = $_GET['pageNum_Rec_halp1'];
}
$startRow_Rec_halp1 = $pageNum_Rec_halp1 * $maxRows_Rec_halp1;

mysql_select_db($database_connch21, $connch21);
$query_Rec_halp1 = "SELECT * FROM news WHERE bigtype = '2' and smalltype='买家帮助' ORDER BY news_id DESC";
$query_limit_Rec_halp1 = sprintf("%s LIMIT %d, %d", $query_Rec_halp1, $startRow_Rec_halp1, $maxRows_Rec_halp1);
$Rec_halp1 = mysql_query($query_limit_Rec_halp1, $connch21) or die(mysql_error());
$row_Rec_halp1 = mysql_fetch_assoc($Rec_halp1);

if (isset($_GET['totalRows_Rec_halp1'])) {
  $totalRows_Rec_halp1 = $_GET['totalRows_Rec_halp1'];
} else {
  $all_Rec_halp1 = mysql_query($query_Rec_halp1);
  $totalRows_Rec_halp1 = mysql_num_rows($all_Rec_halp1);
}
$totalPages_Rec_halp1 = ceil($totalRows_Rec_halp1/$maxRows_Rec_halp1)-1;

$maxRows_Rec_halp2 = 6;
$pageNum_Rec_halp2 = 0;
if (isset($_GET['pageNum_Rec_halp2'])) {
  $pageNum_Rec_halp2 = $_GET['pageNum_Rec_halp2'];
}
$startRow_Rec_halp2 = $pageNum_Rec_halp2 * $maxRows_Rec_halp2;

mysql_select_db($database_connch21, $connch21);
$query_Rec_halp2 = "SELECT * FROM news WHERE bigtype = '2' and smalltype='用户帮助' ORDER BY news_id DESC";
$query_limit_Rec_halp2 = sprintf("%s LIMIT %d, %d", $query_Rec_halp2, $startRow_Rec_halp2, $maxRows_Rec_halp2);
$Rec_halp2 = mysql_query($query_limit_Rec_halp2, $connch21) or die(mysql_error());
$row_Rec_halp2 = mysql_fetch_assoc($Rec_halp2);

if (isset($_GET['totalRows_Rec_halp2'])) {
  $totalRows_Rec_halp2 = $_GET['totalRows_Rec_halp2'];
} else {
  $all_Rec_halp2 = mysql_query($query_Rec_halp2);
  $totalRows_Rec_halp2 = mysql_num_rows($all_Rec_halp2);
}
$totalPages_Rec_halp2 = ceil($totalRows_Rec_halp2/$maxRows_Rec_halp2)-1;

$maxRows_Rec_news1 = 6;
$pageNum_Rec_news1 = 0;
if (isset($_GET['pageNum_Rec_news1'])) {
  $pageNum_Rec_news1 = $_GET['pageNum_Rec_news1'];
}
$startRow_Rec_news1 = $pageNum_Rec_news1 * $maxRows_Rec_news1;

mysql_select_db($database_connch21, $connch21);
$query_Rec_news1 = "SELECT * FROM news WHERE bigtype = '3' and smalltype='行业新闻' ORDER BY news_id DESC";
$query_limit_Rec_news1 = sprintf("%s LIMIT %d, %d", $query_Rec_news1, $startRow_Rec_news1, $maxRows_Rec_news1);
$Rec_news1 = mysql_query($query_limit_Rec_news1, $connch21) or die(mysql_error());
$row_Rec_news1 = mysql_fetch_assoc($Rec_news1);

if (isset($_GET['totalRows_Rec_news1'])) {
  $totalRows_Rec_news1 = $_GET['totalRows_Rec_news1'];
} else {
  $all_Rec_news1 = mysql_query($query_Rec_news1);
  $totalRows_Rec_news1 = mysql_num_rows($all_Rec_news1);
}
$totalPages_Rec_news1 = ceil($totalRows_Rec_news1/$maxRows_Rec_news1)-1;

mysql_select_db($database_connch21, $connch21);
$query_Rec_news1_1 = "SELECT * FROM news WHERE bigtype = '3' and smalltype='行业新闻' and newsph_top=1 ORDER BY news_id DESC";
$Rec_news1_1 = mysql_query($query_Rec_news1_1, $connch21) or die(mysql_error());
$row_Rec_news1_1 = mysql_fetch_assoc($Rec_news1_1);
$totalRows_Rec_news1_1 = mysql_num_rows($Rec_news1_1);

mysql_select_db($database_connch21, $connch21);
$query_Rec_news2_1 = "SELECT * FROM news WHERE bigtype = '3' and smalltype='手机资讯' and newsph_top=1 ORDER BY news_id DESC";
$Rec_news2_1 = mysql_query($query_Rec_news2_1, $connch21) or die(mysql_error());
$row_Rec_news2_1 = mysql_fetch_assoc($Rec_news2_1);
$totalRows_Rec_news2_1 = mysql_num_rows($Rec_news2_1);

$maxRows_Rec_news2 = 6;
$pageNum_Rec_news2 = 0;
if (isset($_GET['pageNum_Rec_news2'])) {
  $pageNum_Rec_news2 = $_GET['pageNum_Rec_news2'];
}
$startRow_Rec_news2 = $pageNum_Rec_news2 * $maxRows_Rec_news2;

mysql_select_db($database_connch21, $connch21);
$query_Rec_news2 = "SELECT * FROM news WHERE bigtype = '3' and smalltype='手机资讯'  ORDER BY news_id DESC";
$query_limit_Rec_news2 = sprintf("%s LIMIT %d, %d", $query_Rec_news2, $startRow_Rec_news2, $maxRows_Rec_news2);
$Rec_news2 = mysql_query($query_limit_Rec_news2, $connch21) or die(mysql_error());
$row_Rec_news2 = mysql_fetch_assoc($Rec_news2);

if (isset($_GET['totalRows_Rec_news2'])) {
  $totalRows_Rec_news2 = $_GET['totalRows_Rec_news2'];
} else {
  $all_Rec_news2 = mysql_query($query_Rec_news2);
  $totalRows_Rec_news2 = mysql_num_rows($all_Rec_news2);
}
$totalPages_Rec_news2 = ceil($totalRows_Rec_news2/$maxRows_Rec_news2)-1;

$maxRows_Rec_news3 = 9;
$pageNum_Rec_news3 = 0;
if (isset($_GET['pageNum_Rec_news3'])) {
  $pageNum_Rec_news3 = $_GET['pageNum_Rec_news3'];
}
$startRow_Rec_news3 = $pageNum_Rec_news3 * $maxRows_Rec_news3;

mysql_select_db($database_connch21, $connch21);
$query_Rec_news3 = "SELECT * FROM news WHERE bigtype = '3' and smalltype='各地动态' ORDER BY news_id DESC";
$query_limit_Rec_news3 = sprintf("%s LIMIT %d, %d", $query_Rec_news3, $startRow_Rec_news3, $maxRows_Rec_news3);
$Rec_news3 = mysql_query($query_limit_Rec_news3, $connch21) or die(mysql_error());
$row_Rec_news3 = mysql_fetch_assoc($Rec_news3);

if (isset($_GET['totalRows_Rec_news3'])) {
  $totalRows_Rec_news3 = $_GET['totalRows_Rec_news3'];
} else {
  $all_Rec_news3 = mysql_query($query_Rec_news3);
  $totalRows_Rec_news3 = mysql_num_rows($all_Rec_news3);
}
$totalPages_Rec_news3 = ceil($totalRows_Rec_news3/$maxRows_Rec_news3)-1;

$maxRows_Rec_yqlj = 20;
$pageNum_Rec_yqlj = 0;
if (isset($_GET['pageNum_Rec_yqlj'])) {
  $pageNum_Rec_yqlj = $_GET['pageNum_Rec_yqlj'];
}
$startRow_Rec_yqlj = $pageNum_Rec_yqlj * $maxRows_Rec_yqlj;

mysql_select_db($database_connch21, $connch21);
$query_Rec_yqlj = "SELECT * FROM yqlj ORDER BY id ASC";
$query_limit_Rec_yqlj = sprintf("%s LIMIT %d, %d", $query_Rec_yqlj, $startRow_Rec_yqlj, $maxRows_Rec_yqlj);
$Rec_yqlj = mysql_query($query_limit_Rec_yqlj, $connch21) or die(mysql_error());
$row_Rec_yqlj = mysql_fetch_assoc($Rec_yqlj);

if (isset($_GET['totalRows_Rec_yqlj'])) {
  $totalRows_Rec_yqlj = $_GET['totalRows_Rec_yqlj'];
} else {
  $all_Rec_yqlj = mysql_query($query_Rec_yqlj);
  $totalRows_Rec_yqlj = mysql_num_rows($all_Rec_yqlj);
}
$totalPages_Rec_yqlj = ceil($totalRows_Rec_yqlj/$maxRows_Rec_yqlj)-1;

mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao01 = "SELECT * FROM guanggao WHERE title = '首页图片轮播  '";
$Rec_ggao01 = mysql_query($query_Rec_ggao01, $connch21) or die(mysql_error());
$row_Rec_ggao01 = mysql_fetch_assoc($Rec_ggao01);
$totalRows_Rec_ggao01 = mysql_num_rows($Rec_ggao01);

mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao02 = "SELECT * FROM guanggao WHERE title = '首页手机靓号栏广告'";
$Rec_ggao02 = mysql_query($query_Rec_ggao02, $connch21) or die(mysql_error());
$row_Rec_ggao02 = mysql_fetch_assoc($Rec_ggao02);
$totalRows_Rec_ggao02 = mysql_num_rows($Rec_ggao02);

mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao3 = "SELECT * FROM guanggao WHERE title = '首页固定电话底广告'";
$Rec_ggao3 = mysql_query($query_Rec_ggao3, $connch21) or die(mysql_error());
$row_Rec_ggao3 = mysql_fetch_assoc($Rec_ggao3);
$totalRows_Rec_ggao3 = mysql_num_rows($Rec_ggao3);

mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao04 = "SELECT * FROM guanggao WHERE title = '首页车牌底部广告'";
$Rec_ggao04 = mysql_query($query_Rec_ggao04, $connch21) or die(mysql_error());
$row_Rec_ggao04 = mysql_fetch_assoc($Rec_ggao04);
$totalRows_Rec_ggao04 = mysql_num_rows($Rec_ggao04);

mysql_select_db($database_connch21, $connch21);
$query_Rec_gzptai = "SELECT * FROM guanggao WHERE title = '公众平台二维码'";
$Rec_gzptai = mysql_query($query_Rec_gzptai, $connch21) or die(mysql_error());
$row_Rec_gzptai = mysql_fetch_assoc($Rec_gzptai);
$totalRows_Rec_gzptai = mysql_num_rows($Rec_gzptai);

mysql_select_db($database_connch21, $connch21);
$query_Rec_syqqgl = "SELECT * FROM admin_wysz";
$Rec_syqqgl = mysql_query($query_Rec_syqqgl, $connch21) or die(mysql_error());
$row_Rec_syqqgl = mysql_fetch_assoc($Rec_syqqgl);
$totalRows_Rec_syqqgl = mysql_num_rows($Rec_syqqgl);

$maxRows_Recordset4 = 8;
$pageNum_Recordset4 = 0;
if (isset($_GET['pageNum_Recordset4'])) {
  $pageNum_Recordset4 = $_GET['pageNum_Recordset4'];
}
$startRow_Recordset4 = $pageNum_Recordset4 * $maxRows_Recordset4;

mysql_select_db($database_connch21, $connch21);
$query_Recordset4 = "SELECT * FROM sll ORDER BY id DESC";
$query_limit_Recordset4 = sprintf("%s LIMIT %d, %d", $query_Recordset4, $startRow_Recordset4, $maxRows_Recordset4);
$Recordset4 = mysql_query($query_limit_Recordset4, $connch21) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);

if (isset($_GET['totalRows_Recordset4'])) {
  $totalRows_Recordset4 = $_GET['totalRows_Recordset4'];
} else {
  $all_Recordset4 = mysql_query($query_Recordset4);
  $totalRows_Recordset4 = mysql_num_rows($all_Recordset4);
}
$totalPages_Recordset4 = ceil($totalRows_Recordset4/$maxRows_Recordset4)-1;

$maxRows_Rec_jlou = 8;
$pageNum_Rec_jlou = 0;
if (isset($_GET['pageNum_Rec_jlou'])) {
  $pageNum_Rec_jlou = $_GET['pageNum_Rec_jlou'];
}
$startRow_Rec_jlou = $pageNum_Rec_jlou * $maxRows_Rec_jlou;

mysql_select_db($database_connch21, $connch21);
$query_Rec_jlou = "SELECT * FROM sj WHERE jlou = '1' ORDER BY id DESC";
$query_limit_Rec_jlou = sprintf("%s LIMIT %d, %d", $query_Rec_jlou, $startRow_Rec_jlou, $maxRows_Rec_jlou);
$Rec_jlou = mysql_query($query_limit_Rec_jlou, $connch21) or die(mysql_error());
$row_Rec_jlou = mysql_fetch_assoc($Rec_jlou);

if (isset($_GET['totalRows_Rec_jlou'])) {
  $totalRows_Rec_jlou = $_GET['totalRows_Rec_jlou'];
} else {
  $all_Rec_jlou = mysql_query($query_Rec_jlou);
  $totalRows_Rec_jlou = mysql_num_rows($all_Rec_jlou);
}
$totalPages_Rec_jlou = ceil($totalRows_Rec_jlou/$maxRows_Rec_jlou)-1;

mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao05 = "SELECT * FROM guanggao WHERE title = '首页400电话底广告'";
$Rec_ggao05 = mysql_query($query_Rec_ggao05, $connch21) or die(mysql_error());
$row_Rec_ggao05 = mysql_fetch_assoc($Rec_ggao05);
$totalRows_Rec_ggao05 = mysql_num_rows($Rec_ggao05);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<meta name="applicable-device" content="mobile">
    <meta name="format-detection" content="telephone=no">
	<meta charset="UTF-8">
				
		<!--<link rel="dns-prefetch" href="http://static1.hrblh.com/">
			
		<link rel="dns-prefetch" href="http://static2.hrblh.com/">
			
		<link rel="dns-prefetch" href="http://static3.hrblh.com/">-->
					<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=yes">
	<meta name="format-detection" content="email=no">
   <?php include("../keyword.php");?>
	<meta name="robots" content="All">
	<meta http-equiv="Content-Language" content="zh_CN">
	<meta name="author" content="lezhizhe_net">
	<meta name="copyright" content="hrblh.com">
	
	<link href="./index_files/swiper.min.css" rel="stylesheet" type="text/css">
	<link href="./index_files/m.public.css" rel="stylesheet" type="text/css">

	
	<link href="./index_files/m.home.css" rel="stylesheet" type="text/css">
</head>

<body class="index">
<?php include("top.php");?>

	<!-- banner -->
	<div id="top-slide" class="swiper-container top-slide swiper-container-horizontal" data-swiper="[object Object]">
		<div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
						<div class="swiper-slide swiper-slide-active" style="width: 1423px;">
				<a href="filter.php" target="_blank"><img src="./index_files/593e3a55ec49f.png"></a>
			</div>
						<div class="swiper-slide swiper-slide-next" style="width: 1423px;">
				<a href="filter.php" target="_blank"><img src="./index_files/59292c9ec5bd5.jpg"></a>
			</div>
						<div class="swiper-slide" style="width: 1423px;">
				<a href="filter.php" target="_blank"><img src="./index_files/58d22908c7469.jpg"></a>
			</div>
								</div>
		<div class="swiper-pagination"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
	</div>
	<div class="nav">
		<ul>
			<li class="ico-phone"><a href="./filter.php"><i class="icon"></i><p>手机靓号</p></a></li>
			<!--<li class="ico-qq"><a href="http://#/qq/"><i class="icon"></i><p>QQ号</p></a></li>-->
			
			
			<li class="ico-tel"><a href="./gh.php"><i class="icon"></i><p>固定电话</p></a></li>
            <li class="ico-400"><a href="./400.php"><i class="icon"></i><p>400电话</p></a></li>
			<li class="ico-car"><a href="./cp.php"><i class="icon"></i><p>车牌靓号</p></a></li>
            <li class="ico-new"><a href="news.php"><i class="icon"></i><p>行业资讯</p></a></li>
			<!--<li class="ico-shop"><a href="http://#/yu/"><i class="icon"></i><p>美玉商城</p></a></li>-->
            <!-- <li class="ico-birth"><a href="/shengrihao/"><i class="icon"></i><p>生日靓号</p></a></li> -->
          <!--  <li class="ico-huishou"><a href="http://#/shouji/huishou/"><i class="icon"></i><p>靓号回收</p></a></li>-->
		</ul>
		<div class="clear"></div>
	</div>
	<!-- guess -->
	<!--<div class="guess">
		<span>推荐</span><div class="local-city"><a href="javascrip:;">正在定位</a></div><a href="http://#/chengdu/">成都站</a><a href="http://#/beijing/">北京站</a>
		<div class="clear"></div>
	</div>-->
	<div class="clear"></div>
	<div class="zhongjie">
		<ul class="huodong">
			<li><a href="filter.php"><img src="./index_files/shuang-1.jpg" alt="金牌靓号经纪人"></a></li>
			<li>
				<div class="shop_img bd_lc1">
					<a class="bd_bc1" href="filter.php">
						<img src="./index_files/shuang-3.jpg" alt="手机靓号">
					</a>
				</div>
				<div class="shop_img bd_lc1">
					<a href="filter.php">
						<img src="./index_files/shuang-4.jpg" alt="中期移动号码">
					</a>
				</div>
			</li>
			<div class="clear"></div>
		</ul>
	</div>
    <!--三连广告位-->
    <!--<div class="column-3">
    			<a href="http://#/yu/bajian/" target="_blank" style="background-color: #f6eff3;">
        	<div class="pic-head">
                <h3 class="main-tit">把件专区</h3>
                <div class="sub-tit">纯手工雕刻</div>
			</div>
            <div class="pic-wrap"><img alt="把件专区" class="" src="./index_files/590862634c04e.png"> </div></a>
        		<a href="http://#/yu/guajian/" target="_blank" style="background-color: #f1f2f7;">
        	<div class="pic-head">
                <h3 class="main-tit">挂件专区</h3>
                <div class="sub-tit">珍品收藏</div>
			</div>
            <div class="pic-wrap"><img alt="挂件专区" class="" src="./index_files/5908625557875.png"> </div></a>
        		<a href="http://#/yu/shouzhuo/" target="_blank">
        	<div class="pic-head">
                <h3 class="main-tit">玉镯专区</h3>
                <div class="sub-tit">正品保证</div>
			</div>
            <div class="pic-wrap"><img alt="玉镯专区" class="" src="./index_files/590862773949a.png"> </div></a>
            </div>-->
    	<!--号码展示-->
        <div class="haoma">
		<div class="haomabt">
			<i></i><span><a href="javascript:void(0);" target="_blank">号码捡漏</a></span>
		</div>
		<ul class="hmlist">
        
        <?php do { ?>
						   <li><a href="filter_xy.php?id=<?php echo $row_Rec_jlou['id']; ?>&pid=<?php echo $row_Rec_jlou['pid']; ?>&tel=<?php echo $row_Rec_jlou['tel']; ?>" target="_blank">
				<h2><i class="icon liang"></i>
				<?php error_reporting(E_ALL & ~E_NOTICE); 
				 $j_red=$row_Rec_jlou['info_top']; 
				 switch ($j_red)
						{
						case 0:
						echo $row_Rec_jlou['sj_hao'];
						break;
						case 1:
						echo substr($row_Rec_jlou['sj_hao'],0,8);
						break;
				        case 2:
						echo substr($row_Rec_jlou['sj_hao'],0,7);
						break;
						case 3:
						echo substr($row_Rec_jlou['sj_hao'],0,6);
						break;
				          } ?><span class="yellow"><?php 
						  // $j_red01=$row_Recordset1['sj_hao']; 
						  
						  switch ($j_red)
						{
						case 0:
						echo "";
						break;
						case 1:
						echo substr($row_Rec_jlou['sj_hao'],8,3);
						break;
				        case 2:
						echo substr($row_Rec_jlou['sj_hao'],7,4);
						break;
						 case 3:
						echo substr($row_Rec_jlou['sj_hao'],6,5);
						break;
				          } ?></span>
				</h2>
				<p><span><?php  $a=$row_Rec_jlou['id'];
				switch ($a)
						{
						case 1:
						echo "哈尔滨";
						break;
						case 2:
						echo "齐齐哈尔";
						break;
						
						case 3:
						echo "牡丹江";
						break;
							
						case 4:
						echo "佳木斯";
						break;	
						
						case 5:
						echo "绥化";
						break;	
						case 6:
						echo "黑河";
						break;	
						case 7:
						echo "大兴安岭";
						break;
						case 8:
						echo "伊春";
						break;
						case 9:
						echo "大庆";
						break;
						
						case 10:
						echo "鸡西";
						break;
						case 11:
						echo "鹤岗";
						break;
						case 12:
						echo "双鸭山";
						break;
						case 13:
						echo "七台河";
						break;
						
							} ?> 
        <?php $b=$row_Rec_jlou['tel'];
					switch ($b)
						{
						case 1:
						echo "移动";
						break;
						case 2:
						echo "联通";
						break;
						
						case 3:
						echo "电信";
						break;
						}
					
					 ?></span><span>￥<span class="red"><?php echo $row_Rec_jlou['s_price']; ?></span></span></p></a></li>
                <?php } while ($row_Rec_jlou = mysql_fetch_assoc($Rec_jlou)); ?>
                
						<div class="clear"></div>
		</ul>  
        <div id="news_more" classid="1" class="jzgd"><a href="filter_jlou.php">查看更多</a><i class="gdicon icon"></i></div>
	</div>
        
        <div class="clear"></div>
        
    <div class="haoma">
		<div class="haomabt">
			<i></i><span><a href="javascript:void(0);" target="_blank">手机靓号</a></span>
		</div>
		<ul class="hmlist">
        
        <?php do { ?>
						   <li><a href="filter_xy.php?id=<?php echo $row_Recordset1['id']; ?>&pid=<?php echo $row_Recordset1['pid']; ?>&tel=<?php echo $row_Recordset1['tel']; ?>" target="_blank">
				<h2><i class="icon liang"></i>
				<?php error_reporting(E_ALL & ~E_NOTICE); 
				 $j_red=$row_Recordset1['info_top']; 
				 switch ($j_red)
						{
						case 0:
						echo $row_Recordset1['sj_hao'];
						break;
						case 1:
						echo substr($row_Recordset1['sj_hao'],0,8);
						break;
				        case 2:
						echo substr($row_Recordset1['sj_hao'],0,7);
						break;
						case 3:
						echo substr($row_Recordset1['sj_hao'],0,6);
						break;
				          } ?><span class="yellow"><?php 
						  // $j_red01=$row_Recordset1['sj_hao']; 
						  
						  switch ($j_red)
						{
						case 0:
						echo "";
						break;
						case 1:
						echo substr($row_Recordset1['sj_hao'],8,3);
						break;
				        case 2:
						echo substr($row_Recordset1['sj_hao'],7,4);
						break;
						 case 3:
						echo substr($row_Recordset1['sj_hao'],6,5);
						break;
				          } ?></span>
				</h2>
				<p><span><?php  $a=$row_Recordset1['pid'];
				switch ($a)
						{
						case 1:
						echo "哈尔滨";
						break;
						case 2:
						echo "齐齐哈尔";
						break;
						
						case 3:
						echo "牡丹江";
						break;
							
						case 4:
						echo "佳木斯";
						break;	
						
						case 5:
						echo "绥化";
						break;	
						case 6:
						echo "黑河";
						break;	
						case 7:
						echo "大兴安岭";
						break;
						case 8:
						echo "伊春";
						break;
						case 9:
						echo "大庆";
						break;
						
						case 10:
						echo "鸡西";
						break;
						case 11:
						echo "鹤岗";
						break;
						case 12:
						echo "双鸭山";
						break;
						case 13:
						echo "七台河";
						break;
						
							} ?> 
					<?php $b=$row_Recordset1['tel'];
					switch ($b)
						{
						case 1:
						echo "移动";
						break;
						case 2:
						echo "联通";
						break;
						
						case 3:
						echo "电信";
						break;
						}
					
					 ?></span><span>￥<span class="red"><?php echo $row_Recordset1['s_price']; ?></span></span></p></a></li><?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
       
                
                
						<div class="clear"></div>
		</ul>  
        <div id="news_more" classid="1" class="jzgd"><a href="filter.php">查看更多</a><i class="gdicon icon"></i></div>
	</div>
	<!--<div class="haoma">
		<div class="haomabt">
			<i></i><span><a href="http://#/qq/" target="_blank">QQ靓号区</a></span>
		</div>
		<ul class="hmlist">
						<li><a href="http://#/qq/501-33560792.htm"><h2><span class="yellow">3356</span>0792</h2><p><span>45级</span><span>￥<span class="red">218</span></span></p></a></li>
						<li><a href="http://#/qq/501-51290955.htm"><h2><span class="yellow">5129</span>0955</h2><p><span>31级</span><span>￥<span class="red">173</span></span></p></a></li>
						<li><a href="http://#/qq/501-55689808.htm"><h2><span class="yellow">5568</span>9808</h2><p><span>48级</span><span>￥<span class="red">456</span></span></p></a></li>
						<li><a href="http://#/qq/501-77428984.htm"><h2><span class="yellow">7742</span>8984</h2><p><span>52级</span><span>￥<span class="red">539</span></span></p></a></li>
						<li><a href="http://#/qq/1005-576872.htm"><h2><span class="yellow">5768</span>72</h2><p><span>41级</span><span>￥<span class="red">11.31万</span></span></p></a></li>
						<li><a href="http://#/qq/1005-3333336.htm"><h2><span class="yellow">3333</span>336</h2><p><span>81级</span><span>￥<span class="red">13万</span></span></p></a></li>
						<li><a href="http://#/qq/501-463237461.htm"><h2><span class="yellow">4632</span>37461</h2><p><span>25级</span><span>￥<span class="red">51</span></span></p></a></li>
						<li><a href="http://#/qq/501-565789997.htm"><h2><span class="yellow">5657</span>89997</h2><p><span>21级</span><span>￥<span class="red">51</span></span></p></a></li>
						<div class="clear"></div>
		</ul>  
        <div id="news_more" classid="1" class="jzgd"><a href="http://#/qq/" target="_blank">查看更多</a><i class="gdicon icon"></i></div> 
	</div>-->
	<div class="clear"></div>
    
  
   
	<div class="haoma">
		<div class="haomabt">
			<i></i><span><a href="javascript:void(0);" target="_blank">400靓号区</a></span>
		</div>
		<ul class="hmlist">
        <?php do { ?>
				 <li><a href="sLL_xy.php?id=<?php echo $row_Recordset4['id']; ?>" ><h2><span class="yellow"><?php echo  substr( $row_Recordset4['sLL_hao'],0,4); ?></span><?php echo  substr( $row_Recordset4['sLL_hao'],4,6); ?></h2><p><span><?php $c=$row_Recordset4['c']; 
  switch($c){
	  case 0: 
	  echo "无规率";
	  break;
	  
	case 1: 
	  echo "普通号码";
	  break;
	  case 2: 
	  echo "尾数ABCDE+";
	  break;
	  case 3: 
	  echo "尾数AAAAA+ ";
	  break; 
	  
	  case 4: 
	  echo "尾数AAABBB";
	  break; 
	  case 5: 
	  echo "尾数AABBCC";
	  break; 
	  case 6: 
	  echo "尾数ABCABC ";
	  break; 
	  case 7: 
	  echo "尾数ABBABB ";
	  break; 
	  case 8: 
	  echo "尾数AABAA ";
	  break; 
	  case 9: 
	  echo "尾数AAABB ";
	  break; 
	  case 10: 
	  echo "尾数AABBB ";
	  break; 
	  case 11: 
	  echo "尾数ABCDE ";
	  break; 
	  case 12: 
	  echo "尾数AAAAA ";
	  break; 
	  
	  case 13: 
	  echo "尾数ABCD ";
	  break;
	  case 14: 
	  echo "尾数AAAA";
	  break;
	  case 15: 
	  echo "尾数AABB ";
	  break;
	  case 16: 
	  echo "尾数ABBA";
	  break;
	  case 17: 
	  echo "尾数AAAB";
	  break;
	  case 18: 
	  echo "尾数ABAB";
	  break;
	  case 19: 
	  echo "尾数AAA";
	  break;
	  case 20: 
	  echo "尾数ABC";
	  break;
	  case 21: 
	  echo "中间AAABBB";
	  break;
	  case 22: 
	  echo "中间AAAA+";
	  break;
	  case 23: 
	  echo "中间AABBB";
	  break;
	  case 24: 
	  echo "中间AAABB";
	  break;
	  case 25: 
	  echo "中间AAAA";
	  break;
	  case 26: 
	  echo "中间AABB";
	  break;
	  case 27: 
	  echo "中间AAA";
	  break;
	  case 28: 
	  echo "中间AABBCC";
	  break;
	
	  
	  
  }
  
  
  ?></span><span>￥<span class="red"><?php echo $row_Recordset4['s_price']; ?></span></span></p></a></li>
  
   <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
				
		        <div class="clear"></div>
		</ul> 
        <div id="news_more" classid="1" class="jzgd"><a href="400.php" target="_blank">查看更多</a><i class="gdicon icon"></i></div> 
	</div>
	<div class="clear"></div>
  
  
    <div class="haoma">
		<div class="haomabt">
			<i></i><span><a href="javascript:void(0);" target="_blank">固定电话靓号区</a></span>
		</div>
		<ul class="hmlist">
         <?php do { ?>
					<li><a href="gh_xy.php?id=<?php echo $row_Recordset2['id']; ?>" target="_blank"><h2><span class="yellow"><?php echo substr($row_Recordset2['gh_hao'],0,4); ?>-</span><?php echo substr($row_Recordset2['gh_hao'],4,8); ?></h2><p><span><?php echo $row_Recordset2['smalltype']; ?></span><span>￥<span class="red"><?php echo $row_Recordset2['s_price']; ?></span></span></p></a></li>
                    
                       <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
							 
        <div class="clear"></div>
		</ul>  
        <div id="news_more" classid="1" class="jzgd"><a href="gh.php" target="_blank">查看更多</a><i class="gdicon icon"></i></div> 
	</div>
	<div class="clear"></div>
    
   	
	
	<div class="haoma">
		<div class="haomabt">
			<i></i><span><a href="javascript:void(0);" target="_blank">车牌靓号区</a></span>
		</div>
		<ul class="hmlist">
          <?php do { ?>
							<li><a href="cp_xy.php?id=<?php echo $row_Recordset3['id']; ?>" target="_blank"><h2><span class="yellow"><?php echo substr($row_Recordset3['cp_hao'],0,5); ?></span><?php echo substr($row_Recordset3['cp_hao'],5,6); ?></h2><p><span><?php echo $row_Recordset3['smalltype']; ?></span><span>￥<span class="red"><?php echo $row_Recordset3['s_price']; ?></span></span></p></a></li>
					
                     <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>		
						<div class="clear"></div>
		</ul>  
        <div id="news_more" classid="1" class="jzgd"><a href="cp.php" target="_blank">查看更多</a><i class="gdicon icon"></i></div> 
	</div>
	<div class="clear"></div>

	<div class="new_index">
		<div class="new-tabs">
			<a href="http://#/#" class="active">本站公告</a>
			<a href="http://#/#">行业新闻</a> 
           
		</div>
		<div id="new-tabs-container" class="swiper-container swiper-container-horizontal" data-swiper="[object Object]">
			<div class="swiper-wrapper">
				<div class="swiper-slide swiper-slide-active" style="width: 1423px;">
					<ul class="index_new" id="noticelist" page="2">
											<!--<li><a href="#">未来已来，你来不来？ 红豆电信诚招手机号码销售合作商</a></li>-->
											 <?php do { ?>
                <li><a href="news_xy.php?news_id=<?php echo $row_Rec_gogao['news_id']; ?>" title="<?php echo $row_Rec_gogao['news_title']; ?>" target="_blank"><font color=""><?php echo $row_Rec_gogao['news_title']; ?></font></a></li>
                <?php } while ($row_Rec_gogao = mysql_fetch_assoc($Rec_gogao)); ?>
										</ul>
					<div id="news_more" classid="1" class="jzgd"><a href="news_ggao.php" target="_blank">查看更多</a><i class="gdicon icon"></i></div>
				</div>
				<div class="swiper-slide swiper-slide-next" style="width: 1423px;">
					<ul class="index_new" id="newslist" page="2">
										  <?php do { ?>
          <li><a href="news_xy.php?news_id=<?php echo $row_Rec_news1['news_id']; ?>" title="<?php echo $row_Rec_news1['news_title']; ?>" target="_blank"><?php echo $row_Rec_news1['news_title']; ?></a></li>
          <?php } while ($row_Rec_news1 = mysql_fetch_assoc($Rec_news1)); ?>
										</ul>
					<div id="notice_more" classid="2" page="2" class="jzgd"><a href="news.php" target="_blank">查看更多</a><i class="gdicon icon"></i></div>
				</div>
			</div>
		</div>
	</div>
	<div class="friendlink">友情链接：
	
				<?php do { ?>
        <a href="<?php echo $row_Rec_yqlj['url']; ?>" target="_blank"><?php echo $row_Rec_yqlj['name']; ?>&nbsp;&nbsp;</a>
        <?php } while ($row_Rec_yqlj = mysql_fetch_assoc($Rec_yqlj)); ?> 
			</div>
    <!--<div class="index_kefu"><a href="tel:18537787182"><i class="index_tel"></i>电话咨询</a><a href="http://p.qiao.baidu.com/cps/chat?siteId=10116005&userId=18077514"><i class="index_contact"></i>在线咨询</a></div>-->
    
    <!--<div class="#####_kefu"><a href="http://p.qiao.#####.com/cps/chat?siteId=10116005&userId=18077514"><img width="100%" src="./index_files/kefu_icon.png"></a></div>-->
		<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->




<script src="./index_files/country.js"></script>
<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Rec_tjian);

mysql_free_result($Rec_tjian2);

mysql_free_result($Rec_tjian3);

mysql_free_result($Rec_gogao);

mysql_free_result($Rec_halp1);

mysql_free_result($Rec_halp2);

mysql_free_result($Rec_news1);

mysql_free_result($Rec_news1_1);

mysql_free_result($Rec_news2_1);

mysql_free_result($Rec_news2);

mysql_free_result($Rec_news3);

mysql_free_result($Rec_yqlj);

mysql_free_result($Rec_ggao01);

mysql_free_result($Rec_ggao02);

mysql_free_result($Rec_ggao3);

mysql_free_result($Rec_ggao04);

//mysql_free_result($Rec_gzptai);

mysql_free_result($Rec_syqqgl);

mysql_free_result($Recordset4);

mysql_free_result($Rec_jlou);

mysql_free_result($Rec_ggao05);
?>
