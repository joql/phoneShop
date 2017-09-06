<?php require_once('../Connections/connch21.php'); ?>
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

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM admin_zc ORDER BY z_id DESC";
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$currentPage = $_SERVER["PHP_SELF"];

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
<title>会员管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <style type="text/css">
<!--
.dotline {
	border: 1px dashed #666666;
}
td{font-size:14px;}
-->







 </style>


</head>
<body bgcolor="#ffffff">
<table width=98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEEEEE">
        <tr valign="top"> 
          <td width="180" background="images/diary_back.gif"> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="106"><img name="diary_r1_c1" src="images/diary_r1_c1.gif" width="180" height="106" border="0" alt=""></td>
              </tr>
              <tr> 
                <td >
				
				
				<?php include("nav_left.php");?></td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
            </tr>
            <tr>
              <td><strong><font color="#FF0000" size="3">会员管理</font></strong>
                <hr size="1" noshade>
                <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
                  <table width="100%" border="0" cellpadding="2" cellspacing="1">
                    <tr align="center" bgcolor="#CCCCCC">
                      <td width="30" ><font size="2">编号</font></td>
                      <td width="126" ><font size="2">注册名</font></td>
                      <td width="64" >真实姓名</td>
                      <td width="59" >姓别</td>
                      <td width="100" >单位名称</td>
                      <td width="118" >地址</td>
                      <td width="118" >邮编</td>
                      <td width="58" >电话</td>
                      <td width="59" >手机</td>
                      <td width="100" >传真</td>
                      <td width="100" >QQ</td>
                      <td width="100" >电子邮箱</td>
                      <td width="100" >注册时间</td>
                    <!--  <td width="17" align="center"><font size="2">执行功能</font></td>-->
                    </tr>
                    <?php do { ?>
                      <tr bgcolor="#FFFFFF" style="cursor: hand;" onMouseOver="this.style.backgroundColor='#F0F0F0'" onMouseOut="this.style.backgroundColor=''">
                        <td  ><?php echo $row_Recordset1['z_id']; ?></td>
                        <td ><?php echo $row_Recordset1['f_name']; ?></td>
                        <td align="center" ><?php echo $row_Recordset1['RealName']; ?></td>
                        <td align="center"><?php echo $row_Recordset1['Sex']; ?></td>
                        <td><?php echo $row_Recordset1['dwei']; ?></td>
                        <td><?php echo $row_Recordset1['Address']; ?></td>
                        <td><?php echo $row_Recordset1['ZipCode']; ?></td>
                        <td><?php echo $row_Recordset1['Telephone']; ?> </td>
                        <td><?php echo $row_Recordset1['Mobile']; ?></td>
                        <td><?php echo $row_Recordset1['Fax']; ?></td>
                        <td><?php echo $row_Recordset1['QQ']; ?></td>
                        <td><?php echo $row_Recordset1['Email']; ?></td>
                        <td><?php echo $row_Recordset1['z_time']; ?></td>
                        <!--<td width="17" align="center"><font size="2">
                        
                        
                        <?php error_reporting(E_ALL & ~E_NOTICE); echo
                        "<a href='schuan_fix.php?id=".$row_Recordset1[id]."'>"."编辑"."</a>"?> <a href="musicDel.php?id=<?php echo $row_Recordset1['id']; ?>">删除</a></font></td>-->
                      </tr>
                      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                  </table>
                  <?php } // Show if recordset not empty ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr align="right">
                    <td>&nbsp;
                      
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr align="right">
                      <td align="center">&nbsp;
                        <table width="100%" border="0" align="center"  bgcolor="#FFFFFF">
                          <?php error_reporting(E_ALL & ~E_NOTICE);
						  include("fanye.php");?>
                          
                          
                      </table></td>
                    </tr>
                </table></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td align="center"><?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
                  目前资料库没有任何音乐文件!
  <?php } // Show if recordset empty ?></td>
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
</html>
<?php
mysql_free_result($Recordset1);
?>
