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

$MM_restrictGoTo = "index.php";
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

$maxRows_Recordset1 = 20;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM `order` ORDER BY id DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>

<html>
<head>
<title>在线订单管理</title>
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
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
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
                <td><strong><font color="#FF0000" size="3">在线订单管理</font></strong><font color="#FF0000" size="3">：</font>
                  <hr size="1" noshade> 
                 
                   
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
					 <form  name="form3"action="del_plsc.php" method="post"><input name="tab" type="hidden" value="order">
                      <?php do { ?>
                        <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
                          <table  bgcolor="#CCCCCC"width="100%" border="0" cellspacing="1" cellpadding="2">
                            <tr bgcolor="#CCCCCC" align="center">
                              <td width="119" rowspan="2" valign="middle"  bgcolor="#eaf8ff"><h3 style="margin-top:15px;">
                                <input name="nid[]" type="checkbox" id='chk' value="<?php echo $row_Recordset1['id']; ?>">
                              第<?php echo $row_Recordset1['id']; ?>单 <?php if($row_Recordset1['state']==1){echo '<img  src="./Images/dh.png" width="22"/>';}?></h3></td>
                              <td bgcolor="#EAEAEA"><font size="2">客户姓名</font></td>
                              <td bgcolor="#EAEAEA"><!--手机--></td>
                              <td width="64" bgcolor="#EAEAEA">联系手机</td>
                              <td width="64" bgcolor="#EAEAEA">邮箱</td>
                              <td width="76" align="center" bgcolor="#EAEAEA"><font size="2">执行功能</font></td>
                            </tr>
                            <tr bgcolor="#FFFFFF" align="center">
                              <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['name']; ?></td>
                              <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['mobile']; ?></td>
                              <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['lxtel']; ?></td>
                              <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['email']; ?></td>
                              <td width="76" align="center" bgcolor="#FFFFFF"><font size="2"> <a href="zxdd_del.php?id=<?php echo $row_Recordset1['id']; ?>">删除</a></font></td>
                            </tr>
                            <!-- <tr bgcolor="#FFFFFF">
                            <td colspan="6">公司名称：<?php echo $row_Recordset1['gsmc']; ?></td>
                          </tr>
                          
                          <tr bgcolor="#FFFFFF">
                            <td colspan="6">联系地址：<?php echo $row_Recordset1['address']; ?></td>
                          </tr>-->
                            <tr bgcolor="#FFFFFF">
                              <td height="60" colspan="6" valign="top"><!--<p>标题：&nbsp;&nbsp;&nbsp;<?php echo $row_Recordset1['title']; ?></p>-->
                              <p>收货地址：<?php echo $row_Recordset1['address']; ?></p>
                                <p style="margin-top:10px;">留言内容：<?php echo nl2br(htmlspecialchars($row_Recordset1['message'])); ?>
                             
                              <!--<p>订单时间：<?php echo $row_Recordset1['time']; ?></p></td>-->
                            </tr>
                            <tr >
                              <td height="110" colspan="6" valign="top"><table width="100%" height="77" border="0" cellpadding="0" cellspacing="1" background="#CCCCCC">
                              <tr>
                                  <td colspan="9" align="left" bgcolor="#FFFFFF">　订单号：<?php echo $row_Recordset1['order_no']; ?>　　成交时间：<?php if($row_Recordset1['state']==1){echo date("Y-m-d H:i:s",$row_Recordset1['update_time']);}else{echo "未成交";} ?></td>
                                </tr>
                                <tr>
                                  <td align="center" bgcolor="#FFFFFF">购买的号码</td>
                                 <!-- <td align="center" bgcolor="#FFFFFF">订单号</td>-->
                                  <td align="center" bgcolor="#FFFFFF">流水号</td>
                                  <td align="center" bgcolor="#FFFFFF">实收款</td>
                                  <td align="center" bgcolor="#FFFFFF">付款方式</td>
                                  <td align="center" bgcolor="#FFFFFF">支付状态</td>
                                  <td align="center" bgcolor="#FFFFFF">拍下时间</td>
                                 <!-- <td align="center" bgcolor="#FFFFFF">付款时间</td>-->
                                  <td align="center" bgcolor="#FFFFFF">订单状态</td>
                                </tr>
                                
                                <tr align="center">
                                  <td height="27" bgcolor="#FFFFFF"><?php echo $row_Recordset1['sjh']; ?></td>
                                  <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['trade_no']; ?></td>
                                <!--  <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['trade_no']; ?></td>-->
                                  <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['order_money']; ?></td>
                                  <td bgcolor="#FFFFFF"><?php if($row_Recordset1['pay_type']=="zfb"){echo "支付宝";}else{echo "微信";} ?></td>
                                  <td bgcolor="#FFFFFF"><?php if($row_Recordset1['state']==1){echo '<span style=" color:red;">买家已付款</span>';}else{echo '<span style=" color:#0000FF;">等待买家付款</span>';} ?> </td>
                                  <td bgcolor="#FFFFFF"><?php echo date("Y-m-d H:i:s",$row_Recordset1['addtime']); ?></td>
                                 <!-- <td bgcolor="#FFFFFF"><?php echo date("Y-m-d H:i:s",$row_Recordset1['update_time']); ?></td>-->
                                  <td bgcolor="#FFFFFF">&nbsp;</td>
                                </tr>
                              </table></td>
                            </tr>
                            
                          </table><hr color="#FF9900" size="3" style="margin-top:-10px; margin-bottom:0px;">
                          <?php } // Show if recordset not empty ?>
                        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                         <tr><td colspan="7"><!--<a href="" onClick="return chek();">全部选择/取消</a>--><input name="null" type="button" value="全部选择/取消" onClick="return chek();">&nbsp;&nbsp;<input name="tj" type="submit" value="批量删除" onclick = 'return del();'></form></td></tr>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  
 <tr bgcolor="#FFFFFF">
                      <td width="63%"> &nbsp; &nbsp; &nbsp; &nbsp;记录 <?php echo ($startRow_Recordset1 + 1) ?> 到 <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?> (总共 <?php echo $totalRows_Recordset1 ?> 条）</td>
                            <td width="37%" colspan="4" align="center">
                              <table border="0">
                                <tr>
                                  <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                                      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">第一页</a>
                                      <?php } // Show if not first page ?>
                                    <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                                      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">前一页</a>
                                      <?php } // Show if not first page ?>
                                    <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                                      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">下一页</a>
                                      <?php } // Show if not last page ?>
                                    <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                                      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">最后一页</a>
                                      <?php } // Show if not last page ?></td>
                                </tr>
                      </table></td>
                    </tr>
</table>

<?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
  <table width="100%">
    <tr bgcolor="#FFFFFF">
      <td height="50" colspan="5" align="center">数据库没有任何留言信息哦！</td>
    </tr>
  </table>
  <?php } // Show if recordset empty ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr align="right">
                      <td>&nbsp;</td>
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
