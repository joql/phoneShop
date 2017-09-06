<?php error_reporting(E_ALL & ~E_NOTICE);
include_once('connect.php');
//微信扫码支付
//$order_no = date("YmdHis") . rand(1000, 9999); //支付订单号
$order_no =$_GET['order_no'];
//$order_money = 0.01; //订单金额 元
$order_money = $_GET['price']; //订单金额 
//echo "订单支付金额：".$order_money;
/*$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
$url_notify = $url . "notify.php"; //微信回调地址*/

$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$dir = dirname($url);
$url_notify = $dir . "/notify.php";

//添加订单
//$query = mysql_query("INSERT INTO `order` (`order_no`,`order_money`,`pay_type`,`addtime`,sjh) VALUES ('" . $order_no . "', '" . $order_money . "','weixin', '" . time() . "','".$_GET['sj']."');");



include_once "weixinpay/lib/WxPay.Api.php";
include_once "weixinpay/example/WxPay.NativePay.php";

$NativePay = new NativePay();
$title = "微信支付购买手机靓号：".$_GET['sj'];

$input = new WxPayUnifiedOrder();
$input->SetBody($title);   //商品描述
$input->SetAttach(""); //附加数据
$input->SetOut_trade_no($order_no);
$input->SetTotal_fee($order_money *100); // 总金额
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag(""); //商品标记，代金券或立减优惠功能的参数，说明详见
$input->SetNotify_url($url_notify);
$input->SetTrade_type("NATIVE");//交易类型 我注：原生的扫码
$input->SetProduct_id($order_no); //商品ID 或订单编号
$result = $NativePay->GetPayUrl($input);


$code_url = urlencode($result["code_url"]);
?>

<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="keywords" content="">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>微信扫码支付</title>
   
<script src="js/jquery.js" type="text/javascript"></script>
<script>
    changeOrderStatues();//检测订单是否支付成功
    function changeOrderStatues() { 
        var order_no = $("#order_no").val();

        $.post("check_order.php", {order_no: order_no}, function(data) {
            if (data > 0) {
                //订单返回值大于0表示支付成功
                alert("恭喜，付款成功！请及时联系客服为您发货！");
                location.href = "order_detail.php?order_no=" + order_no + ""; //支付成功后跳转到订单详情页
            }
        })
        setTimeout("changeOrderStatues()", 3000);
    }
</script>

<style>

.iconfont {
    font-family:"rei";
    font-style: normal;
    font-weight: normal;
    cursor: default;
    -webkit-font-smoothing: antialiased;
}
</style>
<link charset="utf-8" rel="stylesheet" href="./index_files/front-old.css" media="all">
<link charset="utf-8" rel="stylesheet" href="./index_files/alice.components.security-core-2.1-src.css" media="all">

<style>

</style>
<style>
    #header {
        height: 60px;
        background-color: #fff;
        border-bottom: 1px solid #d9d9d9;
        margin-top: 0px;
    }
    #header .header-title {
        width: 250px;
        height: 60px;
        float: left;
    }
    #header .logo {
        float: left;
        height: 31px;
        width: 95px;
        margin-top: 14px;
        text-indent: -9999px;
        background: none; !important
    }
    #header .logo-title {
        font-size: 16px;
        font-weight: normal;
        font-family: "Microsoft YaHei",微软雅黑,"宋体";
        border-left: 1px solid #676d70;
        color: #676d70;
        height: 20px;
        float: left;
        margin-top: 15px;
        margin-left: 10px;
        padding-top: 10px;
        padding-left: 10px;
    }
    .header-container {
        width: 950px;
        margin: 0 auto;
    }

    body,
    #footer{
        background-color: #eff0f1;
    }

    #footer #ServerNum {
        color: #eff0f1;
    }
    .login-switchable-container {
        background-color: #fff;
    }

    #order.order-bow .orderDetail-base,
    #order.order-bow .ui-detail {
        border-bottom: 3px solid #bbb;
        background: #eff0f1;
        color: #000;
    }

    .order-ext-trigger {
        position: absolute;
        right: 20px;
        bottom: 0;
        height: 22px;
        padding: 2px 8px 1px;
        font-weight: 700;
        border-top: 0;
        background: #b3b3b3;
        z-index: 100;
        color: #fff;
    }

    #partner {
        margin-top: 0;
        padding-top: 0;
        background-color: #eff0f1;
    }

    #order.order-bow .orderDetail-base, #order.order-bow .ui-detail {
        border-bottom: 3px solid #b3b3b3;
    }

    .payAmount-area {
        bottom: 36px;
    }

    .alipay-logo {
        display: block;
        width: 148px;
        position: relative;
        left: 0;
        top: 10px;
        float: left;
        height: 40px;
        background-position: 0 0;
        background-repeat: no-repeat;
        background-image: url(./images/wx.png);
    }
