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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE sy_news SET news_time=%s, news_title=%s, news_editor=%s, news_top=%s, news_content=%s, quyu=%s WHERE news_id=%s",
                       GetSQLValueString($_POST['news_time'], "date"),
                       GetSQLValueString($_POST['news_title'], "text"),
                       GetSQLValueString($_POST['news_editor'], "text"),
                       GetSQLValueString($_POST['news_top'], "int"),
                       GetSQLValueString($_POST['news_content'], "text"),
                       GetSQLValueString($_POST['quyu'], "text"),
                       GetSQLValueString($_POST['news_id'], "int"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($updateSQL, $connch21) or die(mysql_error());

  $updateGoTo = "s_newsAdmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO photo (title, top, rePic) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['top'], "int"),
                       GetSQLValueString($_POST['rePic'], "text"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($insertSQL, $connch21) or die(mysql_error());

  /*$insertGoTo = "s_newsFix.php?news_id=3";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));*/
  
  echo "<script language='javascript'>alert('提交保存成功!');location.href='s_newsFix.php?news_id=3#aaa';</script>";
  
}

$colname_Rec_s_news = "-1";
if (isset($_GET['news_time'])) {
  $colname_Rec_s_news = $_GET['news_time'];
}
mysql_select_db($database_connch21, $connch21);
$query_Rec_s_news = sprintf("SELECT * FROM sy_news WHERE news_time = %s", GetSQLValueString($colname_Rec_s_news, "date"));
$Rec_s_news = mysql_query($query_Rec_s_news, $connch21) or die(mysql_error());
$row_Rec_s_news = mysql_fetch_assoc($Rec_s_news);
$colname_Rec_s_news = "-1";
if (isset($_GET['news_id'])) {
  $colname_Rec_s_news = $_GET['news_id'];
}
mysql_select_db($database_connch21, $connch21);
$query_Rec_s_news = sprintf("SELECT * FROM sy_news WHERE news_id = %s", GetSQLValueString($colname_Rec_s_news, "int"));
$Rec_s_news = mysql_query($query_Rec_s_news, $connch21) or die(mysql_error());
$row_Rec_s_news = mysql_fetch_assoc($Rec_s_news);
$totalRows_Rec_s_news = mysql_num_rows($Rec_s_news);

mysql_select_db($database_connch21, $connch21);
$query_Rec_dfl = "SELECT * FROM sy_bigclass";
$Rec_dfl = mysql_query($query_Rec_dfl, $connch21) or die(mysql_error());
$row_Rec_dfl = mysql_fetch_assoc($Rec_dfl);
$totalRows_Rec_dfl = mysql_num_rows($Rec_dfl);

$maxRows_Rec_photo = 5;
$pageNum_Rec_photo = 0;
if (isset($_GET['pageNum_Rec_photo'])) {
  $pageNum_Rec_photo = $_GET['pageNum_Rec_photo'];
}
$startRow_Rec_photo = $pageNum_Rec_photo * $maxRows_Rec_photo;

mysql_select_db($database_connch21, $connch21);
$query_Rec_photo = "SELECT * FROM photo ORDER BY id DESC";
$query_limit_Rec_photo = sprintf("%s LIMIT %d, %d", $query_Rec_photo, $startRow_Rec_photo, $maxRows_Rec_photo);
$Rec_photo = mysql_query($query_limit_Rec_photo, $connch21) or die(mysql_error());
$row_Rec_photo = mysql_fetch_assoc($Rec_photo);

if (isset($_GET['totalRows_Rec_photo'])) {
  $totalRows_Rec_photo = $_GET['totalRows_Rec_photo'];
} else {
  $all_Rec_photo = mysql_query($query_Rec_photo);
  $totalRows_Rec_photo = mysql_num_rows($all_Rec_photo);
}
$totalPages_Rec_photo = ceil($totalRows_Rec_photo/$maxRows_Rec_photo)-1;

$colname_Rec_xg = "-1";
if (isset($_GET['xid'])) {
  $colname_Rec_xg = $_GET['xid'];
}
mysql_select_db($database_connch21, $connch21);
$query_Rec_xg = sprintf("SELECT * FROM photo WHERE id = %s", GetSQLValueString($colname_Rec_xg, "int"));
$Rec_xg = mysql_query($query_Rec_xg, $connch21) or die(mysql_error());
$row_Rec_xg = mysql_fetch_assoc($Rec_xg);
$totalRows_Rec_xg = mysql_num_rows($Rec_xg);

$queryString_Rec_photo = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Rec_photo") == false && 
        stristr($param, "totalRows_Rec_photo") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Rec_photo = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Rec_photo = sprintf("&totalRows_Rec_photo=%d%s", $totalRows_Rec_photo, $queryString_Rec_photo);
?>

<?php  header("Content-type: text/html; charset=utf-8");


$xid=$_GET['xid'];
if((isset($_POST['xiugai']))){
	
$sql="UPDATE `photo` SET `title`='".$_POST['title']."',`top`='".$_POST['top']."',`rePic`='".$_POST['rePic']."' WHERE id='".$xid."' ";
mysql_query($sql,$connch21);
echo "<script language='javascript'>alert('修改成功!');location.href='s_newsFix.php?news_id=3#aaa';</script>"
;
}
	
$fid=$_GET['id']; 
if ((isset($fid))){
$sql="delete from photo where id='".$fid."' "; 
mysql_query($sql,$connch21);
//删除相关图片
$imgSource="images/".$_GET['delpic'];
unlink($imgSource);//执行操作

echo "<script language='javascript'>alert('删除成功!');location.href='s_newsFix.php?news_id=3#aaa';</script>"

 ;} ?>

<html>
<head>
<title>主栏目管理</title>
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
#showImg { width:60px;
}
img { border:0;
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
				
				
				
				
				
				
				
              <style type="text/css">
a {
	text-decoration: none;
}
</style>
<?php include("s_nav_left.php");?>  
                
                
                
                
				
				
				
				
				
				
			&nbsp;</td>
              </tr>
            </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="29" background="images/diary_r1_c4.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td><font color="#FF0000" size="3"><strong>修改分类页面</strong></font> 
                  <hr size="1" noshade> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" style="margin=0px;">
                          <table width="100%" border="0" cellspacing="1" cellpadding="2">
                            <tr> 
                              <td width="24" align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">日期：</font></strong></td>
                              <td colspan="4" valign="top"><font size="2"> 
                                <input name="news_time" type="text" id="news_time" value="<?php echo $row_Rec_s_news['news_time']; ?>">
                                <input name="news_id" type="hidden" id="news_id" value="<?php echo $row_Rec_s_news['news_id']; ?>">
                              </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">标题：</font></strong></td>
                              <td colspan="4" valign="top"><font size="2"> 
                                <input name="news_title" type="text" id="news_title" value="<?php echo $row_Rec_s_news['news_title']; ?>">
                                </font></td>
                            </tr>
                            <tr> 
                              <td align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">首页推荐：</font></strong></td>
                              <td width="145" valign="top"> 
                                <input <?php if (!(strcmp($row_Rec_s_news['news_top'],"1"))) {echo "checked=\"checked\"";} ?>  name="news_top" type="radio" value="1" checked>
                                是
                                <input <?php if (!(strcmp($row_Rec_s_news['news_top'],"0"))) {echo "checked=\"checked\"";} ?>  name="news_top" type="radio" value="0">
否  </td>
                              <td width="63" valign="top">大分类:</td>
                              <td width="96" valign="top"><label for="quyu"></label>
                                <select name="quyu" id="quyu">
                                  <?php
do {  
?>
                                  <option value="<?php echo $row_Rec_dfl['classname']?>"<?php if (!(strcmp($row_Rec_dfl['classname'], $row_Rec_s_news['quyu']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Rec_dfl['classname']?></option>
                                  <?php
} while ($row_Rec_dfl = mysql_fetch_assoc($Rec_dfl));
  $rows = mysql_num_rows($Rec_dfl);
  if($rows > 0) {
      mysql_data_seek($Rec_dfl, 0);
	  $row_Rec_dfl = mysql_fetch_assoc($Rec_dfl);
  }
?>
                              </select></td>
                              
                            </tr>
                            <tr> 
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">新闻内容：</font></strong></td>
                              <td colspan="4" valign="top"> 
                                <textarea name="news_content" style="width:550px; height:300px;" rows="1" cols="20" id="news_content"><?php echo $row_Rec_s_news['news_content']; ?></textarea></td>
                            </tr>
                           
                              <td align="right" valign="top" bgcolor="#999999"><strong><font color="#FFFFFF" size="2">发布人：<br>
                                </font></strong></td>
                              <td colspan="4" valign="top"> <font size="2">
                                 <input name="news_editor" type="text" id="news_editor" value="<?php echo $row_Rec_s_news['news_editor']; ?>">
                            </font></td></tr>  
                              
                          </table>
                          <script type="text/javascript">
										var editor = UE.getEditor('news_content');
								</script>
<input type="submit" name="Submit2" value="递交">
                          <input type="reset" name="Submit3" value="重设">
                          <input type="button" name="Submit4" value="回上一页" onClick="window.history.back();">
                          <input type="hidden" name="MM_update" value="form1">
                     
                      
                      </form>
                      
                      </td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          <td><img name="diary_r1_c5" src="images/diary_r1_c5.gif" width="12" height="29" border="0" alt=""></td>
        </tr>
        <tr bgcolor="#EEEEEE"> 
          <td height="12"><a name="aaa"></a><table width="20" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
  <tr>
    <td bgcolor="#EEEEEE">
    
    <script language="javascript">
function tijiao(){
	if(form2.title.value==""){
		alert("图片标题不能为空!");
		form2.title.focus();
		return false;		
		}
	
	if(form2.rePic.value==""){
		alert("图片不能为空!");
		
		/*addform.rePic.focus();
		return false;		*/
		}	
	}
</script>





<?php //news_id，代码开关开始。news_id=3,即等于服务客户分类，这个上传图片框才显示

$new=$_GET['news_id'];
if($new==3){

?>


<!--服务客户代码开始-->
<?php 
if(isset($xid)){ ?>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#EEEEEE">
         
       <form id="form2" name="form2" method="POST" action="<?php echo $editFormAction; ?>" onSubmit="return tijiao();">  <table width="100%" border="1" cellspacing="1" cellpadding="0">
  <tr>
    <td>  &nbsp;<span style="color:#F00">*</span>服务客户图片上传：
            
              <p>
                <label for="title">&nbsp;图片名称：</label>
                <input name="title" type="text" id="title" value="<?php echo $row_Rec_xg['title']; ?>" />
              </p>
              <p>首页显示：
                <label>
                  <input <?php if (!(strcmp($row_Rec_xg['top'],"1"))) {echo "checked=\"checked\"";} ?> name="top" type="radio" id="RadioGroup1_0" value="1">
                  是
                </label>
               
                <label>
                  <input <?php if (!(strcmp($row_Rec_xg['top'],"0"))) {echo "checked=\"checked\"";} ?> name="top" type="radio" id="RadioGroup1_1" value="0" checked>
                  否</label>
                <br>
                <br />
                <br /><script type="text/javascript">  

function openwindow(url,name,iWidth,iHeight)  
{  
// url 转向网页的地址   
// name 网页名称，可为空   
// iWidth 弹出窗口的宽度   
// iHeight 弹出窗口的高度   
//window.screen.height获得屏幕的高，window.screen.width获得屏幕的宽   
var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;   
var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;   
window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');  
}  

</script>  
                <div style="border:1px solid #999;">上传图片：&nbsp;<img  src="images/<?php echo $row_Rec_xg['rePic']; ?>" alt="这是显示上传预览图片的位置" name="showImg" id="showImg" onclick='javascript:alert(&quot;这是显示上传预览图片的位置&quot;);' 
   />
                <input type="button" name="Submit" value="浏览..." onClick="javascript:openwindow('fupload.php?useForm=form2&amp;prevImg=showImg&amp;upUrl=images&amp;ImgS=500&amp;ImgW=300&amp;ImgH=200&amp;reItem=rePic','fileUpload',400,180)" />
                <input name="rePic" type="hidden" id="rePic" value="<?php echo $row_Rec_xg['rePic']; ?>" size="4" /></div>
                <p align="center"><font color="#FF0000"><strong>请修改内容！</strong></font></p>
                
                <!--<input type="hidden" name="MM_insert" value="form2">-->
              </p>
            </td>
  </tr>
  <tr>
    <td align="center" valign="middle"> <br>
    <?php if($xid){ ?> <input name="xiugai" type="hidden" id="xiugai" value="form2">
    
    <span style="position: relative;top:-10px;"><input type="submit" name="button" id="button" value="修改保存">　　<input type="button" name="Submit4" value="回上一页" onClick="window.history.back();"></span>　<?php } else { ?>      &nbsp;<span style="position: relative;top:-10px;"><input type="submit" name="button" id="button" value="提交保存"></span><?php } ?>
     
      <br>
    </td>
  </tr>
</table></form>
 
          
          
          
        <center><strong><a href="#aaa">服务客户品牌例表</a></strong></center>
          </td>
        </tr>
        
        
         <?php if ($totalRows_Rec_photo > 0) { // Show if recordset not empty ?>
        
        <?php do { ?>
          <tr>
          <td> 

<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
              <tr align="center">
                <td colspan="4" bgcolor="#FFFFFF"></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
              <tr align="center">
                <td width="12%" bgcolor="#CCCCCC">编号</td>
                <td width="25%" bgcolor="#CCCCCC">图片</td>
                <td width="24%" bgcolor="#CCCCCC">标题</td>
                <td width="24%" bgcolor="#CCCCCC">&nbsp;</td>
                <td width="15%" bgcolor="#CCCCCC">执行功能</td>
                </tr>
              <tr align="center">
                <td align="center" bgcolor="#FFFFFF"><?php echo $row_Rec_photo['id']; ?></td>
                <td align="left" bgcolor="#FFFFFF"><img src="images/<?php echo $row_Rec_photo['rePic']; ?>" width="120"></td>
                <td bgcolor="#FFFFFF"><?php echo $row_Rec_photo['title']; ?></td>
                <td bgcolor="#FFFFFF"><?php if($row_Rec_photo['top'] =="1") {?>[首页显示]<?php }?></td>
                <td bgcolor="#FFFFFF">
                
           <a href="s_newsFix.php?news_id=3&xid=<?php echo $row_Rec_photo['id']; ?>&delpic=<?php echo $row_Rec_photo['rePic']; ?>#aaa">修改</a> | <a href="s_newsFix.php?news_id=3&id=<?php echo $row_Rec_photo['id']; ?>&delpic=<?php echo $row_Rec_photo['rePic']; ?>">删除</a></td>
                </tr>
              <tr>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
          <?php } while ($row_Rec_photo = mysql_fetch_assoc($Rec_photo)); ?>
          <?php }  ?>

          
          
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="56%" align="center">记录 <?php echo ($startRow_Rec_photo + 1) ?> 到 <?php echo min($startRow_Rec_photo + $maxRows_Rec_photo, $totalRows_Rec_photo) ?> (总共 <?php echo $totalRows_Rec_photo ?>)</td>
    <td width="44%" align="center"><?php if ($totalRows_Rec_photo == 0) { // Show if recordset empty ?>
  <p align="center">暂无合作客户图片信息！
  <?php } // Show if recordset empty ?><table border="0">
  <tr>
    <td><?php if ($pageNum_Rec_photo > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Rec_photo=%d%s", $currentPage, 0, $queryString_Rec_photo); ?>"><img src="First.gif"></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Rec_photo > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Rec_photo=%d%s", $currentPage, max(0, $pageNum_Rec_photo - 1), $queryString_Rec_photo); ?>"><img src="Previous.gif"></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Rec_photo < $totalPages_Rec_photo) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Rec_photo=%d%s", $currentPage, min($totalPages_Rec_photo, $pageNum_Rec_photo + 1), $queryString_Rec_photo); ?>"><img src="Next.gif"></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Rec_photo < $totalPages_Rec_photo) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Rec_photo=%d%s", $currentPage, $totalPages_Rec_photo, $queryString_Rec_photo); ?>"><img src="Last.gif"></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table></td>
  </tr>
</table>


</td>
        </tr>
      </table>

<?php } else {?>


<table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#EEEEEE">
         
       <form id="form2" name="form2" method="POST" action="<?php echo $editFormAction; ?>" onSubmit="return tijiao();">  <table width="100%" border="1" cellspacing="1" cellpadding="0">
  <tr>
    <td>  &nbsp;<span style="color:#F00">*</span>服务客户图片上传：
            
              <p>
                <label for="title">&nbsp;图片名称：</label>
                <input type="text" name="title" id="title" />
              </p>
              <p>首页显示：
                <label>
                  <input name="top" type="radio" id="RadioGroup1_0" value="1">
                  是
                </label>
               
                <label>
                  <input name="top" type="radio" id="RadioGroup1_1" value="0" checked>
                  否</label>
                <br>
                <br />
                <br /><script type="text/javascript">  

function openwindow(url,name,iWidth,iHeight)  
{  
// url 转向网页的地址   
// name 网页名称，可为空   
// iWidth 弹出窗口的宽度   
// iHeight 弹出窗口的高度   
//window.screen.height获得屏幕的高，window.screen.width获得屏幕的宽   
var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;   
var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;   
window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');  
}  

</script>  
                <div style="border:1px solid #999;">上传图片：&nbsp;<img  src="icon_prev.gif" alt="这是显示上传预览图片的位置" name="showImg" id="showImg" onclick='javascript:alert(&quot;这是显示上传预览图片的位置&quot;);' 
   />
                <input type="button" name="Submit" value="浏览..." onClick="javascript:openwindow('fupload.php?useForm=form2&amp;prevImg=showImg&amp;upUrl=images&amp;ImgS=500&amp;ImgW=300&amp;ImgH=200&amp;reItem=rePic','fileUpload',400,180)" />
                <input name="rePic" type="hidden" id="rePic" size="4" /></div>
               
                <input type="hidden" name="MM_insert" value="form2">
              </p>
            </td>
  </tr>
  <tr>
    <td align="center" valign="middle"> <br>&nbsp;<span style="position: relative;top:-10px;"><input type="submit" name="button" id="button" value="提交保存"> 　<input type="button" name="Submit4" value="回上一页" onClick="location.href='s_newsAdmin.php';"></span>
     
      <br>
    </td>
  </tr>
</table></form>
 
          
          
          
        <center><strong><a href="#aaa">服务客户品牌例表</a></strong></center>
          </td>
        </tr>
       
       
       
         <?php if ($totalRows_Rec_photo > 0) { // Show if recordset not empty ?>
       
        <?php do { ?>
          <tr>
          <td> 

<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
              <tr align="center">
                <td colspan="4" bgcolor="#FFFFFF"></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
              <tr align="center">
                <td width="12%" bgcolor="#CCCCCC">编号</td>
                <td width="25%" bgcolor="#CCCCCC">图片</td>
                <td width="24%" bgcolor="#CCCCCC">标题</td>
                <td width="24%" bgcolor="#CCCCCC">&nbsp;</td>
                <td width="15%" bgcolor="#CCCCCC">执行功能</td>
                </tr>
              <tr align="center">
                <td align="center" bgcolor="#FFFFFF"><?php echo $row_Rec_photo['id']; ?></td>
                <td align="left" bgcolor="#FFFFFF"><img src="images/<?php echo $row_Rec_photo['rePic']; ?>" width="120"></td>
                <td bgcolor="#FFFFFF"><?php echo $row_Rec_photo['title']; ?></td>
                <td bgcolor="#FFFFFF"><?php if($row_Rec_photo['top'] =="1") {?>[首页显示]<?php }?></td>
                <td bgcolor="#FFFFFF">
                
           <a href="s_newsFix.php?news_id=3&xid=<?php echo $row_Rec_photo['id']; ?>&delpic=<?php echo $row_Rec_photo['rePic']; ?>#aaa">修改</a> | <a href="s_newsFix.php?news_id=3&id=<?php echo $row_Rec_photo['id']; ?>&delpic=<?php echo $row_Rec_photo['rePic']; ?>">删除</a></td>
                </tr>
              <tr>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
          <?php } while ($row_Rec_photo = mysql_fetch_assoc($Rec_photo)); ?>
          
      
      <?php }  ?>


<tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="56%" align="center">记录 <?php echo ($startRow_Rec_photo + 1) ?> 到 <?php echo min($startRow_Rec_photo + $maxRows_Rec_photo, $totalRows_Rec_photo) ?> (总共 <?php echo $totalRows_Rec_photo ?>)</td>
    <td width="44%" align="center"><?php if ($totalRows_Rec_photo == 0) { // Show if recordset empty ?>
  <p align="center">暂无合作客户图片信息！
  <?php } // Show if recordset empty ?><table border="0">
  <tr>
    <td><?php if ($pageNum_Rec_photo > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Rec_photo=%d%s", $currentPage, 0, $queryString_Rec_photo); ?>"><img src="First.gif"></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Rec_photo > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Rec_photo=%d%s", $currentPage, max(0, $pageNum_Rec_photo - 1), $queryString_Rec_photo); ?>"><img src="Previous.gif"></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Rec_photo < $totalPages_Rec_photo) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Rec_photo=%d%s", $currentPage, min($totalPages_Rec_photo, $pageNum_Rec_photo + 1), $queryString_Rec_photo); ?>"><img src="Next.gif"></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Rec_photo < $totalPages_Rec_photo) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Rec_photo=%d%s", $currentPage, $totalPages_Rec_photo, $queryString_Rec_photo); ?>"><img src="Last.gif"></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table></td>
  </tr>
</table>


</td>
        </tr>
      </table><?php }?>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
  
      <p>&nbsp;</p>
      <p><br>
  </p></td></tr>
</table>

<?php //。代码开关结束。news_id=3,即等于服务客户分类，这个上传图片框才显示

}?>

</body>
</html>
<?php
mysql_free_result($Rec_s_news);

mysql_free_result($Rec_dfl);

mysql_free_result($Rec_photo);

mysql_free_result($Rec_xg);
?>
<?php mysql_close($connch21);?>