<?php require_once('../Connections/connch21.php'); 
@mysql_select_db($database_connch21,$connch21) or die("打开数据库错误");
?>
<?php error_reporting(E_ALL & ~E_NOTICE);

if($_POST['f_reg']){
	$f_name=$_POST['f_name'];
	$RealName=$_POST['RealName'];
	$Sex=$_POST['Sex'];
	$f_pass=$_POST['f_pass'];
	$f_pass2=$_POST['f_pass2'];
	$dwei=$_POST['dwei'];
	
	$Address=$_POST['Address'];
	$ZipCode=$_POST['ZipCode'];
	$Telephone=$_POST['Telephone'];
	
	$Mobile=$_POST['Mobile'];
	$Fax=$_POST['Fax'];
	$QQ=$_POST['QQ'];
	$Email=$_POST['Email'];
	$z_time=$_POST['z_time'];
	
	$ts1=$_POST['ts1'];
	$tsda=$_POST['tsda'];
	
//echo $uname.$upass.$upass2;
 if($f_pass!=$f_pass2){echo "<script language='javascript'>alert('两次密码输入不相同!');location.href='javascript:history.go(-1)';</script>";}
/*  if($_POST['yzm']==''){echo "<script language='javascript'>alert('验证码不能为空!');location.href='javascript:history.go(-1)';</script>";} */
	  if($_POST['yzm'] !== $_SESSION["vcode"]){echo "<script language='javascript'>alert('验证码错误!');location.href='javascript:history.go(-1)';</script>";} 
 
 
	else{
		
		$sql="select*from admin_zc where f_name='".$f_name."'";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	if($num>0){
	echo "<script language='javascript'>alert('你要注册的用户名已存在!');location.href='javascript:history.go(-1)';</script>";}
	
	else{
	
	
		$sql="insert into admin_zc (f_name,RealName,Sex,f_pass,f_pass2,dwei,Address,ZipCode,Telephone,Mobile,Fax,QQ,Email,z_time,ts1,tsda)values('".$f_name."','".$RealName."','".$Sex."','".md5(md5($f_pass))."','".$f_pass2."','".$dwei."','".$Address."','".$ZipCode."','".$Telephone."','".$Mobile."','".$Fax."','".$QQ."','".$Email."','".$z_time."','".$ts1."','".$tsda."')";
	mysql_query($sql)or die("注册失败");
	
	
	
	

	
	
	
	echo "<script language='javascript'>alert('恭喜您！已成功注册会员!');location.href='../index.php';</script>";
	}

} 

}

 ?>


<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script type="text/javascript" charset="utf-8" async src="./index_dl_files/crmqq.php"></script><script type="text/javascript" charset="utf-8" async src="./index_dl_files/contains.js"></script><script type="text/javascript" charset="utf-8" async src="./index_dl_files/localStorage.js"></script><script type="text/javascript" charset="utf-8" async src="./index_dl_files/Panel.js"></script>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
				
		
			    <?php include("../keyword.php");?>
		<link href="./index_dl_files/public.css" rel="stylesheet">
	<link href="./index_dl_files/buy.css" rel="stylesheet">
	<link href="./index_dl_files/ui-dialog.css" rel="stylesheet">
	
	
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  
  
  
  
   <!--验证用户名是否存在时用start-->
<script type="text/javascript" src="zze_yanzeng/jquery-1.7.1.js"></script> <!--千万别忘记引用jQuery文件，否则无法执行--> 
<script type="text/javascript"> 
$(function(){ 
/* //方式一 jQuery(普通应用时推荐，简单易用) 
$("#user").blur(function(){ //文本框鼠标焦点消失事件 
$.get("check_user.php?user="+$("#user").val(),null,function(data) //此处get方式 可换为post方式按需求调整，其他无需修改使用方式一样 
{ 
$("#chk").html(data); //向ID为chk的元素内添加html代码 
}); 
})  */
//方式二 aJax方式 (比较复杂，如无特殊需求推荐使用方式一) 
$("#user").blur(function(){ 
$.ajax({ 
url:"zze_yanzeng/check_user.php", //请求验证页面 
type:"GET", //请求方式 可换为post 注意验证页面接收方式 
data:"user="+$("#user").val(), //取得表提交“用户名”文本框数据，作为提交数据 注意前面的 user 此处格式 key=value 其他方式请参考ajax手册 我标注：此处传get变量user= 到check_user.php页
success: function(data) 
{ //请求成功时执行操作 我注：（查询成功时 ，出如下字段）
$("#chk").html(data); //向ID为chk的元素内添加html代码 
} 
}); 
}) 
}) 
</script>
<!--验证用户名是否存在时用over-->

<script>var webdir="";</script>
<script language="javascript" src="./index_files/jquery-1.4.4.min.js"></script>
<script language="javascript" src="./index_files/Common.js"></script>
<link href="./index_files/common.css" rel="stylesheet" type="text/css">


