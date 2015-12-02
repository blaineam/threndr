<?php
	//include site-wide dependencies
	include "data/dependencies.php";
	//include header section
	include "sections/header.php";
	//include menu
	include "sections/menu.php";
	//check for sent url path
	if(empty($path_info['call_parts'][0])){
		//remove any remaining error messages
		unset($_SESSION["error"]);
		//include the home page
	include "pages/home.php";
	//check if requested page exists
	}elseif(file_exists("pages/".$path_info['call_parts'][0].".php")){
		//include requested page
		include "pages/".$path_info['call_parts'][0].".php";
		unset($_SESSION["error"]);
	}else{
		//display error stating the page didnt exist
		$_SESSION["error"]="The Page you requested does not exist. Please use the menu or search to find what your looking for.";
		include "pages/error.php";
	}
	//include footer
	include "sections/footer.php";
	
	
	?>