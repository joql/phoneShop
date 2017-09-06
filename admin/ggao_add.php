<?php require_once('../Connections/connch21.php'); ?>
<?php mysql_query("SET time_zone = '+8:00'") or die('时区设置失败，请联系管理员！');

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO guanggao (`time`, gg_photo1, gg_photo2, gg_photo3, gg_photo4, gg_photo5, gg_photo6, gg_photo7, gg_photo8, title, ms01, ms02, ms03, ms04, ms05, ms06, ms07, ms08, url1, url2, url3, url4, url5, url6, url7, url8, name, guige) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['guige'], "text"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($insertSQL, $connch21) or die(mysql_error());

  $insertGoTo = "ggao_Admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao = "SELECT * FROM guanggao";
$Rec_ggao = mysql_query($query_Rec_ggao, $connch21) or die(mysql_error());
$row_Rec_ggao = mysql_fetch_assoc($Rec_ggao);
$totalRows_Rec_ggao = mysql_num_rows($Rec_ggao);mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao = "SELECT * FROM guanggao";
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

#a img {
    max-width: 600px; 
    width:expression(this.width > 600 ? "600px" : this.width);
    overflow:hidden;
}  
table #3a { border-collapse:collapse;
	
	}
table #3a td { border:1px solid #FFF;
	}

</style>


