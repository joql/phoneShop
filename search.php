<?php require_once('Connections/connch21.php'); ?>
<?php ?>
<?php 
header("Content-type: text/html; charset=utf-8");

$m1=$_GET['m1'];
//echo $m1."<br>";
$m2=$_GET['m2'];
//echo $m2."<br>";

$m3=$_GET['m3'];
//echo $m3."<br>";

$bigtype=$_GET['bigtype'];
//echo $bigtype."<br>";
$smalltype=$_GET['smalltype'];

//echo $smalltype."<br>";

$key=$_GET['key'];

//if($_GET['key']=="0"){$key="0";}else{$key=$_GET['key'];}

//echo $key."<br>";

$grade=$_GET['grade'];

//echo $grade."<br>";

$price=$_GET['price'];
//echo $price."<br>";

$number=$_GET['number'];

//echo $day."<br>";

//$pid="1";
//$tel=2;
//$theme=3;
//$price=4;
//$day=5;
//$key=$_GET['key'];
//$tai=$_GET['tai'];
if($_GET['tj']){if(empty($m1)&&empty($m2)&&empty($m3)){echo "<script language='javascript'>alert('必须要选择一个搜索类型的栏目（即无线、有线或商务一号通）!');location.href='search.php';</script>";
} 
}


$link='';

if(!empty($m1)){
$link = "m1 = '$m1' ";
}

if(empty($m1)&&!empty($m2)&&empty($m3)&&empty($bigtype)&&empty($smalltype)&&empty($key)&&empty($grade)&&empty($price)){
$link = "m2 = '$m2'";
} 


if(empty($m1)&&empty($m2)&&!empty($m3)&&empty($bigtype)&&empty($smalltype)&&empty($key)&&empty($grade)&&empty($price)){
$link = "m3 = '$m3'";
} 


if(empty($m1)&&empty($m2)&&empty($m3)&&!empty($bigtype)&&empty($smalltype)&&empty($key)&&empty($grade)&&empty($price)){
$link = "bigtype = '$bigtype'";
} 


if(empty($m1)&&empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&empty($grade)&&empty($price)){
$link = " bigtype = '$bigtype' and smalltype = '$smalltype'";
} 



if(empty($m1)&&empty($m2)&&empty($m3)&&empty($bigtype)&&empty($smalltype)&&!empty($key)&&empty($grade)&&empty($price)){
$link = "gh_hao like '%$key%'";
} 


if(empty($m1)&&empty($m2)&&empty($m3)&&empty($bigtype)&&empty($smalltype)&&empty($key)&&!empty($grade)&&empty($price)){
$link = "grade = '$grade'";
}

if(empty($m1)&&empty($m2)&&empty($m3)&&empty($bigtype)&&empty($smalltype)&&empty($key)&&empty($grade)&&!empty($price)){
$link = "price = '$price'";
}

//gh组合选项1

if(!empty($m1)&&!empty($m2)&&empty($m3)&&empty($bigtype)&&empty($smalltype)&&empty($key)&&empty($grade)&&empty($price)){
$link = $link."and m2 = '$m2'";
}

if(!empty($m1)&&!empty($m2)&&!empty($m3)&&empty($bigtype)&&empty($smalltype)&&empty($key)&&empty($grade)&&empty($price)){
$link = $link."and m2 = '$m2' and m3 = '$m3'";
}

if(!empty($m1)&&empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&empty($price)){
$link = $link."and bigtype = '$bigtype' and smalltype = '$smalltype' and grade = '$grade' ";
}

if(empty($m1)&&!empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&empty($price)){
$link = " m2 = '$m2' and bigtype = '$bigtype' and smalltype = '$smalltype' and grade = '$grade' ";
}

if(empty($m1)&&empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&empty($price)){
$link = " m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype' and grade = '$grade' ";
}



if(!empty($m1)&&!empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&empty($price)){
$link = $link."and m2 = '$m2'  and bigtype = '$bigtype' and smalltype = '$smalltype' and grade = '$grade' ";
}

if(!empty($m1)&&!empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&empty($price)){
$link = $link."and m2 = '$m2' and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype' and grade = '$grade' ";
}

