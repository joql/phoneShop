<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body><?php ini_set('display_errors', 'Off'); 
date_default_timezone_set('PRC') or die('时区设置失败，请联系管理员！')//必须高设时间，否则时间好不正确；
?>
<?php 
 header("Content-Type:text/html;charset=utf-8");
 //引入PHPExcel库文件（路径根据自己情况）
 
//$dir = dirname(__FILE__);  
//Include class  
//require_once($dir.'/PHPExcel.php');  
  require_once 'PHPExcel.php';
  
$objPHPExcel = new PHPExcel(); //实例化PHPExcel类  
$objPHPExcel->setActiveSheetIndex(0);  
$objSheet = $objPHPExcel->getActiveSheet(); //获得当前sheet  
$objSheet->setTitle("demo"); //给当前sheet设置名称  
  
$array = array(  
    array("姓名","分数"),  
    array("李四","60"),  
    array("王五","70")  
);  
  
$objSheet->setCellValue("A5","姓名");  
$objSheet->setCellValue("B5","分数"); //给当前sheet填充数据  
$objSheet->setCellValue("A6","张三");  
$objSheet->setCellValue("B6","70");  
  
$objSheet->fromArray($array); //直接加载数据块填充数据  
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); //按照指定格式生成excel文件  
  
$objWriter->save(str_replace('.php', '.xls', __FILE__));  
?>
</body>
</html>