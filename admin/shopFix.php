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
  $updateSQL = sprintf("UPDATE shop SET info_time=%s, classname=%s, smallclassname=%s, xx_smallclass=%s, info_title=%s, info_jg=%s, info_gg=%s, info_editor=%s, info_photo=%s, info_top=%s, info_flash=%s, info_content=%s, cp_je=%s, px=%s WHERE info_id=%s",
                       GetSQLValueString($_POST['info_time'], "date"),
                       GetSQLValueString($_POST['classname'], "text"),
                       GetSQLValueString($_POST['smallclassname'], "text"),
                       GetSQLValueString($_POST['xx_smallclass'], "text"),
                       GetSQLValueString($_POST['info_title'], "text"),
                       GetSQLValueString($_POST['info_jg'], "text"),
                       GetSQLValueString($_POST['info_gg'], "text"),
                       GetSQLValueString($_POST['info_editor'], "text"),
                       GetSQLValueString($_POST['rePic'], "text"),
                       GetSQLValueString($_POST['info_top'], "int"),
                       GetSQLValueString($_POST['info_flash'], "int"),
                       GetSQLValueString($_POST['info_content'], "text"),
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['px'], "int"),
                       GetSQLValueString($_POST['info_id'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($updateSQL, $connch21) or die(mysql_error());

  $updateGoTo = "shopAdmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

/* if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE info SET info_time=%s, classname=%s, smallclassname=%s, xx_smallclass=%s, info_title=%s, info_editor=%s, info_photo=%s, info_photo1=%s, info_photo2=%s, info_top=%s, info_flash=%s, info_content=%s, cp_je=%s WHERE info_id=%s",
                       GetSQLValueString($_POST['info_time'], "date"),
                       GetSQLValueString($_POST['classname'], "text"),
                       GetSQLValueString($_POST['smallclassname'], "text"),
                       GetSQLValueString($_POST['xx_smallclass'], "text"),
                       GetSQLValueString($_POST['info_title'], "text"),
                       GetSQLValueString($_POST['info_editor'], "text"),
                       GetSQLValueString($_POST['rePic'], "text"),
                       GetSQLValueString($_POST['rePic2'], "text"),
                       GetSQLValueString($_POST['rePic3'], "text"),
                       GetSQLValueString($_POST['info_top'], "int"),
                       GetSQLValueString($_POST['info_flash'], "int"),
                       GetSQLValueString($_POST['info_content'], "text"),
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['info_id'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($updateSQL, $connch21) or die(mysql_error());

  $updateGoTo = "infoAdmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
} */

$colname_Recinfo = "-1";
if (isset($_GET['info_id'])) {
  $colname_Recinfo = $_GET['info_id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recinfo = sprintf("SELECT * FROM shop WHERE info_id = %s", GetSQLValueString($colname_Recinfo, "int"));
$Recinfo = mysql_query($query_Recinfo, $connch21) or die(mysql_error());
$row_Recinfo = mysql_fetch_assoc($Recinfo);
$totalRows_Recinfo = mysql_num_rows($Recinfo);

mysql_select_db($database_connch21, $connch21);
$query_Recclass = "SELECT * FROM bigclass ORDER BY classnum ASC";
$Recclass = mysql_query($query_Recclass, $connch21) or die(mysql_error());
$row_Recclass = mysql_fetch_assoc($Recclass);
$totalRows_Recclass = mysql_num_rows($Recclass);

mysql_select_db($database_connch21, $connch21);
$query_Recsmallclass = "SELECT * FROM smallclass where smallclassname <> '会员展示'";
$Recsmallclass = mysql_query($query_Recsmallclass, $connch21) or die(mysql_error());
$row_Recsmallclass = mysql_fetch_assoc($Recsmallclass);
$totalRows_Recsmallclass = mysql_num_rows($Recsmallclass);

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM xx_smallclass";
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_connch21, $connch21);
$query_Rec_zhxg = "SELECT * FROM zx_xx_smallclass ORDER BY x_num ASC";
$Rec_zhxg = mysql_query($query_Rec_zhxg, $connch21) or die(mysql_error());
$row_Rec_zhxg = mysql_fetch_assoc($Rec_zhxg);
$totalRows_Rec_zhxg = mysql_num_rows($Rec_zhxg);
?>
<html>
<head>
<title>经典案例信息修改</title>
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

<SCRIPT LANGUAGE="JavaScript">    
<!--//    
function textCounter(field, countfield, maxlimit) {    
// 函数，3个参数，表单名字，表单域元素名，限制字符；    
if (field.value.length > maxlimit)    
//如果元素区字符数大于最大字符数，按照最大字符数截断；    
fieldfield.value = field.value.substring(0, maxlimit);    
else    
//在记数区文本框内显示剩余的字符数；    
countfield.value = maxlimit - field.value.length;    
}    
//-->    
</SCRIPT>

<script type="text/javascript">  

function openwindow(url,name,iWidth,iHeight)  
{  
// url 转向网页的地址   
// name 网页名称，可为空   
// iWidth 弹出窗口的宽度   
// iHeight 弹出窗口的高度   
//window.screen.height获得屏幕的高，window.screen.width获得屏幕的宽   
var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;   
var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;   
window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');  
}  

</script>  


</head>
<body bgcolor="#ffffff">
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
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
                <td><font color="#FF0000" size="3"><strong>修改经典案例信息</strong></font> 
                  <hr size="1" noshade> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" style="margin=0px;">
                          <table  width="100%" border="0" cellspacing="1" cellpadding="0">
                            <tr> 
                              <td width="109" align="center" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日期：</font></strong></td>
                              <td colspan="7" valign="top"><font size="2"> 
                                <input name="info_time" type="text" id="info_time" value="<?php echo $row_Recinfo['info_time']; ?>">
                                <input name="info_id" type="hidden" id="info_id" value="<?php echo $row_Recinfo['info_id']; ?>">
                              </font></td>
                            </tr>
                            <tr> 
                              <td align="center" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">信息名称:</font></strong></td>
                              <td colspan="7" valign="top"><font size="2"> 
                                <input name="info_title" type="text" id="info_title" value="<?php echo $row_Recinfo['info_title']; ?>">
                                </font></td>
                            </tr>                            
                            <tr> 
                              <td align="center" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">首页显示:</font></strong></td>
                              <td width="95" valign="top"><font size="2"> 
                                <input    <?php if (!(strcmp($row_Recinfo['info_top'],"1"))) {echo "checked=\"checked\"";} ?> name="info_top" type="radio" value="1"  >
                                是
                                <input    <?php if (!(strcmp($row_Recinfo['info_top'],"0"))) {echo "checked=\"checked\"";} ?> name="info_top" type="radio" value="0">
否 </font></td>
<td width="112" align="right" valign="top">是否幻灯:</td>
                              <td width="111" valign="top"> <input <?php if (!(strcmp($row_Recinfo['info_flash'],"1"))) {echo "checked=\"checked\"";} ?> name="info_flash" type="radio" value="1" >
                                是
                                <input <?php if (!(strcmp($row_Recinfo['info_flash'],"0"))) {echo "checked=\"checked\"";} ?> name="info_flash" type="radio" value="0">
否</td>
                              <td width="129" valign="top">&nbsp;</td>
                              <td width="58" valign="top">&nbsp;</td>
                              <td width="137" valign="top">&nbsp;</td>
                              <td width="48" valign="top">&nbsp;</td>
                            </tr>
                           
                           <tr>
                              <td align="center" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">产品简介:</font></strong></td>
                              <td colspan="7" valign="top"><textarea name="message" cols="35" rows="4" id="message" 
onKeyDown="textCounter(this.form.message,this.form.remLen,200);"
 onKeyUp="textCounter(this.form.message,
this.form.remLen,200);"><?php echo $row_Recinfo['cp_je']; ?></textarea> 
  您还可以输入:<input name="remLen" type="text" 
value="200" size="5" readonly>
  个字符 </td>
                            </tr>
                           
                            <tr> 
                              <td align="center" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">信息信息:</font></strong></td>
                              <td colspan="7" valign="top"> 
                                <textarea name="info_content" rows="1" cols="20" id="info_content" style="width:550px; height:300px;"><?php echo $row_Recinfo['info_content']; ?></textarea>
	<script type="text/javascript">
										var editor = UE.getEditor('info_content');
								</script>
                              </td>
                            </tr>
                            
                             <tr> 
                              <td align="center" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2"><font color="#FF0000" size="2">*&nbsp;</font>封面图片:</font></strong></td>
                              <td id="a" colspan="7" valign="top">&nbsp;<img src="../images/<?php echo $row_Recinfo['info_photo']; ?>"  width="100px" "alt="这是显示上传预览图片的位置" name="showImg" id="showImg" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <?php /*start db_input script*/ if ($row_Recinfo['info_photo'] == ""){ ?>
                                 
                                  
                 <input type="button" name="Submit" value="上传图片" onClick="javascript:openwindow('fupload.php?useForm=form1&amp;prevImg=showImg&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic','fileUpload',400,180)">                   
                                  
                                  
                                  <?php } /*end db_input script*/ ?>

 <?php /*start db_input script*/ if ($row_Recinfo['info_photo'] != ""){ ?>
  <input type="button" name="Submit" value="更换图片" onClick="javascript:openwindow('fupload.php?useForm=form1&amp;prevImg=showImg&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic','fileUpload',400,180)">    <?php } /*end db_input script*/ ?>
                                
                                
                            <input name="rePic" type="hidden" id="rePic" value="<?php echo $row_Recinfo['info_photo']; ?>" size="4"></td></tr>
                          
                          
                          
                          
                          
                          
                       <!--
                           <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片2：</font></strong></td>
                              <td id="a" colspan="7" valign="top">&nbsp;<?php /*start db_input script*/ if ($row_Recinfo['info_photo1'] != ""){ ?><img src="../images/<?php echo $row_Recinfo['info_photo1']; ?>" width="100px" alt="这是显示上传预览图片的位置" name="showImg2" id="showImg2" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                  <?php } /*end db_input script*/ ?>
                 
                                <?php /*start db_input script*/ if ($row_Recinfo['info_photo1'] == ""){ ?>
                                    <img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg2" id="showImg2" width="60px" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <?php } /*end db_input script*/ ?>
             <?php /*start db_input script*/ if ($row_Recinfo['info_photo1'] == ""){ ?>                        
<input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg2&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic2','fileUpload','width=0px,height=0px')"> <?php } /*end db_input script*/ ?>

<?php /*start db_input script*/ if ($row_Recinfo['info_photo1'] != ""){ ?> 
<input type="button" name="Submit" value="更换图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg2&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic2','fileUpload','width=0px,height=0px')"> <?php } /*end db_input script*/ ?>

                            <input name="rePic2" type="hidden" id="rePic2" value="<?php echo $row_Recinfo['info_photo1']; ?>" size="4"></td></tr>   
                            <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片3：</font></strong></td>
                              <td id="a" colspan="7" valign="top">&nbsp;<?php /*start db_input script*/ if ($row_Recinfo['info_photo2'] != ""){ ?><img src="../images/<?php echo $row_Recinfo['info_photo2']; ?>" width="100px" alt="这是显示上传预览图片的位置" name="showImg3" id="showImg3" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                              <?php } /*end db_input script*/ ?>
                               
                                <?php /*start db_input script*/ if ($row_Recinfo['info_photo2'] == ""){ ?>
                                    <img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg3" id="showImg3" width="60px" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <?php } /*end db_input script*/ ?>
                               <?php /*start db_input script*/ if ($row_Recinfo['info_photo2'] == ""){ ?> <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg3&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic3','fileUpload','width=0px,height=0px')"><?php } /*end db_input script*/ ?>
                            
                              <?php /*start db_input script*/ if ($row_Recinfo['info_photo2'] != ""){ ?><input type="button" name="Submit" value="更换图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg3&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic3','fileUpload','width=0px,height=0px')">  <?php } /*end db_input script*/ ?> 
                                
                            <input name="rePic3" type="hidden" id="rePic3" value="<?php echo $row_Recinfo['info_photo2']; ?>" size="4"></td></tr>
                            
                            
                          
                     <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片4：</font></strong></td>
                              <td id="a" colspan="7" valign="top">&nbsp;<?php /*start db_input script*/ if ($row_Recinfo['info_photo3'] != ""){ ?><img src="../images/<?php echo $row_Recinfo['info_photo3']; ?>" width="100px" alt="这是显示上传预览图片的位置" name="showImg4" id="showImg4" onClick='javascript:alert("这是显示上传预览图片的位置");'><?php } /*end db_input script*/ ?>
                               <?php /*start db_input script*/ if ($row_Recinfo['info_photo3'] == ""){ ?>
                                    <img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg4" id="showImg4" width="60px" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <?php } /*end db_input script*/ ?>
                                
                                <?php /*start db_input script*/ if ($row_Recinfo['info_photo3'] == ""){ ?>  <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg4&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic4','fileUpload','width=0px,height=0px')"><?php } /*end db_input script*/ ?>
                                
                                <?php /*start db_input script*/ if ($row_Recinfo['info_photo3'] != ""){ ?> <input type="button" name="Submit" value="更换图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg4&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic4','fileUpload','width=0px,height=0px')"><?php } /*end db_input script*/ ?>
                                
                            <input name="rePic4" type="hidden" id="rePic4" value="<?php echo $row_Recinfo['info_photo3']; ?>" size="4"></td></tr>     
                          
                         <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片5：</font></strong></td>
                              <td id="a" colspan="7" valign="top">&nbsp;<?php /*start db_input script*/ if ($row_Recinfo['info_photo4'] != ""){ ?><img src="../images/<?php echo $row_Recinfo['info_photo4']; ?>" width="100px" alt="这是显示上传预览图片的位置" name="showImg5" id="showImg5" onClick='javascript:alert("这是显示上传预览图片的位置");'><?php } /*end db_input script*/ ?>
							  <?php /*start db_input script*/ if ($row_Recinfo['info_photo4'] == ""){ ?>
                                    <img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg5" id="showImg5" width="60px" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <?php } /*end db_input script*/ ?>
                               <?php /*start db_input script*/ if ($row_Recinfo['info_photo4'] == ""){ ?> <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg5&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic5','fileUpload','width=0px,height=0px')"> <?php } /*end db_input script*/ ?>
                  <?php /*start db_input script*/ if ($row_Recinfo['info_photo4'] != ""){ ?> <input type="button" name="Submit" value="更换图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg5&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic5','fileUpload','width=0px,height=0px')"> <?php } /*end db_input script*/ ?>
                               
                            <input name="rePic5" type="hidden" id="rePic5" value="<?php echo $row_Recinfo['info_photo4']; ?>" size="4"></td></tr>   
                            
                       
                    -->   
                       
                       
                       
                       
                       
                            
                           <tr> 
                              <td align="center" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">发布人：<br>
                                </font></strong></td>
                              <td colspan="7" valign="top"> <font size="2">
                                <input name="info_editor" type="text" id="info_editor" value="<?php echo $row_Recinfo['info_editor']; ?>">
                            </font></td></tr>  
                              
                          </table>
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
mysql_free_result($Recinfo);

mysql_free_result($Recclass);

mysql_free_result($Recsmallclass);

mysql_free_result($Recordset1);

mysql_free_result($Rec_zhxg);
?>
<?php mysql_close($connch21);?>