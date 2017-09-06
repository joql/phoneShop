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
$query_Recinfo = "SELECT * FROM sll where sLL_hao='$key' ORDER BY id DESC";
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
}else{
	
$maxRows_Recinfo = 15;
$pageNum_Recinfo = 0;
if (isset($_GET['pageNum_Recinfo'])) {
  $pageNum_Recinfo = $_GET['pageNum_Recinfo'];
}
$startRow_Recinfo = $pageNum_Recinfo * $maxRows_Recinfo;

mysql_select_db($database_connch21, $connch21);
$query_Recinfo = "SELECT * FROM sll ORDER BY id DESC";
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
}?>	

<html>
<head>
<title>400号码信息管理</title>
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
                <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td><strong><font color="#FF0000" size="3">400号码信息管理</font></strong>
                  <hr size="1" noshade> 
                  <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    <tr bgcolor="#CCCCCC">
                      <td colspan="14" bgcolor="#FFFFFF" ><form name="form1" method="get" action="">
                    <label for="key">　号码搜索：</label>
                    <input name="key" type="text" id="key" placeholder="请输入您要查询的号码" maxlength="12">
                    <input type="submit" name="tj" id="tj" value="查找"　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　>
                   <?php if(!empty($key)) {?> <input type="submit" name="fhui" id="fhui" value="返回"><?php } ?>
                      </form></td>
                      
                      <td colspan="2" align="center"><span style=" color:#F00;">*&nbsp;</span>400号码批量上传 </td><td colspan="2"  bgcolor="#FFFFFF"><form name="form2" method="post" enctype="multipart/form-data" action="plsc2017_sll/upload_excel.php" onSubmit="  jc();">


<input type="hidden" name="leadExcel" value="true">
<table align="center"  border="0">
<tr>
   <td>
   <!--<input class="four" type="file" name="name">-->
  <input type="file" name="inputExcel">
    <input type="submit" name="import" value="导入数据" style="margin-top:5px;"  >
    <input type="button" value="批量导出数据" onClick="javascript:location.href='./plsc2017_sll/dc/';">
   </td>
