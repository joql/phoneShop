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

$currentPage = $_SERVER["PHP_SELF"];


 error_reporting(E_ALL & ~E_NOTICE);
$a=$_GET['a'];
#echo '$a='. $a."<br>";
$b=$_GET['b'];
//echo '$b='.$b."<br>";

$c=$_GET['c'];
//echo '$c='.$c."<br>";

$aprm=$_GET['aprm'];
//echo '$aprm=' .$aprm."<br>";

$minprice=$_GET['minprice'];
//echo '$minprice='. $minprice."<br>";

$tctype=$_GET['tctype'];
//echo '$tctype='. $tctype."<br>";

$key=$_GET['key'];
//echo '$key='.$key."<br>";
$tail=$_GET['tail'];
//echo '$tail='. $tail."<br>";

$nofour=$_GET['nofour'];
//echo '$nofour='. $nofour."<br>";



$link='';

if(!empty($a)){
$link = "a = '$a' ";
}

if(empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = "b = '$b'";
} 

if(empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = "c = '$c'";
} 

if(empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = "aprm = '$aprm'";
} 

if(empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = "minprice = '$minprice'";
}
if(empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = "tctype = '$tctype'";
}
if(empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = "sLL_hao like '%$key%'";
}

if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link =$link. " and b = '$b'";
} 

if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link =$link. " and b = '$b' and c = '$c'";
} 
if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link =$link. " and b = '$b' and c = '$c' and aprm = '$aprm'";
} 

if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link =$link. " and b = '$b' and c = '$c' and aprm = '$aprm' and minprice = '$minprice'";
} 

if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link =$link. " and b = '$b' and c = '$c' and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype'";
}
if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link =$link. " and b = '$b' and c = '$c' and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype' and sLL_hao like '%$key%'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link =$link. " and b = '$b' and c = '$c' and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' ";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link =$link. " and b = '$b' and c = '$c' and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%'  and substring(sLL_hao,-7) not like '%4%'";
}

if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and c = '$c'";
} 
if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and c = '$c' and aprm = '$aprm'";
} 

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and c = '$c' and aprm = '$aprm' and minprice = '$minprice'";
} 

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and c = '$c' and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype'";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and c = '$c' and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype'  and sLL_hao like '%$key%'";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and c = '$c' and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype'  and substring(sLL_hao,-4) like '%$key%'";
}


if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and c = '$c' and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype'  and substring(sLL_hao,-4) like '%$key%'  and substring(sLL_hao,-7) not like '%4%' ";
}


#t第三部份
if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and aprm = '$aprm'";
} 


if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and aprm = '$aprm' and minprice = '$minprice'";
}

if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype'";
}

if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype' and sLL_hao like '%$key%'";
}

if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%'";
}

if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
}


#第四部份
if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and minprice = '$minprice'";
} 

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and minprice = '$minprice' and tctype = '$tctype'";
} 

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and minprice = '$minprice' and tctype = '$tctype' and sLL_hao like '%$key%'";
}

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%'";
}

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
}
#第五部份
if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and tctype = '$tctype'";
} 

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and tctype = '$tctype' and sLL_hao like '%$key%'";
}
if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%'";
}

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
}

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link."and tctype = '$tctype'  and substring(sLL_hao,-7) not like '%4%'";
}
#第6部份
if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and sLL_hao like '%$key%'";
} 

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and substring(sLL_hao,-4) like '%$key%'";
} 

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
} 

#第7部份
if(!empty($a)&&!empty($b)&&empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and aprm = '$aprm'";
}

if(!empty($a)&&!empty($b)&&empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and aprm = '$aprm' and minprice = '$minprice'";
}

if(!empty($a)&&!empty($b)&&empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype'";
}

if(!empty($a)&&!empty($b)&&empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype' and sLL_hao like '%$key%' ";
}

if(!empty($a)&&!empty($b)&&empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' ";
}
if(!empty($a)&&!empty($b)&&empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b'  and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
}

#第8部份
if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and minprice = '$minprice'";
}
if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and minprice = '$minprice' and tctype = '$tctype'";
}
if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and minprice = '$minprice' and tctype = '$tctype' and sLL_hao like '%$key%' ";
}

