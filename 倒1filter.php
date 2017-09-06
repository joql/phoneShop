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
?>
<?php 


$pid=$_GET['pid'];
$xihuan1="where pid=$pid";

if(!empty($pid)){$xihuan1="$xihuan1";}
else{$xihuan1='';}
//echo $xihuan1;
//echo $pid;

$maxRows_Recordset2 = 30;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_connch21, $connch21);
$query_Recordset2 = "SELECT id,pid, tel, `day`, sj_hao, info_top, s_price FROM sj $xihuan1 ORDER BY id DESC";
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

$maxRows_Recordset2 = 26;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;



?>

<?php
$currentPage = $_SERVER["PHP_SELF"];


  error_reporting(E_ALL & ~E_NOTICE);
$pid=$_GET['pid'];
//echo $pid."<br>";
$tel=$_GET['tel'];
//echo $tel."<br>";

$theme=$_GET['theme'];
//echo $theme."<br>";

$price=$_GET['price'];
//echo $price."<br>";
$day=$_GET['day'];
//echo $day."<br>";

//$pid="1";
//$tel=2;
//$theme=3;
//$price=4;
//$day=5;
$key=$_GET['key'];
$tai=$_GET['tai'];

$link='';

if(!empty($pid)){
$link = "pid = '$pid' ";
}

if(empty($pid)&&!empty($tel)&&empty($theme)&&empty($price)&&empty($day)){
$link = "tel = '$tel'";
} 

//echo $link;


 if(empty($pid)&&empty($tel)&&!empty($theme)&&empty($price)&&empty($day)){
$link = "theme = '$theme'";
} 




if(empty($pid)&&empty($tel)&&empty($theme)&&!empty($price)&&empty($day)){
$link = "price = '$price'";
} 

 if(empty($pid)&&empty($tel)&&empty($theme)&&empty($price)&&!empty($day)){
$link = "day = '$day'";
} 

//组合选1

if(!empty($pid)&&empty($tel)&&!empty($theme)&&empty($price)&&empty($day)){
$link=$link."  and theme='$theme'" ;

} 

if(!empty($pid)&&empty($tel)&&empty($theme)&&!empty($price)&&empty($day)){
$link=$link."  and price='$price'" ;

} 

if(!empty($pid)&&empty($tel)&&empty($theme)&&empty($price)&&!empty($day)){
$link=$link."  and day='$day'" ;

} 

if(empty($pid)&&!empty($tel)&&!empty($theme)&&empty($price)&&empty($day)){
$link=" tel = '$tel' and theme='$theme'" ;

}

if(empty($pid)&&!empty($tel)&&empty($theme)&&!empty($price)&&empty($day)){
$link=" tel = '$tel' and price='$price'" ;

}
if(empty($pid)&&!empty($tel)&&empty($theme)&&empty($price)&&!empty($day)){
$link=" tel = '$tel' and day='$day'" ;

}

if(empty($pid)&&empty($tel)&&!empty($theme)&&!empty($price)&&empty($day)){
$link="theme = '$theme' and price='$price'" ;

}

if(empty($pid)&&empty($tel)&&!empty($theme)&&empty($price)&&!empty($day)){
$link="theme = '$theme' and day='$day'" ;

}


if(!empty($pid)&&!empty($tel)&&empty($theme)&&!empty($price)&&empty($day)){
$link=$link." and tel = '$tel'  and price='$price' " ;


}

if(!empty($pid)&&!empty($tel)&&empty($theme)&&empty($price)&&!empty($day)){
$link=$link." and tel = '$tel'  and day='$day' " ;


}

if(!empty($pid)&&!empty($tel)&&empty($theme)&&!empty($price)&&!empty($day)){
$link=$link." and tel = '$tel'  and price='$price' and day='$day' " ;


}
if(empty($pid)&&!empty($tel)&&!empty($theme)&&!empty($price)&&empty($day)){
$link="tel = '$tel' and theme='$theme' and price='$price'  " ;


}

if(empty($pid)&&!empty($tel)&&!empty($theme)&&!empty($price)&&!empty($day)){
$link="tel = '$tel' and theme='$theme' and price='$price' and day='$day' " ;


}

if(!empty($pid)&&empty($tel)&&!empty($theme)&&!empty($price)&&empty($day)){
$link=$link."  and theme='$theme' and price='$price' " ;


}

if(!empty($pid)&&empty($tel)&&!empty($theme)&&!empty($price)&&!empty($day)){
$link=$link."  and theme='$theme' and price='$price' and day='$day'" ;


}

