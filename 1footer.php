<?php require_once('Connections/connch21.php'); ?>
<?php


mysql_select_db($database_connch21, $connch21);
$query_Rec_glfoot = "SELECT * FROM admin_wysz";
$Rec_glfoot = mysql_query($query_Rec_glfoot, $connch21) or die(mysql_error());
$row_Rec_glfoot = mysql_fetch_assoc($Rec_glfoot);
$totalRows_Rec_glfoot = mysql_num_rows($Rec_glfoot);
?>
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


<div class="foot">
  <div class="main">
    <!--<div class="bottom_contact fl">
      <dl class="question_icon">
        <dt></dt>
        <dd> <img style="CURSOR: pointer" onclick="javascript:window.open(&#39;http://b.qq.com/webc.htm?new=0&amp;sid=800060708&amp;eid=2188z8p8p8p8x8p8y8p8z&amp;o=www.#.com&amp;q=7&#39;, &#39;_blank&#39;, &#39;height=544, width=644,toolbar=no,scrollbars=no,menubar=no,status=no&#39;);" border="0" src="./index_files/pa"> </dd>
        <div class="clear"></div>
      </dl>
      <dl class="tel24">
        <dt></dt>
        <dd>
          <p>上午：8:00-12:00</p>
          <p>下午：14:00-18:00</p>
          <p class="bottom-tel">4008-915-925</p>
        </dd>
        <div class="clear"></div>
      </dl>
    </div>-->
    <!--<ul class="b_nav fr">
      <li>
        <dl>
          <dt>关于玖玖靓号</dt>
          <dd><a href="#/about/about.htm" rel="nofollow">玖玖靓号简介</a></dd>
          <dd><a href="#/about/safe.htm" rel="nofollow">交易方式</a></dd>
          <dd><a href="#/zhuanti/guide/buy.htm" rel="nofollow">买号码</a></dd>
          <dd><a href="#/" target="_blank" rel="nofollow">免费开店</a></dd>
        </dl>
      </li>
      <li>
        <dl>
          <dt>加盟合作</dt>
          <dd><a href="#/about/vip.htm" rel="nofollow">VIP会员</a></dd>
          <dd><a href="#/about/morecity.htm" rel="nofollow">图片广告</a></dd>
          <dd><a href="#/about/shopid.htm" rel="nofollow">超靓门牌号</a></dd>
        </dl>
      </li>
      <li>
        <dl>
          <dt>联系我们</dt>
          <dd><a href="#/about/contact.htm" title="联系我们" rel="nofollow">联系我们</a></dd>
          <dd><a href="#/about/payment.htm" title="付款方式" rel="nofollow">付款方式</a></dd>
          <dd><a href="#/about/sitemap.htm" title="网站地图">网站地图</a></dd>
          <dd><a href="#/about/ad.htm" title="广告服务" rel="nofollow">广告服务</a></dd>
        </dl>
      </li>
      <li>
        <h3>玖玖靓号微博</h3>
        <img src="./index_files/weibo-ewm.jpg" width="110" height="110" alt="玖玖靓号微博"> </li>
      <li>
        <h3>玖玖靓号微信公众号</h3>
        <img src="./index_files/ewm.jpg" width="110" height="110" alt="玖玖靓号微信公众号"> </li>
      <div class="clear"></div>
    </ul>-->
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
      地址：<?php echo $row_Rec_glfoot['w_address']; ?>　电话：<?php echo $row_Rec_glfoot['w_tel']; ?>　QQ:<?php echo $row_Rec_glfoot['w_qq']; ?>:  邮箱：<?php echo $row_Rec_glfoot['w_emil']; ?><br />

<?php echo $row_Rec_glfoot['w_footsm']; ?>　Copyright © 2010-2028   All rights reserved　
      　
     
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
<?php
mysql_free_result($Rec_glfoot);
?>