if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' ";
}

if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b'  and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
}

#第9部份
if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and tctype = '$tctype'";
}
if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and tctype = '$tctype' and sLL_hao like '%$key%'";
}
if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%'";
}

if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b'  and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%' ";
}

#第9_1部份
if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b'  and sLL_hao like '%$key%'";
}
if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and substring(sLL_hao,-4) like '%$key%'";
}

if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
}

#第9_2部份
if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link."  and substring(sLL_hao,-7) not like '%4%'";
}
if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b'  and substring(sLL_hao,-7) not like '%4%'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b'  and c = '$c' and substring(sLL_hao,-7) not like '%4%'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b'  and c = '$c' and aprm = '$aprm'  and substring(sLL_hao,-7) not like '%4%'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b'  and c = '$c' and aprm = '$aprm' and minprice = '$minprice'  and substring(sLL_hao,-7) not like '%4%'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b'  and c = '$c' and aprm = '$aprm' and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-7) not like '%4%'";
}

if(!empty($a)&&!empty($b)&&empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b'  and sLL_hao like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
}


#第10部份
if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and minprice = '$minprice'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and minprice = '$minprice' and tctype = '$tctype'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and minprice = '$minprice' and tctype = '$tctype' and sLL_hao like '%$key%' ";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){

$link = $link."and b = '$b' and c = '$c' and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' ";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%' ";
}

#第11部份
if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and tctype = '$tctype'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and tctype = '$tctype' and sLL_hao like '%$key%'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
}

#第11_1部份
if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and sLL_hao like '%$key%'";
}
if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and substring(sLL_hao,-4) like '%$key%'";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b' and c = '$c' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
}


#第12部份
if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c'  and aprm = '$aprm'  and tctype = '$tctype'";
}
if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c'  and aprm = '$aprm'  and tctype = '$tctype' and sLL_hao like '%$key%' ";
}
if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c'  and aprm = '$aprm'  and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' ";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b' and c = '$c'  and aprm = '$aprm'  and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%' ";
}

#第13部份
if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c'  and aprm = '$aprm'  and minprice = '$minprice' and sLL_hao like '%$key%' ";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link."and b = '$b' and c = '$c'  and aprm = '$aprm'  and minprice = '$minprice'  and substring(sLL_hao,-4) like '%$key%' ";
}

if(!empty($a)&&!empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link."and b = '$b' and c = '$c'  and aprm = '$aprm'  and minprice = '$minprice'  and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'";
}

#第14部份
if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and minprice = '$minprice'  ";
}
if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and minprice = '$minprice' and tctype = '$tctype'  ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and minprice = '$minprice' and tctype = '$tctype' and sLL_hao like '%$key%' ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' ";
}


if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&!empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'    and minprice = '$minprice' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%' ";
}


#第15部份
if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and tctype = '$tctype'  ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and tctype = '$tctype'  and sLL_hao like '%$key%' ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and tctype = '$tctype'  and substring(sLL_hao,-4) like '%$key%' ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'    and tctype = '$tctype'  and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%' ";
}

#第16部份
if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'   and sLL_hao like '%$key%'   ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and substring(sLL_hao,-4) like '%$key%'   ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'    and substring(sLL_hao,-4) like '%$key%'  and substring(sLL_hao,-7) not like '%4%' ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'      and substring(sLL_hao,-7) not like '%4%' ";
}

#第17部份
if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and aprm = '$aprm' and tctype = '$tctype' ";
}

if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and aprm = '$aprm' and tctype = '$tctype' and sLL_hao like '%$key%' ";
}

if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link." and aprm = '$aprm' and tctype = '$tctype'  and substring(sLL_hao,-4) like '%$key%' ";
}

if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link." and aprm = '$aprm' and tctype = '$tctype'  and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%' ";
}
//$link = "a = '$a' and b = '$b' and c= '$c' and aprm= '$aprm'  and minprice= '$minprice' and tctype= '$tctype'";

#第18部份
if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and aprm = '$aprm' and sLL_hao like '%$key%' ";
}
if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link." and aprm = '$aprm' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%' ";
}

