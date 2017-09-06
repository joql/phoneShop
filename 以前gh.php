<?php require_once('Connections/connch21.php'); ?>
<?php ?>
<?php  error_reporting(E_ALL & ~E_NOTICE);
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


$maxRows_Recordset1 = 25;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM kuhua where info_top=1 ORDER BY id DESC";
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

$maxRows_Recordset2 = 20;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = "SELECT * FROM kuhua WHERE info_top = 2 ORDER BY id DESC";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $connch21) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

mysql_select_db($database_connch21, $connch21);
$query_Rec_ghggao = "SELECT * FROM guanggao WHERE title = '副页固定电话页广告  '";
$Rec_ghggao = mysql_query($query_Rec_ghggao, $connch21) or die(mysql_error());
$row_Rec_ghggao = mysql_fetch_assoc($Rec_ghggao);
$totalRows_Rec_ghggao = mysql_num_rows($Rec_ghggao);




?>
<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<meta charset="UTF-8">
				
		<link rel="dns-prefetch" href="http://static1.jihaoba.com/">
			
		<link rel="dns-prefetch" href="http://static2.jihaoba.com/">
			
		<link rel="dns-prefetch" href="http://static3.jihaoba.com/">
				<meta name="applicable-device" content="pc">
    <?php include("keyword.php");?>
	<meta name="robots" content="All">
	<meta name="verify-v1" content="casZho9kECUkOAU+2uY1SGpjeqJiwu0o/ALrzgPNKFo=">
	<meta name="AizhanSEO" content="a2511a4d1a6a1b0fe57f5ce001438cc9">
	<meta http-equiv="Content-Language" content="zh_CN">
	<meta name="author" content="lezhizhe.net">
	<meta name="copyright" content="jihaoba.com">
	<link rel="shortcut icon" href="#/favicon.ico" type="image/x-icon">
	<link href="./index_files/public.css" rel="stylesheet" type="text/css">

<meta name="mobile-agent" content="format=html5;url=http://m.jihaoba.com/dianhua/">
	<link href="./index_files/telephone.css" rel="stylesheet" type="text/css">

<!--检查表单不能为空的调用JS 而且有此多条件的修改单选才工作-->
<script type="text/javascript" src="admin/js/jquery-1.7.2.min.js"></script>
<!--检查表单不能为空的调用JS结束-->


</head>
<body>



<?php  mysql_select_db($database_connch21, $connch21);
     $sql="select * from smalltype_gh";
  $result = mysql_query( $sql );
