<?php error_reporting(E_ALL & ~E_NOTICE);
//����Excel�ļ�
function uploadFile($file,$filetempname) 
{
	//�Լ����õ��ϴ��ļ����·��
	$filePath = 'upFile/';
	$str = "";
	//�����·��������PHPExcel��·�����޸�
	set_include_path('.'. PATH_SEPARATOR .'\PHPExcel' . PATH_SEPARATOR .get_include_path()); 
      
	require_once 'PHPExcel.php';
	require_once 'PHPExcel\IOFactory.php';
	//require_once 'PHPExcel\Reader\Excel5.php';//excel 2003
	require_once 'PHPExcel\Reader\Excel2007.php';//excel 2007

	$filename=explode(".",$file);//���ϴ����ļ����ԡ�.����Ϊ׼��һ�����顣 
	@$time=date("y-m-d-H-i-s");//ȥ��ǰ�ϴ���ʱ�� 
	//$time=date("ymdHis");//ȥ��ǰ�ϴ���ʱ��
	$filename[0]=$time;//ȡ�ļ���t�滻 
	$name=implode(".",$filename); //�ϴ�����ļ��� 
	$uploadfile=$filePath.$name;//�ϴ�����ļ�����ַ 

  
	//move_uploaded_file() �������ϴ����ļ��ƶ�����λ�á����ɹ����򷵻� true�����򷵻� false��
    $result=move_uploaded_file($filetempname,$uploadfile);//�����ϴ�����ǰĿ¼��
    if($result) //����ϴ��ļ��ɹ�����ִ�е���excel����
    {
	   //$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2003
	   $objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 �� 2007 format
	   //$objPHPExcel = $objReader->load($uploadfile); //����������httpd����
	   $objPHPExcel = PHPExcel_IOFactory::load($uploadfile);//�ĳ����д���ͺ���

	   $sheet = $objPHPExcel->getSheet(0); 
	   $highestRow = $sheet->getHighestRow(); // ȡ�������� 
	   $highestColumn = $sheet->getHighestColumn(); // ȡ��������
    
		//ѭ����ȡexcel�ļ�,��ȡһ��,����һ��
		for($j=2;$j<=$highestRow;$j++) //$j=2 ��˵����Excel �ڶ��п�ʼ�����ݿ����
		{ 
			for($k='A';$k<=$highestColumn;$k++)
			{ 
				$str .= iconv('utf-8','gbk',$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()).'\\';//��ȡ��Ԫ��
			} 
			//explode:�������ַ����ָ�Ϊ���顣
			$strs = explode("\\",$str);
			
			//var_dump($strs);
			//die();
			//$sql = "INSERT INTO sj(pid,tel,theme,price,day,sj_hao,info_top,s_price,hfei,message,tszf,phpoto,info_editor,l_tel,wx,info_time,jlou) VALUES('".$strs[0]."','".$strs[1]."','".$strs[2]."','".$strs[3]."','".$strs[4]."','".$strs[5]."','".$strs[6]."','".$strs[7]."','".$strs[8]."','".$strs[9]."','".$strs[10]."','".$strs[11]."','".$strs[12]."','".$strs[13]."','".$strs[14]."','".$strs[15]."','".$strs[16]."')";     
			//��Ʒ1
			//$sql = "INSERT INTO sj(pid,tel,theme,price,day,sj_hao,info_top,s_price,hfei,message,tszf,info_editor,l_tel,wx,jlou) VALUES('".$strs[0]."','".$strs[1]."','".$strs[2]."','".$strs[3]."','".$strs[4]."','".$strs[5]."','".$strs[6]."','".$strs[7]."','".$strs[8]."','".$strs[9]."','".$strs[10]."','".$strs[12]."','".$strs[13]."','".$strs[14]."','".$strs[16]."')";  //��Ʒ1   
			
			$sql = "INSERT INTO sj(pid,tel,theme,price,day,sj_hao,info_top,s_price,hfei,message,tszf,info_editor,l_tel,wx,jlou) VALUES('".$strs[0]."','".$strs[1]."','".$strs[2]."','".$strs[3]."','".$strs[4]."','".$strs[5]."','".$strs[6]."','".$strs[7]."','".$strs[8]."','".$strs[9]."','".$strs[10]."','".$strs[11]."','".$strs[12]."','".$strs[13]."','".$strs[14]."')";  //��Ʒ2  
			
			
			//$sql = "INSERT INTO sj (pid,tel,theme) VALUES('".$strs[0]."','".$strs[1]."','".$strs[2]."')";     
			//$sql = "INSERT INTO z_test_importexcel(duty_date,name_am,name_pm) VALUES('".$strs[0]."','".$strs[1]."','".$strs[2]."')"; 
			
			//$sql = "INSERT INTO sj01(duty_date,name_am,name_pm) VALUES('".$strs[0]."','".$strs[1]."','".$strs[2]."')";
			
			//echo $sql;
			mysql_query("set names GBK");//�����ָ�����ݿ��ַ�����һ������������ݿ�����ϵ�� 
			
			
			if(!mysql_query($sql)){
				return false;
			}
			$str = "";
	   } 
   
   	   unlink($uploadfile); //ɾ���ϴ���excel�ļ�
      // $msg = "����ɹ���";
	 echo "<script language='javascript'>alert('�ֻ��������ϴ��ɹ�!');location.href='../sjAdmin.php';</script>";
    }else{
      // $msg = "����ʧ�ܣ�";
	  
	  echo "<script language='javascript'>alert('�ֻ��������ϴ�ʧ��!');location.href='inddex.php';</script>";
    }
   // return $msg;
}
?>