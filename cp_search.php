<?php require_once('Connections/connch21.php'); ?>
<?php ?>
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


 
header("Content-type: text/html; charset=utf-8");

$bigtype=$_GET['bigtype'];
//echo $bigtype."<br>";
$smalltype=$_GET['smalltype'];
//echo $smalltype."<br>";

$grade=$_GET['grade'];
//echo $grade."<br>";

$key=$_GET['key'];
//echo $key."<br>";

$tail=$_GET['tail'];
//echo $tail."<br>";


$link='';

if(!empty($bigtype)){
$link = "bigtype = '$bigtype' ";
}



if(!empty($bigtype)&&!empty($smalltype)&&empty($grade)&&empty($key)&&empty($tail)){
$link = $link."and smalltype = '$smalltype'";
} 


if(!empty($bigtype)&&!empty($smalltype)&&!empty($grade)&&empty($key)&&empty($tail)){
$link = $link."and smalltype = '$smalltype' and grade='$grade'";
} 

//此处也很关健，empty($key)=0 的话，那!empty($tail)就没意义，所以和上一条一样
if(!empty($bigtype)&&!empty($smalltype)&&!empty($grade)&&empty($key)&&!empty($tail)){
$link = $link."and smalltype = '$smalltype' and grade='$grade'";
} 

	
	//此处!empty($key);不为空的条件就是不能为0，为0就是此处就变成条件empty($key)
if(!empty($bigtype)&&!empty($smalltype)&&!empty($grade)&&!empty($key)&&empty($tail)){
	
	$link = $link."and smalltype = '$smalltype' and grade='$grade' and cp_hao like '%$key%'";

} 


	
if(!empty($bigtype)&&!empty($smalltype)&&empty($grade)&&!empty($key)&&empty($tail)){
	
	$link = $link."and smalltype = '$smalltype'  and cp_hao like '%$key%'";

} 


if(!empty($bigtype)&&!empty($smalltype)&&empty($grade)&&empty($key)&&!empty($tail)){
	
	$link = $link."and smalltype = '$smalltype'  ";

} 


if(!empty($bigtype)&&!empty($smalltype)&&empty($grade)&&!empty($key)&&!empty($tail)){
	
	$link = $link."and smalltype = '$smalltype'  and substring(cp_hao,-4) like '%$key%'";

} 



if(!empty($bigtype)&&!empty($smalltype)&&!empty($grade)&&!empty($key)&&!empty($tail)){
$link = $link."and smalltype = '$smalltype' and grade='$grade' and substring(cp_hao,-4) like '%$key%' ";
} 


if(!empty($bigtype)&&empty($smalltype)&&!empty($grade)&&empty($key)&&empty($tail)){
$link = $link."and grade='$grade'";
}

//此处也很关健，empty($key)=0 的话，那!empty($tail)就没意义，所以和上一条一样
if(!empty($bigtype)&&empty($smalltype)&&!empty($grade)&&empty($key)&&!empty($tail)){
$link = $link."and grade='$grade'";
} 


if(!empty($bigtype)&&empty($smalltype)&&!empty($grade)&&!empty($key)&&empty($tail)){
$link = $link." and grade='$grade' and cp_hao like '%$key%'";
} 


if(!empty($bigtype)&&empty($smalltype)&&!empty($grade)&&!empty($key)&&!empty($tail)){
$link = $link." and grade='$grade' and substring(cp_hao,-4) like '%$key%' ";
} 



if(!empty($bigtype)&&empty($smalltype)&&empty($grade)&&!empty($key)&&empty($tail)){
$link = $link."and cp_hao like '%$key%'";
}

if(!empty($bigtype)&&empty($smalltype)&&empty($grade)&&!empty($key)&&!empty($tail)){
$link = $link."and substring(cp_hao,-4) like '%$key%'";
}


//这块是精典所有等于0的都加这个and条件。如果等于0上面条件!empty($key)就是没有了，就会换成上条条件中empty($key)为空查询。就是假不会输出这个变量，所以如果等于0为了显示查询出==0的$ket还有最好在加一个这个变量。
if($key=="0"&&$tail!="1"){$link=$link."and cp_hao like '%$key%'";}

//尾号四位截取，并且关健字==0的查询
if($key=="0"&&$tail=="1"){$link=$link."and substring(cp_hao,-4) like '%$key%'";}

//echo $link;



