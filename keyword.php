<?php require_once('Connections/connch21.php'); ?>
<?php


mysql_select_db($database_connch21, $connch21);
$query_Rec_key = "SELECT w_name, w_gjz, w_msu FROM admin_wysz";
$Rec_key = mysql_query($query_Rec_key, $connch21) or die(mysql_error());
$row_Rec_key = mysql_fetch_assoc($Rec_key);
$totalRows_Rec_key = mysql_num_rows($Rec_key);
?>
 <title><?php echo $row_Rec_key['w_name']; ?></title>
<meta name="keywords" content="<?php echo $row_Rec_key['w_gjz']; ?>">
<meta name="description" content="<?php echo $row_Rec_key['w_gjz']; ?>">  
<?php
mysql_free_result($Rec_key);
?>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">