</style>
<link charset="utf-8" rel="stylesheet" href="./index_files/OgPAgbONDiKhITIVYmdn.css"></head>
<body style="min-width: 990px;">



<!-- CMS:全站公共 cms/notice/headNotice.vm结束:alipay/notice/headNotice.vm --><div class="topbar">
    <div class="topbar-wrap fn-clear">
        
        		<span class="topbar-link-first">你好，欢迎使用微信扫码付款！</span>
		    </div>
</div>

<div id="header">
    <div class="header-container fn-clear">
        <div class="header-title">
            <div class="alipay-logo"></div>
            <span class="logo-title">我的收银台</span>
        </div>
    </div>
</div>
<div id="container">



<style>

.ui-securitycore .ui-label, .mi-label {
    text-align: left;
    height: auto;
    line-height: 18px;
    padding: 0;
    display: block;
    padding-bottom: 8px;
    margin: 0;
    width: auto;
    float: none;
    font:14px/1.5 tahoma,arial,\5b8b\4f53;
}

.ui-securitycore .ui-form-item {
    position: relative;
    padding: 0 0 10px 0;
    width: 350px;

}

.ui-securitycore .ui-form-explain {
    height: 18px;
    /*display: block;*/
    font-family:tahoma,arial,\5b8b\4f53;
}

.ui-securitycore .edit-link {
    position: absolute;
    top: -3px;
    right: 0;
}

.ui-securitycore .ui-input {
    height: 28px;
    font-size: 14px;
}

.ui-securitycore .standardPwdContainer .ui-input {
    width: 340px;
}

.ui-securitycore .mobile-section.checkcode-section {
    margin-top: 10px;
}

/*安全服务化必将覆盖的样式*/
.mobile-form .ui-securitycore .ui-form-item-mobile {
    display: none;
}

.mobile-form .ui-securitycore .ui-form-item-mobile .ui-label {

}

.mobile-form .ui-securitycore .ui-form-item-mobile .ui-form-text {
    display: none;
}

.mobile-form .ui-securitycore .ui-form-item-counter {
    padding-left: 0;
    padding-right: 0;
    padding-bottom: 20px;
    position: relative;
    height: 87px;
}

