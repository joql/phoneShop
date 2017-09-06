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

$maxRows_Recordset1 = 24;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM cpai WHERE info_top = 1 ORDER BY id desc";
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

$maxRows_Recordset2 = 24;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = "SELECT * FROM cpai WHERE info_top = 2 ORDER BY id DESC";
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
?>
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

<meta name="mobile-agent" content="format=html5;url=http://m.jihaoba.com/chepai/">
	<link href="./index_files/car.css" rel="stylesheet" type="text/css">
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
 /*
        if ($("[tname=smalltype]").val() == "") {
            alert('请选择城市!');
            $("[tname=smalltype]").val("");
            $("[tname=smalltype]").focus();
            return false;
        }*/
    
	
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


	<div class="search_banner main">
    	<div class="search fleft">
        	<h2>搜索车牌号</h2>
            <div class="preview">
            <div class="scrolldoorFrame">
                <ul class="scrollUl">
                    <li class="gg01">模糊搜索</li>
                    <!--<li class="gg02" id="n02">定位搜索</li>-->
                </ul>
                <form method="get" action="cp_search.php" name="myform">
                <div class="bor03 cont">
                    <div id="y01">
                        <div class="sj_mhss">

               <p>
                            <label class="ms_label">归&nbsp;&nbsp;属&nbsp;&nbsp;地：</label>
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
                 </p>
              <p>
                <label class="ms_label">价格范围：</label>
                            <select name="grade" id="grade">
                            <option value="">不限价格</option>
                                                        <option value="-1">价格面议</option>
                                                        <option value="1">500元以下</option>
                                                        <option value="2">500-2000元</option>
                                                        <option value="3">2000-1万元</option>
                                                        <option value="4">1万-5万元</option>
                                                        <option value="5">5万元以上</option>
                                                      
                            </select>
                        </p>
            <p><label class="ms_label">包含数字：</label><span id="showcarhead"></span>
            <input name="key" type="text" maxlength="11" class="keyserbtnsty" value="">
            <input type="checkbox" name="tail" value="1" class="wenbenksty "> 
            <label class="padl6">尾数</label>&nbsp;
                        </p>
                         <p><button class="ssan" type="submit" name="tj" onClick="javascript:return check();">搜索</button>
                        </p>
            </div>
                    </div>
                    
                    </div></form>
            </div>
      </div>
</div>
<?php include("cp_lbo.php")?>
        <div class="clear"></div>
        
    