<script>
function getcode() 
{ document.getElementById("safecode").src="vcode/vcode.php?"+Math.random();}
</script>


  
<script language="javascript">
	function CheckForm()
	{
		if(document.formReg.f_name.value=="")
		{
			alert("请输入用户名！");
			document.formReg.f_name.focus();
			return false;
		}
		
		
		 if(document.formReg.f_name.value.length<6||formReg.f_name.value.length>20)
 {
  alert("你的用户名长度应该在6到20个字符之间");
  document.formReg.f_name.focus();
  return false;
 }
		
		
		
		if(document.formReg.RealName.value=="")
		{
			alert("请输入姓名！");
			document.formReg.RealName.focus();
			return false;
		}
		
		if(document.formReg.f_pass.value=="")
		{
			alert("请输入密码！");
			document.formReg.f_pass.focus();
			return false;
		}
		
		
		  if(document.formReg.f_pass.value.length<6||document.formReg.f_pass.value.length>20)
 {
  alert("你的密码长度应该在6到20个字符之间");
  document.formReg.f_pass.focus();
  return false;
 }
		
		
		
		
		
		if(document.formReg.f_pass2.value=="")
		{
			alert("请输入确认密码！");
			document.formReg.f_pass2.focus();
			return false;
		}
		
		
		 if(document.formReg.f_pass.value!=document.formReg.f_pass2.value)
 {
  alert("你的密码不一致");
  document.formReg.f_pass2.focus();
  return false;
 }
		
		
		
		
		if(document.formReg.dwei.value=="")
		{
			alert("请输入单位名称！");
			document.formReg.dwei.focus();
			return false;
		}
		if(document.formReg.Address.value=="")
		{
			alert("请输入地址！");
			document.formReg.Address.focus();
			return false;
		}
		if(document.formReg.Mobile.value.length<11)
		{
			alert("手机号不能少于11个字符！");
			document.formReg.Mobile.focus();
			return false;
		}
		if(document.formReg.QQ.value=="")
		{
			alert("请输入QQ！");
			document.formReg.QQ.focus();
			return false;
		}
		
		
		
		
		if ( document.formReg.Email.value=="") {
     alert("请填写你的电子邮件地址！");
     formReg.Email.focus()
     return false
     }
     var email = document.formReg.Email.value
     var is_error = false
     var pn_0 = email.indexOf("@")
     var pn_1 = email.indexOf(".",pn_0)
     var pn_2 = email.length
     if (pn_0<1 || pn_1<pn_0+2 || pn_1+2>pn_2) is_error=true
     if (is_error) {
     alert("请输入正确的邮件地址！");
     document.formReg.Email.focus()
     return false
     }
		
		
		
				
	if(document.formReg.ts1.value=="1")
		{
			alert("请选择提示问题！密码丢失找回必用！");
			document.formReg.ts1.focus();
			return false;
		}
		
		if(document.formReg.tsda.value=="")
		{
			alert("请输入提示答案！密码丢失找回必用！");
			document.formReg.tsda.focus();
			return false;
		}	
		
		
	if(document.formReg.yzm.value=="")
		{
			alert("请输入验证码！");
			document.formReg.yzm.focus();
			return false;
		}
	
		
		
	}
</script>
  
  </head>
  <body>
  
 <?php include("top.php");?>
	

 
  <!--主体内容-->
  <div class="zc_frame" >
    <div class="zc_frame_left" style=" margin-top:-30px;">
      <div class="content">
		<div style="width:520px; height:26px; line-height:26px; padding-left:20px; margin:0px 0 8px 0;border:#FFD173 1px solid; background:#FFFCF2; color:#CC0000; font-size:14px; font-weight:bold;">
提示：请输入您的真实信息，以便我们与您联系，谢谢合作。
</div>        <form action="zze.php" method="post" name="formReg" id="formReg" autocomplete="off" onsubmit="return CheckForm();">
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
  
            <tbody><tr>
              <td width="240" height="30" align="right" valign="top">用户名：</td>
              <td width="710" height="30"><input name="f_name" type="text" class="input_text" id="user" size="20" maxlength="16" >
               
              &nbsp;<font color="#CC0000">*</font>&nbsp;不可更改
             
              <br />
              <!--验证用户名是否存在时用start-->
              <span id="chk"></span>
              <!--验证用户名是否存在时用over-->
