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
	<link href="./index_files/m.public01.css" rel="stylesheet" type="text/css">

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
	</div><!--经纪人信息-->
 
<form  id="wfform" name="wfform" action="../zfb_or_wx.php" method="post" onsubmit="return postcheck()">
<div class="haomaxx">
	<div class="haomaxx_bt pay-tips">
    	请联系经纪人号码是否已出售，再付款哦！
    </div>
    
   
	<div class="haomaxx_nr">  
        <p class="haomaxx-three"><span class="mc">订购号码：</span><span class="cs pay-num"><?php echo $row_Recordset1['sj_hao']; ?><input name="sjh" type="hidden" value="<?php echo $row_Recordset1['sj_hao']; ?>" /></span><?php  $a=$row_Recordset1['pid'];
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
					
					 ?></span></p>
        <p class="haomaxx-three"><span class="mc">付款方式一：</span><span class="cs pay-escrow">
        <span style="margin-right:5px;"><input name="zffs" type="radio" id="radio" value="zfb" checked="checked" /></span><img src="./index_files/payment.jpg" width="86" height="36">　</span></p>
       　<p class="haomaxx-three"><span class="mc">付款方式二：</span><span class="cs pay-escrow">
           <span style="margin-right:5px;"><input type="radio" name="zffs" id="radio" value="wx" /></span><img src="./images/fkd.gif" >　</span></p>
        <p class="haomaxx-three"><span class="mc">支付金额：</span><span class="cs"><input  name="money" type="text" class="pay-dj" id="money"value="<?php echo $row_Recordset1['s_price']; ?>" readonly="readonly">元</span></p>
		<div class="clear"></div>
    </div>                                                                         
    <div class="haomaxx_nr">  
    
        <p class="haomaxx-three"><span class="mc">客户姓名：</span><span class="cs pay-num"><input name="name" type="text" class="pay-bt"></span><span class="red pay-btf">（必填）</span>	</p>
        <p class="haomaxx-three"><span class="mc">联系电话：</span><span class="cs pay-escrow"><input name="lxtel" type="text" class="pay-bt"></span><span class="red  pay-btf">（必填）</span>	</p>
        <p class="haomaxx-three"><span class="mc">送货地址：</span><span class="cs"><input type="text" name="address" value=""></span></p>
      <p class="haomaxx-three"><span class="mc">建议意见：</span><span class="cs"><textarea name="message" id="remark" cols="" rows="2"></textarea></span></p>
        <input name="submit" type="submit" id="payment" value="立即支付" class="ljyd">
		<div class="clear"></div>
       
    </div> </form>
    
    <div class="pay-payment">
    	<p>您也可以采用以下付款方式：</p>
        <ul><li>工商银行户名： 哈尔滨靓玖商贸有限公司</li>
<li>对公账号：35000044109067116761</li>
<li>农业银行: 6228480176006707366 韩冰</li>
<li>建设银行: 6217001140004959745 韩冰</li>
<li>交通银行: 6222620360001764440 韩冰</li>
<li>邮政银行: 6210982600081021667 韩冰</li>

<li>汇款后请联系您的专属客服</li>
</ul>
    </div>
    <div class="haomaxx_yc">
    	<dl class="gsd-jg1">
        <dd><img src="./index_files/liucheng.jpg"></dd>
		<dt><span>所有号码必须当面交易，实名过户！</span></dt>
	</dl>
    </div>

<div class="clear"></div>
<!-- 联系卖家预约 -->

<div class="clear"></div>
<!--号码展示-->
<!--<div class="haoma">
	<h3 class="menu_head current">该中介的其他号码</h3>
    <ul class="hmlist">
				    	<li><a href="http://#/escrow/622-15622819666.htm"><h2><i class="icon liang"></i>
		15622819<span class="yellow">666</span></h2>
		<p><span class="ychidden">深圳联通</span>
			<span><span class="red">￥ 6500</span></span></p></a></li>
							    	
					    <div class="clear"></div>
    </ul>
</div>-->
<div class="clear"></div>

<div class="location">
	<a href="index.php">首页</a>&nbsp;&gt;&nbsp;<a href="#">支付选择</a>
</div>

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
	<?php include("footer.php");?>
<!--    <a href="javascript:;" class="cd-top"></a>
-->



<p style="height:40px;">&nbsp;</p>
<script type="text/javascript">
var loadingpay = false;
$(function() {
	$('#payment').bind('click', function() {
		if(!loadingpay) {
			var money = $('#money').val();
			var name = $('input[name=name]').val();
			var lxtel = $('input[name=lxtel]').val();
			var address = $('input[name=address]').val();
			var remark = $('#remark').val();
			var userid = "622";
			var mobile = "13808038889";
			if(isNaN(money)) {
				alert('请输入正确的数字！');
				return false;
			}
			money = parseFloat(money);
			if(money < 1.00) {
				alert('支付金额不能低于1元！');
				return false;
			}
			if(!name) {
				alert('请填写姓名！');
				return false;
			}
			if(!/^1[3|4|5|7|8][0-9]{9}$/.test(lxtel)) {
				alert('请填写正确的联系方式！');
				return false;
			}
			var data = {
				userid : userid,
				mobile : mobile,
				money : money,
				name : name,
				phone : phone,
				address :address,
				remark : remark
			};
			loadingpay = true;
			var url = '/escrow/payment/';
			$.ajax({
			   type: "POST",
			   url: url,
			   data:data,
			   dataType:'json',
			   success: function(result){
					if(result.success) {
						location.href = result.url;
					} else {
						alert(result.msg);
					}
					loadingpay = false;
			   }
			});
		}
		return false;
	});
 });
 </script>
<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div>


</body></html>

<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Rec_qqgl011);
?>