if(!empty($m1)&&empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&empty($price)){
$link = $link." and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype' and grade = '$grade' ";
}

if(empty($m1)&&!empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&empty($price)){
$link = " m2 = '$m2' and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype' and grade = '$grade' ";
}




if(!empty($m1)&&empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&empty($price)){
$link = $link." and bigtype = '$bigtype' and smalltype = '$smalltype'  and gh_hao like '%$key%' and grade = '$grade' ";
}

if(empty($m1)&&!empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&empty($price)){
$link = " m2 = '$m2' and bigtype = '$bigtype' and smalltype = '$smalltype'  and gh_hao like '%$key%' and grade = '$grade' ";
}

if(empty($m1)&&empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&empty($price)){
$link = " m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype'  and gh_hao like '%$key%' and grade = '$grade' ";
}


if(!empty($m1)&&!empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&empty($price)){
$link = $link."and m2 = '$m2'  and bigtype = '$bigtype' and smalltype = '$smalltype'  and gh_hao like '%$key%' and grade = '$grade' ";
}


if(!empty($m1)&&!empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&empty($price)){
$link = $link."and m2 = '$m2' and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype'  and gh_hao like '%$key%' and grade = '$grade' ";
}

if(!empty($m1)&&empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&empty($price)){
$link = $link." and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype'  and gh_hao like '%$key%' and grade = '$grade' ";
}
if(empty($m1)&&!empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&empty($price)){
$link = "m2 = '$m2' and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype'  and gh_hao like '%$key%' and grade = '$grade' ";
}

if(!empty($m1)&&empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&!empty($price)){
$link = $link." and bigtype = '$bigtype' and smalltype = '$smalltype'   and grade = '$grade' and price = '$price'";
}

if(empty($m1)&&!empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&!empty($price)){
$link = " m2 = '$m2' and bigtype = '$bigtype' and smalltype = '$smalltype'   and grade = '$grade' and price = '$price'";
}

if(empty($m1)&&empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&!empty($price)){
$link = " m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype'   and grade = '$grade' and price = '$price'";
}

if(!empty($m1)&&!empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&!empty($price)){
$link = $link."and m2 = '$m2'  and bigtype = '$bigtype' and smalltype = '$smalltype'   and grade = '$grade' and price = '$price'";
}
if(!empty($m1)&&!empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&!empty($price)){
$link = $link."and m2 = '$m2' and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype'   and grade = '$grade' and price = '$price'";
}

if(!empty($m1)&&empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&!empty($price)){
$link = $link." and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype'   and grade = '$grade' and price = '$price'";
}


if(empty($m1)&&!empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&empty($key)&&!empty($grade)&&!empty($price)){
$link = " m2 = '$m2' and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype'   and grade = '$grade' and price = '$price'";
}


if(!empty($m1)&&empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&!empty($price)){
$link = $link."  and bigtype = '$bigtype' and smalltype = '$smalltype' and gh_hao like '%$key%'  and grade = '$grade' and price = '$price'";
}

if(empty($m1)&&!empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&!empty($price)){
$link = " m2 = '$m2' and bigtype = '$bigtype' and smalltype = '$smalltype' and gh_hao like '%$key%'  and grade = '$grade' and price = '$price'";
}

if(empty($m1)&&empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&!empty($price)){
$link = " m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype' and gh_hao like '%$key%'  and grade = '$grade' and price = '$price'";
}



if(!empty($m1)&&!empty($m2)&&empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&!empty($price)){
$link = $link."and m2 = '$m2'  and bigtype = '$bigtype' and smalltype = '$smalltype' and gh_hao like '%$key%'  and grade = '$grade' and price = '$price'";
}

if(!empty($m1)&&!empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&!empty($price)){
$link = $link."and m2 = '$m2' and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype' and gh_hao like '%$key%'  and grade = '$grade' and price = '$price'";
}

if(!empty($m1)&&empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&!empty($price)){
$link = $link." and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype' and gh_hao like '%$key%'  and grade = '$grade' and price = '$price'";
}

