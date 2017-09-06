
<?php require_once('../Connections/connch21.php'); ?>
<?php session_start(); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE admin_wysz SET w_name=%s, w_http=%s, w_gname=%s, w_address=%s, w_lxr=%s, w_tel=%s, w_qq=%s, w_emil=%s, w_gjz=%s, w_msu=%s, w_footsm=%s, on_off=%s WHERE w_id=%s",
                       GetSQLValueString($_POST['w_name'], "text"),
                       GetSQLValueString($_POST['w_http'], "text"),
                       GetSQLValueString($_POST['w_gname'], "text"),
                       GetSQLValueString($_POST['w_address'], "text"),
                       GetSQLValueString($_POST['w_lxr'], "text"),
                       GetSQLValueString($_POST['w_tel'], "text"),
                       GetSQLValueString($_POST['w_qq'], "text"),
                       GetSQLValueString($_POST['w_emil'], "text"),
                       GetSQLValueString($_POST['w_gjz'], "text"),
                       GetSQLValueString($_POST['w_msu'], "text"),
                       GetSQLValueString($_POST['w_footsm'], "text"),
                       GetSQLValueString($_POST['on_off'], "text"),
                       GetSQLValueString($_POST['w_id'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($updateSQL, $connch21) or die(mysql_error());

  $updateGoTo = "jbgl_ok.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_connch21, $connch21);
$query_Rec_cx = "SELECT * FROM admin_wysz";
$Rec_cx = mysql_query($query_Rec_cx, $connch21) or die(mysql_error());
$row_Rec_cx = mysql_fetch_assoc($Rec_cx);
$totalRows_Rec_cx = mysql_num_rows($Rec_cx);
?>
<html>
<head>
<title>网站基本设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <style type="text/css">
<!--
.dotline {
	border: 1px dashed #666666;
}
input {border: 1px solid #BEBEBE;
height:25px;
}
textarea {border: 1px solid #BEBEBE;
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
                    <!--<tr align="right">
                      <td>&nbsp;</td>
                    </tr>-->
                    <tr align="right">
                      <td align="center">
                       
                       <div style="position:relative;  left:8px; margin-top:10px;">
                      
                       <form action="<?php echo $editFormAction; ?>" id="form2" name="form2" method="POST">
<table width="570" border="0" align="left" cellpadding="10" cellspacing="1" bgcolor="#D8D8D8">
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF">网站基本设置
      <input name="w_id" type="hidden" id="w_id" value="<?php echo $row_Rec_cx['w_id']; ?>"></td>
  </tr>
  <tr>
    <td width="121" align="center" bgcolor="#FFFFFF">网站名称：</td>
    <td width="450" align="left" bgcolor="#FFFFFF"><label for="w_name"></label>
      <input name="w_name" type="text" id="w_name" value="<?php echo $row_Rec_cx['w_name']; ?>" size="40" /></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">网站域名：</td>
    <td align="left" bgcolor="#FFFFFF"><label for="w_http"></label>
      <input name="w_http" type="text" id="w_http" value="<?php echo $row_Rec_cx['w_http']; ?>" size="40" /></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">公司名称：</td>
    <td align="left" bgcolor="#FFFFFF"><label for="w_gname"></label>
      <input name="w_gname" type="text" id="w_gname" value="<?php echo $row_Rec_cx['w_gname']; ?>" size="40" /></td>
  </tr>
  
  
  
  <tr>
    <td align="center" bgcolor="#FFFFFF">公司地址：</td>
    <td align="left" bgcolor="#FFFFFF"><label for="w_gname"></label>
      <input name="w_address" type="text" id="w_address" value="<?php echo $row_Rec_cx['w_address']; ?>" size="40" maxlength="60" /></td>
  </tr>
  
  
  <tr>
    <td align="center" bgcolor="#FFFFFF">联系人：</td>
    <td align="left" bgcolor="#FFFFFF"><label for="w_gname"></label>
      <input name="w_lxr" type="text" id="w_lxr" value="<?php echo $row_Rec_cx['w_lxr']; ?>" size="40" /></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">联系电话：</td>
    <td align="left" bgcolor="#FFFFFF"><label for="w_gname"></label>
      <input name="w_tel" type="text" id="w_tel" value="<?php echo $row_Rec_cx['w_tel']; ?>" size="40" /></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">联系QQ：</td>
    <td align="left" bgcolor="#FFFFFF"><label for="w_gname"></label>
      <input name="w_qq" type="text" id="w_qq" value="<?php echo $row_Rec_cx['w_qq']; ?>" size="40" /></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">联系邮箱：</td>
    <td align="left" bgcolor="#FFFFFF"><label for="w_gname"></label>
      <input name="w_emil" type="text" id="w_emil" value="<?php echo $row_Rec_cx['w_emil']; ?>" size="40" /></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">网页关键字：</td>
    <td align="left" bgcolor="#FFFFFF"><textarea name="w_gjz" cols="45" rows="5" id="w_gjz"><?php echo $row_Rec_cx['w_gjz']; ?></textarea>
    </td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">网站描述：</td>
    <td align="left" bgcolor="#FFFFFF"><label for="w_msu"></label>
      <textarea name="w_msu" id="w_msu" cols="45" rows="5"><?php echo $row_Rec_cx['w_msu']; ?></textarea></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">底部说明：</td>
    <td align="left" bgcolor="#FFFFFF"><label for="w_footms"></label>
      <textarea name="w_footsm" id="w_footsm" cols="45" rows="3"><?php echo $row_Rec_cx['w_footsm']; ?></textarea></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">是否关闭网站：</td>
    <td align="left" bgcolor="#FFFFFF">
      
         <label>
      <input <?php if (!(strcmp($row_Rec_cx['on_off'],"0"))) {echo "checked=\"checked\"";} ?> name="on_off" type="radio" id="on_off" value="0" checked="checked" />
      否</label>
    &nbsp;
    <label>
      <input <?php if (!(strcmp($row_Rec_cx['on_off'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="on_off" value="1" id="on_off" />
      是</label>
      
      
     </td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="left" bgcolor="#FFFFFF">
      <input type="submit" name="button" id="button" value="提交" />
    &nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="MM_update" value="form2">
                       </form>
                        
                     </div>   
                      </td>
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
</html>
<?php
mysql_free_result($Rec_cx);
?>
<?php mysql_close($connch21);?>