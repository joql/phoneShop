<?php require_once('../Connections/connch21.php'); ?>
<?php ?>
<?php  error_reporting(E_ALL & ~E_NOTICE);
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
 
 $key=$_GET['key'];
 if(!empty($key)){$link="and gh_hao like '%$key%'";}else {$link="";}

$maxRows_Recordset1 = 16;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM kuhua where info_top=1 $link ORDER BY id DESC";
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

$maxRows_Recordset2 = 16;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = "SELECT * FROM kuhua WHERE info_top = 2 $link ORDER BY id DESC";
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

mysql_select_db($database_connch21, $connch21);
$query_Rec_ghggao = "SELECT * FROM guanggao WHERE title = '副页固定电话页广告  '";
$Rec_ghggao = mysql_query($query_Rec_ghggao, $connch21) or die(mysql_error());
$row_Rec_ghggao = mysql_fetch_assoc($Rec_ghggao);
$totalRows_Rec_ghggao = mysql_num_rows($Rec_ghggao);

mysql_select_db($database_connch21, $connch21);
$query_Rec_jilu = "SELECT count( *) FROM kuhua";
$Rec_jilu = mysql_query($query_Rec_jilu, $connch21) or die(mysql_error());
$row_Rec_jilu = mysql_fetch_assoc($Rec_jilu);
$totalRows_Rec_jilu = mysql_num_rows($Rec_jilu);




?>
<?php ?>
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

<link href="./index_files/m.telephone.css" rel="stylesheet" type="text/css">


</head>

<body class="index">
<?php include("top.php");?>
  
<!-- banner -->
<!-- banner -->
<div id="top-slide" class="swiper-container top-slide swiper-container-horizontal" data-swiper="[object Object]">
	<div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
				<div class="swiper-slide swiper-slide-active" style="width: 1423px;">
			<a href="filter.php" target="_blank"><img src="./index_files/5837d844a438f.jpg"></a>
		</div>
				<div class="swiper-slide swiper-slide-next" style="width: 1423px;">
			<a href="filter.php" target="_blank"><img src="./index_files/59015f8635479.jpg"></a>
		</div>
				<div class="swiper-slide" style="width: 1423px;">
			<a href="filter.php" target="_blank"><img src="./index_files/593520343ebec.jpg"></a>
		</div>
					</div>
	<div class="swiper-pagination"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
</div>
<!-- nav -->
<!--<div class="nav">
	<ul>
    	<li class="ico-wuxian"><a href="/dianhua/wuxian/"><i class="yys_icon"></i><p>无线</p></a></li>
        <li class="ico-youxian"><a href="/dianhua/youxian/"><i class="yys_icon"></i><p>有线</p></a></li>
        <li class="ico-yihaotong"><a href="/dianhua/yihaotong/"><i class="yys_icon"></i><p>商务一号通</p></a></li>
    </ul>
    <div class="clear"></div>
</div>-->
<div class="clear"></div>
<!-- search -->
<div id="mobileSearch" class="sousuo">
<div class="tabs">
  <a href="http://#/dianhua/#" class="active">模糊搜索</a>
  <!--<a href="#" >个性搜索</a> -->
