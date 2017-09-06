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
$query_Recordset1 = sprintf("SELECT * FROM sj WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 13;
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
	
	<meta charset="UTF-8">
		<meta name="applicable-device" content="pc">
        <?php include("keyword.php");?>
	<meta name="robots" content="All">
	<meta name="verify-v1" content="casZho9kECUkOAU+2uY1SGpjeqJiwu0o/ALrzgPNKFo=">
	<meta name="AizhanSEO" content="a2511a4d1a6a1b0fe57f5ce001438cc9">
	<meta http-equiv="Content-Language" content="zh_CN">
	<meta name="author" content="lezhizhe.net">
	<meta name="copyright" content="jihaoba.com">
	<link rel="shortcut icon" href="#/favicon.ico" type="image/x-icon">
	<link href="./index_files/public.css" rel="stylesheet" type="text/css">

	<meta name="mobile-agent" content="format=html5;url=http://m.jihaoba.com/escrow/6699-15805323666.htm">
	<link href="./index_files/escrow.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include("nav.php");?>
<div id="bj" style="display: none;"></div>


<div class="main">
<div class="onepage_bt">当前位置：<a href="/">玖玖靓号</a>&nbsp;&gt;&nbsp;<a href="filter.php" title="手机靓号">手机靓号</a>&nbsp;&gt;&nbsp;<a href="javascript:void(0);" target="_blank" title="#"><?php echo $row_Recordset1['sj_hao']; ?>号码详情</a></div>
<!--手机号码详情-->
	<div class="hmxq fright">
    	<div class="pzc">
        	<div class="phaoma">
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
						</div>
			<div class="pguishu"><?php  $a=$row_Recordset1['pid'];
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
					
					 ?></div>
            <div class="clear"></div>
        </div>	
		<ul class="hmxq-list">
        	<li>
				<div class="hmxq-sx fleft">价格：</div>
				<div class="hmxq-wz fright">
					<span class="red zi20">￥<?php echo $row_Recordset1['s_price']; ?></span>（含费 ￥<?php 
				if($row_Recordset1['hfei']!=""){echo $row_Recordset1['hfei'];}else{echo "0" ;} ?>元）	
				</div>
				<div class="clear"></div>
			</li>
            <li><div class="hmxq-sx fleft">规律：</div><div class="hmxq-wz fright"><?php  $E=$row_Recordset1['day']; 
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
						
						
						}
					 
					 ?></div><div class="clear"></div></li>
            <li><div class="hmxq-sx fleft">特殊字符：</div><div class="hmxq-wz fright"><?php echo $row_Recordset1['tszf']; ?></div><div class="clear"></div></li>
            <li>
          <div class="hmxq-sx fleft">号码备注：</div><div class="hmxq-wz fright"><?php echo $row_Recordset1['message']; ?></div><div class="clear"></div></li>
            <li><div class="hmxq-sx fleft">号码详情：</div>
            <div class="hmxq-wz fright">如对此号感兴趣，请咨询玖玖靓号客服</div><div class="clear"></div></li>
        </ul>
        <div class="hmxq_button">
			<input type="button" class="hmxq_gm one" value="联系经纪人">
			<!--<a href="http://qiycl.com" class="hmxq_yd two">支付定金</a>-->
           
		   <script type="text/javascript">  

function openwindow(url,name,iWidth,iHeight)  
{  
// url 转向网页的地址   
// name 网页名称，可为空   
// iWidth 弹出窗口的宽度   
// iHeight 弹出窗口的高度   
//window.screen.height获得屏幕的高，window.screen.width获得屏幕的宽   
var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;   
var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;   
window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');  
}  

</script>  
      <!--      <a href="javascript:void(0);"  onclick="javascript:openwindow('wx_zffs.php?id=<?php echo $row_Recordset1['id']; ?>','1',500,260);" class="hmxq_yd">付款购买</a>-->
              <a href="zf_xz.php?id=<?php echo $row_Recordset1['id']; ?>&pid=<?php echo $row_Recordset1['pid']; ?>&tel=<?php echo $row_Recordset1['tel']; ?>"   class="hmxq_yd">付款购买</a>
			<div class="clear"></div>
		</div>
		<div class="ghlc">
			<img src="./index_files/ghlc.jpg">
		</div>
	</div>
<!--手机号码详情结束-->

