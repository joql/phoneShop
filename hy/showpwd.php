<?php require_once('../Connections/connch21.php'); 
mysql_select_db($database_connch21, $connch21);
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>找回密码</title>
<link rel="stylesheet" type="text/css" href="css/font.css">
</head>
<?php
 //include("conn/conn.php");
 $nc=$_POST[nc];
 $da=$_POST[da];
 $sql=mysql_query("select * from admin_zc where f_name='".$nc."'",$connch21);
 $info=mysql_fetch_array($sql);
 if($info[tsda]!=$da)
 {
   /*echo "<script>alert('提示答案输入错误!');history.back();</script>";*/
echo "<script>alert('提示答案输入错误!');location.href='javascript:history.go(-2)';</script>";
/*echo "<script>alert('提示答案输入错误!');</script>";*/
  exit;
 }
 else
 {
?>
<body topmargin="0" leftmargin="0" bottommargin="0">
<table width="200" height="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#FFEDBF">
    <td height="25" colspan="2" bgcolor="#F0F0F0"><div align="center">请记好您的账号和密码信息</div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="76" height="25"><div align="center">账号：</div></td>
    <td width="124"><div align="left"><?php echo $nc;?></div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25"><div align="center">密码：</div></td>
    <td height="25"><div align="left"><?php echo $info[f_pass2];?></div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25" colspan="2"><div align="center"><input name="submit" type="button" id="submit" onClick="window.close()"  value="确定">
    </div></td>
  </tr>
</table>
<?php
  }
?>
</body>
</html>
