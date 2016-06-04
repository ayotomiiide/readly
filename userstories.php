<?php 
 require_once('startsession.php');
 @$user = $_GET['id'];
 	if(!isset($user)){
 		header('Location:home');
 	}

 	require_once('db.php');
	$query = "SELECT * FROM user WHERE userID = $user";
	$result = mysql_query($query);

	if(mysql_num_rows($result) == 1){
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
	}
	else
	{
		header('location:home');
	}

$pagetitle = ' | '.ucfirst(@$row['firstname']).' '.ucfirst(@$row['lastname']);
	require_once('header.php');
	
	require_once('navbar.php');
?>

<div align="center" class="jumbotron container row">
<div class="page-header"> Stories by <?php echo ucfirst($row['firstname']).' '.ucfirst($row['lastname']); ?> 
</div>
<?php if(isset($_SESSION['deletealert'])){echo $_SESSION['deletealert']; } unset($_SESSION['deletealert']);  ?>

<?php
  $getstories = "SELECT * FROM stories WHERE userID = $user ORDER BY storyID DESC";
  $storiesresult = mysql_query($getstories);

  while($stories = mysql_fetch_array($storiesresult)){
    echo '<div class="list-unit">'.
          '<span class="name">'.
          '<a href="read.php?s='.
          $stories['storyID'].
          '">'.
          ucfirst($stories['title']).
          '</a>'.
          '</span>';
          if($_SESSION['userID'] == $user)
          {

         echo  '<a href="#" class="note mini pull-right onhover" data-toggle="modal" data-target="#modalWrap'.$stories['storyID'].'"><img src="images/del.png"/></a>'.
          '<a href="editstory?s='.
          $stories['storyID']
          .'" class="note mini pull-right onhover"><img src="images/edit.png"/></a>';}
      echo '</div>';

      echo '<div id="modalWrap'.$stories['storyID'].'" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete story "'.ucfirst($stories['title']).'"?</p>
                <p class="text-warning"><small>Delete Action is permanent!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning"><a href="deletestory?s='.$stories['storyID']
                .'">Delete</a></button>
            </div>
        </div>
    </div>
  </div>';
  }
      
 ?>
</div>


<div id="modalWrap" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete story ""?</p>
                <p class="text-warning"><small>Delete Action is permanent!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning">Delete</button>
            </div>
        </div>
    </div>
  </div>
  <?php require_once('footer.php'); ?>