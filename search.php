<?php

  // This function builds navigational page links based on the current page and the number of pages
  function generate_page_links($user_search, $cur_page, $num_pages,$cat) {
    $page_links = '';

    // If this page is not the first page, generate the "previous" link
    if ($cur_page > 1) {
      $page_links .= '<li> <a href="' . $_SERVER['PHP_SELF'] . '?q=' . $user_search.'&c='.$cat. '&page=' . ($cur_page - 1) . '">&laquo;</a> </li> ';
    }
    else {
      $page_links .= '<li class="disabled"> <span>&laquo; </span> </li> ';
    }

    // Loop through the pages generating the page number links
    for ($i = 1; $i <= $num_pages; $i++) {
      if ($cur_page == $i) {
        $page_links .= ' <li class="active"><span>' . $i.'</span> </li>';
      }
      else {
        $page_links .= '<li> <a href="' . $_SERVER['PHP_SELF'] . '?q=' . $user_search  .'&c='.$cat.  '&page=' . $i . '"> ' . $i . '</a> </li>';
      }
    }

    // If this page is not the last page, generate the "next" link
    if ($cur_page < $num_pages) {
      $page_links .= '<li> <a href="' . $_SERVER['PHP_SELF'] . '?q=' . $user_search .'&c='.$cat.  '&page=' . ($cur_page + 1) . '"> &raquo;</a> </li>';
    }
    else {
      $page_links .= '<li class="disabled"> <span> &raquo; </span></li>';
    }

    $page_links =  '<ul class="pagination">'.$page_links.'</ul>';
    return $page_links;
  }

@$searchquery = $_GET['q'];
@$cat = $_GET['c'];

  // Calculate pagination information
  $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $results_per_page = 5;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);


session_start();

if(!($_SESSION['logged_in']==true))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login.php');
    exit;


}

if( !isset($searchquery) && !isset($cat)){
	header('Location: home');
}

 
 require_once('db.php');
	$pagetitle = "| ".'" '.$searchquery.' "';
	require_once('header.php');
	
	require_once('navbar.php');

	$search_query = "SELECT * FROM stories INNER JOIN category USING(catID)".
				"INNER JOIN user USING(userID)";
	$where_list = array();
	$search_words = explode(' ', $searchquery);
	foreach ($search_words as $word) {
		$where_list[] = "title LIKE '%$word%'";
	}

	$where_clause = implode(' OR ', $where_list);

	if(isset($where_clause)){
		$search_query .= " WHERE $where_clause";
	}

	if(isset($cat) && !empty($cat)){
		$search_query .= " AND catID = ".$cat;
		@$query1 = "SELECT * FROM category WHERE catID = ".$cat;
		@$result1 = mysql_query($query1);
		if(!@mysql_num_rows(@$result1)==0){
			while ($row1 = mysql_fetch_array($result1))  {
			@$catc = ' in '.$row1['catNAME']. ' category';
		}
		}
	} 

	 // Query to get the total results 
  
  $totalresultsquery = mysql_query($search_query);
  $totalresults = mysql_num_rows($totalresultsquery);
  $num_pages = ceil($totalresults / $results_per_page);

  $search_query =  $search_query . " LIMIT $skip, $results_per_page";
?>
<div class="container" id="wrap">
	<div class="jumbotron container"> 
		<div class="container page-header">
			<h4> Search Results for: <?php 
			if(!isset($cat) || empty($cat)){
			echo '"'.$searchquery.'"';}
			else{
				echo '"'.$searchquery.'"'.$catc;
			}
			?> </h4>
		</div>
		<div>
			<ul class="list-group" align="center">
			<?php

				@$result = mysql_query($search_query);


				if(!@mysql_num_rows(@$result)==0){

				

					while ($row = mysql_fetch_array($result))  {

						echo '<li class="list-group-item"><a href="read?s='.$row['storyID'].'">'.$row['title'].
							'</a> <small> by: <a href="user?id='.$row['userID'].'">'.ucfirst($row['username']).'</a> </small> <br/> <small> Read : '. $row['hits'].' times</small> </li>' ; 

						  // Generate navigational page links if we have more than one page
  					
					} }
					else
					{
						echo '<div> No result found, Pls redefine your search terms </div>';
					}
					if ($num_pages > 1) {
    						echo generate_page_links($searchquery, $cur_page, $num_pages,$cat);
  								}
				?>
		</div>
	</div>
</div>
<?php require_once('footer.php'); ?>