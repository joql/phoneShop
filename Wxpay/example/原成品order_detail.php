<?php
include_once('connect.php');
$order_no = isset($_GET['order_no']) ? $_GET['order_no'] : "";
if ($order_no) {
    $query = mysql_query("SELECT * FROM `order` WHERE order_no = '" . $order_no . "' AND state = 1 LIMIT 1");
    $row = mysql_fetch_array($query);
}
?>
订单详情页：
<p>订单号：<?php echo $row['order_no'] ?></p>
<p>流水号：<?php echo $row['trade_no'] ?></p>
<p>支付时间：<?php echo date("Y-m-d H:i:s", $row['update_time']) ?></p>