if(empty($pid)&&!empty($tel)&&empty($theme)&&!empty($price)&&!empty($day)){
$link=" tel='$tel'  and price='$price' and day='$day'" ;


}

if(!empty($pid)&&empty($tel)&&empty($theme)&&!empty($price)&&!empty($day)){
$link=$link." and price='$price' and day='$day'" ;


}

if(empty($pid)&&empty($tel)&&!empty($theme)&&!empty($price)&&empty($day)){
$link=" theme='$theme'  and price='$price' " ;


}

if(empty($pid)&&empty($tel)&&!empty($theme)&&!empty($price)&&!empty($day)){
$link=" theme='$theme'  and price='$price' and day='$day' " ;


}

if(!empty($pid)&&empty($tel)&&!empty($theme)&&empty($price)&&!empty($day)){
$link=$link." and theme='$theme'   and day='$day' " ;


}

if(!empty($pid)&&!empty($tel)&&!empty($theme)&&empty($price)&&!empty($day)){
$link=$link." and tel=$tel  and theme='$theme'   and day='$day' " ;


}

if(empty($pid)&&!empty($tel)&&!empty($theme)&&empty($price)&&!empty($day)){
$link=" tel=$tel  and theme='$theme'   and day='$day' " ;


}


//组合筛选2
if(!empty($pid)&&!empty($tel)&&empty($theme)&&empty($price)&&empty($day)){
$link=$link." and tel = '$tel'";


}


if(!empty($pid)&&!empty($tel)&&!empty($theme)&&empty($price)&&empty($day)){
$link=$link." and tel = '$tel' and theme='$theme'" ;

}




if(!empty($pid)&&!empty($tel)&&!empty($theme)&&!empty($price)&&empty($day)){
$link=$link." and tel = '$tel' and theme='$theme' and price='$price'" ;


}

if(!empty($pid)&&!empty($tel)&&!empty($theme)&&!empty($price)&&!empty($day)){
$link=$link." and tel = '$tel' and theme='$theme' and price='$price' and day='$day'" ;


}

if(!empty($key)&&empty($tai)){
	
	$link="sj_hao like '%$key%'";
	
	}






//调试用看最终输出什么
//echo $link;

if($link){//为真 输出记录集1
$maxRows_Recordset1 = 40;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sj where $link ORDER BY id DESC";
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


}

	
	
elseif(!empty($key)&&!empty($tai)){//多条件搜索上面表单搜索。尾四查搜。
	
	$link01="substring(sj_hao,-4) like '%$key%'";
	
	$maxRows_Recordset1 = 40;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT sj_hao FROM sj where $link01 ORDER BY id DESC";
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

	
	
	}	
	


else {//不为真输出记录集1
	
	
	$maxRows_Recordset1 = 40;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sj  ORDER BY id DESC";
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

}
?>
<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<meta name="applicable-device" content="pc">
<?php include("keyword.php");?>
<meta name="robots" content="All">
<meta name="verify-v1" content="casZho9kECUkOAU+2uY1SGpjeqJiwu0o/ALrzgPNKFo=">
<meta name="AizhanSEO" content="a2511a4d1a6a1b0fe57f5ce001438cc9">
<meta http-equiv="Content-Language" content="zh_CN">
<meta name="author" content="lezhizhe.net">
<meta name="copyright" content="jihaoba.com">
<!--<link rel="shortcut icon" href="#/favicon.ico" type="image/x-icon">-->
<link href="./index_files/public.css" rel="stylesheet" type="text/css">
<!--<meta name="mobile-agent" content="format=html5;url=http://m.jihaoba.com/escrow/">-->
<link href="./index_files/escrow.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include("nav.php");?>
<div id="bj" style="display: none;"></div>
<div class="main">
  <div class="clear"></div>
  <div class="found"><img src="./index_files/found.jpg" width="1190" height="120"></div>
  <div class="hmxq fright">
    <div class="search background">
      <form action="/filter.php" method="get">
        <div class="mohu">
          <input class="ssk" placeholder="请输入包含数字" autocomplete="off" value="" name="key" type="text">
          <label>
            <input class="dx" name="tai" type="checkbox" value="1">
            <span>尾数</span></label>
          <input class="anniu" type="submit" value="搜索">
        </div>
      </form>
    </div>
    <div class="choice clearfix" id="choice"> 
      
      <!-- Bootstrap --> 
      <!--<link href="css/bootstrap.min.css" rel="stylesheet">
