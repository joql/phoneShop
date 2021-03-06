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
$key=$_GET['key'];
if(!empty($key)){
	
	$maxRows_Recinfo = 15;
$pageNum_Recinfo = 0;
if (isset($_GET['pageNum_Recinfo'])) {
  $pageNum_Recinfo = $_GET['pageNum_Recinfo'];
}
$startRow_Recinfo = $pageNum_Recinfo * $maxRows_Recinfo;

mysql_select_db($database_connch21, $connch21);
$query_Recinfo = "SELECT * FROM sj  where sj_hao = '$key' ORDER BY id DESC";
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
	
	
	}

else
{

$maxRows_Recinfo = 15;
$pageNum_Recinfo = 0;
if (isset($_GET['pageNum_Recinfo'])) {
  $pageNum_Recinfo = $_GET['pageNum_Recinfo'];
}
$startRow_Recinfo = $pageNum_Recinfo * $maxRows_Recinfo;

mysql_select_db($database_connch21, $connch21);
$query_Recinfo = "SELECT * FROM sj ORDER BY id DESC";
$query_limit_Recinfo = sprintf("%s LIMIT %d, %d", $query_Recinfo, $startRow_Recinfo, $maxRows_Recinfo);
$Recinfo = mysql_query($query_limit_Recinfo, $connch21) or die(mysql_error());
$row_Recinfo = mysql_fetch_assoc($Recinfo);

if (isset($_GET['totalRows_Recinfo'])) {
  $totalRows_Recinfo = $_GET['totalRows_Recinfo'];
} else {
  $all_Recinfo = mysql_query($query_Recinfo);
  $totalRows_Recinfo = mysql_num_rows($all_Recinfo);
}
$totalPages_Recinfo = ceil($totalRows_Recinfo/$maxRows_Recinfo)-1;}
?>

<html>
<head>
<title>手机号信息管理</title>
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
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
                <td height="29" colspan="2" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td><strong><font color="#FF0000" size="3">手机号信息管理</font></strong>
                  
                  <hr size="1" noshade> 
                  <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    
                    
                    <tr bgcolor="#CCCCCC">
                      <td colspan="14" bgcolor="#FFFFFF" ><form name="form1" method="get" action="">
                    <label for="key">　号码搜索：</label>
                    <input name="key" type="text" id="key" placeholder="请输入您要查询的号码" maxlength="12">
                    <input type="submit" name="tj" id="tj" value="查找"　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　>
                   <?php if(!empty($key)) {?> <input type="submit" name="fhui" id="fhui" value="返回">
                   <?php } ?>　
                      </form></td><td colspan="2" align="center"><span style=" color:#F00;">*&nbsp;</span>手机号批量上传 </td><td colspan="2"  bgcolor="#FFFFFF"><form name="form2" method="post" enctype="multipart/form-data" action="plsc2017/upload_excel.php">


<input type="hidden" name="leadExcel" value="true">
<table align="center" width="90%" border="0">
<tr>
   <td>
   <!--<input class="four" type="file" name="name">-->
  <input type="file" name="inputExcel">
    <input type="submit" name="import" value="导入数据" style="margin-top:5px;">
   </td>
