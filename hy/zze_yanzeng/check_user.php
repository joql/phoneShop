<?php header ("Content-type:text/html;charset=utf-8");?>
 


<?php require_once('../../Connections/connch21.php'); ?>
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
//验证注册用户名是否存在,接收注册页js ajax传递来的变量
$colname_Recordset1 = "-1";
if (isset($_GET['user'])) {
  $colname_Recordset1 = $_GET['user'];
}
if (!empty($_GET['user'])){
mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = sprintf("SELECT * FROM admin_zc WHERE f_name = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>验证注册用户名是否存在</title>
</head>

<body><?php if (!empty($_GET['user'])){ 

 if ($totalRows_Recordset1 > 0) {
  echo "抱歉，此用户名已被注册了！";}
  else{
	  
	 echo "恭喜，此用户名可以注册。" ;
  }
}
 ?> 
  <?php
//mysql_free_result($Recordset1);
?>
  
  
  
</body>
</html>