?>
<?php 
if($link){

	
$maxRows_Recordset1 = 40;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM cpai where $link ORDER BY id DESC";
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

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);

$maxRows_Rec_cpnews = 15;
$pageNum_Rec_cpnews = 0;
if (isset($_GET['pageNum_Rec_cpnews'])) {
  $pageNum_Rec_cpnews = $_GET['pageNum_Rec_cpnews'];
}
$startRow_Rec_cpnews = $pageNum_Rec_cpnews * $maxRows_Rec_cpnews;

mysql_select_db($database_connch21, $connch21);
$query_Rec_cpnews = "SELECT * FROM news WHERE bigtype = '3' and smalltype='车牌号资讯'  ORDER BY news_id DESC";
$query_limit_Rec_cpnews = sprintf("%s LIMIT %d, %d", $query_Rec_cpnews, $startRow_Rec_cpnews, $maxRows_Rec_cpnews);
$Rec_cpnews = mysql_query($query_limit_Rec_cpnews, $connch21) or die(mysql_error());
$row_Rec_cpnews = mysql_fetch_assoc($Rec_cpnews);

if (isset($_GET['totalRows_Rec_cpnews'])) {
  $totalRows_Rec_cpnews = $_GET['totalRows_Rec_cpnews'];
} else {
  $all_Rec_cpnews = mysql_query($query_Rec_cpnews);
  $totalRows_Rec_cpnews = mysql_num_rows($all_Rec_cpnews);
}
$totalPages_Rec_cpnews = ceil($totalRows_Rec_cpnews/$maxRows_Rec_cpnews)-1;
	
}





else{
	$maxRows_Recordset1 = 40;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM cpai  ORDER BY id DESC";
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

$maxRows_Rec_cpnews = 15;
$pageNum_Rec_cpnews = 0;
if (isset($_GET['pageNum_Rec_cpnews'])) {
  $pageNum_Rec_cpnews = $_GET['pageNum_Rec_cpnews'];
}
$startRow_Rec_cpnews = $pageNum_Rec_cpnews * $maxRows_Rec_cpnews;

mysql_select_db($database_connch21, $connch21);
$query_Rec_cpnews = "SELECT * FROM news WHERE bigtype = '3' and smalltype='车牌号资讯'  ORDER BY news_id DESC";
$query_limit_Rec_cpnews = sprintf("%s LIMIT %d, %d", $query_Rec_cpnews, $startRow_Rec_cpnews, $maxRows_Rec_cpnews);
$Rec_cpnews = mysql_query($query_limit_Rec_cpnews, $connch21) or die(mysql_error());
$row_Rec_cpnews = mysql_fetch_assoc($Rec_cpnews);

if (isset($_GET['totalRows_Rec_cpnews'])) {
  $totalRows_Rec_cpnews = $_GET['totalRows_Rec_cpnews'];
} else {
  $all_Rec_cpnews = mysql_query($query_Rec_cpnews);
  $totalRows_Rec_cpnews = mysql_num_rows($all_Rec_cpnews);
}
$totalPages_Rec_cpnews = ceil($totalRows_Rec_cpnews/$maxRows_Rec_cpnews)-1;
	
}



?>


