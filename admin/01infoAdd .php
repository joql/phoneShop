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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO info (info_time, classname, smallclassname, info_title, info_editor, info_photo,info_photo1,info_photo2, info_top, info_flash, info_content) VALUES (%s, %s, %s, %s, %s, %s,%s,%s, %s, %s, %s)",
                       GetSQLValueString($_POST['info_time'], "date"),
                       GetSQLValueString($_POST['classname'], "text"),
                       GetSQLValueString($_POST['smallclassname'], "text"),
                       GetSQLValueString($_POST['info_title'], "text"),
                       GetSQLValueString($_POST['info_editor'], "text"),
                       GetSQLValueString($_POST['rePic'], "text"),
					   GetSQLValueString($_POST['rePic2'], "text"),
					   GetSQLValueString($_POST['rePic3'], "text"),
                       GetSQLValueString($_POST['info_top'], "int"),
                       GetSQLValueString($_POST['info_flash'], "int"),
                       GetSQLValueString($_POST['info_content'], "text"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($insertSQL, $connch21) or die(mysql_error());

  $insertGoTo = "infoAdmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_connch21, $connch21);
$query_Recclass = "SELECT * FROM bigclass ORDER BY classnum ASC";
$Recclass = mysql_query($query_Recclass, $connch21) or die(mysql_error());
$row_Recclass = mysql_fetch_assoc($Recclass);
$totalRows_Recclass = mysql_num_rows($Recclass);

mysql_select_db($database_connch21, $connch21);
$query_Recsmallclass = "SELECT * FROM smallclass";
$Recsmallclass = mysql_query($query_Recsmallclass, $connch21) or die(mysql_error());
$row_Recsmallclass = mysql_fetch_assoc($Recsmallclass);
$totalRows_Recsmallclass = mysql_num_rows($Recsmallclass);
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
                <td><font color="#FF0000" size="3"><strong>新增信息</strong></font> 
                  <hr size="1" noshade> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" style="margin=0px;">
                       <table width="100%" border="0" cellspacing="1" cellpadding="2">
                            <tr> 
                              <td width="42" align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日期：</font></strong></td>
                              <td colspan="3" valign="top"><font size="2"> 
                                <input name="info_time" type="text" id="info_time" value="<?php echo date("Y-m-d") ?>">
                              </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">信息名称：</font></strong></td>
                              <td colspan="3" valign="top"><font size="2"> 
                                <input name="info_title" type="text" id="info_title">
                                </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">信息大别：</font></strong></td>
                              <td valign="top">
                              <select name="classname">
                                <?php
do {  
?>
                                <option value="<?php echo $row_Recclass['classname']?>"><?php echo $row_Recclass['classname']?></option>
                                <?php
} while ($row_Recclass = mysql_fetch_assoc($Recclass));
  $rows = mysql_num_rows($Recclass);
  if($rows > 0) {
      mysql_data_seek($Recclass, 0);
	  $row_Recclass = mysql_fetch_assoc($Recclass);
  }
?>
                              </select>
                                
                              </td>
                              <td valign="top">信息小类</td>
                              <td valign="top"><select name="smallclassname">
                                <?php
do {  
?>
                                <option value="<?php echo $row_Recsmallclass['smallclassname']?>"><?php echo $row_Recsmallclass['smallclassname']?></option>
                                <?php
} while ($row_Recsmallclass = mysql_fetch_assoc($Recsmallclass));
  $rows = mysql_num_rows($Recsmallclass);
  if($rows > 0) {
      mysql_data_seek($Recsmallclass, 0);
	  $row_Recsmallclass = mysql_fetch_assoc($Recsmallclass);
  }
?>
                              </select></td>
                            </tr>                            
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">首页显示：</font></strong></td>
                              <td width="250" valign="top"><font size="2"> 
                                <input name="info_top" type="radio" value="1" checked>
                                是
                                <input name="info_top" type="radio" value="0">
否 </font></td>
                              <td width="73" valign="top">是否幻灯</td>
                              <td width="222" valign="top"> <input name="info_flash" type="radio" value="1" checked>
                                是
                                <input name="info_flash" type="radio" value="0">
否</td>
                            </tr>
                            <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">内容：</font></strong></td>
                              <td colspan="3" valign="top"> 
                                <textarea name="info_content" rows="1" cols="20" id="info_content" style="width:550px; height:300px;"></textarea>
                                <script type="text/javascript">
										var editor = UE.getEditor('info_content');
								</script>
                              </td>
                            </tr>
                            <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片：</font></strong></td>
                              <td colspan="3" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg" id="showImg" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic','fileUpload','width=400,height=180')">
                            <input name="rePic" type="hidden" id="rePic" size="4"></td></tr>
                              
                           <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片2：</font></strong></td>
                              <td colspan="3" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg2" id="showImg2" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg2&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic2','fileUpload','width=400,height=180')">
                            <input name="rePic2" type="hidden" id="rePic2" size="4"></td></tr>
                           <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片3：</font></strong></td>
                              <td colspan="3" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg3" id="showImg3" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg3&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic3','fileUpload','width=400,height=180')">
                            <input name="rePic3" type="hidden" id="rePic3" size="4"></td></tr>                              
                              
                           <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">发布人：<br>
                                </font></strong></td>
                              <td colspan="3" valign="top"> <font size="2">
                                <input name="info_editor" type="text" id="info_editor">
                            </font></td></tr>  
                              
                          </table>    
                          <input type="submit" name="Submit2" value="递交">
                          <input type="reset" name="Submit3" value="重设">
                          <input type="button" name="Submit4" value="回上一页" onClick="window.history.back();">
                          <input type="hidden" name="MM_insert" value="form1">
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

mysql_free_result($Recsmallclass);
?>
