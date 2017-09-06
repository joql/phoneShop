<?php require_once('../Connections/connch21.php'); ?>
<?php ini_set('display_errors', 'Off');
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

$maxRows_Recinfo = 15;
$pageNum_Recinfo = 0;
if (isset($_GET['pageNum_Recinfo'])) {
  $pageNum_Recinfo = $_GET['pageNum_Recinfo'];
}
$startRow_Recinfo = $pageNum_Recinfo * $maxRows_Recinfo;

mysql_select_db($database_connch21, $connch21);
$query_Recinfo = "SELECT * FROM info ORDER BY info_id DESC";
$query_limit_Recinfo = sprintf("%s LIMIT %d, %d", $query_Recinfo, $startRow_Recinfo, $maxRows_Recinfo);
$Recinfo = mysql_query($query_limit_Recinfo, $connch21) or die(mysql_error());
$row_Recinfo = mysql_fetch_assoc($Recinfo);

if (isset($_GET['totalRows_Recinfo'])) {
  $totalRows_Recinfo = $_GET['totalRows_Recinfo'];
} else {
  $all_Recinfo = mysql_query($query_Recinfo);
  $totalRows_Recinfo = mysql_num_rows($all_Recinfo);
}
$totalPages_Recinfo = ceil($totalRows_Recinfo/$maxRows_Recinfo)-1;

$queryString_Recinfo = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recinfo") == false && 
        stristr($param, "totalRows_Recinfo") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recinfo = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recinfo = sprintf("&totalRows_Recinfo=%d%s", $totalRows_Recinfo, $queryString_Recinfo);

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <style type="text/css">
<!--
.dotline {
	border: 1px dashed #666666;
}
td{font-size:14px;}
.yso1 {
	color: #F00;
}
.ys02 {
	color: #6FF;
}
.ys02 {
	color: #0FF;
}
.ys03 {
	color: #30F;
}
-->
 </style>
</head>
<body bgcolor="#ffffff">
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td ><table  width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ACACAC">
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
                <td><strong><font color="#FF0000" size="3">信息管理</font></strong>
                  <hr size="1" noshade> 
                  <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    
                    
                    <tr bgcolor="#CCCCCC"> 
                      <td width="5%"><font size="2">ID</font></td>
                      <td width="10%"><font size="2">大类</font></td>
                      <td width="10%"><font size="2">中类</font></td>
                      <td width="10%">小类</td>
                      <td width="10%">最小类别</td>
                      <td width="55%"><font size="2">标题</font></td>
                      <td width="20%" align="center"><font size="2">执行功能</font></td>
                    </tr>
                    <?php do { ?>
                      <tr bgcolor="#FFFFFF" style="cursor: hand;" onMouseOver="this.style.backgroundColor='#F0F0F0'" onMouseOut="this.style.backgroundColor=''">
                        <td width="100" height="30"><?php echo $row_Recinfo['info_id']; ?></td>
                        <td width="100"><?php echo $row_Recinfo['classname']; ?></td>
                        <td width="100"><?php echo $row_Recinfo['smallclassname']; ?></td>
                        <td><?php echo $row_Recinfo['xx_smallclass']; ?></td>
                        <td><?php echo $row_Recinfo['zx_name']; ?></td>
                        <td><?php echo $row_Recinfo['info_title']; ?>
                          <?php /*start db_input script*/ if ($row_Recinfo['info_top'] == 1){ ?>
                            <span class="ys02">[推荐]</span>
                            <?php } /*end db_input script*/ ?>
                          <?php /*start db_input script*/ if ($row_Recinfo['info_flash'] == 1){ ?>
                            <span class="ys03">[幻灯]</span>
                            <?php } /*end db_input script*/ ?>
                          </span>
<?php /*start db_input script*/ if ($row_Recinfo['info_photo'] != ""){ ?>
                            <span class="yso1">[主图]</span>
<?php } /*end db_input script*/ ?></td>
                        <td width="50" align="center"><font size="2"><a href="infoFix.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."info_id=".$row_Recinfo['info_id'] ?>">编辑</a> —<a href="infoDel.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."info_id=".$row_Recinfo['info_id'] ?>">删除</a></font></td>
                      </tr>
                      <?php } while ($row_Recinfo = mysql_fetch_assoc($Recinfo)); ?>
                  </table>
                  
                
                
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr align="right">
                      <td align="center">&nbsp;
                        <table width="100%" border="0" align="center"  bgcolor="#FFFFFF">
                          <tr bgcolor="#FFFFFF">
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;记录 <?php echo ($startRow_Recinfo + 1) ?> 到 <?php echo min($startRow_Recinfo + $maxRows_Recinfo, $totalRows_Recinfo) ?> (总共 <?php echo $totalRows_Recinfo ?></td>
                            <td height="30" align="right" ><?php if ($pageNum_Recinfo > 0) { // Show if not first page ?>
                                <a href="<?php printf("%s?pageNum_Recinfo=%d%s", $currentPage, 0, $queryString_Recinfo); ?>">第一页</a>
                                <?php } // Show if not first page ?>
                              <?php if ($pageNum_Recinfo > 0) { // Show if not first page ?>
                                <a href="<?php printf("%s?pageNum_Recinfo=%d%s", $currentPage, max(0, $pageNum_Recinfo - 1), $queryString_Recinfo); ?>">前一页</a>
                                <?php } // Show if not first page ?>
                              <?php if ($pageNum_Recinfo < $totalPages_Recinfo) { // Show if not last page ?>
                                <a href="<?php printf("%s?pageNum_Recinfo=%d%s", $currentPage, min($totalPages_Recinfo, $pageNum_Recinfo + 1), $queryString_Recinfo); ?>">下一页</a>
                                <?php } // Show if not last page ?>
                              <?php if ($pageNum_Recinfo < $totalPages_Recinfo) { // Show if not last page ?>
                                <a href="<?php printf("%s?pageNum_Recinfo=%d%s", $currentPage, $totalPages_Recinfo, $queryString_Recinfo); ?>">最后一页</a>
                            <?php } // Show if not last page ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
          <td width="14" height="12"><img name="diary_r4_c5" src="images/diary_r4_c5.gif" width="12" height="12" border="0" alt=""></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recinfo);
?>
