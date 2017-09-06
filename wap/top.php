<!-- <?php include("../footer_ip.php");?>-->
<!-- header -->
	<!-- header -->
    <div class="header">
        <a href="./index.php" class="logo"></a>
        <a href="#" class="city_a"><!--<div class="city" id="localcity">城市</div><div class="city_ico"></div>--></a>
        <a href="javascript:tanchu1();" class="t_search"><i></i>输入数字</a>
       <!-- <a class="loginer icon" href="http://user.hrblh.com/">-->
       <a class="menu icon"></a>
    </div>
    <!--头部搜索弹出-->
     <div class="jlkk hidden" id="tck1">
		<form action="filter_soso.php" method="get">
        <div class="tc_search"><a class="close search_cancel" href="javascript:guanbi1();">取消</a><button class="search_is" href="#">搜索</button><input name="key" class="tc_search" type="text" placeholder="请输入你喜欢的数字"></div>
        </form>	
        <div class="hot_search">
        	<div class="hot_s_bt">热门搜索</div>
            <ul class="hot_list">
            	<li><a href="./filter_soso.php?day=6">尾数ABCD</a></li>
                <li><a href="./filter_soso.php?day=23">尾数ABCDE</a></li>
                <li><a href="./filter_soso.php?day=25">尾数ABCDABCD</a></li>
                <li><a href="./filter_soso.php?price=4&day=25">1万元以上</a></li>
				<li><a href="./filter_soso.php?price=4&day=3">尾数AAA</a></li>
				<li><a href="./filter_soso.php?price=4&day=4">尾数AAAA</a></li>
				<li><a href="./filter_soso.php?price=4&day=7">尾数AAAAA</a></li>
            </ul>
        </div>
	</div>
    <!--头部搜索弹出结束-->
	<div class="clear"></div>
	<div class="pop-nav tan" style="display: none;">
		<i></i>
		<ul>
			<li><a href="./index.php" class="pop-nav01">首页</a></li>
            <li><a href="./filter.php" class="pop-nav02">手机号</a></li>
           <!-- <li><a href="http://#/qq/" class="pop-nav06">QQ号</a></li>-->
            <li><a href="400.php" class="pop-nav04">400电话</a></li>
            <li><a href="gh.php" class="pop-nav05">固话</a></li>
            <li><a href="cp.php" class="pop-nav03">车牌号</a></li>
            <li><a href="news.php" class="pop-nav07">行业资讯</a></li>
            <!--<li><a href="http://#/shouji/yuding.htm" class="pop-nav08">靓号定制</a></li>
            <li><a href="http://#/jixiong/" class="pop-nav09">吉凶测试</a></li>
            <li><a href="http://#/gujia/" class="pop-nav10">号码估价</a></li>
            <li><a href="http://#/guishudi/" class="pop-nav11">归属地查询</a></li>
            <li><a href="http://#/tools/haoduan/" class="pop-nav12">号段查询</a></li>
            <li><a href="http://#/quhao/" class="pop-nav13">区号查询</a></li>
            <li><a href="http://#/changyongdianhua/" class="pop-nav14">常用电话</a></li>
            <li><a href="http://#/shouji/huishou/" class="pop-nav15">靓号回收</a></li>-->
		</ul>
        <div class="nav_shadow"></div>
        <div class="tel"><a class="tel_inner" href="tel:045189675888"><img src="./index_files/telphone.png"></a></div>	
	</div>
    <div class="pop-nav zhezhao" style="display: none;"></div>
<div class="tanchu" id="login_pop" style="display:none;">
  <div class="login"> 
  <a class="close"></a>
    <div class="tc_dl"><span>登陆</span></div>
    <ul style="">
      <li class="user-info name">
        <input type="number" placeholder="请输入手机号/门牌号" name="username">
      </li>
      <li class="user-info pwd">
        <input type="password" placeholder="请输入密码" name="password">
      </li>
	  <li class="user-info select on">
        <select name="">
			<option></option>
		</select>
      </li>
      <!--<li class="yzm">
        <input type="text" placeholder="验证码" value="" name="code" maxlength="4">
        <img src="images/yzm.jpg" width="100" style="margin-left:5px;" />
	  </li>-->
      <li class="enter">
        <input type="submit" class="btn" value="登陆">
      </li>
      <li> <span class="auto">
        <input type="checkbox" checked="" class="check active">
        自动登录</span>
        <div class="getpwd"> <a href="http://#/#">忘记密码</a>丨<a href="http://#/#">注册账号</a> </div>
      </li>
      <div class="clear"></div>
    </ul>
  </div>
</div>