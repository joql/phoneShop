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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE news SET news_time=%s, news_title=%s, news_editor=%s, news_photo=%s, news_photo1=%s, news_photo2=%s, news_top=%s, news_content=%s, quyu=%s, `number`=%s WHERE news_id=%s",
                       GetSQLValueString($_POST['news_time'], "date"),
                       GetSQLValueString($_POST['news_title'], "text"),
                       GetSQLValueString($_POST['news_editor'], "text"),
                       GetSQLValueString($_POST['rePic'], "text"),
                       GetSQLValueString($_POST['rePic2'], "text"),
                       GetSQLValueString($_POST['rePic3'], "text"),
                       GetSQLValueString($_POST['news_top'], "int"),
                       GetSQLValueString($_POST['news_content'], "text"),
                       GetSQLValueString($_POST['quyu'], "int"),
                       GetSQLValueString($_POST['number'], "int"),
                       GetSQLValueString($_POST['news_id'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($updateSQL, $connch21) or die(mysql_error());

  $updateGoTo = "newsAdmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recnews = "-1";
if (isset($_GET['news_id'])) {
  $colname_Recnews = $_GET['news_id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recnews = sprintf("SELECT * FROM news WHERE news_id = %s", GetSQLValueString($colname_Recnews, "int"));
$Recnews = mysql_query($query_Recnews, $connch21) or die(mysql_error());
$row_Recnews = mysql_fetch_assoc($Recnews);
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
<title>广告管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="./ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="./ueditor/ueditor.all.js"></script>
<script type="text/javascript" charset="gbk" src="./ueditor/lang/zh-cn/zh-cn.js"></script>
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
                <td> 
                <?php include("nav_left.php");?>
                </td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td><font color="#FF0000" size="3"><strong>修改企业新闻</strong></font> 
                  <hr size="1" noshade> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" style="margin=0px;">
                          <table width="100%" border="0" cellspacing="1" cellpadding="2">
                            <tr> 
                              <td width="24" align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日期：</font></strong></td>
                              <td colspan="5" valign="top"><font size="2"> 
                                <input name="news_time" type="text" id="news_time" value="<?php echo $row_Recnews['news_time']; ?>">
                                <input name="news_id" type="hidden" id="news_id" value="<?php echo $row_Recnews['news_id']; ?>">
                              </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">标题：</font></strong></td>
                              <td colspan="5" valign="top"><font size="2"> 
                                <input name="news_title" type="text" id="news_title" value="<?php echo $row_Recnews['news_title']; ?>">
                                </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">首页推荐：</font></strong></td>
                              <td width="145" valign="top"> 
                                <input <?php if (!(strcmp($row_Recnews['news_top'],"1"))) {echo "checked=\"checked\"";} ?> name="news_top" type="radio" value="1" checked>
                                是
                                <input <?php if (!(strcmp($row_Recnews['news_top'],"0"))) {echo "checked=\"checked\"";} ?> name="news_top" type="radio" value="0">
否  </td>
                              <td width="63" valign="top">大分类:</td>
                              <td width="96" valign="top">  <select name="quyu" size="1" id="quyu">
                                <option selected="selected" value="0" <?php if (!(strcmp("默认区", $row_Recnews['quyu']))) {echo "selected=\"selected\"";} ?>>默认区</option>
                               
                                <option value="2" <?php if (!(strcmp(2, $row_Recnews['quyu']))) {echo "selected=\"selected\"";} ?>>手册指导</option>
                                
                                </select></td>
                              <td width="91" valign="top">小分类:</td>
                              <td width="158" valign="top"><select name="number" size="1" id="number">
                                <option value="0" selected="SELECTED" <?php if (!(strcmp("", $row_Recnews['number']))) {echo "selected=\"selected\"";} ?>>默认区</option>
                                <option value="1" <?php if (!(strcmp(1, $row_Recnews['number']))) {echo "selected=\"selected\"";} ?>>家具知识大全</option>
                                  
                              </select></td>
                            </tr>
                            <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">内容：</font></strong></td>
                              <td colspan="5" valign="top"> 
                                <textarea name="news_content" style="width:550px; height:300px;" rows="1" cols="20" id="news_content"><?php echo $row_Recnews['news_content']; ?></textarea></td>
                            </tr>
                           
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">发布人：<br>
                                </font></strong></td>
                              <td colspan="5" valign="top"> <font size="2">
                                 <input name="news_editor" type="text" id="news_editor" value="<?php echo $row_Recnews['news_editor']; ?>">
                            </font></td></tr>  
                              
                          </table>
                          <script type="text/javascript">
										var editor = UE.getEditor('news_content');
								</script>
<input type="submit" name="Submit2" value="递交">
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
mysql_free_result($Recnews);
?>