if(empty($m1)&&!empty($m2)&&!empty($m3)&&!empty($bigtype)&&!empty($smalltype)&&!empty($key)&&!empty($grade)&&!empty($price)){
$link = " m2 = '$m2' and m3 = '$m3' and bigtype = '$bigtype' and smalltype = '$smalltype' and gh_hao like '%$key%'  and grade = '$grade' and price = '$price'";
}


//这块是精典所有等于0的都加这个and条件。如果等于0上面条件!empty($key)就是没有了，就会换成上条条件中empty($key)为空查询。就是假不会输出这个变量，所以如果等于0为了显示查询出==0的$ket还有最好在加一个这个变量。
if($key=="0"){$link=$link."and gh_hao like '%$key%'";}

//echo $link;





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



if($link){//如果$link为真，执行
	
	$maxRows_Recordset1 = 5;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM kuhua where $link ORDER BY id DESC";
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


$maxRows_Rec_ghnews = 15;
$pageNum_Rec_ghnews = 0;
if (isset($_GET['pageNum_Rec_ghnews'])) {
  $pageNum_Rec_ghnews = $_GET['pageNum_Rec_ghnews'];
}
$startRow_Rec_ghnews = $pageNum_Rec_ghnews * $maxRows_Rec_ghnews;

mysql_select_db($database_connch21, $connch21);
$query_Rec_ghnews = "SELECT * FROM news WHERE bigtype = '3' and smalltype='固话资讯' ORDER BY news_id DESC";
$query_limit_Rec_ghnews = sprintf("%s LIMIT %d, %d", $query_Rec_ghnews, $startRow_Rec_ghnews, $maxRows_Rec_ghnews);
$Rec_ghnews = mysql_query($query_limit_Rec_ghnews, $connch21) or die(mysql_error());
$row_Rec_ghnews = mysql_fetch_assoc($Rec_ghnews);

if (isset($_GET['totalRows_Rec_ghnews'])) {
  $totalRows_Rec_ghnews = $_GET['totalRows_Rec_ghnews'];
} else {
  $all_Rec_ghnews = mysql_query($query_Rec_ghnews);
  $totalRows_Rec_ghnews = mysql_num_rows($all_Rec_ghnews);
}
$totalPages_Rec_ghnews = ceil($totalRows_Rec_ghnews/$maxRows_Rec_ghnews)-1;

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

mysql_select_db($database_connch21, $connch21);
$query_Rec_ghsoso = "SELECT * FROM guanggao WHERE title = '副页固定电话高级搜索页广告'";
$Rec_ghsoso = mysql_query($query_Rec_ghsoso, $connch21) or die(mysql_error());
$row_Rec_ghsoso = mysql_fetch_assoc($Rec_ghsoso);
$totalRows_Rec_ghsoso = mysql_num_rows($Rec_ghsoso);



mysql_select_db($database_connch21, $connch21);
$query_Rec_jilu = "SELECT count(*) FROM kuhua";
$Rec_jilu = mysql_query($query_Rec_jilu, $connch21) or die(mysql_error());
$row_Rec_jilu = mysql_fetch_assoc($Rec_jilu);
$totalRows_Rec_jilu = mysql_num_rows($Rec_jilu);


$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);

	
	}
	
	
	else{//否则$link 不为真执行
$maxRows_Recordset1 = 5;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM kuhua  ORDER BY id DESC";
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

$maxRows_Rec_ghnews = 15;
$pageNum_Rec_ghnews = 0;
if (isset($_GET['pageNum_Rec_ghnews'])) {
  $pageNum_Rec_ghnews = $_GET['pageNum_Rec_ghnews'];
}
$startRow_Rec_ghnews = $pageNum_Rec_ghnews * $maxRows_Rec_ghnews;

mysql_select_db($database_connch21, $connch21);
$query_Rec_ghnews = "SELECT * FROM news WHERE bigtype = '3' and smalltype='固话资讯' ORDER BY news_id DESC";
$query_limit_Rec_ghnews = sprintf("%s LIMIT %d, %d", $query_Rec_ghnews, $startRow_Rec_ghnews, $maxRows_Rec_ghnews);
$Rec_ghnews = mysql_query($query_limit_Rec_ghnews, $connch21) or die(mysql_error());
$row_Rec_ghnews = mysql_fetch_assoc($Rec_ghnews);

if (isset($_GET['totalRows_Rec_ghnews'])) {
  $totalRows_Rec_ghnews = $_GET['totalRows_Rec_ghnews'];
} else {
  $all_Rec_ghnews = mysql_query($query_Rec_ghnews);
  $totalRows_Rec_ghnews = mysql_num_rows($all_Rec_ghnews);
}
$totalPages_Rec_ghnews = ceil($totalRows_Rec_ghnews/$maxRows_Rec_ghnews)-1;

mysql_select_db($database_connch21, $connch21);
$query_Rec_ghsoso = "SELECT * FROM guanggao WHERE title = '副页固定电话高级搜索页广告'";
$Rec_ghsoso = mysql_query($query_Rec_ghsoso, $connch21) or die(mysql_error());
$row_Rec_ghsoso = mysql_fetch_assoc($Rec_ghsoso);
$totalRows_Rec_ghsoso = mysql_num_rows($Rec_ghsoso);

mysql_select_db($database_connch21, $connch21);
$query_Rec_jilu = "SELECT count(*) FROM kuhua";
$Rec_jilu = mysql_query($query_Rec_jilu, $connch21) or die(mysql_error());
$row_Rec_jilu = mysql_fetch_assoc($Rec_jilu);
$totalRows_Rec_jilu = mysql_num_rows($Rec_jilu);

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
}?>
<?php ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<?php include("keyword.php");?>
	
	<meta name="robots" content="All">
	<meta name="verify-v1" content="casZho9kECUkOAU+2uY1SGpjeqJiwu0o/ALrzgPNKFo=">
	<meta name="AizhanSEO" content="a2511a4d1a6a1b0fe57f5ce001438cc9">
	<meta http-equiv="Content-Language" content="zh_CN">
	<meta name="author" content="lezhizhe.net">
	<meta name="copyright" content="jihaoba.com">
	
	<link href="./index_files/public.css" rel="stylesheet" type="text/css">

