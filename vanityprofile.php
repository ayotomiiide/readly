<?php 

$getName = explode("/",$_SERVER['REQUEST_URI']);

$result = mysql_query("SELECT * FROM user WHERE username='$getName[3]'");	
$num_rows = mysql_num_rows($result);

if($num_rows == 0){
  header ("Location: 404");
}

$row = mysql_fetch_array($result);

echo $

?>