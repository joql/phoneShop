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

$maxRows_Recordset1 = 6;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$smalltype=$_GET['fl'];
mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM news WHERE bigtype = '2' and smalltype='买家帮助' ORDER BY news_id DESC";
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
<!-- banner -->
	<?php include("news_lbo.php");?>  
<div class="clear"></div>

<div class="newlist ">
  <div class="newlistbt bd1">
    	<span>买家帮助</span>
    </div>
    <?php do { ?>
      <ul class="new_all c-news-text">
        <li class="cnt-list   mth-list-count ">
          <a href="news_xy.php?news_id=<?php echo $row_Recordset1['news_id']; ?>" class="typeNews ">
            <div class="ttimg"><div class="tn-div-img" style=" background-image:url(../images/<?php if($row_Recordset1['news_photo']){echo $row_Recordset1['news_photo'];}else{echo "wu.gif";} ?>)"></div></div>
            <div class="text">
              <h2><?php echo $row_Recordset1['news_title']; ?></h2>
              <div class="text-extra">
                <div class="time"><?php echo $row_Recordset1['news_time']; ?></div>
              </div>
              </div>
          </a> 
          </li>
        
        
        <div class="clear"></div>
      
      </ul>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
     
</div>


<div class="clear" ></div>

  

<div class="clear"></div>

<div class="location" >
	<?php include("fanye.php");?>
</div>

	<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->



<script type="text/javascript" src="./index_files/iscroll.js"></script>
<script>
$(function() {

	/*新闻头部导航定位显示*/
	var ele = $("#news-nav-scroll ul");
	ele.width((ele.find("li").length) * (ele.find("li").width() + 10));
	var domainScroll = new IScroll('#news-nav-scroll', { scrollX: true,scrollY: false, freeScroll: true, click: true});
	});
</script>
<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);
?>
