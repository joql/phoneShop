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

$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addform")) {
  $insertSQL = sprintf("INSERT INTO liuyan (name, phone, message, `time`) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['time'], "date"));

  mysql_select_db($database_connch21, $connch21);
  $Result1 = mysql_query($insertSQL, $connch21) or die(mysql_error());

 /* $insertGoTo = "ly.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}*/
echo "<script language='javascript'>alert('您给我们的留言已成功发布了!我们看到您的留言我尽快回复您哦！');histoty.go(-1);</script>";
}

?>
<script language="javascript">
function tijiao(){
	
if(addform.name.value==''){
	alert("名称不能为空！");
	addform.name.focus()
	return false;
	}
	
	if(addform.phone.value==''){
	alert("电话不能为空！");
	addform.phone.focus()
	return false;
	}
	if(addform.content.value==''){
	alert("内容不能为空！");
	addform.content.focus()
	return false;
	}
	
}

</script>
<div id="contact-tabs-container" class="swiper-container swiper-container-horizontal" data-swiper="[object Object]">
  <div class="swiper-wrapper">
    <div class="swiper-slide swiper-slide-active" style="width: 1423px;">
   	 	<div class="seller_contact">
        	<h1><a href="http://#/u/105497">玖玖靓号</a></h1>
            <div class="renzheng">
            	<i class="icon_rz sjrz on"></i><i class="icon_rz sfrz on"></i><i class="icon_rz yxrz on"></i><i class="icon_rz vip4"></i> 
            </div>
            <p><span>联系电话：</span><?php echo $row_Recordset1['l_tel']; ?></p>
          <p><span>联系QQ：</span>
						<a class="lxqq" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=110999999&site=qq&menu=yes"><img border="0" src="./index_files/qq.gif" alt="点击这里给我发消息" title="点击这里给我发消息"> 110999999</a>
						</p>
			<p><span>微信：</span><?php echo $row_Recordset1['wx']; ?></p>
			<p><span>地址：</span>哈尔滨市南岗区士课街39号玖玖靓号数码生活馆</p>
			<p><span>  </span></p>
            <div class="yjbh">
			<a class="telphone" href="tel:17745611099"><i class="icon_n"></i>电话联系</a>
           <!-- <a class="jrdp" href="#"><i class="icon_n"></i>进入选号</a>-->
            </div>
        </div>
       
    </div>
	
    <div class="swiper-slide swiper-slide-next" style="width: 1423px;">
      <div class="seller_reserve">
      <form action="<?php echo $ym ?>" method="POST" name="addform"  onsubmit="return tijiao();" class="uk-form" id="order">
	
		<input type="hidden" name="id" id="id" value="1839685">
		<input type="hidden" id="type" name="type" value="four">
       	  <p class="name icon_n"><input placeholder="请输入您的姓名" name="name" type="text" style="width:100%"></p>
          <p class="lxdh icon_n"><input placeholder="请输入您的电话" name="phone" type="text" style="width:100%"></p>
          <p class="lxdh icon_n"><input placeholder="请输入您的留言内容" name="content" type="text" style="width:100%"></p>
		  <!--<p class="lxdz icon_n"><input placeholder="请输入您的收货地址" name="useraddress" type="text" style="width:100%" /></p>-->
         
         <input name="time" type="hidden" value="<?php echo date("Y-m-d H:i:s");?>">
         <input type="submit" name="submit" class="tjyd" id="submit" value="提交预约">
		 
          <input type="hidden" name="MM_insert" value="addform" />
         </form>
       </div>
    </div>  
    </div>
  </div>