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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "myform")) {
  $updateSQL = sprintf("UPDATE sll SET a=%s, b=%s, c=%s, aprm=%s, minprice=%s, tctype=%s, sLL_hao=%s, s_price=%s, hfei=%s, message=%s, tszf=%s, rePic=%s, info_editor=%s, l_tel=%s, wx=%s, zding=%s, `time`=%s WHERE id=%s",
                       GetSQLValueString($_POST['a'], "int"),
                       GetSQLValueString($_POST['b'], "int"),
                       GetSQLValueString($_POST['c'], "int"),
                       GetSQLValueString($_POST['aprm'], "int"),
                       GetSQLValueString($_POST['minprice'], "text"),
                       GetSQLValueString($_POST['tctype'], "int"),
                       GetSQLValueString($_POST['sLL_hao'], "text"),
                       GetSQLValueString($_POST['s_price'], "text"),
                       GetSQLValueString($_POST['hfei'], "text"),
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['tszf'], "text"),
                       GetSQLValueString($_POST['rePic'], "text"),
                       GetSQLValueString($_POST['info_editor'], "text"),
                       GetSQLValueString($_POST['l_tel'], "text"),
                       GetSQLValueString($_POST['wx'], "text"),
                       GetSQLValueString($_POST['zding'], "text"),
                       GetSQLValueString($_POST['info_time'], "date"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($updateSQL, $connch21) or die(mysql_error());

  /*$updateGoTo = "sLL_Admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}*/

echo "<script language='javascript'>alert('修改400号码信息成功!');location.href='sLL_Admin.php';</script>";
}


mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sll";
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = sprintf("SELECT * FROM sll WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);




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
<title>400号码修改系统</title>
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




  <script type="text/javascript" language="javascript">

    function check() {
      
	  if ($("[tname=news_title]").val() == "") {
            alert('400号码不能为空!');
            $("[tname=news_title]").val("");
            $("[tname=news_title]").focus();
            return false;
        }
	  
	  else if ($("[tname=news_title]").val().length!=10) {
            alert('400号码为10个位数，请检查你输入的号码是否正确!');
            $("[tname=news_title]").val("");
            $("[tname=news_title]").focus();
            return false;
        }
	  
	 /* if(myform.news_title.value.length<12){
	alert("电话不能少于12个字符！");
	addform.news_title.focus()
	return false;
	}*/
	
	  
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
            alert('请选择归属地!');
            $("[tname=bigtype]").val("");
            $("[tname=bigtype]").focus();
            return false;
        }
 
        if ($("[tname=smalltype]").val() == "") {
            alert('请选择城市!');
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
                <td><p><font color="#FF0000" size="3"><strong>　　400号码信息修改</strong></font><font color="#FF0000" size="3"><strong>系统：</strong></font>
                  </p>
                  <hr size="1" noshade> <table  id="a" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><form action="<?php echo $editFormAction; ?>"   method="POST" name="myform" id="myform" style="margin=0px;">
                       <table width="100%" border="0" cellspacing="1" cellpadding="8">
                            <tr>
                              <td width="100" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日　期：</font></strong></td> 
                              <td colspan="3" valign="top" ><font size="2"> 
                                <input name="info_time" type="text" id="info_time" value="<?php echo $row_Recordset1['time']; ?>">
                                <input name="id" type="hidden" id="id" value="<?php echo $row_Recordset1['id']; ?>">
                              </font></td>
                            </tr>
                            <tr>
                              <td width="100" rowspan="2" bgcolor="#999999"><strong><font color="#FFFFFF" size="2"><font color="#FF0000" size="2">*&nbsp;</font>400号码信息:</font></strong></td> 
                              <td colspan="3" valign="top" ><font size="2"> 
                          <font size="3">号码全称：</font>
                          <input name="sLL_hao" type="text" id="sj_hao" value="<?php echo $row_Recordset1['sLL_hao']; ?>" size="13" maxlength="13" tname="news_title">
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
                                <!--<label for="pid">所属城市:</label>
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
                              </select>-->
                                <!--  <label for="tel">运营商：</label>
                                <select name="tel" id="tel">
                                  <option value="1">中国移动</option>
                                  <option value="2">中国联通</option>
                                  <option value="3">中国电信</option>
                                 
                                 
                              </select>-->
                             </font>
                              
                              <LABEL class=ms_label>号段：</LABEL> <SELECT name=a id="a" tname="bigtype"><OPTION selected 
  value=0  <?php if (!(strcmp(0, $row_Recordset1['a']))) {echo "selected=\"selected\"";} ?>>不限号段</OPTION> 
  <OPTGROUP label=移动> 
  <OPTION value=4007 <?php if (!(strcmp(4007, $row_Recordset1['a']))) {echo "selected=\"selected\"";} ?>>4007</OPTION> 
    <OPTION value=4001 <?php if (!(strcmp(4001, $row_Recordset1['a']))) {echo "selected=\"selected\"";} ?>>4001</OPTION> </OPTGROUP> 
    <OPTGROUP label=联通> 
    <OPTION  value=4000 <?php if (!(strcmp(4000, $row_Recordset1['a']))) {echo "selected=\"selected\"";} ?>>4000</OPTION> 
    <OPTION value=4006 <?php if (!(strcmp(4006, $row_Recordset1['a']))) {echo "selected=\"selected\"";} ?>>4006</OPTION>
     </OPTGROUP> 
  <OPTGROUP label=电信> 
  <OPTION value=4008 <?php if (!(strcmp(4008, $row_Recordset1['a']))) {echo "selected=\"selected\"";} ?>>4008</OPTION>
   <OPTION  value=4009 <?php if (!(strcmp(4009, $row_Recordset1['a']))) {echo "selected=\"selected\"";} ?>>4009</OPTION> </OPTGROUP></SELECT>
                              
                              </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <tr>
                              <td colspan="3" valign="top"  style="border-bottom:1px dashed #999999;"><!--<select name="theme" id="theme">
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
                                
                                
                                
                              <LABEL class=ms_label>价格范围：</LABEL> <SELECT name=b id="b"><OPTION 
  selected value=0 <?php if (!(strcmp(0, $row_Recordset1['b']))) {echo "selected=\"selected\"";} ?>>不限价格</OPTION><OPTION value=-1 <?php if (!(strcmp(-1, $row_Recordset1['b']))) {echo "selected=\"selected\"";} ?>>价格面议</OPTION><OPTION 
  value=1 <?php if (!(strcmp(1, $row_Recordset1['b']))) {echo "selected=\"selected\"";} ?>>800元以下</OPTION><OPTION value=2 <?php if (!(strcmp(2, $row_Recordset1['b']))) {echo "selected=\"selected\"";} ?>>800-1500元</OPTION><OPTION 
  value=3 <?php if (!(strcmp(3, $row_Recordset1['b']))) {echo "selected=\"selected\"";} ?>>1500-3000元</OPTION><OPTION value=4 <?php if (!(strcmp(4, $row_Recordset1['b']))) {echo "selected=\"selected\"";} ?>>3000-5000元</OPTION><OPTION 
  value=5 <?php if (!(strcmp(5, $row_Recordset1['b']))) {echo "selected=\"selected\"";} ?>>5000-9000元</OPTION><OPTION value=6 <?php if (!(strcmp(6, $row_Recordset1['b']))) {echo "selected=\"selected\"";} ?>>9000-8万元</OPTION><OPTION 
  value=7 <?php if (!(strcmp(7, $row_Recordset1['b']))) {echo "selected=\"selected\"";} ?>>8万元以上</OPTION></SELECT>
                                
                                

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                <LABEL class=ms_label>号码规律：</LABEL> <SELECT name=c id="c"><OPTION selected 
  value=0 <?php if (!(strcmp(0, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>不限规律</OPTION><OPTION value=1 <?php if (!(strcmp(1, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>普通号码</OPTION><OPTION 
  value=19 <?php if (!(strcmp(19, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AAA</OPTION><OPTION value=20 <?php if (!(strcmp(20, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数ABC</OPTION><OPTION 
  value=14 <?php if (!(strcmp(14, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AAAA</OPTION><OPTION value=13 <?php if (!(strcmp(13, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数ABCD</OPTION><OPTION 
  value=17 <?php if (!(strcmp(17, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AAAB</OPTION><OPTION value=15 <?php if (!(strcmp(15, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AABB</OPTION><OPTION 
  value=18 <?php if (!(strcmp(18, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数ABAB</OPTION><OPTION value=16 <?php if (!(strcmp(16, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数ABBA</OPTION><OPTION 
  value=12 <?php if (!(strcmp(12, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AAAAA</OPTION><OPTION value=11 <?php if (!(strcmp(11, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数ABCDE</OPTION><OPTION 
  value=9 <?php if (!(strcmp(9, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AAABB</OPTION><OPTION value=8 <?php if (!(strcmp(8, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AABAA</OPTION><OPTION 
  value=10 <?php if (!(strcmp(10, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AABBB</OPTION><OPTION value=6 <?php if (!(strcmp(6, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数ABCABC</OPTION><OPTION 
  value=5 <?php if (!(strcmp(5, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AABBCC</OPTION><OPTION value=4 <?php if (!(strcmp(4, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AAABBB</OPTION><OPTION 
  value=7 <?php if (!(strcmp(7, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数ABBABB</OPTION><OPTION value=3 <?php if (!(strcmp(3, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数AAAAA+</OPTION><OPTION 
  value=2 <?php if (!(strcmp(2, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>尾数ABCDE+</OPTION><OPTION value=27 <?php if (!(strcmp(27, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>中间AAA</OPTION><OPTION 
  value=25 <?php if (!(strcmp(25, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>中间AAAA</OPTION><OPTION value=26 <?php if (!(strcmp(26, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>中间AABB</OPTION><OPTION 
  value=24 <?php if (!(strcmp(24, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>中间AAABB</OPTION><OPTION value=23 <?php if (!(strcmp(23, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>中间AABBB</OPTION><OPTION 
  value=22 <?php if (!(strcmp(22, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>中间AAAA+</OPTION><OPTION value=28 <?php if (!(strcmp(28, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>中间AABBCC</OPTION><OPTION 
  value=21 <?php if (!(strcmp(21, $row_Recordset1['c']))) {echo "selected=\"selected\"";} ?>>中间AAABBB</OPTION></SELECT>
                                
                                
                              </td>
                            </tr>
                            
                            
                                                        
                            <tr>
                              <td width="100" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">类　型:</font></strong></td> 
                              <td colspan="2" style="border-bottom:1px dashed #999999;"><font size="2">
                               
                     <LABEL class=ms_label for=letter>资费：</LABEL> <INPUT <?php if (!(strcmp($row_Recordset1['aprm'],"0"))) {echo "checked=\"checked\"";} ?> value=0 CHECKED 
type=radio name=aprm> 不限 <INPUT <?php if (!(strcmp($row_Recordset1['aprm'],"10"))) {echo "checked=\"checked\"";} ?> value=10 type=radio name=aprm> 低于0.1元/分钟 <INPUT <?php if (!(strcmp($row_Recordset1['aprm'],"20"))) {echo "checked=\"checked\"";} ?> 
value=20 type=radio name=aprm> 0.1-0.2元/分钟 <INPUT <?php if (!(strcmp($row_Recordset1['aprm'],"30"))) {echo "checked=\"checked\"";} ?> value=30 type=radio name=aprm> 
0.2-0.3元/分钟           
                               
                               
 <P><LABEL class=ms_label for=letter>套餐：</LABEL> <SELECT name=minprice>
   <OPTION 
  selected value=0 <?php if (!(strcmp(0, $row_Recordset1['minprice']))) {echo "selected=\"selected\"";} ?>>不限</OPTION>
   <OPTION value="0-1000"  <?php if (!(strcmp("0-1000", $row_Recordset1['minprice']))) {echo "selected=\"selected\"";} ?>>1000元以下</OPTION>
   <OPTION value="1000-4000" <?php if (!(strcmp("1000-4000", $row_Recordset1['minprice']))) {echo "selected=\"selected\"";} ?>>1000-4000元</OPTION><OPTION 
  value="4000-8000" <?php if (!(strcmp("4000-8000", $row_Recordset1['minprice']))) {echo "selected=\"selected\"";} ?>>4000-8000元</OPTION><OPTION value="8000-90000" <?php if (!(strcmp("8000-90000", $row_Recordset1['minprice']))) {echo "selected=\"selected\"";} ?>>8000-9万</OPTION>
   <OPTION value="90000-1000000" <?php if (!(strcmp("90000-1000000", $row_Recordset1['minprice']))) {echo "selected=\"selected\"";} ?>>9万以上</OPTION></SELECT> </LABEL><INPUT <?php if (!(strcmp($row_Recordset1['tctype'],"0"))) {echo "checked=\"checked\"";} ?> value=0 
CHECKED type=radio name=tctype> 不限 <INPUT <?php if (!(strcmp($row_Recordset1['tctype'],"1"))) {echo "checked=\"checked\"";} ?> value=1 type=radio name=tctype> 年套餐 
<INPUT <?php if (!(strcmp($row_Recordset1['tctype'],"2"))) {echo "checked=\"checked\"";} ?> value=2 type=radio name=tctype> 月套餐 </P>                              


<!--&nbsp;<input name="info_top" type="radio" value="3">
后五位-->


</font>

                              <!--是否幻灯:--> <!--<input name="info_flash" type="radio" value="1">
                                是
                                <input name="info_flash" type="radio" value="0" checked="CHECKED">
否-->
</td>
                            
                            </tr>
                            <tr>
                              <td bgcolor="#999999"><strong><font color="#FFFFFF" size="2">置　顶:</font></strong></td>
                              <td valign="top"  colspan="2" style="border-bottom:1px dashed #999999;">
                              无置顶 
                                <input <?php if (!(strcmp($row_Recordset1['zding'],"无置顶"))) {echo "checked=\"checked\"";} ?> name="zding" type="radio" id="radio1" value="无置顶" checked="CHECKED">|
                              
                              移动置顶 
                                <input <?php if (!(strcmp($row_Recordset1['zding'],"移动置顶"))) {echo "checked=\"checked\"";} ?> type="radio" name="zding" id="radio1" value="移动置顶">
                             | 联通置顶
                                <input <?php if (!(strcmp($row_Recordset1['zding'],"联通置顶"))) {echo "checked=\"checked\"";} ?> type="radio" name="zding" id="radio2" value="联通置顶">
                              | 电信置顶<input <?php if (!(strcmp($row_Recordset1['zding'],"电信置顶"))) {echo "checked=\"checked\"";} ?> type="radio" name="zding" id="radio3" value="电信置顶">
                             </td>
                              
                            </tr>
                            
                            <tr>
                              <td width="100" bgcolor="#999999"><strong><font color="#FFFFFF" size="2"><font color="#FF0000" size="2">*&nbsp;</font>此号售价:</font></strong></td> 
                              <td colspan="2" valign="top"  style="border-bottom:1px dashed #999999;"><font size="3"> 
                                <input name="s_price" type="text" id="s_price" value="<?php echo $row_Recordset1['s_price']; ?>" size="30" maxlength="35" tname="s_price">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000" >*</font>请添写出售价格。</font>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                <label for="hfei"><font color="#FF0000">*</font>此号含费</label>
                              <input name="hfei" type="text" id="hfei" value="<?php echo $row_Recordset1['hfei']; ?>" size="15" maxlength="20">
                              元</td>
                            </tr>
                            
                            
                            
                            <tr>
                              <td width="100" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">备注信息:</font></strong></td>
                              <td colspan="3" valign="top"><textarea name="message" cols="35" rows="4" id="message" 
onKeyDown="textCounter(this.form.message,this.form.remLen,200);"
 onKeyUp="textCounter(this.form.message,
this.form.remLen,200);"><?php echo $row_Recordset1['message']; ?></textarea> 
                              您还可以输入:<input name="remLen" type="text" 
value="200" size="5" readonly>个字符 </td>
                            </tr>
                            <tr>
                              <td width="100" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">特殊字符：</font></strong></td> 
                              <td colspan="3" valign="top"><font size="2">
                                <input name="tszf" type="text" id="tszf" value="<?php echo $row_Recordset1['tszf']; ?>" size="13" maxlength="13">
                              </font>&nbsp;&nbsp;例：含4不含4等。</td>
                            </tr>
                            <tr>
                              <td width="100" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2"><font color="#FF0000" size="2">&nbsp;</font>经纪人头像:</font></strong></td> 
                              <td colspan="3" valign="top">&nbsp;<img src="../images/<?php echo $row_Recordset1['rePic']; ?>" alt="这是显示上传预览图片的位置" name="showImg" id="showImg"  width="60px" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                            
                          
             
                          
    <input type="button" name="Submit" value="上传图片" onClick="javascript:openwindow('fupload.php?useForm=myform&amp;prevImg=showImg&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic','fileUpload',400,180)">
                   
                           
                           
                           
                           
                            <input name="rePic" type="hidden" id="rePic" value="<?php echo $row_Recordset1['rePic']; ?>" size="4"></td></tr>
                              
                         
                         
                         
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
                              <td colspan="3" valign="top"> <font size="2">
                                <input name="info_editor" type="text" id="info_editor" value="<?php echo $row_Recordset1['info_editor']; ?>">
                            </font></td></tr>  
                            
                            <tr>
                             <td width="100" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">联系人电话：<br>
                             </font></strong></td> 
                              <td colspan="3" valign="top"> <font size="2">
                                <input name="l_tel" type="text" id="l_tel" value="<?php echo $row_Recordset1['l_tel']; ?>">
                            </font></td></tr>
                            
                              
                              <tr>
                             <td width="100" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">联系人微信：<br>
                             </font></strong></td> 
                              <td colspan="3" valign="top"> <font size="2">
                                <input name="wx" type="text" id="wx" value="<?php echo $row_Recordset1['wx']; ?>">
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
                          <input type="hidden" name="MM_update" value="myform">

                         
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
</html><?php
mysql_free_result($Recordset1);
 mysql_close($connch21);?>