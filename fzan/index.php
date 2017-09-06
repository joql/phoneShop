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

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sy_news WHERE news_title = '加盟建站'";
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta charset="UTF-8">
<meta name="applicable-device" content="pc">
  <?php include("../keyword.php");?>
<link rel="shortcut icon" href="http://localhost/images/favicon.ico" type="image/x-icon"><meta name="robots" content="All">
<meta name="verify-v1" content="casZho9kECUkOAU+2uY1SGpjeqJiwu0o/ALrzgPNKFo=">
<meta name="AizhanSEO" content="a2511a4d1a6a1b0fe57f5ce001438cc9">
<meta http-equiv="Content-Language" content="zh_CN">
<meta name="author" content="lezhizhe.net">
<meta name="copyright" content="#.com">
<link rel="shortcut icon" href="http://hrblh.com/images/favicon.ico" type="image/x-icon"><link href="./index_files/public.css" rel="stylesheet" type="text/css">
<!--<meta name="mobile-agent" content="format=html5;url=http://m.#.com/escrow/">-->
<link href="./index_files/escrow.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include("../nav.php");?>
<div id="bj" style="display: none;"></div>


<script type="text/javascript">
if((typeof(bidding_second) != "undefined")) {
	document.write(bidding_second);
}
</script>
<!-- 代码 开始 --><!--
<div id="rightArrow"><a href="javascript:;" title="在线客户"></a></div>
<div id="floatDivBoxs">
  <div class="floatDtt">在线客服</div>
  <div class="floatShadow">
    <ul class="floatDqq">
      <li style="padding-left:0px;"><a target="_blank" href="http://b.qq.com/webc.htm?new=0&sid=800060708&eid=2188z8p8p8p8x8p8y8p8z&o=www.#.com&q=7" rel="external nofollow"><img src="./index_files/qq1.png" align="absmiddle">&nbsp;&nbsp;在线客服</a></li>
    </ul>
    <div class="floatDtxt">热线电话</div>
    <div class="floatDtel"><img src="./index_files/online_phone.jpg" width="155" height="45" alt=""></div>
    <div style="text-align:center;padding:10PX 0 5px 0;background:#EBEBEB;"><img src="./index_files/57a1437445133.png" width="130" height="130"><br>
      客服微信</div>
    <div style="text-align:center;padding:10PX 0 5px 0;background:#EBEBEB;"><img src="./index_files/ewm.jpg"><br>
      微信公众账号</div>
  </div>
  <div class="floatDbg"></div>
</div>-->
<!-- 代码 结束 --> 

<br />
<br />




<!--导航开始 -->

<!--<link href="./index01_files/public.css" rel="stylesheet" type="text/css">-->
<link href="./index01_files/shopsite.css" type="text/css" rel="stylesheet">






<div class="duli-banner">
	<div class="duli-banner-con"><img style="CURSOR: pointer" border="0" src="./index01_files/buy.jpg" title="点击购买" alt="点击购买"></div>
</div>
<!--什么是独立网站-->
<div class="what">
<div class="what-con">
	<div class="what01"><img src="./index01_files/what-bt.png" width="365" height="40" title="什么是独立网站？" alt="什么是独立网站？">
    	<div class="what01-con">独立网站就是您可以拥有自己独立的店标、品牌、域名、空间，独立的企业形象。<br>
独立店铺也可以根据需求做各种营销活动。<br>
多一条宣传通道、多一个销售途径、多一种商业模式，多一次创造财富的机会。</div>
<img src="./index01_files/tedian.png" width="250" height="37" title="独立网站特点" alt="独立网站特点">
    </div>
    <div class="what02">
    	<p>独立域名</p>
        <p>独立空间</p>
        <p>独立品牌</p>
    </div>
    <div class="what03"></div>
    <div class="clear"></div>
