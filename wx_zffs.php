<?php require_once('Connections/connch21.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = sprintf("SELECT * FROM sj WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>付款方式选择</title>

<script type="text/javascript">
function is_weixn(){  
    var ua = navigator.userAgent.toLowerCase();  
    //if(!(ua.match(/MicroMessenger/i)=="micromessenger")) {  
	 if(ua.match(/MicroMessenger/i)=="micromessenger") {  
        //return true;  //无用
		//document.write("true");此句调试用
		location.href='http://www.hrblh.com/Wxpay/example/jsapi02.php?sj=<?php echo $row_Recordset1['sj_hao']; ?>&price=<?php echo $row_Recordset1['s_price']; ?>';
    } else {  
       //return false; //无用
		//document.write("false"); 此句调式用
		location.href='http://www.hrblh.com/waxin/index.php?sj=<?php echo $row_Recordset1['sj_hao']; ?>&price=<?php echo $row_Recordset1['s_price']; ?>';
    }  
}  

</script>
</head>

<body><table width="500" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" >
  <tr>
    <td align="center" bgcolor="#FFFFFF">订购号码</td>
    <td align="center" bgcolor="#FFFFFF">所属区域</td>
    <td align="center" bgcolor="#FFFFFF">价格</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><?php echo $row_Recordset1['sj_hao']; ?></td>
    <td align="center" bgcolor="#FFFFFF"><?php  $a=$row_Recordset1['pid'];
				switch ($a)
						{
						case 1:
						echo "哈尔滨";
						break;
						case 2:
						echo "齐齐哈尔";
						break;
						
						case 3:
						echo "牡丹江";
						break;
							
						case 4:
						echo "佳木斯";
						break;	
						
						case 5:
						echo "绥化";
						break;	
						case 6:
						echo "黑河";
						break;	
						case 7:
						echo "大兴安岭";
						break;
						case 8:
						echo "伊春";
						break;
						case 9:
						echo "大庆";
						break;
							} ?>  <?php $b=$row_Recordset1['tel'];
					switch ($b)
						{
						case 1:
						echo "移动";
						break;
						case 2:
						echo "联通";
						break;
						
						case 3:
						echo "电信";
						break;
						}
					
					 ?></td>
    <td align="center" bgcolor="#FFFFFF">&yen; <?php echo $row_Recordset1['s_price']; ?></span>（含费 &yen; 
    <?php 
				if($row_Recordset1['hfei']!=""){echo $row_Recordset1['hfei'];}else{echo "0" ;} ?>元）</td>
  </tr>
   <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><h3 style="font-family:font-family:Microsoft YaHei; height:0px; line-height:0;">请选择支付方式</h3></td>
  </tr>
  
  <tr>
    <td bgcolor="#FFFFFF"><input name="tj" type="button" id="tj"  onclick="is_weixn()" value="微信支付" /></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>



</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
