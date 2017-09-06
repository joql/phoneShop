<?php require_once('Connections/connch21.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php 

//echo $_SERVER['QUERY_STRING'];//geg方式用，考虑get最大256个字节，还是用post方式传过到这个页面值 
echo $sjh=$_POST['sjh'];
echo "<br>";
echo $zffs=$_POST['zffs'];
echo "<br>";
echo $money=$_POST['money'];
echo "<br>";
echo $name=$_POST['name'];
echo "<br>";

echo $lxtel=$_POST['lxtel'];
echo "<br>";
echo $address=$_POST['address'];
echo "<br>";
echo $message=$_POST['message'];
echo "<br>";

$order_no = date("YmdHis") . rand(1000, 9999); //支付订单号
mysql_select_db($database_connch21, $connch21);
//添加订单
//$query = mysql_query("INSERT INTO `order` (`order_no`,`order_money`,`pay_type`,`addtime`,sjh) VALUES ('".$order_no."', '" .$money. "','weixin', '" . time() . "','".$_GET['sj']."');")or die(mysql_error());

//添加订单

//mysql_select_db($database_connch21, $connch21);
$query = mysql_query("INSERT INTO `order` (name,lxtel,address,message,order_no,order_money,pay_type,addtime,sjh) VALUES ('$name','$lxtel','$address','$message','" . $order_no . "', '" .$money. "','$zffs', '" . time() . "','$sjh')")or die(mysql_error());

//$query=mysql_query("INSERT INTO `order`( name, `lxtel`, `address`, `message`, `order_no`, `trade_no`, `order_money`, `unit_name`, `pay_type`, `state`, `addtime`, `update_time`, `sjh`) VALUES ('2','3','4','5','6','7','8','9','10','11','12','13','14')")or die("失败");
/*$sql="INSERT INTO 'order' (name)values('1')";
$query = mysql_query($sql)or die(mysql_error());*/
if($query==true&&$zffs=='wx'){
	

?>
微付支付
<script type="text/javascript">
function is_weixn(){  //这个是个函数，得调用才能执行；
    var ua = navigator.userAgent.toLowerCase();  
    //if(!(ua.match(/MicroMessenger/i)=="micromessenger")) {  
	 if(ua.match(/MicroMessenger/i)=="micromessenger") {  
        //return true;  //无用
		//document.write("true");此句调试用 微信内及公众号内打开跳转
		location.href='http://www.hrblh.com/Wxpay/example/jsapi02.php?sj=<?php echo $sjh; ?>&price=<?php echo $money; ?>&order_no=<?php echo $order_no;?>';
    } else {  
       //return false; //无用
		//document.write("false"); 此句调式用 非微信打开跳转
		location.href='http://www.hrblh.com/waxin/index.php?sj=<?php echo $sjh; ?>&price=<?php echo $money; ?>&order_no=<?php echo $order_no;?>';
    }  
}  
is_weixn();
</script>

<?php }else if($query==true&&$zffs=='zfb'){?>

<script type="text/javascript">
function is_mobile() {   
 var regex_match = /(nokia|iphone|android|motorola|^mot-|softbank|foma|docomo|kddi|up.browser|up.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte-|longcos|pantech|gionee|^sie-|portalmmm|jigs browser|hiptop|^benq|haier|^lct|operas*mobi|opera*mini|320x320|240x320|176x220)/i; 
  var u = navigator.userAgent;  
 if (null == u) {   return true;  } 
 var result = regex_match.exec(u);  
 if (null == result) {   return false  } else {   return true  } } 

if (!is_mobile()) {  location.href='http://www.hrblh.com/zfbweb/alipayapi.php?sj=<?php echo $sjh; ?>&price=<?php echo $money; ?>&order_no=<?php echo $order_no;?>'; }
else{
	
	location.href='http://www.hrblh.com/zfbwap/alipayapi.php?sj=<?php echo $sjh; ?>&price=<?php echo $money; ?>&order_no=<?php echo $order_no;?>';
}
</script>

<?php }?>
</body>
</html>