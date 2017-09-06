<?php require_once('Connections/connch21.php'); ?>
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

$maxRows_Recordset1 = 25;
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

$maxRows_Recordset2 = 20;
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

$maxRows_Recordset3 = 25;
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

$maxRows_Recordset4 = 20;
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

$maxRows_Rec_jlou = 20;
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

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<link rel="dns-prefetch" href="http://static1.#.com/">
<link rel="dns-prefetch" href="http://static2.#.com/">
<link rel="dns-prefetch" href="http://static3.#.com/">
<meta name="applicable-device" content="pc">
<?php include("keyword.php");?>
<meta name="robots" content="All">
<meta name="verify-v1" content="casZho9kECUkOAU+2uY1SGpjeqJiwu0o/ALrzgPNKFo=">
<meta name="AizhanSEO" content="a2511a4d1a6a1b0fe57f5ce001438cc9">
<meta http-equiv="Content-Language" content="zh_CN">
<meta name="author" content="lezhizhe.net">
<meta name="copyright" content="#.com">

<link href="./index_files/public.css" rel="stylesheet" type="text/css">
<meta name="mobile-agent" content="format=html5;url=http://m.#.com/">
<link href="./index_files/index.css" rel="stylesheet" type="text/css">


<script type="text/javascript">  

function openwindow(url,name,iWidth,iHeight)  
{  
// url 转向网页的地址   
// name 网页名称，可为空   
// iWidth 弹出窗口的宽度   
// iHeight 弹出窗口的高度   
//window.screen.height获得屏幕的高，window.screen.width获得屏幕的宽   
var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;   
var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;   
window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');  
}  

</script>  
</head>
<body>

<?php include("nav.php");?>

