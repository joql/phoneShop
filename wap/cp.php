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

 $key=$_GET['key'];
 if(!empty($key)){$link="and cp_hao like '%$key%'";}else {$link="";}

$maxRows_Recordset1 = 12;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM cpai WHERE info_top = 1 $link ORDER BY id desc";
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

$maxRows_Recordset2 = 12;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = "SELECT * FROM cpai WHERE info_top = 2 $link ORDER BY id DESC";
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

<link href="./index_files/m.car.css" rel="stylesheet" type="text/css">
</head>

<body class="index">
	<?php include("top.php");?>

	<!-- banner -->
<div id="top-slide" class="swiper-container top-slide swiper-container-horizontal" data-swiper="[object Object]">
	<div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
				<div class="swiper-slide swiper-slide-active" style="width: 1423px;">
			<a href="filter.php" target="_blank"><img src="./index_files/594a139b43135.jpg"></a>
		</div>
				<div class="swiper-slide swiper-slide-next" style="width: 1423px;">
			<a href="filter.php" target="_blank"><img src="./index_files/59351ee14fea3.jpg"></a>
		</div>
				<div class="swiper-slide" style="width: 1423px;">
			<a href="filter.php" target="_blank"><img src="./index_files/5874a0af6a47a.jpg"></a>
		</div>
					</div>
	<div class="swiper-pagination"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
</div>
<div class="clear"></div>
<!-- search -->
<div id="carSearch" class="sousuo">
	<div class="tabs">
	  <a href="javascript:void(0);" class="active">模糊搜索</a>
	<!--  <a href="javascript:void(0);">定位搜索</a> -->
	</div>
	<div id="carSearch_slide" class="swiper-container swiper-container-horizontal" data-swiper="[object Object]">
	  <div class="swiper-wrapper">
		<div class="swiper-slide swiper-slide-active" style="width: 1423px;">
		  <form action="cp.php" method="get" class="sreach" id="mhDianhuaForm" >
			<!--<p>
			    <label>城市：</label>
			    <select class="selected" name="province">
					<option value="-1">不限省份</option>				
					<option type="1" value="1">北京(京)</option>
					<option type="1" value="2">上海(沪)</option>
					<option type="1" value="3">天津(津)</option>
					<option type="1" value="4">重庆(渝)</option>
					<option type="2" value="5">浙江(浙)</option>
					<option type="2" value="6">江苏(苏)</option>
					<option type="2" value="7">广东(粤)</option>
					<option type="2" value="8">福建(闽)</option>
					<option type="2" value="9">湖南(湘)</option>
					<option type="2" value="10">湖北(鄂)</option>
					<option type="2" value="11">辽宁(辽)</option>
					<option type="2" value="12">吉林(吉)</option>
					<option type="2" value="13">黑龙江(黑)</option>
					<option type="2" value="14">河北(冀)</option>
					<option type="2" value="15">河南(豫)</option>
					<option type="2" value="16">山东(鲁)</option>
					<option type="2" value="17">陕西(陕)</option>
					<option type="2" value="18">甘肃(甘)</option>
					<option type="2" value="19">青海(青)</option>
					<option type="2" value="20">新疆(新)</option>
					<option type="2" value="21">山西(晋)</option>
					<option type="2" value="22">四川(川)</option>
					<option type="2" value="23">贵州(黔)</option>
					<option type="2" value="24">安徽(皖)</option>
					<option type="2" value="25">江西(赣)</option>
					<option type="2" value="26">云南(云)</option>
					<option type="2" value="27">内蒙古(蒙)</option>
					<option type="2" value="28">广西(桂)</option>
					<option type="2" value="29">西藏(藏)</option>
					<option type="2" value="30">宁夏(宁)</option>
					<option type="2" value="31">海南(琼)</option>
				</select>                               
				<select class="selected" name="city">
					<option value="">不限城市</option>
				</select>
			</p>-->
			<p><label>包含数字：</label><input class="text" name="key" type="number" placeholder="请输入号码" value=" "><input class="button" type="submit" value="　"></p>
       </form>
		</div>
		<!--<div class="swiper-slide swiper-slide-next" style="width: 1423px;">
		    <form id="carForm" class="sreach car_search">
			<p>
			<label>城市：</label>
			    <select class="selected" name="province">
					<option value="-1">不限省份</option>				
					<option type="1" value="1">北京(京)</option>
					<option type="1" value="2">上海(沪)</option>
					<option type="1" value="3">天津(津)</option>
					<option type="1" value="4">重庆(渝)</option>
					<option type="2" value="5">浙江(浙)</option>
					<option type="2" value="6">江苏(苏)</option>
					<option type="2" value="7">广东(粤)</option>
					<option type="2" value="8">福建(闽)</option>
					<option type="2" value="9">湖南(湘)</option>
					<option type="2" value="10">湖北(鄂)</option>
					<option type="2" value="11">辽宁(辽)</option>
					<option type="2" value="12">吉林(吉)</option>
					<option type="2" value="13">黑龙江(黑)</option>
					<option type="2" value="14">河北(冀)</option>
					<option type="2" value="15">河南(豫)</option>
					<option type="2" value="16">山东(鲁)</option>
					<option type="2" value="17">陕西(陕)</option>
					<option type="2" value="18">甘肃(甘)</option>
					<option type="2" value="19">青海(青)</option>
					<option type="2" value="20">新疆(新)</option>
					<option type="2" value="21">山西(晋)</option>
					<option type="2" value="22">四川(川)</option>
					<option type="2" value="23">贵州(黔)</option>
					<option type="2" value="24">安徽(皖)</option>
					<option type="2" value="25">江西(赣)</option>
					<option type="2" value="26">云南(云)</option>
					<option type="2" value="27">内蒙古(蒙)</option>
					<option type="2" value="28">广西(桂)</option>
					<option type="2" value="29">西藏(藏)</option>
					<option type="2" value="30">宁夏(宁)</option>
					<option type="2" value="31">海南(琼)</option>
				</select>                               
				<select class="selected" name="city">
					<option value="">不限城市</option>
				</select>
				</p>
				<p><label>定位搜：</label>
					<span class="dws">
					<input name="p1" type="text" maxlength="1" value="">
					<input name="p2" type="text" maxlength="1" value="">
					<input name="p3" type="text" maxlength="1" value="">
					<input name="p4" type="text" maxlength="1" value="">
					<input name="p5" type="text" maxlength="1" value="">
					<input class="button" type="button" value="　">
				</span></p>
		   </form>
		</div>-->
	  </div>
	</div>