<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<meta charset="UTF-8">
				
		
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
 
       /* if ($("[tname=smalltype]").val() == "") {
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
<div class="main">

   <!--小图广告-->
	<div class="main mb20">
		<!--<div class="adq"> 
						<a href="#/escrow/1/" target="_blank"><img src="./index_files/5844e561cfd1f.jpg" width="293" height="105"></a> 
				<a href="#/u/521" target="_blank"><img src="./index_files/583935594ade7.jpg" width="293" height="105"></a> 
				<a href="#/u/400" target="_blank"><img src="./index_files/576bac1ca8dce.jpg" width="293" height="105"></a> 
				<a href="#/u/521" target="_blank"><img src="./index_files/58393459847d5.jpg" width="293" height="105"></a> 
				
				  		 </div>-->
		 <div class="clear"></div>
	</div>
	<!--广告结束-->
  <div class="listbox mb20">
  <div class="list fleft" style="width:915px">
    <div class="sort">
      <ul class="fleft">
        <li class="current"><a href="#">按默认</a></li>
        <!--<li><a href="#/chepai/search.htm?stype=&p1=&p2=&p3=&p4=&p5=&key=&tail=0&pricescope=-1&city=0&province=0&s=date">按最新</a></li>
        <li class="">
        <a href="#/chepai/search.htm?stype=&p1=&p2=&p3=&p4=&p5=&key=&tail=0&pricescope=-1&city=0&province=0&s=lowprice">按价格
          <i></i>
          <s></s>
        </a>
        </li>-->
        <!-- <li><a href="#">按默认</a></li>
        <li><a href="#">按最新</a></li>
        <li class="arrow"><a href="#">按价格<i class="active"></i><s></s></a></li> -->
      </ul>
      <!--<div class="fl listsc"><a href="#/chepai/search.htm?favorite=1&rand=0.09265928785316646">收藏（<span class="red favoritechepai">0</span>）个</a></div>-->
       
    </div>
    <div class="label">
      <ul>
        <li class="number">车牌号</li>
        <li class="price">代选费</li>
        <li class="brand">归属地</li>
        <li class="moral">号码寓意</li>
        <li class="package2">联系人电话</li>
        <li class="operation">操作</li>
      </ul>
    </div>
            <?php do { ?>
              <div class="numbershow">
                <ul>
                  <li class="number hmzt"><a href="cp_xy.php?id=<?php echo $row_Recordset1['id']; ?>" target="_blank"><span class="red"><?php echo substr($row_Recordset1['cp_hao'],0,5); ?></span><span class="searchresultkey"><?php echo substr($row_Recordset1['cp_hao'],5,6); ?></span></a></li>
                  <li class="price"><span class="red">￥<?php echo $row_Recordset1['s_price']; ?></span></li>
                  <li class="brand">
                    <?php /*if($row_Recordset1['bigtype']==1){
				echo "黑龙江";
				}; */?>
                    <?php echo $row_Recordset1['smalltype']; ?></li>
                  
                  <li class="moral"><a href="#/chepai/89861-396-Q-UH678.htm" title="<?php echo $row_Recordset1['message']; ?>">
				  <?php  if($row_Recordset1['message']==""){ echo "未知" ; }
				  else
				  {echo $row_Recordset1['message']; }?> </a></li>
                  <li class="package2">
                    <a href="#" target="_blank"><?php if($row_Recordset1['l_tel']==""){echo "未知"; }else{echo $row_Recordset1['l_tel'];}?></a>
                    <i class="sjdp_icon1 sj_vip4"></i>
                    <i class="sjdp_icon sj_dpup" title="10020"></i>
                  </li>
                  <li class="operation"><a class="collect fleft addFavorite" key="708388" type="chepai" style="cursor:pointer;">收藏</a><a class="reserve fright" href="foot_news.php?news_id=7" target="_blank">预订</a></li>
                </ul>
            </div>
              <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
       
        
      
      <div class="bottom-page mb20">
        <div class="bottom-page-l"><div id="pageGro" class="cb">
          <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
            <div class="indexPage"><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>" class="m-pages">首页</a></div><?php } // Show if not first page ?>
          
          <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <div class="pageUp"><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>" class="m-pages-pre">上一页</a></div><?php }?>
          
          
          <div class="pageList">
            <ul>
              
              
              <?php 
$i=1;

if($_GET['pageNum_Recordset1']){$i=$_GET['pageNum_Recordset1'];}
$tt=$i+9;
if($tt>$totalPages_Recordset1+1){$tt=$totalPages_Recordset1+1;}
while($i<=$tt)
  {
 ?>  
              
              <?php if ($_GET['pageNum_Recordset1']+1==$i){ ?>
              <li class="on"><a href="javascript:;"><?php echo $i ?></a></li>
              <?php } else { ?>
              <li ><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $i-1, $queryString_Recordset1); ?>"><?php echo $i ?></a></li>
              <?php }  ?>
              
              <?php   
  $i++;
  }