?>
<script language="JavaScript">
 var onecount;
 subcat=new Array(); 
    <?php
 $count=0;
    while($rows=mysql_fetch_assoc($result)){
      $bid=$rows['bid'];
   $smalltype=$rows['smalltype'];
 ?>
    subcat[<?php echo $count?>]=new Array("<?php echo $rows['smalltype']?>","<?php echo
    $rows['bid']?>","<?php echo $rows['smalltype']?>"); <?php
    $count++; }
     ?>
  onecount=<?php echo $count;?>;
    function changelocation(locationid)
    {
 document.myform.smalltype.length=1;
    var locationid=locationid;
 var i;
    for(i=0;i<onecount;i++)
 {   
  if(subcat[i][1]==locationid)
  {
   document.myform.smalltype.options[document.myform.smalltype.length]=new Option(subcat[i][0],subcat[i][2]);    }
     }
}
</script>

  <script type="text/javascript" language="javascript">

    function check() {
      
	  if ($("[tname=news_title]").val() == "") {
            alert('手机号不能为空!');
            $("[tname=news_title]").val("");
            $("[tname=news_title]").focus();
            return false;
        }
	  
	  if ($("[tname=message]").val() == "") {
            alert('新闻简介不能为空!');
            $("[tname=messsag]").val("");
            $("[tname=message]").focus();
            return false;
        }
	  
	  
	  if ($("[tname=nr]").val() == "") {
            alert('新闻内容不能为空!');
            $("[tname=nr]").val("");
            $("[tname=nr]").focus();
            return false;
        }
	  
	    if ($("[tname=bigtype]").val()=="") {
            alert('请选择归属地!');
            $("[tname=bigtype]").val("");
            $("[tname=bigtype]").focus();
            return false;
        }
 
        if ($("[tname=smalltype]").val() == "") {
            alert('请选择城市!');
            $("[tname=smalltype]").val("");
            $("[tname=smalltype]").focus();
            return false;
        }
    
	
	if ($("[tname=grade]").val() == "") {
            alert('号码规律不能为空!');
            $("[tname=grade]").val("");
            $("[tname=grade]").focus();
            return false;
        }
	
	
	
  if ($("[tname=price]").val() == "") {
            alert('价格范围不能为空!');
            $("[tname=price]").val("");
            $("[tname=price]").focus();
            return false;
        }
 
 
    }
 
    </script>



<?php include("nav.php");?>
<div id="bj" style="display: none;"></div>


<div class="main">
	<div class="dh_p1 mb20">
   	  <div class="dh_sstj1 fleft">
	  <form action="search.php" method="get" name="myform" class="sreach" id="myform">
       	<div class="sj_mhss fleft">
        	<p>
			 <label class="ms_label">类型：</label>
		     <input type="checkbox" name="m1" value="-1" class="wenbenksty dan_active">
			 <label>无线</label>
			 <input type="checkbox" name="m2" value="1" class="wenbenksty dan_active" checked="checked">
			 <label>有线</label>
			 <input type="checkbox" name="m3" value="2" class="wenbenksty dan_active" >
			 <label>商务一号通</label>
          </p>
          <p>
		  <label class="ms_label">归属地：</label>
		    
                                <?php  mysql_select_db($database_connch21, $connch21);
      // $sql = "select * from bigtype";
	   $sql="SELECT * 
FROM bigtype_gh";
          $result = mysql_query( $sql );
 ?>     
                                
                                <select name="bigtype" id="bigtype" tname="bigtype" onChange="changelocation(document.myform.bigtype.options[document.myform.bigtype.selectedIndex].value)" size="1">
                                  <option value=""  >不限归属地</option>
                                  <?php //ini_set('display_errors', 'Off'); //error_reporting(E_ALL & ~E_NOTICE);
		  while($rows=mysql_fetch_array($result)){   ?>
                                  <option value="<?php echo $rows['id']; ?>"><?php echo $rows['bigtype']; ?></option>
                                  <?php } ?>
                                </select> 
                                
                                
                                
                                
                                
                <select name="smalltype" id="smalltype" tname="smalltype">
          <option value="">不限城市</option>
        </select>                 
                                
                                
			
            </p><p>
			 <label class="ms_label">包含数字：</label>
            <input name="key" type="text" class="bhsz" />
            </p>
          <p></p>
        </div>
        <div class="sj_mhss fright">
        	<p>
			<label class="ms_label">号码规律：</label>
			<select name="grade" tname="grade">
				<option value="">号码规律</option>
								<option value="-1">无规律</option>
								<option value="1">尾数AAA</option>
								<option value="2">尾数ABC</option>
								<option value="3">尾数AABB</option>
								<option value="4">尾数ABAB</option>
								<option value="5">尾数ABBA</option>
								<option value="6">尾数ABCD+</option>
								<option value="7">尾数AABBCC</option>
								<option value="8">尾数ABCABC</option>
								<option value="9">尾数AAABB</option>
								<option value="10">尾数AAAA+</option>
								<option value="11">中间AAA</option>
								<option value="12">中间AABB</option>
								<option value="13">中间AAAA+</option>
								<option value="14">中间AAABB</option>
								<option value="15">中间AABBB</option>
								<option value="16">中间AAABBB</option>
								<option value="17">中间AABBCC</option>
								<option value="18">中间ABCABC</option>
							</select>
			</p>
			<p>
			<label class="ms_label">价格范围：</label>
			<select name="price" >
				<option value="">价格范围</option>
								<option value="-1">价格面议</option>
								<option value="1">100元以下</option>
								<option value="2">100-500元</option>
								<option value="3">500-1000元</option>
								<option value="4">1000-2000元</option>
								<option value="5">2000-5000元</option>
								<option value="6">5000-10000元</option>
								<option value="7">10000元以上</option>
							</select>
		</p>
        </div>
        <div style="clear:both">
        
          
        </div>
                <div class="dh_ss">
                  <span class="sj_cleaer fr "> <a href="gh.php" title="清除所有条件"> 清除所有条件 </a> </span><input name="tj" type="submit" class="serbtnyshi button" id="tj" onClick="javascript:return check();" value="搜索">
              </div>
	  <input type="hidden" name="number" value="">
	  </form>
	  </div>
      <div class="dh_cs fright">
      	<div class="dh_dhsl"><span>150,001</span>个固定电话正在本站出售</div>
        <a href="http://user.jihaoba.com/telephone/add" target="_blank">立即发布</a>
      </div>
      <div class="clear"></div>
    </div>
		<!--大图广告-->
      <div class="ad1-1 mb20">
			<a href="#/escrow/149/" target="_blank"><img src="images/<?php echo $row_Rec_ghggao['gg_photo1']; ?>" width="1190" height="100"></a>
			</div>
  <div class="dh_lmbt">
    	<div class="dh_lmname fleft">置顶靓号</div>
        <div class="dh_lmqh">
        	<ul>
            <li><a href="search.php?bigtype=1&smalltype=哈尔滨" target="_blank">哈尔滨</a></li>
            <li><a href="search.php?bigtype=1&smalltype=齐齐哈尔" target="_blank">齐齐哈尔</a></li>
            <li><a href="search.php?bigtype=1&smalltype=牡丹江" target="_blank">牡丹江</a></li>
            <li><a href="search.php?bigtype=1&smalltype=佳木斯" target="_blank">佳木斯</a></li>
            </ul>
        </div>
        <div class="dh_more fright"><a href="search.php">更多</a></div>
    </div>
  <div class="sj_lm mb20">
   	  <div class="sj_lmleft fleft">
        	<div class="sj_lb">
            <div class="full-screen-slider">
                <ul class="sj_slides">
                <li style="background:url(&#39;http://static1.jihaoba.com/home/images/dh_lb2.jpg&#39;) no-repeat center top"><a href=""></a></li>
                <li style="background:url(&#39;http://static1.jihaoba.com/home/images/dh_lb.jpg&#39;) no-repeat center top"><a href=""></a></li>
                </ul>
                </div>
            </div>
        
        <div class="sj_bqlist">
            <ul>
            <li><a href="search.php?bigtype=1&smalltype=哈尔滨">哈尔滨</a></li>
            <li><a href="search.php?bigtype=1&smalltype=齐齐哈尔">齐齐哈尔</a></li>
            <li><a href="search.php?bigtype=1&smalltype=牡丹江">牡丹江</a></li>
            <li><a href="search.php?bigtype=1&smalltype=佳木斯">佳木斯</a></li>
            <li><a href="search.php?bigtype=1&smalltype=绥化">绥化</a></li>
            <li><a href="search.php?bigtype=1&smalltype=大兴安岭">大兴安岭</a></li>
            <li><a href="search.php?bigtype=1&smalltype=伊春">伊春</a></li>
            <li><a href="search.php?bigtype=1&smalltype=大庆">大庆</a></li>
            </ul>
            <div style="clear:both"></div>
            </div>
      
            
      </div>
        <div class="sj_lmright fright">
        	<ul>
			            <?php do { ?>
		                <li>
			                <a href="gh_xy.php?id=<?php echo $row_Recordset1['id']; ?>" target="_blank">
		                    <div class="sj_sjhm"><i class="dh_putong"></i><span class="sj_zi"><?php echo substr($row_Recordset1['gh_hao'],0,4); ?></span>-<?php echo substr($row_Recordset1['gh_hao'],4,8); ?></div>
		                    <div class="sj_hmsm"><?php echo $row_Recordset1['smalltype']; ?>　￥<span class="red"><?php echo $row_Recordset1['s_price']; ?></span></div>
		                    </a>
		                </li>
			              <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                       
                        </ul>
        </div>
    </div>
	<!--大图广告-->
      <div class="ad1-1 mb20">
		  <a href="#/about/ad.htm" target="_blank"><img src="images/<?php echo $row_Rec_ghggao['gg_photo2']; ?>" width="1190" height="100"></a>
	  	</div>
    <div class="dh_lmbt">
    	<div class="dh_lmname fleft">天价靓号</div>
        <div class="dh_lmqh">
        	<ul>
            <li><a href="search.php?bigtype=1&smalltype=哈尔滨" target="_blank">哈尔滨</a></li>
            <li><a href="search.php?bigtype=1&smalltype=齐齐哈尔" target="_blank">齐齐哈尔</a></li>
            <li><a href="search.php?bigtype=1&smalltype=牡丹江" target="_blank">牡丹江</a></li>
            <li><a href="search.php?bigtype=1&smalltype=佳木斯" target="_blank">佳木斯</a></li>
            </ul>
        </div>
        <div class="dh_more fright"><a href="search.php">更多</a></div>
    </div>
    <div class="sj_lm">
   	  <div class="sj_lmleft fleft">
        	<div class="sj_lb">
            <div class="full-screen-slider">
                <ul class="sj_slides2">
                <li style="background:url(&#39;http://static1.jihaoba.com/home/images/dh_lb.jpg&#39;) no-repeat center top"><a href=""></a></li>
                <li style="background:url(&#39;http://static1.jihaoba.com/home/images/dh_lb2.jpg&#39;) no-repeat center top"><a href=""></a></li>
                </ul>
                </div>
            </div>
        <div class="sj_bqlist">
            <ul>
            <li><a href="search.php?bigtype=1&smalltype=哈尔滨">哈尔滨</a></li>
            <li><a href="search.php?bigtype=1&smalltype=齐齐哈尔">齐齐哈尔</a></li>
            <li><a href="search.php?bigtype=1&smalltype=牡丹江">牡丹江</a></li>
            <li><a href="search.php?bigtype=1&smalltype=佳木斯">佳木斯</a></li>
            <li><a href="search.php?bigtype=1&smalltype=绥化">绥化</a></li>
            <li><a href="search.php?bigtype=1&smalltype=大兴安岭">大兴安岭</a></li>
            <li><a href="search.php?bigtype=1&smalltype=伊春">伊春</a></li>
            <li><a href="search.php?bigtype=1&smalltype=大庆">大庆</a></li>
            </ul>
            <div style="clear:both"></div>
        </div>
      </div>
        <div class="sj_lmright fright">
        	<ul>
            			<?php do { ?>
           			    <li>
            			    <a href="gh_xy.php?id=<?php echo $row_Recordset2['id']; ?>" target="_blank">
           			        <div class="sj_sjhm"><i class="dh_lianghao"></i><span class="sj_zi"><?php echo substr($row_Recordset2['gh_hao'],0,4); ?></span>-<?php echo substr($row_Recordset2['gh_hao'],4,8); ?></div>
           			        <div class="sj_hmsm"><?php echo $row_Recordset2['smalltype']; ?>　￥<span class="red"><?php echo $row_Recordset2['s_price']; ?></span></div>
           			        </a>
           			    </li>
            			  <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
						
          </ul>
        </div>
    </div>
    
    
  <!--<div class="sj_new mb20">
  <div class="tj_shop fleft">
    <div class="dh_lmbt">
    	<div class="dh_lmname2 fleft">靓号经纪人</div>
    </div>
    <div class="ranklist">
    <ul style="margin-top: -12px;">
	      
          
          
          
          
          
          
          
          
          
          
          
          
    	<li class="top"><p><a href="#/escrow/875/" target="_blank">经纪人-张远松</a></p></li><li class="top"><p><a href="#/escrow/896/" target="_blank">经纪人-姚光伟</a></p></li><li class="top"><p><a href="#/escrow/5555/" target="_blank">经纪人-张爽</a></p></li><li class="top"><p><a href="#/escrow/6699/" target="_blank">经纪人-翟林祥</a></p></li><li class="top"><p><a href="#/escrow/31863/" target="_blank">经纪人-吴蕊</a></p></li><li class="top"><p><a href="#/escrow/52222/" target="_blank">经纪人-赵艳</a></p></li><li class="top"><p><a href="#/escrow/81678/" target="_blank">经纪人-李鹏飞</a></p></li><li class="top"><p><a href="#/escrow/1/" target="_blank">经纪人-刘玉娇</a></p></li><li class="top"><p><a href="#/escrow/44/" target="_blank">经纪人-仵楠</a></p></li><li class="top"><p><a href="#/escrow/149/" target="_blank">经纪人-君君</a></p></li><li class="top"><p><a href="#/escrow/158/" target="_blank">经纪人-任河清</a></p></li><li class="top"><p><a href="#/escrow/588/" target="_blank">经纪人-葡壹</a></p></li><li class="top"><p><a href="#/escrow/633/" target="_blank">经纪人-赵云</a></p></li></ul>
    </div>
  </div>
  <div class="new fright">
    <div class="dh_lmbt">
    	<div class="dh_lmname2 fleft">固话号码资讯</div>
        <div class="dh_more fright"><a href="#/news/class_25/1">更多</a></div>
    </div>
    <ul>
	      <li> <a href="#/news/show/9259" target="_blank"> <img class="block fleft" src="./index_files/583e763f61151.jpg" width="125" height="85">
        <div class="fright">
          <h2 class="wz_hidden">如何选择合适的固话号码？</h2>
          <span>不吉利的号码接触的时间长了在一定程度上会影响你的运势。而我们接触时间最...</span> </div>
		  </a> </li>
	      <li> <a href="#/news/show/9226" target="_blank"> <img class="block fleft" src="./index_files/583d0ec9bd779.jpg" width="125" height="85">
        <div class="fright">
          <h2 class="wz_hidden">越南：明年全国固话区号将换！</h2>
          <span>根据11月24日的越南《海关报》报道消息，越南通信与传媒部2036号决...</span> </div>
		  </a> </li>
	      <li> <a href="#/news/show/9190" target="_blank"> <img class="block fleft" src="./index_files/583a713158c59.jpg" width="125" height="85">
        <div class="fright">
          <h2 class="wz_hidden">固话成电信诈骗新手段？</h2>
          <span>近年来，各种的电信诈骗手段络绎不绝，电话、网络和短信方式，编造虚假信息...</span> </div>
		  </a> </li>
	      <li> <a href="#/news/show/9174" target="_blank"> <img class="block fleft" src="./index_files/58392b6a4d2ce.jpg" width="125" height="85">
        <div class="fright">
          <h2 class="wz_hidden">英国：固话上网用户占据60% </h2>
          <span>现在在许多人的眼中，在移动通讯盛行的年代，使用固定电话的人已经成为古董...</span> </div>
		  </a> </li>
		  <div class="clear"></div>
    </ul>
  </div>
  <div class="clear"></div>
</div>-->
	
    <!--<div class="main">
	<div class="adq"> 
		<a href="#/u/89336" target="_blank"><img src="./index_files/574d4e2c7701f.jpg" width="293" height="105"></a> 
		<a href="#/u/1" target="_blank"><img src="./index_files/2015_11_25_1448415486.gif" width="293" height="105"></a> 
		<a href="#/u/400" target="_blank"><img src="./index_files/57844615a2da6.jpg" width="293" height="105"></a> 
		<a href="#/u/1" target="_blank"><img src="./index_files/5747ab3737d05.jpg" width="293" height="105"></a> 
		<a href="#/u/4000" target="_blank"><img src="./index_files/582d758ac52cb.jpg" width="293" height="105"></a> 
		<a href="#/u/4000" target="_blank"><img src="./index_files/58365b52b3510.jpg" width="293" height="105"></a> 
		<a href="http://m.jihaoba.com/u/690" target="_blank"><img src="./index_files/583903d3816ff.jpg" width="293" height="105"></a> 
		<a href="#/u/4000" target="_blank"><img src="./index_files/582d757ade22b.jpg" width="293" height="105"></a> 
			 </div>
	 <div class="clear"></div>
	</div>-->
    <div class="liucheng">
    <ul>
      <li class="lc">
        <div class="lc_icon lc1 fleft"></div>
        <div class="lc_wz fright">选择号码</div>
        </li>
      <li class="lcjt"></li>
      <li class="lc">
        <div class="lc_icon lc2 fleft"></div>
        <div class="lc_wz fright">联系店主</div>
        </li>
      <li class="lcjt"></li>
      <li class="lc">
        <div class="lc_icon lc3 fleft"></div>
        <div class="lc_wz fright">填写资料</div>
        </li>
      <li class="lcjt"></li>
      <li class="lc">
        <div class="lc_icon lc4 fleft"></div>
        <div class="lc_wz fright">支付费用</div>
        </li>
      <li class="lcjt"></li>
      <li class="lc">
        <div class="lc_icon lc5 fleft"></div>
        <div class="lc_wz fright">开通使用</div>
        </li>
    </ul>
  </div>
</div>
<!--<div class="main footer">
	        <div class="friendlink">
		<div class="friendlink_l">站内导航</div>
		<div class="friendlink_r">
						<div class="clear"></div></div><div class="clear"></div>
    </div>
			<div class="friendlink">
		<div class="friendlink_l">友情链接</div>
		<div class="friendlink_r">
				<a href="http://www.examw.com/ksbd/" target="_blank">考试宝典</a>
				<a href="http://www.chinacar.com.cn/banguache/" target="_blank">半挂车</a>
				<a href="http://beijing.liebiao.com/gongshangzhuce/" target="_blank">北京工商注册</a>
				<a href="http://www.vstou.com/" target="_blank">头像宝</a>
				<a href="http://sx.focus.cn/" target="_blank">绍兴房产网</a>
				<a href="http://sz.centanet.com/" target="_blank">深圳二手房</a>
				<a href="http://www.ht.cn/" target="_blank">商标转让</a>
				<a href="http://p3.cjcp.com.cn/kaijiang/" target="_blank">排列3开奖结果</a>
				<a href="http://www.youbian.com/kuaidi/" target="_blank">快递查询</a>
				<a href="http://www.azg168.com/yuncheng/" target="_blank">生肖运势</a>
				<a href="http://www.xbiao.com/seiko/" target="_blank">精工手表型号</a>
				<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>	
	   <div class="red friendsm">链接交换联被降权的网站将被换到北京手机号码页面（注：交换首页权重不低于6）</div>
</div>-->

<?php include ("footer.php")?>
<a href="javascript:;" class="cd-top">Top</a>

<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Rec_ghggao);
?>
