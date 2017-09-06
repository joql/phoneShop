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
$query_Rec_cplbo = "SELECT * FROM guanggao WHERE title = '车牌页轮播广告'";
$Rec_cplbo = mysql_query($query_Rec_cplbo, $connch21) or die(mysql_error());
$row_Rec_cplbo = mysql_fetch_assoc($Rec_cplbo);
$totalRows_Rec_cplbo = mysql_num_rows($Rec_cplbo);
?>
<div class="banner fright">
        	<div class="long_block_index">
              <div class="js_imgs_block">
                <div id="slideshow_wrapper">
                  <div id="slideshow_photo">
				  				  				  <a href="#" target="_blank" index="1" style="z-index: 1; display: block;"><img border="0" src="images/<?php echo $row_Rec_cplbo['gg_photo1']; ?>" width="780" height="350"></a> 
								  <a href="#" target="_blank" index="2" style="z-index: 1; display: block;"><img border="0" src="images/<?php echo $row_Rec_cplbo['gg_photo2']; ?>" width="780" height="350"></a> 
								  <a href="#" target="_blank" index="3" style="z-index: 1; display: block;"><img border="0" src="images/<?php echo $row_Rec_cplbo['gg_photo3']; ?>" width="780" height="350"></a> 
												<a href="#" target="_blank" index="4" style="z-index: 2; display: block;"><img border="0" src="images/<?php echo $row_Rec_cplbo['gg_photo4']; ?>" width="780" height="350"></a> 
				  </div>
                  <div id="slideshow_footbar"><div class="slideshow-bt bt-on" index="4"></div><div class="slideshow-bt" index="3"></div><div class="slideshow-bt" index="2"></div><div class="slideshow-bt" index="1"></div></div>
                </div>
              </div>
            </div>
            <div class="survey_block_index">
              <div class="title_survey_block_index">
                <ul class="scrollU2">
                  <a id="m01" class="sd01" href="javascript:void(0)"></a>
                  <a id="m02" class="sd02" href="javascript:void(0)"></a>
				  <a id="m03" class="sd03" href="javascript:void(0)"></a>
                  <a style="BaCKGROUND-IMaGE: none" id="m03" class="sd03" href="javascript:void(0)"></a>
                </ul>
              </div>
            </div>
		</div></div>
        
<?php
mysql_free_result($Rec_cplbo);
?>
