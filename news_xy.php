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
$query_Recordset1 = sprintf("SELECT * FROM news WHERE news_id = %s", GetSQLValueString($colname_Recordset1, "int"));
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
	<meta name="copyright" content="jihaoba.com">
	<link rel="shortcut icon" href="#/favicon.ico" type="image/x-icon">
	<link href="./index_files/public.css" rel="stylesheet" type="text/css">

	<link href="./index_files/new_index_t.css" rel="stylesheet" type="text/css">
<script src="./index_files/share.js"></script><link rel="stylesheet" href="./index_files/share_style1_16.css"></head>
<body><div id="BAIDU_DUP_fp_wrapper" style="position: absolute; left: -1px; bottom: -1px; z-index: 0; width: 0px; height: 0px; overflow: hidden; visibility: hidden; display: none;"><iframe id="BAIDU_DUP_fp_iframe" src="./index_files/o.html" style="width: 0px; height: 0px; visibility: hidden; display: none;"></iframe></div>
<?php include("nav.php");?>
<div id="bj" style="display: none;"></div>


<div class="main mb30">
  
  <div class="newsite"><strong>当前位置：</strong><a href="/">首页</a>&gt;<a href="#">综合信息</a>&gt;<a href="#"><?php echo $row_Recordset1['smalltype']; ?></a></div>
  <div class="newpage_L fleft">
    <h1 class="newpage_title">   <?php echo $row_Recordset1['news_title']; ?></h1>
    <div class="newpage_more">
      <div class=" fleft">玖玖靓号丨发表时间：<?php echo $row_Recordset1['news_time']; ?>丨<!--访问量：74--></div>
      <div class="bdsharebuttonbox fright bdshare-button-style1-16" data-bd-bind="1481422398835"><a href="#/news/show/9476#" class="bds_more" data-cmd="more"></a><a href="#/news/show/9476#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#/news/show/9476#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#/news/show/9476#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#/news/show/9476#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#/news/show/9476#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
    </div>
    <div class="newpage_zhaiyao"><?php echo $row_Recordset1['message']; ?></div>
    <div class="newpage_nr">
   	
    
    <?php echo $row_Recordset1['news_content']; ?>
    
    
	  
	  	  	</div>
    
    <div class="bqfx">
      <div class="bdsharebuttonbox fright bdshare-button-style1-16" data-bd-bind="1481422398835">
        <div class="bdsharebuttonbox bdshare-button-style1-16" data-bd-bind="1481422398835"><a href="#/news/show/9476#" class="bds_more" data-cmd="more"></a><a href="#/news/show/9476#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#/news/show/9476#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#/news/show/9476#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#/news/show/9476#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#/news/show/9476#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
</div>
    </div>
    
  </div>
  <div class="clear"></div>
</div>

<?php include ("footer.php")?></body></html>
<?php
mysql_free_result($Recordset1);
?>
