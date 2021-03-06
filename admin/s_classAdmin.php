<?php require_once('../Connections/connch21.php'); ?>
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

$maxRows_Recclass = 15;
$pageNum_Recclass = 0;
if (isset($_GET['pageNum_Recclass'])) {
  $pageNum_Recclass = $_GET['pageNum_Recclass'];
}
$startRow_Recclass = $pageNum_Recclass * $maxRows_Recclass;

mysql_select_db($database_connch21, $connch21);
$query_Recclass = "SELECT * FROM sy_bigclass ORDER BY class_id DESC";
$query_limit_Recclass = sprintf("%s LIMIT %d, %d", $query_Recclass, $startRow_Recclass, $maxRows_Recclass);
$Recclass = mysql_query($query_limit_Recclass, $connch21) or die(mysql_error());
$row_Recclass = mysql_fetch_assoc($Recclass);

if (isset($_GET['totalRows_Recclass'])) {
  $totalRows_Recclass = $_GET['totalRows_Recclass'];
} else {
  $all_Recclass = mysql_query($query_Recclass);
  $totalRows_Recclass = mysql_num_rows($all_Recclass);
}
$totalPages_Recclass = ceil($totalRows_Recclass/$maxRows_Recclass)-1;
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
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEEEEE">
        <tr valign="top"> 
          <td width="180" background="images/diary_back.gif"> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="106"><img name="diary_r1_c1" src="images/diary_r1_c1.gif" width="180" height="106" border="0" alt=""></td>
              </tr>
              <tr> 
                <td><?php include("s_nav_left.php");?></td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td><font color="#FF0000" size="3"><strong>管理信息大类别</strong></font> 
                  <font color="#FF0000" size="3">（A类）</font>
                  <hr size="1" noshade> 
                  <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    
                    
                    <tr bgcolor="#CCCCCC"> 
                      <td width="133">类别ID</td>
                      <td width="184"><font size="2">类别名称</font></td>
                      <td width="170"><font size="2">序号</font></td>
                      <td width="100" align="center"><font size="2">执行功能</font></td>
                    </tr>
                    <?php do { ?>
                      <tr bgcolor="#FFFFFF">
                        <td width="133"><?php echo $row_Recclass['class_id']; ?></td>
                        <td width="184"><?php echo $row_Recclass['classname']; ?></td>
                        <td><?php echo $row_Recclass['classnum']; ?></td>
                        <td width="100" align="center"><font size="2"><a href="sy_classFix.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."class_id=".$row_Recclass['class_id'] ?>">编辑</a> <a href="s_classDel.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."class_id=".$row_Recclass['class_id'] ?>">删除</a></font></td>
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
