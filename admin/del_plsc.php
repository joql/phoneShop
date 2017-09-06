<?php require_once('../Connections/connch21.php'); ?>
<?php /*批量删除*/
 $del_id=$_POST['nid'];
//echo $del_id."<br>";
$tab=$_POST['tab'];//接收前端传来的数据名表
if(!empty($del_id)){
$del_id=implode(",",$_POST['nid']);
//echo $del_id;
mysql_select_db($database_connch21, $connch21);
if(mysql_query("DELETE FROM `$tab` where id in($del_id)")or die(mysql_error())){
if(!empty($_POST['delpic'])){//删除图片
	$img="../images/".$_POST['delpic'];
	unlink($img);
	
	}
	

echo "<script>alert(\"批量删除成功！\");history.go(-1);</script>";}
}else{
echo "<script>alert('请选择你要删除的记录！');history.go(-1);</script>";	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>批量删除</title>
</head>

<body>

</body>
</html>