</div>
<div class="clear"></div>
<!--<div class="hots">
	<div class="hots_1"><a class="hosted" href="/chepai/all/">快速选号</a></div><div class="hots_2"><a class="hosted" href="javascript:void(0);">广告投放</a></div><div class="hots_3"><a href="javascript:void(0);">广告投放</a></div>
</div>-->
<!--<div class="hots">
	<div class="hots_3"><a class="hosted" href="javascript:void(0);">广告投放</a></div><div class="hots_2"><a class="hosted" href="javascript:void(0);">广告投放</a></div><div class="hots_1"><a href="javascript:void(0);">广告投放</a></div>
</div>
<div class="clear"></div>-->
<!--号码展示-->
<div class="haoma">
	<div class="haomabt">
    	<i></i><span><a href="cp_xy.php?id=<?php echo $row_Recordset1['id']; ?>" target="_blank">置顶靓号</a></span>
    </div>
    <ul class="hmlist">
	     <?php do { ?>
         <li><a href="cp_xy.php?id=<?php echo $row_Recordset1['id']; ?>" target="_blank">
		<h2><span class="blue"><?php echo substr($row_Recordset1['cp_hao'],0,5); ?><?php echo  substr($row_Recordset1['cp_hao'],5,6); ?></span></h2>
		<p>
			<span class="fleft"><?php echo $row_Recordset1['smalltype']; ?></span><span class="fright">￥<span class="red"><?php echo $row_Recordset1['s_price']; ?></span></span>
		</p>
		</a>
	</li><?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        
        <div class="clear"></div>
	</ul> 
         <div id="news_more" classid="1" class="jzgd"><a href="cp_gd.php" target="_blank">查看更多</a><i class="gdicon icon"></i></div> 
 
</div>
<div class="clear"></div>
<div class="haoma">
	<div class="haomabt">
    	<i></i><span><a href="cp_xy.php?id=<?php echo $row_Recordset2['id']; ?>" target="_blank">天价靓号</a></span>
    </div>
    <ul class="hmlist">
      <?php do { ?>
      
        <li><a href="cp_xy.php?id=<?php echo $row_Recordset2['id']; ?>" target="_blank">
		<h2><span class="blue"><?php echo substr($row_Recordset2['cp_hao'],0,5); ?><?php echo substr($row_Recordset2['cp_hao'],5,6); ?></span></h2>
		<p>
			<span class="fleft"><?php echo $row_Recordset2['smalltype']; ?></span><span class="fright">￥<span class="red"><?php echo $row_Recordset2['s_price']; ?></span></span>
		</p>
		</a>
	</li> <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
        
    	<div class="clear"></div>
    </ul>  
             <div id="news_more" classid="1" class="jzgd"><a href="cp_gd2.php" target="_blank">查看更多</a><i class="gdicon icon"></i></div> 
</div>
<div class="clear"></div>

<div class="clear"></div>
<div class="location">
	<a href="index.php">首页</a>&nbsp;&gt;&nbsp;<a href="cp.php">车牌</a>&nbsp;&gt;&nbsp;搜索选号
</div>
		<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->


<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>