?>
              
              
              
              
              
              
            </ul></div>
          
          <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <div class="pageDown"><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>" class="m-pages-next">下一页</a></div><?php } ?>
        </div></div>
        <!--<div class="f-paper"><span class="fp-text">共<strong>150131</strong>条记录</span><span class="fp-text"><b>1</b><em>/</em><i>3754</i></span><a href="javascript:void(0);" class="fp-prev disabled">&lt;</a><a href="#/dianhua/search.htm?stype=&m1=0&m2=1&m3=2&grade=-1&province=-1&city=-1&price=-1&key=&page=2" class="fp-next">&gt;</a></div>-->
        <div class="clear"></div>
      </div>
        </div>
    <div class="fr n_right">
    	<!--<h1 class="tjbt">根据您的浏览为您推荐</h1>
    	<div class="tj_hm">
          <ul>
                        <li><a href="#/chepai/89861-396-Q-UH678.htm" target="_blank"><h2><i class="liang"></i><span class="yellow">川Q·</span>UH678</h2><p><span class="fl">宜宾</span><span class="fr">￥<span class="red">800</span></span></p></a></li>              
                          <li><a href="#/chepai/89861-384-A-A9A88.htm" target="_blank"><h2><i class="liang"></i><span class="yellow">川A·</span>A9A88</h2><p><span class="fl">成都</span><span class="fr">￥<span class="red">600</span></span></p></a></li>              
                          <li><a href="#/chepai/89861-384-A-A866A.htm" target="_blank"><h2><i class="liang"></i><span class="yellow">川A·</span>A866A</h2><p><span class="fl">成都</span><span class="fr">￥<span class="red">600</span></span></p></a></li>              
                          <li><a href="#/chepai/89861-384-A-A399A.htm" target="_blank"><h2><i class="liang"></i><span class="yellow">川A·</span>A399A</h2><p><span class="fl">成都</span><span class="fr">￥<span class="red">600</span></span></p></a></li>              
                          <li><a href="#/chepai/179-387-E-_5D55.htm" target="_blank"><h2><i class="liang"></i><span class="yellow">川E·</span>*5D55</h2><p><span class="fl">泸州</span><span class="fr">￥<span class="red">1200</span></span></p></a></li>              
                    
          </ul>
        </div>-->
      <div class="tj_new">
        	<div class="tj_newbt"><span class="fl">车牌号资讯</span><!--<a class="fr" href="#/news/class_21/1">更多</a>--></div>
            <ul>
                        	<?php do { ?>
                       	    <li><a href="news_xy.php?news_id=<?php echo $row_Rec_cpnews['news_id']; ?>" target="_blank"><?php echo $row_Rec_cpnews['news_title']; ?></a></li>
                        	  <?php } while ($row_Rec_cpnews = mysql_fetch_assoc($Rec_cpnews)); ?>               
                        	
        </ul>
      </div>
        
        <!--<div class="nr_gg" style=" padding:10px 0;">
   	    <img src="./index_files/list_new.jpg" width="250" height="127"> </div>
         <div class="tj_new tjshop">
        	<div class="tj_newbt "><span class="fl">推荐皇冠店铺</span></div>
            <ul>
                        <li><a href="#/u/179" target="_blank"><i class="rz_icon rz_1"></i>▆█▆█ 汽车 车牌 号 号 牌</a></li>
                       <li><a href="#/u/219" target="_blank"><i class="rz_icon rz_1"></i>特价号加微信</a></li>
                       <li><a href="#/u/232" target="_blank"><i class="rz_icon rz_1"></i>为客户提供大</a></li>
                       <li><a href="#/u/768" target="_blank"><i class="rz_icon rz_1"></i>成都车牌选号 成都车牌靓号吧</a></li>
                       <li><a href="#/u/65999" target="_blank"><i class="rz_icon rz_1"></i>志远行</a></li>
                       <li><a href="#/u/89861" target="_blank"><i class="rz_icon rz_1"></i>▂▃▅▆█ 车 牌 靓号 车 牌 号◆◆</a></li>
           

        </ul>
        </div>
    </div>-->
    
    
    <div class="clear"></div>
  </div>
  </div>
   <!--小图广告-->
	<div class="main mb20">
		<!--<div class="adq"> 
						<a href="#/u/521" target="_blank"><img src="./index_files/583933b3f1258.jpg" width="293" height="105"></a> 
				<a href="#/u/521" target="_blank"><img src="./index_files/583933df68658.jpg" width="293" height="105"></a> 
				<a href="#/u/521" target="_blank"><img src="./index_files/583933fc8efa8.jpg" width="293" height="105"></a> 
				<a href="#/u/521" target="_blank"><img src="./index_files/5839342d8be93.jpg" width="293" height="105"></a> 
				
				  		 </div>-->
		 <div class="clear"></div>
	</div>
	<!--广告结束-->
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
<?php include ("footer.php")?></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Rec_cpnews);
?>
