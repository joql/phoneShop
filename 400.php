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
$query_Recordset1 = "SELECT * FROM sll WHERE zding = '移动置顶' ORDER BY id DESC";
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
$query_Recordset2 = "SELECT * FROM sll WHERE zding = '联通置顶' ORDER BY id DESC";
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

$maxRows_Recordset3 = 24;
$pageNum_Recordset3 = 0;
if (isset($_GET['pageNum_Recordset3'])) {
  $pageNum_Recordset3 = $_GET['pageNum_Recordset3'];
}
$startRow_Recordset3 = $pageNum_Recordset3 * $maxRows_Recordset3;

mysql_select_db($database_connch21, $connch21);
$query_Recordset3 = "SELECT * FROM sll WHERE zding = '电信置顶' ORDER BY id DESC";
$query_limit_Recordset3 = sprintf("%s LIMIT %d, %d", $query_Recordset3, $startRow_Recordset3, $maxRows_Recordset3);
$Recordset3 = mysql_query($query_limit_Recordset3, $connch21) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);

if (isset($_GET['totalRows_Recordset3'])) {
  $totalRows_Recordset3 = $_GET['totalRows_Recordset3'];
} else {
  $all_Recordset3 = mysql_query($query_Recordset3);
  $totalRows_Recordset3 = mysql_num_rows($all_Recordset3);
}
$totalPages_Recordset3 = ceil($totalRows_Recordset3/$maxRows_Recordset3)-1;

mysql_select_db($database_connch21, $connch21);
$query_Rec_ggao = "SELECT gg_photo1, gg_photo2, title FROM guanggao WHERE title = '副页400电话页广告 '";
$Rec_ggao = mysql_query($query_Rec_ggao, $connch21) or die(mysql_error());
$row_Rec_ggao = mysql_fetch_assoc($Rec_ggao);
$totalRows_Rec_ggao = mysql_num_rows($Rec_ggao);
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
<DIV class=ad1-1><!--大图广告--><A href="http://www.#.com/escrow/588/" 
target=_blank><IMG src="images/<?php echo $row_Rec_ggao['gg_photo1']; ?>" width=1190 
height=100></A> </DIV><!--置顶靓号-->
<DIV class=stick_show>
<DIV class=hmbt>
<UL>
  <LI id=ff1 class=hdm01>移动置顶靓号</LI>
  <LI id=ff2 class=hdm02>联通置顶靓号</LI>
  <LI id=ff3 class=hdm02>电信置顶靓号</LI></UL></DIV>