<!--店铺介绍-->
	<div class="box_fleft fl">
    	<div class="xinxi color_border m15">
        	<div class="guan-icon"></div>
      		<div class="escrow_logo">
           	  <a href="javascript:void(0);" class="two">
            	<?php /*start db_input script*/ if ($row_Recordset1['phpoto'] == ""){ ?>
            	  <img src="images/defaultpic.jpg" />
            	  <?php } /*end db_input script*/ ?>
                  
                 
              <?php   if ($row_Recordset1['phpoto'] != ""){ ?>
            	  <img src="../images/<?php echo $row_Recordset1['phpoto']; ?>">
				  <?php }  ?>
                    
                    
            	</a>
                <div class="escrow-xinxi fr">
               	  <p class="escrow-name"><a href="#" target="_blank"><?php echo $row_Recordset1['info_editor']; ?></a><span>经纪人</span></p>
                    <p class="escrow-work">   </p>
                </div>
            </div>
            <div class="jj_phone">
                <img src="./index_files/jj-phone.png" width="35px" height="35">
								<?php echo $row_Recordset1['l_tel']; ?>&nbsp;&nbsp;
								
            </div>
            <div class="xx_show clearfix">
                <div class="fleft">微信：<?php echo $row_Recordset1['wx']; ?></div>
                <div class="shop_nr fright"></div>
            </div>
            <div class="cheng" style="margin-bottom:5px;"><a href="javascript:void(0);" class="three"><img src="./index_files/cheng.jpg" width="100%"></a></div>
            <div class="xx_show clearfix">
                <div class="fleft">服务星级：<img src="./index_files/star.png" width="112" height="19"></div>
                <div class="shop_nr fright"></div>
            </div>
            <div class="escrow-all"><a href="javascript:;"><span>&gt;&gt;</span><!--查看其他3914个中介号码--></a></div>
	    </div>
        
          
		<div class="chuchuang m15">
			<div class="bt"><i></i><span>猜你喜欢</span></div>
  
			<div class="tj_hm">
				<ul>
                  <?php if ($totalRows_Recordset2 > 0) { // Show if recordset not empty ?>
  <?php do { ?>
    <li><a href="filter_xy.php?id=<?php echo $row_Recordset2['id']; ?>&pid=<?php echo $row_Recordset2['pid']; ?>&tel=<?php echo $row_Recordset2['tel']; ?>">
      <span class="tj01"><?php error_reporting(E_ALL & ~E_NOTICE); 
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
				          } ?></span></span>
      <span class="tj02"><?php  $E=$row_Recordset2['day']; 
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
						
						
						}
					 
					 ?></span>
      <span class="tj03">￥ <?php echo $row_Recordset2['s_price']; ?></span>
      </a>
    </li>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                    <?php } // Show if recordset not empty ?>
                </ul>
			</div>
		</div>
    </div>
    <div class="clear"></div>
</div>

<!--店铺介绍结束-->


<?php include ("footer.php")?>

<!--弹出层开始-->
<div class="box">
	<div class="box2">
		<div class="login5">
			<h2>微信扫描二维码 马上联系经纪人</h2>
			<a class="close"></a>
		</div>
		<div class="login51">
			<div class="login5left">
				<img src="images/<?php echo $row_Recordset3['gg_photo1']; ?>" width="170" height="170">
			</div>
			<div class="login5right">
				<ul>

				<li>1、扫描二维码</li>
					<li>2、添加经纪人微信</li>
					<li>3、联系经纪人</li>
				</ul>
			</div>
		</div>
	</div>
    
</div>
<script src="./index_files/jquery.min.js"></script>
<script src="./index_files/jquery.cookie.js"></script>
<script type="text/javascript">
$(function() {
	$('.one').click(function(){
		$('.box2').show();
	});	
	$('.login5 a').click(function(){
		$('.box2').hide();
	});	
	$('.two').click(function(){
		$('.box2').show();
	});	
	$('.three').click(function(){
		$('.box2').show();
	});
})
</script>
<!--弹出层强结束-->


<!-- 代码 开始 -->
<div id="rightArrow"><a href="javascript:;" title="在线客户"></a></div>
<div id="floatDivBoxs">
	<div class="floatDtt">号码经纪人</div>
    <div class="floatShadow">
        <ul class="floatDqq">
            <li style="padding-left:0px;">
													<a target="_blank"  href="tencent://message/?uin=<?php echo $row_Rec_qqgl011['w_qq']; ?>&Menu=yes"><img src="./index_files/qq1.png" align="absmiddle">&nbsp;&nbsp;点击咨询</a>
		  </li>
        </ul>
        <div class="floatDtxt">咨询热线</div>
        <div class="floatDtel">17745611099&nbsp;&nbsp;
	  </div>
        <div style="text-align:center;padding:10PX 0 5px 0;background:#EBEBEB;"><img src="images/wx.jpg" width="130" height="130"><br>客服微信</div>
    
    <div style="text-align:center;padding:10PX 0 5px 0;background:#EBEBEB;"><img src="images/<?php echo $row_Recordset3['gg_photo1']; ?>"><br>
      微信公众账号</div>
    <div class="floatDbg"></div>
    
</div>
<!-- 代码 结束 -->
<!--右侧浮动qq-->
<script type="text/javascript" src="./index_files/lrtk.js"></script></div><div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div>
</body></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Rec_qqgl011);
?>
