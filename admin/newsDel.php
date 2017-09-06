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

if ((isset($_GET['news_id'])) && ($_GET['news_id'] != "") && (isset($_GET['delsure']))) {
  $deleteSQL = sprintf("DELETE FROM news WHERE news_id=%s",
                       GetSQLValueString($_GET['news_id'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($deleteSQL, $connch21) or die(mysql_error());

  $deleteGoTo = "newsAdmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recnews = "-1";
if (isset($_GET['news_id'])) {
  $colname_Recnews = $_GET['news_id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recnews = sprintf("SELECT * FROM news WHERE news_id = %s", GetSQLValueString($colname_Recnews, "int"));
$Recnews = mysql_query($query_Recnews, $connch21) or die(mysql_error());
$row_Recnews = mysql_fetch_assoc($Recnews);
$totalRows_Recnews = mysql_num_rows($Recnews);
?>
<html>
<head>
<title>删除各栏目分类信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Fireworks MX Dreamweaver MX target.  Created Thu Feb 27 23:51:44 GMT+0800 (￥x￥_?D  CRE?!) 2003-->
<style type="text/css">
<!--
.dotline {
	border: 1px dashed #666666;	
}
.whiteline {
	border-top: 1px solid #999999;
	border-right: 1px solid #000000;
	border-bottom: 1px solid #000000;
	border-left: 1px solid #999999;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 10px;
	margin-left: 10px;
}
p {
	line-height: 20px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 10px;
	margin-left: 0px;
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
                <td><font color="#FF0000" size="3"><strong>删除各栏目分类信息</strong></font>
                  <?php echo $row_Recnews['news_title']; ?>
                  <hr size="1" noshade> 
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td valign="top"><font size="2"><strong>日期</strong>：<strong><?php echo $row_Recnews['news_time']; ?>发布人</strong>：<?php echo $row_Recnews['news_editor']; ?></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr> 
                <td><form name="form1" method="get" action="">
                  <input type="submit" name="Submit" value="确定删除">
                  <input name="delsure" type="hidden" id="delsure" value="1">
                  <input name="news_id" type="hidden" id="news_id" value="<?php echo $row_Recnews['news_id']; ?>">
              <input type="button" name="Submit4" value="回上一页" onClick="window.history.back();">  </form></td>
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
mysql_free_result($Recnews);
?>