<div id="bj" style="display: none;"></div>
<div class="banner">
  <div class="mainbanner">
    <div class="mainbanner_window">
      <ul id="slideContainer">
        <li><a href="#/u/400/" target="_blank"><img src="images/<?php echo $row_Rec_ggao01['gg_photo1']; ?>"></a></li>
        <li><a href="#/escrow/52222/" target="_blank"><img src="images/<?php echo $row_Rec_ggao01['gg_photo2']; ?>"></a></li>
        <li><a href="#/escrow/5555/" target="_blank"><img src="images/<?php echo $row_Rec_ggao01['gg_photo3']; ?>"></a></li>
        <li><a href="#/escrow/633/" target="_blank"><img src="images/<?php echo $row_Rec_ggao01['gg_photo4']; ?>"></a></li>
      </ul>
    </div>
    <ul class="mainbanner_list">
      <li><a href="javascript:void(0);">1</a></li>
      <li><a href="javascript:void(0);">2</a></li>
      <li><a href="javascript:void(0);">3</a></li>
      <li><a href="javascript:void(0);">4</a></li>
    </ul>
    
    <!--banner左侧选项卡--> 
    <script type="text/javascript">
		<!--
		function setTab(name,cursel,n){
		for(i=1;i<=n;i++){
		var menu=document.getElementById(name+i);
		var con=document.getElementById("con_"+name+"_"+i);
		menu.className=i==cursel?"hover":"";
		con.style.display=i==cursel?"block":"none";
		}
	}
	//-->
	</script>
    <div id="lib_Tab1">
      <div class="lib_Menubox lib_tabborder">
        <ul>
          <li id="one1" onclick="setTab(&#39;one&#39;,1,6)" class="hover"><span>手机靓号</span></li>
          <li id="one2" onclick="setTab(&#39;one&#39;,2,6)"><span>固定电话</span></li>
          <li id="one3" onclick="setTab(&#39;one&#39;,3,6)"><span>车牌号</span></li>
        <!-- <li id="one4" onclick="setTab(&#39;one&#39;,5,6)"><span>QQ号</span></li>-->
          <li id="one4" onclick="setTab(&#39;one&#39;,4,6)"><span>400电话</span></li>
         <!-- <li id="one6" onclick="setTab(&#39;one&#39;,6,6)"><span>私人定制</span></li>-->
        </ul>
      </div>
      <div class="lib_Contentbox lib_tabborder">
        <div id="con_one_1" class="text_div">
          <div class="b_bt">选择运营商：</div>
          <ul class="b_check">
            <li><a href="filter.php?tel=1">中国移动</a></li>
            <li><a href="filter.php?tel=2">中国联通</a></li>
            <li><a href="filter.php?tel=3">中国电信</a></li>
           <li><a href="filter.php?tel=4">虚拟运营商</a></li>
            <div class="clear"></div>
          </ul>
          <div class="b_bt">热门城市：</div>
          <ul class="b_check">
            <li><a href="filter.php?pid=1">哈尔滨</a></li>
            <li><a href="filter.php?pid=2">齐齐哈尔</a></li>
            <li><a href="filter.php?pid=3">牡丹江</a></li>
            <li><a href="filter.php?pid=4">佳木斯</a></li>
            <li><a href="filter.php?pid=5">绥化</a></li>
           <!-- <li><a href="filter.php?pid=6">黑河</a></li>
            <li><a href="filter.php?pid=7">大兴安岭</a></li>-->
            <li><a href="filter.php">更多</a></li>
            <div class="clear"></div>
          </ul>
          <div class="b_bt">价格区间：</div>
          <ul class="b_check">
            <li><a href="filter.php?price=1">价格面议</a></li>
            <!--<li><a href="#/escrow/search.htm?pricescope=2">100-500元</a></li>
            <li><a href="#/escrow/search.htm?pricescope=3">500-1000元</a></li>
            <li><a href="#/escrow/search.htm?pricescope=4">1000-2000元</a></li>-->
            <li><a href="filter.php?price=2">2000-5000元</a></li>
            <li><a href="filter.php?price=3">5000-10000元</a></li>
            <li><a href="filter.php?price=4">10000元以上</a></li>
            <div class="clear"></div>
          </ul>
          <div class="b_bt">热门规律：</div>
          <ul class="b_check">
            <li><a href="filter.php?day=4">尾数AAAA</a></li>
            <li><a href="filter.php?day=6">尾数ABCD</a></li>
            <li><a href="filter.php?day=15">尾数AAABB</a></li>
            <li><a href="filter.php?day=26">中间AAA</a></li>
            <div class="clear"></div>
          </ul>
        </div>
        <div id="con_one_2" class="text_div" style="display:none">
          <div class="b_bt">选择类型：</div>
          <ul class="b_check">
            <li><a href="search.php?m2=1">有线</a></li>
            <li><a href="search.php?m1=-1">无线</a></li>
            <li><a href="search.php?m3=2">商务一号通</a></li>
            <div class="clear"></div>
          </ul>
          <div class="b_bt">价格区间：</div>
          <ul class="b_check">
            <li><a href="search.php?price=1">100元以下</a></li>
            <li><a href="search.php?price=2">100-500元</a></li>
            <li><a href="search.php?price=3">500-1000元</a></li>
            <li><a href="search.php?price=4">1000-2000元</a></li>
            <li><a href="search.php?price=5">2000-5000元</a></li>
            <li><a href="search.php?price=6">5000-10000元</a></li>
            <li><a href="search.php?price=7">10000元以上</a></li>
            <div class="clear"></div>
          </ul>
          <div class="b_bt">热门规律：</div>
          <ul class="b_check">
            <li><a href="search.php?grade=10">尾数AAAA+</a></li>
            <li><a href="search.php?grade=2">尾数ABC</a></li>
            <li><a href="search.php?grade=7">尾数AABBCC</a></li>
            <li><a href="search.php?grade=1">尾数AAA</a></li>
            <div class="clear"></div>
          </ul>
        </div>
        <div id="con_one_3" class="text_div" style="display:none">
          <div class="b_bt">热门地区：</div>
          <ul class="b_check">
            <li><a href="cp_search.php?bigtype=1&smalltype=哈尔滨&grade=&key=&tj=">哈尔滨</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=齐齐哈尔&grade=&key=&tj=">齐齐哈尔</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=牡丹江&grade=&key=&tj=">牡丹江</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=佳木斯&grade=&key=&tj=">佳木斯</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=绥化&grade=&key=&tj=">绥化</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=黑河&grade=&key=&tj=">黑河</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=大兴安岭&grade=&key=&tj=">大兴安岭</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=伊春&grade=&key=&tj=">伊春</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=大庆&grade=&key=&tj=">大庆</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=鸡西&grade=&key=&tj=">鸡西</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=鹤岗&grade=&key=&tj=">鹤岗</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=双鸭山&grade=&key=&tj=">双鸭山</a></li>
            <li><a href="cp_search.php?bigtype=1&smalltype=七台河&grade=&key=&tj=">七台河</a></li>
            
            <div class="clear"></div>
          </ul>
        </div>
        <div id="con_one_5" class="text_div" style="display:none">
          <div class="b_bt">热门位数：</div>
          <ul class="b_check">
            <li><a href="#/qq/5/">5位</a></li>
            <li><a href="#/qq/6/">6位</a></li>
            <li><a href="#/qq/7/">7位</a></li>
            <li><a href="#/qq/8/">8位</a></li>
            <li><a href="#/qq/9/">9位</a></li>
            <li><a href="#/qq/10/">10位</a></li>
            <li><a href="#/qq/11/">11位</a></li>
            <div class="clear"></div>
          </ul>
          <div class="b_bt">热门主题：</div>
          <ul class="b_check">
            <li><a href="#/qq/all/all-all-all-all-1-all-all-1.htm">三连号</a></li>
            <li><a href="#/qq/all/all-all-all-all-2-all-all-1.htm">四连号</a></li>
            <li><a href="#/qq/all/all-all-all-all-3-all-all-1.htm">五连号</a></li>
            <li><a href="#/qq/all/all-all-all-all-4-all-all-1.htm">顺子号</a></li>
            <div class="clear"></div>
          </ul>
          <div class="b_bt">价格区间：</div>
          <ul class="b_check">
            <li><a href="#/qq/all/all-1-all-all-all-all-all-1.htm">0-100元</a></li>
            <li><a href="#/qq/all/all-2-all-all-all-all-all-1.htm">100-500元</a></li>
            <li><a href="#/qq/all/all-3-all-all-all-all-all-1.htm">500-1000元</a></li>
            <li><a href="#/qq/all/all-4-all-all-all-all-all-1.htm">1000-2000元</a></li>
            <li><a href="#/qq/all/all-5-all-all-all-all-all-1.htm">2000-5000元</a></li>
            <li><a href="#/qq/all/all-6-all-all-all-all-all-1.htm">5000-10000元</a></li>
            <li><a href="#/qq/all/all-7-all-all-all-all-all-1.htm">10000元以上</a></li>
            <div class="clear"></div>
          </ul>
          <div class="b_bt">密保状态：</div>
          <ul class="b_check">
            <li><a href="#/qq/all/all-all-all-0-all-all-all-1.htm">无密保</a></li>
            <li><a href="#/qq/all/all-all-all-1-all-all-all-1.htm">一代密保</a></li>
            <li><a href="#/qq/all/all-all-all-2-all-all-all-1.htm">二代密保</a></li>
            <div class="clear"></div>
          </ul>
        </div>
        <div id="con_one_4" class="text_div" style="display:none">
          <div class="b_bt">热门号段：</div>
          <ul class="b_check">
            <li><a href="400_soso.php?a=4000">联通4000</a></li>
            <li><a href="400_soso.php?a=4006">联通4006</a></li>
            <li><a href="400_soso.php?a=4001">移动4001</a></li>
            <li><a href="400_soso.php?a=4007">移动4007</a></li>
            <li><a href="400_soso.php?a=4008">电信4008</a></li>
            <li><a href="400_soso.php?a=4009">电信4009</a></li>
            <div class="clear"></div>
          </ul>
          <div class="b_bt">热门主题：</div>
          <ul class="b_check">
            <li><a href="400_soso.php?c=19">尾数AAA</a></li>
            <li><a href="400_soso.php?c=20">尾数ABC</a></li>
            <li><a href="400_soso.php?c=15">尾数AABB</a></li>
            <li><a href="400_soso.php?c=25">中间AAAA</a></li>
            <li><a href="400_soso.php?c=5">中间AABBCC</a></li>
            <div class="clear"></div>
          </ul>
          <div class="b_bt">价格区间：</div>
          <ul class="b_check">
            <li><a href="400_soso.php?b=1">800元以下</a></li>
            <li><a href="400_soso.php?b=2">800-1500元</a></li>
            <li><a href="400_soso.php?b=3">1500-3000元</a></li>
            <li><a href="400_soso.php?b=4">3000-5000元</a></li>
            <li><a href="400_soso.php?b=5">5000-9000元</a></li>
            <li><a href="400_soso.php?b=6">9000-8万元</a></li>
            <li><a href="400_soso.php?b=7">8万元以上</a></li>
            <div class="clear"></div>
          </ul>
        </div>
        <div id="con_one_6" class="text_div" style="display:none">
          <ul class="b_check">
            <li><a href="#/shouji/yuding.htm" target="_blank">定制手机靓号</a></li>
            <li><a href="#/dianhua/yuding.htm" target="_blank">定制固定电话</a></li>
            <li><a href="#/chepai/yuding.htm" target="_blank">定制车牌号</a></li>
            <li><a href="#/qq/yuding.htm" target="_blank">定制QQ号</a></li>
            <li><a href="#/400/yuding.htm" target="_blank">定制400</a></li>
            <div class="clear"></div>
          </ul>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!--banner结束--> 

