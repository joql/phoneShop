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

$maxRows_Recordset1 = 20;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM cpai WHERE info_top = 2 $link ORDER BY id desc";
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
20;
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

<link href="./index_files/m.telephone.css" rel="stylesheet" type="text/css">
</head>

<body class="index">
<?php include("top.php");?>
  
<!-- banner -->
<!-- banner -->
<div id="top-slide" class="swiper-container top-slide swiper-container-horizontal" data-swiper="[object Object]">
	<div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-2846px, 0px, 0px);">
				<div class="swiper-slide" style="width: 1423px;">
			<a href="filter.php" target="_blank"><img src="./index_files/5837d844a438f.jpg"></a>
		</div>
				<div class="swiper-slide swiper-slide-prev" style="width: 1423px;">
			<a href="filter.php" target="_blank"><img src="./index_files/59015f8635479.jpg"></a>
		</div>
				<div class="swiper-slide swiper-slide-active" style="width: 1423px;">
			<a href="filter.php" target="_blank"><img src="./index_files/593520343ebec.jpg"></a>
		</div>
					</div>
	<div class="swiper-pagination"><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span></div>
</div>
<div class="clear"></div>
<!-- search -->
<div id="mobileSearch" class="sousuo">
<div class="tabs">
  <a href="http://#/dianhua/search.htm#" class="active">模糊搜索</a>
  <!--<a href="#">个性搜索</a> -->
 
</div>
<div class="swiper-container">
  <div class="swiper-wrapper">
    <div class="swiper-slide" style="background:#fff;">
   	 <form action="cp_gd2.php" method="get" class="sreach" id="mhDianhuaForm" >
	  		<!--<p><label>类型：</label>
						<input class="dan dan_active" name="m1" type="checkbox" value="0">无线&nbsp;
						<input class="dan dan_active" name="m2" type="checkbox" value="1">有线&nbsp;
						<input class="dan dan_active" name="m3" type="checkbox" value="2">商务一号通
					</p>
            <p><label>归属地：</label>
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
			</p>
			<p>
            <label>号码规律：</label>
			<span class="bk">
			<select class="selected" name="grade">
			<option value="-1">号码规律</option>
						<option value="0">无规律</option>
						<option value="3">尾数AAA</option>
						<option value="6">尾数ABC</option>
						<option value="8">尾数AABB</option>
						<option value="9">尾数ABAB</option>
						<option value="10">尾数ABBA</option>
						<option value="4">尾数ABCD+</option>
						<option value="7">尾数AABBCC</option>
						<option value="5">尾数ABCABC</option>
						<option value="2">尾数AAABB</option>
						<option value="1">尾数AAAA+</option>
						<option value="16">中间AAA</option>
						<option value="14">中间AABB</option>
						<option value="11">中间AAAA+</option>
						<option value="15">中间AAABB</option>
						<option value="18">中间AABBB</option>
						<option value="12">中间AAABBB</option>
						<option value="13">中间AABBCC</option>
						<option value="17">中间ABCABC</option>
						</select>
			<i></i>
			</span>
			
			</p>
            <p>
            <label>价格范围：</label>
			<span class="bk">
			<select class="selected" name="price">
			<option value="-1">价格范围</option>
						<option value="0">价格面议</option>
						<option value="1">100元以下</option>
						<option value="2">100-500元</option>
						<option value="3">500-1000元</option>
						<option value="4">1000-2000元</option>
						<option value="5">2000-5000元</option>
						<option value="6">5000-10000元</option>
						<option value="7">10000元以上</option>
						</select>
			<i></i>
			</span>
			</p>-->
       <p><label>包含数字：</label><input class="text" name="key" type="number" placeholder="请输入号码" value=" "><input class="button" type="submit" value="　"></p>
       </form>
    </div>
    <!--<div class="swiper-slide">
       <form class="sreach">
        	
            <p><label>归属地：</label><select class="selected" name=""><option>河南省</option><option>河北省</option></select><select class="selected" name=""><option>南阳市</option><option>商丘市</option></select></p>
        <p><label>包含数字：</label><input class="text" type="text" value="输入号码" /><input class="button" type="button" value="　" /></p>
       </form>
    </div>-->
 
   
  </div>
</div>
</div>
<div class="clear"></div>
<!--<div class="wrap m10">
        <div class="sort-clear">
            <a href="./index_files/index.html" class="btn-clear">清除条件</a> <a href="http://#/dianhua/yuding.htm" class="dycy">号码定制</a>
        </div>
    </div>-->