</td>
            </tr>
            <tr>
              <td height="30" align="right">真实姓名：</td>
              <td height="30"><input name="RealName" type="text" class="input_text" id="RealName" size="20" maxlength="50">&nbsp; <font color="#CC0000">*</font></td>
            </tr>
            <tr>
              <td height="30" align="right">性别：</td>
              <td height="30"><input name="Sex" type="radio" value="先生" checked="checked">
                先生
                <input type="radio" name="Sex" value="女士">
                女士</td>
            </tr>
            <tr>
              <td height="30" align="right">设置密码：</td>
              <td height="30"><input name="f_pass" type="password" class="input_text" id="Password" size="20" maxlength="16">
                &nbsp;<font color="#CC0000">*</font> 6-16个数字或字母。</td>
            </tr>
            <tr>
              <td height="30" align="right">确定密码：</td>
              <td height="30"><input name="f_pass2" type="password" class="input_text" id="vPassword" size="20" maxlength="16">
                &nbsp;<font color="#CC0000">*</font></td>
            </tr>
            <tr>
              <td height="30" align="right">单位名称：</td>
              <td height="30"><input name="dwei" type="text" class="input_text" id="dwei" size="40" maxlength="100">
              &nbsp;<font color="#CC0000">*</font> 个人请填写&ldquo;个人&rdquo;。</td>
            </tr>
            <tr>
              <td height="30" align="right">地址：</td>
              <td height="30"><input name="Address" type="text" class="input_text" id="Address" size="40" maxlength="100">
                <font color="#CC0000"> &nbsp;*</font> </td>
            </tr>
            <tr>
              <td height="30" align="right">邮编：</td>
              <td height="30"><input name="ZipCode" type="text" class="input_text" id="ZipCode" size="20" maxlength="20"></td>
            </tr>

            <tr>
              <td height="30" align="right">电话：</td>
              <td height="30"><input name="Telephone" type="text" class="input_text" id="Telephone" size="20" maxlength="50"></td>
            </tr>
			<tr>
              <td height="30" align="right">手机：</td>
              <td height="30"><input name="Mobile" type="text" class="input_text" id="Mobile" size="20" maxlength="50">&nbsp; <font color="#CC0000">*</font></td>
            </tr>
            <tr>
              <td height="30" align="right">传真：</td>
              <td height="30"><input name="Fax" type="text" class="input_text" id="Fax" size="20" maxlength="50"></td>
            </tr>
            
            <tr>
              <td height="30" align="right">QQ：</td>
              <td height="30"><input name="QQ" type="text" class="input_text" id="QQ" size="30" maxlength="50">&nbsp; <font color="#CC0000">*</font></td>
            </tr>
           <tr>
              <td height="30" align="right">电子邮箱：</td>
              
              
              
              

              
              
              <td height="30"><input name="Email" type="text" class="input_text" id="Email" size="30" maxlength="50"></td>
            </tr>
            
            <tr>
              <td height="30" align="right">密码提示：</td>
              
              
              
              

              
              
              <td height="30"><select name="ts1" class="inputcss">
                            <option selected value=1>请选择问题</option>
                            <option value="您的生日">您的生日</option>
                            <option value="你的爱好">你的爱好</option>
                            <option value="您母亲的名字">您母亲的名字</option>
                            <option value="您父亲的名字">您父亲的名字</option>
                            <option value="您最喜欢的花">您最喜欢的花</option>
                          </select></td>
            </tr>
            
            <tr>
              <td height="30" align="right">密码答案：</td>
              
              
              
              

              
              
              <td height="30"><input type="text" name="tsda" size="25" class="inputcss"   ></td>
            </tr>
         <tr>
              <td height="30" align="right">验证码：</td>
              <td height="30" valign="bottom">
              
              
              <input name="yzm" type="text" class="input_text" size="4" maxlength="4" onfocus="get_checkcode();this.onfocus=null;">
              
              &nbsp;<font color="#CC0000">*</font>
             <!--<span id="img_checkcode">
              <label style="cursor:pointer;" onclick="get_checkcode();">点击获取验证码</label>
              </span><span id="isok_checkcode"></span> */--> 
              
              <!--后加gd代码下边是--><font size="2"><img src="vcode/vcode.php" name="safecode" id="safecode" align="absbottom" onclick="getcode();" title="点击刷新验证码"/>&nbsp;[<a href="#" title="点击刷新验证码" onclick="getcode();">刷新</a>]</font>
              
              
              <a name="aaa" id="aaa"></a></td>
            </tr>
            <tr>
              <td height="30" align="right">&nbsp;</td>
              <td height="30" valign="bottom"><input name="f_reg" type="submit" class="button_style" style="WIDTH:80px;" value="注册" id="f_reg">
                &nbsp;
                <input name="Reset" type="reset" class="button_style" style="WIDTH:80px;" value=" 重置 ">
                <input name="z_time" type="hidden" id="z_time" value="<?php echo date("Y-m-d H:i:s");?>" /></td>
            </tr>
         
        </tbody></table></form>
	  </div>
    </div>
    <div class="zc_frame_right">
      <dl class="list">
      <dt>集号吧靓号网</dt>
        <dd>选号码就上集号吧，中国最大的号码展示平台！</dd>
        <dd>号码类型：固话电话、车牌号、400号、QQ号。</dd>
        <dd></dd>
        <dd></dd>
      </dl>
    </div>
    <div class="clear"> </div>
  </div>
	<div class="clear"> </div>
	<?php include("foot.php");?>
		


<div></div></body></html>