<!--店铺排行榜-->
<div class="main01">
  <div class="fl rank">
    <div class="rank_bt rank_bt03"> 推荐用户 </div>
    <ul class="rank_con">
      <?php do { ?>
        <li><a href="news_xy.php?news_id=<?php echo $row_Rec_tjian['news_id']; ?>" target="_blank" title="<?php echo $row_Rec_tjian['news_title']; ?>"><font color="#ff0000"><?php echo $row_Rec_tjian['news_title']; ?></font></a></li>
        <?php } while ($row_Rec_tjian = mysql_fetch_assoc($Rec_tjian)); ?>
      
    </ul>
  </div>
  <div class="fl rank">
    <div class="rank_bt rank_bt03"> 推荐用户 </div>
    <ul class="rank_con">
      <?php do { ?>
        <li><a href="news_xy.php?news_id=<?php echo $row_Rec_tjian2['news_id']; ?>" target="_blank" rel="nofollow" title="<?php echo $row_Rec_tjian2['news_title']; ?>"><font color="#0000ff"><?php echo $row_Rec_tjian2['news_title']; ?></font></a></li>
        <?php } while ($row_Rec_tjian2 = mysql_fetch_assoc($Rec_tjian2)); ?>
      
    </ul>
  </div>
  <div class="fl rank">
    <div class="rank_bt rank_bt03"> 推荐用户 </div>
    <ul class="rank_con">
      <?php do { ?>
        <li><a href="news_xy.php?news_id=<?php echo $row_Rec_tjian3['news_id']; ?>" target="_blank" title="<?php echo $row_Rec_tjian3['news_title']; ?>"><font color="#ff0000"><?php echo $row_Rec_tjian3['news_title']; ?></font></a></li>
        <?php } while ($row_Rec_tjian3 = mysql_fetch_assoc($Rec_tjian3)); ?>
      
    </ul>
  </div>
  <!-- 店铺排行榜结束-->
  <div class="fr">
    <div class="preview">
      <div class="scrolldoorFrame">
        <ul class="scrollUl">
          <li class="gg01" id="n01" value="0"><a href="#/news/class_1/1">本站公告</a></li>
          <li class="gg02" id="n02" value="1"><a href="#/news/class_9/1">买家帮助</a></li>
          <li class="gg02" id="n03" value="2"><a href="#/news/class_10/1">用户帮助</a></li>
        </ul>
        <div class="bor03 cont">
<div id="y01" style="display:block;">
            <ul class="news_con">
              <?php do { ?>
                <li><a href="news_xy.php?news_id=<?php echo $row_Rec_gogao['news_id']; ?>" title="<?php echo $row_Rec_gogao['news_title']; ?>" target="_blank"><font color=""><?php echo $row_Rec_gogao['news_title']; ?></font></a></li>
                <?php } while ($row_Rec_gogao = mysql_fetch_assoc($Rec_gogao)); ?>
              
            </ul>
          </div>
          <div id="y02" style="display:none;">
            <ul class="news_con">
              <?php do { ?>
                <li><a href="news_xy.php?news_id=<?php echo $row_Rec_halp1['news_id']; ?>" title="<?php echo $row_Rec_halp1['news_title']; ?>" target="_blank"><font color=""><?php echo $row_Rec_halp1['news_title']; ?></font></a></li>
                <?php } while ($row_Rec_halp1 = mysql_fetch_assoc($Rec_halp1)); ?>
</div>
          <div id="y03" style="display:none;">
            <ul class="news_con">
              <?php do { ?>
              <li><a href="news_xy.php?news_id=<?php echo $row_Rec_halp2['news_id']; ?>" title="<?php echo $row_Rec_halp2['news_title']; ?>" target="_blank"><font color=""><?php echo $row_Rec_halp2['news_title']; ?></font></a></li>
                <?php } while ($row_Rec_halp2 = mysql_fetch_assoc($Rec_halp2)); ?>
              
            </ul>
</div>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>

<!--豆腐块广告-->
<!--<div class="main01">
  <ul class="index_big_picture">
    <li><a href="#/zhuanti/miaosha/" target="_blank"><img src="./index_files/5824251d5b46c.jpg" width="287" height="195"></a></li>
    <li><a href="#/news/show/8807" target="_blank"><img src="./index_files/582425b95489e.jpg" width="287" height="195"></a></li>
    <li><a href="#/paimai/1-all-1-1-all.htm" target="_blank"><img src="./index_files/5832667d0ff1a.jpg" width="287" height="195"></a></li>
    <li><a href="#/link.php?url=#/news/show/8808" target="_blank" rel="nofollow"><img src="./index_files/5832668fa4ce4.jpg" width="287" height="195"></a></li>
    <div class="clear"></div>
  </ul>
</div>-->


<div class="main01">
  <div class="number_09 ">
    <h2><a href="#/shouji/" target="_blank">号码捡漏</a></h2>
  </div>
<DIV class="number_left fl">
<P style="MARGIN-BOTTOM: 10px"><IMG src="index_files/jianlou.jpg" width=186 
height=113></P><A href="#" target=_blank><IMG 
src="index_files/birth02.jpg" width=186 height=113></A> <!--<div class="number_left_bt">优质中介</div>
		        <a href="http://www.jihaoba.com/u/4000" target="_blank" class="yzsj01"><img src="http://static2.jihaoba.com/7niu/upload/56f24882aea9c.jpg" width="84" height="84" alt="" /></a>
	            <a href="http://www.jihaoba.com/u/4000" target="_blank"><img src="http://static2.jihaoba.com/7niu/upload/570b11f73de03.jpg" width="84" height="84" alt="" /></a>
	    	    --></DIV>