.mobile-form .ui-securitycore .ui-form-item-counter .ui-label {
    display: block;
    float: none;
    margin-left: 0;
    text-align: left;
    line-height: 18px !important;
    padding: 0 0 8px 0;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-form-field {
    /*display: block;*/
    zoom: 1;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-form-field:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-checkcode-input {
    height: 24px;
    line-height: 24px;
    width: 148px;
    border: 1px solid #ccc;
    padding: 7px 10px;
    float: left;
    display: block;
    font-size: 14px;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-checkcode-input:focus {
    color: #4d4d4d;
    border-color: #07f;
    outline: 1px solid #8cddff;
}
.mobile-form .ui-securitycore .ui-form-item-counter .eSend-btn {
    float: left;
    color: #08c;
}

#mobileSend {
    position: absolute;
    right: 0;
    top: 26px;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-checkcode-messagecode-btn {
    float: left;
    width: 178px;
    height: 40px;
    _height: 38px;
    line-height: 38px;
    _line-height: 35px;
    color: #676d70;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 1px;
    background: #f3f3f3;
    margin-left: 2px;
    padding-left: 0;
    padding-right: 0;

}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-checkcode-messagecode-disabled-btn {
    background: #cacccd;
    border: 1px solid #cacccd;
    color: #aeb1b3;
    font-weight: normal;
    cursor: default;
}

.mobile-form .ui-securitycore .ui-form-item-counter .reSend-btn {
    float: left;
    margin-top: 10px;
    color: #08c;
}

.ui-checkcode-messagecode-disabled-btn {

}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-form-field {
    display: block;
}
.mobile-form .ui-securitycore .ui-form-item-counter .ui-form-field .fn-hide,
.mobile-form .ui-securitycore .ui-form-item-counter .fn-hide .reSend-btn {
    display: none;
}

/*安全服务化必将覆盖的样式*/


.alieditContainer object {
    width: 348px;
    height:38px;
}

#container .alieditContainer {
    width: 348px;
    height: 38px;
}

#container .alieditContainer a.aliedit-install {
    line-height: 38px;
}

/* 安全服务化去控件升级 特木 temu.psc@alipay.com */
#container .alieditContainer .ui-input {
    width:324px;
    padding:7px 10px;
    font-size:14px;
    height: 20px;
    line-height: 24px;
}

#container .alieditContainer .ui-input:focus {
    color:#4D4D4D;
    border-color:#07F;
    outline:1px solid #8CDDFF;
    *padding:7px 3px 4px;
    *border:2px solid #07F;
}


.teBox {
    height: auto;
}

#J_loginPwdMemberT {
    padding: 20px 0 60px 0;
}

#J_loginPwdMemberT #teLogin {
    height: auto;
}

#J_loginPwdMemberT .mi-form-item{
    padding: 0 0 10px 0;
}

#J_loginPwdMemberT .teBox-in {
    padding: 0;
    width: 350px;
    margin: 0 auto;
}

.t-contract-container {
    width: 76%;
}

.contract-container {
    width: 450px;
    margin: 0 auto;
    text-align: left;
    position: relative;
}
.contract-container .contract-container-label {
    width: 450px;
}

.mb-text {
    font-size: 14px;
    padding-top: 10px;
}

.ml5 {
    margin-left: 5px;
}

.user-login-account {
    font-size: 16px;
}

.mi-mobile-button {
    font-weight: bold;
}

.alipay-agreement-link {
    margin-left: 5px;
    color: #999;
}

.alipay-agreement {
    width: 600px;
    height: 270px;
    padding: 10px;
    text-align: center;
}

.alipay-agreement-content {
    height: 230px;
    width: 600px;
    margin-bottom: 5px;
}

#container .order-timeout-notice {
    margin-top: 30px;
    display: none;
}

.login-panel .fn-mb8{
    margin-bottom: 8px;
}

.login-panel .fn-mt8{
    margin-top: 8px;
}

/* 新版扫码页面样式 */


.order-area {
    position: relative;
    z-index: 10;
}

.cashier-center-container {
    overflow: hidden;
    position: relative;
    z-index: 1;
    width: 950px;
    min-height: 460px;
    background-color: #fff;

    border-bottom: 3px solid #b3b3b3;
}

.cashiser-switch-wrapper {
    width: 1800px;
}

.cashier-center-view {
    position: relative;
    width: 803px;
}

.cashier-center-view.view-pc {
    display: block;
}

.cashier-center-view.view-pc .loginBox {
    padding: 60px 0 20px 238px;
    width: 350px;
    margin: 0;
}

.loginBox .login-title-area {
    margin: 0;
    margin-bottom: 30px;
}