--> 
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --> 
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
      <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> 
      <script src="js/jquery.js"></script> 
      <!-- Include all compiled plugins (below), or include individual files as needed --> 
      <script src="js/bootstrap.min.js"></script> 
      <script>
     $(function(){
       <?php
          if($_GET){
            echo 'var obj='.json_encode($_GET).';';
          }
       ?>
      if(typeof(obj)!='undefined'){
          for(k in obj){
            $("#"+k).val(obj[k]);
            $("a["+k+"="+obj[k]+"]").parent().addClass("in").siblings().removeClass("in");
          }
      }
     })
    </script> 
      <script>
function Filter(a,b){
          var $ = function(e){return document.getElementById(e);}
          var ipts = $('filterForm').getElementsByTagName('input'),result=[];
          for(var i=0,l=ipts.length;i<l;i++){
          if(ipts[i].getAttribute('to')=='filter'){
          result.push(ipts[i]);
          }
          }
          if($(a)){
          $(a).value = b;
          for(var j=0,len=result.length;j<len;j++){
          
            if(result[j].value=='' || result[j].value=='0'){
            result[j].parentNode.removeChild(result[j]);
            }
          }
            document.forms['filterForm'].submit();
          }
          return false;
          }
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
    </script>
      <style>
	
	

.in, .in a {
	background: #FA8D00;
	color: #fff;
	border-radius: 4px;
	
}
.in a:hover {
	color: #fff
}
    
    </style>
      <style>


#dtj{width:870px; font-size:0.875em; /*background:#F3F3F3;*/ margin-left:-8px;  margin-bottom:5px;}
#dtj a{ text-decoration:none; padding:0 3px; }

#dtj div {   margin-top:-12px; height:30px; /*border-bottom:1px  solid #333333; background:#0F6;*/}

#dtj ul{ margin-left:25px;}