<DIV class="number_right fr">
<DIV class=clear></DIV>
<DIV class=number_right_num>
<UL>
  <?php do { ?>
    <LI><a href="filter_xy.php?id=<?php echo $row_Rec_jlou['id']; ?>" target="_blank">
      <H2><I class=liang></I><?php error_reporting(E_ALL & ~E_NOTICE); 
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
				          } ?><SPAN class=yellow><?php 
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
				          } ?></SPAN> </H2>
      <P><SPAN class=fl><?php  $a=$row_Rec_jlou['id'];
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
					
					 ?></SPAN> <SPAN class=fr>￥<SPAN 
  class=red><?php echo $row_Rec_jlou['s_price']; ?></SPAN></SPAN> </P></A></LI>
    <?php } while ($row_Rec_jlou = mysql_fetch_assoc($Rec_jlou)); ?>
 
  
  <DIV class=clear></DIV>
  
  
  </UL></DIV></DIV>
<DIV class=clear></DIV></DIV>


<!--手机靓号-->
<div class="main01">
  <div class="number_01 ">
    <h2><a href="#/shouji/" target="_blank">手机靓号</a></h2>
  </div>
  <div class="number_left fl">
    <div class="number_left_bt">热门城市</div>
    <ul>
      <li><a target="_blank" href="filter.php?pid=1">哈尔滨</a></li>
      <li><a target="_blank" href="filter.php?pid=2">齐齐哈尔</a></li>
      <li><a target="_blank" href="filter.php?pid=3">牡丹江</a></li>
      <li><a target="_blank" href="filter.php?pid=4">佳木斯</a></li>
      <li><a target="_blank" href="filter.php?pid=5">绥化</a></li>
      <li><a target="_blank" href="filter.php?pid=6">黑河</a></li>
      <li><a target="_blank" href="filter.php?pid=7">大兴安岭</a></li>
      <li><a target="_blank" href="filter.php?pid=8">伊春</a></li>
      <li><a target="_blank" href="filter.php?pid=9">大庆</a></li>
      <li><a target="_blank" href="filter.php?pid=10">鸡西</a></li>
      <li><a target="_blank" href="filter.php?pid=11">鹤岗</a></li>
      <li><a target="_blank" href="filter.php?pid=12">双鸭山</a></li>
      <li><a target="_blank" href="filter.php?pid=13">七台河</a></li>
      <div class="clear"></div>
    </ul>
    <div class="number_left_bt">运营商</div>
    <ul>
      <li><a href="filter.php?tel=1" target="_blank" title="移动手机号">移动</a></li>
      <li><a href="filter.php?tel=2" target="_blank" title="联通手机号">联通</a></li>
      <li><a href="filter.php?tel=3" target="_blank" title="电信手机号">电信</a></li>
      
      <div class="clear"></div>
    </ul>
    <!--<div class="number_left_bt">优质中介</div>
		        <a href="#/u/4000" target="_blank" class="yzsj01"><img src="http://static2.#.com/7niu/upload/56f24882aea9c.jpg" width="84" height="84" alt="" /></a>
	            <a href="#/u/4000" target="_blank"><img src="http://static2.#.com/7niu/upload/570b11f73de03.jpg" width="84" height="84" alt="" /></a>
	    	    --> 
  </div>
  <div class="number_right fr">
    <div class="fr number_right_more"><a href="filter.php" class="blue">更多手机靓号</a></div>
    <ul class="fl number_right_city">
      <li><a href="filter.php?pid=1">哈尔滨手机靓号</a></li>
      <li><a href="filter.php?pid=2">齐齐哈尔手机靓号</a></li>
      <li><a href="filter.php?pid=3">牡丹江手机靓号</a></li>
      <li><a href="filter.php?pid=4">佳木斯手机靓号</a></li>
   <li><a href="filter.php?pid=5">绥化手机靓号</a></li>
     <!--    <li><a href="#/escrow/search.htm?cityid=3">手机靓号</a></li>-->
    </ul>
    <div class="clear"></div>
    <div class="number_right_num">
      <ul>
        <?php do { ?>
          <li> <a href="filter_xy.php?id=<?php echo $row_Recordset1['id']; ?>" target="_blank">
            <h2><i class="liang"></i> <?php error_reporting(E_ALL & ~E_NOTICE); 
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
				          } ?></span> </h2>
            <p> <span class="fl"><?php  $a=$row_Recordset1['pid'];
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
					
					 ?></span> <span class="fr">￥<span class="red"><?php echo $row_Recordset1['s_price']; ?></span></span> </p>
            </a> </li>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
       
       
        <div class="clear"></div>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
</div>
<!--广告2区--> 
<!-- <div class="main m20">
	<ul class="index_small_picture">
	    <li><a href="#/u/392" target="_blank"><img src="http://static2.#.com/7niu/upload/5731862e10295.jpg" width="293" height="105" /></a></li>
	    <li><a href="#/u/83557" target="_blank"><img src="http://static2.#.com/7niu/upload/56c2bcbedde6b.gif" width="293" height="105" /></a></li>
	    <li><a href="#/u/52013" target="_blank"><img src="http://static2.#.com/7niu/upload/5722ced2cb206.jpg" width="293" height="105" /></a></li>
	    <li><a href="#/u/91562" target="_blank"><img src="http://static2.#.com/7niu/upload/578ef5f07575e.gif" width="293" height="105" /></a></li>
	    <li><a href="#/u/256" target="_blank"><img src="http://static2.#.com/7niu/upload/569855775c3da.jpg" width="293" height="105" /></a></li>
	    <li><a href="#/u/8998" target="_blank"><img src="http://static2.#.com/7niu/upload/572819bc73b15.jpg" width="293" height="105" /></a></li>
	    <li><a href="#/link.php?url=http://dwz.cn/27TH79" target="_blank" rel="nofollow"><img src="http://static2.#.com/7niu/upload/56b1682a68889.jpg" width="293" height="105" /></a></li>
	    <li><a href="#/u/121" target="_blank"><img src="http://static2.#.com/7niu/upload/574826a926922.jpg" width="293" height="105" /></a></li>
		    <div class="clear"></div></ul></div> --> 
