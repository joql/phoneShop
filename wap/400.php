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

/*echo  $m1=$_GET['m1'];
echo  $m2=$_GET['m2'];
echo  $m3=$_GET['m3'];*/
$p0=400;
 $p1=$_GET['p1'];
 $p2= $_GET['p2'];
 $p3= $_GET['p3'];
 $p4= $_GET['p4'];
 $p5= $_GET['p5'];
 $p6= $_GET['p6'];
 $p7= $_GET['p7'];
 
  $key0=$p0.$p1.$p2.$p3.$p4.$p5.$p6.$p7;
 
 
 $key=$_GET['key'];
 

//条件判断			  
/*if(empty($m1)&&empty($m2)&&empty($m3)){$link= "";}

if(empty($m1)&&!empty($m2)&&!empty($m3)){ $link="(and a=4007 or a=4001) and sLL_hao like '%$key%' ";}  */
if(!empty($key)){ $link=" and sLL_hao like '%$key%' ";}elseif(!empty($key0)){$link=" and sLL_hao like '%$key0%' ";}else{$link="";}

$maxRows_Recordset1 = 20;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sll where 1=1 $link ORDER BY id DESC";
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
				
		<link rel="dns-prefetch" href="http://static1.hrblh.com/">
			
		<link rel="dns-prefetch" href="http://static2.hrblh.com/">
			
		<link rel="dns-prefetch" href="http://static3.hrblh.com/">
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

<link href="./index_files/m.400.css" rel="stylesheet" type="text/css">
</head>

<body class="index">
	<?php include("top.php");?>

	<!-- banner -->
<div id="top-slide" class="swiper-container top-slide swiper-container-horizontal" data-swiper="[object Object]">
	<div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
				<div class="swiper-slide swiper-slide-active" style="width: 1423px;">
			<a href="400.php" target="_blank"><img src="./index_files/5776253e3fdbb.jpg"></a>
		</div>
				<div class="swiper-slide swiper-slide-next" style="width: 1423px;">
			<a href="filter.php" target="_blank"><img src="./index_files/593e417c2a80b.jpg"></a>
		</div>
				<div class="swiper-slide" style="width: 1423px;">
			<a href="index.php" target="_blank"><img src="./index_files/59312016151c0.jpg"></a>
		</div>
					</div>
	<div class="swiper-pagination"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
</div>
	<div class="clear"></div>
	<!-- search -->
	<div id="fourSearch" class="sousuo">
		<div class="tabs">
		  <a href="javascript:void(0);" class="active">模糊搜索</a>
		  <a href="javascript:void(0);" class="">定位搜索</a>
		</div>
		<div id="fourSearch_slide" class="swiper-container swiper-container-horizontal" data-swiper="[object Object]">
		  <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
			<div class="swiper-slide swiper-slide-active" style="height: 80px; width: 1423px; background: rgb(255, 255, 255);">
			 
              
              <form name="form1" action="400.php" method="get" class="sreach" id="fuzzyFourForm" >
				<!--<p><label>运营商：</label><input name="m1" type="checkbox" class="dan dan_active" value="1" checked="checked">移动<input name="m2" type="checkbox" class="dan dan_active" value="2" checked="checked">联通<input name="m3" type="checkbox" class="dan dan_active" value="3" checked="checked">电信</p>-->
				<p><label>包含数字：</label><input name="key" type="number" class="text" id="key" placeholder="输入号码" value=""><input name="提交" type="submit" class="button" value="&nbsp;&nbsp;&nbsp;"></p>
			  </form>
			</div>
			<div class="swiper-slide swiper-slide-next" style="height: 80px; width: 1423px; background: rgb(255, 255, 255);">
			  <form class="sreach" id="fourForm" action="400.php" method="get">
				<!--<p><label>运营商：</label><input class="dan dan_active" name="m1" type="checkbox" value="1">移动<input class="dan dan_active" name="m2" type="checkbox" value="1">联通<input class="dan dan_active" name="m3" type="checkbox" value="1">电信</p>-->
				<p><label>定位搜：</label>
				<span class="dws">
				<input name="pa" type="text" value="4" disabled="" readonly="">
				<input name="pb" type="text" value="0" disabled="" readonly="">
				<input name="pc" type="text" value="0" disabled="" readonly="">
				<input name="p1" type="number" min="0" max="9">
				<input name="p2" type="number" min="0" max="9">
				<input name="p3" type="number" min="0" max="9">
				<input name="p4" type="number" min="0" max="9">
				<input name="p5" type="number" min="0" max="9">
				<input name="p6" type="number" min="0" max="9">
				<input name="p7" type="number" min="0" max="9">
				<input class="button" type="submit" value="　">
				</span></p>
			  </form>
			</div>
		  </div>
		</div>
	</div>
	<div class="clear"></div>
	<!--<div class="hots">
		<div class="hots_1"><a class="hosted" href="/400/all/">快速选号</a></div><div class="hots_2"><a class="hosted" href="/400/4001/all-all-all-all-all-1.htm">移动4001</a></div><div class="hots_3"><a href="/400/4007/all-all-all-all-all-1.htm">移动4007</a></div>
	</div>-->
	<!--<div class="hots">
		<div class="hots_3"><a class="hosted" href="/400/4000/all-all-all-all-all-1.htm">联通4000</a></div><div class="hots_2"><a class="hosted" href="/400/4008/all-all-all-all-all-1.htm">电信4008</a></div><div class="hots_1"><a href="/400/4009/all-all-all-all-all-1.htm">电信4009</a></div>
	</div>-->
	<div class="clear"></div>
<!--号码展示-->
<div class="haoma">
	<div class="haomabt">
    	<i></i><span><a href="#" target="_blank">按默认</a></span>
    </div>
    <ul class="hmlist">
	     <?php do { ?>
         <li>
	         <a href="sLL_xy.php?id=<?php echo $row_Recordset1['id']; ?>" >
             <h2><i class="icon liang"></i>
	             <span class="yellow"><?php echo substr($row_Recordset1['sLL_hao'],0,4); ?></span><?php echo substr($row_Recordset1['sLL_hao'],4,7); ?>
             </h2>
             <p><span class="fleft"><?php $c=$row_Recordset1['c']; 
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
  
  
  ?></span>
               <span class="fright">￥<span class="red"><?php echo $row_Recordset1['s_price']; ?></span></span>
           </p></a></li>
	       <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        
		
      <div class="clear"></div>
    </ul> 
    <div id="news_more" classid="1" class="jzgd"><?php include("fanye.php");?><i class="gdicon icon"></i></div>  
</div>
<div class="clear"></div>
<div class="haoma">
	<!--<div class="haomabt">
    	<i></i><span><a href="http://#/400.php" target="_blank">官方推荐靓号</a></span>
    </div>-->
    <ul class="hmlist">
    	<div class="clear"></div>
	</ul>  
  <!--  <div id="news_more" classid="1" class="jzgd"><a href="http://#/400.php" target="_blank">查看更多</a><i class="gdicon icon"></i></div>  
</div>-->
<div class="clear"></div>

<div class="clear"></div>
<div class="location">
		<a href="index.php">首页</a>&nbsp;&gt;&nbsp;<a href="400.php">400电话</a>
	</div>
		<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->


<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);
?>