<meta name="mobile-agent" content="format=html5;url=http://m.jihaoba.com/dianhua/search.htm">
	<link href="./index_files/telephone.css" rel="stylesheet" type="text/css">
<!--检查表单不能为空的调用JS 而且有此多条件的修改单选big and smalltype才工作-->
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
		     <input name="m1" type="checkbox" class="wenbenksty dan_active" value="-1" checked="checked">
			 <label>无线</label>
			 <input name="m2" type="checkbox" class="wenbenksty dan_active" value="1" checked="checked">
			 <label>有线</label>
			 <input name="m3" type="checkbox" class="wenbenksty dan_active" value="2" checked="checked">
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
      	<div class="dh_dhsl"><span><!--150,--><?php echo $row_Rec_jilu['count(*)']; ?></span>个固定电话正在本站出售</div>
        <a href="javascript:;" target="_blank">欢迎选号</a>
      </div>
      <div class="clear"></div>
    </div>
	 <!--小图广告-->
	<div class="main">
		<div class="adq"> 
						<a href="#" target="_blank"><img src="images/<?php echo $row_Rec_ghsoso['gg_photo1']; ?>" width="293" height="105"></a> 
				<a href="#" target="_blank"><img src="images/<?php echo $row_Rec_ghsoso['gg_photo2']; ?>" width="293" height="105"></a> 
				<a href="#" target="_blank"><img src="images/<?php echo $row_Rec_ghsoso['gg_photo3']; ?>" width="293" height="105"></a> 
				<a href="#" target="_blank"><img src="images/<?php echo $row_Rec_ghsoso['gg_photo4']; ?>" width="293" height="105"></a> 
				
	  </div>
		 <div class="clear"></div>
	</div>
	<!--广告结束-->
    <div class="dh_p2">
    <div class="dh_listl fleft">
    
    <div class="list">
    <div class="sort">
      <ul class="fleft">
        <li class="arrow"><a href="#">按默认</a></li>
       <!-- <li><a href="#/dianhua/search.htm?stype=&m1=0&m2=1&m3=2&grade=-1&province=-1&city=-1&price=-1&key=&s=date">按最新</a></li>
        <li>
			<a href="#/dianhua/search.htm?stype=&m1=0&m2=1&m3=2&grade=-1&province=-1&city=-1&price=-1&key=&s=lowprice">按价格
			<i></i>
			<s></s>
			</a>
		</li>-->
      </ul>
      <!--<div class="fl listsc"><a href="#/dianhua/search.htm?favorite=1&rand=0.5397364485543221">收藏（<span class="red favoritedianhua">0</span>）个</a></div>-->
      
    </div>
    <div class="label">
      <ul class="sj_sslist">
        <li class="moral2">区号</li>
        <li class="number2">固定电话</li>
        <li class="cost2">价格</li>
        <li class="brand2">类型</li>
        <li class="price2">归属地</li>
        <li class="law">号码规律</li>
        <li class="package2">特殊字符</li>
        <li class="operation2">操作</li>
      </ul>
    </div>
    <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
  <?php do { ?>
    <div class="numbershow">
      <ul>
        <li class="moral2"><span class="yellow"><?php echo substr($row_Recordset1['gh_hao'],0,4); ?></span></li>
        <li class="number2 hmzt"><a href="gh_xy.php?id=<?php echo $row_Recordset1['id']; ?>" target="_blank"><span class="searchresultkey"><?php if(substr($row_Recordset1['gh_hao'],4,8)==""){echo "号码不全";}else{echo substr($row_Recordset1['gh_hao'],4,8);} ?></span></a></li>
        <li class="cost2"><span class="red">￥<?php echo $row_Recordset1['s_price']; ?><!--未知--></span></li>
        <li class="brand2"><?php if($row_Recordset1['m1']=="-1"){echo "无线"; }?>|<?php if($row_Recordset1['m2']=="1"){echo "有线"; }?>|<?php if($row_Recordset1['m3']=="2"){echo "商务一号通"; }?></li>
        <li class="price2"><?php echo $row_Recordset1['smalltype']; ?></li>
        <li class="law">
          <?php $E=$row_Recordset1['grade'];
			       switch ($E)
						{
							case -1:
						echo '无规律';
						break;
						
						case 1:
						echo '尾数AAA';
						break;
						case 2:
						echo "尾数ABC";
						break;
						
						case 3:
						echo "尾数AABB";
						break;
							
						case 4:
						echo "尾数ABAB";
						break;	
						
						case 5:
						echo "尾数ABBA";
						break;	
						case 6:
						echo "尾数ABCD+";
						break;	
						case 7:
						echo "尾数AABBCC";
						break;
						case 8:
						echo "尾数ABCABC";
						break;
						case 9:
						echo "尾数AAABB";
						break;
						
						case 10:
						echo "尾数AAAA+";
						break;
						case 11:
						echo "中间AAA";
						break;
						
						case 12:
						echo "中间AABB";
						break;
						
						case 13:
						echo "中间AAAA+";
						break;
						
						case 14:
						echo "中间AAABB";
						break;
						
						case 15:
						echo "中间AABBB";
						break;
						
						case 16:
						echo "中间AAABBB";
						break;
						
						case 17:
						echo "中间AABBCC";
						break;
						
						case 18:
						echo "中间ABCABC";
						break;}
			  
			   ?></li>
        <li class="package2">
          <?php /*start db_input script*/ if ($row_Recordset1['tszf'] != ""){ ?>
          <?php echo $row_Recordset1['tszf']; ?>
          <?php } /*end db_input script*/ else{?>未知<?php }?>
        </li>
        <li class="operation2">
          <a class="collect fleft addFavorite" key="1210708" type="dianhua" style="cursor:pointer;">收藏</a><a class="reserve fright" href="foot_news.php?news_id=7" target="_blank">预订</a>
        </li>
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
      <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
  <div class="nonumber">很抱歉，没有符合您要求的号码！
    <!--您可以选择：<br><a href="#">1、点此立即私人订制</a><br><a href="/search.php">2、点此返回重新选号</a>--></div>
  <?php } // Show if recordset empty ?>
    </div>
    	<div class="clear"></div>
    </div>
    <div class="dh_listr fright">
    	<!--<div class="dh_wntj">
        <span>根据您的搜索为您推荐</span>
        <ul>
							<li>
                <a href="#/dianhua/124-0317-8088888.htm" target="_blank">
                <div class="sj_sjhm"><i></i><span class="sj_zi">0317<b>-</b></span>8088888</div>
                <div class="sj_hmsm">沧州　￥<span class="red">未知</span></div>
                </a>
            </li>
		        					<li>
                <a href="#/dianhua/24115-0317-7181818.htm" target="_blank">
                <div class="sj_sjhm"><i></i><span class="sj_zi">0317<b>-</b></span>7181818</div>
                <div class="sj_hmsm">沧州　￥<span class="red">未知</span></div>
                </a>
            </li>
		        					<li>
                <a href="#/dianhua/24115-0317-7227722.htm" target="_blank">
                <div class="sj_sjhm"><i></i><span class="sj_zi">0317<b>-</b></span>7227722</div>
                <div class="sj_hmsm">沧州　￥<span class="red">2200</span></div>
                </a>
            </li>
		        					<li>
                <a href="#/dianhua/112057-023-62778778.htm" target="_blank">
                <div class="sj_sjhm"><i></i><span class="sj_zi">023<b>-</b></span>62778778</div>
                <div class="sj_hmsm">重庆　￥<span class="red">1800</span></div>
                </a>
            </li>
		        					<li>
                <a href="#/dianhua/112057-023-60602222.htm" target="_blank">
                <div class="sj_sjhm"><i></i><span class="sj_zi">023<b>-</b></span>60602222</div>
                <div class="sj_hmsm">重庆　￥<span class="red">4.30万</span></div>
                </a>
            </li>
		        					<li>
                <a href="#/dianhua/112057-023-68166666.htm" target="_blank">
                <div class="sj_sjhm"><i></i><span class="sj_zi">023<b>-</b></span>68166666</div>
                <div class="sj_hmsm">重庆　￥<span class="red">7.90万</span></div>
                </a>
            </li>
   		  </ul>
        </div>-->
      <div class="dh_ycnew">
        <div class="dh_yxwbt"><span class="fright"><!--<a href="#/news/class_25/1">更多</a>--></span>固话资讯</div>
        <ul>
					<?php do { ?>
					  <li><a href="news_xy.php?news_id=<?php echo $row_Rec_ghnews['news_id']; ?>" title="<?php echo $row_Rec_ghnews['news_title']; ?>" target="_blank"><?php echo $row_Rec_ghnews['news_title']; ?></a></li>
					  <?php } while ($row_Rec_ghnews = mysql_fetch_assoc($Rec_ghnews)); ?>
					
        </ul>
        
        <div class="clear"></div>
      </div>
      <!--<div class="dh_ycggw"><img src="./index_files/dh_ggw.jpg" width="245" height="127"></div>-->
    </div>
    <div class="clear"></div>
    </div>
	<!--小图广告-->
	<!--<div class="main">
		<div class="adq"> 
						<a href="#/u/4000" target="_blank"><img src="./index_files/582d758ac52cb.jpg" width="293" height="105"></a> 
				<a href="#/u/4000" target="_blank"><img src="./index_files/58365b52b3510.jpg" width="293" height="105"></a> 
				<a href="http://m.jihaoba.com/u/690" target="_blank"><img src="./index_files/583903d3816ff.jpg" width="293" height="105"></a> 
				<a href="#/u/4000" target="_blank"><img src="./index_files/582d757ade22b.jpg" width="293" height="105"></a> 
				
	  </div>
		 <div class="clear"></div>
	</div>-->
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

<?php include ("footer.php")?></body></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Rec_ghnews);

mysql_free_result($Rec_ghsoso);

mysql_free_result($Rec_jilu);
?>
