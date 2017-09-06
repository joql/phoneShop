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
  $insertSQL = sprintf("INSERT INTO yqlj (name, url, `time`) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['url'], "text"),
                       GetSQLValueString($_POST['time'], "date"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($insertSQL, $connch21) or die(mysql_error());

  $insertGoTo = "yqlj.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE yqlj SET name=%s, url=%s, `time`=%s WHERE id=%s",
                       GetSQLValueString($_POST['name2'], "text"),
                       GetSQLValueString($_POST['url_x'], "text"),
                       GetSQLValueString($_POST['time_1'], "date"),
                       GetSQLValueString($_POST['id_1'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($updateSQL, $connch21) or die(mysql_error());

  $updateGoTo = "yqlj_x.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST['id'])) && ($_POST['id'] != "") && (isset($_POST['del']))) {
  $deleteSQL = sprintf("DELETE FROM yqlj WHERE id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($deleteSQL, $connch21) or die(mysql_error());

  $deleteGoTo = "yqlj.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM yqlj ORDER BY id DESC";
$Recordset1 = mysql_query($query_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<html>
<head>
<title>友情链接管理</title>
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

#q7 {
	border: none;
	position: relative;
	top: 2px;
}
#url_x {
	position: relative;
	bottom: 3px;
}
#button {
	position: relative;
	bottom: 2px;
}
.ys09 {
	position: relative;
	bottom: 4px;
}
</style>
<script type="text/javascript">
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
</script>
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
              <td><table  id="a" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><strong><font color="#FF0000" size="3">友情链接：</font></strong>
                      <hr size="1" noshade>
                      
  <table  id="a2" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="5"><form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" style="margin=0px;" onSubmit="YY_checkform('form1','name','#q','0','友情链接名称不能为空！');return document.MM_returnValue">
        <table width="100%" border="0" cellspacing="1" cellpadding="2" >
          <tr>
            <td width="9%" align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日期：</font></strong></td>
            <td colspan="2" valign="top"><font size="2">
              <input name="time" type="text" id="time" value="<?php echo date("Y-m-d H:i:s") ?>">
              </font></td>
            </tr>
          <tr>
            <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">名称：</font></strong></td>
            <td valign="top"><font size="2">
              <input name="name" type="text" id="name" onBlur="YY_checkform('form1','time','#q','0','友情链接名称不能为空！');return document.MM_returnValue">
              </font></td>
            <td width="64%" valign="top">链接：
              <label for="url"></label>
              <input name="url" type="text" id="url" value="http://" size="50"></td>
            </tr>
          </table>
        <input type="submit" name="Submit2" value="添加新链接">
        <input type="reset" name="Submit3" value="重设">
        <input type="button" name="Submit4" value="回上一页" onClick="window.history.back();">
        <input type="hidden" name="MM_insert" value="form1">
        </form></td>
    </tr>
    <tr><td height="10px" colspan="3"></td></tr>
     <tr><td height="5px" colspan="3" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
  <font color="#FF0000" size="3">*暂无友情链接信息！</font>
  <?php } // Show if recordset empty ?></td></tr>
   <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
    <tr>
      <td height="30px" colspan="3"><font size="3">所有链接：</font></td></tr> 
    <?php $i=1; do { ?><form method="POST" name="form2"  action="<?php echo $editFormAction; ?>">
      <tr>
        <td width="9%" height="25" align="center" bgcolor="#999999" ><strong><font color="#FFFFFF" size="2"> <?php echo $i ?>.
          <input name="id_1" type="hidden" id="id_1" value="<?php echo $row_Recordset1['id']; ?>">名称:</font></strong></td>
        
        <td width="27%" align="left"><font size="2">
          &nbsp;<input name="name2" type="text" id="name2" value="<?php echo $row_Recordset1['name']; ?>">
        </font></td>
        <td width="9%" align="center" ><font  size="2"> 链接：</font></td>
        <td width="55%"><label for="url_x"></label>
          <input name="url_x" type="text" id="url_x" value="<?php echo $row_Recordset1['url']; ?>" size="40">
          <input type="submit" name="button" id="button" value="修改">
          <input name="time_1" type="hidden" id="time_1" value="<?php echo $row_Recordset1['time']; ?>">
          
          <span class="ys09">|</span> <a  href='yqlj_Del.php?id=<?php echo $row_Recordset1['id']; ?>' onClick="if ( confirm( '您将删除链接“<?php echo $row_Recordset1['name']; ?>”\n  按“取消”停止，按“确定”删除。' ) ) { return true;}return false;"><img id="q7" src="images/q7.png"></a>
          
          
        </td>
      </tr>
      <input type="hidden" name="MM_update" value="form2">
    </form>
      <?php $i++;} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?><?php } // Show if recordset not empty ?>
      
       <tr><td height="30px" colspan="3"></td></tr>
  </table>
                      </td>
                  </tr>
                </table></td>
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
mysql_free_result($Recordset1);
?>
