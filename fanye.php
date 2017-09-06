<style type="text/css">


.fenye a:link,a:visited{  text-decoration:none; } 
.fenye a:hover,a:active{ text-decoration:underline; color:#FF6600;}



/*分页开始*/
.fenye{ clear:both; overflow:hidden;margin-bottom:5px;font-size:12px;}
.fenye ul{ list-style-type:none; margin:0px; padding:0px; padding-left:20px; }
.fenye ul li{ float:left; height:28px; margin-right:6px;border:1px solid #CCCCCC;text-align:center; line-height:28px;}
.fenye ul li.fangkuang{ width:28px;}
.fenye ul li.start_end{ width:38px;}
.fenye ul li.start_end2{ width:28px;}
.fenye ul li.fangkuangcurrent{ width:28px;border:1px solid #999999;background:#2398b9; color:#FFFFFF; font-weight:bold;}
.fenye ul li.fangkuangcurrent a{ color:#FFFFFF; font-weight:bold; }
.fenye ul li a:link,.fenye ul li a:visited{ display:block;color:#000000;}
.fenye ul li a:hover,.fenye ul li a:active{ text-decoration:none; background:#68d7f6; color:#FFFFFF;}
/*分页结束*/


</style>
<table width="98%" border="0" align="center"  bgcolor="#FFFFFF" >
                        
                     

 <tr bgcolor="#FFFFFF">
    <td style="font-size:14px" width="320"colspan="1"  height="50 
    "   >
记录 <?php echo ($startRow_Recordset1 + 1) ?> 到 <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?> (总共<?php echo $totalRows_Recordset1 ?>条   &nbsp;共<?php echo $totalPages_Recordset1+1 //共多少页代码?>页 当前为<?php echo $_GET[pageNum_Recordset1]+1;//当前为第几页代码 ?>页）
     </td>
    
    
    
    <td  height="50" colspan="3" >
    
    <table  border="0" cellspacing="1" cellpadding="1" class="pages">
      <tr>
      
        
        <td align="left" >    
        
         <div  class="fenye">   
		  <ul>
		 
      <li class="start_end2"><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">首页</a> </li>   
         
              
			 
              <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>  
        <li class="start_end">
  <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">前一页</a> </li>  <?php } // Show if not first page ?>
         
        
        

         
         
         
		 <?php 
$i=1;

if($_GET['pageNum_Recordset1']){$i=$_GET['pageNum_Recordset1'];}
$tt=$i+2;
if($tt>$totalPages_Recordset1+1){$tt=$totalPages_Recordset1+1;}
while($i<=$tt)
  {
 ?>  
 
 
 
<?php if ($_GET['pageNum_Recordset1']+1==$i){ ?>
  <li class="fangkuangcurrent"><SPAN 
 class=""><?php echo $i ?></SPAN></li>
<?php } else { ?>
  <li  class="fangkuang"><SPAN 
  class=><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $i-1, $queryString_Recordset1); ?>"><?php echo $i ?></a></SPAN></li>

<?php } ?>
  
  
  
  
  <?php   
  $i++;
  }
?>



<?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
 <li class="start_end"><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">下一页</a></li>
  <?php } // Show if not last page ?>
 

<?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
<li class="start_end2"><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">尾页</a></li>	<?php } // Show if not last page ?>


</ul></div></td>


      
       
      </tr>
   </table></td>
     
    
  </tr> </table>