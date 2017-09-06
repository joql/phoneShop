<?php require_once('Connections/connch21.php'); ?>
<?php
//echo $url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//第一部分
session_start(); //启动Session的使用
if(!isset($_SESSION['ipb'])){
$url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];//将地址栏url取出

$nowtime=date("Y-m-d H:i:s");//设定代表当前时间的变量
$userIp=$_SERVER['REMOTE_ADDR'];//收集浏览者ip
mysql_select_db($database_connch21, $connch21);
$sql="insert into webcount01(count_id,count_ip,lf_url,count_time) values(null,'$userIp','$url','$nowtime')";
mysql_query($sql,$connch21);
$_SESSION['ipb']=1;
}


//第二部分
$countDay=date("Y-m-d");//设今日浏览人数筛选日期条件
mysql_select_db($database_connch21, $connch21);
$query_RecCount = "SELECT * FROM webcount";
$RecCount = mysql_query($query_RecCount, $connch21) or die(mysql_error());
$row_RecCount = mysql_fetch_assoc($RecCount);
$totalRows_RecCount = mysql_num_rows($RecCount);

mysql_select_db($database_connch21, $connch21);
$query_TodayCount = "SELECT * FROM webcount WHERE count_time LIKE '$countDay%'";
$TodayCount = mysql_query($query_TodayCount, $connch21) or die(mysql_error());
$row_TodayCount = mysql_fetch_assoc($TodayCount);
$totalRows_TodayCount = mysql_num_rows($TodayCount);

$timesec=gettimeofday();//从此处开始往下统计在线人数
$tmp=file("time.txt");
if ($tmp[0]==""){
  $fopen0=fopen("time.txt","w+");
  fputs($fopen0,$timesec["sec"]);
  fclose($fopen0);
  $fopen1=fopen("ip.txt","w+");
  fputs($fopen1,"");
  fclose($fopen1);
}
$tmp1=file("time.txt");
$equal=($timesec["sec"]-$tmp1[0]);
if ($equal>60){
  $fopen0=fopen("time.txt","w+");
  fputs($fopen0,"");
  fclose($fopen0); 
}
$fopen=fopen("ip.txt","a+");
$ip=$_SERVER['REMOTE_ADDR'];
$flag=1;
$tmp2=file("ip.txt");
$con=count($tmp2);
for ($i=0;$i<$con;$i++){
  if ($ip."\n"==$tmp2[$i]){
    $flag=0;
    break;
  }
}
if ($flag==1){
  $ipstring=$ip."\n";
  fputs($fopen,$ipstring);
}
fclose($fopen);
$tmp3=file("ip.txt");
$onlineusr=count($tmp3);
?>

欢迎光本站，您是第 <font color="#FF0000"><?php echo 501307 + $totalRows_RecCount ?></font> 位访客，本日浏览人次： <?php echo $totalRows_TodayCount ?> 人，</font><font size="2">目前线上人数：<?php echo $onlineusr;?> 。
<?php
//mysql_free_result($RecCount);

//mysql_free_result($TodayCount);
?>