</div>
</div>
<!--独立店铺优势-->
<div class="youshi">
	<div class="youshi-bt"><img src="./index01_files/youshi-bt.jpg" width="1190" height="36" title="独立网站有哪些优势？" alt="独立网站有哪些优势？"></div>
    <dl class="youshi-l"><dt><img src="./index01_files/youshi01.jpg" width="633" height="292" title="专业技术团队量身打造" alt="专业技术团队量身打造"></dt><dd><h4>专业技术团队量身打造</h4>玖玖靓号拥有一直专业的技术团队，并具有8年号码网站运营经验，历时1个月潜心打造出一套专业卖号的网站</dd><div class="clear"></div></dl>
    <dl class="youshi-r"><dt><h4>助你进行自我品牌塑造</h4>商家可以上传自己的LOGO，上传自己的广告活动图片，使用并宣传自己的独立域名，也可以根据自己店铺的需要发布活动文章，打造自己的品牌，树立自己的品牌形象。</dt><dd><img src="./index01_files/youshi02.jpg" width="633" height="292" title="助你塑造自我品牌" alt="助你塑造自我品牌"></dd><div class="clear"></div></dl>
    <dl class="youshi-l"><dt><img src="./index01_files/youshi03.jpg" width="633" height="292" title="绝无仅有的推广优势" alt="绝无仅有的推广优势"></dt><dd><h4>绝无仅有的推广优势</h4>您购买独立网站之后发布的号码不仅仅可以在独立店铺展示，还会在玖玖靓号总站、城市分站、玖玖靓号店铺（包括手机版店铺）等多站点同步显示。</dd><div class="clear"></div></dl>
    <dl class="youshi-r"><dt><h4>花更少的钱</h4>在市面上，与玖玖靓号独立店铺类似功能的网站价格都在万元以上。玖玖靓号为了回馈广大会员们多年来支持，内部会员独立网站特价<span>880元</span>，续费仅需<span>880元</span>。让会员享受超值的服务。</dt><dd><img src="./index01_files/youshi04.jpg" width="633" height="292" title="花更少的钱做更好的品质" alt="花更少的钱做更好的品质"></dd><div class="clear"></div></dl>
</div>
<!--开通-->
<div class="kaitong">
<div class="hy"><p>如果您已是玖玖靓号VIP会员，恭喜你，直接点击联系客服开通独立网站吧！</p><a target="_blank" href="tencent://message/?uin=110999999&Menu=yes"><img style="CURSOR: pointer" border="0" src="./index01_files/hy-b.png" title="VIP会员立即开通" alt="VIP会员立即开通"></a></div>
<div class="fhy"><p>如果您不是VIP会员，快点击下方按钮注册会员 ，开通店铺办理VIP会员！</p>
  <a href="../hy/zze.php"><img style="CURSOR: pointer" border="0" src="./index01_files/fhy-b.png" title="立即注册" alt="立即注册"></a></div>
<div class="clear"></div>
</div>
<!--开通资料问答-->
<div class="question">
	<!--<div class="question-con">
    	<div class="question-bt"><img src="./index01_files/question-bt.jpg" width="425" height="64" title="如何开通独立网站" alt="如何开通独立网站"></div>
    	<dl class="wenda"><dt>1、购买独立网站需要准备什么？</dt>
        <dd>答：第一步：首先您需要是玖玖靓号的VIP会员。步骤是注册会员——开通店铺——联系客服办理VIP会员。<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;第二步：联系客服，提供域名。</dd></dl>
      <dl class="wenda"><dt>2、开通独立网站后多久能访问？</dt>
        <dd>答：独立网站开通时间为1个小时。开通后，会有专业技术为您的店铺进行装修。装修时间为1-3个工作日。装修成功后即可正常访问。<br>
</dd></dl>
<dl class="wenda"><dt>3、没有域名怎么办？</dt>
        <dd>答：若没有域名，可以委托玖玖靓号给您注册一个，100元/年，也可以向玖玖靓号申请一个二级域名（免费）。例如：http://*.hrblh.com。其中*号可以换成你喜欢的域名。<br></dd></dl>
        <dl class="wenda"><dt>4、有演示网站吗？</dt>
        <dd>答：<a href="http://www.guotonghao.com/" target="_blank" rel="nofollow">演示网站1</a><a href="http://www.longshanhao.com/" target="_blank" rel="nofollow">演示网站2</a><a href="http://www.xunhaoba.com/" target="_blank" rel="nofollow">演示网站3</a><a href="http://www.043110086.com/" target="_blank" rel="nofollow">演示网站4</a><a href="http://www.0431xh.com/" target="_blank" rel="nofollow">演示网站5</a><a href="http://www.yalehao.com/" target="_blank" rel="nofollow">演示网站6</a><a href="http://www.170mei.cc/" target="_blank" rel="nofollow">演示网站7</a><a href="http://www.170h.cn/" target="_blank" rel="nofollow">演示网站8</a></dd></dl>
    </div>-->
    <div class="question-con">
    <div class="question-con">
    	<div class="question-bt"><img src="./index01_files/question-bt.jpg" width="425" height="64" title="如何开通独立网站" alt="如何开通独立网站"></div>
    
	<dl class="wenda">
	<?php echo $row_Recordset1['news_content']; ?>
    </div>
    
</div>








