<?php
require_once('startsession.php');

$pagetitle = ' | Top Stories';

if(!($_SESSION['logged_in']==true))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login.php');
    exit;




}
    	require_once('header.php');
	
	require_once('navbar.php');
	require_once('db.php');

?>

<div align="center" class="jumbotron container row">
	<div class="page-header"> Top Stories </div>
	<ul class="list-group" align="center">
	<?php
  $getstories = "SELECT * FROM stories INNER JOIN user USING(userID)  ORDER BY hits DESC LIMIT 25";
  $storiesresult = mysql_query($getstories);

  while ($row = mysql_fetch_array($storiesresult))  {

						echo '<li class="list-group-item"><a href="read?s='.$row['storyID'].'">'.$row['title'].
							'</a> <small> by: <a href="user?id='.$row['userID'].'">'.ucfirst($row['username']).'</a> </small> <br/> <small> Read : '. $row['hits'].' times</small> </li>' ; 
					}

					mysql_close();
  ?>
	</ul>
</div>

<?php  require_once('footer.php'); ?>