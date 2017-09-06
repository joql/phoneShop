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
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = sprintf("SELECT * FROM kuhua WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 10;
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
	
	<meta charset="UTF-8">
		 <?php include("keyword.php");?>
	<meta name="robots" content="All">
	<meta name="verify-v1" content="casZho9kECUkOAU+2uY1SGpjeqJiwu0o/ALrzgPNKFo=">
	<meta name="AizhanSEO" content="a2511a4d1a6a1b0fe57f5ce001438cc9">
	<meta http-equiv="Content-Language" content="zh_CN">
	<meta name="author" content="lezhizhe.net">
	<meta name="copyright" content="jihaoba.com">
	<link rel="shortcut icon" href="#/favicon.ico" type="image/x-icon">
	<link href="./index_files/public.css" rel="stylesheet" type="text/css">

<meta name="mobile-agent" content="format=html5;url=http://m.jihaoba.com/dianhua/54497-028-66886686.htm">
	<link href="./index_files/telephone.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include("nav.php");?>
<div id="bj" style="display: none;"></div>


<div class="main">
<div class="onepage_bt">当前位置：<a href="/">首页</a>&nbsp;&gt;&nbsp;<a href="gh.php">固定电话</a>&nbsp;&gt;&nbsp;黑龙江&nbsp;&gt;&nbsp;<a href="javascript:void(0);" target="_blank"><?php echo $row_Recordset1['smalltype']; ?>电话号码</a>&nbsp;&gt;<?php echo $row_Recordset1['gh_hao']; ?>号码详情</div>
<!--固定电话详情-->
	<div class="hmxq fl">
    <table width="818" border="0" cellspacing="1" cellpadding="" class="hmxq_list">
  <tbody><tr>
    <td colspan="4">
		<h1>
		<span><?php echo $row_Recordset1['gh_hao']; ?></span>
						    </h1>
		<p></p><div class="fl datetime"><?php  if($row_Recordset1['m1']=="-1"){echo "无线 | " ;} ?> <?php  if($row_Recordset1['m2']=="1"){echo "有线 |"; }?> <?php if($row_Recordset1['m3']=="2"){echo "商务一号通 | "; }?> 发布时间：<?php echo $row_Recordset1['info_time']; ?></div><!--<div class="fr llsc"><span class="hmxq_sc"><a class="addFavorite" key="1211227" type="dianhua" style="cursor:pointer;">收藏</a></span><a href="#/dianhua/search.htm?favorite=1"><span class="hmxq_fx" href="/dianhua/search.htm?favorite=1&amp;rand=0.17516220803372562">已收藏<span class="favoritedianhua">0</span>个</span></a></div>--><p></p></td>
    </tr>
  <tr>
    <td class="hmxq_sx">售价：</td>
    <td class="hmxq_sj yellow">￥<?php echo $row_Recordset1['s_price']; ?></td>
    <td class="hmxq_sx">归属地：</td>
    <td class="hmxq_nr"><?php if($row_Recordset1['bigtype']==1){echo "黑龙江";} ?>　<?php echo $row_Recordset1['smalltype']; ?></td>
  </tr>
  <tr>
    <td class="hmxq_sx">号码规律：</td>
    <td class="hmxq_nr"><?php $E=$row_Recordset1['grade'];
	
	
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
	
	 ?></td>
    <td class="hmxq_sx">所属分类：</td>
    <td class="hmxq_nr">
    <?php  if($row_Recordset1['m1']=="-1"){echo "无线 | " ;} ?> <?php  if($row_Recordset1['m2']=="1"){echo "有线 |"; }?> <?php if($row_Recordset1['m3']=="2"){echo "商务一号通 | "; }?>
    
    </td>
  </tr>
    <tr>
    <td class="hmxq_sx">号码寓意：</td>
    <td colspan="3" class="hmxq_nr"><?php echo $row_Recordset1['message']; ?></td>
    </tr>
		    <tr>
    <td class="hmxq_sx">联系方式：</td>
    <td colspan="3" class="hmxq_nr sj-phone"><?php echo $row_Recordset1['l_tel']; ?><br></td>
    </tr>
</tbody></table>

<!--<div class="hmxq_button"><a style="cursor:pointer;" id="yuding" class="hmxq_gm">预约此号</a><a href="#/about/safe.htm" class="hmxq_yd" target="_blank">如何交易？</a></div>-->
    </div>
<!--店铺介绍-->
	<!--<div class="xq_shop fr">
    	<div class="shop_logo"><a href="" target="_blank"><img src="" width="185" height="135" alt=""/></a></div>
        <div class="shop_rz">
			<span class="shop_rz1 on"></span>
			<span class="shop_rz2 on"></span>
			<span class="shop_rz3 "></span>
			<span class="shop_rz_vip3"></span>
      			<div class="clear"></div>
		</div>
        <div class="shop_xinxi">
        	<div class="shop_xinxi_l fl">店铺：</div><div class="shop_xinxi_r fr"><a href="#/u/54497" target="_blank" style="color:#000000">成都号码商城</a></div>
            <div class="clear"></div>
            <div class="shop_xinxi_l fl">电话：</div><div class="shop_xinxi_r fr">18628888000</div><div class="clear"></div>
<div class="shop_xinxi_l fl">Q Q：</div>
	<div class="shop_xinxi_r fr">
		<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=18628888000&site=qq&menu=yes"><img border="0" src="./index_files/pa" alt="点击这里给我发消息" title="点击这里给我发消息"></a> 18628888000
		</div>
	<div class="clear"></div>
<div class="shop_xinxi_l fl">微信：</div><div class="shop_xinxi_r fr">成都市太升南路</div><div class="clear"></div>
<div class="shop_xinxi_l fl">旺旺：</div><div class="shop_xinxi_r fr">
<a target="_blank" href="http://www.taobao.com/webww/ww.php?ver=3&touid=clever0524&siteid=jihaoba&status=1&charset=utf-8" rel="nofollow"><img border="0" src="./index_files/online.aw" alt="点击这里给我发消息"></a>
</div><div class="clear"></div>
<div class="shop_xinxi_l fl">地址：</div><div class="shop_xinxi_r fr">成都市太升南路</div>
			<div class="clear"></div>
        </div>
        <a href="#/u/54497" class="enter" target="_blank">进入选号</a>
    </div>-->
    <div class="clear"></div>
</div>
<!--店铺介绍结束-->

<div class="number_right_num">
<div class="number_01 "><span><a href="search.php">更多</a></span>为您推荐其它的固话靓号</div>
        	<ul>
									<?php do { ?>
								    <li><a href="gh_xy.php?id=<?php echo $row_Recordset2['id']; ?>" target="_blank"><h2><i class="liang"></i><span class="yellow"><?php echo substr($row_Recordset2['gh_hao'],0,4); ?>-</span><?php echo substr($row_Recordset2['gh_hao'],4,8); ?></h2><p><span class="fl"><?php echo $row_Recordset2['smalltype']; ?></span><span class="fr">￥<span class="red"><?php echo $row_Recordset2['s_price']; ?></span></span></p></a></li>
									  <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
			            						
			            			            			            			            			                        <div class="clear"></div>
            </ul>
    	</div>
<div style="height:10px;"></div>
<!--在线预定开始-->
<div class="zxyd_ceng" style="display:none ">
<div class="zxyd">
    <div class="ydtx">预订提醒：靓号有限，先到先得，建议直接<a href="#/shop/?id=54497&com=contact" target="_blank">联系卖家</a>可更快获取此号码。</div>
        <div class="ydhm">您要预定的号码是：028-66886686
                <br>
          <form action="" method="post" id="order" name="order">
      <input type="hidden" name="id" value="1211227">
    <input type="hidden" name="type" value="telephone">
     <input type="hidden" name="submit" value="1">
    <input type="hidden" name="formhash" value="ff42ec87">
          <label class="ms_label">姓名：</label><input name="name" id="name" type="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="ms_label">电话：</label><input name="tel" id="tel" type="text"><br>
        <label class="ms_label">地址：</label><input name="address" type="text" size="51"><br>
        <button type="button" class="button_yd" id="submit">立即预定</button><input type="reset" class="button_ct" value="重新填写"><div class="clear"></div>        </form></div>
    <div class="hmxq_cha"><span id="closemodal"><img src="./index_files/close.png"></span></div>
</div>
</div>
<!--在线预定结束-->


<?php include ("footer.php")?>

<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