.login-title .rt-text {
    font-size: 14px;
}

.teForm {
    padding: 0;
}

.mi-form-item {
    padding: 0 0 12px 0;
}

.submitContainer {
    margin-top: 6px;
}

/* 切换按钮 */
.view-switch {
    width: 146px;
    height: 400px;
    padding-top: 126px;
    background-color: #e6e6e6;
    cursor: pointer;

    /* 禁止选中 */
    -webkit-user-select: none; 
    -khtml-user-select: none; 
    -moz-user-select: none; 
    user-select: none;
}

.view-switch.qrcode-show {
    border-left: 1px solid #d9d9d9;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.view-switch.qrcode-hide {
    border-right: 1px solid #d9d9d9;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}

.switch-tip {
    text-align: center;
}

.switch-tip-font {
    font-size: 16px;
    font-family: tahoma, arial, '\5FAE\8F6F\96C5\9ED1', '\5B8B\4F53';
}

.switch-tip-icon {
    position: relative;
    z-index: 10;
    display: block;
    margin-top: 4px;
    font-size: 78px;
    color: #a6a6a6;
    cursor: pointer;
}

.switch-tip-btn {
    display: block;
    width: 106px;
    height: 36px;
    margin: 6px auto 0;
    border: 1px solid #0fa4db;
    background-color: #00aeef;
    border-radius: 5px;

    font-size: 12px;
    font-weight: 400;
    line-height: 36px;
    text-align: center;
    color: #fff;
    text-decoration: none;
}

.switch-tip-btn:hover {
    color: #fff;
    text-decoration: none;
}

.view-switch.qrcode-hide .view-switch-content {
    height: 334px;
    padding-top: 126px;
}

.switch-pc-tip .switch-tip-icon {
    position: relative;
    z-index: 10;
    margin-top: 4px;
    font-size: 78px;
}

.switch-tip-icon-wrapper {
    position: relative;
}

.switch-tip-icon-wrapper:before {
    content: '';
    position: absolute;
    left: 47px;
    top: 24px;
    z-index: 0;
    width: 50px;
    height: 70px;
    background-color: #fff;
}

.switch-qrcode-tip .switch-tip-icon-wrapper:before {
    left: 38px;
    top: 25px;
    width: 70px;
    height: 47px;
}

.switch-tip-icon-img {
    position: absolute;
    left: 58px;
    top: 35px;
    z-index: 11;
}

.switch-qrcode-tip .switch-tip-icon-img {
    left: 48px;
    top: 39px;
}

.standardPwdContainer object {
    width: 348px;
    height:38px;
}

#container .standardPwdContainer {
    width: 348px;
    height: 38px;
}

#container .standardPwdContainer a.aliedit-install {
    line-height: 38px;
}

#container .standardPwdContainer .ui-input {
    width:324px;
    padding:7px 10px;
    font-size:14px;
    height: 20px;
    line-height: 24px;
}

#container .standardPwdContainer .ui-input:focus {
    color:#4D4D4D;
    border-color:#07F;
    outline:1px solid #8CDDFF;
    *padding:7px 3px 4px;
    *border:2px solid #07F;
}</style>

<div class="mi-notice mi-notice-success mi-notice-titleonly order-timeout-notice" id="J_orderPaySuccessNotice">
    <div class="mi-notice-cnt">
        
    </div>
</div>

<div class="mi-notice mi-notice-error mi-notice-titleonly order-timeout-notice" id="J_orderDeadlineNotice">
    <div class="mi-notice-cnt">
        <div class="mi-notice-title">
            
      </div>
    </div>
</div>

<!-- CMS:全站公共 cms/tracker/um.vm开始:tracker/um.vm -->



<style type="text/css">
.umidWrapper{display:block; height:1px;}
</style>
<span style="display:inline;width:1px;height:1px;overflow:hidden">


</span>
<!-- CMS:全站公共 cms/tracker/um.vm结束:tracker/um.vm -->

