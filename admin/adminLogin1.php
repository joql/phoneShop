<?php require_once('../Connections/connch21.php'); ?>
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
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['passwd'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "adminLogin.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connch21, $connch21);
  
  $LoginRS__query=sprintf("SELECT username, passwd FROM `admin` WHERE username=%s AND passwd=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connch21) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<html>
<head>
<title>����Ա��¼����</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<style type="text/css">
<!--
.bluebox {
	border: 1px solid #0066CC;
}
body {
	background-image: url(Images/mainbg.jpg);
}
.dw {
	position: absolute;
	left: 570px;
	top: 305px;
	
}
-->
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
<form ACTION="<?php echo $loginFormAction; ?>" method="POST" name="form1" class="dw">
        <table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="5"><img src="images/winxp_r1_c1.jpg" width="5" height="30"></td>
            <td background="images/winxp_r1_c3.jpg"><font color="#FFFFFF" size="2"><img src="images/winxp_r1_c9.jpg" width="18" height="30" align="absmiddle">����Ա��¼����</font></td>
            <td width="28"><a href="../index.php"><img src="images/winxp_r1_c5.jpg" alt="�뿪��¼����" width="28" height="30" border="0"></a></td>
          </tr>
        </table>
        <table width="300" border="0" align="center" cellpadding="4" cellspacing="2" class="bluebox">
          <tr> 
            <td width="60"> <div align="right"><font size="2">�˺�</font></div></td>
            <td><font size="2"> 
              <input name="username" type="text" id="username">
              </font></td>
          </tr>
          <tr> 
            <td width="60"> <div align="right"><font size="2">����</font></div></td>
            <td><font size="2"> 
              <input name="passwd" type="password" id="passwd" >
              </font></td>
          </tr>
          <tr> 
            <td colspan="2"> <div align="center"><font size="2"></font> <font size="2"> 
                <input type="submit" name="Submit" value="��¼��������">
                <input type="button" name="Submit2" value="�뿪��¼����" onClick="window.location.href='index.php';">
                </font></div></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
</body>
</html>
