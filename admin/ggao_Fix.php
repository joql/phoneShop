
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
  $updateSQL = sprintf("UPDATE guanggao SET `time`=%s, gg_photo1=%s, gg_photo2=%s, gg_photo3=%s, gg_photo4=%s, gg_photo5=%s, gg_photo6=%s, gg_photo7=%s, gg_photo8=%s, title=%s, ms01=%s, ms02=%s, ms03=%s, ms04=%s, ms05=%s, ms06=%s, ms07=%s, ms08=%s, url1=%s, url2=%s, url3=%s, url4=%s, url5=%s, url6=%s, url7=%s, url8=%s, name=%s WHERE id=%s",
                       GetSQLValueString($_POST['info_time'], "date"),
                       GetSQLValueString($_POST['rePic'], "text"),
                       GetSQLValueString($_POST['rePic2'], "text"),
                       GetSQLValueString($_POST['rePic3'], "text"),
                       GetSQLValueString($_POST['rePic4'], "text"),
                       GetSQLValueString($_POST['rePic5'], "text"),
                       GetSQLValueString($_POST['rePic6'], "text"),
                       GetSQLValueString($_POST['rePic7'], "text"),
                       GetSQLValueString($_POST['rePic8'], "text"),
                       GetSQLValueString($_POST['info_title'], "text"),
                       GetSQLValueString($_POST['ms01'], "text"),
                       GetSQLValueString($_POST['ms02'], "text"),
                       GetSQLValueString($_POST['ms03'], "text"),
                       GetSQLValueString($_POST['ms04'], "text"),
                       GetSQLValueString($_POST['ms05'], "text"),
                       GetSQLValueString($_POST['ms06'], "text"),
                       GetSQLValueString($_POST['ms07'], "text"),
                       GetSQLValueString($_POST['ms08'], "text"),
                       GetSQLValueString($_POST['url1'], "text"),
                       GetSQLValueString($_POST['url2'], "text"),
                       GetSQLValueString($_POST['url3'], "text"),
                       GetSQLValueString($_POST['url4'], "text"),
                       GetSQLValueString($_POST['url5'], "text"),
                       GetSQLValueString($_POST['url6'], "text"),
                       GetSQLValueString($_POST['url7'], "text"),
                       GetSQLValueString($_POST['url8'], "text"),
                       GetSQLValueString($_POST['info_editor'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($updateSQL, $connch21) or die(mysql_error());

  $updateGoTo = "ggao_Admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Rec_ggao = "-1";
if (isset($_GET['id'])) {
  $colname_Rec_ggao = $_GET['id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao = sprintf("SELECT * FROM guanggao WHERE id = %s", GetSQLValueString($colname_Rec_ggao, "int"));
$Rec_ggao = mysql_query($query_Rec_ggao, $connch21) or die(mysql_error());
$row_Rec_ggao = mysql_fetch_assoc($Rec_ggao);
$totalRows_Rec_ggao = mysql_num_rows($Rec_ggao);$colname_Rec_ggao = "-1";
if (isset($_GET['id'])) {
  $colname_Rec_ggao = $_GET['id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao = sprintf("SELECT * FROM guanggao WHERE id = %s", GetSQLValueString($colname_Rec_ggao, "int"));
$Rec_ggao = mysql_query($query_Rec_ggao, $connch21) or die(mysql_error());
$row_Rec_ggao = mysql_fetch_assoc($Rec_ggao);
$totalRows_Rec_ggao = mysql_num_rows($Rec_ggao);
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
table #3a { border-collapse:collapse;
	
	}
table #3a td { border:1px solid #FFF;
	}
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
</head>
<body bgcolor="#ffffff">
<table width="910" border="0" align="center" cellpadding="0" cellspacing="0">
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
                <td><font color="#FF0000" size="3"><strong>修改信息信息</strong></font> 
                  <hr size="1" noshade> <table width="100%" border="0" cellspacing="0" cellpadding="0" id="3a">
                    <tr> 
                      <td><form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" style="margin=0px;">
                          <table  width="100%" border="0" cellspacing="1" cellpadding="0">
                            <tr> 
                              <td width="77" align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日期：</font></strong></td>
                              <td colspan="2" valign="top"><font size="2"> 
                                <input name="info_time" type="text" id="info_time" value="<?php echo $row_Rec_ggao['time']; ?>">
                                <input name="id" type="hidden" id="id" value="<?php echo $row_Rec_ggao['id']; ?>">
                              </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">信息名称：</font></strong></td>
                              <td width="209" valign="top"><font size="2"> 
                                <input name="info_title" type="text" id="info_title" value="<?php echo $row_Rec_ggao['title']; ?>" readonly>
                                </font></td>
                              <td width="428" valign="top">图片规格：
                                <label for="guige"></label>
                              <input name="guige" type="text" id="guige" value="<?php echo $row_Rec_ggao['guige']; ?>" size="16" readonly>
                              px.（小于400k）</td>
                            </tr>
                            <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片：</font></strong></td>
                              <td colspan="2" valign="top" id="a">&nbsp;
                                <p><img src="../images/<?php echo $row_Rec_ggao['gg_photo1']; ?>"  width="250" alt="这是显示上传预览图片的位置" name="showImg" id="showImg" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                  <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic','fileUpload','width=0px,height=0px')">
                                  <input name="rePic" type="hidden" id="rePic" value="<?php echo $row_Rec_ggao['gg_photo1']; ?>" size="4">
                                 
                                </p>
                                
                           <p> 描述1：
                                  <label for="ms01"></label>
                                <input name="ms01" type="text" id="ms01" value="<?php echo $row_Rec_ggao['ms01']; ?>" size="50"></p>     
                            <p>链接1：
                                <label for="url1"></label>
                            <input name="url1" type="text" id="url1" value="<?php echo $row_Rec_ggao['url1']; ?>" size="50">
                            （http://）
                            </p></td></tr>
                            <?php /*start db_input script*/ if ($row_Rec_ggao['gg_photo2'] != ""){ ?>
                              <tr>
                                <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片2：</font></strong></td>
                                <td colspan="2" valign="top" id="a">&nbsp;
                                  <p><img src="../images/<?php echo $row_Rec_ggao['gg_photo2']; ?>" width="250px" alt="这是显示上传预览图片的位置" name="showImg2" id="showImg2" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg2&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic2','fileUpload','width=0px,height=0px')">
                                    <input name="rePic2" type="hidden" id="rePic2" value="<?php echo $row_Rec_ggao['gg_photo2']; ?>" size="4">
                                  </p>
                                  <p> 描述2：
                                  <label for="ms02"></label>
                                <input name="ms02" type="text" id="ms02" value="<?php echo $row_Rec_ggao['ms02']; ?>" size="50"></p>    
                                  
                                  <p> 链接2：
                                    <label for="url2"></label>
                                    <input name="url2" type="text" id="url2" value="<?php echo $row_Rec_ggao['url2']; ?>" size="50">
                                    （http://）</p></td>
                              </tr>
                              <?php } /*end db_input script*/ ?>
                            <?php /*start db_input script*/ if ($row_Rec_ggao['gg_photo3'] != ""){ ?>
                              <tr>
                                <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片3：</font></strong></td>
                                <td colspan="2" valign="top" id="a">&nbsp;
                                  <p><img src="../images/<?php echo $row_Rec_ggao['gg_photo3']; ?>" width="250px" alt="这是显示上传预览图片的位置" name="showImg3" id="showImg3" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg3&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic3','fileUpload','width=0px,height=0px')">
                                    <input name="rePic3" type="hidden" id="rePic3" value="<?php echo $row_Rec_ggao['gg_photo3']; ?>" size="4">
                                  </p>
                                  
                                  <p> 描述3：
                                  <label for="ms03"></label>
                                <input name="ms03" type="text" id="ms03" value="<?php echo $row_Rec_ggao['ms03']; ?>" size="50"></p>     
                                  <p>链接3：
                                    <label for="url3"></label>
                                    <input name="url3" type="text" id="url3" value="<?php echo $row_Rec_ggao['url3']; ?>" size="50">
                                    （http://）</p></td>
                              </tr>
                              <?php } /*end db_input script*/ ?>
                            <?php /*start db_input script*/ if ($row_Rec_ggao['gg_photo4'] != ""){ ?>
                              <tr>
                                <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片4：</font></strong></td>
                                <td colspan="2" valign="top" id="a">&nbsp;
                                  <p><img src="../images/<?php echo $row_Rec_ggao['gg_photo4']; ?>" width="250px" alt="这是显示上传预览图片的位置" name="showImg4" id="showImg4" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg4&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic4','fileUpload','width=0px,height=0px')">
                                    <input name="rePic4" type="hidden" id="rePic4" value="<?php echo $row_Rec_ggao['gg_photo4']; ?>" size="4">
                                  </p>
                                  
                                  <p> 描述4：
                                  <label for="ms04"></label>
                                <input name="ms04" type="text" id="ms04" value="<?php echo $row_Rec_ggao['ms04']; ?>" size="50"></p>     
                                  
                                  <p>链接4：
                                    <label for="url4"></label>
                                    <input name="url4" type="text" id="url4" value="<?php echo $row_Rec_ggao['url4']; ?>" size="50">
                                    （http://）</p></td>
                              </tr>
                              <?php } /*end db_input script*/ ?>
                            
							
							
							
							
							
							
							
							
							
							
							
							
							<?php /*start db_input script*/ if ($row_Rec_ggao['gg_photo5'] != ""){ ?>
                              <tr> 
                                <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片5：</font></strong></td>
                                <td colspan="2" valign="top" id="a">&nbsp;
                                  <p><img src="../images/<?php echo $row_Rec_ggao['gg_photo5']; ?>" width="250px" alt="这是显示上传预览图片的位置" name="showImg5" id="showImg5" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg5&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic5','fileUpload','width=0px,height=0px')">
                                    <input name="rePic5" type="hidden" id="rePic5" value="<?php echo $row_Rec_ggao['gg_photo5']; ?>" size="4">
                                  </p>
                                  
                                  <p> 描述5：
                                  <label for="ms05"></label>
                                <input name="ms05" type="text" id="ms05" value="<?php echo $row_Rec_ggao['ms05']; ?>" size="50"></p>     
                                  
                                  <p>链接5：
                                    <label for="url5"></label>
                                    <input name="url5" type="text" id="url5" value="<?php echo $row_Rec_ggao['url5']; ?>" size="50">
                              （http://）</p></td></tr>
                              <?php } /*end db_input script*/ ?>
                           
                           
                           
                           
                           
                           
                           
                  <!--6-->         
           <?php /*start db_input script*/ if ($row_Rec_ggao['gg_photo6'] != ""){ ?>
                              <tr> 
                                <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片6：</font></strong></td>
                                <td colspan="2" valign="top" id="a">&nbsp;
                                  <p><img src="../images/<?php echo $row_Rec_ggao['gg_photo6']; ?>" width="250px" alt="这是显示上传预览图片的位置" name="showImg6" id="showImg6" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg6&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic6','fileUpload','width=0px,height=0px')">
                                    <input name="rePic6" type="hidden" id="rePic6" value="<?php echo $row_Rec_ggao['gg_photo6']; ?>" size="4">
                                  </p>
                                  
                                  <p> 描述6：
                                  <label for="ms06"></label>
                                <input name="ms06" type="text" id="ms06" value="<?php echo $row_Rec_ggao['ms06']; ?>" size="50"></p>     
                                  <p>链接6：
                                    <label for="url6"></label>
                                    <input name="url6" type="text" id="url6" value="<?php echo $row_Rec_ggao['url6']; ?>" size="50">
                              （http://）</p></td></tr>
                              <?php } /*end db_input script*/ ?>                
             
             
             
             
             
             
             
                          
                  <!--7-->         
           <?php /*start db_input script*/ if ($row_Rec_ggao['gg_photo7'] != ""){ ?>
                              <tr> 
                                <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片7：</font></strong></td>
                                <td colspan="2" valign="top" id="a">&nbsp;
                                  <p><img src="../images/<?php echo $row_Rec_ggao['gg_photo7']; ?>" width="250px" alt="这是显示上传预览图片的位置" name="showImg7" id="showImg7" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg7&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic7','fileUpload','width=0px,height=0px')">
                                    <input name="rePic7" type="hidden" id="rePic7" value="<?php echo $row_Rec_ggao['gg_photo7']; ?>" size="4">
                                  </p>
                                  
                                  <p> 描述7：
                                  <label for="ms07"></label>
                                <input name="ms07" type="text" id="ms07" value="<?php echo $row_Rec_ggao['ms07']; ?>" size="50"></p>     
                                  <p>链接7：
                                    <label for="url7"></label>
                                    <input name="url7" type="text" id="url7" value="<?php echo $row_Rec_ggao['url7']; ?>" size="50">
                              （http://）</p></td></tr>
                              <?php } /*end db_input script*/ ?>                
                           
                           
                           
                           
                           
        
        
        
         <!--8-->         
           <?php /*start db_input script*/ if ($row_Rec_ggao['gg_photo8'] != ""){ ?>
                              <tr> 
                                <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片8：</font></strong></td>
                                <td colspan="2" valign="top" id="a">&nbsp;
                                  <p><img src="../images/<?php echo $row_Rec_ggao['gg_photo8']; ?>" width="250px" alt="这是显示上传预览图片的位置" name="showImg8" id="showImg8" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                    <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg8&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic8','fileUpload','width=0px,height=0px')">
                                    <input name="rePic8" type="hidden" id="rePic8" value="<?php echo $row_Rec_ggao['gg_photo8']; ?>" size="4">
                                  </p>
                                  <p> 描述8：
                                  <label for="ms08"></label>
                                <input name="ms08" type="text" id="ms08" value="<?php echo $row_Rec_ggao['ms08']; ?>" size="50"></p>     
                                  
                                  <p>链接8：
                                    <label for="url8"></label>
                                    <input name="url8" type="text" id="url8" value="<?php echo $row_Rec_ggao['url8']; ?>" size="50">
                              （http://）</p></td></tr>
                              <?php } /*end db_input script*/ ?>                
        
        
        
        
        
        
        
        
                           
                           
                           
                           
                           
                            <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">发布人：<br>
                              </font></strong></td>
                              <td colspan="2" valign="top"> <font size="2">
                                <input name="info_editor" type="text" id="info_editor" value="<?php echo $row_Rec_ggao['name']; ?>">
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
mysql_free_result($Rec_ggao);
?>
<?php mysql_close($connch21);?>