</tr>
</table>
</form></td>
                      
                    </tr>
                    
                    <tr bgcolor="#CCCCCC">
                      <td >&nbsp;</td> 
                      <td ><font size="2">ID</font></td>
                      <td ><font size="2">号码</font></td>
                      <td  ><font size="2">号段</font></td>
                      <td >价格范围</td>
                      <td >号码规律</td>
                      <td >资费</td>
                      <td >套餐</td>
                      <!--<td ><font size="2">尾号加红</font></td>-->
                      <td >此号售价</td>
                      <td ><font size="2">所属置顶</font></td>
                      <td >此号含费</td>
                      <td>备注</td>
                      <td>特殊字符</td>
                     <!-- <td >经纪人头像</td>-->
                      <td >发布人</td>
                      <td >联系人电话</td>
                      <td >联系人微信</td>
                      <td >时间</td>
                      <td align="center"  width="7%"><font size="2">执行功能</font></td>
                    </tr>
                    
                    <?php if($totalRows_Recinfo>0){?>
                     <script>
//删除确认
function del(){
 if(!window.confirm('是否要删除数据??'))
	return false;
	
}
//全部选择/取消
function chek(){
	 var leng = this.form3.chk.length;
	 if(leng==undefined){
	   leng=1;
	   if(!form3.chk.checked)
	   	document.form3.chk.checked=true;
		else
			document.form3.chk.checked=false;
	 }else{
       for( var i = 0; i < leng; i++)
	    {
			if(!form3.chk[i].checked)
	      		document.form3.chk[i].checked = true;
			else
				document.form3.chk[i].checked = false;
	    }
	 }
	return false;
}
</script>
					 <form  name="form3"action="del_plsc.php" method="post">  <input name="tab" type="hidden" value="sll">   
                    
                    
                    <?php do { ?>
                      <tr bgcolor="#FFFFFF" style="cursor: hand;" onMouseOver="this.style.backgroundColor='#F0F0F0'" onMouseOut="this.style.backgroundColor=''">
                        <td><input name="nid[]" type="checkbox" id='chk' value="<?php echo $row_Recinfo['id']; ?>"></td>
                        <td  height="50"><?php echo $row_Recinfo['id']; ?></td>
                        <td ><?php echo $row_Recinfo['sLL_hao'];
						
				           ?></td>
                        <td ><?php echo $row_Recinfo['a']; ?></td>
                        <td>
                        <?php 
						$b=$row_Recinfo['b'];
						switch ($b)
						{
						case 0:
						echo '不限号段';
						break;
						
						case -1:
						echo '价格面议';
						break;
							
						case 1:
						echo '800元以下';
						break;
						case 2:
						echo "800-1500元";
						break;
						
						case 3:
						echo "1500-3000元";
						break;
							
						case 4:
						echo "3000-5000元";
						break;	
						
						case 5:
						echo "5000-9000元";
						break;	
						case 6:
						echo "9000-8万元";
						break;	
						case 7:
						echo "8万元以上";
						break;
						
						}
						
						
						 ?></td>
                        <td><?php /*$c= $row_Recinfo['c']; 
						
						
						switch ($c)
						{
							case 0:
						echo "不限规律";
						break;
							
						case 1:
						echo "普通号码";
						break;
						case 2:
						echo "100-500元";
						break;
						
						case 3:
						echo "500-1000元";
						break;
							
						case 4:
						echo "1000-2000元";
						break;	
						
						case 5:
						echo "2000-5000元";
						break;
						
						case 6:
						echo "5000-10000元";
						break;
						
						case 7:
						echo "10000元以上";
						break;
						
							}
						*/
						
						
						?>
                        
                      <LABEL class=ms_label></LABEL> <SELECT name=c id="c"><OPTION selected 
  value=0 <?php if (!(strcmp(0, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>不限规律</OPTION><OPTION value=1 <?php if (!(strcmp(1, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>普通号码</OPTION><OPTION 
  value=19 <?php if (!(strcmp(19, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AAA</OPTION><OPTION value=20 <?php if (!(strcmp(20, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数ABC</OPTION><OPTION 
  value=14 <?php if (!(strcmp(14, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AAAA</OPTION><OPTION value=13 <?php if (!(strcmp(13, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数ABCD</OPTION><OPTION 
  value=17 <?php if (!(strcmp(17, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AAAB</OPTION><OPTION value=15 <?php if (!(strcmp(15, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AABB</OPTION><OPTION 
  value=18 <?php if (!(strcmp(18, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数ABAB</OPTION><OPTION value=16 <?php if (!(strcmp(16, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数ABBA</OPTION><OPTION 
  value=12 <?php if (!(strcmp(12, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AAAAA</OPTION><OPTION value=11 <?php if (!(strcmp(11, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数ABCDE</OPTION><OPTION 
  value=9 <?php if (!(strcmp(9, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AAABB</OPTION><OPTION value=8 <?php if (!(strcmp(8, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AABAA</OPTION><OPTION 
  value=10 <?php if (!(strcmp(10, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AABBB</OPTION><OPTION value=6 <?php if (!(strcmp(6, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数ABCABC</OPTION><OPTION 
  value=5 <?php if (!(strcmp(5, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AABBCC</OPTION><OPTION value=4 <?php if (!(strcmp(4, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AAABBB</OPTION><OPTION 
  value=7 <?php if (!(strcmp(7, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数ABBABB</OPTION><OPTION value=3 <?php if (!(strcmp(3, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数AAAAA+</OPTION><OPTION 
  value=2 <?php if (!(strcmp(2, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>尾数ABCDE+</OPTION><OPTION value=27 <?php if (!(strcmp(27, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>中间AAA</OPTION><OPTION 
  value=25 <?php if (!(strcmp(25, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>中间AAAA</OPTION><OPTION value=26 <?php if (!(strcmp(26, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>中间AABB</OPTION><OPTION 
  value=24 <?php if (!(strcmp(24, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>中间AAABB</OPTION><OPTION value=23 <?php if (!(strcmp(23, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>中间AABBB</OPTION><OPTION 
  value=22 <?php if (!(strcmp(22, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>中间AAAA+</OPTION><OPTION value=28 <?php if (!(strcmp(28, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>中间AABBCC</OPTION><OPTION 
  value=21 <?php if (!(strcmp(21, $row_Recinfo['c']))) {echo "selected=\"selected\"";} ?>>中间AAABBB</OPTION></SELECT>
  
  

                        
                        
                        
                        </td>
                        <td><?php $E=$row_Recinfo['aprm'];
						
						switch ($E)
						{
							case 0:
						echo '不限';
						break;
						
						case 10:
						echo '低于0.1元/分钟';
						break;
						case 20:
						echo "0.1-0.2元/分钟";
						break;
						
						case 30:
						echo "0.2-0.3元/分钟 ";
						break;
							
						
						
						}
						
						
						
						
						 ?></td>
                        <td>
                        
                        
                       <div> <LABEL class=ms_label for=letter></LABEL> <SELECT name=minprice>
                          <OPTION 
  selected value=0 <?php if (!(strcmp(0, $row_Recinfo['minprice']))) {echo "selected=\"selected\"";} ?>>不限</OPTION>
                          <OPTION value=0-1000 selected? <?php if (!(strcmp("0-1000", $row_Recinfo['minprice']))) {echo "selected=\"selected\"";} ?>>1000元以下</OPTION>
                          <OPTION value=1000-4000 <?php if (!(strcmp("1000-4000", $row_Recinfo['minprice']))) {echo "selected=\"selected\"";} ?>>1000-4000元</OPTION><OPTION 
  value=4000-8000 <?php if (!(strcmp("4000-8000", $row_Recinfo['minprice']))) {echo "selected=\"selected\"";} ?>>4000-8000元</OPTION><OPTION value=8000-90000 <?php if (!(strcmp("8000-90000", $row_Recinfo['minprice']))) {echo "selected=\"selected\"";} ?>>8000-9万</OPTION>
                          <OPTION value=90000-1000000 <?php if (!(strcmp("90000-1000000", $row_Recinfo['minprice']))) {echo "selected=\"selected\"";} ?>>9万以上</OPTION></SELECT> </LABEL><br>
</div><div style=" margin-top:5px;">
    <?php 
	$tc=$row_Recinfo['tctype'];
	switch($tc){
		case 0:
						echo '不限';
						break;
						
						case 1:
						echo '年套餐';
						break;
						case 2:
						echo "月套餐";
						break;
						
						
						
		}
	
	
	?>                    
        </div>                
                        </td>
                        <!--<td><?php $f=$row_Recinfo['info_top'];
						
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
						
						
						 ?></td>-->
                        <td><?php echo $row_Recinfo['s_price']; ?></td>
                        <td><?php echo $row_Recinfo['zding']; ?>
                          <?php /*$b=$row_Recinfo['tel'];
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
						}*/
						 ?></td>
                        <td><?php if($row_Recinfo['hfei']!=""){ 
						echo $row_Recinfo['hfei'];}else{
						echo "0"; }?>元</td>
                        <td><?php echo $row_Recinfo['message']; ?></td>
                        <td><?php echo $row_Recinfo['tszf']; ?></td>
                        <!--<td><img src="../images/<?php echo $row_Recinfo['phpoto']; ?>" width="100"></td>-->
                        <td><?php echo $row_Recinfo['info_editor']; ?></td>
                        <td><?php echo $row_Recinfo['l_tel']; ?></td>
                        <td><?php echo $row_Recinfo['wx']; ?></td>
                        <td><?php echo $row_Recinfo['time']; ?></td>
						  
					
                        <td width="5%" align="center"><font size="2"><a href="sLL_fix.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."id=".$row_Recinfo['id'] ?>">编辑</a> —<a href="sLL_Del.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."id=".$row_Recinfo['id'] ?>">删除</a></font></td>
                      </tr>
                      <?php } while ($row_Recinfo = mysql_fetch_assoc($Recinfo)); ?>
                  
				   <tr><td colspan="7"><!--<a href="" onClick="return chek();">全部选择/取消</a>--><input name="null" type="button" value="全部选择/取消" onClick="return chek();">&nbsp;&nbsp;<input name="tj" type="submit" value="批量删除" onclick = 'return del();'></form></td></tr>
				  <?php }?>
                   <?php if($totalRows_Recinfo==0&&$key!=""){ ?>
                 <tr align="center" bgcolor="#FFFFFF" style="cursor: hand;" onMouseOver="this.style.backgroundColor='#F0F0F0'" onMouseOut="this.style.backgroundColor=''">
                        <td  height="50" colspan="19">没有您要查询的号码！</td>
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