<!--QQ-->
<!--<div class="main01">
  <div class="number_04">
    <h2><a href="#/qq/" target="_blank">QQ号码</a></h2>
  </div>
  <div class="number_left fl">
    <div class="number_left_bt">热门位数</div>
    <ul>
      <li><a href="#/qq/5/">五位</a></li>
      <li><a href="#/qq/6/">六位</a></li>
      <li><a href="#/qq/7/">七位</a></li>
      <li><a href="#/qq/8/">八位</a></li>
      <li><a href="#/qq/9/">九位</a></li>
      <li><a href="#/qq/10/">十位</a></li>
      <div class="clear"></div>
    </ul>
    <div class="number_left_bt">主题</div>
    <ul>
      <li><a href="#/qq/all/all-all-all-all-1-all-all-1.htm">三连号</a></li>
      <li><a href="#/qq/all/all-all-all-all-2-all-all-1.htm">四连号</a></li>
      <li><a href="#/qq/all/all-all-all-all-3-all-all-1.htm">五连号</a></li>
      <li><a href="#/qq/all/all-all-all-all-4-all-all-1.htm">顺子号</a></li>
      <div class="clear"></div>
    </ul>
    <div class="number_left_bt">优质用户</div>
    <a href="javascript:;" class="yzsj01"><img src="./index_files/yzsj.jpg" width="84" height="84" alt=""></a> <a href="javascript:;"><img src="./index_files/yzsj.jpg" width="84" height="84" alt=""></a> </div>
  <div class="number_right fr">
    <div class="fr number_right_more"><a href="#/qq/" class="blue">更多QQ靓号</a></div>
    <ul class="fl number_right_city">
      <li><a href="#/qq/all/1-all-all-all-all-all-all-1.htm">0-10级qq靓号</a></li>
      <li><a href="#/qq/all/2-all-all-all-all-all-all-1.htm">10-20级qq靓号</a></li>
      <li><a href="#/qq/all/3-all-all-all-all-all-all-1.htm">20-30级qq靓号</a></li>
      <li><a href="#/qq/all/4-all-all-all-all-all-all-1.htm">30-40级qq靓号</a></li>
      <li><a href="#/qq/all/5-all-all-all-all-all-all-1.htm">40-50级qq靓号</a></li>
      <li><a href="#/qq/all/6-all-all-all-all-all-all-1.htm">50级以上qq靓号</a></li>
    </ul>
    <div class="clear"></div>
    <div class="number_right_num">
      <ul>
        <li> <a href="#/qq/108-3810193.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">3810</span>193</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1561</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-5315172.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">5315</span>172</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1561</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-6591260.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">6591</span>260</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1561</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-7038531.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">7038</span>531</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1561</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-7859013.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">7859</span>013</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1561</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-3809614.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">3809</span>614</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1390</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-6045824.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">6045</span>824</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1390</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-7761539.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">7761</span>539</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1875</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-8342693.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">8342</span>693</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1390</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-4013681.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">4013</span>681</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1390</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-6396211.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">6396</span>211</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1875</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-8676351.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">8676</span>351</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1561</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-7442638.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">7442</span>638</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1390</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-9564953.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">9564</span>953</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1298</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-9296198.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">9296</span>198</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1561</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-8714846.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">8714</span>846</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1390</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-6920919.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">6920</span>919</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1309</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-9756274.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">9756</span>274</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1242</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-6579202.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">6579</span>202</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1446</span></span></p>
          </a></li>
        <li> <a href="#/qq/108-7630675.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">7630</span>675</h2>
          <p><span class="fl">0级</span> <span class="fr">￥<span class="red">1484</span></span></p>
          </a></li>
        <li> <a href="#/qq/124051-285432001.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">2854</span>32001</h2>
          <p><span class="fl">16级</span> <span class="fr">￥<span class="red">30</span></span></p>
          </a></li>
        <li> <a href="#/qq/124051-645673006.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">6456</span>73006</h2>
          <p><span class="fl">16级</span> <span class="fr">￥<span class="red">30</span></span></p>
          </a></li>
        <li> <a href="#/qq/124051-110783783.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">1107</span>83783</h2>
          <p><span class="fl">16级</span> <span class="fr">￥<span class="red">30</span></span></p>
          </a></li>
        <li> <a href="#/qq/124051-778205200.htm" target="_blank">
          <h2><i class="pu"></i> <span class="yellow">7782</span>05200</h2>
          <p><span class="fl">16级</span> <span class="fr">￥<span class="red">30</span></span></p>
          </a></li>
        <li> <a href="#/qq/121945-89517234.htm" target="_blank">
          <h2><i class="liang"></i> <span class="yellow">8951</span>7234</h2>
          <p><span class="fl">30级</span> <span class="fr">￥<span class="red">225</span></span></p>
          </a></li>
        <div class="clear"></div>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
</div>-->
<!--广告3区-->
<div class="main m20">
  <ul class="index_small_picture">
    <li><a href="#/u/400" target="_blank"><img src="images/<?php echo $row_Rec_ggao02['gg_photo1']; ?>" width="293" height="105"></a></li>
    <li><a href="#/u/1" target="_blank"><img src="images/<?php echo $row_Rec_ggao02['gg_photo2']; ?>" width="293" height="105"></a></li>
    <li><a href="#/u/521" target="_blank"><img src="images/<?php echo $row_Rec_ggao02['gg_photo3']; ?>" width="293" height="105"></a></li>
    <li><a href="#/u/1" target="_blank"><img src="images/<?php echo $row_Rec_ggao02['gg_photo4']; ?>" width="293" height="105"></a></li>
    <div class="clear"></div>
  </ul>
