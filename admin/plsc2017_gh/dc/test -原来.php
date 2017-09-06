 <?php
 date_default_timezone_set("Etc/GMT-8"). //设置时区
 header('Content-Type: text/html; charset=utf-8');  //设置网页编码方式，最好是utf-8
 require_once './Classes/PHPExcel.php';          //路径根据自己实际项目的路径进行设置
 
 
/* require_once './Classes/phpExcel/Writer/Excel2007.php';
require_once './Classes/phpExcel/Writer/Excel5.php';
include_once './Classes/phpExcel/IOFactory.php';*/
      $objPHPExcel = new PHPExcel();  //创建PHPExcel实例
   //下面是对mysql数据库的连接   
$conn = mysql_connect("localhost","root","admin") or die("数据库连接失败！");   
 mysql_select_db("db_39",$conn);               //连接数据库
 mysql_query("set names 'GBK'");               //转换字符编码
 $sql = mysql_query("select * from sj");    //查询sql语句
/*--------------设置表头信息------------------*/
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID编号')
            ->setCellValue('B1', '商品名称')
            ->setCellValue('C1', '货号')
            ->setCellValue('D1', '商品条形码')
            ->setCellValue('E1', '型号规格')
            ->setCellValue('F1', '吊牌价');
           
/*--------------开始从数据库提取信息插入Excel表中------------------*/
$i=2;                //定义一个i变量，目的是在循环输出数据是控制行数
//$rows=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
 while($rs=mysql_fetch_array($sql)){
  $rm = iconv("gbk", "UTF-8//IGNORE",$rs[1]);   //对字符进行编码将数据库里GB2312的中文字符转换成UTF-8格式
       $objPHPExcel->setActiveSheetIndex(0)
                            
             ->setCellValue("A".$i, $rs[0]) //向单元格中填写数据
           //  ->setCellValue("B".$i, $rm)  //由于我的这一列是中文，所以在上面进行了编码
			   ->setCellValue("B".$i,$rs[1])  //由于我的这一列是中文，所以在上面进行了编码
             ->setCellValue("C".$i, $rs[2])
             ->setCellValue("D".$i, $rs[3])
             ->setCellValue("E".$i, $rs[4])
             ->setCellValue("F".$i, $rs[5]);  
            $i++;
 }
/*--------------下面是设置其他信息------------------*/

   $objPHPExcel->getActiveSheet()->setTitle('Example1');      //设置sheet的名称
   $objPHPExcel->setActiveSheetIndex(0);           //设置sheet的起始位置
   //注意下面是excel2007。不要写成excel5不然会是乱码。
   //如果还是乱码看看你自己数据的编码方式
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  //通过PHPExcel_IOFactory的写函数将上面数据
    ob_clean(); //必加这个。否则导出的内容2007显示出错打不开.ob_clean — 清空（擦掉）输出缓冲区.此函数用来丢弃输出缓冲区中的内容。 
//此函数不会销毁输出缓冲区，而像 ob_end_clean() 函数会销毁输出缓冲区。
 
 // $objWriter->save('php://output'); //到浏览器
 //$objWriter->save(str_replace('.php', date('Y-m-d H-i-s').'.xls', __FILE__)); 
  

  $outputFileName = "Book1.xlsx";
 
  header("Content-Type: application/force-download");//标头您的浏览器并告诉它下载，而不是在浏览器中运行的文件
  header("Content-Type: application/octet-stream");//文件流
  header("Content-Type: application/download"); //下载文件
  header("Content-Disposition:attachment;filename=$outputFileName");  //到文件
  header("Content-Transfer-Encoding: binary");
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");//上一次修改时间
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Pragma: no-cache"); //不缓存页面
  $objWriter->save('php://output');

 ?>