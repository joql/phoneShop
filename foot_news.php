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

$colname_Recordset1 = "-1";
if (isset($_GET['news_id'])) {
  $colname_Recordset1 = $_GET['news_id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = sprintf("SELECT * FROM sy_news WHERE news_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta charset="UTF-8">
<meta name="applicable-device" content="pc">

<?php include("keyword.php");?>

<meta name="robots" content="All">
<meta name="verify-v1" content="casZho9kECUkOAU+2uY1SGpjeqJiwu0o/ALrzgPNKFo=">
<meta name="AizhanSEO" content="a2511a4d1a6a1b0fe57f5ce001438cc9">
<meta http-equiv="Content-Language" content="zh_CN">
<meta name="author" content="lezhizhe.net">
<meta name="copyright" content="#.com">
<link rel="shortcut icon" href="http://www.#.com/favicon.ico" type="image/x-icon">
<link href="./index_files/public.css" rel="stylesheet" type="text/css">
<link href="./index_files/onepage.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include("nav.php");?>
<div id="bj" style="display: none;"></div>
<div class="onepage_banner  m20"></div>
<div class="main m20">
<div class="sidebar fl">
<h2>玖玖靓号</h2>
<ul class="m20"><li><a href="foot_news.php?news_id=1">网站简介</a></li>
<li><a href="foot_news.php?news_id=2">交易安全声明</a></li>
<li><a href="foot_news.php?news_id=8">网站地图</a></li>
<li><a href="foot_news.php?news_id=6">联系我们</a></li>
<li><a href="foot_news.php?news_id=7">付款方式</a></li></ul>
<h2>增值服务</h2>
<ul class="m20"><li><a href="foot_news.php?news_id=4">vip会员特权</a></li>
<!--<li><a href="http://www.#.com/about/kingad.htm">黄金靓号展位</a></li>
<li><a href="http://www.#.com/about/bestad.htm">精准靓号展位</a></li>
<li><a href="http://www.#.com/about/shopid.htm">超靓门牌号</a></li>
<li><a href="http://www.#.com/about/morecity.htm">图片广告</a></li>
<li><a href="http://www.#.com/zhuanti/ggzs/">广告服务</a></li>
<li><a href="http://www.#.com/about/cityad.htm">分站文字广告</a></li>

-->

</ul>
<!--<a href="http://www.#.com/zhuanti/vip/duibi.htm" title="" target="_blank"><img src="./index_files/pk.jpg" width="215" height="50" class="m10"></a>
<h2>联系我们</h2>
<p class="tel">4008-915-925 </p>
<p class="qq"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=8380798&site=qq&menu=yes" title="点击咨询集号吧客服" style="text-decoration:none;">8380798</a></p>-->
</div>
<div class="onepage fr">
<div class="onepage_bt">当前位置：<a href="index.php">首页</a>&nbsp;&gt;&nbsp;<?php echo $row_Recordset1['news_title']; ?></div>
<div class="onepage_con">
<?php echo $row_Recordset1['news_content']; ?>
</div>
</div>
<div class="clear"></div>
</div>
<?php include ("footer.php")?>
</body></html>
<?php
mysql_free_result($Recordset1);
?>