if(!empty($a)&&empty($b)&&empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link." and aprm = '$aprm'  and substring(sLL_hao,-7) not like '%4%' ";
}


#第19部份
if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and minprice = '$minprice' and sLL_hao like '%$key%' ";
}

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link." and minprice = '$minprice' and substring(sLL_hao,-4) like '%$key%' ";
}

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link." and minprice = '$minprice' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%'  ";
}

if(!empty($a)&&empty($b)&&empty($c)&&empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link." and minprice = '$minprice'  and substring(sLL_hao,-7) not like '%4%'  ";
}

#第20部份
if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and tctype = '$tctype'  ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and tctype = '$tctype' and sLL_hao like '%$key%' ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and tctype = '$tctype' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%' ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and tctype = '$tctype'  and substring(sLL_hao,-7) not like '%4%' ";
}
#第21部份 1347
if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and sLL_hao like '%$key%'  ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and substring(sLL_hao,-4) like '%$key%' ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and substring(sLL_hao,-4) like '%$key%' and substring(sLL_hao,-7) not like '%4%' ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm'  and substring(sLL_hao,-7) not like '%4%' ";
}


#第22部份 1347
if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&!empty($key)&&empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and minprice = '$minprice' and sLL_hao like '%$key%'  ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and minprice = '$minprice' and substring(sLL_hao,-4) like '%$key%'   ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&!empty($key)&&!empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and minprice = '$minprice' and substring(sLL_hao,-4) like '%$key%'  and substring(sLL_hao,-7) not like '%4%'  ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and minprice = '$minprice'   and substring(sLL_hao,-7) not like '%4%'  ";
}

if(!empty($a)&&empty($b)&&!empty($c)&&!empty($aprm)&&!empty($minprice)&&!empty($tctype)&&empty($key)&&empty($tail)&&!empty($nofour)){
$link = $link." and c = '$c'    and aprm = '$aprm' and minprice = '$minprice'  and tctype = '$tctype'  and substring(sLL_hao,-7) not like '%4%'  ";
}
//echo "\$link的值为：".$link;

 #表单搜索2

$p1=$_GET['p1'];
$p2=$_GET['p2'];
$p3=$_GET['p3'];
$p4=$_GET['p4'];
$p5=$_GET['p5'];
$p6=$_GET['p6'];
$p7=$_GET['p7'];
if(isset($_GET['tj2'])){
if($p1==null||$p2==null||$p3==null||$p4==null||$p5==null||$p6==null||$p7==null){
	echo "<script>alert(\"你的号码位数不全！请重新输入正确的位数！\");location.href='javascript:history.go(-1)';</script>";
}
$p0=400;
$p=$p0.$p1.$p2.$p3.$p4.$p5.$p6.$p7;
echo "\$p的值为：".$p;

}
 $zding=$_GET['zding'];//前页传来


if(isset($_GET['stype'])){//此为看精确搜运判断
	$maxRows_Recordset1 = 40;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sll where sLL_hao='$p' ORDER BY id DESC";
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
mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao = "SELECT * FROM guanggao WHERE title = '副页高级搜索400电话页广告'";
$Rec_ggao = mysql_query($query_Rec_ggao, $connch21) or die(mysql_error());
$row_Rec_ggao = mysql_fetch_assoc($Rec_ggao);
$totalRows_Rec_ggao = mysql_num_rows($Rec_ggao);
}

elseif(isset($_GET['zding'])){//前页传来的zding变量，如有此变量按此变量腮腺筛选
	
	$maxRows_Recordset1 = 40;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sll where zding='$zding' ORDER BY id DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao = "SELECT * FROM guanggao WHERE title = '副页高级搜索400电话页广告'";
$Rec_ggao = mysql_query($query_Rec_ggao, $connch21) or die(mysql_error());
$row_Rec_ggao = mysql_fetch_assoc($Rec_ggao);
$totalRows_Rec_ggao = mysql_num_rows($Rec_ggao);
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



else{//如无精确搜索执行
if($link==false){
	
	$maxRows_Recordset1 = 40;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sll  ORDER BY id DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $connch21) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao = "SELECT * FROM guanggao WHERE title = '副页高级搜索400电话页广告'";
$Rec_ggao = mysql_query($query_Rec_ggao, $connch21) or die(mysql_error());
$row_Rec_ggao = mysql_fetch_assoc($Rec_ggao);
$totalRows_Rec_ggao = mysql_num_rows($Rec_ggao);
if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
}
	else{
$maxRows_Recordset1 = 40;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connch21, $connch21);
$query_Recordset1 = "SELECT * FROM sll where $link ORDER BY id DESC";
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

mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao = "SELECT * FROM guanggao WHERE title = '副页高级搜索400电话页广告'";
$Rec_ggao = mysql_query($query_Rec_ggao, $connch21) or die(mysql_error());
$row_Rec_ggao = mysql_fetch_assoc($Rec_ggao);
$totalRows_Rec_ggao = mysql_num_rows($Rec_ggao);

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

}
?>




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">

