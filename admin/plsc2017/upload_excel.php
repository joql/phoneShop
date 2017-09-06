<?php  //ini_set('display_errors', 'Off'); 
error_reporting(E_ALL & ~E_NOTICE);
header("Content-type:text/html;charset=UTF-8");
/*if($_POST['inputExcel']==""){echo "<script language='javascript'>alert('上传文件不能为空!请选择上传文件！');history.go(-1);</script>";}else{*/
include("conn.php");
include("function.php"); 
//echo $_POST['import'];
if($_POST['import']=="导入数据"){

	$leadExcel=$_POST['leadExcel'];
	
	if($leadExcel == "true")
	{
		//echo "OK"."<br>";
		//die();
		//获取上传的文件名
		$filename = $_FILES['inputExcel']['name'];
		//echo $filename;
		echo "<br>";
		//$filename = $_FILES['inputExcel'];
		// echo $filename['inputExcel'];
		//上传到服务器上的临时文件名
		$tmp_name = $_FILES['inputExcel']['tmp_name'];
		//echo $tmp_name;
		//$msg = move_uploaded_file($filename,$tmp_name);
		
		
		//include("function.php");
		
		 $msg = uploadFile($filename,$tmp_name);   
        
		//echo "<br>".$msg;
	}
}
//}
?>