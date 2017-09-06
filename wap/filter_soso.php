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
?>

<?php //echo $_GET['px'];?>
<?php if(!empty($_GET['px'])){
	$px=$_GET['px'];}
	else{
	$px="id DESC";	
	}
	
	 ;?>

<?php 


$pid=$_GET['pid'];
$xihuan1="where pid=$pid";

if(!empty($pid)){$xihuan1="$xihuan1";}
else{$xihuan1='';}
//echo $xihuan1;
//echo $pid;

$maxRows_Recordset2 = 30;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = "SELECT id,pid, tel, `day`, sj_hao, info_top, s_price FROM sj $xihuan1 ORDER BY id DESC";
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

$maxRows_Recordset2 = 26;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;



?>

<?php
$currentPage = $_SERVER["PHP_SELF"];


  error_reporting(E_ALL & ~E_NOTICE);
$pid=$_GET['pid'];
//echo $pid."<br>";
$tel=$_GET['tel'];
//echo $tel."<br>";

$theme=$_GET['theme'];
//echo $theme."<br>";

$price=$_GET['price'];
//echo $price."<br>";
$day=$_GET['day'];
//echo $day."<br>";

//$pid="1";
//$tel=2;
//$theme=3;
//$price=4;
//$day=5;
$key=$_GET['key'];
$tai=$_GET['tai'];

$link='';

if(!empty($pid)){
$link = "pid = '$pid' ";
}

if(empty($pid)&&!empty($tel)&&empty($theme)&&empty($price)&&empty($day)){
$link = "tel = '$tel'";
} 

//echo $link;


 if(empty($pid)&&empty($tel)&&!empty($theme)&&empty($price)&&empty($day)){
$link = "theme = '$theme'";
} 




if(empty($pid)&&empty($tel)&&empty($theme)&&!empty($price)&&empty($day)){
$link = "price = '$price'";
} 

 if(empty($pid)&&empty($tel)&&empty($theme)&&empty($price)&&!empty($day)){
$link = "day = '$day'";
} 

//组合选1

if(!empty($pid)&&empty($tel)&&!empty($theme)&&empty($price)&&empty($day)){
$link=$link."  and theme='$theme'" ;

} 

if(!empty($pid)&&empty($tel)&&empty($theme)&&!empty($price)&&empty($day)){
$link=$link."  and price='$price'" ;

} 

if(!empty($pid)&&empty($tel)&&empty($theme)&&empty($price)&&!empty($day)){
$link=$link."  and day='$day'" ;

} 

if(empty($pid)&&!empty($tel)&&!empty($theme)&&empty($price)&&empty($day)){
$link=" tel = '$tel' and theme='$theme'" ;

}

if(empty($pid)&&!empty($tel)&&empty($theme)&&!empty($price)&&empty($day)){
$link=" tel = '$tel' and price='$price'" ;

}
if(empty($pid)&&!empty($tel)&&empty($theme)&&empty($price)&&!empty($day)){
$link=" tel = '$tel' and day='$day'" ;

}

if(empty($pid)&&empty($tel)&&!empty($theme)&&!empty($price)&&empty($day)){
$link="theme = '$theme' and price='$price'" ;

}

if(empty($pid)&&empty($tel)&&!empty($theme)&&empty($price)&&!empty($day)){
$link="theme = '$theme' and day='$day'" ;

}


if(!empty($pid)&&!empty($tel)&&empty($theme)&&!empty($price)&&empty($day)){
$link=$link." and tel = '$tel'  and price='$price' " ;


}

if(!empty($pid)&&!empty($tel)&&empty($theme)&&empty($price)&&!empty($day)){
$link=$link." and tel = '$tel'  and day='$day' " ;


}

if(!empty($pid)&&!empty($tel)&&empty($theme)&&!empty($price)&&!empty($day)){
$link=$link." and tel = '$tel'  and price='$price' and day='$day' " ;


}
if(empty($pid)&&!empty($tel)&&!empty($theme)&&!empty($price)&&empty($day)){
$link="tel = '$tel' and theme='$theme' and price='$price'  " ;


}

