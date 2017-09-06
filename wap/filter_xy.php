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
$query_Recordset1 = sprintf("SELECT * FROM sj WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 6;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

$colname_Recordset2 = "-1";
if (isset($_GET['pid'])) {
  $colname_Recordset2 = $_GET['pid'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = sprintf("SELECT * FROM sj WHERE pid = %s and tel='".$_GET['tel']."' and id <> '".$_GET['id']."' ORDER BY pid DESC", GetSQLValueString($colname_Recordset2, "int"));
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
$query_Recordset3 = "SELECT * FROM guanggao WHERE title = '公众平台二维码'";
$Recordset3 = mysql_query($query_Recordset3, $connch21) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_connch21, $connch21);
$query_Rec_qqgl011 = "SELECT * FROM admin_wysz";
$Rec_qqgl011 = mysql_query($query_Rec_qqgl011, $connch21) or die(mysql_error());
$row_Rec_qqgl011 = mysql_fetch_assoc($Rec_qqgl011);
$totalRows_Rec_qqgl011 = mysql_num_rows($Rec_qqgl011);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<meta name="applicable-device" content="mobile">
    <meta name="format-detection" content="telephone=no">
	<meta charset="UTF-8">
			<meta name="location" content="province=四川省;city=成都">
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

<link href="./index_files/escrow.css" rel="stylesheet" type="text/css">
<link href="./index_files/demo.css" rel="stylesheet" type="text/css">

</head><body class="index">
<?php include("top.php");?>


	<div class="escrow-head">
		<div class="basic_info flexbox">
			<div class="head_info"> 
            
            <a href="#">
           <!-- <img src="./index_files/20170605153209_75022.jpg"  class="lazyload" data-mark="agent_img"> -->
            <?php /*start db_input script*/ if ($row_Recordset1['phpoto'] == ""){ ?>
            	  <img src="../images/defaultpic.jpg"  class="lazyload" data-mark="agent_img"/>
            	  <?php } /*end db_input script*/ ?>
                  
                 
              <?php   if ($row_Recordset1['phpoto'] != ""){ ?>
            	  <img src="../images/<?php echo $row_Recordset1['phpoto']; ?>" class="lazyload" data-mark="agent_img">
				  <?php }  ?>
            
            
            </a> </div>
			<div class="detail_info box_col">
				<h1 class="item_main text_cut"><span class="name q_agentname" data-mark="agent_name"><?php echo $row_Recordset1['info_editor']; ?></span><span class="info q_level">经纪人</span></h1>
				<div class="item_other"><div>微信号:<?php echo $row_Recordset1['wx']; ?></div></div>
			</div>
			<div class="escrow_tel"> <a href="tel:17745611099"><i></i></a> </div>
			<!--<div class="good_info"><div class="item_other"><a href="/escrow/622/"><span class="good_rate" data-mark="good_rate" data-info="num=64&amp;rate=95.0">18450<span>个</span></span><span class="good_rate_title">中介号码</span></a></div></div>-->
			<div class="clear"></div>
		</div>
	</div>
	<div class="haomaxx">
		<div class="haomaxx_bt">
			<h1 class="z_center"> 
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
				          } ?><span class="yellow"><?php 
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
				 
			</h1>
			<div class="haoma-dq"><?php  $a=$row_Recordset1['pid'];
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
							} ?>  <?php $b=$row_Recordset1['tel'];
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
					
					 ?> <span class="red z_center">价格：￥<?php echo $row_Recordset1['s_price']; ?></span></div>
		</div>
		<div class="haomaxx_nr">
			<p class="haomaxx-one"><span class="mc">含费：</span><span class="cs">￥<?php 
				if($row_Recordset1['hfei']!=""){echo $row_Recordset1['hfei'];}else{echo "0" ;} ?></span></p>
			<p class="haomaxx-two"><span class="mc">规律：</span><span class="cs"><?php  $E=$row_Recordset1['day']; 
					 switch ($E)
						{
						case 1:
						echo '普通号码';
						break;
						case 2:
						echo "尾数AA";
						break;
						
						case 3:
						echo "尾数AAA";
						break;
							
						case 4:
						echo "尾数AAAA";
						break;	
						
						case 5:
						echo "尾数ABC";
						break;	
						case 6:
						echo "尾数ABCD";
						break;	
						case 7:
						echo "尾数AAAAA";
						break;
						case 8:
						echo "尾数AABB";
						break;
						case 9:
						echo "尾数AAAAB";
						break;
						
						case 10:
						echo "尾数AAAB";
						break;
						case 11:
						echo "尾数AABA";
						break;
						
						case 12:
						echo "尾数AABB";
						break;
						
						case 13:
						echo "尾数ABBA";
						break;
						
						case 14:
						echo "尾数ABCDE";
						break;
						
						case 15:
						echo "尾数AAABB";
						break;
						
						case 16:
						echo "尾数AABBB";
						break;
						
						case 17:
						echo "尾数AABAA";
						break;
						
						case 18:
						echo "尾数ABCABC";
						break;
						
						case 19:
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
						
						case 37:
						echo "尾号ABAB";
						break;
						
						}
					 
					 ?></span></p>
			<!--<p class="haomaxx-one"><span class="mc">低消：</span><span class="cs">0元/月</span></p>-->
			<p class="haomaxx-two"><span class="mc">特殊字：</span><span class="cs"><?php echo $row_Recordset1['tszf']; ?></span></p>
			<p class="haomaxx-three"><span class="mc">号码备注：</span><span class="cs"><?php echo $row_Recordset1['message']; ?></span></p>
			<p class="haomaxx-three"><span class="mc">详情：</span><span class="cs">如对此号感兴趣，请咨询玖玖靓号客服</span></p>
			<div class="haomaxx-three blue-wx lxqq">
				<img src="./index_files/w-zx.jpg" width="36" height="36">
				咨询靓号信息加微信：<span style="color:#ff0000; font-weight:bold"><?php echo $row_Recordset1['wx']; ?></span>
			</div>
			<!--微信-->
			<div class="buy"><a href="sj_fk.php?id=<?php echo $row_Recordset1['id']; ?>">支付订金</a></div>
			<div style="font-size:1rem; color:#333; text-align:center; ">支付订金，保留号码，线下过户</div>
			<div class="clear"></div>
		</div>
		<!--经纪人信息--> 

		<div class="escrow-tips" style="background:#fef7dc; padding:15px; margin-bottom:5px; line-height:180%; color:#FB7D00; font-size:0.7rem"> 
			1、联系客服确定号码是否还在。<br>
            			2、预约成功后，然后确定交易时间和营业厅地点。<br>
            			3、根据国家工信部相关规定，所有手机号码销售都需要提供身份证实名验证,到营业厅实名过户。国家工信部《电话用户真实身份信息登记规定》（工业和信息化部令第25号）、电话“黑卡”治理专项行动工作方案。
		</div>
		<!--<div class="saler-say">
			<h2>卖家说</h2>
			<div class="saler-con">
				<div class="saler-logo"><img src="./index_files/saler-logo.jpg"></div>
				<div class="saler-js">
					<p><span></span></p>
					<p>过户地点：成都移动任意营业厅</p>
				</div>
				<div class="clear"></div>
				<div class="saler-neirong">
					<div class="saler-neirong-top"></div>
					万物皆有阴阳五行，数字也一样都有阴阳五行，只有与你五行相生的数字才能够给你带来好运。你的手机号码跟你的命理五行相生吗？本人特价转让五行靓号，为你转运！ 
				</div>
			</div>
		</div>-->
		<div class="haomaxx_yc">
			<dl class="gsd-jg1">
				<dd><img src="./index_files/liucheng.jpg"></dd>
				<dt><span>所有号码必须当面交易，实名过户！</span></dt>
			</dl>
		</div>
	</div>
	<div class="clear"></div>
	<!-- 联系卖家预约 -->
	
	<div class="clear"></div>
	<!--号码展示-->
	<div class="haoma">
		<h3 class="escrow_head current">猜你喜欢</h3>
		<ul class="hmlist">
			 
			  <?php if ($totalRows_Recordset2 > 0) { // Show if recordset not empty ?>
  <?php do { ?>
						<li><a href="filter_xy.php?id=<?php echo $row_Recordset2['id']; ?>&pid=<?php echo $row_Recordset2['pid']; ?>&tel=<?php echo $row_Recordset2['tel']; ?>">
				<h2><i class="icon liang"></i> 
					<?php error_reporting(E_ALL & ~E_NOTICE); 
				 $j_red=$row_Recordset2['info_top']; 
				 switch ($j_red)
						{
						case 0:
						echo $row_Recordset2['sj_hao'];
						break;
						case 1:
						echo substr($row_Recordset2['sj_hao'],0,8);
						break;
				        case 2:
						echo substr($row_Recordset2['sj_hao'],0,7);
						break;
						case 3:
						echo substr($row_Recordset2['sj_hao'],0,6);
						break;
				          } ?><span class="yellow"><?php 
						  // $j_red01=$row_Recordset1['sj_hao']; 
						  
						  switch ($j_red)
						{
						case 0:
						echo "";
						break;
						case 1:
						echo substr($row_Recordset2['sj_hao'],8,3);
						break;
				        case 2:
						echo substr($row_Recordset2['sj_hao'],7,4);
						break;
						 case 3:
						echo substr($row_Recordset2['sj_hao'],6,5);
						break;
				          } ?></span></h2>
				<p><span class="ychidden"><?php  $a=$row_Recordset2['pid'];
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
							} ?>  <?php $b=$row_Recordset2['tel'];
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
					
					 ?></span> <span><span class="red">￥ <?php echo $row_Recordset2['s_price']; ?></span></span></p>
				</a></li>
			  <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                    <?php } // Show if recordset not empty ?>
			 
			<div class="clear"></div>
			<div id="news_more" classid="1" class="jzgd"><a href="filter.php">查看更多</a><i class="gdicon icon"></i></div>
		</ul>
	</div>
	<div class="clear"></div>
	<!--<div id="firstpane" class="menu_list">
		<h3 class="menu_head current">周边城市</h3>
		<div style="" class="menu_body"> 
			 
				<a href="http://#/chengdu/" title="成都手机号码" target="_blank">成都</a> 
			 
				<a href="http://#/zigong/" title="自贡手机号码" target="_blank">自贡</a> 
			 
				<a href="http://#/panzhihua/" title="攀枝花手机号码" target="_blank">攀枝花</a> 
			 
				<a href="http://#/luzhou/" title="泸州手机号码" target="_blank">泸州</a> 
			 
				<a href="http://#/deyang/" title="德阳手机号码" target="_blank">德阳</a> 
			 
				<a href="http://#/mianyang/" title="绵阳手机号码" target="_blank">绵阳</a> 
			 
				<a href="http://#/guangyuan/" title="广元手机号码" target="_blank">广元</a> 
			 
				<a href="http://#/suining/" title="遂宁手机号码" target="_blank">遂宁</a> 
			 
				<a href="http://#/neijiang/" title="内江手机号码" target="_blank">内江</a> 
			 
				<a href="http://#/leshan/" title="乐山手机号码" target="_blank">乐山</a> 
			 
				<a href="http://#/nanchong/" title="南充手机号码" target="_blank">南充</a> 
			 
				<a href="http://#/meishan/" title="眉山手机号码" target="_blank">眉山</a> 
			 
				<a href="http://#/yibin/" title="宜宾手机号码" target="_blank">宜宾</a> 
			 
				<a href="http://#/guangan/" title="广安手机号码" target="_blank">广安</a> 
			 
				<a href="http://#/dazhou/" title="达州手机号码" target="_blank">达州</a> 
			 
				<a href="http://#/yaan/" title="雅安手机号码" target="_blank">雅安</a> 
			 
				<a href="http://#/bazhong/" title="巴中手机号码" target="_blank">巴中</a> 
			 
				<a href="http://#/ziyang/" title="资阳手机号码" target="_blank">资阳</a> 
			 
				<a href="http://#/aba/" title="阿坝手机号码" target="_blank">阿坝</a> 
			 
				<a href="http://#/ganzi/" title="甘孜手机号码" target="_blank">甘孜</a> 
			 
				<a href="http://#/liangshan/" title="凉山手机号码" target="_blank">凉山</a> 
			 
		</div>
		<h3 class="menu_head">热门城市</h3>
		<div style="display:none" class="menu_body"> <a href="http://#/beijing/" title="北京手机号码" target="_blank">北京</a> <a href="http://#/shanghai/" title="上海手机号码" target="_blank">上海</a> <a href="http://#/shenzhen/" title="深圳手机号码" target="_blank">深圳</a> <a href="http://#/guangzhou/" title="广州手机号码" target="_blank">广州</a> <a href="http://#/zhengzhou/" title="郑州手机号码" target="_blank">郑州</a> <a href="http://#/tianjin/" title="天津手机号码" target="_blank">天津</a> <a href="http://#/chengdu/" title="成都手机号码" target="_blank">成都</a> <a href="http://#/haerbin/" title="哈尔滨手机号码" target="_blank">哈尔滨</a> <a href="http://#/changsha/" title="长沙手机号码" target="_blank">长沙</a> <a href="http://#/wuhan/" title="武汉手机号码" target="_blank">武汉</a> <a href="http://#/changchun/" title="长春手机号码" target="_blank">长春</a> <a href="http://#/chongqing/" title="重庆手机号码" target="_blank">重庆</a> <a href="http://#/hangzhou/" title="杭州手机号码" target="_blank">杭州</a> <a href="http://#/suzhou/" title="苏州手机号码" target="_blank">苏州</a> <a href="http://#/fuzhou/" title="福州手机号码" target="_blank">福州</a> <a href="http://#/quanzhou/" title="泉州手机号码" target="_blank">泉州</a> <a href="http://#/hefei/" title="合肥手机号码" target="_blank">合肥</a> <a href="http://#/shenyang/" title="沈阳手机号码" target="_blank">沈阳</a> <a href="http://#/sjz/" title="石家庄手机号码" target="_blank">石家庄</a> </div>
	</div>-->
	<div class="location"> <a href="index.php">首页</a>&nbsp;&gt;&nbsp;<a href="#">手机号</a> </div>
	<div class="footbar">
		<div class="btn-group"> 
			<a href="#" class="btn btn-primary btn-large js-touch-state">
				<div class="mod_media"><?php /*start db_input script*/ if ($row_Recordset1['phpoto'] == ""){ ?>
            	  <img src="../images/defaultpic.jpg"  class="lazyload" data-mark="agent_img"/>
            	  <?php } /*end db_input script*/ ?>
                  
                 
              <?php   if ($row_Recordset1['phpoto'] != ""){ ?>
            	  <img src="../images/<?php echo $row_Recordset1['phpoto']; ?>" class="lazyload" data-mark="agent_img">
				  <?php }  ?></div>
				<div class="box_col item_list">
					<div class="item_main text_cut"><?php echo $row_Recordset1['info_editor']; ?></div>
					<div class="item_minor q_phone">17745611099</div>
				</div>
			</a>
			<div class="icon-cutprize"><a href="tel:17745611099"><i class="icon-c"></i>致电</a></div>
			<div class="icon-order"><a target="_blank" href="sms:17745611099"><i class="icon-o"></i>短信</a></div>
		</div>
	</div>
	<!--浮动手机号码--> 
	<!--<a href="tel:17745611099" class="cd-tel"></a>--> 
<script src="./index_files/622" type="text/javascript"></script> 
	<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->



<p style="height:40px;">&nbsp;</p>
<script type="text/javascript">
$(document).ready(function(){

	$("#firstpane .menu_body:eq(0)").show();
	$("#firstpane h3.menu_head").click(function(){
		$(this).addClass("current").next("div.menu_body").slideToggle(500).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	
	$("#secondpane .menu_body:eq(0)").show();
	$("#secondpane h3.menu_head").mouseover(function(){
		$(this).addClass("current").next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	
	$('.lxqq').bind('click', function() {
		$('#open').css('display', 'block');
	});
	$('.close-open').bind('click', function() {
		$('#open').css('display', 'none');
	});
});
</script>
<!--弹出层-->
<div class="open" id="open" style="display:none">
	<div class="title-bar-wrapper">
        <a class="i-back close-open" href="javascript:void(0);"></a> 
        <h2 class="title-bar-center-title">经纪人微信</h2>
    </div>
    <div class="open_contact">
		    	<img src="../images/wx.jpg" width="200" height="200">
		    	<p>扫码加微信</p>
        <p>微信号：110999999</p>
    </div>
</div><div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Rec_qqgl011);
?>
