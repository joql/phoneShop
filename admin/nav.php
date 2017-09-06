<?php require_once('Connections/connch21.php'); ?>
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
$query_Rec_guanlia = "SELECT * FROM admin_wysz";
$Rec_guanlia = mysql_query($query_Rec_guanlia, $connch21) or die(mysql_error());
$row_Rec_guanlia = mysql_fetch_assoc($Rec_guanlia);
$totalRows_Rec_guanlia = mysql_num_rows($Rec_guanlia);

mysql_select_db($database_connch21, $connch21);
$query_Rec_topggo = "SELECT * FROM guanggao WHERE title = '头部右上侧小广告'";
$Rec_topggo = mysql_query($query_Rec_topggo, $connch21) or die(mysql_error());
$row_Rec_topggo = mysql_fetch_assoc($Rec_topggo);
$totalRows_Rec_topggo = mysql_num_rows($Rec_topggo);

mysql_select_db($database_connch21, $connch21);
$query_Rec_gzptai = "SELECT gg_photo1, url1 FROM guanggao WHERE title = '公众平台二维码'";
$Rec_gzptai = mysql_query($query_Rec_gzptai, $connch21) or die(mysql_error());
$row_Rec_gzptai = mysql_fetch_assoc($Rec_gzptai);
$totalRows_Rec_gzptai = mysql_num_rows($Rec_gzptai);
?>
<div class="head">
  <div class="main"> </div>
  <div class="top">
    <div class="main">
      <div class="zcxx fleft">大量靓号转让、求购信息，尽在玖玖靓号！
    <?php if(isset($_SESSION[name])){?>  <span id="nologin" style="display:none;"><span class="red"><a href="#" rel="nofollow" target="_blank" id="loginusername">您好，<?php echo $_SESSION[name];?></a></span><a href="<?php //echo $_SERVER["HTTP_HOST"];?><?php echo $_SERVER["SCRIPT_NAME"];?>?act=logout" rel="nofollow">退出</a></span><?php } else{?>
      
    <span id="nologin"><span class="red"><a href="hy/zze.php" rel="nofollow" >会员注册</a></span><a href="hy/dl.php" rel="nofollow" >会员登录</a></span> 
    <?php }?>
    </div>
      <div class="fright">
        <ul class="menu">
         <li class=""> <a href="javascript:;">会员中心<i></i></a>
            <div class="zs1" style="width:141px;"> 
             <div class="account">
					<div class="loginbefore hidden">您好，<span class="red"><a href="#" target="_blank" rel="nofollow">请登录</a></span></div>
					<div class="loginafter "><span class="red">玖玖靓号网</span> 欢迎您！</div>
					</div>
             <div class="accountlist">
					<span><a href="hy/zze.php" target="_blank" rel="nofollow">免费注册</a><a href="hy/dl.php" rel="nofollow" target="_blank">会员登录</a></span>
					<span><!--<a href="#" target="_blank" rel="nofollow">高级会员</a>--><a target="_blank" href="tencent://message/?uin=110999999&Menu=yes" target="_blank" rel="nofollow">联系客服</a></span>
					</div>
            </div>
            <span></span> </li>
          <!--<li class=""> <a href="javascript:;">我的收藏<i></i></a>
            <div class="zs2" style="width:200px;" id="myFavorite">
              <div><span class="fright dianhua"><a href="#">0个</a></span><a href="#">固定电话</a></div>
              <div><span class="fright chepai"><a href="#">0个</a></span><a href="#">车牌靓号</a></div>
              <div><span class="fright qq"><a href="#">0个</a></span><a href="#">QQ靓号</a></div>
              <div><span class="fright 400"><a href="#">0个</a></span><a href="#">400电话</a></div>
            </div>
            <span></span> </li>-->
          <li class=""> <a href="javascript:;">官方微信<i></i></a>
            <div class="zs3" style="width:130px; ">
              <div style="padding:10px;">
                <div><img src="images/<?php echo $row_Rec_gzptai['gg_photo1']; ?>" width="110" height="110"></div>
                微信号:#999 </div>
            </div>
            <span></span> </li>
          <li class=""> <a target="_blank" href="javascript:;">联系电话<i></i></a>
            <div class="zs4" style="width:210px;"> <span class="saom2">电话：<?php echo substr($row_Rec_guanlia['w_tel'],0,13); ?><br>
              企业QQ：<a href="tencent://message/?uin=800060708" target="_blank"><?php echo $row_Rec_guanlia['w_qq']; ?></a></span> </div>
            <span></span> </li>
          <!--<li class=""> <a target="_blank" href="javascript:;">客户服务<i></i></a>
            <div class="zs5"> <a href="#">在线客服</a> <a href="#">网站地图</a> <a href="#" rel="nofollow">网站简介</a> </div>
            <span></span> </li>-->
        </ul>
      </div>
    </div>
  </div>
  <div class="pheader main">
    <div class="logo fleft"><a href="/" title="手机号码 玖玖靓号"><img src="./index_files/logo.jpg" alt="手机号码 玖玖靓号"></a></div>
    <!--<div class="menu2">
      <ul>
        <li id="citydw"><a target="_blank" href="#/p/">切换城市<i></i></a>
          <div class="city">
            <ul class="cityfl">
              <li id="m01" class="sd01" value="0">热门城市</li>
              <li id="m02" class="sd02" value="1">ABCD</li>
              <li id="m03" class="sd02" value="2">EFGH</li>
              <li id="m04" class="sd02" value="3">JKL</li>
              <li id="m05" class="sd02" value="4">MNPQR</li>
              <li id="m06" class="sd02" value="5">STW</li>
              <li id="m07" class="sd02" value="6">XYZ</li>
            </ul>
            <div id="c01">
              <div class="rcc-con"> <span><a target="_blank" href="http://xuchang.#.com/" style="color:#03F; font-weight:bold"><span id="mylocation">许昌</span></a></span> <span><a target="_blank" href="http://beijing.#.com/">北京</a></span> <span><a target="_blank" href="http://shanghai.#.com/">上海</a></span> <span><a target="_blank" href="http://guangzhou.#.com/">广州</a></span> <span><a target="_blank" href="http://chengdu.#.com/">成都</a></span> <span><a target="_blank" href="http://hangzhou.#.com/">杭州</a></span> <span><a target="_blank" href="http://wuhan.#.com/">武汉</a></span> <span><a target="_blank" href="http://shenzhen.#.com/">深圳</a></span> <span><a target="_blank" href="http://shenyang.#.com/">沈阳</a></span> <span><a target="_blank" href="http://changchun.#.com/">长春</a></span> <span><a target="_blank" href="http://haerbin.#.com/">哈尔滨</a></span> <span><a target="_blank" href="http://changsha.#.com/">长沙</a></span> <span><a target="_blank" href="http://dalian.#.com/">大连</a></span> <span><a target="_blank" href="http://nanjing.#.com/">南京</a></span> <span><a target="_blank" href="http://suzhou.#.com/">苏州</a></span> <span><a target="_blank" href="http://wenzhou.#.com/">温州</a></span> <span><a target="_blank" href="http://hefei.#.com/">合肥</a></span> <span><a target="_blank" href="http://fuzhou.#.com/">福州</a></span> <span><a target="_blank" href="http://xiamen.#.com/">厦门</a></span> <span><a target="_blank" href="http://qingdao.#.com/">青岛</a></span> <span><a target="_blank" href="http://yantai.#.com/">烟台</a></span> <span><a target="_blank" href="http://zhengzhou.#.com/">郑州</a></span> <span><a target="_blank" href="http://shantou.#.com/">汕头</a></span> <span><a target="_blank" href="http://foshan.#.com/">佛山</a></span> <span><a target="_blank" href="http://huizhou.#.com/">惠州</a></span> <span><a target="_blank" href="http://tianjin.#.com/">天津</a></span> <span><a target="_blank" href="http://dongguan.#.com/">东莞</a></span> <span><a target="_blank" href="http://chongqing.#.com/">重庆</a></span> <span><a target="_blank" href="http://kunming.#.com/">昆明</a></span> <span><a target="_blank" href="http://sjz.#.com/">石家庄</a></span> <span><a target="_blank" href="http://cangzhou.#.com/">沧州</a></span> <span><a target="_blank" href="http://taiyuan.#.com/">太原</a></span> </div>
            </div>
            <div id="c02" class="hidden">
              <div class="rcc-con">
                <div><span>A</span><span><span><a href="http://alsm.#.com/" target="_blank">阿拉善盟</a></span><span><a href="http://anshan.#.com/" target="_blank">鞍山</a></span><span><a href="http://anqing.#.com/" target="_blank">安庆</a></span><span><a href="http://anyang.#.com/" target="_blank">安阳</a></span><span><a href="http://aba.#.com/" target="_blank">阿坝</a></span><span><a href="http://anshun.#.com/" target="_blank">安顺</a></span><span><a href="http://ali.#.com/" target="_blank">阿里地区</a></span><span><a href="http://ankang.#.com/" target="_blank">安康</a></span><span><a href="http://akesu.#.com/" target="_blank">阿克苏</a></span><span><a href="http://aletai.#.com/" target="_blank">阿勒泰</a></span><span><a href="http://alaer.#.com/" target="_blank">阿拉尔</a></span><span><a href="http://aomen.#.com/" target="_blank">澳门特别行政区</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>B</span><span><span><a href="http://beijing.#.com/" target="_blank">北京</a></span><span><a href="http://baoding.#.com/" target="_blank">保定</a></span><span><a href="http://baotou.#.com/" target="_blank">包头</a></span><span><a href="http://bayannaoer.#.com/" target="_blank">巴彦淖尔</a></span><span><a href="http://benxi.#.com/" target="_blank">本溪</a></span><span><a href="http://baishan.#.com/" target="_blank">白山</a></span><span><a href="http://baicheng.#.com/" target="_blank">白城</a></span><span><a href="http://bengbu.#.com/" target="_blank">蚌埠</a></span><span><a href="http://bozhou.#.com/" target="_blank">亳州</a></span><span><a href="http://binzhou.#.com/" target="_blank">滨州</a></span><span><a href="http://beihai.#.com/" target="_blank">北海</a></span><span><a href="http://baise.#.com/" target="_blank">百色</a></span><span><a href="http://baisha.#.com/" target="_blank">白沙</a></span><span><a href="http://baoting.#.com/" target="_blank">保亭</a></span><span><a href="http://bazhong.#.com/" target="_blank">巴中</a></span><span><a href="http://bijie.#.com/" target="_blank">毕节</a></span><span><a href="http://baoshan.#.com/" target="_blank">保山</a></span><span><a href="http://baoji.#.com/" target="_blank">宝鸡</a></span><span><a href="http://baiyin.#.com/" target="_blank">白银</a></span><span><a href="http://boertala.#.com/" target="_blank">博尔塔拉</a></span><span><a href="http://bygl.#.com/" target="_blank">巴音郭楞</a></span><span><a href="http://beiqu.#.com/" target="_blank">北区</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>C</span><span><span><a href="http://chongqing.#.com/" target="_blank">重庆</a></span><span><a href="http://chengde.#.com/" target="_blank">承德</a></span><span><a href="http://cangzhou.#.com/" target="_blank">沧州</a></span><span><a href="http://changzhi.#.com/" target="_blank">长治</a></span><span><a href="http://chifeng.#.com/" target="_blank">赤峰</a></span><span><a href="http://chaoyang.#.com/" target="_blank">朝阳</a></span><span><a href="http://changchun.#.com/" target="_blank">长春</a></span><span><a href="http://changzhou.#.com/" target="_blank">常州</a></span><span><a href="http://chuzhou.#.com/" target="_blank">滁州</a></span><span><a href="http://chaohu.#.com/" target="_blank">巢湖</a></span><span><a href="http://chizhou.#.com/" target="_blank">池州</a></span><span><a href="http://changsha.#.com/" target="_blank">长沙</a></span><span><a href="http://changde.#.com/" target="_blank">常德</a></span><span><a href="http://chenzhou.#.com/" target="_blank">郴州</a></span><span><a href="http://chaozhou.#.com/" target="_blank">潮州</a></span><span><a href="http://chongzuo.#.com/" target="_blank">崇左</a></span><span><a href="http://chengmai.#.com/" target="_blank">澄迈</a></span><span><a href="http://changjiang.#.com/" target="_blank">昌江</a></span><span><a href="http://chengdu.#.com/" target="_blank">成都</a></span><span><a href="http://chuxiong.#.com/" target="_blank">楚雄</a></span><span><a href="http://changdu.#.com/" target="_blank">昌都</a></span><span><a href="http://changji.#.com/" target="_blank">昌吉</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>D</span><span><span><a href="http://datong.#.com/" target="_blank">大同</a></span><span><a href="http://dalian.#.com/" target="_blank">大连</a></span><span><a href="http://dandong.#.com/" target="_blank">丹东</a></span><span><a href="http://daqing.#.com/" target="_blank">大庆</a></span><span><a href="http://dxal.#.com/" target="_blank">大兴安岭</a></span><span><a href="http://dongying.#.com/" target="_blank">东营</a></span><span><a href="http://dezhou.#.com/" target="_blank">德州</a></span><span><a href="http://dongguan.#.com/" target="_blank">东莞</a></span><span><a href="http://danzhou.#.com/" target="_blank">儋州</a></span><span><a href="http://dongfang.#.com/" target="_blank">东方</a></span><span><a href="http://dingan.#.com/" target="_blank">定安</a></span><span><a href="http://deyang.#.com/" target="_blank">德阳</a></span><span><a href="http://dazhou.#.com/" target="_blank">达州</a></span><span><a href="http://dali.#.com/" target="_blank">大理</a></span><span><a href="http://dehong.#.com/" target="_blank">德宏</a></span><span><a href="http://diqing.#.com/" target="_blank">迪庆</a></span><span><a href="http://dingxi.#.com/" target="_blank">定西</a></span><span><a href="http://dapuqu.#.com/" target="_blank">大埔区</a></span></span></div>
              </div>
            </div>
            <div id="c03" class="hidden">
              <div class="rcc-con">
                <div><span>E</span><span><span><a href="http://eerduosi.#.com/" target="_blank">鄂尔多斯</a></span><span><a href="http://ezhou.#.com/" target="_blank">鄂州</a></span><span><a href="http://enshi.#.com/" target="_blank">恩施</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>F</span><span><span><a href="http://fushun.#.com/" target="_blank">抚顺</a></span><span><a href="http://fuxin.#.com/" target="_blank">阜新</a></span><span><a href="http://fuyang.#.com/" target="_blank">阜阳</a></span><span><a href="http://fuzhou.#.com/" target="_blank">福州</a></span><span><a href="http://fz.#.com/" target="_blank">抚州</a></span><span><a href="http://foshan.#.com/" target="_blank">佛山</a></span><span><a href="http://fcg.#.com/" target="_blank">防城港</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>G</span><span><span><a href="http://ganzhou.#.com/" target="_blank">赣州</a></span><span><a href="http://guangzhou.#.com/" target="_blank">广州</a></span><span><a href="http://guilin.#.com/" target="_blank">桂林</a></span><span><a href="http://guigang.#.com/" target="_blank">贵港</a></span><span><a href="http://guangyuan.#.com/" target="_blank">广元</a></span><span><a href="http://guangan.#.com/" target="_blank">广安</a></span><span><a href="http://ganzi.#.com/" target="_blank">甘孜</a></span><span><a href="http://guiyang.#.com/" target="_blank">贵阳</a></span><span><a href="http://gannan.#.com/" target="_blank">甘南</a></span><span><a href="http://guoluo.#.com/" target="_blank">果洛</a></span><span><a href="http://guyuan.#.com/" target="_blank">固原</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>H</span><span><span><a href="http://handan.#.com/" target="_blank">邯郸</a></span><span><a href="http://hengshui.#.com/" target="_blank">衡水</a></span><span><a href="http://huhehaote.#.com/" target="_blank">呼和浩特</a></span><span><a href="http://hulunbeier.#.com/" target="_blank">呼伦贝尔</a></span><span><a href="http://huludao.#.com/" target="_blank">葫芦岛</a></span><span><a href="http://haerbin.#.com/" target="_blank">哈尔滨</a></span><span><a href="http://hegang.#.com/" target="_blank">鹤岗</a></span><span><a href="http://heihe.#.com/" target="_blank">黑河</a></span><span><a href="http://huaian.#.com/" target="_blank">淮安</a></span><span><a href="http://hangzhou.#.com/" target="_blank">杭州</a></span><span><a href="http://huzhou.#.com/" target="_blank">湖州</a></span><span><a href="http://hefei.#.com/" target="_blank">合肥</a></span><span><a href="http://huainan.#.com/" target="_blank">淮南</a></span><span><a href="http://huaibei.#.com/" target="_blank">淮北</a></span><span><a href="http://huangshan.#.com/" target="_blank">黄山</a></span><span><a href="http://heze.#.com/" target="_blank">菏泽</a></span><span><a href="http://hebi.#.com/" target="_blank">鹤壁</a></span><span><a href="http://huangshi.#.com/" target="_blank">黄石</a></span><span><a href="http://huanggang.#.com/" target="_blank">黄冈</a></span><span><a href="http://hengyang.#.com/" target="_blank">衡阳</a></span><span><a href="http://huaihua.#.com/" target="_blank">怀化</a></span><span><a href="http://huizhou.#.com/" target="_blank">惠州</a></span><span><a href="http://heyuan.#.com/" target="_blank">河源</a></span><span><a href="http://hezhou.#.com/" target="_blank">贺州</a></span><span><a href="http://hechi.#.com/" target="_blank">河池</a></span><span><a href="http://haikou.#.com/" target="_blank">海口</a></span><span><a href="http://honghe.#.com/" target="_blank">红河</a></span><span><a href="http://hanzhong.#.com/" target="_blank">汉中</a></span><span><a href="http://haidong.#.com/" target="_blank">海东</a></span><span><a href="http://haibei.#.com/" target="_blank">海北</a></span><span><a href="http://huangnan.#.com/" target="_blank">黄南</a></span><span><a href="http://hainan.#.com/" target="_blank">海南</a></span><span><a href="http://haixi.#.com/" target="_blank">海西</a></span><span><a href="http://hami.#.com/" target="_blank">哈密</a></span><span><a href="http://hetian.#.com/" target="_blank">和田</a></span><span><a href="http://huadaxianqu.#.com/" target="_blank">黄大仙区</a></span></span></div>
              </div>
            </div>
            <div id="c04" class="hidden">
              <div class="rcc-con">
                <div><span>J</span><span><span><a href="http://jincheng.#.com/" target="_blank">晋城</a></span><span><a href="http://jinzhong.#.com/" target="_blank">晋中</a></span><span><a href="http://jinzhou.#.com/" target="_blank">锦州</a></span><span><a href="http://jilin.#.com/" target="_blank">吉林</a></span><span><a href="http://jixi.#.com/" target="_blank">鸡西</a></span><span><a href="http://jiamusi.#.com/" target="_blank">佳木斯</a></span><span><a href="http://jiaxing.#.com/" target="_blank">嘉兴</a></span><span><a href="http://jinhua.#.com/" target="_blank">金华</a></span><span><a href="http://jingdezhen.#.com/" target="_blank">景德镇</a></span><span><a href="http://jiujiang.#.com/" target="_blank">九江</a></span><span><a href="http://jian.#.com/" target="_blank">吉安</a></span><span><a href="http://jinan.#.com/" target="_blank">济南</a></span><span><a href="http://jining.#.com/" target="_blank">济宁</a></span><span><a href="http://jiaozuo.#.com/" target="_blank">焦作</a></span><span><a href="http://jiyuan.#.com/" target="_blank">济源</a></span><span><a href="http://jingmen.#.com/" target="_blank">荆门</a></span><span><a href="http://jingzhou.#.com/" target="_blank">荆州</a></span><span><a href="http://jiangmen.#.com/" target="_blank">江门</a></span><span><a href="http://jieyang.#.com/" target="_blank">揭阳</a></span><span><a href="http://jiayuguan.#.com/" target="_blank">嘉峪关</a></span><span><a href="http://jinchang.#.com/" target="_blank">金昌</a></span><span><a href="http://jiuquan.#.com/" target="_blank">酒泉</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>K</span><span><span><a href="http://kaifeng.#.com/" target="_blank">开封</a></span><span><a href="http://kunming.#.com/" target="_blank">昆明</a></span><span><a href="http://kelamayi.#.com/" target="_blank">克拉玛依</a></span><span><a href="http://kzls.#.com/" target="_blank">克孜勒苏</a></span><span><a href="http://kashi.#.com/" target="_blank">喀什</a></span><span><a href="http://kuiqingqu.#.com/" target="_blank">葵青区</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>L</span><span><span><a href="http://langfang.#.com/" target="_blank">廊坊</a></span><span><a href="http://linfen.#.com/" target="_blank">临汾</a></span><span><a href="http://lvliang.#.com/" target="_blank">吕梁</a></span><span><a href="http://liaoyang.#.com/" target="_blank">辽阳</a></span><span><a href="http://liaoyuan.#.com/" target="_blank">辽源</a></span><span><a href="http://lyg.#.com/" target="_blank">连云港</a></span><span><a href="http://lishui.#.com/" target="_blank">丽水</a></span><span><a href="http://liuan.#.com/" target="_blank">六安</a></span><span><a href="http://longyan.#.com/" target="_blank">龙岩</a></span><span><a href="http://laiwu.#.com/" target="_blank">莱芜</a></span><span><a href="http://linyi.#.com/" target="_blank">临沂</a></span><span><a href="http://liaocheng.#.com/" target="_blank">聊城</a></span><span><a href="http://luoyang.#.com/" target="_blank">洛阳</a></span><span><a href="http://luohe.#.com/" target="_blank">漯河</a></span><span><a href="http://loudi.#.com/" target="_blank">娄底</a></span><span><a href="http://liuzhou.#.com/" target="_blank">柳州</a></span><span><a href="http://laibin.#.com/" target="_blank">来宾</a></span><span><a href="http://lingao.#.com/" target="_blank">临高</a></span><span><a href="http://ledong.#.com/" target="_blank">乐东</a></span><span><a href="http://lingshui.#.com/" target="_blank">陵水</a></span><span><a href="http://luzhou.#.com/" target="_blank">泸州</a></span><span><a href="http://leshan.#.com/" target="_blank">乐山</a></span><span><a href="http://liangshan.#.com/" target="_blank">凉山</a></span><span><a href="http://liupanshui.#.com/" target="_blank">六盘水</a></span><span><a href="http://lijiang.#.com/" target="_blank">丽江</a></span><span><a href="http://lincang.#.com/" target="_blank">临沧</a></span><span><a href="http://lasa.#.com/" target="_blank">拉萨</a></span><span><a href="http://linzhi.#.com/" target="_blank">林芝地区</a></span><span><a href="http://lanzhou.#.com/" target="_blank">兰州</a></span><span><a href="http://longnan.#.com/" target="_blank">陇南</a></span><span><a href="http://linxia.#.com/" target="_blank">临夏</a></span><span><a href="http://lidaoqu.#.com/" target="_blank">离岛区</a></span></span></div>
              </div>
            </div>
            <div id="c05" class="hidden">
              <div class="rcc-con">
                <div><span>M</span><span><span><a href="http://mudanjiang.#.com/" target="_blank">牡丹江</a></span><span><a href="http://maanshan.#.com/" target="_blank">马鞍山</a></span><span><a href="http://maoming.#.com/" target="_blank">茂名</a></span><span><a href="http://meizhou.#.com/" target="_blank">梅州</a></span><span><a href="http://mianyang.#.com/" target="_blank">绵阳</a></span><span><a href="http://meishan.#.com/" target="_blank">眉山</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>N</span><span><span><a href="http://nanjing.#.com/" target="_blank">南京</a></span><span><a href="http://nantong.#.com/" target="_blank">南通</a></span><span><a href="http://ningbo.#.com/" target="_blank">宁波</a></span><span><a href="http://nanping.#.com/" target="_blank">南平</a></span><span><a href="http://ningde.#.com/" target="_blank">宁德</a></span><span><a href="http://nanchang.#.com/" target="_blank">南昌</a></span><span><a href="http://nanyang.#.com/" target="_blank">南阳</a></span><span><a href="http://nanning.#.com/" target="_blank">南宁</a></span><span><a href="http://nsqd.#.com/" target="_blank">南沙群岛</a></span><span><a href="http://neijiang.#.com/" target="_blank">内江</a></span><span><a href="http://nanchong.#.com/" target="_blank">南充</a></span><span><a href="http://nujiang.#.com/" target="_blank">怒江</a></span><span><a href="http://naqu.#.com/" target="_blank">那曲地区</a></span><span><a href="http://nanqu.#.com/" target="_blank">南区</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>P</span><span><span><a href="http://panjin.#.com/" target="_blank">盘锦</a></span><span><a href="http://putian.#.com/" target="_blank">莆田</a></span><span><a href="http://pingxiang.#.com/" target="_blank">萍乡</a></span><span><a href="http://pds.#.com/" target="_blank">平顶山</a></span><span><a href="http://puyang.#.com/" target="_blank">濮阳</a></span><span><a href="http://panzhihua.#.com/" target="_blank">攀枝花</a></span><span><a href="http://puer.#.com/" target="_blank">普洱</a></span><span><a href="http://pingliang.#.com/" target="_blank">平凉</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>Q</span><span><span><a href="http://qhd.#.com/" target="_blank">秦皇岛</a></span><span><a href="http://qiqihaer.#.com/" target="_blank">齐齐哈尔</a></span><span><a href="http://qitaihe.#.com/" target="_blank">七台河</a></span><span><a href="http://quzhou.#.com/" target="_blank">衢州</a></span><span><a href="http://quanzhou.#.com/" target="_blank">泉州</a></span><span><a href="http://qingdao.#.com/" target="_blank">青岛</a></span><span><a href="http://qianjiang.#.com/" target="_blank">潜江</a></span><span><a href="http://qingyuan.#.com/" target="_blank">清远</a></span><span><a href="http://qinzhou.#.com/" target="_blank">钦州</a></span><span><a href="http://qionghai.#.com/" target="_blank">琼海</a></span><span><a href="http://qiongzhong.#.com/" target="_blank">琼中</a></span><span><a href="http://qianxinan.#.com/" target="_blank">黔西南</a></span><span><a href="http://qdn.#.com/" target="_blank">黔东南</a></span><span><a href="http://qiannan.#.com/" target="_blank">黔南</a></span><span><a href="http://qujing.#.com/" target="_blank">曲靖</a></span><span><a href="http://qingyang.#.com/" target="_blank">庆阳</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>R</span><span><span><a href="http://rizhao.#.com/" target="_blank">日照</a></span><span><a href="http://rikaze.#.com/" target="_blank">日喀则</a></span></span></div>
              </div>
            </div>
            <div id="c06" class="hidden">
              <div class="rcc-con">
                <div><span>S</span><span><span><a href="http://shanghai.#.com/" target="_blank">上海</a></span><span><a href="http://sjz.#.com/" target="_blank">石家庄</a></span><span><a href="http://shuozhou.#.com/" target="_blank">朔州</a></span><span><a href="http://shenyang.#.com/" target="_blank">沈阳</a></span><span><a href="http://siping.#.com/" target="_blank">四平</a></span><span><a href="http://songyuan.#.com/" target="_blank">松原</a></span><span><a href="http://sys.#.com/" target="_blank">双鸭山</a></span><span><a href="http://suihua.#.com/" target="_blank">绥化</a></span><span><a href="http://suzhou.#.com/" target="_blank">苏州</a></span><span><a href="http://suqian.#.com/" target="_blank">宿迁</a></span><span><a href="http://shaoxing.#.com/" target="_blank">绍兴</a></span><span><a href="http://sz.#.com/" target="_blank">宿州</a></span><span><a href="http://sanming.#.com/" target="_blank">三明</a></span><span><a href="http://shangrao.#.com/" target="_blank">上饶</a></span><span><a href="http://sanmenxia.#.com/" target="_blank">三门峡</a></span><span><a href="http://shangqiu.#.com/" target="_blank">商丘</a></span><span><a href="http://shiyan.#.com/" target="_blank">十堰</a></span><span><a href="http://suizhou.#.com/" target="_blank">随州</a></span><span><a href="http://snj.#.com/" target="_blank">神农架</a></span><span><a href="http://shaoyang.#.com/" target="_blank">邵阳</a></span><span><a href="http://shaoguan.#.com/" target="_blank">韶关</a></span><span><a href="http://shenzhen.#.com/" target="_blank">深圳</a></span><span><a href="http://shantou.#.com/" target="_blank">汕头</a></span><span><a href="http://shanwei.#.com/" target="_blank">汕尾</a></span><span><a href="http://sanya.#.com/" target="_blank">三亚</a></span><span><a href="http://suining.#.com/" target="_blank">遂宁</a></span><span><a href="http://shannan.#.com/" target="_blank">山南</a></span><span><a href="http://shangluo.#.com/" target="_blank">商洛</a></span><span><a href="http://shizuishan.#.com/" target="_blank">石嘴山</a></span><span><a href="http://shihezi.#.com/" target="_blank">石河子</a></span><span><a href="http://shatianqu.#.com/" target="_blank">沙田区</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>T</span><span><span><a href="http://tianjin.#.com/" target="_blank">天津</a></span><span><a href="http://tangshan.#.com/" target="_blank">唐山</a></span><span><a href="http://taiyuan.#.com/" target="_blank">太原</a></span><span><a href="http://tongliao.#.com/" target="_blank">通辽</a></span><span><a href="http://tieling.#.com/" target="_blank">铁岭</a></span><span><a href="http://tonghua.#.com/" target="_blank">通化</a></span><span><a href="http://tz.#.com/" target="_blank">泰州</a></span><span><a href="http://taizhou.#.com/" target="_blank">台州</a></span><span><a href="http://tongling.#.com/" target="_blank">铜陵</a></span><span><a href="http://taian.#.com/" target="_blank">泰安</a></span><span><a href="http://tianmen.#.com/" target="_blank">天门</a></span><span><a href="http://tunchang.#.com/" target="_blank">屯昌</a></span><span><a href="http://tongren.#.com/" target="_blank">铜仁</a></span><span><a href="http://tongchuan.#.com/" target="_blank">铜川</a></span><span><a href="http://tianshui.#.com/" target="_blank">天水</a></span><span><a href="http://tulufan.#.com/" target="_blank">吐鲁番</a></span><span><a href="http://tacheng.#.com/" target="_blank">塔城</a></span><span><a href="http://tumushuke.#.com/" target="_blank">图木舒克</a></span><span><a href="http://tunmenqu.#.com/" target="_blank">屯门区</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>W</span><span><span><a href="http://wuhai.#.com/" target="_blank">乌海</a></span><span><a href="http://wulanchabu.#.com/" target="_blank">乌兰察布</a></span><span><a href="http://wuxi.#.com/" target="_blank">无锡</a></span><span><a href="http://wenzhou.#.com/" target="_blank">温州</a></span><span><a href="http://wuhu.#.com/" target="_blank">芜湖</a></span><span><a href="http://weifang.#.com/" target="_blank">潍坊</a></span><span><a href="http://weihai.#.com/" target="_blank">威海</a></span><span><a href="http://wuhan.#.com/" target="_blank">武汉</a></span><span><a href="http://wuzhou.#.com/" target="_blank">梧州</a></span><span><a href="http://wuzhishan.#.com/" target="_blank">五指山</a></span><span><a href="http://wenchang.#.com/" target="_blank">文昌</a></span><span><a href="http://wanning.#.com/" target="_blank">万宁</a></span><span><a href="http://wenshan.#.com/" target="_blank">文山</a></span><span><a href="http://weinan.#.com/" target="_blank">渭南</a></span><span><a href="http://wuwei.#.com/" target="_blank">武威</a></span><span><a href="http://wuzhong.#.com/" target="_blank">吴忠</a></span><span><a href="http://wulumuqi.#.com/" target="_blank">乌鲁木齐</a></span><span><a href="http://wujiaqu.#.com/" target="_blank">五家渠</a></span><span><a href="http://wangzaiqu.#.com/" target="_blank">湾仔区</a></span><span><a href="http://quanwanqu.#.com/" target="_blank">荃湾区</a></span><span><a href="http://wusu.#.com/" target="_blank">乌苏市</a></span></span></div>
              </div>
            </div>
            <div id="c07" class="hidden">
              <div class="rcc-con">
                <div><span>X</span><span><span><a href="http://xingtai.#.com/" target="_blank">邢台</a></span><span><a href="http://xinzhou.#.com/" target="_blank">忻州</a></span><span><a href="http://xinganmeng.#.com/" target="_blank">兴安盟</a></span><span><a href="http://xlgl.#.com/" target="_blank">锡林郭勒</a></span><span><a href="http://xuzhou.#.com/" target="_blank">徐州</a></span><span><a href="http://xuancheng.#.com/" target="_blank">宣城</a></span><span><a href="http://xiamen.#.com/" target="_blank">厦门</a></span><span><a href="http://xinyu.#.com/" target="_blank">新余</a></span><span><a href="http://xinxiang.#.com/" target="_blank">新乡</a></span><span><a href="http://xuchang.#.com/" target="_blank">许昌</a></span><span><a href="http://xinyang.#.com/" target="_blank">信阳</a></span><span><a href="http://xiangyang.#.com/" target="_blank">襄阳</a></span><span><a href="http://xiaogan.#.com/" target="_blank">孝感</a></span><span><a href="http://xianning.#.com/" target="_blank">咸宁</a></span><span><a href="http://xiantao.#.com/" target="_blank">仙桃</a></span><span><a href="http://xiangtan.#.com/" target="_blank">湘潭</a></span><span><a href="http://xiangxi.#.com/" target="_blank">湘西</a></span><span><a href="http://xsbn.#.com/" target="_blank">西双版纳</a></span><span><a href="http://xian.#.com/" target="_blank">西安</a></span><span><a href="http://xianyang.#.com/" target="_blank">咸阳</a></span><span><a href="http://xining.#.com/" target="_blank">西宁</a></span><span><a href="http://xigong.#.com/" target="_blank">西贡区</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>Y</span><span><span><a href="http://yangquan.#.com/" target="_blank">阳泉</a></span><span><a href="http://yuncheng.#.com/" target="_blank">运城</a></span><span><a href="http://yingkou.#.com/" target="_blank">营口</a></span><span><a href="http://yanbian.#.com/" target="_blank">延边</a></span><span><a href="http://yichun.#.com/" target="_blank">伊春</a></span><span><a href="http://yancheng.#.com/" target="_blank">盐城</a></span><span><a href="http://yangzhou.#.com/" target="_blank">扬州</a></span><span><a href="http://yingtan.#.com/" target="_blank">鹰潭</a></span><span><a href="http://yc.#.com/" target="_blank">宜春</a></span><span><a href="http://yantai.#.com/" target="_blank">烟台</a></span><span><a href="http://yichang.#.com/" target="_blank">宜昌</a></span><span><a href="http://yueyang.#.com/" target="_blank">岳阳</a></span><span><a href="http://yiyang.#.com/" target="_blank">益阳</a></span><span><a href="http://yongzhou.#.com/" target="_blank">永州</a></span><span><a href="http://yangjiang.#.com/" target="_blank">阳江</a></span><span><a href="http://yunfu.#.com/" target="_blank">云浮</a></span><span><a href="http://yl.#.com/" target="_blank">玉林</a></span><span><a href="http://yangpu.#.com/" target="_blank">洋浦</a></span><span><a href="http://yibin.#.com/" target="_blank">宜宾</a></span><span><a href="http://yaan.#.com/" target="_blank">雅安</a></span><span><a href="http://yuxi.#.com/" target="_blank">玉溪</a></span><span><a href="http://yanan.#.com/" target="_blank">延安</a></span><span><a href="http://yulin.#.com/" target="_blank">榆林</a></span><span><a href="http://yushu.#.com/" target="_blank">玉树</a></span><span><a href="http://yinchuan.#.com/" target="_blank">银川</a></span><span><a href="http://yili.#.com/" target="_blank">伊犁</a></span><span><a href="http://youjianwangqu.#.com/" target="_blank">油尖旺区</a></span><span><a href="http://yuanlangqu.#.com/" target="_blank">元朗区</a></span></span></div>
              </div>
              <div class="rcc-con">
                <div><span>Z</span><span><span><a href="http://zjk.#.com/" target="_blank">张家口</a></span><span><a href="http://zhenjiang.#.com/" target="_blank">镇江</a></span><span><a href="http://zhoushan.#.com/" target="_blank">舟山</a></span><span><a href="http://zhangzhou.#.com/" target="_blank">漳州</a></span><span><a href="http://zibo.#.com/" target="_blank">淄博</a></span><span><a href="http://zaozhuang.#.com/" target="_blank">枣庄</a></span><span><a href="http://zhengzhou.#.com/" target="_blank">郑州</a></span><span><a href="http://zhoukou.#.com/" target="_blank">周口</a></span><span><a href="http://zhumadian.#.com/" target="_blank">驻马店</a></span><span><a href="http://zhuzhou.#.com/" target="_blank">株洲</a></span><span><a href="http://zjj.#.com/" target="_blank">张家界</a></span><span><a href="http://zhuhai.#.com/" target="_blank">珠海</a></span><span><a href="http://zhanjiang.#.com/" target="_blank">湛江</a></span><span><a href="http://zhaoqing.#.com/" target="_blank">肇庆</a></span><span><a href="http://zhongshan.#.com/" target="_blank">中山</a></span><span><a href="http://zsqd.#.com/" target="_blank">中沙群岛</a></span><span><a href="http://zigong.#.com/" target="_blank">自贡</a></span><span><a href="http://ziyang.#.com/" target="_blank">资阳</a></span><span><a href="http://zunyi.#.com/" target="_blank">遵义</a></span><span><a href="http://zhaotong.#.com/" target="_blank">昭通</a></span><span><a href="http://zhangye.#.com/" target="_blank">张掖</a></span><span><a href="http://zhongwei.#.com/" target="_blank">中卫</a></span></span></div>
              </div>
            </div>
            <span></span> </div>
        </li>
      </ul>
    </div>-->
    <div class="index_top_picture fright"> <a href="#/u/400/" target="_blank"><img src="images/<?php echo $row_Rec_topggo['gg_photo1']; ?>" width="288" height="80"></a> </div>
  </div>
  <div class="nav" id="nav">
    <div class="main">
      <ul>
        <li <?php if($_SERVER["SCRIPT_NAME"]=="/index.php"|| $_SERVER["SCRIPT_NAME"]=="/"){?> class="nowpage" <?php }?>><a href="/">首页</a></li>
        <li <?php if($_SERVER["SCRIPT_NAME"]=="/filter.php"){?> class="nowpage" <?php }?> > <a href="/filter.php">手机靓号</a>
          <div class="childnav"> <span><a href="filter.php">黑龙江</a></span> <span><!--<a href="#/shouji/huishou/">手机回收</a>--></span> </div>
        </li>
        
        
        <li <?php if($_SERVER["SCRIPT_NAME"]=="/gh.php"||$_SERVER["SCRIPT_NAME"]=="/search.php"){?> class="nowpage" <?php }?> > <a href="/gh.php">固定电话</a>
          <div class="childnav"> <span <?php if($_SERVER["SCRIPT_NAME"]=="/gh.php"){echo 'class="active"';}?>><a href="/gh.php">固定电话</a></span> <span <?php if($_SERVER["SCRIPT_NAME"]=="/search.php"){echo 'class="active"';}?>><a href="/search.php">高级搜索</a></span>  </div>
        </li>
         <li <?php if($_SERVER["SCRIPT_NAME"]=="/400_soso.php"||$_SERVER["SCRIPT_NAME"]=="/400.php"){?> class="nowpage" <?php }?>> <a href="/400.php">400电话</a>
          <div class="childnav"> <span <?php if($_SERVER["SCRIPT_NAME"]=="/400.php"){echo 'class="active"';}?>><a href="/400.php">400靓号</a></span> <span <?php if($_SERVER["SCRIPT_NAME"]=="/400_soso.php"){echo 'class="active"';}?>><a href="/400_soso.php">高级搜索</a></span> <!--<span><a href="#/400/all/">快速选号</a></span> <span><a href="#/4 target="_blank">手机号归属地查询</a></span> <span><a href="http://jixiong.#.com/" target="_blank">手机号吉凶测试</a></span> <span><a href="#/tools/haoduan/">手机号段查询</a></span> <span><a href="#/quhao/">区号查询</a></span> <span><a href="#/changyongdianhua/">常用电话</a></span> --></div>
        </li>
        
        <li <?php if($_SERVER["SCRIPT_NAME"]=="/cpai.php"||$_SERVER["SCRIPT_NAME"]=="/cp_search.php"){?> class="nowpage" <?php }?> > <a href="/cpai.php">车牌选号</a>
          <div class="childnav"> <span <?php if($_SERVER["SCRIPT_NAME"]=="/cpai.php"){echo 'class="active"';}?>><a href="/cpai.php">车牌靓号</a></span> <span <?php if($_SERVER["SCRIPT_NAME"]=="/cp_search.php"){echo 'class="active"';}?>><a href="/cp_search.php">高级搜索</a></span> </div>
        </li>
        
          <li <?php if($_SERVER["SCRIPT_NAME"]=="/fzan/index.php"||$_SERVER["SCRIPT_NAME"]=="/fzan/index.php"){?> class="nowpage" <?php }?> > <a href="/fzan/index.php">加盟建站</a>
          <!--<div class="childnav"> <span <?php if($_SERVER["SCRIPT_NAME"]=="/cpai.php"){echo 'class="active"';}?>><a href="cpai.php">车牌靓号</a></span> <span <?php if($_SERVER["SCRIPT_NAME"]=="/cp_search.php"){echo 'class="active"';}?>><a href="cp_search.php">高级搜索</a></span> </div>-->
        </li>
        
        
       <li <?php if($_SERVER["SCRIPT_NAME"]=="/foot_news.php"||$_SERVER["SCRIPT_NAME"]=="/foot_news.php"){?> class="nowpage" <?php }?> > <a href="/foot_news.php?news_id=7">付款方式</a>
          <!--<div class="childnav"> <span <?php if($_SERVER["SCRIPT_NAME"]=="/cpai.php"){echo 'class="active"';}?>><a href="cpai.php">车牌靓号</a></span> <span <?php if($_SERVER["SCRIPT_NAME"]=="/cp_search.php"){echo 'class="active"';}?>><a href="cp_search.php">高级搜索</a></span> </div>-->
        </li> 
        
        <!--<li class=""> <a href="#/qq/">QQ靓号</a>
          <div class="childnav"> <span><a href="#/qq/">QQ靓号</a></span> <span><a href="#/qq/search.htm">高级搜索</a></span> <span><a href="#/qq/all/">快速选号</a></span> <span><a href="#/qqqun/">QQ群</a></span> <span><a href="#/qq/yuding.htm">私人定制</a></span> <span><a href="#/qq/gujia/">QQ号估价</a></span> <span><a href="#/qq/jixiong/">QQ号吉凶</a></span> </div>
        </li>-->
       
        <li class="dpgl"><a href="javascript:;">用户服务中心</a>
         <div class="submenu">
            <div><a href="/hy/zze.php" target="_blank">免费注册</a></div>
            <div><a href="/hy/dl.php" target="_blank">会员登录</a></div>
            <div><a href="/foot_news.php?news_id=4" target="_blank">VIP会员介绍</a></div>
  <!--          <div><a href="#/about/ad.htm" target="_blank">广告服务</a></div>
            <div><a href="#/shopid/" target="_blank">超靓门牌号</a></div>-->
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<?php
mysql_free_result($Rec_guanlia);

mysql_free_result($Rec_topggo);

mysql_free_result($Rec_gzptai);
?>