<!-- 页面主体 -->
<div id="content" class="fn-clear">
        
<div id="J_order" class="order-area" data-module="excashier/login/2015.08.01/orderDetail">


        
        
                
        <div id="order" data-role="order" class="order order-bow">
                        <div class="orderDetail-base" data-role="J_orderDetailBase">
                <div class="order-extand-explain fn-clear">
            <span class="fn-left explain-trigger-area order-type-navigator" style="cursor: auto" data-role="J_orderTypeQuestion">

            <span>正在使用微信扫码交易</span>
    
    <span data-role="J_questionIcon" seed="order-type-detail" style="cursor: pointer;color: #08c;">[?]</span>
            </span>
                                    </div>
                <div class="commodity-message-row">
            <span class="first long-content">
                <?php echo $title = "微信支付购买手机靓号：".$_GET['sj'];?>
            </span>
                                            <span class="second short-content">
                                                                    收款方：哈尔滨靓玖商贸有限公司
                            </span>
                                    </div>
                                                <span class="payAmount-area" id="J_basePriceArea">
                                                     <strong class=" amount-font-22 "><?php echo $order_money;?></strong> 元
                
        </span>
            </div>
            
<div class="ui-tip ui-question-tip fn-hide" seed="question-tip" data-role="J_orderTypeTip">
    
    <div class="ui-icon-dialog-arrow">
        ↓
    </div>
</div>


<div class="ui-tip ui-question-tip fn-hide" data-role="J_exchangeTip">
    
    <div class="ui-icon-dialog-arrow">
        ↓
    </div>
</div>

            
            <a id="J_OrderExtTrigger" class="order-ext-trigger" href="javascript:;" seed="order-detail-more" data-role="J_oderDetailMore">
                订单详情
            </a>
            

                <div class="ui-detail fn-hide" data-role="J_orderDetailCnt" id="J-orderDetail">
                    <div class="ajax-Account od-more-cnt fn-clear">
                        <div class="first  long-content">支付宝购买手机靓号 13244583721</div>
                        <ul class="order-detail-container">
                            <li class="order-item">
                                                                                                             <table>
    <tbody>
                <tr>
            <th class="sub-th">收款方：</th>
            <td>
                                    哈尔滨靓玖商贸有限公司
                                            </td>
        </tr>
                        <tr>
            <th class="sub-th">订单号：</th>
            <td>201</td>
        </tr>
                        <tr>
            <th class="sub-th">商品名称：</th>
            <td>
                                    购买手机靓号 
                            </td>
        </tr>
                                <tr>
            <th class="sub-th">交易金额：</th>
            <td>0.01</td>
        </tr>
                            </tbody>
</table>

                                                                    
                            </li>
                        </ul>
                    </div>
        <span class="payAmount-area payAmount-area-expand">
                <strong class=" amount-font-22 ">0.01</strong> 元
        </span>
                    <iframe src="javascript:''" class="ui-detail-iframe-fix" data-role="J_orderDetailFrameFix"></iframe>
                </div>

            <a id="J_OrderExtTrigger" class="order-ext-trigger fn-hide" href="#" seed="order-detail-more" data-role="J_oderDetailShrink">
                订单详情
            </a>
		        </div>
        

</div>




    <!-- 操作区 -->
    <div class="cashier-center-container">
        
        <div data-module="excashier/login/2016.08.01/loginPwdMemberT" id="J_loginPwdMemberTModule" class="cashiser-switch-wrapper fn-clear">

            <!-- 扫码支付页面 -->
            <div class="cashier-center-view view-qrcode fn-left" id="J_view_qr">
                                
<style type="text/css">
.qrcode-area {
    margin: 0 auto;
    position: relative;
}

/* 扫码头部信息 */
.qrcode-integration .qrcode-header {
    display: block;
    width: auto;
    margin: 0;
    padding: 0;
    margin-top: 75px;
    margin-bottom: 16px;
}

