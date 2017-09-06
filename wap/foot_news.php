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
$query_Recordset1 = sprintf("SELECT * FROM sy_news WHERE news_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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

<div class="nav">
	<ul>
    	<!--<li class="ico-about"><a href="http://#/about/about.htm"><i class="icon_menu"></i><p>关于我们</p></a></li>-->
        <li class="ico-safety"><a href="foot_news.php?news_id=2"><i class="icon_menu"></i><p>交易安全</p></a></li>
        <li class="ico-contact"><a href="foot_news.php?news_id=6"><i class="icon_menu"></i><p>联系我们</p></a></li>
        <li class="ico-payment"><a href="foot_news.php?news_id=13"><i class="icon_menu"></i><p>付款方式</p></a></li>
    </ul>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<div class="clear"></div>
<div class="contact"><p style="LINE-HEIGHT: 1.5em; TEXT-INDENT: 2em; WHITE-SPACE: normal"><span style="FONT-SIZE: 14px"><strong><span style="COLOR: rgb(255,0,0)"></span></strong></span></p><p style="TEXT-INDENT: 2em"><strong><span style="COLOR: rgb(255,0,0); FONT-SIZE: 14px"><?php echo $row_Recordset1['news_content']; ?></p><p style="TEXT-INDENT: 2em"><span style="FONT-SIZE: 14px"></span><br></p><p style="LINE-HEIGHT: 1.5em; TEXT-INDENT: 2em; WHITE-SPACE: normal"><span style="FONT-SIZE: 14px"></span><br></p></div>
<div class="clear"></div>
<!-- 当前位置 --> 
<div class="location">
	<a href="index.php">首页</a>&gt;联系我们
</div>
	<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->


<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);
?>
