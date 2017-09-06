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
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = sprintf("SELECT * FROM kuhua WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 18;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = "SELECT * FROM kuhua ORDER BY info_time DESC";
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
			<meta name="location" content="province=河北省;city=石家庄">
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

<div class="clear"></div>
<div class="haomaxx">
	<div class="haomaxx_bt">
    	<h1 > <?php echo substr($row_Recordset1['gh_hao'],0,4); ?>-<?php echo substr($row_Recordset1['gh_hao'],4,8); ?>
				</h1>
        <div class="status_bar"> </div>
    </div>
	<div class="haomaxx_nr">
    	<p class="haomaxx-one"><span class="mc">售价：</span><span class="cs red"><?php echo $row_Recordset1['s_price']; ?></span></p>
        <p class="haomaxx-two"><span class="mc">归属地：</span><span class="cs"><?php if($row_Recordset1['bigtype']==1){echo "黑龙江";} ?>　<?php echo $row_Recordset1['smalltype']; ?></span></p>
        <p class="haomaxx-one"><span class="mc">规律：</span><span class="cs"><?php $E=$row_Recordset1['grade'];
	
	
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
	
	 ?></span></p>
        <p class="haomaxx-two"><span class="mc">类型：</span><span class="cs"> <?php  if($row_Recordset1['m1']=="-1"){echo "无线 | " ;} ?> <?php  if($row_Recordset1['m2']=="1"){echo "有线 |"; }?> <?php if($row_Recordset1['m3']=="2"){echo "商务一号通 | "; }?></span></p>
        <p class="haomaxx-three"><span class="mc">号码寓意：</span><span class="cs"><?php echo $row_Recordset1['message']; ?></span></p>
		<!--<p class="haomaxx-three"><span class="mc">号码详情：</span><span class="cs"></span></p>-->
        <div class="clear"></div>
    </div>
    
</div>
<div class="clear"></div>
<!-- 联系卖家预约 -->
<div class="lxmj">
<div class="contact-tabs">
  <a href="#" class="active">联系卖家</a>
  <a href="#" class="">在线预约</a> 
</div>
<?php $ym="gh_xy.php" ;
  include("xy_from.php");?>
</div>

<div class="clear"></div>
<!--号码展示-->
<div class="haoma" style="margin:0">
	
     <ul class="hmlist">
     <?php do { ?>
	     	<li><a href="gh_xy.php?id=<?php echo $row_Recordset2['id']; ?>" target="_blank"><h2><i class="icon liang"></i><span class="yellow"><?php echo substr($row_Recordset2['gh_hao'],0,4); ?>-</span><?php echo substr($row_Recordset2['gh_hao'],4,8); ?></h2><p><span class="fleft"><?php echo $row_Recordset2['smalltype']; ?></span><span class="fright">￥<span class="red"><?php echo $row_Recordset2['s_price']; ?></span></span></p></a></li>
           <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
          </ul>  
</div>
<div class="clear"></div>
<div class="jzgd"><a href="gh.php" target="_blank">我要看更多</a><i class="gdicon icon"></i></div>
<div class="clear"></div>
<!-- 当前位置 --> 
<div class="location">
	<a href="index.php">首页</a>&nbsp;&gt;&nbsp;<a href="gh_xy.php">固定电话</a>
</div> 
<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->



<!--<a href="tel:17745611099" class="cd-tel" style="display: inline;"></a>-->
<script type="text/javascript">
	$(function() {	
		$('#submit').bind('click', function() {
			if(submitorder()) {
				$.post('/order', {
						id:$('#id').val(),
						type:$('#type').val(),
						name:$('input[name=name]').val(),
						tel:$('input[name=tel]').val(),
						useraddress:$('input[name=useraddress]').val(),
						formhash:'96913f73',
						submit:'1'
					},
					function (data) {
						alert(data.msg);
						if(data.success) {
						  $('#order')[0].reset();
						}
					},
					'json'
				);
			}
			return false;
		});
		$('#localcity').html('石家庄');
		$('a.city_a').attr('href','');
	});
	function submitorder() {
		var str=/^1[3|4|5|7|8][0-9]{9}$/;
		if(form.name.value==''){
			alert('请填写姓名！');
			form.name.focus();
			return false;
		} else if(form.tel.value==''){
			alert('请填写联系电话');
			form.tel.focus();
			return false;
		} else if(!str.exec(form.tel.value)){
			alert('请填11位的手机号码');
			form.tel.focus();
			return false;
		} else return true;
	}
</script><div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>