<?php require_once('../Connections/connch21.php'); 
@mysql_select_db($database_connch21,$connch21) or die("打开数据库错误");
?>



<?php error_reporting(E_ALL & ~E_NOTICE);

if($_POST['f_reg']){
	$uname=$_POST['f_name'];
	$upass=$_POST['f_pass'];
	
if($_POST['yzm'] !== $_SESSION["vcode"]){echo "<script language='javascript'>alert('验证码错误!');location.href='dl.php';</script>";}
else{
	$sql="select*from admin_zc where f_name='".$uname."'and f_pass='".md5(md5($upass))."'";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	if($num==0){
	echo "<script language='javascript'>alert('用户名或密码错误,未能登录!');location.href='dl.php';</script>";
	}else{
	
		
		$_SESSION[name]=$uname;
	//$_SESSION[pass]=$upass;
	
	
	//echo "<br>你好：".$_SESSION[name];
	
	echo "<script language='javascript'>location.href='../index.php';</script>";
	/*echo "<script language='javascript'>location.href='javascript:history.go(-1)';</script>";*/
	
	
	}
	
	

} 

}

 ?>


<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
				
		
			   <?php include("../keyword.php");?>
		<link href="./index_dl_files/public.css" rel="stylesheet">
	<link href="./index_dl_files/buy.css" rel="stylesheet">
	<link href="./index_dl_files/ui-dialog.css" rel="stylesheet">
	 <link rel="shortcut icon" href="http://hrblh.com/images/favicon.ico" type="image/x-icon">
	
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
		
		
		/* if(document.formReg.f_name.value.length<6||formReg.f_name.value.length>20)
 {
  alert("你的用户名长度应该在6到20个字符之间");
  document.formReg.f_name.focus();
  return false;
 }*/
		
		
		
		/*if(document.formReg.RealName.value=="")
		{
			alert("请输入姓名！");
			document.formReg.RealName.focus();
			return false;
		}*/
		
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
		
		
	if(document.formReg.yzm.value=="")
		{
			alert("请输入验证码！");
			document.formReg.yzm.focus();
			return false;
		}	
		
		
		/*if(document.formReg.f_pass2.value=="")
		{
			alert("请输入确认密码！");
			document.formReg.f_pass2.focus();
			return false;
		}*/
		
		
		/* if(document.formReg.f_pass.value!=document.formReg.f_pass2.value)
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
     alert("请输入正确的邮件地址，密码丢失后可用此找回！");
     document.formReg.Email.focus()
     return false
     }*/
		
		
		
		
		
		
		
	}
</script>    
    
     <script type="text/javascript">  

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
  </head>
  <body>


 <?php include("top.php");?>


  <div class="zc_frame">
		<div class="content_frame fleft">
		<form action="dl.php" method="post" id="formReg" name="formReg"  onsubmit="return CheckForm();" autocomplete="off">
			<h2> 一个账号，享受一站式靓号服务！</h2>
			<ul class="list">
				<li>
					<input id="inputMobile" type="text" name="f_name" placeholder="用户名或手机号" class="login_input input_user input_width01" >
					<div class="prompt tipwrong" style="display: none;"><em class="wrong" id="usernameerror">请输入手机号码或门牌号</em></div>
                    <div class="prompt tipok" style="display:none;"><em class="correct"></em></div>
				</li>
				<li class="pow">
					<input id="inputPassword" type="password" name="f_pass" class="login_input input_password input_width01 " placeholder="密码" onfocus="this.type=&#39;password&#39;" autocomplete="off">



					<div class="prompt tipwrong" style="display: none;"><em class="wrong">密码不正确</em></div>
                    <div class="prompt tipok" style="display:none;"><em class="correct"></em></div>
				</li>
				<li id="li_code" class="yz" style="display: block;">
					
					<input name="yzm"  type="text" class="login_input input_width02" id="inputCode" onfocus="get_checkcode();this.onfocus=null;" placeholder="请输入验证码" size="20" maxlength="4">
                    
                    <div  style="padding-top:20px;">　<font size="2"><img src="vcode/vcode.php" name="safecode" id="safecode" align="absbottom" onclick="getcode();" title="点击刷新验证码"/>&nbsp;[<a href="#" title="点击刷新验证码" onclick="getcode();">刷新</a>]</font>
              
              
              <a name="aaa" id="aaa"></a></td></div>
					<a href="javascript:void(0);" title="看不清换一张" id="changeCode" class="refresh changeCode">看不清换一张</a>
					<div class="prompt tipwrong" style="display: none;"><em class="wrong">验证码不正确</em></div>
                    <div class="prompt tipok" style="display:none;"><em class="correct"></em></div>
				</li>
				<li class="shopnumber" style="display: none;">
					<select id="shoplist">
						<option value="">请选择登录门牌</option>
					</select>
					<div class="prompt"><em class="wrong">请选择门牌号</em></div>
				</li>
				<li class="zddl">
					<div class="content_frame_left">
					<!--<label>
					  <input id="loginmonth" type="checkbox" value="true">30天内免登录 </label>-->
					</div> 
                    
                   
					<div class="content_frame_right"> <a href="javascript:void(0);" onClick="javascript:openwindow('openfindpwd.php','fileUpload',445,150)">忘记密码</a> <span>|</span> <a href="zze.php">免费注册</a> </div>
				</li>
				<li>
					<input name="f_reg" type="submit" class="input_orange button_380_55" id="submit" value="立即登录">
				</li>
			</ul>
		</form>
		<div class="clear"> </div>
	</div>
		<div class="zc_frame_right">
			<dl class="list">
      <dt>玖玖靓号网</dt>
        <dd>选号码就上玖玖靓号，打造国内最全的号码展示平台！</dd>
        <dd>号码类型：固话电话、车牌号、400号、手机号。 </dd>
		<!--<dd><a href="http://user.#.com/qqconnect/oauth/index.php"><img src="http://user.#.com/qqconnect/img/qq_login.png"></a></dd>-->
       
      </dl>
		</div>
	  <div class="clear"> </div>
	</div>

	<div class="clear"> </div>
	<?php include("foot.php");?>
		


<div></div></body></html>