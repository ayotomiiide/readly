<?php

	$searchquery = $_POST['searchquery'];

	if(isset($_POST['search']))
	{
		if(!isempty($searchquery)){


		}

		header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/search.php?q='.$searchquery;
    exit;
	}

?>