<div class="clear"></div>
	<div class="tt-first">
	<ul class="tags-sub">
		<li class="current"><a href="#">按默认</a></li>
		<!--<li><a href="http://#/dianhua/search.htm?stype=&m1=0&m2=1&m3=2&grade=-1&province=-1&city=-1&pricescope=-1&key=&s=date">按最新</a></li>
		<li class="arrow">
			<a href="http://#/dianhua/search.htm?stype=&m1=0&m2=1&m3=2&grade=-1&province=-1&city=-1&pricescope=-1&key=&s=lowprice">按价格
				<i></i>
				<s></s>
			</a>
		</li>
-->	</ul>
 </div>
 <div class="clear"></div>
 <div class="cityhaoma">
 	<ul id="mobile_search_more_list">
	     <?php do { ?>	<li><a href="#">
        	<div class="ch_show fleft">
            	<h1><span class="orange"><?php echo substr($row_Recordset1['cp_hao'],0,5); ?></span>-<?php echo  substr($row_Recordset1['cp_hao'],5,6); ?></h1>
                <p><?php echo $row_Recordset1['smalltype']; ?>   　　<?php $E=$row_Recordset1['grade'];
	
	
	switch ($E)
						{
							case -1:
						echo '无规律';
						break;
						
						case 1:
						echo '尾数AAA';
						break;
						case 2:
						echo "尾数ABC";
						break;
						
						case 3:
						echo "尾数AABB";
						break;
							
						case 4:
						echo "尾数ABAB";
						break;	
						
						case 5:
						echo "尾数ABBA";
						break;	
						case 6:
						echo "尾数ABCD+";
						break;	
						case 7:
						echo "尾数AABBCC";
						break;
						case 8:
						echo "尾数ABCABC";
						break;
						case 9:
						echo "尾数AAABB";
						break;
						
						case 10:
						echo "尾数AAAA+";
						break;
						case 11:
						echo "中间AAA";
						break;
						
						case 12:
						echo "中间AABB";
						break;
						
						case 13:
						echo "中间AAAA+";
						break;
						
						case 14:
						echo "中间AAABB";
						break;
						
						case 15:
						echo "中间AABBB";
						break;
						
						case 16:
						echo "中间AAABBB";
						break;
						
						case 17:
						echo "中间AABBCC";
						break;
						
						case 18:
						echo "中间ABCABC";
						break;
						
						/*case 19:
						echo "尾数AAABBB";
						break;
						case 20:
						echo "尾数AABBC";
						break;
						
						case 21:
						echo "尾数ABBABB";
						break;
						
						case 22:
						echo "尾数AAAAA＋";
						break;
						
						case 23:
						echo "尾数ABCDE+";
						break;
						
						case 24:
						echo "尾数ABCABCD";
						break;
						
						case 25:
						echo "尾数ABCDABCD";
						break;
						
						case 26:
						echo "中间AAA";
						break;
						
						case 27:
						echo "中间AAAA";
						break;
						
						case 28:
						echo "中间AABB";
						break;
						case 29:
						echo "中间AAABB";
						break;
						
						case 30:
						echo "中间AABBB";
						break;
						
						case 31:
						echo "中间AAAA+";
						break;
						
						case 32:
						echo "中间AAABBB";
						break;
						
						case 33:
						echo "中间AABBCC";
						break;
						
						case 34:
						echo "人气号";
						break;
						
						case 35:
						echo "情侣号";
						break;
						
						case 36:
						echo "风水号";
						break;
						*/
						
						}
	
	 ?></p>
                <span class="red">￥<?php echo $row_Recordset1['s_price']; ?></span>
            </div>
            <i class="fright dplx group5">至尊店铺</i>
        </a></li> <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
		    
		    	
		    </ul>
 </div>
 <div class="m-pages">
 
 <?php include("fanye.php");?>
 
 </div>
    <div class="clear"></div>
	<!-- 当前位置 --> 
<div class="location">
	<a href="index.php">首页</a>&nbsp;&gt;&nbsp;<a href="cp.php">车牌</a>&nbsp;&gt;&nbsp;搜索选号
</div> 
		<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->



<script type="text/javascript">
$(function() {
	var provinceid = $("#mhDianhuaForm select[name=province]").val();
	if(provinceid == 1 || provinceid == 2 || provinceid == 3 || provinceid == 4) {
		var city = $("#mhDianhuaForm select[name=city]");
		$('#showcity').css('display', 'none');
		var option = "<option value='"+provinceid+"' selected ></option>"; 
		city.append(option);
	}
})
</script>
<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);

//mysql_free_result($Recordset2);?>