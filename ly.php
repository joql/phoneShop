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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addform")) {
  $insertSQL = sprintf("INSERT INTO liuyan (name, phone, message, `time`) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['time'], "date"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($insertSQL, $connch21) or die(mysql_error());

 /* $insertGoTo = "ly.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}*/
echo "<script language='javascript'>alert('您给我们的留言已成功发布了!我们看到您的留言我尽快回复您哦！');location.href='ly.php';</script>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言中心-给我留言</title>

<script language="javascript">
function tijiao(){
	
if(addform.name.value==''){
	alert("名称不能为空！");
	addform.name.focus()
	return false;
	}
	
	if(addform.phone.value==''){
	alert("电话不能为空！");
	addform.phone.focus()
	return false;
	}
	if(addform.content.value==''){
	alert("内容不能为空！");
	addform.content.focus()
	return false;
	}
	
}

</script>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
</head>

<body>
<!--留言中心：--><center>
<div style="position:relative; top:5px; color:#333; "><form action="<?php echo $editFormAction; ?>" method="POST" name="addform" id="addform" onsubmit="return tijiao();" style="padding:0">
            <table width="748" height="392" border="0" cellpadding="3" cellspacing="1" style="padding-top:10px; padding-left:10px;" background="./index_files/123lyan.png">
  <tbody><tr>
    <td height="30" colspan="2" align="left">您的名称：<input name="name" type="text" id="name" maxlength="15"></td>
  
  </tr>
   <tr>
    
    <td height="30" colspan="2" align="left">您的电话：<input name="phone" type="text" id="phone" maxlength="15"></td>
</tr>
  
   <tr>
    
    <td height="30" colspan="2" align="left" valign="top">留言内容：<textarea name="content" cols="45" rows="5" id="content"></textarea></td>
  </tr>
   <tr>
    <td width="409" height="30" align="center">　　　　　<input name="submit" type="submit" value="提交留言"></td>
    <td width="324" align="center"><input type="hidden" name="a_qq" id="a_qq" /></td>
   </tr>
  <tr>
    
    <td colspan="2"><input name="time" type="hidden" value="<?php echo date("Y-m-d H:i:s");?>"></td>
  </tr>
</tbody></table>
            <input type="hidden" name="MM_insert" value="addform" />
</form></div></center>

</body>
</html>

