<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php //ini_set('display_errors', 'On'); 
/*$mysql=mysql_pconnect("localhost","root","admin")or die('01shi bai');
mysql_select_db("db_39",$mysql)or die('02shi bai');;*/
//mysql_query("SET NAMES 'UTF8'");
date_default_timezone_set('PRC') or die('时区设置失败，请联系管理员！')//必须高设时间，否则时间好不正确；
?>
<?php 


require_once 'PHPExcel.php';
require_once 'phpExcel/Writer/Excel2007.php';
require_once 'phpExcel/Writer/Excel5.php';
include_once 'phpExcel/IOFactory.php';
$objExcel = new PHPExcel();
//设置属性 (这段代码无关紧要，其中的内容可以替换为你需要的)
$objExcel->getProperties()->setCreator("andy");
$objExcel->getProperties()->setLastModifiedBy("andy");
$objExcel->getProperties()->setTitle("Office 2003 XLS Test Document");
$objExcel->getProperties()->setSubject("Office 2003 XLS Test Document");
$objExcel->getProperties()->setDescription("Test document for Office 2003 XLS, generated using PHP classes.");
$objExcel->getProperties()->setKeywords("office 2003 openxml php");
$objExcel->getProperties()->setCategory("Test result file");
$objExcel->setActiveSheetIndex(0);
$i=0;
//表头
$k1="编号";
$k2="推广代码";
$k3="访问来源";
$k4="IP";
$k5="访问时间";
$objExcel->getActiveSheet()->setCellValue('a1', "$k1");
$objExcel->getActiveSheet()->setCellValue('b1', "$k2");
$objExcel->getActiveSheet()->setCellValue('c1', "$k3");
$objExcel->getActiveSheet()->setCellValue('d1', "$k4");
$objExcel->getActiveSheet()->setCellValue('e1', "$k5");
//debug($links_list);
foreach($links_list as $k=>$v) {
  $u1=$i+2;
  /*----------写入内容-------------*/
  $objExcel->getActiveSheet()->setCellValue('a'.$u1, $v["id"]);
  $objExcel->getActiveSheet()->setCellValue('b'.$u1, $v["num"]);
  $objExcel->getActiveSheet()->setCellValue('c'.$u1, $v["referer"]);
  $objExcel->getActiveSheet()->setCellValue('d'.$u1, $v["ip"]);
  $objExcel->getActiveSheet()->setCellValue('e'.$u1, $v["dateline"]);
  $i++;
}
// 高置列的宽度
$objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(70);
$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');
$objExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objExcel->getProperties()->getTitle() . '&RPage &P of &N');
// 设置页方向和规模
$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$objExcel->setActiveSheetIndex(0);
$timestamp = time();
if($ex == '2007') { //导出excel2007文档
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="links_out'.$timestamp.'.xlsx"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
  $objWriter->save('php://output');
  exit;
} else { //导出excel2003文档
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="links_out'.$timestamp.'.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
  $objWriter->save('php://output');
  exit;
}

?>
</body>
</html>