</tr>
</table>
</form></td>
                    </tr>
                    <tr bgcolor="#CCCCCC"> 
                      <td ><font size="2">ID</font></td>
                      <td ><font size="2">手机号</font></td>
                      <td  ><font size="2" >所属城市</font></td>
                      <td ><font size="2">运营商</font></td>
                      <td ><font size="2">号段</font></td>
                      <td ><font size="2">价格范围</font></td>
                      <td ><font size="2">规率</font></td>
                      <td ><font size="2">尾号加红</font></td>
                      <td >此号售价</td>
                      <td >此号含费</td>
                      <td>备注</td>
                      <td>特殊字符</td>
                     <!-- <td >经纪人头像</td>-->
                      <td >发布人</td>
                      <td >联系人电话</td>
                      <td >联系人微信</td>
                      <td ><font color="#FF0000"><b>号码捡漏</b></font></td>
                      <td >时间</td>
                      <td align="center"  width="7%"><font size="2">执行功能</font></td>
                    </tr>
                    <?php if($totalRows_Recinfo>0){ ?>
                    <?php do { ?>
                    <tr bgcolor="#FFFFFF" style="cursor: hand;" onMouseOver="this.style.backgroundColor='#F0F0F0'" onMouseOut="this.style.backgroundColor=''">
                        <td  height="50"><?php echo $row_Recinfo['id']; ?></td>
                        <td ><?php echo $row_Recinfo['sj_hao'];
						
				           ?></td>
                        <td ><?php $a=$row_Recinfo['pid'];
						switch ($a)
						{
						case 1:
						echo "哈尔滨";
						break;
						case 2:
						echo "齐齐哈尔";
						break;
						
						case 3:
						echo "牡丹江";
						break;
							
						case 4:
						echo "佳木斯";
						break;	
						
						case 5:
						echo "绥化";
						break;	
						case 6:
						echo "黑河";
						break;	
						case 7:
						echo "大兴安岭";
						break;
						case 8:
						echo "伊春";
						break;
						case 9:
						echo "大庆";
						break;
							
							
							
						case 10:
						echo "鸡西";
						break;
						case 11:
						echo "鹤岗";
						break;
						case 12:
						echo "双鸭山";
						break;
						case 13:
						echo "七台河";
						break;	
							
							
							
							}
						
						
						 ?></td>
                        <td><?php $b=$row_Recinfo['tel'];
						switch ($b)
						{
						case 1:
						echo "中国移动";
						break;
						case 2:
						echo "中国联通";
						break;
						
						case 3:
						echo "中国电信";
						break;
						}
						 ?></td>
                        <td><?php echo $c=$row_Recinfo['theme'];
						/*switch ($c)
						{
						case 1:
						echo '139';
						break;
						case 2:
						echo "138";
						break;
						
						case 3:
						echo "137";
						break;
							
						case 4:
						echo "136";
						break;	
						
						case 5:
						echo "135";
						break;	
						case 6:
						echo "134";
						break;	
						case 7:
						echo "147";
						break;
						case 8:
						echo "150";
						break;
						case 9:
						echo "151";
						break;
						
						case 10:
						echo "152";
						break;
						case 11:
						echo "157";
						break;
						
						case 12:
						echo "158";
						break;
						
						case 13:
						echo "159";
						break;
						
						case 14:
						echo "178";
						break;
						
						case 15:
						echo "182";
						break;
						
						case 16:
						echo "183";
						break;
						
						case 17:
						echo "184";
						break;
						
						case 18:
						echo "187";
						break;
						
						case 19:
						echo "188";
						break;
						case 20:
						echo "130";
						break;
						
						case 21:
						echo "131";
						break;
						
						case 22:
						echo "132";
						break;
						
						case 23:
						echo "155";
						break;
						
						case 24:
						echo "156";
						break;
						
						case 25:
						echo "185";
						break;
						
						case 26:
						echo "186";
						break;
						
						case 27:
						echo "145";
						break;
						
						case 28:
						echo "176";
						break;
						case 29:
						echo "133";
						break;
						
						case 30:
						echo "153";
						break;
						
						case 31:
						echo "177";
						break;
						
						case 32:
						echo "173";
						break;
						
						case 33:
						echo "180";
						break;
						
						case 34:
						echo "181";
						break;
						
						case 35:
						echo "189";
						break;
						
						case 36:
						echo "170";
						break;
						
						case 37:
						echo "171";
						break;
						}*/
						
						
						 ?></td>
                        <td><?php $d= $row_Recinfo['price']; 
						
						
						switch ($d)
						{
						case 1:
						echo "价格面议";
						break;
						case 2:
						echo "2000-5000元";
						break;
						
						case 3:
						echo "5000-10000元";
						break;
							
						case 4:
						echo "10000元以上";
						break;	
						
						
							}
						
						
						
						?></td>
                        <td><?php $E=$row_Recinfo['day'];
						
						switch ($E)
						{
						case 1:
						echo '普通号码';
						break;
						case 2:
						echo "尾数AA";
						break;
						
						case 3:
						echo "尾数AAA";
						break;
							
						case 4:
						echo "尾数AAAA";
						break;	
						
						case 5:
						echo "尾数ABC";
						break;	
						case 6:
						echo "尾数ABCD";
						break;	
						case 7:
						echo "尾数AAAAA";
						break;
						case 8:
						echo "尾数AABB";
						break;
						case 9:
						echo "尾数AAAAB";
						break;
						
						case 10:
						echo "尾数AAAB";
						break;
						case 11:
						echo "尾数AABA";
						break;
						
						case 12:
						echo "尾数AABB";
						break;
						
						case 13:
						echo "尾数ABBA";
						break;
						
						case 14:
						echo "尾数ABCDE";
						break;
						
						case 15:
						echo "尾数AAABB";
						break;
						
						case 16:
						echo "尾数AABBB";
						break;
						
						case 17:
						echo "尾数AABAA";
						break;
						
						case 18:
						echo "尾数ABCABC";
						break;
						
						case 19:
						echo "尾数AAABBB";
						break;
						case 20:
						echo "尾数AABBC";
						break;
						
						case 21:
						echo "尾数ABBABB";
						break;
						
						case 22:
						echo "尾数AAAAA＋";
						break;
						
						case 23:
						echo "尾数ABCDE+";
						break;
						
						case 24:
						echo "尾数ABCABCD";
						break;
						
						case 25:
						echo "尾数ABCDABCD";
						break;
						
						case 26:
						echo "中间AAA";
						break;
						
						case 27:
						echo "中间AAAA";
						break;
						
						case 28:
						echo "中间AABB";
						break;
						case 29:
						echo "中间AAABB";
						break;
						
						case 30:
						echo "中间AABBB";
						break;
						
						case 31:
						echo "中间AAAA+";
						break;
						
						case 32:
						echo "中间AAABBB";
						break;
						
						case 33:
						echo "中间AABBCC";
						break;
						
						case 34:
						echo "人气号";
						break;
						
						case 35:
						echo "情侣号";
						break;
						
						case 36:
						echo "风水号";
						break;
						
						
						}
						
						
						
						
						 ?></td>
                        <td><?php $f=$row_Recinfo['info_top'];
						
						switch ($f)
						{
						case 0:
						echo '不加';
						break;
						case 1:
						echo "后三位";
						break;
						
						case 2:
						echo "后四位";
						break;
							
						case 3:
						echo "后五位";
						break;	
						}
						
						
						 ?></td>
                        <td><?php echo $row_Recinfo['s_price']; ?></td>
                        <td><?php if($row_Recinfo['hfei']!=""){ 
						echo $row_Recinfo['hfei'];}else{
						echo "0"; }?>元</td>
                        <td><?php echo $row_Recinfo['message']; ?></td>
                        <td><?php echo $row_Recinfo['tszf']; ?></td>
                        <!--<td><img src="../images/<?php echo $row_Recinfo['phpoto']; ?>" width="100"></td>-->
                        <td><?php echo $row_Recinfo['info_editor']; ?></td>
                        <td><?php echo $row_Recinfo['l_tel']; ?></td>
                        <td><?php echo $row_Recinfo['wx']; ?></td>
                        <td><?php if($row_Recinfo['jlou']==1){echo "<font color=\"#FF0000\">是</font>";}else{echo '否';} ?></td>
                        <td><?php echo $row_Recinfo['info_time']; ?></td>
						  
					
                        <td width="7%" align="center"><font size="2"><a href="sj_fix.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."id=".$row_Recinfo['id'] ?>">编辑</a> —<a href="sjDel.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."id=".$row_Recinfo['id'] ?>">删除</a></font></td>
                      </tr><?php } while ($row_Recinfo = mysql_fetch_assoc($Recinfo)); ?> <?php } ?>
                 <?php if($totalRows_Recinfo==0&&$key!=""){ ?>
                 <tr align="center" bgcolor="#FFFFFF" style="cursor: hand;" onMouseOver="this.style.backgroundColor='#F0F0F0'" onMouseOut="this.style.backgroundColor=''">
                        <td  height="50" colspan="18">没有您要查询的号码！</td>
                      </tr><?php }?>
                  </table>
                  
                
                
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr align="right">
                      <td align="center">&nbsp;
                        <table width="100%" border="0" align="center"  bgcolor="#FFFFFF">
                          <?php include("fanye.php");?>
                      </table></td>
                    </tr>
                </table></td>
                <td>&nbsp;</td>
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
<?php mysql_close($connch21);?>