.qrcode-header-money {
    font-size: 26px;
    font-weight: 700;
    color: #f60;
}

.qrcode-integration .qrcode-img-area {
    width: 168px;
    height: 168px;
    text-align: center;
}

.qrcode-img-area.qrcode-img-crash {
    height: 220px;
}

.qrcode-reward-wrapper {
    text-align: center;
}

.qrcode-reward {
    display: inline-block;
    margin: 0;
    padding: 2px 5px;
    background-color: #0188cd;
    border-radius: 0;

    font-size: 12px;
    line-height: 16px;
    color: #fff;
}

.qrcode-reward-question {
    font-size: 12px;
    margin-left: 5px;
    margin-right: 0;
}

.qrcode-integration .qrcode-loading {
    top: 70px;
    left: 60px;
}

.qrcode-integration .qrcode-img {
    top: 70px;
    left: 70px;
}

.qrcode-integration .qrcode-img-wrapper {
    position: relative;
    width: 168px;
    height: auto;
    min-height: 168px;
    margin: 0 auto;
    padding: 6px;

    border: 1px solid #d3d3d3;
    -webkit-box-shadow: 1px 1px 1px #ccc;
    box-shadow: 1px 1px 1px #ccc;
}

.qrcode-img-area .qrcode-busy-icon {
    padding-top: 15px;
}

.qrcode-img-area .qrcode-busy-text {
    margin-top: 20px;
}

a.mi-button-lwhite .mi-button-text {
    padding: 8px 39px 4px 36px;
}

.qrcode-img-area .mi-button {
    margin-top: 40px;
}

/* 扫码图片下方提示 */
.qrcode-img-explain {
    padding: 10px 0 6px;
}

.qrcode-img-explain img {
    margin-left: 20px;
    margin-top: 5px;
}

.qrcode-img-explain div {
    margin-left: 10px;
}




.qrcode-foot {
    text-align: center;
}

.qrcode-downloadApp,
.qrcode-downloadApp:hover,
.qrcode-downloadApp:active,
.qrcode-explain a.qrcode-downloadApp:hover {
    font-size: 12px;
    color: #a6a6a6;
    text-decoration: underline;
}



.qrguide-area {
    position: absolute;
    top: 62px;
    left: 505px;
    width: 204px;
    height: 183px;
    cursor: pointer;
}

.qrguide-area .qrguide-area-img {
    display: block;
    position: absolute;
    bottom: 0;
    left: 0;
    z-index: -1;
}

.qrguide-area .qrguide-area-img.active {
     z-index: 10;
}

.qrguide-area .qrguide-area-img.background {
     z-index: 9;
}

.qrcode-notice .qrcode-notice-title {
    padding: 10px 10px 11px 63px;
}</style>
<!-- 扫码区域 -->