</div>
<div class="swiper-container">
  <div class="swiper-wrapper">
    <div class="swiper-slide" style="background:#fff; height:80px;">
   	  <form action="gh.php" method="get" class="sreach" id="mhDianhuaForm" >
            <!--<p><label>归属地：</label>
			<span class="bk">
			<select class="selected" name="province">
			<option value="-1">不限归属地</option>
							<option value="1">北京</option>				
							<option value="2">上海</option>				
							<option value="3">天津</option>				
							<option value="4">重庆</option>				
							<option value="5">浙江省</option>				
							<option value="6">江苏省</option>				
							<option value="7">广东省</option>				
							<option value="8">福建省</option>				
							<option value="9">湖南省</option>				
							<option value="10">湖北省</option>				
							<option value="11">辽宁省</option>				
							<option value="12">吉林省</option>				
							<option value="13">黑龙江</option>				
							<option value="14">河北省</option>				
							<option value="15">河南省</option>				
							<option value="16">山东省</option>				
							<option value="17">陕西省</option>				
							<option value="18">甘肃省</option>				
							<option value="21">山西省</option>				
							<option value="22">四川省</option>				
							<option value="23">贵州省</option>				
							<option value="24">安徽省</option>				
							<option value="25">江西省</option>				
							<option value="26">云南省</option>				
							<option value="27">内蒙古</option>				
							<option value="28">广西</option>				
							<option value="31">海南省</option>				
							<option value="20">新疆</option>				
							<option value="29">西藏</option>				
							<option value="19">青海省</option>				
							<option value="30">宁夏</option>				
						</select>
			<i></i>
			</span>
			<span class="bk" id="showcity">
			<select class="selected" name="city">
				<option value="-1">不限城市</option>
			</select>
			<i></i>
			</span>
			</p>-->
        <p><label>包含数字：</label><input class="text" name="key" type="number" placeholder="请输入号码" value=" "><input class="button" type="submit" value="　"></p>
       </form>
    </div>
    <!--<div class="swiper-slide" style="background:#fff; height:110px;">
       <form class="sreach">
        	
            <p><label>归属地：</label>
           <span class="bk">
            <select class="selected" name=""><option>河南省</option><option>河北省</option></select>
            <i></i>
            </span>
            <span class="bk">
            <select class="selected" name=""><option>南阳市</option><option>商丘市</option></select>
            <i></i>
            </span>
            </p>
        <p><label>包含数字：</label><input class="text" type="text" value="输入号码" /><input class="button" type="button" value="　" /></p>
       </form>
    </div>-->
 
   
  </div>
</div>
</div>
<div class="clear"></div>
<!--<div class="hots">
	<div class="hots_1"><a class="hosted" href="/dianhua/all/">快速选号</a></div><div class="hots_2"><a class="hosted" href="/dianhua/all/">靓号私人定制</a></div>
</div>-->
<!--<div class="hots">
	<div class="hots_3"><a class="hosted" href="/dianhua/all/all-1-all-all-all-1.htm">尾数AAAA+</a></div><div class="hots_2"><a class="hosted" href="/dianhua/all/all-5-all-all-all-1.htm">尾数ABCABC</a></div><div class="hots_1"><a href="/dianhua/all/all-7-all-all-all-1.htm">尾数AABBCC</a></div>
</div>-->
<div class="clear"></div>
<!--号码展示-->
<div class="haoma">
	<div class="haomabt">
    	<i></i><span><a href="gh_xy.php?id=<?php echo $row_Recordset1['id']; ?>" target="_blank">置顶靓号</a></span>
    </div>
    <ul class="hmlist">  <?php do { ?>
	    	<li><a href="gh_xy.php?id=<?php echo $row_Recordset1['id']; ?>" target="_blank"><h2><i class="icon liang"></i><span class="yellow"><?php echo substr($row_Recordset1['gh_hao'],0,4); ?></span>-<?php echo substr($row_Recordset1['gh_hao'],4,8); ?></h2><p><span class="fleft"><?php echo $row_Recordset1['smalltype']; ?></span><span class="fright">￥<span class="red"><?php echo $row_Recordset1['s_price']; ?></span></span></p></a></li> <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
          	
            <div class="clear"></div>
    </ul>  
        <div id="news_more" classid="1" class="jzgd"><a href="gh_gd.php" target="_blank">查看更多</a><i class="gdicon icon"></i></div>   
</div>
<div class="clear"></div>
<div class="haoma">
	<div class="haomabt">
    	<i></i><span><a href="gh_xy.php?id=<?php echo $row_Recordset2['id']; ?>" target="_blank">天价靓号</a></span>
    </div>
    <ul class="hmlist">
	<?php do { ?>
            	<li><a href="gh_xy.php?id=<?php echo $row_Recordset2['id']; ?>" target="_blank"><h2><i class="icon liang"></i><span class="yellow"><?php echo substr($row_Recordset2['gh_hao'],0,4); ?></span>-<?php echo substr($row_Recordset2['gh_hao'],4,8); ?></h2><p><span class="fleft"><?php echo $row_Recordset2['smalltype']; ?></span><span class="fright">￥<span class="red"><?php echo $row_Recordset2['s_price']; ?></span></span></p></a></li>
                 <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
          	
            <div class="clear"></div>
    </ul>
    <div id="news_more" classid="1" class="jzgd"><a href="gh_gd2.php" target="_blank">查看更多</a><i class="gdicon icon"></i></div>   
</div>
<div class="clear"></div>

<!-- 当前位置 --> 
<div class="location">
	<a href="index.php">首页</a>&nbsp;&gt;&nbsp;<a href="./gh.php">固定电话</a>
</div> 
		<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->


<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>


<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);?>