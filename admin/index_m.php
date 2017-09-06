
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "adminLogin.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>

<html>
<head>
<title>密码管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <style type="text/css">
<!--
.dotline {
	border: 1px dashed #666666;
}
-->
 </style>
</head>
<body bgcolor="#ffffff">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEEEEE">
        <tr valign="top"> 
          <td width="180" background="images/diary_back.gif"> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="106"><img name="diary_r1_c1" src="images/diary_r1_c1.gif" width="180" height="106" border="0" alt=""></td>
              </tr>
              <tr> 
                <td><?php include("nav_left.php");?></td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td><strong><font color="#FF0000" size="3">管理后台首页</font></strong>
                  <hr size="1" noshade>
                  您好：<?php echo $_SESSION['MM_Username']; ?>，欢迎使用后台管理功能
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr align="right">
                      <td>&nbsp;</td>
                    </tr>
                    <tr align="right">
                      <td align="center">&nbsp;
                        
                        
                        
                        
                        
                        
                        <div><?php //session_start() //调用页上端一定加此，inclede 调用去掉此栏; 本代码适用于会员修改及密修改?>
<?php require_once('../Connections/connch21.php'); ?>
<?php error_reporting(E_ALL & ~E_NOTICE);

mysql_select_db($database_connch21, $connch21);

if($_POST['f_reg']){
	$upass0=$_POST['f_name'];
	$upass=$_POST['f_pass'];
	$upass2=$_POST['f_pass2'];
//echo $uname.$upass.$upass2;
 /* $sql="select*from admin where  passwd='".md5(md5($upass0))."'";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	if($num!=0){
$row=@mysql_fetch_array($query);
$m=$row[passwd];
echo $m; */




if($upass0==""){
	echo "<script language='javascript'>alert('原密码不能为空值!');location.href='javascript:history.go(-1)';</script>";}
else if($upass==""||$upass2==""){echo "<script language='javascript'>alert('新密码不能为空值!');location.href='javascript:history.go(-1)';</script>";} 

else if($upass!=$upass2){echo "<script language='javascript'>alert('两次输入的新密码不相同!');location.href='javascript:history.go(-1)';</script>";}


else{
	
	 $sql="select*from admin where  passwd='".md5(md5($upass0))."'and username='".$_SESSION['MM_Username']."' ";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	$row=mysql_fetch_array($query);
	//echo $row[passwd];
	// echo $_SESSION['MM_Username'];
if($num){
	$sql="update `admin` set passwd='".md5(md5($upass))."' where username='".$_SESSION['MM_Username']."' ";
	mysql_query($sql) or die("执行修改失败，请检查执行等相关链接！");
	echo "<script language='javascript'>alert('密码修改成功!');location.href='javascript:history.go(-1)';</script>";
} else 
{echo "<script language='javascript'>alert('原密码错误，请核对后重新输入!');location.href='javascript:history.go(-1)';</script>";}
	
	
	
	}

} 



 ?>
<form id="form1" name="form1" method="post" action="index_m.php">
  <table width="400" border="0" align="center" cellpadding="1" cellspacing="1"  bgcolor="#00CCFF">
    <tr>
      <td colspan="2" align="center" bgcolor="#66FFFF">修改密码</td>
    </tr>
    <tr>
      <td width="150" bgcolor="#FFFFFF">原密码：</td>
      <td width="243" bgcolor="#FFFFFF">
      <input name="f_name" type="password" id="textfield" size="20" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">新密码：</td>
      <td bgcolor="#FFFFFF"><input name="f_pass" type="password" id="f_pass" size="20" /></td>
    </tr>
     <tr>
      <td bgcolor="#FFFFFF">再输入一次新密码：</td>
      <td bgcolor="#FFFFFF">
       <input name="f_pass2" type="password" id="f_pass2" size="20" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="f_reg" id="f_reg" value="确定" />
      <input type="reset" name="button2" id="button2" value="重置" /></td>
    </tr>
  </table>


</form>



</div>
                      <p>&nbsp;</p></td>
                    </tr>
                    <tr align="right">
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td><img name="diary_r1_c5" src="images/diary_r1_c5.gif" width="12" height="29" border="0" alt=""></td>
        </tr>
        <tr bgcolor="#EEEEEE"> 
          <td height="12"><table width="20" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr> 
                <td width="8"><img src="images/spacer.gif" width="8" height="12"></td>
                <td width="12"><img name="diary_r4_c1" src="images/diary_r4_c1.gif" width="12" height="12" border="0" alt=""></td>
              </tr>
            </table></td>
          <td height="12"><img src="images/spacer.gif" width="1" height="12"></td>
          <td width="12" height="12"><img name="diary_r4_c5" src="images/diary_r4_c5.gif" width="12" height="12" border="0" alt=""></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html><?php mysql_close($connch21);?>