if(empty($pid)&&!empty($tel)&&!empty($theme)&&!empty($price)&&!empty($day)){
$link="tel = '$tel' and theme='$theme' and price='$price' and day='$day' " ;


}

if(!empty($pid)&&empty($tel)&&!empty($theme)&&!empty($price)&&empty($day)){
$link=$link."  and theme='$theme' and price='$price' " ;


}

if(!empty($pid)&&empty($tel)&&!empty($theme)&&!empty($price)&&!empty($day)){
$link=$link."  and theme='$theme' and price='$price' and day='$day'" ;


}

if(empty($pid)&&!empty($tel)&&empty($theme)&&!empty($price)&&!empty($day)){
$link=" tel='$tel'  and price='$price' and day='$day'" ;


}

if(!empty($pid)&&empty($tel)&&empty($theme)&&!empty($price)&&!empty($day)){
$link=$link." and price='$price' and day='$day'" ;


}

if(empty($pid)&&empty($tel)&&!empty($theme)&&!empty($price)&&empty($day)){
$link=" theme='$theme'  and price='$price' " ;


}

if(empty($pid)&&empty($tel)&&!empty($theme)&&!empty($price)&&!empty($day)){
$link=" theme='$theme'  and price='$price' and day='$day' " ;


}

if(!empty($pid)&&empty($tel)&&!empty($theme)&&empty($price)&&!empty($day)){
$link=$link." and theme='$theme'   and day='$day' " ;


}

if(!empty($pid)&&!empty($tel)&&!empty($theme)&&empty($price)&&!empty($day)){
$link=$link." and tel=$tel  and theme='$theme'   and day='$day' " ;


}

if(empty($pid)&&!empty($tel)&&!empty($theme)&&empty($price)&&!empty($day)){
$link=" tel=$tel  and theme='$theme'   and day='$day' " ;


}


//组合筛选2
if(!empty($pid)&&!empty($tel)&&empty($theme)&&empty($price)&&empty($day)){
$link=$link." and tel = '$tel'";


}


if(!empty($pid)&&!empty($tel)&&!empty($theme)&&empty($price)&&empty($day)){
$link=$link." and tel = '$tel' and theme='$theme'" ;

}




if(!empty($pid)&&!empty($tel)&&!empty($theme)&&!empty($price)&&empty($day)){
$link=$link." and tel = '$tel' and theme='$theme' and price='$price'" ;


}

if(!empty($pid)&&!empty($tel)&&!empty($theme)&&!empty($price)&&!empty($day)){
$link=$link." and tel = '$tel' and theme='$theme' and price='$price' and day='$day'" ;


}
//包含匹配 下面代码重要
if(!empty($key)&&empty($tai)){
	
	$link="sj_hao like '%$key%'";
	
	}






//调试用看最终输出什么
//echo $link;

if($link){//为真 输出记录集1
$maxRows_Recordset1 = 20;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sj where $link ORDER BY $px";
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

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);


}

	
	
elseif(!empty($key)&&!empty($tai)){//多条件搜索上面表单搜索。尾四查搜。
	
	$link01="substring(sj_hao,-4) like '%$key%'";
	
	$maxRows_Recordset1 = 20;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT sj_hao FROM sj where $link01 ORDER BY $px";
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

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);

	
	
	}	
	


else {//不为真输出记录集1
	
	
	$maxRows_Recordset1 = 20;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sj  ORDER BY $px";
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



$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);

}
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
	<link rel="shortcut icon" href="http://#/favicon.ico" type="image/x-icon">
	<link href="./index_files/swiper.min.css" rel="stylesheet" type="text/css">
	<link href="./index_files/m.public.css" rel="stylesheet" type="text/css">

<link href="./index_files/escrow.css" rel="stylesheet" type="text/css">
<link href="./index_files/demo.css" rel="stylesheet" type="text/css">

