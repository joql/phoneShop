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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recclass = 15;
$pageNum_Recclass = 0;
if (isset($_GET['pageNum_Recclass'])) {
  $pageNum_Recclass = $_GET['pageNum_Recclass'];
}
$startRow_Recclass = $pageNum_Recclass * $maxRows_Recclass;

mysql_select_db($database_connch15, $connch15);
$query_Recclass = "SELECT * FROM smallclass ORDER BY class_id DESC";
$query_limit_Recclass = sprintf("%s LIMIT %d, %d", $query_Recclass, $startRow_Recclass, $maxRows_Recclass);
$Recclass = mysql_query($query_limit_Recclass, $connch15) or die(mysql_error());
$row_Recclass = mysql_fetch_assoc($Recclass);

if (isset($_GET['totalRows_Recclass'])) {
  $totalRows_Recclass = $_GET['totalRows_Recclass'];
} else {
  $all_Recclass = mysql_query($query_Recclass);
  $totalRows_Recclass = mysql_num_rows($all_Recclass);
}
$totalPages_Recclass = ceil($totalRows_Recclass/$maxRows_Recclass)-1;$maxRows_Recclass = 15;
$pageNum_Recclass = 0;
if (isset($_GET['pageNum_Recclass'])) {
  $pageNum_Recclass = $_GET['pageNum_Recclass'];
}
$startRow_Recclass = $pageNum_Recclass * $maxRows_Recclass;

mysql_select_db($database_connch15, $connch15);
$query_Recclass = "SELECT * FROM smallclass ORDER BY class_id DESC";
$query_limit_Recclass = sprintf("%s LIMIT %d, %d", $query_Recclass, $startRow_Recclass, $maxRows_Recclass);
$Recclass = mysql_query($query_limit_Recclass, $connch15) or die(mysql_error());
$row_Recclass = mysql_fetch_assoc($Recclass);

if (isset($_GET['totalRows_Recclass'])) {
  $totalRows_Recclass = $_GET['totalRows_Recclass'];
} else {
  $all_Recclass = mysql_query($query_Recclass);
  $totalRows_Recclass = mysql_num_rows($all_Recclass);
}
$totalPages_Recclass = ceil($totalRows_Recclass/$maxRows_Recclass)-1;

$queryString_Recclass = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recclass") == false && 
        stristr($param, "totalRows_Recclass") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recclass = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recclass = sprintf("&totalRows_Recclass=%d%s", $totalRows_Recclass, $queryString_Recclass);

$MM_paramName = ""; 

// *** Go To Record and Move To Record: create strings for maintaining URL and Form parameters
// create the list of parameters which should not be maintained
$MM_removeList = "&index=";
if ($MM_paramName != "") $MM_removeList .= "&".strtolower($MM_paramName)."=";
$MM_keepURL="";
$MM_keepForm="";
$MM_keepBoth="";
$MM_keepNone="";
// add the URL parameters to the MM_keepURL string
reset ($HTTP_GET_VARS);
while (list ($key, $val) = each ($HTTP_GET_VARS)) {
	$nextItem = "&".strtolower($key)."=";
	if (!stristr($MM_removeList, $nextItem)) {
		$MM_keepURL .= "&".$key."=".urlencode($val);
	}
}
// add the URL parameters to the MM_keepURL string
if(isset($HTTP_POST_VARS)){
	reset ($HTTP_POST_VARS);
	while (list ($key, $val) = each ($HTTP_POST_VARS)) {
		$nextItem = "&".strtolower($key)."=";
		if (!stristr($MM_removeList, $nextItem)) {
			$MM_keepForm .= "&".$key."=".urlencode($val);
		}
	}
}
// create the Form + URL string and remove the intial '&' from each of the strings
$MM_keepBoth = $MM_keepURL."&".$MM_keepForm;
if (strlen($MM_keepBoth) > 0) $MM_keepBoth = substr($MM_keepBoth, 1);
if (strlen($MM_keepURL) > 0)  $MM_keepURL = substr($MM_keepURL, 1);
if (strlen($MM_keepForm) > 0) $MM_keepForm = substr($MM_keepForm, 1);
?>
<html>
<head>
<title>广告管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
 <style type="text/css">
<!--
.dotline {
	border: 1px dashed #666666;
}
td{font-size:14px;}
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
                <td><font color="#FF0000" size="3"><strong>管理信息类别</strong></font> 
                  <hr size="1" noshade> 
                  <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    
                    
                    <tr bgcolor="#CCCCCC"> 
                      <td width="133">类别ID</td>
                      <td width="184"><font size="2">类别名称</font></td>
                      <td width="170"><font size="2">所属大类</font></td>
                      <td width="170"><font size="2">序号</font></td>
                      <td width="100" align="center"><font size="2">执行功能</font></td>
                    </tr>
                    <?php do { ?>
                      <tr bgcolor="#FFFFFF">
                        <td width="133"><?php echo $row_Recclass['smallclass_id']; ?></td>
                        <td width="184"><?php echo $row_Recclass['smallclassname']; ?></td>
                         <td width="184"><?php echo $row_Recclass['class_id']; ?></td>
                        <td><?php echo $row_Recclass['smallclassnum']; ?></td>
                        <td width="100" align="center"><font size="2"><a href="classFix.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."smallclass_id=".$row_Recclass['smallclass_id'] ?>">编辑</a> <a href="classDel.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."smallclass_id=".$row_Recclass['smallclass_id'] ?>">删除</a></font></td>
                      </tr>
                      <?php } while ($row_Recclass = mysql_fetch_assoc($Recclass)); ?>
                  </table>
                  
                
                
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr align="right">
                      <td>&nbsp;
                        <table border="0">
                          <tr>
                            <td><?php if ($pageNum_Recclass > 0) { // Show if not first page ?>
                                <a href="<?php printf("%s?pageNum_Recclass=%d%s", $currentPage, 0, $queryString_Recclass); ?>">第一页</a>
                                <?php } // Show if not first page ?>
                              <?php if ($pageNum_Recclass > 0) { // Show if not first page ?>
                                <a href="<?php printf("%s?pageNum_Recclass=%d%s", $currentPage, max(0, $pageNum_Recclass - 1), $queryString_Recclass); ?>">前一页</a>
                                <?php } // Show if not first page ?>
                              <?php if ($pageNum_Recclass < $totalPages_Recclass) { // Show if not last page ?>
                                <a href="<?php printf("%s?pageNum_Recclass=%d%s", $currentPage, min($totalPages_Recclass, $pageNum_Recclass + 1), $queryString_Recclass); ?>">下一个</a>
                                <?php } // Show if not last page ?>
                              <?php if ($pageNum_Recclass < $totalPages_Recclass) { // Show if not last page ?>
                                <a href="<?php printf("%s?pageNum_Recclass=%d%s", $currentPage, $totalPages_Recclass, $queryString_Recclass); ?>">最后一页</a>
                              <?php } // Show if not last page ?></td>
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
mysql_free_result($Recclass);
?>