<!--搜索区域结束-->
<!--置顶靓号区域-->
<div class="main">
	<div class="number_01"><div class="fright haomo_more"><a href="cp_search.php" class="blue">更多</a></div>置顶靓号</div>
    <!--<div class="fright number_right_more"><a href="#/chepai/all/" class="blue">更多热门城市</a></div>-->
     <!--<ul class="fleft number_right_city"><li><a href="#/chepai/chengdu/">成都</a></li><li><a href="#/chepai/chongqing/">重庆</a></li><li><a href="#/chepai/panzhihua/">攀枝花</a></li><li><a href="#/chepai/leshan/">乐山</a></li><li><a href="#/chepai/suining/">遂宁</a></li><li><a href="#/chepai/meishan/">眉山</a></li></ul>-->
    <div class="clear"></div>
        	<ul class="number_right_num">
                    
                    
              <?php do { ?>
              <li><a href="cp_xy.php?id=<?php echo $row_Recordset1['id']; ?>" target="_blank"><h2><i class="liang"></i><span class="yellow"><?php echo substr($row_Recordset1['cp_hao'],0,5); ?></span><?php echo  substr($row_Recordset1['cp_hao'],5,6); ?></h2><p><span class="fl"><?php echo $row_Recordset1['smalltype']; ?></span><span class="fr">￥<span class="red"><?php echo $row_Recordset1['s_price']; ?></span></span></p></a></li>
                <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                  
                     
           
           
           
            <div class="clear"></div>
            </ul>
    	
</div>
   


<!--置顶靓号区域结束-->
<!--天价靓号区域-->
<div class="main">
	<div class="number_02"><div class="fright haomo_more"><a href="cp_search.php" class="blue">更多</a></div>天价靓号</div>
    <!--<div class="fright number_right_more"><a href="#/chepai/all/" class="blue">更多热门城市</a></div>-->
    <!--<ul class="fleft number_right_city"><li><a href="#/chepai/chengdu/">成都</a></li><li><a href="#/chepai/chongqing/">重庆</a></li><li><a href="#/chepai/panzhihua/">攀枝花</a></li><li><a href="#/chepai/leshan/">乐山</a></li><li><a href="#/chepai/suining/">遂宁</a></li><li><a href="#/chepai/meishan/">眉山</a></li></ul>-->
    <div class="clear"></div>
        	<ul class="number_right_num">
                    <?php do { ?>
                    <li><a href="cp_xy.php?id=<?php echo $row_Recordset2['id']; ?>" target="_blank"><h2><i class="liang"></i><span class="yellow"><?php echo substr($row_Recordset2['cp_hao'],0,5); ?></span><?php echo substr($row_Recordset2['cp_hao'],5,6); ?></h2><p><span class="fl"><?php echo $row_Recordset2['smalltype']; ?></span><span class="fr">￥<span class="red"><?php echo $row_Recordset2['s_price']; ?></span></span></p></a></li>
                      <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
                  
                     <div class="clear"></div>
            </ul>
    	
</div>
   

<!--天价靓号区域结束-->
<!--<div class="main" style="margin-top:32px; margin-bottom:32px;">
    <div class="crown fl">
     	<div class="number_04"><div class="fright haomo_more"></div>靓号经纪人</div>
        <div class="ranklist">
        <ul style="margin-top: -24px;">       
              
              
              
              
              
              
              
              
              
              
              
              
                   <li class="top"><p><a href="#/escrow/44/" target="_blank">经纪人-仵楠</a></p></li><li class="top"><p><a href="#/escrow/149/" target="_blank">经纪人-君君</a></p></li><li class="top"><p><a href="#/escrow/158/" target="_blank">经纪人-任河清</a></p></li><li class="top"><p><a href="#/escrow/588/" target="_blank">经纪人-葡壹</a></p></li><li class="top"><p><a href="#/escrow/633/" target="_blank">经纪人-赵云</a></p></li><li class="top"><p><a href="#/escrow/875/" target="_blank">经纪人-张远松</a></p></li><li class="top"><p><a href="#/escrow/896/" target="_blank">经纪人-姚光伟</a></p></li><li class="top"><p><a href="#/escrow/5555/" target="_blank">经纪人-张爽</a></p></li><li class="top"><p><a href="#/escrow/6699/" target="_blank">经纪人-翟林祥</a></p></li><li class="top"><p><a href="#/escrow/31863/" target="_blank">经纪人-吴蕊</a></p></li><li class="top"><p><a href="#/escrow/52222/" target="_blank">经纪人-赵艳</a></p></li><li class="top"><p><a href="#/escrow/81678/" target="_blank">经纪人-李鹏飞</a></p></li><li class="top"><p><a href="#/escrow/1/" target="_blank">经纪人-刘玉娇</a></p></li></ul>
      </div>
    </div>  --> 
	<!--新闻-->
    <!--<div class="news fr">
    	<div class="number_05"><div class="fright haomo_more"><a href="#/news/class_21/1" class="blue">更多</a></div>车牌号资讯</div>
       	<ul>
              <li> <a href="#/news/show/9312" target="_blank"> <img class="block fleft" src="./index_files/584188da0a154.png" width="125" height="85">
        <div class="fright">
          <h1 class="wz_hidden">上海新能源车专用号牌开始发放</h1>
          <span>​按照公安部的规定，新能源车专用号牌于昨天起在上海、南京、无锡、深圳、...</span> </div>
        </a> </li>
            <li> <a href="#/news/show/9292" target="_blank"> <img class="block fleft" src="./index_files/584036641f92a.png" width="125" height="85">
        <div class="fright">
          <h1 class="wz_hidden">摇号选车牌 轻松得靓号</h1>
          <span>​由荆州市公安交管局车管所和《江汉风》联合举办的“摇号选车牌”活动，受...</span> </div>
        </a> </li>
            <li> <a href="#/news/show/9159" target="_blank"> <img class="block fleft" src="./index_files/58385735684e8.png" width="125" height="85">
        <div class="fright">
          <h1 class="wz_hidden">上海年底前将推车牌号互联网随机...</h1>
          <span>作为试点城市，上海将在年底前全面启用全国统一版机动车选号系统，此前，新...</span> </div>
        </a> </li>
            <li> <a href="#/news/show/9122" target="_blank"> <img class="block fleft" src="./index_files/5835ac2ceaac4.png" width="125" height="85">
        <div class="fright">
          <h1 class="wz_hidden">为什么启用新能源汽车号牌？</h1>
          <span>自2016年12月1日起，上海、南京、无锡、济南、深圳5个城市将率先试...</span> </div>
        </a> </li>
            <div class="clear"></div>
    </ul>
    </div>-->
    <!--新闻结束-->
    <div class="clear"></div>
</div>
<div class="main mb20">
<!--<div class="adq"> 
<a href="#/u/429" target="_blank"><img src="./index_files/577f26026e828.jpg" width="293" height="105"></a> 
<a href="#/u/521" target="_blank"><img src="./index_files/583935594ade7.jpg" width="293" height="105"></a> 
<a href="#/u/400" target="_blank"><img src="./index_files/576bac1ca8dce.jpg" width="293" height="105"></a> 
<a href="#/u/521" target="_blank"><img src="./index_files/58393459847d5.jpg" width="293" height="105"></a> 
<a href="#/u/521" target="_blank"><img src="./index_files/583933b3f1258.jpg" width="293" height="105"></a> 
<a href="#/u/521" target="_blank"><img src="./index_files/583933df68658.jpg" width="293" height="105"></a> 
<a href="#/u/521" target="_blank"><img src="./index_files/583933fc8efa8.jpg" width="293" height="105"></a> 
<a href="#/u/521" target="_blank"><img src="./index_files/5839342d8be93.jpg" width="293" height="105"></a> 
 </div>-->
 <div class="clear"></div>
</div>
<div class="liucheng main">
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
      <div class="lc_wz fright">沟通交易</div>
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


<?php include ("footer.php")?></body></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