</head><body class="index">
	<?php include("top.php");?>

	<div class="clear"></div>
    <a href="http://#/broker/"><img src="./index_files/m-tit.jpg" width="100%"></a>
	<div class="search">
	
    <form action="./filter_soso.php" method="get" name="searchform" id="escrowform">
		<p>
			<input class="text" type="number" name="key" value="" placeholder=" 输入你喜欢的数字"><input class="dan" name="tai" type="checkbox" value="1">尾数 <input name="提交" type="submit" class="button" value="搜索"></p>
			
	</form>
	</div>
	<!-- screening -->
	<!--<div class="screening">
		<ul>
			<li class="Regional">
				<span>归属地</span>
			</li>
			<li class="Sort">
				<span>运营商</span>
			</li>
			<li class="Brand">
				<span>价格</span>
			</li>
			<li class="meishi">
				<span>规律</span>
			</li>
		</ul>
	</div>-->
	<!-- End screening -->
	<!--归属地-->
	<!--<div class="grade-eject">
		<ul class="grade-w" id="gradew">
					<li pid="0">不限 </li>
					<li pid="1">北京 </li>
					<li pid="2">上海 </li>
					<li pid="3">天津 </li>
					<li pid="4">重庆 </li>
					<li pid="5">浙江省 </li>
					<li pid="6">江苏省 </li>
					<li pid="7">广东省 </li>
					<li pid="8">福建省 </li>
					<li pid="9">湖南省 </li>
					<li pid="10">湖北省 </li>
					<li pid="11">辽宁省 </li>
					<li pid="12">吉林省 </li>
					<li pid="13">黑龙江 </li>
					<li pid="14">河北省 </li>
					<li pid="15">河南省 </li>
					<li pid="16">山东省 </li>
					<li pid="17">陕西省 </li>
					<li pid="18">甘肃省 </li>
					<li pid="21">山西省 </li>
					<li pid="22">四川省 </li>
					<li pid="23">贵州省 </li>
					<li pid="24">安徽省 </li>
					<li pid="25">江西省 </li>
					<li pid="26">云南省 </li>
					<li pid="27">内蒙古 </li>
					<li pid="28">广西 </li>
					<li pid="31">海南省 </li>
					<li pid="20">新疆 </li>
					<li pid="29">西藏 </li>
					<li pid="19">青海省 </li>
					<li pid="30">宁夏 </li>
				</ul>
		<ul class="grade-t" id="gradet">
			
		</ul>
	</div>-->
	<!-- End 归属地 -->

	<!-- 运营商-->
	<!--<div class="Sort-eject Sort-height">
		<ul class="Sort-Sort" id="Sort-Sort">
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=-1&pricescope=-1">不限</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=1&grade=-1&pricescope=-1">中国移动</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=2&grade=-1&pricescope=-1">中国联通</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=3&grade=-1&pricescope=-1">中国电信</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=4&grade=-1&pricescope=-1">虚拟运营商</a></li>
				</ul>
	</div>-->

	<!--价格-->
	<!--<div class="Category-eject">
		<ul class="Category-w" id="Categorytw">
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=-1&pricescope=-1">不限</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=-1&pricescope=0">价格面议</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=-1&pricescope=1">500元以下</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=-1&pricescope=2">500-2000元</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=-1&pricescope=3">2000-5000元</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=-1&pricescope=4">5000-10000元</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=-1&pricescope=5">10000-50000元</a></li>
					<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=-1&pricescope=6">50000元以上</a></li>
				</ul>
	</div>-->
	<!-- End 价格 -->

	<!-- 规律 -->
	<!--<div class="meishi22">
		<ul class="meishia-w" id="meishia">
        <li><a style="color:#ff0000;" href="http://#/escrow/search.htm?key=520&tail=1">520爱情号专区</a></li>
            <li><a style="color:#ff0000;" href="http://#/escrow/search.htm?key=521&tail=1">521爱情号专区</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=-1&pricescope=-1">不限</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=0&pricescope=-1">普通号码</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=28&pricescope=-1">尾数AA</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=18&pricescope=-1">尾数AAA</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=13&pricescope=-1">尾数AAAA</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=11&pricescope=-1">尾数AAAAA</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=2&pricescope=-1">尾数AAAAA+</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=3&pricescope=-1">尾数AAABBB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=19&pricescope=-1">尾数ABC</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=12&pricescope=-1">尾数ABCD</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=31&pricescope=-1">尾数ABCDABCD</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=10&pricescope=-1">尾数ABCDE</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=1&pricescope=-1">尾数ABCDE+</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=39&pricescope=-1">尾数AAAAAB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=34&pricescope=-1">尾数AAAAB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=16&pricescope=-1">尾数AAAB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=32&pricescope=-1">尾数AAB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=14&pricescope=-1">尾数AABB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=30&pricescope=-1">尾数AABA</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=17&pricescope=-1">尾数ABAB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=15&pricescope=-1">尾数ABBA</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=29&pricescope=-1">尾数ABAA</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=8&pricescope=-1">尾数AAABB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=9&pricescope=-1">尾数AABBB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=7&pricescope=-1">尾数AABAA</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=5&pricescope=-1">尾数ABCABC</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=4&pricescope=-1">尾数AABBCC</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=6&pricescope=-1">尾数ABBABB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=33&pricescope=-1">尾数ABCABCD</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=35&pricescope=-1">尾数AABBCCDD</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=36&pricescope=-1">尾数ABABABAB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=37&pricescope=-1">尾数ABBBABBB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=38&pricescope=-1">尾数AAABAAAB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=26&pricescope=-1">中间AAA</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=24&pricescope=-1">中间AAAA</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=21&pricescope=-1">中间AAAA+</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=25&pricescope=-1">中间AABB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=23&pricescope=-1">中间AAABB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=22&pricescope=-1">中间AABBB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=20&pricescope=-1">中间AAABBB</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=27&pricescope=-1">中间AABBCC</a></li>
							<li><a href="http://#/escrow/search.htm?cityid=0&manager=0&grade=40&pricescope=-1">中间ABAB</a></li>
					</ul>
	</div>-->
    
    
    