<div data-role="qrPayArea" class="qrcode-integration qrcode-area" id="J_qrPayArea">
        <div class="qrcode-header">
        <div class="ft-center">扫一扫付款（元）</div>
        <div class="ft-center qrcode-header-money"><?php echo $order_money;?></div>
    </div>

	    	
        <div data-role="qrPayCrash" class="qrcode-img-area qrcode-img-crash fn-hide">
        <div class="qrcode-busy-icon">
            <i class="iconfont qrpay-crash-icon">&#61511;</i>
        </div>
        
        
    </div>

        <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
        <div data-role="qrPayImg" class="qrcode-img-area">
            
        <div style="position: relative;display: inline-block;"><img alt="微信扫码支付" src="weixinpay/example/qrcode.php?data=<?php echo $code_url; ?>" width="150px" height="150px" /></div></div>
           <input type="hidden" value="<?php echo $order_no; ?>" id="order_no"/>
        <div class="qrcode-img-explain fn-clear">
            <img class="fn-left" src="./index_files/T1bdtfXfdiXXXXXXXX.png" alt="扫一扫标识" seed="qrcodeImgExplain-tImagesT1bdtfXfdiXXXXXXXX" smartracker="on">
            <div class="fn-left">打开您手机微信<br>扫一扫继续付款</div>
        </div>
    </div>

        <div class="qrcode-foot" data-role="qrPayFoot" style="display: block;">
        

        <div data-role="qrPayScanSuccess" class="mi-notice mi-notice-success mi-notice-titleonly qrcode-notice fn-hide">
            <div class="mi-notice-cnt">
                <div class="mi-notice-title qrcode-notice-title">
                    <i class="iconfont qrcode-notice-iconfont" title="扫描成功">&#61513;</i>
                    <p class="mi-notice-explain-other qrcode-notice-explain ft-break">
                        <span class="ft-orange fn-mr5" data-role="qrPayAccount"></span>已创建订单，请在手机支付宝上完成付款
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- 优惠 TIP -->
    <div class="ft-center fn-hide" data-role="pr-container">
        <div class="qrcode-discount-privilege">
            <ul class="discount-list">
                <li class="discount-item">
                    <span class="action-rt">
                        <span class="action-rt-type">惠</span>
                        <span class="rt-discount" data-role="pr-name"></span>
                    </span>
                    | <em data-role="pr-explain">使用扫码支付可享受优惠</em>
                </li>
                <li class="discount-desc" data-role="pr-desc"></li>
            </ul>
        </div>
    </div>

</div>

<style>
    .ad-wrap {
        width: 260px;
    }

    .ad-title {
        background-color: #f5f5f5;
        padding: 10px;
        line-height: 12px;
        font-size: 12px;
        color: #1a1a1a;
        font-family: Heiti SC;
        text-align: left;
        font-weight: 700;
    }

    .ad-cnt {
        padding: 10px;
        font-size:12px;
        color:#1a1a1a;
        font-family:Heiti SC;
    }

    .arale-tip-1_2_2 .ui-poptip-white .ui-poptip-container {
        padding: 0;
    }

    .arale-tip-1_2_2 .ui-poptip-white .ui-poptip-arrow-2 span,
    .arale-tip-1_2_2 .ui-poptip-white .ui-poptip-arrow-3 span {
        border-left-color: #f5f5f5;
    }
</style>

<!-- 指引区域 -->
<div class="qrguide-area" id="J_qrguideArea" seed="NewQr_animationClick"><img src="./index_files/T1ASFgXdtnXXXXXXXX.png" class="qrguide-area-img active" seed="J_qrguideArea-qrguideAreaImgT1" smartracker="on" style="display: block;">
</div>
	

            </div>

                        
<!-- 点击切换区域 -->
<div class="view-switch qrcode-show fn-left" id="J_viewSwitcher" unselectable="on" onselectstart="return false;" seed="NewQr_viewSwitch" style="padding-right: 10px; margin-left: -10px;">
  <div class="switch-tip switch-pc-tip fn-hide" id="J_tip_pc">
    <div class="switch-tip-font">试试手机支付宝</div>
        <div class="switch-tip-icon-wrapper">
            <i class="switch-tip-icon iconfont" title="手机">&#61491;</i>
            <img class="switch-tip-icon-img" src="./index_files/T1Z5XfXdxmXXXXXXXX.png" alt="手机支付宝图标" width="30" height="30" seed="switchTipIconWrapper-switchTipIconImgT1" smartracker="on">
        </div>
        <a class="switch-tip-btn" href="javascript:void(0)" seed="J_tip_pc-switchTipBtn" smartracker="on">扫一扫付款&nbsp;&gt;</a>
  </div>
</div>
            <!-- PC 付款登录页面 -->
            <div class="cashier-center-view view-pc fn-left" id="J_view_pc">
            
            </div>

        </div>
    </div>
    <!-- 操作区 结束 -->

</div>
<!-- 页面主体 结束 -->

 
    
  
</body></html>