</div>
<!--400电话-->
<div class="main01">
  <div class="number_03">
    <h2><a href="#/400/" target="_blank">400电话</a></h2>
  </div>
  <div class="number_left fl">
    <div class="number_left_bt">热门号段</div>
    <ul>
      <li><a href="400_soso.php?a=4000">4007</a></li>
      <li><a href="400_soso.php?a=4001">4001</a></li>
      <li><a href="400_soso.php?a=4000">4000</a></li>
      <li><a href="400_soso.php?a=4006">4006</a></li>
      <li><a href="400_soso.php?a=4008">4008</a></li>
      <li><a href="400_soso.php?a=4009">4009</a></li>
      <div class="clear"></div>
    </ul>
    <div class="number_left_bt">常见规律</div>
    <ul>
      <li><a href="400_soso.php?c=19">尾数AAA</a></li>
      <li><a href="400_soso.php?c=20">尾数ABC</a></li>
      <li><a href="400_soso.php?c=17">尾数AAAB</a></li>
      <li><a href="400_soso.php?c=25">尾数AABB</a></li>
      <li><a href="400_soso.php?c=5">尾数AABBCC</a></li>
      <li><a href="400_soso.php?c=25">中间AAAA</a></li>
      <div class="clear"></div>
    </ul>
    <div class="number_left_bt">优质用户</div>
    <a href="javascript:;" class="yzsj01"><img src="./index_files/yzsj.jpg" width="84" height="84" alt=""></a><a href="javascript:;"><img src="./index_files/yzsj.jpg" width="84" height="84" alt=""></a> </div>
  <div class="number_right fr">
    <div class="fr number_right_more"><a href="400_soso.php" class="blue">更多400靓号</a></div>
    <ul class="fl number_right_city">
      <li><a href="400_soso.php?a=4000">联通4000靓号</a></li>
      <li><a href="400_soso.php?a=4001">移动4001靓号</a></li>
      <li><a href="400_soso.php?a=4006">联通4006靓号</a></li>
      <li><a href="400_soso.php?a=4007">移动4007靓号</a></li>
      <li><a href="400_soso.php?a=4008">电信4008靓号</a></li>
      <li><a href="400_soso.php?a=4009">电信4009靓号</a></li>
    </ul>
    <div class="clear"></div>
    <div class="number_right_num">
      <ul>
        <?php do { ?>
          <li><a href="sLL_xy.php?id=<?php echo $row_Recordset4['id']; ?>" >
            <h2><i class="liang"></i> <span class="yellow"><?php echo  substr( $row_Recordset4['sLL_hao'],0,4); ?></span><?php echo  substr( $row_Recordset4['sLL_hao'],4,6); ?></h2>
            <p><span class="fl"><?php $c=$row_Recordset4['c']; 
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
  
  
  ?></span> <span class="fr">￥<span class="red"><?php echo $row_Recordset4['s_price']; ?></span></span></p>
            </a></li>
          <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
          
          
          
       
        <div class="clear"></div>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
</div>

<!--400 4个小广告-->
<!--<div class="main m20">
  <ul class="index_small_picture">
    <li><a href="#/u/400" target="_blank"><img src="./index_files/579ad6b7b149e.jpg" width="293" height="105"></a></li>
    <li><a href="#/u/1" target="_blank"><img src="./index_files/579aae4a833c4.jpg" width="293" height="105"></a></li>
    <li><a href="#/u/400" target="_blank"><img src="./index_files/575bd6dd788dd.jpg" width="293" height="105"></a></li>
    <li><a href="#/u/690" target="_blank"><img src="./index_files/57afe5c12c074.png" width="293" height="105"></a></li>
    <div class="clear"></div>
  </ul>
</div>-->


<!--广告5区-->
<div class="main01"><a href="#" target="_blank"><img src="images/<?php echo $row_Rec_ggao05['gg_photo1']; ?>" width="1190" height="100"></a></div>
<!--车牌-->




<!--固定电话-->
<div class="main01">
  <div class="number_02">
    <h2><a href="#/dianhua/" target="_blank">固定电话</a></h2>
  </div>
  <div class="number_left fl">
    <div class="number_left_bt">热门城市</div>
    <ul>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=哈尔滨">哈尔滨</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=齐齐哈尔">齐齐哈尔</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=牡丹江">牡丹江</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=佳木斯">佳木斯</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=绥化">绥化</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=黑河">黑河</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=大兴安安岭">大兴安岭</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=伊春">伊春</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=大庆">大庆</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=鸡西">鸡西</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=鹤岗">鹤岗</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=双鸭山">双鸭山</a></li>
      <li><a target="_blank" href="search.php?bigtype=1&smalltype=七台河">七台河</a></li>
      <div class="clear"></div>
    </ul>
    <div class="number_left_bt">类型</div>
    <ul>
      <li><a href="search.php?m2=1" target="_blank" title="有线固话">有线</a></li>
      <li><a href="search.php?m1=-1" target="_blank" title="无线固话">无线</a></li>
      <div class="clear"></div>
    </ul>
    <div class="number_left_bt">优质用户</div>
    <a href="javascript:;" class="yzsj01"><img src="./index_files/yzsj.jpg" width="84" height="84" alt=""></a><a href="javascript:;"><img src="./index_files/yzsj.jpg" width="84" height="84" alt=""></a> </div>
  <div class="number_right fr">
    <div class="fr number_right_more"><a href="gh.php" class="blue">更多固话靓号</a></div>
    <ul class="fl number_right_city">
      <li><a href="search.php?bigtype=1&smalltype=哈尔滨">哈尔滨固话靓号</a></li>
      <li><a href="search.php?bigtype=1&smalltype=齐齐哈尔">齐齐哈尔固话靓号</a></li>
      <li><a href="search.php?bigtype=1&smalltype=牡丹江">牡丹江固话靓号</a></li>
      <li><a href="search.php?bigtype=1&smalltype=佳木斯">佳木斯手固话靓号</a></li>
   <li><a href="search.php?bigtype=1&smalltype=绥化">绥化固话靓号</a></li>
     <!--    <li><a href="#/escrow/search.htm?cityid=3">手机靓号</a></li>-->
    </ul>
    <div class="clear"></div>
    <div class="number_right_num">
      <ul>
        <?php do { ?>
          <li> <a href="gh_xy.php?id=<?php echo $row_Recordset2['id']; ?>" target="_blank">
            <h2><i class="liang"></i> <span class="yellow"><?php echo substr($row_Recordset2['gh_hao'],0,4); ?>-</span> <?php echo substr($row_Recordset2['gh_hao'],4,8); ?></h2>
            <p><span class="fl"><?php echo $row_Recordset2['smalltype']; ?></span> <span class="fr">￥<span class="red"><?php echo $row_Recordset2['s_price']; ?></span> </span></p>
          </a></li>
          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
       
        <div class="clear"></div>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
</div>
<!--广告5区-->
<div class="main01"><a href="#/u/1" target="_blank"><img src="images/<?php echo $row_Rec_ggao3['gg_photo1']; ?>" width="1190" height="100"></a></div>
<!--车牌-->
<div class="main01">
  <div class="number_05">
    <h2><a href="#/chepai/" target="_blank">车牌靓号</a></h2>
  </div>
  <div class="number_left fl">
    <div class="number_left_bt">热门城市</div>
    <ul>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=哈尔滨&grade=&key=&tj=">哈尔滨</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=齐齐哈尔&grade=&key=&tj=">齐齐哈尔</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=牡丹江&grade=&key=&tj=江">牡丹江</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=佳木斯&grade=&key=&tj=">佳木斯</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=绥化&grade=&key=&tj=">绥化</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=黑河&grade=&key=&tj=">黑河</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=大兴安岭&grade=&key=&tj=">大兴安岭</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=伊春&grade=&key=&tj=">伊春</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=大庆&grade=&key=&tj=">大庆</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=鸡西&grade=&key=&tj=">鸡西</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=鹤岗&grade=&key=&tj=">鹤岗</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=双鸭山&grade=&key=&tj=">双鸭山</a></li>
      <li><a target="_blank" href="cp_search.php?bigtype=1&smalltype=七台河&grade=&key=&tj=">七台河</a></li>
      <div class="clear"></div>
    </ul>
    <div class="number_left_bt">优质用户</div>
    <a href="javascript:;" class="yzsj01"><img src="./index_files/yzsj.jpg" width="84" height="84" alt=""></a><a href="javascript:;"><img src="./index_files/yzsj.jpg" width="84" height="84" alt=""></a> </div>
  <div class="number_right fr">
    <div class="fr number_right_more"><a href="cpai.php" class="blue">更多车牌靓号</a></div>
    <ul class="fl number_right_city">
      <li><a href="cp_search.php?bigtype=1&smalltype=哈尔滨&grade=&key=&tj=">哈尔滨车牌靓号</a></li>
      <li><a href="cp_search.php?bigtype=1&smalltype=齐齐哈尔&grade=&key=&tj=">齐齐哈尔车牌靓号</a></li>
      <li><a href="cp_search.php?bigtype=1&smalltype=牡丹江&grade=&key=&tj=">牡丹江车牌靓号</a></li>
      <li><a href="cp_search.php?bigtype=1&smalltype=佳木斯&grade=&key=&tj=">佳木斯手车牌靓号</a></li>
   <li><a href="cp_search.php?bigtype=1&smalltype=绥化&grade=&key=&tj=">绥化车牌靓号</a></li>
     <!--    <li><a href="#/escrow/search.htm?cityid=3">手机靓号</a></li>-->
    </ul>
    <div class="clear"></div>
    <div class="number_right_num">
      <ul>
        <?php do { ?>
          <li> <a href="cp_xy.php?id=<?php echo $row_Recordset3['id']; ?>" target="_blank">
            <h2> <i class="liang"></i> <span class="yellow"><?php echo substr($row_Recordset3['cp_hao'],0,5); ?></span><?php echo substr($row_Recordset3['cp_hao'],5,6); ?></h2>
            <p><span class="fl"><?php echo $row_Recordset3['smalltype']; ?></span> <span class="fr">￥<span class="red"><?php echo $row_Recordset3['s_price']; ?></span></span></p>
            </a></li>
          <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
       
       
        <div class="clear"></div>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
</div>
<!--广告4区-->
<div class="main01"><a href="#/u/400" target="_blank"><img src="images/<?php echo $row_Rec_ggao04['gg_photo1']; ?>" width="1190" height="100"></a></div>

<!--主页新闻-->
<div class="index_news">
  <div class="main01">
    <div class="index_news01 fl m25">
      <h2><span><a href="#">更多</a></span>行业新闻</h2>
       <?php error_reporting(E_ALL & ~E_NOTICE);
		
				 //echo $row_Recordset1['info_title'];
		//$str=$row_Recordset1['info_title'];
		//echo $str;
		 function mysub($str,$len) {  
        
     for($i = 0;$i < $len; $i++) {  
            if(ord(substr($str,$i,1)) > 0xa0) {  
               $string.= substr($str,$i,3);  //utf8此处改成3即可
                $i++;  //utf8此处下边在加一个$i++; 
           $i++;      //utf8时加这个
		    } else  {
                $string.= substr($str,$i,1);  
        } 
		}
        return $string;
    }  
		//echo mysub($str,54); 
	 ?>  
      <div class="index_news_bt"><a href="news_xy.php?news_id=<?php echo $row_Rec_news1_1['news_id']; ?>" title="<?php echo $row_Rec_news1_1['news_title']; ?>" target="_blank"><?php echo $row_Rec_news1_1['news_title']; ?></a></div>
      <a href="news_xy.php?news_id=<?php echo $row_Rec_news1_1['news_id']; ?>" title="" target="_blank"><img src="images/<?php if( $row_Rec_news1_1['news_photo']==""){echo "NoPic.jpg"; }else{ echo $row_Rec_news1_1['news_photo'];}?>" width="80" height="53" class="fl"></a>
      <p class="fr"><a href="news_xy.php?news_id=<?php echo $row_Rec_news1_1['news_id']; ?>" title="<?php echo $row_Rec_news1_1['message']; ?>" target="_blank"><?php echo mysub($row_Rec_news1_1['message'],84); ?>
      <?php    $a=$row_Rec_news1_1['message'];
 if( iconv_strlen($a,'utf-8')>27){ ?>...<?php }?>
      </a></p>
      <div class="clear"></div>
      <ul>
        <?php do { ?>
          <li><a href="news_xy.php?news_id=<?php echo $row_Rec_news1['news_id']; ?>" title="<?php echo $row_Rec_news1['news_title']; ?>" target="_blank"><?php echo $row_Rec_news1['news_title']; ?></a></li>
          <?php } while ($row_Rec_news1 = mysql_fetch_assoc($Rec_news1)); ?>

      </ul>
    </div>
    <div class="index_news01 fl m25">
      <h2><span><a href="#">更多</a></span>手机资讯</h2>
      <div class="index_news_bt"><a href="news_xy.php?news_id=<?php echo $row_Rec_news2_1['news_id']; ?>" title=" <?php echo $row_Rec_news2_1['news_title']; ?>" target="_blank"> <?php echo $row_Rec_news2_1['news_title']; ?></a></div>
      <a href="news_xy.php?news_id=<?php echo $row_Rec_news2_1['news_id']; ?>" title="" target="_blank"><img src="images/<?php if($row_Rec_news2_1['news_photo']==""){echo "NoPic.jpg";}else{echo $row_Rec_news2_1['news_photo']; } ?>" width="80" height="53" class="fl"></a>
      <p class="fr"><a href="news_xy.php?news_id=<?php echo $row_Rec_news2_1['news_id']; ?>" title="<?php echo $row_Rec_news2_1['message']; ?>" target="_blank"><?php echo mysub($row_Rec_news2_1['message'],84); ?>
       <?php    $a=$row_Rec_news2_1['message'];
 if( iconv_strlen($a,'utf-8')>27){ ?>...<?php }?>
      
      </a></p>
      <div class="clear"></div>
      <ul>
        <?php do { ?>
          <li><a href="news_xy.php?news_id=<?php echo $row_Rec_news2['news_id']; ?>" title="<?php echo $row_Rec_news2['']; ?>" target="_blank"><?php echo $row_Rec_news2['news_title']; ?></a></li>
          <?php } while ($row_Rec_news2 = mysql_fetch_assoc($Rec_news2)); ?>
       
      </ul>
    </div>
    <div class="index_news01 fr">
      <h2><span><a href="#">更多</a></span>各地动态</h2>
      <div class="clear"></div>
      <ul class="index_gddt">
        <?php do { ?>
          <li><a href="news_xy.php?news_id=<?php echo $row_Rec_news3['news_id']; ?>" title="<?php echo $row_Rec_news3['news_title']; ?>" target="_blank"><?php echo $row_Rec_news3['news_title']; ?></a></li>
          <?php } while ($row_Rec_news3 = mysql_fetch_assoc($Rec_news3)); ?>
        
      </ul>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!-- 代码 开始 -->
<div id="rightArrow"><a href="javascript:;" title="在线客户"></a></div>
<div id="floatDivBoxs">
  <div class="floatDtt">在线客服</div>
  <div class="floatShadow">
    <ul class="floatDqq">
      <li style="padding-left:0px;"><a target="_blank"  href="tencent://message/?uin=<?php echo $row_Rec_syqqgl['w_qq']; ?>&Menu=yes"><img src="./index_files/qq1.png" align="absmiddle">&nbsp;&nbsp;在线客服</a></li>
    </ul>
    <div class="floatDtxt">热线电话</div>
    <div class="floatDtel"><img src="./index_files/online_phone.jpg" width="155" height="45" alt=""></div>
   <!-- <div style="text-align:center;padding:10PX 0 5px 0;background:#EBEBEB;"><img src="./index_files/57a1437445133.png" width="130" height="130"><br>
      客服微信</div>-->
         <div style="text-align:center;padding:10PX 0 5px 0;background:#EBEBEB;"><img src="./images/wx.jpg" width="130" height="130"><br>
      客服微信</div>
    <div style="text-align:center;padding:10PX 0 5px 0;background:#EBEBEB;"><img src="images/<?php echo $row_Rec_gzptai['gg_photo1']; ?>"><br>
      微信公众账号</div>
  </div>
  <div class="floatDbg"></div>
</div>
<!-- 代码 结束 --> 
<!--<div class="zhaopin"><a href="/news/show/6676" title="招聘" target="_blank"></a></div>-->
<div class="main footer">
  <!--<div class="friendlink">
    <div class="friendlink_l">手机靓号</div>
    <div class="friendlink_r"> <a href="http://beijing.#.com/" target="_blank">北京手机靓号</a> <a href="http://shanghai.#.com/" target="_blank">上海手机号码</a> <a href="#/dianhua/" target="_blank">固话靓号</a> <a href="http://shenzhen.#.com/" target="_blank">深圳手机号码</a> <a href="http://wuhan.#.com/" target="_blank">武汉手机号码</a> <a href="http://chengdu.#.com/" target="_blank">成都手机靓号</a> <a href="http://dalian.#.com/" target="_blank">大连手机靓号</a> <a href="http://changchun.#.com/" target="_blank">长春手机靓号</a> <a href="http://haerbin.#.com/" target="_blank">哈尔滨手机号码</a> <a href="http://zhengzhou.#.com/" target="_blank">郑州手机靓号</a> <a href="http://guangzhou.#.com/" target="_blank">广州手机号码</a> <a href="http://suzhou.#.com/" target="_blank">苏州手机靓号</a> <a href="http://nanyang.#.com/" target="_blank">南阳手机号码</a> <a href="http://guiyang.#.com/" target="_blank">贵阳手机号码</a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>-->
  <!--<div class="friendlink">
    <div class="friendlink_l">其它靓号</div>
    <div class="friendlink_r"> <a href="#/qq/5/" target="_blank">5位QQ靓号</a> <a href="#/qq/6/" target="_blank">6位QQ靓号</a> <a href="#/qq/7/" target="_blank">7位QQ靓号</a> <a href="#/qq/8/" target="_blank">8位QQ靓号</a> <a href="#/qq/9/" target="_blank">买9位QQ号码</a> <a href="#/400/all/" target="_blank">400电话申请</a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>-->
  <!--<div class="friendlink">
    <div class="friendlink_l">站内导航</div>
    <div class="friendlink_r"> <a href="http://bbs.#.com/" target="_blank">靓号论坛</a> <a href="#/duanxin/" target="_blank">短信大全</a> <a href="http://jixiong.#.com/" target="_blank">手机号码测吉凶</a> <a href="http://guishudi.#.com/" target="_blank">手机号码归属地查询</a> <a href="http://gujia.#.com/" target="_blank">手机号码估价</a> <a href="#/zhuanti/shopsite/" target="_blank">独立号码网站</a> <a href="#/qq/" target="_blank">qq靓号网</a> <a href="#/qqqun/" target="_blank">QQ群靓号商城</a> <a href="#/haoduan/beijing/" target="_blank">北京号段查询</a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>-->
  <div class="friendlink">
    <div class="friendlink_l">友情链接</div>
    <div class="friendlink_r">   
      <?php do { ?>
        <a href="<?php echo $row_Rec_yqlj['url']; ?>" target="_blank"><?php echo $row_Rec_yqlj['name']; ?></a>
        <?php } while ($row_Rec_yqlj = mysql_fetch_assoc($Rec_yqlj)); ?> 
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="red friendsm">友情链接交换联系QQ：<?php echo $row_Rec_guanlia['w_qq']; ?>。</div>
</div>
<?php include ("footer.php")?>
<div style="position: fixed; top:320px; left:5px;"><img src="images/ly.jpg" usemap="#Map" border="0" />
  <map name="Map" id="Map">
    <area shape="rect" coords="33,92,115,115"  href="tencent://message/?uin=110999999&Menu=yes"  >
    <area shape="rect" coords="36,135,112,157" href="tencent://message/?uin=110999999&Menu=yes">
    <area shape="rect" coords="38,178,108,201"href="javascript:void(0);"  onclick="javascript:openwindow('ly.php ','1',748,375);">
  </map>
</div>
</body>
</html>
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