#dtj ul li { float:left; list-style:none;  margin-right:10px; margin-top:2px;};


 </style>
      <div id="dtj" >
        <form id="filterForm" name="form1" method="get" action="filter.php">
          <input id="pid" type="hidden" value="" name="pid" to="filter">
          <input id="tel" type="hidden" value="" name="tel" to="filter">
          <input id="theme" type="hidden" value="" name="theme" to="filter">
          <input id="price" type="hidden" value="" name="price" to="filter">
          <input id="day" type="hidden" value="" name="day" to="filter">
          <!-- <input id="type" type="hidden" value="" name="type" to="filter">--> 
          <br />
          <div >
            <ul >
              <li>城　市：</li>
              <li class='in'><a pid="0" href="javascript:Filter('pid','0');">不限</a></li>
              <li ><a pid="1" href="javascript:Filter('pid','1');">哈尔滨</a></li>
              <li ><a pid="2" href="javascript:Filter('pid','2');">齐齐哈尔</a></li>
              <li ><a pid="3" href="javascript:Filter('pid','3');">牡丹江</a></li>
              <li ><a pid="4" href="javascript:Filter('pid','4');">佳木斯</a></li>
              <li><a pid="5" href="javascript:Filter('pid','5');">绥化</a></li>
              <li ><a pid="6" href="javascript:Filter('pid','6');">黑河</a></li>
              <li ><a pid="7" href="javascript:Filter('pid','7');">大兴安岭</a></li>
              <li><a pid="8" href="javascript:Filter('pid','8');">伊春</a></li>
              <li><a pid="9" href="javascript:Filter('pid','9');">大庆</a></li>
              <li><a pid="10" href="javascript:Filter('pid','10');">鸡西</a></li>
              <li><a pid="11" href="javascript:Filter('pid','11');">鹤岗</a></li>
              <li><a pid="12" href="javascript:Filter('pid','12');">双鸭山</a></li>
              <li><a pid="13" href="javascript:Filter('pid','13');">七台河</a></li>
            </ul>
            <div  style="width:98%; height:1px; border-bottom:1px dashed #e8e8e8; margin:0 auto;position:relative; bottom:-30px;"></div>
          </div>
          <br />
          <div>
            <ul >
              <li>运营商：</li>
              <li class=' in'><a price="0" href="javascript:Filter('tel','0');">不限</a></li>
              <li ><a tel="1" href="javascript:Filter('tel','1');">中国移动</a></li>
              <li ><a tel="2" href="javascript:Filter('tel','2');">中国联通 </a></li>
              <li><a tel="3" href="javascript:Filter('tel','3');">中国电信</a></li>
              <!--       <li ><a tel="4" href="javascript:Filter('tel','4');">电话4</a></li>
          <li ><a tel="5" href="javascript:Filter('tel','5');">电话5</a></li>-->
            </ul>
            <div  style="width:98%; height:1px; border-bottom:1px dashed #e8e8e8; margin:0 auto;position:relative; bottom:-30px;"></div>
          </div>
          <br />
          <div  style="height:50px;" >
            <ul >
              <li>号　段：</li>
              <li class='in'><a href="javascript:Filter('theme','0');">不限</a></li>
              <li ><a theme='139' href="javascript:Filter('theme','139');">139</a></li>
              <li ><a theme='138' href="javascript:Filter('theme','138');">138</a></li>
              <li><a theme='137' href="javascript:Filter('theme','137');">137</a></li>
              <li ><a theme='136' href="javascript:Filter('theme','136');">136</a></li>
              <li><a theme='135' href="javascript:Filter('theme','135');">135</a></li>
              <li ><a theme='134' href="javascript:Filter('theme','134');">134</a></li>
              <li ><a theme='147' href="javascript:Filter('theme','147');">147</a></li>
              <li ><a theme='150' href="javascript:Filter('theme','150');">150</a></li>
              <li ><a theme='151' href="javascript:Filter('theme','151');">151</a></li>
              <li ><a theme='152' href="javascript:Filter('theme','152');">152</a></li>
              <li ><a theme='157' href="javascript:Filter('theme','157');">157</a></li>
              <li ><a theme='158' href="javascript:Filter('theme','158');">158</a></li>
              <li ><a theme='159' href="javascript:Filter('theme','159');">159</a></li>
              <li ><a theme='178' href="javascript:Filter('theme','178');">178</a></li>
              <li ><a theme='182' href="javascript:Filter('theme','182');">182</a></li>
              <li ><a theme='183' href="javascript:Filter('theme','183');">183</a></li>
              
              <li ><a theme='184' href="javascript:Filter('theme','184');">184</a></li>
              <li ><a theme='187' href="javascript:Filter('theme','187');">187</a></li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              <li ><a theme='188' href="javascript:Filter('theme','188');">188</a></li>
              <li ><a theme='130' href="javascript:Filter('theme','130');">130</a></li>
              <li ><a theme='131' href="javascript:Filter('theme','131');">131</a></li>
              <li ><a theme='132' href="javascript:Filter('theme','132');">132</a></li>
              <li ><a theme='155' href="javascript:Filter('theme','155');">155</a></li>
              <li ><a theme='156' href="javascript:Filter('theme','156');">156</a></li>
              <li ><a theme='186' href="javascript:Filter('theme','186');">186</a></li>
              <li ><a theme='145' href="javascript:Filter('theme','145');">145</a></li>
              <li ><a theme='176' href="javascript:Filter('theme','176');">176</a></li>
              <li><a theme='133' href="javascript:Filter('theme','133');">133</a></li>
              <li ><a theme='153' href="javascript:Filter('theme','153');">153</a></li>
              <li ><a theme='177' href="javascript:Filter('theme','177');">177</a></li>
              <li ><a theme='170' href="javascript:Filter('theme','170');">170</a></li>
              <li ><a theme='171' href="javascript:Filter('theme','171');">171</a></li>
            </ul>
            <div  style="width:98%; height:1px; border-bottom:1px dashed #e8e8e8; margin:0 auto;position:relative; bottom:-50px;"></div>
          </div>
          <br />
          <div>
            <ul >
              <li>价　格：</li>
              <li class=' in'><a price="0" href="javascript:Filter('price','0');">不限</a></li>
              <li ><a price="1" href="javascript:Filter('price','1');">价格面议</a></li>
              <li ><a price="2" href="javascript:Filter('price','2');">2000-5000元</a></li>
              <li><a price="3" href="javascript:Filter('price','3');">5000-10000元</a></li>
              <li ><a price="4" href="javascript:Filter('price','4');">10000元以上</a></li>
            </ul>
            <div  style="width:98%; height:1px; border-bottom:1px dashed #e8e8e8; margin:0 auto;position:relative; bottom:-30px;"></div>
          </div>
          <br />
          <div  style="height:110px;" >
            <ul >
              <li>规　律：</li>
              <li class=' in'><a price="0" href="javascript:Filter('day','0');">不限</a></li>
              <li ><a day="1" href="javascript:Filter('day','1');">普通号码</a></li>
              <li ><a day="2" href="javascript:Filter('day','2');">尾数AA</a></li>
              <li><a day="3" href="javascript:Filter('day','3');">尾数AAA</a></li>
              <li ><a day="4" href="javascript:Filter('day','4');">尾数AAAA</a></li>
              <li ><a day="5" href="javascript:Filter('day','5');">尾数ABC</a></li>
              <li> <a day="6"  href="javascript:Filter('day','6');">尾数ABCD</a></li>
              <li ><a day="7" href="javascript:Filter('day','7');">尾数AAAAA </a></li>
              <li><a day="8" href="javascript:Filter('day','8');">尾数AABB</a></li>
              <li ><a day="9" href="javascript:Filter('day','9');">尾数AAAAB</a></li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              <li ><a day="10" href="javascript:Filter('day','10');">尾数AAAB</a></li>
              <li ><a day="11" href="javascript:Filter('day','11');"> 尾数AABA</a></li>
              <li ><a day="12" href="javascript:Filter('day','12');">尾数AABB</a></li>
              <li ><a day="13" href="javascript:Filter('day','13');">尾数ABBA </a></li>
              <li ><a day="14" href="javascript:Filter('day','14');">尾数ABCDE</a></li>
              <li ><a day="15" href="javascript:Filter('day','15');">尾数AAABB </a></li>
              <li ><a day="16" href="javascript:Filter('day','16');">尾数AABBB </a></li>
              <li ><a day="17" href="javascript:Filter('day','17');">尾数AABAA</a></li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              <li ><a day="18" href="javascript:Filter('day','18');">尾数ABCABC </a></li>
              <li ><a day="19" href="javascript:Filter('day','19');">尾数AAABBB</a></li>
              <li ><a day="20" href="javascript:Filter('day','20');">尾数AABBCC</a></li>
              <li ><a day="21" href="javascript:Filter('day','21');">尾数ABBABB</a></li>
              <li ><a day="22" href="javascript:Filter('day','22');">尾数AAAAA+ </a></li>
              <li ><a day="23" href="javascript:Filter('day','23');">尾数ABCDE+ </a></li>
              <li ><a day="24" href="javascript:Filter('day','24');">尾数ABCABCD</a></li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              <li ><a day="25" href="javascript:Filter('day','25');">尾数ABCDABCD</a></li>
              <li ><a day="26" href="javascript:Filter('day','26');">中间AAA</a></li>
              <li ><a day="27" href="javascript:Filter('day','27');">中间AAAA</a></li>
              <li ><a day="28" href="javascript:Filter('day','28');">中间AABB</a></li>
              <li ><a day="29" href="javascript:Filter('day','29');">中间AAABB</a></li>
              <li ><a day="30" href="javascript:Filter('day','30');">中间AABBB </a></li>
              <li ><a day="31" href="javascript:Filter('day','31');">中间AAAA+</a></li>
              <li ><a day="32" href="javascript:Filter('day','32');">中间AAABBB</a></li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              <li ><a day="33" href="javascript:Filter('day','33');">中间AABBCC</a></li>
              <li ><a day="34" href="javascript:Filter('day','34');">人气号</a></li>
              <li ><a day="35" href="javascript:Filter('day','35');">情侣号</a></li>
              <li ><a day="36" href="javascript:Filter('day','36');">风水号</a></li>
            </ul>
            <div  style="width:98%; height:1px; border-bottom:1px dashed #e8e8e8; margin:0 auto;position:relative; bottom:-114px;"></div>
          </div>
          
          <!-- 
    <div>
 <ul ><li>特　色：</li>
  <li class=' in'><a price="0" href="javascript:Filter('type','0');">不限</a></li>
          <li ><a type="1" href="javascript:Filter('type','1');">参团</a></li>
          <li ><a type="2" href="javascript:Filter('type','2');">组团</a></li>
          <li><a type="3" href="javascript:Filter('type','3');">自驾</a></li>
          <li ><a type="4" href="javascript:Filter('type','4');">自游行</a></li>
          <li ><a type="5" href="javascript:Filter('type','5');">散客游</a></li>
      </ul></div>-->
          
        </form>
      </div>
    </div>
    

    
    <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
  <div class="dp_newpage">
    <div class="dp_hmlb">
      <div class="dp_hmlsm fleft"> <span class="kd1">手机靓号</span> <span class="kd2">售价</span> <span class="kd3">含费</span> <span class="kd4">操作</span> </div>
      <div class="dp_hmlsm fright"> <span class="kd1">手机靓号</span> <span class="kd2">售价</span> <span class="kd3">含费</span> <span class="kd4">操作</span> </div>
      <div class="clearfix"></div>
      <ul>
        <?php do { ?>
          <li>
            <div class="hm_boss">
              <div class="dp_hmzs">
                <div class="kd1 hmzs"><a href="filter_xy.php?id=<?php echo $row_Recordset1['id']; ?>&pid=<?php echo $row_Recordset1['pid']; ?>&tel=<?php echo $row_Recordset1['tel']; ?>" target="_blank">
                
                
                
              <?php //if(substr($row_Recordset1['sj_hao'],0,3)=='139'||){}
			 $tubiao=substr($row_Recordset1['sj_hao'],0,3);
			 $yd='<i class="dp_yidong"></i>';
			 $lt='<i class="dp_liantong"></i>';
			 $dx='<i class="dp_dianxin"></i>';
			 switch ($tubiao)
						{
						
						case 139:
						echo $yd;
						break;
						case 138:
						echo $yd;
						break;
						
						case 137:
						echo $yd;
						break;
							
						case 136:
						echo $yd;
						break;	
						
						case 135:
						echo $yd;
						break;	
						case 134:
						echo $yd;
						break;	
						case 147:
						echo $yd;
						break;
						case 150:
						echo $yd;
						break;
						case 151:
						echo $yd;
						break;
						
						case 152:
						echo $yd;
						break;
						case 157:
						echo $yd;
						break;
						
						case 158:
						echo $yd;
						break;
						
						case 159:
						echo $yd;
						break;
						
						case 178:
						echo $yd;
						break;
						
						case 182:
						echo $yd;
						break;
						
						case 183:
						echo $yd;
						break;
						
						case 184:
						echo $yd;
						break;
						
						case 187:
						echo $yd;
						break;
						
						case 188:
						echo $yd;
						break;
						case 130:
						echo $lt;
						break;
						
						case 131:
						echo $lt;
						break;
						
						case 132:
						echo $lt;
						break;
						
						case 155:
						echo $lt;
						break;
						
						case 156:
						echo $lt;
						break;
						
						case 185:
						echo $lt;
						break;
						
						case 186:
						echo $lt;
						break;
						
						case 145:
						echo $lt;
						break;
						
						case 176:
						echo $lt;
						break;
						case 133:
						echo $dx;
						break;
						
						case 153:
						echo $dx;
						break;
						
						case 177:
						echo $dx;
						break;
						
						case 173:
						echo $dx;
						break;
						
						case 180:
						echo $dx;
						break;
						
						case 181:
						echo $dx;
						break;
						
						case 189:
						echo $dx;
						break;
						
						case 170:
						echo $dx;
						break;
						
						case 171:
						echo $dx;
						break;
						}
			 
			  
			 ?><!--<i class="dp_liantong"></i>--><?php error_reporting(E_ALL & ~E_NOTICE); 
				 $j_red=$row_Recordset1['info_top']; 
				 switch ($j_red)
						{
						case 0:
						echo $row_Recordset1['sj_hao'];
						break;
						case 1:
						echo substr($row_Recordset1['sj_hao'],0,8);
						break;
				        case 2:
						echo substr($row_Recordset1['sj_hao'],0,7);
						break;
						case 3:
						echo substr($row_Recordset1['sj_hao'],0,6);
						break;
				          } ?><span class="red"><?php 
						  // $j_red01=$row_Recordset1['sj_hao']; 
						  
						  switch ($j_red)
						{
						case 0:
						echo "";
						break;
						case 1:
						echo substr($row_Recordset1['sj_hao'],8,3);
						break;
				        case 2:
						echo substr($row_Recordset1['sj_hao'],7,4);
						break;
						 case 3:
						echo substr($row_Recordset1['sj_hao'],6,5);
						break;
				          } ?>
						  
						 </span> </a></div>
               
                <div class="kd2"><span class="red"> ￥<?php echo $row_Recordset1['s_price']; ?> </span></div>
                <div class="kd3"><?php 
				if($row_Recordset1['hfei']!=""){echo $row_Recordset1['hfei'];}else{echo "0" ;} ?>元</div>
                <div class="kd4 hmgm"><a href="filter_xy.php?id=<?php echo $row_Recordset1['id']; ?>&pid=<?php echo $row_Recordset1['pid']; ?>&tel=<?php echo $row_Recordset1['tel']; ?>" target="_blank">查看</a></div>
                <div class="clearfix"></div>
                </div>
              <div class="dp_hmyy">
                <div class="hmzx"> <span class="fleft yys">运营商：<span class="red">
				<?php  $a=$row_Recordset1['pid'];
				switch ($a)
						{
						case 1:
						echo "哈尔滨";
						break;
						case 2:
						echo "齐齐哈尔";
						break;
						
						case 3:
						echo "牡丹江";
						break;
							
						case 4:
						echo "佳木斯";
						break;	
						
						case 5:
						echo "绥化";
						break;	
						case 6:
						echo "黑河";
						break;	
						case 7:
						echo "大兴安岭";
						break;
						case 8:
						echo "伊春";
						break;
						case 9:
						echo "大庆";
						break;
						
						case 10:
						echo "鸡西";
						break;
						case 11:
						echo "鹤岗";
						break;
						case 12:
						echo "双鸭山";
						break;
						case 13:
						echo "七台河";
						break;
						
							} ?> 
					<?php $b=$row_Recordset1['tel'];
					switch ($b)
						{
						case 1:
						echo "移动";
						break;
						case 2:
						echo "联通";
						break;
						
						case 3:
						echo "电信";
						break;
						}
					
					 ?></span></span><span class="fright kf">规律：<span class="red">
					 <?php  $E=$row_Recordset1['day']; 
					 switch ($E)
						{
						case 1:
						echo '普通号码';
						break;
						case 2:
						echo "尾数AA";
						break;
						
						case 3:
						echo "尾数AAA";
						break;
							
						case 4:
						echo "尾数AAAA";
						break;	
						
						case 5:
						echo "尾数ABC";
						break;	
						case 6:
						echo "尾数ABCD";
						break;	
						case 7:
						echo "尾数AAAAA";
						break;
						case 8:
						echo "尾数AABB";
						break;
						case 9:
						echo "尾数AAAAB";
						break;
						
						case 10:
						echo "尾数AAAB";
						break;
						case 11:
						echo "尾数AABA";
						break;
						
						case 12:
						echo "尾数AABB";
						break;
						
						case 13:
						echo "尾数ABBA";
						break;
						
						case 14:
						echo "尾数ABCDE";
						break;
						
						case 15:
						echo "尾数AAABB";
						break;
						
						case 16:
						echo "尾数AABBB";
						break;
						
						case 17:
						echo "尾数AABAA";
						break;
						
						case 18:
						echo "尾数ABCABC";
						break;
						
						case 19:
						echo "尾数AAABBB";
						break;
						case 20:
						echo "尾数AABBC";
						break;
						
						case 21:
						echo "尾数ABBABB";
						break;
						
						case 22:
						echo "尾数AAAAA＋";
						break;
						
						case 23:
						echo "尾数ABCDE+";
						break;
						
						case 24:
						echo "尾数ABCABCD";
						break;
						
						case 25:
						echo "尾数ABCDABCD";
						break;
						
						case 26:
						echo "中间AAA";
						break;
						
						case 27:
						echo "中间AAAA";
						break;
						
						case 28:
						echo "中间AABB";
						break;
						case 29:
						echo "中间AAABB";
						break;
						
						case 30:
						echo "中间AABBB";
						break;
						
						case 31:
						echo "中间AAAA+";
						break;
						
						case 32:
						echo "中间AAABBB";
						break;
						
						case 33:
						echo "中间AABBCC";
						break;
						
						case 34:
						echo "人气号";
						break;
						
						case 35:
						echo "情侣号";
						break;
						
						case 36:
						echo "风水号";
						break;
						
						
						}
					 
					 ?></span></span> </div>
                <div class="clearfix"></div>
                <span class="yuyi">号码备注：<?php echo $row_Recordset1['message']; ?></span> </div>
              </div>
          </li>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        
        
        <div class="clear"></div>
      </ul>
    </div>
    <div id="pageGro" class="cb">
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
    </div>
  </div>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
  <div class="dp_newpage">
    <div class="dp_hmlb">
      <div class="dp_hmlsm fleft"> <span class="kd1">手机靓号</span> <span class="kd2">售价</span> <span class="kd3">含费</span> <span class="kd4">操作</span> </div>
      <div class="dp_hmlsm fright"> <span class="kd1">手机靓号</span> <span class="kd2">售价</span> <span class="kd3">含费</span> <span class="kd4">操作</span> </div>
      <div class="clearfix"></div>
      <ul>
        <div class="nonumber">很抱歉，没有符合您要求的号码！
          </div>
        <div class="clear"></div>
        </ul>
      </div>
    
  </div>
  <?php } // Show if recordset empty ?>
  
  
  

  
  
  
  
  
  
  
  
  
  
  
  </div>
  
