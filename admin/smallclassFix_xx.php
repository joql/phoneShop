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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE xx_smallclass SET x_mame=%s, class_id=%s, smallclass_id=%s, x_num=%s WHERE xx_id=%s",
                       GetSQLValueString($_POST['smallclassname'], "text"),
                       GetSQLValueString($_POST['class_id'], "text"),
                       GetSQLValueString($_POST['small_id'], "text"),
                       GetSQLValueString($_POST['smallclassnum'], "int"),
                       GetSQLValueString($_POST['xx_id'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($updateSQL, $connch21) or die(mysql_error());

  $updateGoTo = "smallclassAdmin_xx.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recclass = "-1";
if (isset($_GET['smallclass_id'])) {
  $colname_Recclass = $_GET['smallclass_id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recclass = sprintf("SELECT * FROM smallclass WHERE smallclass_id = %s ORDER BY smallclass_id DESC", GetSQLValueString($colname_Recclass, "int"));
$Recclass = mysql_query($query_Recclass, $connch21) or die(mysql_error());
$row_Recclass = mysql_fetch_assoc($Recclass);
$totalRows_Recclass = mysql_num_rows($Recclass);

mysql_select_db($database_connch21, $connch21);
$query_Recbigclass = "SELECT * FROM bigclass ORDER BY classnum ASC";
$Recbigclass = mysql_query($query_Recbigclass, $connch21) or die(mysql_error());
$row_Recbigclass = mysql_fetch_assoc($Recbigclass);
$totalRows_Recbigclass = mysql_num_rows($Recbigclass);

mysql_select_db($database_connch21, $connch21);
$query_Rec_small = "SELECT * FROM smallclass ORDER BY smallclassnum ASC";
$Rec_small = mysql_query($query_Rec_small, $connch21) or die(mysql_error());
$row_Rec_small = mysql_fetch_assoc($Rec_small);
$totalRows_Rec_small = mysql_num_rows($Rec_small);

$colname_Rec_xx = "-1";
if (isset($_GET['xx_id'])) {
  $colname_Rec_xx = $_GET['xx_id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Rec_xx = sprintf("SELECT * FROM xx_smallclass WHERE xx_id = %s", GetSQLValueString($colname_Rec_xx, "int"));
$Rec_xx = mysql_query($query_Rec_xx, $connch21) or die(mysql_error());
$row_Rec_xx = mysql_fetch_assoc($Rec_xx);
$totalRows_Rec_xx = mysql_num_rows($Rec_xx);
?>
<html>
<head>
<title>广告管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Fireworks MX Dreamweaver MX target.  Created Thu Feb 27 23:51:44 GMT+0800 (￥x￥_?D  CRE?!) 2003-->
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
                <td><?php include("nav_left.php");?>&nbsp;</td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td height="192"><font color="#FF0000" size="3"><strong>修改类别</strong>&nbsp;(C类）</font> 
                  <hr size="1" noshade> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" style="margin=0px;">
                          <table width="100%" border="0" cellspacing="1" cellpadding="2">
                            <tr> 
                            <td width="80" align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">信息类别：</font></strong></td>
                              <td valign="top"><font size="2"> 
                                <input name="smallclassname" type="text" id="smallclassname" value="<?php echo $row_Rec_xx['x_mame']; ?>">
                                </font></td>
                            </tr>
                            
    <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">所属大类：<br>
                                </font></strong></td>
                              <td valign="top"> <font size="2">
                                 <select  name="class_id" type="text" id="class_id">
                                   <?php
do {  
?>
                                   <option value="<?php echo $row_Recbigclass['classname']?>"<?php if (!(strcmp($row_Recbigclass['classname'], $row_Rec_xx['class_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recbigclass['classname']?></option>
                                   <?php
} while ($row_Recbigclass = mysql_fetch_assoc($Recbigclass));
  $rows = mysql_num_rows($Recbigclass);
  if($rows > 0) {
      mysql_data_seek($Recbigclass, 0);
	  $row_Recbigclass = mysql_fetch_assoc($Recbigclass);
  }
?>
                                 </select>
                              </font></td></tr>  
                              
                              
                              
                              <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">所属中类：<br>
                                </font></strong></td>
                              <td valign="top"> <font size="2">
                                <select  name="small_id" type="text" id="small_id">
                                   <?php
do {  
?>
                                   <option value="<?php echo $row_Rec_small['smallclassname']; ?>"<?php if (!(strcmp($row_Rec_small['smallclassname'],$row_Rec_xx['smallclass_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Rec_small['smallclassname']?></option>
                                   <?php
} while ($row_Rec_small = mysql_fetch_assoc($Rec_small));
  $rows = mysql_num_rows($Rec_small);
  if($rows > 0) {
      mysql_data_seek($Rec_small, 0);
	  $row_Rec_small = mysql_fetch_assoc($Rec_small);
  }
?>
                                 </select>
                              </font></td></tr>
                              
                              
                           <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">排序：<br>
                                </font></strong></td>
                              <td valign="top"> <font size="2">
                                 <input name="smallclassnum" type="text" id="smallclassnum" value="<?php echo $row_Rec_xx['x_num']; ?>">
                                <input name="xx_id" type="hidden" id="xx_id" value="<?php echo $row_Rec_xx['xx_id']; ?>">
                              </font></td>
                            </tr>  
                              
                          </table>
                          <input type="submit" name="Submit2" value="提交">
                          <input type="reset" name="Submit3" value="重设">
                          <input type="button" name="Submit4" value="回上一页" onClick="window.history.back();">
                          <input type="hidden" name="MM_update" value="form1">
                      </form></td>
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
</html>
<?php
mysql_free_result($Recclass);

mysql_free_result($Recbigclass);

mysql_free_result($Rec_small);

mysql_free_result($Rec_xx);
?>
