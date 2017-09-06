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
?>
<!DOCTYPE html>
<html>
	<head>
	<title>微信支付</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
    *{
        margin:0;
        padding:0;
    }
    ul,ol{
        list-style:none;
    }
    body{
        font-family: "Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;
    }
    .hidden{
        display:none;
    }
    .new-btn-login-sp{
        padding: 1px;
        display: inline-block;
        width: 75%;
    }
    .new-btn-login {
        background-color: #02aaf1;
        color: #FFFFFF;
        font-weight: bold;
        border: none;
        width: 100%;
        height: 30px;
        border-radius: 5px;
        font-size: 16px;
    }
    #main{
        width:100%;
        margin:0 auto;
        font-size:14px;
    }
    .red-star{
        color:#f00;
        width:10px;
        display:inline-block;
    }
    .null-star{
        color:#fff;
    }
    .content{
        margin-top:5px;
    }
    .content dt{
        width:100px;
        display:inline-block;
        float: left;
        margin-left: 20px;
        color: #666;
        font-size: 13px;
        margin-top: 8px;
    }
    .content dd{
        margin-left:120px;
        margin-bottom:5px;
    }
    .content dd input {
        width: 85%;
        height: 28px;
        border: 0;
        -webkit-border-radius: 0;
        -webkit-appearance: none;
    }
    #foot{
        margin-top:10px;
        position: absolute;
        bottom: 15px;
        width: 100%;
    }
    .foot-ul{
        width: 100%;
    }
    .foot-ul li {
        width: 100%;
        text-align:center;
        color: #666;
    }
    .note-help {
        color: #999999;
        font-size: 12px;
        line-height: 130%;
        margin-top: 5px;
        width: 100%;
        display: block;
    }
    #btn-dd{
        margin: 20px;
        text-align: center;
		height:50px;
    }
    .foot-ul{
        width: 100%;
    }
    .one_line{
        display: block;
        height: 1px;
        border: 0;
        border-top: 1px solid #eeeeee;
        width: 100%;
        margin-left: 20px;
    }
    .am-header {
        display: -webkit-box;
        display: -ms-flexbox;
        display: box;
        width: 100%;
        position: relative;
        padding: 7px 0;
        -webkit-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
        background: #1D222D;
        height: 50px;
        text-align: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        box-pack: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        box-align: center;
    }
    .am-header h1 {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        box-flex: 1;
        line-height: 18px;
        text-align: center;
        font-size: 18px;
        font-weight: 300;
        color: #fff;
    }
</style>
</head>
<body text=#000000 bgColor="#ffffff" leftMargin=0 topMargin=4>
<header class="am-header">
        <h1>微信支付</h1>
</header>
<div id="main">
        <form name=alipayment action=''>
            <div id="body" style="clear:left">
                <dl class="content">
                    <dt>商户订单号
：</dt>
                    <dd>
                        <input name="WIDout_trade_no" id="WIDout_trade_no" value="<?php echo $order_no;?>" readonly />
                    </dd>
                    <!--<hr class="one_line">
                    <dt>订单名称
：</dt>
                    <dd>
                        <input id="WIDsubject" name="WIDsubject" />
                    </dd>-->
                    <hr class="one_line">
                    <dt>付款金额
：</dt>
                    <dd>
                        <input name="WIDtotal_fee" id="WIDtotal_fee" value="<?php echo $order_money;?>" readonly />
                    </dd>
                   <!-- <hr class="one_line">
                    <dt>商品展示网址
：</dt>
                    <dd>
                        <input id="WIDshow_url" name="WIDshow_url" />
                    </dd>-->
                    <hr class="one_line">
                    <dt>商品描述：</dt>
                    <dd>
                        <input name="WIDbody" id="WIDbody" value="<?php echo $body;?>" readonly />
                    </dd>
                    <hr class="one_line">
                    <dt></dt>
                    <dd id="btn-dd">
                        <span class="new-btn-login-sp">
                            <button class="new-btn-login" style="text-align:center;"type="button" onClick="callpay()" >立即支付</button>
                           
                        </span>
                        <span class="note-help">如果您点击“确认”按钮，即表示您同意该次的执行操作。</span>
                    </dd>
                </dl>
            </div>
		</form>
        <div id="foot">
			<ul class="foot-ul">
				<li>
					权所有 2015
				</li>
			</ul>
		</div>
	</div>
</body>
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
</html>