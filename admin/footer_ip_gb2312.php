<?php require_once('../Connections/connch21.php'); ?>
<?php
//echo $url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//��һ����
session_start(); //����Session��ʹ��
if(!isset($_SESSION['Counter'])){
$url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];//����ַ��urlȡ��

$nowtime=date("Y-m-d H:i:s");//�趨����ǰʱ��ı���
$userIp=$_SERVER['REMOTE_ADDR'];//�ռ������ip
mysql_select_db($database_connch21, $connch21);
$sql="insert into webcount(count_id,count_ip,lf_url,count_time) values(null,'$userIp','$url','$nowtime')";
mysql_query($sql,$connch21);
$_SESSION['Counter']=1;
}


//�ڶ�����
$countDay=date("Y-m-d");//������������ɸѡ��������
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

$timesec=gettimeofday();//�Ӵ˴���ʼ����ͳ����������
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

��ӭ�Ȿվ�����ǵ� <font color="#FF0000"><?php echo 501307 + $totalRows_RecCount ?></font> λ�ÿͣ���������˴Σ� <?php echo $totalRows_TodayCount ?> �ˣ�</font><font size="2">Ŀǰ����������<?php echo $onlineusr;?> ��
<?php
mysql_free_result($RecCount);

mysql_free_result($TodayCount);
?>
