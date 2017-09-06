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

  $updateGoTo = "yqlj.php";
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
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>

</head>
<body bgcolor="#ffffff" onLoad="MM_popupMsg('修改成功！');MM_goToURL('parent','yqlj.php');return document.MM_returnValue">
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
                                  <input name="name" type="text" id="name">
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
                        </tr><tr><td height="10px" colspan="3"></td></tr>
                       <tr><td height="15px" colspan="3" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
  <font color="#FF0000" size="3"></font>
  </td></tr>
   
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
                          <?php $i++;} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                      </table></td>
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
