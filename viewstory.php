<?php 
 require_once('startsession.php');

if(!($_SESSION['logged_in']=true))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login.php');
    exit;


}
	


require_once('db.php');

	$pagetitle = "";
?>

<!DOCTYPE HTML>
<html>
<head> 
	<title> Readly <?php echo $pagetitle ?>  </title>
</head>
<body>



</body>

</html>
