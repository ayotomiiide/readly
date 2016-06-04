<?php 
 require_once('startsession.php');
 @$user = $_GET['id'];
 	if(!isset($user)){
 		header('Location:home');
 	}


if(!($_SESSION['logged_in']=true))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login.php');
    exit;


}
	require_once('db.php');
	$query = "SELECT * FROM user WHERE userID = $user";
	$result = mysql_query($query);

	if(mysql_num_rows($result) == 1){
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
	}

	 
 

	$pagetitle = ' | '.ucfirst(@$row['firstname']).' '.ucfirst(@$row['lastname']);
	require_once('header.php');
	
	require_once('navbar.php');
?>
<div align="center" class="jumbotron container row">
	<div  class="col-md-6 container">
		<div class="page-header"> <h2> <?php echo ucfirst(@$row['firstname']).'\'s Profile'; ?> </h2> </div>
		<img align="left" src="images/userimage/<?php echo $row['avatar']; ?>.jpg" class="img-circle" height="250px" width="250px" />
		<p> <?php echo ucfirst(@$row['firstname']).' '.ucfirst(@$row['lastname']); ?></p>
		<p> Joined : <?php echo $row['joined'];?></p>
		<p> About: </p>
		<div>
			 <?php 
			if($_SESSION['userID'] == $user){
				echo '<small> <a href="editprofile"> Edit Profile </a> </small>' ;
			} ?> 
		</div>
	</div>


	<div align="center" class="col-md-6 container">
		<div class="page-header"> <h2>  Stories by <?php echo ucfirst(@$row['firstname']); ?> </h2> </div>
		<div class="container">
		<ul class="list-group">
		<?php
			
			$query1 = " SELECT * FROM stories WHERE userID=$user ORDER BY storyID DESC";
			$result1 = mysql_query($query1);
			echo '<div> Total : '.mysql_num_rows($result1).' </div>';

			while (@$row1 = mysql_fetch_array($result1)){
			echo '<li class="list-group-item"><a href="read?s='.$row1['storyID'].'">'.ucfirst($row1['title']).'</a> </li>' ; 
			}
		?>
		</ul>
		</div>
	</div>
</div>



  <?php require_once('footer.php'); ?>