<div class="foot">
  <div class="main">
   <div class="bottom_contact fl">
      <dl class="question_icon">
        <dt></dt>
        <dd>  
        <a target="_blank" href="tencent://message/?uin=110999999&Menu=yes"><img src="./index_files/qq01.png" align="absmiddle"></a>

        </dd>
        <div class="clear"></div>
      </dl>
      <dl class="tel24">
        <dt></dt>
        <dd>
          <p>上午：8:00-12:00</p>
          <p>下午：14:00-18:00</p>
          <p class="bottom-tel">0451-89675888</p>
        </dd>
        <div class="clear"></div>
      </dl>
    </div>
    <ul class="b_nav fr">
      <li>
        <dl>
          <dt>关于玖玖靓号</dt>
          <dd><a href="http://hrblh.com/foot_news.php?news_id=1" rel="nofollow">玖玖靓号简介</a></dd>
          <dd><a href="http://hrblh.com/foot_news.php?news_id=2" rel="nofollow">交易方式</a></dd>
          <dd><a href="http://hrblh.com/foot_news.php?news_id=3" rel="nofollow">买号码</a></dd>
         <!-- <dd><a href="#/" target="_blank" rel="nofollow">免费开店</a></dd>-->
        </dl>
      </li>
      <li>
        <dl>
          <dt>加盟合作</dt>
          <dd><a href="http://hrblh.com/foot_news.php?news_id=4" rel="nofollow">VIP会员</a></dd>
         <!-- <dd><a href="#/about/morecity.htm" rel="nofollow">图片广告</a></dd>
          <dd><a href="#/about/shopid.htm" rel="nofollow">超靓门牌号</a></dd>-->
        </dl>
      </li>
      <li>
        <dl>
          <dt>联系我们</dt>
          <dd><a href="http://hrblh.com/foot_news.php?news_id=6" title="联系我们" rel="nofollow">联系我们</a></dd>
          <dd><a href="http://hrblh.com/foot_news.php?news_id=7" title="付款方式" rel="nofollow">付款方式</a></dd>
          <dd><a href="http://hrblh.com/foot_news.php?news_id=8" title="网站地图">网站地图</a></dd>
       <!--  <dd><a href="#/about/ad.htm" title="广告服务" rel="nofollow">广告服务</a></dd>-->
        </dl>
      </li>
      <li>
        <h3>玖玖靓号微博</h3>
        <img src="./index_files/gongzong01.jpg" width="110" height="110" alt="玖玖靓号微博"> </li>
      <li>
        <h3>玖玖靓号微信公众号</h3>
        <img src="./index_files/gongzong02.jpg" width="110" height="110" alt="玖玖靓号微信公众号"> </li>
      <div class="clear"></div>
    </ul>
    <script src="./index_files/jquery.min.js"></script> 
    <script src="./index_files/jquery.cookie.js"></script> 
    <script src="./index_files/gundong.js"></script> 
    <script src="./index_files/index_banner.js"></script> 
    <script src="./index_files/home.js"></script> 
    <script type="text/javascript" src="./index_files/index.js"></script> 
    <script type="text/javascript">
	$(function() {
		//登陆用户头部显示登陆信息
		$.ajax({
			type : "get",
			url :"#/loginuser",
			data :'',
			dataType :"jsonp",
			jsonp: false,
			jsonpCallback: "getuserLogin",
			success : function(data){
				if(data.success) {
					$('#loginusername').html(data.user.msg);
					$('#havelogin').css('display','');
					$('#nologin').css('display','none');
				} else {
					$('#havelogin').css('display','none');
					$('#nologin').css('display','');
				}
			},
			error : function(){
				$('#havelogin').css('display','none');
				$('#nologin').css('display','');
			}
		});
	})
	</script>
    <div class="clear"></div>
    <div class="copyright">大量靓号转让、求购信息，尽在玖玖靓号！可查看固定电话、车牌号、手机号展示信息！<br>
      地址：哈尔滨市南岗区士课街39号，玖玖靓号　电话：0451-89675888  13313613133  17745610086　QQ:110999999:  邮箱：HRB9999@ALIYUN.COM<br>

黑ICP备16008634号-1　Copyright © 2010-2028   All rights reserved　
      　
     
    </div>
  </div>
</div>
<a href="javascript:;" class="cd-top">Top</a> 

<!--右侧浮动qq--> 
<div style=" z-index:9999;"> <script type="text/javascript" src="./index_files/lrtk.js"></script>
<div>
  <object id="ClCache" click="sendMsg" host="" width="0" height="0">
  </object></div><!---->
</div>

 
<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);
?>
