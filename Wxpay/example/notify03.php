<?php
include_once('connect.php');
$simple = json_decode(json_encode(simplexml_load_string($GLOBALS['HTTP_RAW_POST_DATA'], 'SimpleXMLElement', LIBXML_NOCDATA)), true);

//$notify_data['order_no'] = $notify_data['trade_no'] = $simple['out_trade_no'];
//$notify_data['third_id'] = $simple['transaction_id'];
//$notify_data['pay_money'] = $simple['total_fee'];
//
//$notify_data['payment_method'] = 'weixin';

/*下面为我参考扫码支付单加的*/
$order_no = $simple['out_trade_no'];//商户订单号
$third_id = $simple['transaction_id'];//微信流水号
$pay_money = $simple['total_fee'];//实际支付金额
if ($order_no) {//若是支付成功 ，订单状态state=1表示已支付成功
    $query = mysql_query("UPDATE `order` SET `state` = '1',update_time='" . time() . "',trade_no='".$third_id."' WHERE `order_no` ='" . $order_no . "'");
}

file_put_contents('ac_notify_data.txt', date("Y-m-d H:i:s")."：".json_encode($simple));