<DIV class=haoma>
<DIV id=four1>
<UL class=haomalist>
  <?php do { ?>
    <li><a href="sLL_xy.php?id=<?php echo $row_Recordset1['id']; ?>" >
    
    <H2 class=hmzt><I class="hmlx_icon pu"></I><SPAN class=yellow><?php echo substr($row_Recordset1['sLL_hao'],0,4); ?></SPAN><?php echo substr($row_Recordset1['sLL_hao'],4,7); ?></H2>
    
    <p><span class="fl">
      <?php $c=$row_Recordset1['c']; 
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
  
  
  ?></span><span class="fr">￥<span class="red"><?php echo $row_Recordset1['s_price']; ?></span></span></p></a></li>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  
  
  
 
  <DIV class=clear></DIV>
  <DIV class=more><A 
  href="400_soso.php?zding=<?php echo urlencode('移动置顶'); ?>">查看更多</A></DIV></UL></DIV>
  
  
  
<DIV style="DISPLAY: none" id=four2>
<UL class=haomalist>
 
    <?php do { ?>
      <li><a href="sLL_xy.php?id=<?php echo $row_Recordset2['id']; ?>" >
        
        <H2 class=hmzt><I class="hmlx_icon pu"></I><SPAN class=yellow><?php echo substr($row_Recordset2['sLL_hao'],0,4); ?></SPAN><?php echo substr($row_Recordset2['sLL_hao'],4,7); ?></H2>
        
        <p><span class="fl">
          <?php $c=$row_Recordset2['c']; 
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
  
  
  ?></span><span class="fr">￥<span class="red"><?php echo $row_Recordset2['s_price']; ?></span></span></p></a></li>
      <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
    
  
  
  
 
  <DIV class=clear></DIV>
  <DIV class=more><A 
  href="400_soso.php?zding=<?php echo urlencode('联通置顶'); ?>">查看更多</A></DIV></UL></DIV>
<DIV style="DISPLAY: none" id=four3>
<UL class=haomalist>

    <?php do { ?>
      <li><a href="sLL_xy.php?id=<?php echo $row_Recordset3['id']; ?>" >
        
        <H2 class=hmzt><I class="hmlx_icon pu"></I><SPAN class=yellow><?php echo substr($row_Recordset3['sLL_hao'],0,4); ?></SPAN><?php echo substr($row_Recordset3['sLL_hao'],4,7); ?></H2>
        
        <p><span class="fl">
          <?php $c=$row_Recordset3['c']; 
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
  
  
  ?></span><span class="fr">￥<span class="red"><?php echo $row_Recordset3['s_price']; ?></span></span></p></a></li>
      <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
    
  
  
  
 
  <DIV class=clear></DIV>
  <DIV class=more><A 
  href="400_soso.php?zding=<?php echo urlencode('电信置顶'); ?>">查看更多</A></DIV></UL></DIV></DIV></DIV>
<DIV class="ad1-1 mb20"><!--大图广告--><A href="http://www.#.com/u/400" 
target=_blank><IMG src="images/<?php echo $row_Rec_ggao['gg_photo2']; ?>" width=1190 
height=100></A> </DIV><!--广告结束--><!--天价靓号-->
<!--<DIV class=price_show>
<UL class=hmbt>
  <LI id=p1 class=hdm01>官方推荐移动靓号</LI>
  <LI id=p2 class=hdm02>官方推荐联通靓号</LI>
  <LI id=p3 class=hdm02>官方推荐电信靓号</LI></UL>
<DIV class=haoma>
<DIV id=d1>
<UL class=haomalist>
  <DIV class=clear></DIV></UL>
<DIV class=more><A 
href="http://www.#.com/400/search.htm?manager=&amp;s=topprice">查看更多</A></DIV></DIV>
<DIV style="DISPLAY: none" id=d2>
<UL class=haomalist>
  <DIV class=clear></DIV></UL>
<DIV class=more><A 
href="http://www.#.com/400/search.htm?manager=&amp;s=topprice">查看更多</A></DIV></DIV>
<DIV style="DISPLAY: none" id=d3>
<UL class=haomalist>
  <DIV class=clear></DIV></UL>
<DIV class=more><A 
href="http://www.#.com/400/search.htm?manager=&amp;s=topprice">查看更多</A></DIV></DIV></DIV></DIV>--><!--号模-->
<DIV class=clear></DIV><!--推荐店铺和资讯-->
<!--<DIV style="MARGIN-TOP: 32px; MARGIN-BOTTOM: 32px; HEIGHT: 270px">
<DIV class="tj_shop fleft">
<DIV class=new_bt><SPAN>靓号经纪人</SPAN></DIV>
<DIV class=ranklist>
<UL>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/149/" 
  target=_blank>经纪人-古君</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/52222/" 
  target=_blank>经纪人-赵艳</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/208/" 
  target=_blank>经纪人-张爽</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/81678/" 
  target=_blank>经纪人-李鹏飞</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/633/" 
  target=_blank>经纪人-赵云</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/896/" 
  target=_blank>经纪人-姚光伟</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/137/" 
  target=_blank>经纪人-李彬</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/44/" 
  target=_blank>经纪人-仵楠</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/6699/" 
  target=_blank>经纪人-翟林祥</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/588/" 
  target=_blank>经纪人-刘玉娇</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/63128/" 
  target=_blank>经纪人-闫兰军</A></P></LI>
  <LI class=top>
  <P><A href="http://www.#.com/escrow/158/" 
  target=_blank>经纪人-任河清</A></P></LI></UL></DIV></DIV>
<DIV class="new fright">
<DIV class=new_bt><SPAN>400电话资讯</SPAN><A class=fright 
href="http://www.#.com/news/class_41/1">更多</A></DIV>
<UL>
  <LI><A href="http://www.#.com/news/show/7996" target=_blank><IMG 
  class="block fleft" src="index_files/575be68ead673.jpg" width=125 height=85> 
  <DIV class=fright>
  <H1 
  class=wz_hidden>400号码实名认证所需什么样的...</H1><SPAN>企业400业务受理单及企业400业务服务协议中的业务受理单中所有带*的...</SPAN> 
  </DIV></A></LI>
  <LI><A href="http://www.#.com/news/show/6835" target=_blank><IMG 
  class="block fleft" src="index_files/56e2978104905.jpg" width=125 height=85> 
  <DIV class=fright>
  <H1 class=wz_hidden>运营商400特服号华山论剑80...</H1><SPAN>400特服号码​ 
  　　前些年，大众对于400特服电话还不了解，总有被...</SPAN> </DIV></A></LI>
  <LI><A href="http://www.#.com/news/show/6493" target=_blank><IMG 
  class="block fleft" src="index_files/569a62f5beb1f.jpg" width=125 height=85> 
  <DIV class=fright>
  <H1 
  class=wz_hidden>您真的了解400电话吗？</H1><SPAN>随着全球通讯规模的急剧扩张，传统企业通讯工具已经无法满足和适应需求的增...</SPAN> 
  </DIV></A></LI>
  <LI><A href="http://www.#.com/news/show/6492" target=_blank><IMG 
  class="block fleft" src="index_files/569a6268f0e3f.gif" width=125 height=85> 
  <DIV class=fright>
  <H1 
  class=wz_hidden>企业为什么如此青睐400电话？</H1><SPAN>随着市场的不断发展，市场的智能化水平不断提高，办理400电话越来越成为...</SPAN> 
  </DIV></A></LI>
  <DIV class=clear></DIV></UL></DIV>
<DIV class=clear></DIV></DIV>-->
<!--<DIV class="main mb20">
<DIV class=adq><A href="http://www.#.com/escrow/588/" target=_blank><IMG 
src="index_files/5844e51ff4148.jpg" width=293 height=105></A> <A 
href="http://www.#.com/u/400" target=_blank><IMG 
src="index_files/575bda914f985.jpg" width=293 height=105></A> <A 
href="http://www.#.com/escrow/149/" target=_blank><IMG 
src="index_files/585785a9a741b.jpg" width=293 height=105></A> <A 
href="http://www.#.com/u/400" target=_blank><IMG 
src="index_files/575bdb215acc2.jpg" width=293 height=105></A> <A 
href="http://www.#.com/u/400" target=_blank><IMG 
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
  <DIV class="lc_wz fright">开通使用</DIV></LI></UL></DIV></DIV><!--<script type="text/javascript" src="js/shouji.js"></script>-->



<?php include ("footer.php")?>

 </BODY></HTML>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Rec_ggao);
?>
