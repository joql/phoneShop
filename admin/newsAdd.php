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
<?php require_once('../Connections/connch21.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO news (news_time, news_title, news_editor, news_photo, news_photo1, news_photo2, news_top, news_content, quyu, `number`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['news_time'], "date"),
                       GetSQLValueString($_POST['news_title'], "text"),
                       GetSQLValueString($_POST['news_editor'], "text"),
                       GetSQLValueString($_POST['rePic'], "text"),
                       GetSQLValueString($_POST['rePic2'], "text"),
                       GetSQLValueString($_POST['rePic3'], "text"),
                       GetSQLValueString($_POST['news_top'], "int"),
                       GetSQLValueString($_POST['news_content'], "text"),
                       GetSQLValueString($_POST['quyu'], "int"),
                       GetSQLValueString($_POST['number'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($insertSQL, $connch21) or die(mysql_error());

  $insertGoTo = "newsAdmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO news (news_time, news_title, news_editor, news_photo,news_photo1,news_photo2, news_top, news_content,quyu) VALUES (%s, %s,%s,%s,%s, %s, %s, %s,%s)",
                       GetSQLValueString($_POST['news_time'], "date"),
                       GetSQLValueString($_POST['news_title'], "text"),
                       GetSQLValueString($_POST['news_editor'], "text"),
                       GetSQLValueString($_POST['rePic'], "text"),
					   GetSQLValueString($_POST['rePic2'], "text"),
					   GetSQLValueString($_POST['rePic3'], "text"),
                       GetSQLValueString($_POST['news_top'], "int"),
                       GetSQLValueString($_POST['news_content'], "text"));

  echo $insertSQL;
  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($insertSQL, $connch21) or die(mysql_error());

  $insertGoTo = "newsAdmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
                <td><?php include("nav_left.php");?></td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td><font color="#FF0000" size="3"><strong>新增企业新闻</strong></font>
                  <hr size="1" noshade> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" style="margin=0px;">
                          <table width="100%" border="0" cellspacing="1" cellpadding="2">
                            <tr> 
                              <td width="24" align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日期：</font></strong></td>
                              <td colspan="5" valign="top"><font size="2"> 
                                <input name="news_time" type="text" id="news_time" value="<?php echo date("Y-m-d H:i:s") ?>">
                                </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">标题：</font></strong></td>
                              <td colspan="5" valign="top"><font size="2"> 
                                <input name="news_title" type="text" id="news_title">
                                </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">首页推荐：</font></strong></td>
                              <td width="118" valign="top"><font size="2"> 
                                <input name="news_top" type="radio" value="1" checked>
                                是
                                <input name="news_top" type="radio" value="0">
否 
<label for="number"></label>
                              </font></td>
                              <td width="59" valign="top">大分类:</td>
                              <td width="101" valign="top"><font size="2">
                                <select name="quyu" size="1" id="quyu">
                                  <option value="0" selected="SELECTED">行业资讯</option>
                                 
                                  <option value="2">手册指导</option>
                                 
                                </select>
                              </font></td>
                              <td width="89" valign="top">小分类:</td>
                              <td width="186" valign="top"><select name="number" size="1" id="number">
                                  <option value="0" selected="SELECTED">业内分析</option>
                                  <option value="1">业内动态</option>
                                  <option value="2">业内发展</option>
                              </select></td>
                            </tr>
                            <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">新闻内容：</font></strong></td>
                              <td colspan="5" valign="top"> 
                                <textarea name="news_content" style="width:550px; height:300px;" rows="1" cols="20" id="news_content"></textarea>
	<script type="text/javascript">
										var editor = UE.getEditor('news_content');
								</script>	
                                </td>
                            </tr>
                           
                              
                              
                           <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">发布人：<br>
                                </font></strong></td>
                              <td colspan="5" valign="top"> <font size="2">
                                 <input name="news_editor" type="text" id="news_editor">
                              </font></td></tr>  
                              
                          </table>
                          <input type="submit" name="Submit2" value="递交">
                          <input type="reset" name="Submit3" value="重设">
                          <input type="button" name="Submit4" value="回上一页" onClick="window.history.back();">
                          <input type="hidden" name="MM_insert" value="form1">
                         <p style="margin-top:5px">  <span style="font-size:12px; color:#F00; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：
                      如果是网上复制的文章，提交前请在编辑器里清除原文章格式，或转到html代码视图下，删除正文前第一段格式代码！</span></p> 
                      </form>  </td>
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