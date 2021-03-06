<?php require_once('../Connections/connch21.php'); ?>
<?php //限制对页的访问start
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

//限制对页的访问over
?>



<?php //退出登路到前台首页代码 start
ini_set('display_errors', 'Off'); error_reporting(E_ALL & ~E_NOTICE);
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
}//over
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

mysql_select_db($database_connch21, $connch21);
$query_Recnews = "SELECT * FROM sy_news ORDER BY news_id DESC";
$Recnews = mysql_query($query_Recnews, $connch21) or die(mysql_error());
$row_Recnews = mysql_fetch_assoc($Recnews);
$totalRows_Recnews = mysql_num_rows($Recnews);
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
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEEEEE">
        <tr valign="top"> 
          <td width="180" background="images/diary_back.gif"> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="106"><img name="diary_r1_c1" src="images/diary_r1_c1.gif" width="180" height="106" border="0" alt=""></td>
              </tr>
              <tr> 
                <td><?php include("s_nav_left.php");?>&nbsp;</td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td><font color="#FF0000" size="3"><strong>管理分类页面</strong></font> 
                  <hr size="1" noshade> 
                  <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    
                    
                    <tr bgcolor="#CCCCCC"> 
                      <td width="117"><font size="2">新闻ID</font></td><td width="325"><font size="2">标题</font></td>
                      <td width="74">所属大分类</td>
                      
                      <td width="131"><font size="2">日期</font></td>
                      
                      <td width="35" align="center"><font size="2">执行功能</font></td>
                    </tr>
                    <?php do { ?>
                      <tr bgcolor="#FFFFFF" style="cursor: hand;" onMouseOver="this.style.backgroundColor='#F0F0F0'" onMouseOut="this.style.backgroundColor=''">
                        <td width="117" ><?php echo $row_Recnews['news_id']; ?></td>
                        <td width="325"><?php /*start db_input script*/ if ($row_Recnews['quyu'] == 1){ ?>
                            [<a href="newsAdmin_fx_1.php?quyu=1">常见问题</a>]
<?php } /*end db_input script*/ ?>
                         
                         <?php /*start db_input script*/ if ($row_Recnews['quyu'] == 2){ ?>
                          [<a href="newsAdmin_fx_1.php?quyu=2">手册指导</a>]
<?php } /*end db_input script*/ ?>
                          
                           <?php /*start db_input script*/ if ($row_Recnews['number'] == 1){ ?>
                          [<a href="newsAdmin_fx.php?quyu=2&number=1">家具知识大全</a>]
                          <?php } /*end db_input script*/ ?>
						  <?php echo $row_Recnews['news_title']; ?>
                          <?php /*start db_input script*/ if ($row_Recnews['news_photo'] != 0){ ?>
                            [图]
                            <?php } /*end db_input script*/ ?>
                            <?php /*start db_input script*/ if ($row_Recnews['news_top'] != 0){ ?>
                              [推荐]
  <?php } /*end db_input script*/ ?>
						
						
						
  </td>
                        <td width="74"><?php echo $row_Recnews['quyu']; ?></td>
                        <td width="131"><?php echo $row_Recnews['news_time']; ?></td>
                        <td width="35" align="center"><font size="2"><a href="s_newsFix.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."news_id=".$row_Recnews['news_id'] ?>">编辑</a> 
                        
                      
                      <!--
                        <a href="s_newsDel.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."news_id=".$row_Recnews['news_id'] ?>">删除</a>-->
                        
                        
                        
                        
                        </font></td>
                      </tr>
                      <?php } while ($row_Recnews = mysql_fetch_assoc($Recnews)); ?>
                  </table>
                  
                
                
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr align="right">
                      <td>&nbsp;
                        <table border="0">
                          <tr>
                            <td><?php if ($pageNum_Recnews > 0) { // Show if not first page ?>
                                <a href="<?php printf("%s?pageNum_Recnews=%d%s", $currentPage, 0, $queryString_Recnews); ?>">第一页</a>
                                <?php } // Show if not first page ?>
                              <?php if ($pageNum_Recnews > 0) { // Show if not first page ?>
                                <a href="<?php printf("%s?pageNum_Recnews=%d%s", $currentPage, max(0, $pageNum_Recnews - 1), $queryString_Recnews); ?>">前一页</a>
                                <?php } // Show if not first page ?>
                              <?php if ($pageNum_Recnews < $totalPages_Recnews) { // Show if not last page ?>
                                <a href="<?php printf("%s?pageNum_Recnews=%d%s", $currentPage, min($totalPages_Recnews, $pageNum_Recnews + 1), $queryString_Recnews); ?>">下一个</a>
                                <?php } // Show if not last page ?>
                              <?php if ($pageNum_Recnews < $totalPages_Recnews) { // Show if not last page ?>
                                <a href="<?php printf("%s?pageNum_Recnews=%d%s", $currentPage, $totalPages_Recnews, $queryString_Recnews); ?>">最后一页</a>
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
mysql_free_result($Recnews);
?>
