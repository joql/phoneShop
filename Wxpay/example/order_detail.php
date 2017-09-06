<?php
include_once('connect.php');
$order_no = isset($_GET['order_no']) ? $_GET['order_no'] : "";
if ($order_no) {
    $query = mysql_query("SELECT * FROM `order` WHERE order_no = '" . $order_no . "' AND state = 1 LIMIT 1");
    $row = mysql_fetch_array($query);
}
?>
<!--订单详情页：
<p>订单号：<?php echo $row['order_no'] ?></p>
<p>流水号：<?php echo $row['trade_no'] ?></p>
<p>支付时间：<?php echo date("Y-m-d H:i:s", $row['update_time']) ?>-->
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
   <span style="position:relative; left:-20px;"> <img src="./images/bdok.gif" width="60%" /></span>
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