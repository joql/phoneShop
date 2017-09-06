<?php session_start();  
error_reporting(E_ALL & ~E_NOTICE);
include_once('connect.php');


$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$dir = dirname($url);

ini_set('date.timezone', 'Asia/Shanghai');
//配置文件在lib/WxPay.Config.php
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";

//$order_no = date("YmdHis") . rand(1000, 9999);
$order_no =$_GET['order_no'];
$body = "微信支付购买手机靓号：".$_GET['sj'];//订单描述

//$order_money = rand(1, 10) / 100; //订单金额 元
//$order_money = 0.01; //订单金额 元
$order_money = $_GET['price']; //订单金额 
$url_notify = $dir . "/notify03.php";

//添加订单 我后加的参考
//$query = mysql_query("INSERT INTO `order` (`order_no`,`order_money`,`pay_type`,`addtime`,sjh) VALUES ('" . $order_no . "', '" . $order_money . "','jsapi', '" . time() . "','".$_GET['sj']."');");


$tools = new JsApiPay();
//①、获取用户openid 
$openId = isset($_SESSION['openId']) ? $_SESSION['openId'] : "";
if ($openId == '') {
    $openId = $tools->GetOpenid();
    $_SESSION['openId'] = $openId;
}


//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody($body);
$input->SetAttach("");//附加数据
$input->SetOut_trade_no($order_no);
$input->SetTotal_fee($order_money * 100);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("test");
$input->SetNotify_url($url_notify);
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
$jsApiParameters = $tools->GetJsApiParameters($order);
//echo $jsApiParameters;exit
//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?><!DOCTYPE html>
<html>
<head>
<title>微信支付</title>
<meta charset="utf-8" />
<meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="css/wxzf.css">
<script src="js/jquery.js"></script>
<script type="text/javascript">
$(function(){
	//出现浮动层
	$(".ljzf_but").click(function(){
		$(".ftc_wzsf").show();
		});
	//关闭浮动
	$(".close").click(function(){
		$(".ftc_wzsf").hide();
		});
		//数字显示隐藏
		$(".xiaq_tb").click(function(){
		$(".numb_box").slideUp(500);
		});
		$(".mm_box").click(function(){
		$(".numb_box").slideDown(500);
		});
		//----
		var i = 0;
		$(".nub_ggg li a").click(function(){
			i++
			if(i<6){
				$(".mm_box li").eq(i-1).addClass("mmdd");
				}else{
					$(".mm_box li").eq(i-1).addClass("mmdd"); 
					setTimeout(function(){
					location.href="cg.html"; 
					},500);
					//window.document.location="cg.html"
			 } 
		});
		
		$(".nub_ggg li .del").click(function(){
			
			if(i>0){
				i--
				$(".mm_box li").eq(i).removeClass("mmdd");
				i==0;
				}
			//alert(i);
			
			
			 
		});
		
 
		
	 
});
</script>
</head>
<body>
<div class="header">
  <div class="all_w ">
    <div class="gofh"> <a href="#"><img src="images/jt_03.jpg" ></a> </div>
    <div class="ttwenz">
      <h4>确认交易</h4>
      <h5>微信安全支付</h5>
    </div>
  </div>
</div>
<div class="wenx_xx">
  <div class="mz"><?php echo $body;?></div>
  <div class="wxzf_price">￥<?php echo $order_money;?></div>
</div>
<div class="skf_xinf">
  <div class="all_w"> <span class="bt">收款方</span> <span class="fr">哈尔滨靓玖商贸有限公司</span> </div>
</div>
<a href="javascript:void(0);" class="ljzf_but all_w" onClick="callpay()">立即支付</a> 

<!--浮动层-->

<!--<div class="ftc_wzsf">
  <div class="srzfmm_box">
    <div class="qsrzfmm_bt clear_wl"> <img src="images/xx_03.jpg" class="tx close fl" > <img src="images/jftc_03.jpg" class="tx fl" ><span class="fl">请输入支付密码</span> </div>
    <div class="zfmmxx_shop">
      <div class="mz">楚街楚</div>
      <div class="wxzf_price">￥11.90</div>
    </div>
    <a href="cg.html" class="blank_yh"> <img src="images/jftc_07.jpg" class="fl"  ><span class="fl ml5">招商银行信用卡</span> <img src="images/jftc_09.jpg" class="fr"></a>
    <ul class="mm_box">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>
  <div class="numb_box">
    <div class="xiaq_tb"> <img src="images/jftc_14.jpg" height="10"> </div>
    <ul class="nub_ggg">
      <li><a href="javascript:void(0);">1</a></li>
      <li><a href="javascript:void(0);" class="zj_x">2</a></li>
      <li><a href="javascript:void(0);">3</a></li>
      <li><a href="javascript:void(0);">4</a></li>
      <li><a href="javascript:void(0);" class="zj_x">5</a></li>
      <li><a href="javascript:void(0);">6</a></li>
      <li><a href="javascript:void(0);">7</a></li>
      <li><a href="javascript:void(0);" class="zj_x">8</a></li>
      <li><a href="javascript:void(0);">9</a></li>
      <li><span></span></li>
      <li><a href="javascript:void(0);" class="zj_x">0</a></li>
      <li><span  class="del" > <img src="images/jftc_18.jpg"   ></span></li>
    </ul>
  </div>
  <div class="hbbj"></div>
</div>-->


<script type="text/javascript" src="./js/jquery.js"></script>
        <script type="text/javascript">

                //调用微信JS api 支付
                function jsApiCall() {
                    WeixinJSBridge.invoke('getBrandWCPayRequest',<?php echo $jsApiParameters; ?>, function(res) {
                        var msg = res.err_msg;

                        if (msg == "get_brand_wcpay_request:ok") {
                            alert("恭喜，付款成功！请及时联系客服为您发货！");
                            location.href = "<?php echo $dir; ?>/order_detail.php?order_no=<?php echo $order_no;?>";
                        } else {
                            if (msg == "get_brand_wcpay_request:cancel") {
                                var err_msg = "您取消了微信支付";
                            } else if (res.err_code == 3) {
                                var err_msg = "您正在进行跨号支付<br/>正在为您转入扫码支付......";
                            } else if (msg == "get_brand_wcpay_request:fail") {
                                var err_msg = "微信支付失败<br/>错误信息：" + res.err_desc;
                            } else {
                                var err_msg = msg + "<br/>" + res.err_desc;
                            }
                            show_notice(err_msg);
                        }

                    }
                    );
                }

                function callpay() {
                    if (typeof WeixinJSBridge == "undefined") {
                        if (document.addEventListener) {
                            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                        } else if (document.attachEvent) {
                            document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                        }
                    } else {
                        jsApiCall();
                    }
                }
                window.onload = function() {
                    if (typeof WeixinJSBridge == "undefined") {
                        if (document.addEventListener) {
                            document.addEventListener('WeixinJSBridgeReady', '', false);
                        } else if (document.attachEvent) {
                            document.attachEvent('WeixinJSBridgeReady', '');
                            document.attachEvent('onWeixinJSBridgeReady', '');
                        }
                    } else {
                    }
                }
                function show_notice(content) {
                    $("#motify").show();
                    $("#motify_content").html(content);
                    setTimeout(function() {
                        $('#motify').hide();
                    }, 3000);
                }
        </script>
</body>
</html>