<SCRIPT LANGUAGE="JavaScript">
<!--
//    
function textCounter(field, countfield, maxlimit) {    
// 函数，3个参数，表单名字，表单域元素名，限制字符；    
if (field.value.length > maxlimit)    
//如果元素区字符数大于最大字符数，按照最大字符数截断；    
fieldfield.value = field.value.substring(0, maxlimit);    
else    
//在记数区文本框内显示剩余的字符数；    
countfield.value = maxlimit - field.value.length;    
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.65
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(parseInt(myV))||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  if (myErr!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
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
                <td><font color="#FF0000" size="3"><strong>广告信息</strong></font> 
                  <hr size="1" noshade> <table  id="a" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" style="margin=0px;" onSubmit="YY_checkform('form1','info_time','#q','0','Field \'info_time\' is not valid.','info_title','#q','0','信息名称不以为空！','rePic','#q','0','图片1不能为空！');return document.MM_returnValue">
                       <table width="100%" border="0" cellspacing="1" cellpadding="2" id="3a">
                            <tr> 
                              <td width="84" align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日期：</font></strong></td>
                              <td colspan="2" valign="top"><font size="2"> 
                                <input name="info_time" type="text" id="info_time" value="<?php echo date("Y-m-d H:i:s") ?>">
                              </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">信息名称：</font></strong></td>
                              <td valign="top"><font size="2"> 
                                <input name="info_title" type="text" id="info_title">
                                </font></td>
                              <td valign="top">图片规格：
                                <label for="guige"></label>
                              <input name="guige" type="text" id="guige" size="16">
                              px.（小于400k）</td>
                            </tr>                            
                          
                          
                          
                            <tr> 
                              <td rowspan="2" align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片1：</font></strong></td>
                              <td rowspan="2" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg" id="showImg" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic','fileUpload','width=400,height=180')">
                            <input name="rePic" type="hidden" id="rePic" size="4"></td>
                              <td valign="top">描述1：&nbsp;&nbsp;<input name="ms01" type="text" id="ms01" size="50"></td>
                            </tr>
                            <tr>
                             
                             <td width="432" valign="top">链接1：
                                <label for="url1"></label>
                              <input name="url1" type="text" id="url1" value="http://" size="50"></td>
                            
                            </tr>
                              
                           <tr> 
                              <td rowspan="2" align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片2：</font></strong></td>
                              <td rowspan="2" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg2" id="showImg2" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg2&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic2','fileUpload','width=400,height=180')">
                            <input name="rePic2" type="hidden" id="rePic2" size="4"></td>
                           
                           <td valign="top">描述2：&nbsp;&nbsp;<input name="ms02" type="text" id="ms02" size="50"></td>
                           
                              
                           </tr>
                           <td valign="top">链接2：
                                <label for="url2"></label>
                              <input name="url2" type="text" id="url2" size="50" value="http://" ></td>
                           
                           <tr> 
                              <td rowspan="2" align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片3：</font></strong></td>
                              <td rowspan="2" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg3" id="showImg3" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg3&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic3','fileUpload','width=400,height=180')">
                            <input name="rePic3" type="hidden" id="rePic3" size="4"></td>
                            
                            
                             <td valign="top">描述3：&nbsp;&nbsp;<input name="ms03" type="text" id="ms03" size="50"></td>
                            
                              
                           </tr>
                           <tr>
                             <td valign="top">链接3：
                                <label for="url3"></label>
                              <input name="url3" type="text" id="url3"  value="http://"size="50"></td>
                           </tr>                              
                            
                            
                        
                  <tr> 
                              <td rowspan="2" align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片4：</font></strong></td>
                              <td rowspan="2" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg4" id="showImg4" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg4&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic4','fileUpload','width=400,height=180')">
                            <input name="rePic4" type="hidden" id="rePic4" size="4"></td>
                            
                            
                             <td valign="top">描述4：&nbsp;&nbsp;<input name="ms04" type="text" id="ms04" size="50"></td>
                            
                             
                  </tr>
                  <tr>
                     <td valign="top">链接4：
                                <label for="url4"></label>
                              <input name="url4" type="text" id="url4" value="http://" size="50"></td>
                  </tr>      
                            
                        <tr> 
                              <td rowspan="2" align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片5：</font></strong></td>
                              <td rowspan="2" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg5" id="showImg5" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg5&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic5','fileUpload','width=400,height=180')">
                            <input name="rePic5" type="hidden" id="rePic5" size="4"></td>
                            
                            <td valign="top">描述4：&nbsp;&nbsp;<input name="ms05" type="text" id="ms05" size="50"></td>
                            
                             
                        </tr>
                        <tr>
                          <td valign="top">链接5：
                                <label for="url5"></label>
                              <input name="url5" type="text" id="url5" value="http://" size="50"></td>
                        </tr>
                        
                        
                        
                       
                    <tr> <!-- 6   --> 
                              <td rowspan="2" align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片6：</font></strong></td>
                              <td rowspan="2" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg6" id="showImg6" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg6&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic6','fileUpload','width=400,height=180')">
                            <input name="rePic6" type="hidden" id="rePic6" size="4"></td>
                            
                            
                             <td valign="top">描述6：&nbsp;&nbsp;<input name="ms06" type="text" id="ms06" size="50"></td>
                              
                        </tr>
                    <tr>
                     <td valign="top">链接6：
                                <label for="url6"></label>
                              <input name="url6" type="text" id="url6" value="http://" size="50"></td>
                    </tr>    
                        
                        
                        
                        
                <!-- 7   -->    
               
             <tr> 
                              <td rowspan="2" align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片7：</font></strong></td>
                              <td rowspan="2" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg7" id="showImg7" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg7&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic7','fileUpload','width=400,height=180')">
                            <input name="rePic7" type="hidden" id="rePic7" size="4"></td>
                              
                                  <td valign="top">描述7：&nbsp;&nbsp;<input name="ms07" type="text" id="ms07" size="50"></td>
                             
                        </tr>
             <tr>
                <td valign="top">链接7：
                                <label for="url7"></label>
                              <input name="url7" type="text" id="url7" value="http://" size="50"></td>
             </tr>  
               
               
               
               
               
               
                <!-- 8  -->    
               <tr> 
                              <td rowspan="2" align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片8：</font></strong></td>
                              <td rowspan="2" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg8" id="showImg8" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg8&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic8','fileUpload','width=400,height=180')">
                            <input name="rePic8" type="hidden" id="rePic8" size="4"></td>
                              <td valign="top">描述8：&nbsp;&nbsp;
                                <input name="ms08" type="text" id="ms08" size="50"></td>
                            
                              
                        </tr>
               <tr>
                 <td valign="top">链接8：
                                <label for="url8"></label>
                              <input name="url8" type="text" id="url8" value="http://" size="50"></td>
               </tr>  
                        
                    
                        
                        
                        
                              
                           <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">发布人：<br>
                                </font></strong></td>
                              <td colspan="2" valign="top"> <font size="2">
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
mysql_free_result($Rec_ggao);
?>