<!--<iframe src="filter/filter.php" width="100%" height="719" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>-->
    
    
        <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- Bootstrap -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
     <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
     $(function(){
       <?php
          if($_GET){
            echo 'var obj='.json_encode($_GET).';';
          }
       ?>
      if(typeof(obj)!='undefined'){
          for(k in obj){
            $("#"+k).val(obj[k]);
            $("a["+k+"="+obj[k]+"]").parent().addClass("in").siblings().removeClass("in");
          }
      }
     })
    </script>
    <script>
        function Filter(a,b){
          var $ = function(e){return document.getElementById(e);}
          var ipts = $('filterForm').getElementsByTagName('input'),result=[];
          for(var i=0,l=ipts.length;i<l;i++){
          if(ipts[i].getAttribute('to')=='filter'){
          result.push(ipts[i]);
          }
          }
          if($(a)){
          $(a).value = b;
          for(var j=0,len=result.length;j<len;j++){
          
            if(result[j].value=='' || result[j].value=='0'){
            result[j].parentNode.removeChild(result[j]);
            }
          }
            document.forms['filterForm'].submit();
          }
          return false;
          } 
    </script>

  <style>
   .mtp30{
	margin-top: 0px;
}
   .warning{background: #FCF8E3;}
   .img30{width: 30px;height:30px;}
   .img20{width: 20px;height:20px;}
   .listsearch{border:1px solid #FFDCAF;border-top: 2px solid #FF9100;height:200px;}
   .border-color{border-color: #FFDCAF;}
   .top-color{border-top: 2px solid #FF9100}
   .red{color: #FF335D;font-family: '微软雅黑';font-weight: 24px;}
   .searchbody{line-height: 35px;margin-left: 15px;}
   .row a{color: #444;text-decoration: none;}
   .row a:hover{color: #FA8D00}
   .row li{padding-right: 5px;padding-left: 10px;}
   .in,.in a{background: #FA8D00;color: #fff;border-radius: 4px;}
   .in a:hover{color: #fff}
   
   
   #row_one li { display: block; width: 43%; text-align:left;}/*我加控制最底下的规律条件项*/
   #row_tow li { display: block; width: 30%; }
  </style>
    
    
    
    
    
    
    
    
    
    
	<div class="clear"></div>
	<div class="tt-first">
        <ul class="tags-sub"><?php $px=$_GET['px'];?>
            <li class="current"><a href="filter_soso.php?<?php if(isset($px)&&$px=="id DESC"){echo "";}else{echo "px=id DESC&";}; ?><?php echo $_SERVER['QUERY_STRING'];?>">按默认</a></li>
            <!--<li><a href="filter.php?<?php if(isset($px)&&$px=="id ASC"){echo "";}else{echo "px=id ASC&";}; ?><?php echo $_SERVER['QUERY_STRING'];?>">按最新</a></li>
            <li class="arrow">
				<a href="http://#/escrow/search.htm?key=&tail=0&cityid=0&manager=0&grade=-1&pricescope=-1&s=lowprice">按价格
					<i></i>
					<s></s>
				</a>
			</li>
            <li class="han"><a href="http://#/escrow/search.htm?key=&tail=0&cityid=0&manager=0&grade=-1&pricescope=-1&s=indextj&four=1"><input class="han4" name="tail" type="checkbox" value="1">不含4</a></li>-->
			
        </ul>
    </div>
	<div class="clear"></div>
    <div class="e-number">
    	<ul class="list-info">
		       
               
               
               
                <?php do { ?>
                	<li>
           <a href="filter_xy.php?id=<?php echo $row_Recordset1['id']; ?>&pid=<?php echo $row_Recordset1['pid']; ?>&tel=<?php echo $row_Recordset1['tel']; ?>" target="_blank" class="clearfix">
             <div>
            <strong class="fleft">
				<?php error_reporting(E_ALL & ~E_NOTICE); 
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
				          } ?><span class="text-danger"><?php 
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
				          } ?></span>
                </strong>
                <span class="price fright">￥<?php echo $row_Recordset1['s_price']; ?></span>
			</div>
             <p><span class="fleft text-success">				<?php  $a=$row_Recordset1['pid'];
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
					
					 ?></span><span class="fright text-normal">含费<?php 
				if($row_Recordset1['hfei']!=""){echo $row_Recordset1['hfei'];}else{echo "0" ;} ?>元</span></p>
            </a>
            </li>
            
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
		        	
		        </ul>
        <div class="m-pages">
								<?php include("fanye.php");?>
							</div> <br>
         <div class="clear"></div>
    </div>
	<div class="location">
		<a href="index.php">首页</a>&nbsp;&gt;&nbsp;<a href="filter.php">手机靓号</a>&nbsp;&gt;&nbsp;搜索选号
	</div>
	<!--<div class="index_kefu"><a href="tel:17182831666"><i class="index_tel"></i>电话咨询</a><a href="http://p.qiao.#####.com/cps/chat?siteId=10116005&userId=18077514"><i class="index_contact"></i>在线咨询</a></div>-->
    <!--<div class="#####_kefu"><a href="http://p.qiao.#####.com/cps/chat?siteId=10116005&userId=18077514"><img width="100%" src="./index_files/kefu_icon.png"></a></div>-->
	<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->



<script type="text/javascript" src="./index_files/jquery.cookie.js"></script>
<script type="text/javascript" src="./index_files/demo.js"></script><!--联动菜单-->
<script type="text/javascript" src="./index_files/jquery-1.8.2.min.js"></script><!--联动菜单--><div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>