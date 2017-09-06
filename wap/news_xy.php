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

$colname_Recordset1 = "-1";
if (isset($_GET['news_id'])) {
  $colname_Recordset1 = $_GET['news_id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = sprintf("SELECT * FROM news WHERE news_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$fl=$row_Recordset1['smalltype'];//以第一个为基准为类横sai xuan
$id=$row_Recordset1['news_id'];


$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = "SELECT * FROM news WHERE smalltype = '$fl' and news_id<>'$id' ORDER BY news_id DESC";
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



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<meta name="applicable-device" content="mobile">
    <meta name="format-detection" content="telephone=no">
	<meta charset="UTF-8">
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

	<link href="./index_files/m.home.inside.css" rel="stylesheet" type="text/css">
</head>

<body class="index">
<?php include("top.php");?>

<div class="clear"></div>
<?php include("nav.php");?>
<div class="clear"></div>

<div class="location">
	<a href="index.php">首页 </a><!--&gt;<a href="#"><?php echo $row_Recordset1['bigtype']; ?></a>-->&gt; <a href="#"><?php echo $row_Recordset2['smalltype']; ?></a>
</div>
<div class="clear"></div>
<div class="newpage_bt">
	<h1><?php echo $row_Recordset1['news_title']; ?></h1>
    <span><?php echo $row_Recordset1['news_time']; ?></span>
</div>
<div class="contact">
<?php echo $row_Recordset1['news_content']; ?>
<p><br></p>
</div>
<!--<div class="news-bottom">
	<ul><li class="news-bottom1"><a href="http://#/shengrihao/"><img src="./index_files/wap-news-bottom1.jpg" width="100%"></a></li>
    <li class="news-bottom2"><a href="http://#/escrow/"><img src="./index_files/wap-news-bottom2.jpg" width="100%"></a></li>
    <div class="clear"></div>
    </ul>
</div>-->
<div class="newlist m10">
	<div class="newlistbt">
    	<i></i><span>相关文章</span>
    </div>
    <div class="new">
    	<ul>
					<?php do { ?>
				    <li><a href="news_xy.php?news_id=<?php echo $row_Recordset2['news_id']; ?>">· <?php echo $row_Recordset2['news_title']; ?></a></li>
					  <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
					
				</ul>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<!--<div class="newlist m10">
	<div class="newlistbt">
    	<i></i><span>热门文章</span>
    </div>
    <div class="new">
    	<ul>
					<li><a href="http://#/news/show/6430">· 18888888888连号值多钱？归属地是哪里？机主姓名是谁？</a></li>
					<li><a href="http://#/news/show/5287">· 中国移动广东分公司宽带资费</a></li>
					<li><a href="http://#/news/show/5277">· 中国移动河南分公司宽带资费</a></li>
					<li><a href="http://#/news/show/5278">· 中国移动北京分公司宽带资费</a></li>
					<li><a href="http://#/news/show/3886">· 183是移动还是联通</a></li>
				</ul>
        <div class="clear"></div>
    </div>
</div>-->
<div class="clear"></div>
	<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->


<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
