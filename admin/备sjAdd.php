<?php require_once('../Connections/connch21.php'); ?>
<?php
header("Content-type: text/html; charset=utf-8");
 
 
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "myform")) {
  $insertSQL = sprintf("INSERT INTO sj (pid, tel, theme, price, `day`, sj_hao, info_top, s_price, message, tszf, phpoto, info_editor, l_tel, wx, info_time,hfei,jlou) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s, %s,%s)",
                       GetSQLValueString($_POST['pid'], "int"),
                       GetSQLValueString($_POST['bigtype'], "int"),
                       GetSQLValueString($_POST['smalltype'], "int"),
                       GetSQLValueString($_POST['price'], "int"),
                       GetSQLValueString($_POST['day'], "int"),
                       GetSQLValueString($_POST['sj_hao'], "text"),
                       GetSQLValueString($_POST['info_top'], "int"),
                       GetSQLValueString($_POST['s_price'], "text"),
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['tszf'], "text"),
                       GetSQLValueString($_POST['rePic'], "text"),
                       GetSQLValueString($_POST['info_editor'], "text"),
                       GetSQLValueString($_POST['l_tel'], "text"),
                       GetSQLValueString($_POST['wx'], "text"),
                       GetSQLValueString($_POST['info_time'], "date"),
					   GetSQLValueString($_POST['hfei'], "text"),
					   GetSQLValueString($_POST['jlou'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($insertSQL, $connch21) or die(mysql_error());

 /* $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));*/
  
  echo "<script language='javascript'>alert('发布手机号成功!');location.href='sjAdmin.php';</script>";
}
 //mysql_query("SET time_zone = '+8:00'") or die('时区设置失败，请联系管理员！');

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


<html>
<head>
<title>精英手机号发布上传系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="./ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="./ueditor/ueditor.all.js"></script>
<script type="text/javascript" charset="gbk" src="./ueditor/lang/zh-cn/zh-cn.js"></script>

<!--检查表单不能为空的调用JS 而且有此多条件的修改单选才工作-->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<!--检查表单不能为空的调用JS结束-->


<!-- Fireworks MX Dreamweaver MX target.  Created Thu Feb 27 23:51:44 GMT+0800 (￥x￥_?D  CRE?!) 2003-->
<style type="text/css">
<!--
.dotline {
	border: 1px dashed #666666;
}
-->




</style>


<?php  mysql_select_db($database_connch21, $connch21);
     $sql="select * from smalltype";
  $result = mysql_query( $sql );
?>
<script language="JavaScript">
 var onecount;
 subcat=new Array(); 
    <?php
 $count=0;
    while($rows=mysql_fetch_assoc($result)){
      $bid=$rows['bid'];
   $smalltype=$rows['smalltype'];
 ?>
    subcat[<?php echo $count?>]=new Array("<?php echo $rows['smalltype']?>","<?php echo
    $rows['bid']?>","<?php echo $rows['smalltype']?>"); <?php
    $count++; }
     ?>
  onecount=<?php echo $count;?>;
    function changelocation(locationid)
    {
 document.myform.smalltype.length=1;
    var locationid=locationid;
 var i;
    for(i=0;i<onecount;i++)
 {   
  if(subcat[i][1]==locationid)
  {
   document.myform.smalltype.options[document.myform.smalltype.length]=new Option(subcat[i][0],subcat[i][2]);    }
     }
}
</script>

  <script type="text/javascript" language="javascript">

    function check() {
      
	  if ($("[tname=news_title]").val() == "") {
            alert('手机号不能为空!');
            $("[tname=news_title]").val("");
            $("[tname=news_title]").focus();
            return false;
        }
	  
	  if ($("[tname=message]").val() == "") {
            alert('新闻简介不能为空!');
            $("[tname=messsag]").val("");
            $("[tname=message]").focus();
            return false;
        }
	  
	  
	  if ($("[tname=nr]").val() == "") {
            alert('新闻内容不能为空!');
            $("[tname=nr]").val("");
            $("[tname=nr]").focus();
            return false;
        }
	  
	    if ($("[tname=bigtype]").val()=="") {
            alert('请选择大类!');
            $("[tname=bigtype]").val("");
            $("[tname=bigtype]").focus();
            return false;
        }
 
        if ($("[tname=smalltype]").val() == "") {
            alert('请选择小分类!');
            $("[tname=smalltype]").val("");
            $("[tname=smalltype]").focus();
            return false;
        }
    
  if ($("[tname=s_price]").val() == "") {
            alert('售价不能为空!');
            $("[tname=s_price]").val("");
            $("[tname=s_price]").focus();
            return false;
        }
 
 
    }
 
    </script>

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
                <td><font color="#FF0000" size="3"><strong>手机号发布上传系统：</strong></font>
                  <hr size="1" noshade> <table  id="a" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><form   method="POST" name="myform" id="myform" style="margin=0px;">
                       <table width="100%" border="0" cellspacing="1" cellpadding="8">
                            <tr>
                              <td width="100" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日　期：</font></strong></td> 
                              <td colspan="4" valign="top" ><font size="2"> 
                                <input name="info_time" type="text" id="info_time" value="<?php echo date("Y-m-d H:i:s") ?>">
                              </font></td>
                            </tr>
                            <tr>
                              <td width="100" rowspan="2" bgcolor="#999999"><strong><font color="#FFFFFF" size="2"><font color="#FF0000" size="2">*&nbsp;</font>手机号码信息:</font></strong></td> 
                              <td colspan="4" valign="top" ><font size="2"> 
                          <font size="3">号码全称：</font>
                          <input name="sj_hao" type="text" id="sj_hao" size="13" maxlength="13" tname="news_title">
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
                                <label for="pid">所属城市:</label>
                                <select name="pid" id="pid">
                                
                                  <option value="1">哈尔滨</option>
                                  <option value="2">齐齐哈尔</option>
                                  <option value="3">牡丹江</option>
                                  <option value="4">佳木斯</option>
                                  <option value="5">绥化</option>
                                  <option value="6">黑河</option>
                                  <option value="7">大兴安岭</option>
                                  <option value="8">伊春</option>
                                  <option value="9">大庆</option>
                                  <option value="10">鸡西</option>
                                  <option value="11">鹤岗</option>
                                  <option value="12">双鸭山</option>
                                  <option value="13">七台河</option>
                              </select>
                                <!--  <label for="tel">运营商：</label>
                                <select name="tel" id="tel">
                                  <option value="1">中国移动</option>
                                  <option value="2">中国联通</option>
                                  <option value="3">中国电信</option>
                                 
                                 
                              </select>-->
                              &nbsp;&nbsp;&nbsp;&nbsp;  运营商:
                                
                                <?php  mysql_select_db($database_connch21, $connch21);
      // $sql = "select * from bigtype";
	   $sql="SELECT * 
FROM bigtype";
          $result = mysql_query( $sql );
 ?>     
                                
                                <select name="bigtype" id="bigtype" tname="bigtype" onChange="changelocation(document.myform.bigtype.options[document.myform.bigtype.selectedIndex].value)" size="1">
                                  <option value=""  >=请选择运营商=</option>
                                  <?php //ini_set('display_errors', 'Off'); //error_reporting(E_ALL & ~E_NOTICE);
		  while($rows=mysql_fetch_array($result)){   ?>
                                  <option value="<?php echo $rows['id']; ?>"><?php echo $rows['bigtype']; ?></option>
                                  <?php } ?>
                                </select>   
                                
                                 &nbsp;&nbsp;&nbsp;&nbsp;
                                
                                <label>所属号段:
        <select name="smalltype" id="smalltype" tname="smalltype">
          <option value="">=请选择号段=</option>
        </select>
      </label>
                                
                              </font></td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <tr>
                              <td colspan="4" valign="top"  style="border-bottom:1px dashed #999999;"><!--<select name="theme" id="theme">
                                  <option value="">=请选择号段=</option>
                                  <option value="1">139</option>
                                  <option value="2">138</option>
                                  <option value="3">137</option>
                                  <option value="4">136</option>
                                  <option value="5">135</option>
                                  <option value="6">134</option>
                                  <option value="7">147</option>
                                  <option value="8">150</option>
                                  <option value="9">151</option>
                                  <option value="10">152</option>
                                  
                                  <option value="11">157</option>
                                  <option value="12">158</option>
                                  <option value="13">159</option>
                             
                             
                                  <option value="14">178</option>
                                  <option value="15">182</option>
                                  <option value="16">183</option>
                                  <option value="17">184</option>
                                  <option value="18">187</option>
                                  <option value="19">188</option>
                                  <option value="20">130</option>
                                  <option value="21">131</option>
                                  <option value="22">132</option>
                                  
                                  <option value="23">155</option>
                                  <option value="24">156</option>
                                  <option value="25">185</option>
                             
                             
                                  <option value="26">186</option>
                                  <option value="27">145</option>
                                  <option value="28">176</option>
                                  <option value="29">133</option>
                                  <option value="30">153</option>
                                  <option value="31">177</option>
                                  <option value="32">173</option>
                                  <option value="33">180</option>
                                  
                                  <option value="34">181</option>
                                  <option value="35">189</option>
                                  <option value="36">170</option>
                                  <option value="37">171</option>
                             
                              </select>-->
                                
                                
                                
                                <label for="price">价格范围：</label>
                                <select name="price" id="price">
                                  <option value="1">价格面议</option>
                                  <option value="2">2000-5000元</option>
                                  <option value="3">5000-10000元</option>
                                  <option value="4">10000元以上</option>
                                  
                                </select>
                                
                                

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                <label for="day">规　律：</label>
                                <select name="day" id="day">
                                  <!--<option value="">=请选择号段=</option>-->
                                  <option value="1">普通号码</option>
                                  <option value="2">尾数AA</option>
                                  <option value="3">尾数AAA</option>
                                  <option value="4">尾数AAAA</option>
                                  <option value="5">尾数ABC</option>
                                  <option value="6">尾数ABCD</option>
                                  <option value="7">尾数AAAAA</option>
                                  <option value="8">尾数AABB</option>
                                  <option value="9">尾数AAAAB</option>
                                  <option value="10">尾数AAAB</option>
                                  
                                  <option value="11">尾数AABA</option>
                                  <option value="12">尾数AABB</option>
                                  <option value="13">尾数ABBA</option>
                                  
                                  
                                  <option value="14">尾数ABCDE</option>
                                  <option value="15">尾数AAABB</option>
                                  <option value="16">尾数AABBB</option>
                                  <option value="17">尾数AABAA</option>
                                  <option value="18">尾数ABCABC</option>
                                  <option value="19">尾数AAABBB</option>
                                  <option value="20">尾数AABBCC</option>
                                  <option value="21">尾数ABBABB</option>
                                  <option value="22">尾数AAAAA＋</option>
                                  
                                  <option value="23">尾数ABCDE+</option>
                                  <option value="24">尾数ABCABCD</option>
                                  <option value="25">尾数ABCDABCD</option>
                                  
                                  
                                  <option value="26">中间AAA</option>
                                  <option value="27">中间AAAA</option>
                                  <option value="28">中间AABB</option>
                                  <option value="29">中间AAABB</option>
                                  <option value="30">中间AABBB</option>
                                  <option value="31">中间AAAA+</option>
                                  <option value="32">中间AAABBB</option>
                                  <option value="33">中间AABBCC</option>
                                  <option value="34">人气号</option>
                                  <option value="35">情侣号</option>
                                  <option value="36">风水号</option>
                                  
                                  
                                  
                                </select>
                                
                                
                              </td>
                            </tr>
                            
                            
                                                        
                            <tr>
                              <td width="100" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">尾号加红:</font></strong></td> 
                              <td width="267" valign="top"><font size="2">
                                <input name="info_top" type="radio" value="0" checked="CHECKED">
不加  
&nbsp;<input name="info_top" type="radio" value="1">
后三位 
&nbsp;<input name="info_top" type="radio" value="2">
后四位

&nbsp;<input name="info_top" type="radio" value="3">
后五位


</font>　|

                              <!--是否幻灯:--> <!--<input name="info_flash" type="radio" value="1">
                                是
                                <input name="info_flash" type="radio" value="0" checked="CHECKED">
否--></td>
                              <td width="464" valign="top"><font color="#FF0000"><b>*号码捡漏:</b></font>
                                <input type="radio" name="jlou" id="radio" value="1">
                                是   <input name="jlou" type="radio" id="radio2" value="0" checked="CHECKED">
                              否</h3></td>
                              <td width="59" valign="top">&nbsp;</td>
                            </tr>
                            
                            <tr>
                              <td width="100" bgcolor="#999999"><strong><font color="#FFFFFF" size="2"><font color="#FF0000" size="2">*&nbsp;</font>此号售价:</font></strong></td> 
                              <td colspan="3" valign="top"  style="border-bottom:1px dashed #999999;"><font size="3"> 
                                <input name="s_price" type="text" id="s_price" size="30" maxlength="35" tname="s_price">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000" >*</font>请添写出售价格。</font>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                <label for="hfei"><font color="#FF0000">*</font>此号含费</label>
                              <input name="hfei" type="text" id="hfei" size="15" maxlength="20">
                              元</td>
                            </tr>
                            
                            
                            
                            <tr>
                              <td width="100" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">备注信息:</font></strong></td>
                              <td colspan="4" valign="top"><textarea name="message" cols="35" rows="4" id="message" 
onKeyDown="textCounter(this.form.message,this.form.remLen,200);"
 onKeyUp="textCounter(this.form.message,
this.form.remLen,200);"></textarea> 
                              您还可以输入:<input name="remLen" type="text" 
value="200" size="5" readonly>个字符 </td>
                            </tr>
                            <tr>
                              <td width="100" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">特殊字符：</font></strong></td> 
                              <td colspan="4" valign="top"><font size="2">
                                <input name="tszf" type="text" id="tszf" size="13" maxlength="13">
                              </font>&nbsp;&nbsp;例：含4不含4等。</td>
                            </tr>
                            <tr>
                              <td width="100" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2"><font color="#FF0000" size="2">&nbsp;</font>经纪人头像:</font></strong></td> 
                              <td colspan="4" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg" id="showImg"  width="60px" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                            
                          
             
                          
    <input type="button" name="Submit" value="上传图片" onClick="javascript:openwindow('fupload.php?useForm=myform&amp;prevImg=showImg&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic','fileUpload',400,180)">
                   
                           
                           
                           
                           
                            <input name="rePic" type="hidden" id="rePic" size="4"></td></tr>
                              
                         
                         
                         
           <!--              
                         
                           <tr>
                             <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片2：</font></strong></td> 
                              <td colspan="7" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg2" id="showImg2" width="60px" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg2&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic2','fileUpload','width=400,height=180')">
                            <input name="rePic2" type="hidden" id="rePic2" size="4"></td></tr>
                           <tr>
                             <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片3：</font></strong></td> 
                              <td colspan="7" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg3" id="showImg3" width="60px"onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg3&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic3','fileUpload','width=400,height=180')">
                            <input name="rePic3" type="hidden" id="rePic3" size="4"></td></tr>                              
                            
                            
                        
                  <tr>
                    <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片4：</font></strong></td> 
                              <td colspan="7" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg4" id="showImg4" width="60px" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg4&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic4','fileUpload','width=400,height=180')">
                            <input name="rePic4" type="hidden" id="rePic4" size="4"></td></tr>      
                            
                        <tr>
                          <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片5：</font></strong></td> 
                              <td colspan="7" valign="top">&nbsp;<img src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg5" id="showImg5" width="60px" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg5&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic5','fileUpload','width=400,height=180')">
                            <input name="rePic5" type="hidden" id="rePic5" size="4"></td></tr>
                        
                        -->    
                            
                            
                            
                            
                              
                           <tr>
                             <td width="100" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">发布人：<br>
                             </font></strong></td> 
                              <td colspan="4" valign="top"> <font size="2">
                                <input name="info_editor" type="text" id="info_editor">
                            </font></td></tr>  
                            
                            <tr>
                             <td width="100" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">联系人电话：<br>
                             </font></strong></td> 
                              <td colspan="4" valign="top"> <font size="2">
                                <input name="l_tel" type="text" id="l_tel">
                            </font></td></tr>
                            
                              
                              <tr>
                             <td width="100" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">联系人微信：<br>
                             </font></strong></td> 
                              <td colspan="4" valign="top"> <font size="2">
                                <input name="wx" type="text" id="wx">
                            </font></td></tr>
                              
                              
                          </table>  <table width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td width="115">&nbsp; </td>
    <td><input type="submit" name="Submit2" value="提交发布" onClick="javascript:return check();">
                          <input type="reset" name="Submit3" value="重设">
                          <input type="button" name="Submit4" value="回上一页" onClick="window.history.back();">
                          <input type="hidden" name="MM_insert" value="myform">
                          </td>
  </tr>
</table>

                         
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
<?php mysql_close($connch21);?>