<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>

<META name=applicable-device content=pc>
<?php include("keyword.php");?>
<META name=robots content=All>
<META name=verify-v1 content=casZho9kECUkOAU+2uY1SGpjeqJiwu0o/ALrzgPNKFo=>
<META name=AizhanSEO content=a2511a4d1a6a1b0fe57f5ce001438cc9>
<META content=zh_CN http-equiv=Content-Language>
<META name=author content=lezhizhe.net>
<META name=copyright content=#.com><LINK rel="shortcut icon" 
type=image/x-icon href="/favicon.ico"><LINK rel=stylesheet type=text/css 
href="index_files/public.css">
<META name=mobile-agent content=format=html5;url=http://m.#.com/400/><LINK 
rel=stylesheet type=text/css href="index_files/400.css">
<META name=GENERATOR content="MSHTML 8.00.7601.18365">

<!--检查表单不能为空的调用JS 而且有此多条件的修改单选big and smalltype才工作-->
<script type="text/javascript" src="admin/js/jquery-1.7.2.min.js"></script>
<!--检查表单不能为空的调用JS结束-->


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
	  
	    if ($("[tname=bigtype]").val()=="0") {
            alert('请选择一个号段!');
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






</HEAD>
<BODY>
<?php include("nav.php");?>
<DIV id=bj></DIV>
<DIV class=main>
<DIV class=sj_sou>
<DIV class=sj_so>
<FORM id=foursearch method=get action="400_soso.php" name="myform">
<DIV class="sj_mhss fleft">
<P><LABEL class=ms_label>号段：</LABEL> <SELECT name=a id="a" tname="bigtype"> <OPTION selected 
  value=0>不限号段</OPTION> <OPTGROUP label=移动> <OPTION value=4007>4007</OPTION> 
    <OPTION value=4001>4001</OPTION> </OPTGROUP> <OPTGROUP label=联通> <OPTION 
    value=4000>4000</OPTION> <OPTION value=4006>4006</OPTION> </OPTGROUP> 
  <OPTGROUP label=电信> <OPTION value=4008>4008</OPTION> <OPTION 
    value=4009>4009</OPTION> </OPTGROUP></SELECT> </P>
<P><LABEL class=ms_label>价格范围：</LABEL> <SELECT name=b id="b"> <OPTION 
  selected value=0>不限价格</OPTION> <OPTION value=-1>价格面议</OPTION> <OPTION 
  value=1>800元以下</OPTION> <OPTION value=2>800-1500元</OPTION> <OPTION 
  value=3>1500-3000元</OPTION> <OPTION value=4>3000-5000元</OPTION> <OPTION 
  value=5>5000-9000元</OPTION> <OPTION value=6>9000-8万元</OPTION> <OPTION 
  value=7>8万元以上</OPTION></SELECT> </P>
<P><LABEL class=ms_label>号码规律：</LABEL> <SELECT name=c id="c"> <OPTION selected 
  value=0>不限规律</OPTION> <OPTION value=1>普通号码</OPTION> <OPTION 
  value=19>尾数AAA</OPTION> <OPTION value=20>尾数ABC</OPTION> <OPTION 
  value=14>尾数AAAA</OPTION> <OPTION value=13>尾数ABCD</OPTION> <OPTION 
  value=17>尾数AAAB</OPTION> <OPTION value=15>尾数AABB</OPTION> <OPTION 
  value=18>尾数ABAB</OPTION> <OPTION value=16>尾数ABBA</OPTION> <OPTION 
  value=12>尾数AAAAA</OPTION> <OPTION value=11>尾数ABCDE</OPTION> <OPTION 
  value=9>尾数AAABB</OPTION> <OPTION value=8>尾数AABAA</OPTION> <OPTION 
  value=10>尾数AABBB</OPTION> <OPTION value=6>尾数ABCABC</OPTION> <OPTION 
  value=5>尾数AABBCC</OPTION> <OPTION value=4>尾数AAABBB</OPTION> <OPTION 
  value=7>尾数ABBABB</OPTION> <OPTION value=3>尾数AAAAA+</OPTION> <OPTION 
  value=2>尾数ABCDE+</OPTION> <OPTION value=27>中间AAA</OPTION> <OPTION 
  value=25>中间AAAA</OPTION> <OPTION value=26>中间AABB</OPTION> <OPTION 
  value=24>中间AAABB</OPTION> <OPTION value=23>中间AABBB</OPTION> <OPTION 
  value=22>中间AAAA+</OPTION> <OPTION value=28>中间AABBCC</OPTION> <OPTION 
  value=21>中间AAABBB</OPTION></SELECT> </P></DIV>
<DIV class="sj_mhss fright">
<P><LABEL class=ms_label for=letter>资费：</LABEL> <INPUT value=0 CHECKED 
type=radio name=aprm> 不限 <INPUT value=10 type=radio name=aprm> 低于0.1元/分钟 <INPUT 
value=20 type=radio name=aprm> 0.1-0.2元/分钟 <INPUT value=30 type=radio name=aprm> 
0.2-0.3元/分钟 </P>
<P><LABEL class=ms_label for=letter>套餐：</LABEL> <SELECT name=minprice> <OPTION 
  selected value=0>不限</OPTION> <OPTION value=0-1000 selected?>1000元以下</OPTION> 
  <OPTION value=1000-4000>1000-4000元</OPTION> <OPTION 
  value=4000-8000>4000-8000元</OPTION> <OPTION value=8000-90000>8000-9万</OPTION> 
  <OPTION value=90000-1000000>9万以上</OPTION></SELECT> </LABEL><INPUT value=0 
CHECKED type=radio name=tctype> 不限 <INPUT value=1 type=radio name=tctype> 年套餐 
<INPUT value=2 type=radio name=tctype> 月套餐 </P>
<P><SPAN class="sj_cleaer fr"><A title=清除所有条件 
 
href="400.php">清除所有条件 </A></SPAN><LABEL class=ms_label 
for=type>数字过滤：</LABEL> <INPUT id=letter class="wenbenksty " value=1 
type=checkbox name=nofour> <LABEL for=letter>不显示带4号码</LABEL> </P></DIV></DIV>
<DIV class=sj_ss>
<DIV class="sj_mh sj_zxz">
<DIV><LABEL class=ms_label>包含数字：</LABEL> <INPUT class=keyserbtnsty maxLength=10 
type=text name=key>&nbsp; <INPUT class="wenbenksty " value=1 type=checkbox 
name=tail> <LABEL class=padl6>尾数</LABEL>&nbsp; <INPUT class=serbtnyshi value=搜索 type=submit name=submit1 onClick="javascript:return check();"> </DIV></DIV>

</FORM>
<form action="400_soso.php" method="get">
<DIV id=dwss class="sj_mh sj_yxz">
<DIV><INPUT id=stype type=hidden name=stype> <LABEL 
class=ms_labeltho>定位搜索：</LABEL> <INPUT class="keyserbtshort fourkey" value=4 
readOnly maxLength=1 type=text> <INPUT class="keyserbtshort fourkey" value=0 
readOnly maxLength=1 type=text> <INPUT class="keyserbtshort fourkey" value=0 
readOnly maxLength=1 type=text> - <INPUT class="keyserbtshort fourkey" 
maxLength=1 type=text name=p1> <INPUT class="keyserbtshort fourkey" maxLength=1 
type=text name=p2> <INPUT class="keyserbtshort fourkey" maxLength=1 type=text 
name=p3> <INPUT class="keyserbtshort fourkey" maxLength=1 type=text name=p4> - 
<INPUT class="keyserbtshort fourkey" maxLength=1 type=text name=p5> <INPUT 
class="keyserbtshort fourkey" maxLength=1 type=text name=p6> <INPUT 
class="keyserbtshort fourkey" maxLength=1 type=text name=p7> <INPUT name=tj2 type=submit class=serbtnyshi id="tj2" value=搜索> </DIV></DIV>
<DIV class=clear></DIV></DIV></form>

</DIV>
<DIV class="main mb20">
<DIV class=adq><A href="#" target=_blank><IMG 
src="images/<?php echo $row_Rec_ggao['gg_photo1']; ?>" width=293 height=105></A> <A 
href="#" target=_blank><IMG 
src="images/<?php echo $row_Rec_ggao['gg_photo2']; ?>" width=293 height=105></A> <A 
href="#" target=_blank><IMG 
src="images/<?php echo $row_Rec_ggao['gg_photo3']; ?>" width=293 height=105></A> <A 
href="#" target=_blank><IMG 
src="images/<?php echo $row_Rec_ggao['gg_photo4']; ?>" width=293 height=105></A> </DIV>
<DIV class=clear></DIV></DIV>
<DIV class=list>
<DIV class=sort>
<UL class=fleft>
  <LI class="foursort " name="indextj"><A href="javascript:void(0);">按默认</A> 
  </LI>
  <!--<LI class="foursort " name="date"><A href="javascript:void(0);">按最新</A> </LI>
  <LI class="foursort arrow" name="topprice"><A href="javascript:void(0);">按价格 
  <I class=active></I><S></S></A></LI>--></UL>
<!--<DIV class="fl listsc"><A 
href="http://www.#.com/400/search.htm?favorite=1">收藏（<SPAN 
class="red favorite400">0</SPAN>）个</A></DIV>-->
<!--<DIV class="f-paper1 fright"><A href="http://www.#.com/news/show/3304" 
target=_blank>我要置顶号码？</A></DIV>--></DIV>
<DIV class=label>
<UL>
  <LI class=number>400号码</LI>
  <LI class=price>价格/含费</LI>
  <LI class=brand>运营商</LI>
  <LI class=cost>资费</LI>
  <LI class=package>套餐</LI>
  <LI class=law>号码规律</LI>
  <LI class=moral>号码寓意</LI>
 <!-- <LI class=package>门牌号</LI>-->
  <LI class=operation>操作</LI></UL></DIV>
  
  
  <?php error_reporting(E_ALL & ~E_NOTICE);//截取字符串代码如下
		
				 //echo $row_Recordset1['info_title'];
		//$str=$row_Recordset1['info_title'];
		//echo $str;
		 function mysub($str,$len) {  
        
     for($i = 0;$i < $len; $i++) {  
            if(ord(substr($str,$i,1)) > 0xa0) {  
               $string.= substr($str,$i,3);  //utf8此处改成3即可
                $i++;  //utf8此处下边在加一个$i++; 
           $i++;      //utf8时加这个
		    } else  {
                $string.= substr($str,$i,1);  
        } 
		}
        return $string;
    }  
		//echo mysub($str,54); 
	 ?> 
  
  
<?php do { ?>
  <DIV class=numbershow>
    <UL>
      <LI class="number hmzt"><A 
  href="sLL_xy.php?id=<?php echo $row_Recordset1['id']; ?>" ><SPAN 
  class=red><?php echo substr($row_Recordset1['sLL_hao'],0,4); ?></SPAN><SPAN class=searchresultkey><?php echo substr($row_Recordset1['sLL_hao'],4,7); ?></SPAN></A></LI>
      
      <LI class=price><SPAN class=red>￥<?php echo $row_Recordset1['s_price']; ?></SPAN>/￥<?php echo $row_Recordset1['hfei']; ?></LI>
      <LI class=brand><I class="brand_icon liantong"></I>
	  <?php $a=$row_Recordset1['a'];
	  switch($a){
		 case 4007:
		 echo "中国移动"; 
		 break;
		 case 4001:
		 echo "中国移动"; 
		 	break;	
				 case 4000:
		 echo "中国联通"; 
		 break;
		 case 4006:
		 echo "中国联通"; 
		  break;
		  		 case 4008:
		 echo "中国电信"; 
		 break;
		 case 4009:
		 echo "中国电信"; 
		 break;
	  }
	  
	  
	  ?> </LI>
      <LI class=cost>
        <?php  $zf=$row_Recordset1['aprm']; 
  switch ($zf){
	 case 0: 
	  echo "不限";
	  break;
	  
	case 10: 
	  echo "￥低于0.1元/分钟";
	  break;
	  case 20: 
	  echo "￥0.1-0.2元/分钟";
	  break;
	  case 30: 
	  echo "￥0.2-0.3元/分钟 ";
	  break;
	  
	  }
  
  ?></LI>
      <LI class=package>￥<?php if($row_Recordset1['minprice']=="0"){echo "不限";}else{echo $row_Recordset1['minprice'];} ?></LI>
      <LI class=law><?php $c=$row_Recordset1['c']; 
  switch($c){
	  case 0: 
	  echo "无规率";
	  break;
	  
	case 1: 
	  echo "普通号码";
	  break;
	  case 2: 
	  echo "尾数ABCDE+";
	  break;
	  case 3: 
	  echo "尾数AAAAA+ ";
	  break; 
	  
	  case 4: 
	  echo "尾数AAABBB";
	  break; 
	  case 5: 
	  echo "尾数AABBCC";
	  break; 
	  case 6: 
	  echo "尾数ABCABC ";
	  break; 
	  case 7: 
	  echo "尾数ABBABB ";
	  break; 
	  case 8: 
	  echo "尾数AABAA ";
	  break; 
	  case 9: 
	  echo "尾数AAABB ";
	  break; 
	  case 10: 
	  echo "尾数AABBB ";
	  break; 
	  case 11: 
	  echo "尾数ABCDE ";
	  break; 
	  case 12: 
	  echo "尾数AAAAA ";
	  break; 
	  
	  case 13: 
	  echo "尾数ABCD ";
	  break;
	  case 14: 
	  echo "尾数AAAA";
	  break;
	  case 15: 
	  echo "尾数AABB ";
	  break;
	  case 16: 
	  echo "尾数ABBA";
	  break;
	  case 17: 
	  echo "尾数AAAB";
	  break;
	  case 18: 
	  echo "尾数ABAB";
	  break;
	  case 19: 
	  echo "尾数AAA";
	  break;
	  case 20: 
	  echo "尾数ABC";
	  break;
	  case 21: 
	  echo "中间AAABBB";
	  break;
	  case 22: 
	  echo "中间AAAA+";
	  break;
	  case 23: 
	  echo "中间AABBB";
	  break;
	  case 24: 
	  echo "中间AAABB";
	  break;
	  case 25: 
	  echo "中间AAAA";
	  break;
	  case 26: 
	  echo "中间AABB";
	  break;
	  case 27: 
	  echo "中间AAA";
	  break;
	  case 28: 
	  echo "中间AABBCC";
	  break;
	
	  
	  
  }
  
  
  ?></LI>
      <LI class=moral><A title="" 
  href="http://www.#.com/400/429-4006991993.htm"></A></LI>
      <LI class=package ><A href="#" target=_blank title="<?php echo $row_Recordset1['message']; ?>"> <?php if($row_Recordset1['message']==""){echo "未知";}else{echo mysub($row_Recordset1['message'],15);} ?></A> 
        <I class="sjdp_icon1 sj_vip5"></I><I class="sjdp_icon sj_dpdown" 
  title=10000></I></LI>
    <LI class=operation><A style="CURSOR: pointer" 
  class="collect fleft addFavorite" type=400 key="1085107">收藏</A><A 
  class="reserve fright" href="foot_news.php?news_id=7" 
  target=_blank>预订</A></LI></UL></DIV>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>




<DIV class="bottom-page mb20">
<DIV class=bottom-page-l>
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
    
    
    </DIV>
<!--<DIV class=f-paper><SPAN class=fp-text>共<STRONG>510011</STRONG>条记录</SPAN><SPAN 
class=fp-text><B>1</B><EM>/</EM><I>12751</I></SPAN><A class="fp-prev disabled" 
href="javascript:void(0);">&lt;</A><A class=fp-next 
href="http://www.#.com/400/search.htm?stype=&amp;manager=&amp;head=0&amp;grade=0&amp;aprm=0&amp;pricescope=-1&amp;key=&amp;tctype=0&amp;minprice=0&amp;tail=0&amp;nofour=0&amp;p1=&amp;p2=&amp;p3=&amp;p4=&amp;p5=&amp;p6=&amp;p7=&amp;s=topprice&amp;page=2">&gt;</A></DIV>-->
<DIV class=clear></DIV></DIV></DIV>
<!--<DIV class=tjhaoma>
<DIV class=tj_bt><SPAN class="fleft red">玖玖靓号官方推荐</SPAN><A class=fright 
href="http://www.#.com/u/1">更多</A> </DIV>
<DIV class=tj_hm>
<UL style="MARGIN: 0px" class=haomalist>
  <LI><A href="http://www.#.com/400/429-4001385531.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>1385531</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>800</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4006835321.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>6835321</H2>
  <P><SPAN class=fleft>尾数ABC</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1200</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4001184704.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>1184704</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4006222233.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>6222233</H2>
  <P><SPAN class=fleft>尾数ABBABB</SPAN><SPAN class=fright>￥<SPAN 
  class=red>未知</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000990545.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0990545</H2>
  <P><SPAN class=fleft>中间AABB</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000953163.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0953163</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>2.50万</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000937974.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0937974</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000917242.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0917242</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000912498.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0912498</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000892502.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0892502</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000859241.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0859241</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000851942.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0851942</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000837870.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0837870</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000832436.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0832436</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000827614.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0827614</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000769047.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0769047</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000762909.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0762909</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000744908.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0744908</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000739603.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0739603</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000715045.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0715045</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4000587796.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>0587796</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4006671722.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>6671722</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4001723713.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>1723713</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <LI><A href="http://www.#.com/400/429-4007234336.htm" target=_blank>
  <H2 class=hmzt><I class="hmlx_icon liang"></I><SPAN 
  class=yellow>400</SPAN>7234336</H2>
  <P><SPAN class=fleft>普通号码</SPAN><SPAN class=fright>￥<SPAN 
  class=red>1000</SPAN></SPAN></P></A></LI>
  <DIV class=clear></DIV></UL>
<DIV class=clear></DIV></DIV></DIV>-->
<!--<DIV class="main mb20">
<DIV class=adq><A href="http://www.#.com/u/400" target=_blank><IMG 
src="index_files/578443023d9f5.jpg" width=293 height=105></A> <A 
href="http://www.#.com/about/ad.htm" target=_blank><IMG 
src="index_files/4-1gg.jpg" width=293 height=105></A> <A 
href="http://www.#.com/about/ad.htm" target=_blank><IMG 
src="index_files/4-1gg.jpg" width=293 height=105></A> <A 
href="http://www.#.com/about/ad.htm" target=_blank><IMG 
src="index_files/4-1gg.jpg" width=293 height=105></A> </DIV>
<DIV class=clear></DIV></DIV>-->
<DIV class=liucheng>
<UL>
  <LI class=lc>
  <DIV class="lc_icon lc1 fleft"></DIV>
  <DIV class="lc_wz fright">选择号码</DIV></LI>
  <LI class=lcjt></LI>
  <LI class=lc>
  <DIV class="lc_icon lc2 fleft"></DIV>
  <DIV class="lc_wz fright">联系店主</DIV></LI>
  <LI class=lcjt></LI>
  <LI class=lc>
  <DIV class="lc_icon lc3 fleft"></DIV>
  <DIV class="lc_wz fright">填写资料</DIV></LI>
  <LI class=lcjt></LI>
  <LI class=lc>
  <DIV class="lc_icon lc4 fleft"></DIV>
  <DIV class="lc_wz fright">支付费用</DIV></LI>
  <LI class=lcjt></LI>
  <LI class=lc>
  <DIV class="lc_icon lc5 fleft"></DIV>
  <DIV class="lc_wz fright">开通使用</DIV></LI></UL></DIV></DIV>
 
<?php include ("footer.php")?>

</BODY></HTML>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Rec_ggao);
?>
