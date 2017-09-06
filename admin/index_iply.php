<?php require_once('../Connections/connch21.php'); ?>


<?php 

require('ip/ipconfig.php');//调用ip数据库处理代码文件 ?>
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
$date=date("Y-m-d");

$currentPage = $_SERVER["PHP_SELF"];


$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;
$fl=$_GET['fl'];//按有效ip统计ip
if($fl==1){$link="WHERE count_time like '$date%' group by count_ip ORDER BY count_time";}elseif($fl==2){$link="group by count_ip ORDER BY count_time";}else{$link="ORDER BY count_time";}
$maxRows_Recordset1 = 50;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM webcount $link DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
$date=date("Y-m-d");
mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = "SELECT * FROM webcount WHERE count_time like '$date%' group by count_ip ORDER BY count_time DESC";
$Recordset2 = mysql_query($query_Recordset2, $connch21) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_connch21, $connch21);
$query_Recordset3 = "SELECT * FROM webcount group by count_ip ORDER BY count_time DESC";
$Recordset3 = mysql_query($query_Recordset3, $connch21) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
//以下代码必须用dw本机的数据翻页做出来后，及第一页 前一页 下一个 最后一页 然后就会生成下边代码，然后去掉这个本机翻页，把我做好的翻页用include 调用过来即可
$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>

<html>
<head>
<title>网站来访ip统计</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
 <style type="text/css">
<!--
.dotline {
	border: 1px dashed #666666;
}
-->
 </style>
</head>
<body bgcolor="#ffffff">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEEEEE">
        <tr valign="top"> 
          <td width="180" background="images/diary_back.gif"> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="106"><img name="diary_r1_c1" src="images/diary_r1_c1.gif" width="180" height="106" border="0" alt=""></td>
              </tr>
              <tr> 
                <td><?php include("nav_left_gb2312.php");?></td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td><strong><font color="#FF0000" size="3">网站来访ip统计</font></strong>
                  <hr size="1" noshade>
                  您好：<?php echo $_SESSION['MM_Username']; ?>，欢迎使用后台管理功能
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr align="right">
                      <td>&nbsp;</td>
                    </tr>
                    <tr align="right">
                      <td align="center">&nbsp;
                        
                        <table  bgcolor="#999999" width="100%" border="0" cellspacing="1" cellpadding="5">
  <tr>
    <td colspan="4" bgcolor="#FFFFFF"><!--网站浏览总人数：<?php echo $totalRows_Recordset1 ?>　-->　
　
<?php include("./footer_ip_gb2312.php");?> 　　最后访客访问时间为：<?php echo $row_Recordset1['count_time']; ?>

　　　<p style="font-size:14px; text-indent:50px;">今日有效访问IP:<?php echo $totalRows_Recordset2 ?>个  
  <input type="submit" name="button" id="button" value="点击查看今日来访IP" onClick="javasctript:location.href='index_iply.php?fl=1'">
  　　本站累计有效访问IP:<?php echo $totalRows_Recordset3 ?>个　<input type="submit" name="button" id="button" value="点击查看所有来访本站IP" onClick="javasctript:location.href='index_iply.php?fl=2'"> 　<input name="button" type="submit" value="返回默认排序" onClick="javasctript:location.href='index_iply.php'"></p>
</td>
   
    </tr>
  <tr>
    <td bgcolor="#eaeaea">编号</td>
    <td bgcolor="#eaeaea">访客IP (点击ip可看到ip所属地区)</td>
    <td bgcolor="#eaeaea">访问来源 (点击网址进入访问页面)</td>
    <td bgcolor="#eaeaea">来访时间</td>
  </tr>
  
 <?php do { ?>
    <tr>
      <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['count_id']; ?></td>
      <td bgcolor="#FFFFFF"><a href='http://www.baidu.com/s?wd=<?php echo $row_Recordset1['count_ip']; ?>' target="_blank">
	  <?php 
	  echo $row_Recordset1['count_ip'];?>
	  <?php  
	 $ip=$row_Recordset1['count_ip']; 
	 $QQWry=new QQWry;
	 $ifErr=$QQWry ->QQWry($ip);
	 echo "$QQWry->Country$QQWry->Local";
	  
	  ?></a>  
	  
      
    
	  </td>
      <td bgcolor="#FFFFFF"><a href="http://<?php echo $row_Recordset1['lf_url']; ?>" target="_blank">http://<?php echo $row_Recordset1['lf_url']; ?></a></td>
      <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['count_time']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                       
         
                       
                        </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include("fanye_ip_gb2312.php");?> </td>
  </tr>
</table>

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
</html><?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
 mysql_close($connch21);?>