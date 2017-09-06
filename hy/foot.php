<?php require_once('../Connections/connch21.php'); ?>
<?php


mysql_select_db($database_connch21, $connch21);
$query_Rec_hyfoot = "SELECT * FROM admin_wysz";
$Rec_hyfoot = mysql_query($query_Rec_hyfoot, $connch21) or die(mysql_error());
$row_Rec_hyfoot = mysql_fetch_assoc($Rec_hyfoot);
$totalRows_Rec_hyfoot = mysql_num_rows($Rec_hyfoot);
?>
<div class="foot">
		<div class="foot_txt">
			<p><?php echo $row_Rec_hyfoot['w_footsm']; ?>　Copyright © 2010-2028 All rights reserved <br>
              联系电话：<?php echo $row_Rec_hyfoot['w_tel']; ?></p>
		</div>
	</div>
<?php
mysql_free_result($Rec_hyfoot);
?>
