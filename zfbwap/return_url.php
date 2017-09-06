<?php include_once('connect.php');
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
?><?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号

	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号

	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];


    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
   /* echo "商户订单号".$out_trade_no."<br>";
	echo "支付宝交易号".$trade_no."<br>";
	echo "支付状态".$trade_status;*/
	
	if ($out_trade_no) {//若是支付成功 ，订单状态state=1表示已支付成功
    $query = mysql_query("select* from `order`  WHERE `order_no` ='" .$out_trade_no. "'");
    $row=mysql_fetch_array($query);
/*echo "数据库订单数据如下：<br>";
echo "商户订单号".$row['order_no']."<br>";
	echo "支付宝交易号".$row['trade_no']."<br>";
	echo "付款成功进间".date("Y-m-d H:i:s",$row['update_time']);
*/

}
	
	
	}
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
		
	//echo "验证成功<br />";

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta http-equiv="Cache-Control" content="no-cache"/>

<title>CLPHPORDER2017</title>
<style type="text/css">

    *{margin:0;padding:0;}
    body{font:14px Microsoft YaHei,\5FAE\8F6F\96C5\9ED1,SimSun,\5B8B\4F53,Arial,Verdana;color:#000;text-align:left;padding-top:60px;background:#FFF;} 
    a:link,a:visited{color:#F00;text-decoration:none;}a:hover{color:#090;text-decoration:underline;}
    ul,li{list-style:none;display:block;}
    img{border:0 none;vertical-align:middle;}
    #head{width:100%;padding:0 0 30px;text-align:center;border-bottom:2px dotted #DDD;}
    #bdok{
	width: 100%;
	background: #FFF;
	height: auto;
}
    #bdok ul{
	width: 100%;
	height: auto;
	margin: 20px auto;
}    
    #bdok li{
	width: 90%;
	height: 30px;
	line-height: 30px;
	border-bottom: 1px dotted #DDD;
}    
    #bdok li span.l{float:left;width:30%;text-align:right;margin-right:20px;}    
    #bdok li span.r{float:left;width:60%;color:#BD0000;} 
    #foot{
	width: 100%;
	padding-top: 90px;
	padding-right: 0;
	padding-left: 0;
	padding-bottom: 0;
	text-align: center;
	border-top: 2px dotted #DDD;
}
    #foot p.go{font:12px SimSun,\5B8B\4F53,Arial,Verdana;color:#090;margin-bottom:20px;}
    #time{font:14px Arial,Verdana;color:#F90;font-weight:bold;}
</style>
<script type="text/javascript">
setInterval("settime()",1000);
    var i=60;
    function settime() {
       i--;
       time.innerHTML=i;
       if(i<=0) {
           //window.history.go(-1);
		   location.href='http://www.hrblh.com';
       }
    }
</script>
</head>
<body><div>
<div id="head">
   <span style="position:relative; left:-20px;"> <img src="./images/bdok.gif" width="100%" /></span>
</div>
<div id="bdok">
    <ul>
        <li>
            <span class="l">订单号：</span>
          <span class="r"><?php echo $row['order_no'] ?></span>
        </li>
        <li>
            <span class="l">购买号码：</span>
            <span class="r"><?php echo $row['sjh'] ?></span>
        </li>
        
        
         <!--<?php if(!empty($_GET['bdproxh'])){echo "
        <li>
            <span class='l'>产品型号：</span>
            <span class='r'>".$_GET['bdproxh']."</span>
        </li>";}?>-->
        
        <li>
            <span class="l">收货人姓名：</span>
            <span class="r"><?php echo $row['name'] ?></span>
        </li>
        <li>
            <span class="l">手机号码：</span>
            <span class="r"><?php echo $row['lxtel'] ?></span>
        </li> 
		  
       <!-- <?php if(!empty($_GET['bdprovince'])){echo "
        <li>
            <span class='l'>所在地区：</span>
            <span class='r'>".$_GET['bdprovince'].$_GET['bdcity'].$_GET['bdarea']."</span>
        </li>";}?>-->
        <li>
            <span class="l">详细地址：</span>
            <span class="r"><?php echo $row['address'] ?></span>
        </li>
        <li>
            <span class="l">付款方式：</span>
            <span class="r"><?php if($row['pay_type']=='zfb'){echo '<img src="./images/fkb.gif" />';}else{echo '<img src="./images/fkd.gif" />';} ?></span>
        </li>
        
         <li>
            <span class="l">付款时间：</span>
            <span class="r"><?php echo date("Y-m-d H:i:s", $row['update_time']) ?></span>
        </li>
    </ul>
</div>
<div id="foot">
    <p class="go">温馨提示：本页面将在 <span id="time">60</span> 秒后自动返回，或者您也可以点击下面的返回图标立即返回。</p>
  <!--  <p><a href='Javascript:window.history.go(-3)' title="返回"><img src="./images/bdgo.gif" alt="返回" width="60%" /></a></p>-->
    <p><a href='/' title="返回"><img src="./images/bdgo.gif" alt="返回" width="60%" /></a></p>
</div>
<!-------------------------- 此处添加统计转化代码 -------------------------->

<!-------------------------- 此处添加统计转化代码 -------------------------->
</div></body>
</html>