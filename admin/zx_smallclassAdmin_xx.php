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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Rec_zh_xiaolei = 20;
$pageNum_Rec_zh_xiaolei = 0;
if (isset($_GET['pageNum_Rec_zh_xiaolei'])) {
  $pageNum_Rec_zh_xiaolei = $_GET['pageNum_Rec_zh_xiaolei'];
}
$startRow_Rec_zh_xiaolei = $pageNum_Rec_zh_xiaolei * $maxRows_Rec_zh_xiaolei;

mysql_select_db($database_connch21, $connch21);
$query_Rec_zh_xiaolei = "SELECT * FROM zx_xx_smallclass ORDER BY zh_id DESC";
$query_limit_Rec_zh_xiaolei = sprintf("%s LIMIT %d, %d", $query_Rec_zh_xiaolei, $startRow_Rec_zh_xiaolei, $maxRows_Rec_zh_xiaolei);
$Rec_zh_xiaolei = mysql_query($query_limit_Rec_zh_xiaolei, $connch21) or die(mysql_error());
$row_Rec_zh_xiaolei = mysql_fetch_assoc($Rec_zh_xiaolei);

if (isset($_GET['totalRows_Rec_zh_xiaolei'])) {
  $totalRows_Rec_zh_xiaolei = $_GET['totalRows_Rec_zh_xiaolei'];
} else {
  $all_Rec_zh_xiaolei = mysql_query($query_Rec_zh_xiaolei);
  $totalRows_Rec_zh_xiaolei = mysql_num_rows($all_Rec_zh_xiaolei);
}
$totalPages_Rec_zh_xiaolei = ceil($totalRows_Rec_zh_xiaolei/$maxRows_Rec_zh_xiaolei)-1;

$queryString_Rec_zh_xiaolei = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Rec_zh_xiaolei") == false && 
        stristr($param, "totalRows_Rec_zh_xiaolei") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Rec_zh_xiaolei = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Rec_zh_xiaolei = sprintf("&totalRows_Rec_zh_xiaolei=%d%s", $totalRows_Rec_zh_xiaolei, $queryString_Rec_zh_xiaolei);
?>
<html>
<head>
<title>广告管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<table width="890" border="0" align="center" cellpadding="0" cellspacing="0">
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
                <td><font color="#FF0000" size="3"><strong>管理信息最小类别</strong>&nbsp;(D类）</font> 
                  <hr size="1" noshade> 
                  <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    
                    
                    <tr bgcolor="#CCCCCC"> 
                      <td width="133">类别ID</td>
                      <td width="184"><font size="2">类别名称</font></td>
                      <td width="184">所属小类</td>
                      <td width="170"><font size="2">所属中类</font></td>
                      <td width="170"><font size="2">所属大类</font></td>
                      <td width="170"><font size="2">序号</font></td>
                      <td width="100" align="center"><font size="2">执行功能</font></td>
                    </tr>
                    <?php do { ?>
                      <tr bgcolor="#FFFFFF">
                        <td width="133"><?php echo $row_Rec_zh_xiaolei['zh_id']; ?></td>
                        <td width="184"><?php echo $row_Rec_zh_xiaolei['zx_x_mame']; ?></td>
                        <td width="184"><?php echo $row_Rec_zh_xiaolei['xx_name_id']; ?></td>
                        <td width="184"><?php echo $row_Rec_zh_xiaolei['smallclass_id']; ?></td>
                        <td width="184"><?php echo $row_Rec_zh_xiaolei['class_id']; ?></td>
                        <td><?php echo $row_Rec_zh_xiaolei['x_num']; ?></td>
                        <td width="100" align="center"><font size="2"><a href="zx_smallclassFix_xx.php?zh_id=<?php echo $row_Rec_zh_xiaolei['zh_id']; ?>">编辑</a> <a href="zx_smallclassDel_xx.php?zh_id=<?php echo $row_Rec_zh_xiaolei['zh_id']; ?>">删除</a></font></td>
                      </tr>
                      <?php } while ($row_Rec_zh_xiaolei = mysql_fetch_assoc($Rec_zh_xiaolei)); ?>
                  </table>
                  
                
                
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr align="right">
                      <td>&nbsp;
                        <table border="0">
                          <tr>
                            <td><?php if ($pageNum_Rec_zh_xiaolei > 0) { // Show if not first page ?>
                                <a href="<?php printf("%s?pageNum_Rec_zh_xiaolei=%d%s", $currentPage, 0, $queryString_Rec_zh_xiaolei); ?>">第一页</a>
                                <?php } // Show if not first page ?>
                              <?php if ($pageNum_Rec_zh_xiaolei > 0) { // Show if not first page ?>
                                <a href="<?php printf("%s?pageNum_Rec_zh_xiaolei=%d%s", $currentPage, max(0, $pageNum_Rec_zh_xiaolei - 1), $queryString_Rec_zh_xiaolei); ?>">前一页</a>
                                <?php } // Show if not first page ?>
                              <?php if ($pageNum_Rec_zh_xiaolei < $totalPages_Rec_zh_xiaolei) { // Show if not last page ?>
                                <a href="<?php printf("%s?pageNum_Rec_zh_xiaolei=%d%s", $currentPage, min($totalPages_Rec_zh_xiaolei, $pageNum_Rec_zh_xiaolei + 1), $queryString_Rec_zh_xiaolei); ?>">下一个</a>
                                <?php } // Show if not last page ?>
                              <?php if ($pageNum_Rec_zh_xiaolei < $totalPages_Rec_zh_xiaolei) { // Show if not last page ?>
                                <a href="<?php printf("%s?pageNum_Rec_zh_xiaolei=%d%s", $currentPage, $totalPages_Rec_zh_xiaolei, $queryString_Rec_zh_xiaolei); ?>">最后一页</a>
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
mysql_free_result($Rec_zh_xiaolei);
?>
