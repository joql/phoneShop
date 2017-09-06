<?php require_once('../Connections/connch15.php'); ?>
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
  $updateSQL = sprintf("UPDATE info SET info_time=%s, classname=%s, smallclassname=%s, info_title=%s, info_editor=%s, info_photo=%s, info_top=%s, info_flash=%s, info_content=%s WHERE info_id=%s",
                       GetSQLValueString($_POST['info_time'], "date"),
                       GetSQLValueString($_POST['classname'], "text"),
                       GetSQLValueString($_POST['smallclassname'], "text"),
                       GetSQLValueString($_POST['info_title'], "text"),
                       GetSQLValueString($_POST['info_editor'], "text"),
                       GetSQLValueString($_POST['rePic'], "text"),
                       GetSQLValueString($_POST['info_top'], "int"),
                       GetSQLValueString($_POST['info_flash'], "int"),
                       GetSQLValueString($_POST['info_content'], "text"),
                       GetSQLValueString($_POST['info_id'], "int"));

  mysql_select_db($database_connch15, $connch15);
  $Result1 = mysql_query($updateSQL, $connch15) or die(mysql_error());

  $updateGoTo = "infoAdmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recinfo = "-1";
if (isset($_GET['info_id'])) {
  $colname_Recinfo = $_GET['info_id'];
}
mysql_select_db($database_connch15, $connch15);
$query_Recinfo = sprintf("SELECT * FROM info WHERE info_id = %s", GetSQLValueString($colname_Recinfo, "int"));
$Recinfo = mysql_query($query_Recinfo, $connch15) or die(mysql_error());
$row_Recinfo = mysql_fetch_assoc($Recinfo);
$totalRows_Recinfo = mysql_num_rows($Recinfo);

mysql_select_db($database_connch15, $connch15);
$query_Recclass = "SELECT * FROM bigclass ORDER BY classnum ASC";
$Recclass = mysql_query($query_Recclass, $connch15) or die(mysql_error());
$row_Recclass = mysql_fetch_assoc($Recclass);
$totalRows_Recclass = mysql_num_rows($Recclass);

mysql_select_db($database_connch15, $connch15);
$query_Recsmallclass = "SELECT * FROM smallclass";
$Recsmallclass = mysql_query($query_Recsmallclass, $connch15) or die(mysql_error());
$row_Recsmallclass = mysql_fetch_assoc($Recsmallclass);
$totalRows_Recsmallclass = mysql_num_rows($Recsmallclass);
?>
<html>
<head>
<title>广告管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
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
                <table width="90%" height="100%" border="0" cellpadding="2" cellspacing="0">
                    <tr> 
                      <td width="15"><font size="2">&nbsp;</font></td>
                      <td><font color="#FF3300" size="2">   <strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">ADMIN</font></strong></font> 
                                              <hr align="left" width="100%" size="1" noshade class="dotline">
                        <font size="2"> <a href="classAdd.php">新增信息大类</a></font> 
                        <hr align="left" width="100%" size="1" noshade class="dotline">
                        <font size="2"> <a href="classAdmin.php">管理信息大类</a></font>
                        
                        <hr align="left" width="100%" size="1" noshade class="dotline">
                        <font size="2"> <a href="smallclassAdd.php">新增信息小类</a></font> 
                        <hr align="left" width="100%" size="1" noshade class="dotline">
                        <font size="2"> <a href="smallclassAdmin.php">管理信息类别</a></font>
                                                
                        <hr align="left" width="100%" size="1" noshade class="dotline">
                        <font size="2"> <a href="infoAdd.php">新增信息</a></font> 
                        <hr align="left" width="100%" size="1" noshade class="dotline">
                        <font size="2"> <a href="infoAdmin.php">管理信息</a></font>
                                                 
                        <hr align="left" width="100%" size="1" noshade class="dotline">
                        <font size="2"><a href="<?php echo $logoutAction ?>">退出管理界面</a></font> 
                      <hr align="left" width="100%" size="1" noshade class="dotline"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td><font color="#FF0000" size="3"><strong>修改信息信息</strong></font> 
                  <hr size="1" noshade> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" style="margin=0px;">
                          <table width="100%" border="0" cellspacing="1" cellpadding="2">
                            <tr> 
                              <td width="42" align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日期：</font></strong></td>
                              <td colspan="3" valign="top"><font size="2"> 
                                <input name="info_time" type="text" id="info_time" value="<?php echo $row_Recinfo['info_time']; ?>">
                                <input name="info_id" type="hidden" id="info_id" value="<?php echo $row_Recinfo['info_id']; ?>">
                              </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">信息名称：</font></strong></td>
                              <td colspan="3" valign="top"><font size="2"> 
                                <input name="info_title" type="text" id="info_title" value="<?php echo $row_Recinfo['info_title']; ?>">
                                </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">信息类别：</font></strong></td>
                              <td width="224" valign="top">
                              <select name="classname">
                                <?php
do {  
?>
                                <option value="<?php echo $row_Recclass['classname']?>"<?php if (!(strcmp($row_Recclass['classname'], $row_Recinfo['classname']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recclass['classname']?></option>
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
                                <option value="<?php echo $row_Recsmallclass['smallclassname']?>"<?php if (!(strcmp($row_Recsmallclass['smallclassname'], $row_Recinfo['smallclassname']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recsmallclass['smallclassname']?></option>
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
                              <td valign="top"><font size="2"> 
                                <input <?php if (!(strcmp($row_Recinfo['classname'],"1"))) {echo "checked=\"checked\"";} ?> name="info_top" type="radio" value="1"  >
                                是
                                <input <?php if (!(strcmp($row_Recinfo['classname'],"0"))) {echo "checked=\"checked\"";} ?> name="info_top" type="radio" value="0">
否 </font></td>
<td width="73" valign="top">是否幻灯</td>
                              <td width="222" valign="top"> <input <?php if (!(strcmp($row_Recinfo['info_flash'],"1"))) {echo "checked=\"checked\"";} ?> name="info_flash" type="radio" value="1" >
                                是
                                <input <?php if (!(strcmp($row_Recinfo['info_flash'],"0"))) {echo "checked=\"checked\"";} ?> name="info_flash" type="radio" value="0">
否</td>
                            </tr>
                            <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">信息信息：</font></strong></td>
                              <td colspan="3" valign="top"> 
                                <textarea name="info_content" style="display:none" rows="1" cols="20" id="info_content"><?php echo $row_Recinfo['info_content']; ?></textarea>
	<IFRAME ID="eWebEditor1" SRC="../Zreditor/ewebeditor.htm?id=info_content&style=amzi" FRAMEBORDER="0" SCROLLING="no" WIDTH="550" HEIGHT="300"></IFRAME>	
                              </td>
                            </tr>
                            <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">上传图片：</font></strong></td>
                              <td colspan="3" valign="top">&nbsp;<img src="../images/<?php echo $row_Recinfo['info_photo']; ?>" alt="这是显示上传预览图片的位置" name="showImg" id="showImg" onClick='javascript:alert("这是显示上传预览图片的位置");'>
                                <input type="button" name="Submit" value="上传图片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg&amp;upUrl=../images&amp;ImgS=400&amp;ImgW=800&amp;ImgH=600&amp;reItem=rePic','fileUpload','width=0px,height=0px')">
                            <input name="rePic" type="hidden" id="rePic" value="<?php echo $row_Recinfo['info_photo']; ?>" size="4"></td></tr>
                              
                           <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">发布人：<br>
                                </font></strong></td>
                              <td colspan="3" valign="top"> <font size="2">
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
?>