<!--手机号码详情结束--> 
  <!--店铺介绍-->
  <div class="box_fleft fl">
    <div class="chuchuang m15">
      <div class="bt"><i></i><span>购号流程</span></div>
      <img src="./index_files/liucheng.jpg" width="100%"> </div>
    <div class="chuchuang m15">
      <div class="bt"><i></i><span>猜你喜欢</span></div>
      <div class="tj_hm">
        <ul>
          <?php do { ?>
            <li><a href="filter_xy.php?id=<?php echo $row_Recordset2['id']; ?>&pid=<?php echo $row_Recordset2['pid']; ?>&tel=<?php echo $row_Recordset2['tel']; ?>"><span class="tj01"><?php error_reporting(E_ALL & ~E_NOTICE); 
				 $j_red01=$row_Recordset2['info_top']; 
				 switch ($j_red01)
						{
						case 0:
						echo $row_Recordset2['sj_hao'];
						break;
						case 1:
						echo substr($row_Recordset2['sj_hao'],0,8);
						break;
				        case 2:
						echo substr($row_Recordset2['sj_hao'],0,7);
						break;
						case 3:
						echo substr($row_Recordset2['sj_hao'],0,6);
						break;
				          } ?><span class="yellow"><?php 
						  // $j_red01=$row_Recordset1['sj_hao']; 
						  
						  switch ($j_red01)
						{
						case 0:
						echo "";
						break;
						case 1:
						echo substr($row_Recordset2['sj_hao'],8,3);
						break;
				        case 2:
						echo substr($row_Recordset2['sj_hao'],7,4);
						break;
						 case 3:
						echo substr($row_Recordset2['sj_hao'],6,5);
						break;
				          } ?></span></span><span class="tj02"><?php $E=$row_Recordset2['day']; 
						  switch ($E)
						{
						case 1:
						echo '普通号码';
						break;
						case 2:
						echo "尾数AA";
						break;
						
						case 3:
						echo "尾数AAA";
						break;
							
						case 4:
						echo "尾数AAAA";
						break;	
						
						case 5:
						echo "尾数ABC";
						break;	
						case 6:
						echo "尾数ABCD";
						break;	
						case 7:
						echo "尾数AAAAA";
						break;
						case 8:
						echo "尾数AABB";
						break;
						case 9:
						echo "尾数AAAAB";
						break;
						
						case 10:
						echo "尾数AAAB";
						break;
						case 11:
						echo "尾数AABA";
						break;
						
						case 12:
						echo "尾数AABB";
						break;
						
						case 13:
						echo "尾数ABBA";
						break;
						
						case 14:
						echo "尾数ABCDE";
						break;
						
						case 15:
						echo "尾数AAABB";
						break;
						
						case 16:
						echo "尾数AABBB";
						break;
						
						case 17:
						echo "尾数AABAA";
						break;
						
						case 18:
						echo "尾数ABCABC";
						break;
						
						case 19:
						echo "尾数AAABBB";
						break;
						case 20:
						echo "尾数AABBC";
						break;
						
						case 21:
						echo "尾数ABBABB";
						break;
						
						case 22:
						echo "尾数AAAAA＋";
						break;
						
						case 23:
						echo "尾数ABCDE+";
						break;
						
						case 24:
						echo "尾数ABCABCD";
						break;
						
						case 25:
						echo "尾数ABCDABCD";
						break;
						
						case 26:
						echo "中间AAA";
						break;
						
						case 27:
						echo "中间AAAA";
						break;
						
						case 28:
						echo "中间AABB";
						break;
						case 29:
						echo "中间AAABB";
						break;
						
						case 30:
						echo "中间AABBB";
						break;
						
						case 31:
						echo "中间AAAA+";
						break;
						
						case 32:
						echo "中间AAABBB";
						break;
						
						case 33:
						echo "中间AABBCC";
						break;
						
						case 34:
						echo "人气号";
						break;
						
						case 35:
						echo "情侣号";
						break;
						
						case 36:
						echo "风水号";
						break;
						
						
						}
						  
						  ?></span><span class="tj03">￥<?php echo $row_Recordset2['s_price']; ?></span></a></li>
            <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
          
          
          
        </ul>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>
<form id="searchcondition">
  <input type="hidden" name="key" value="">
  <input type="hidden" name="tail" value="0">
  <input type="hidden" name="manager" value="0">
  <input type="hidden" name="head" value="0">
  <input type="hidden" name="pricescope" value="-1">
  <input type="hidden" name="grade" value="-1">
  <input type="hidden" name="four" value="0">
  <input type="hidden" name="love" value="0">
  <input type="hidden" name="month" value="0">
  <input type="hidden" name="p1" value="">
  <input type="hidden" name="p2" value="">
  <input type="hidden" name="p3" value="">
  <input type="hidden" name="p4" value="">
  <input type="hidden" name="p5" value="">
  <input type="hidden" name="p6" value="">
  <input type="hidden" name="p7" value="">
  <input type="hidden" name="p8" value="">
  <input type="hidden" name="p9" value="">
  <input type="hidden" name="p10" value="">
</form>
<script type="text/javascript">
if((typeof(bidding_second) != "undefined")) {
	document.write(bidding_second);
}
</script>
<?php include ("footer.php")?>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
