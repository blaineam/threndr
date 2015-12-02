<?php 
	//check if logged in
if($login){
	//check if customer is an admin
	if($admin){
		
	?>
	<ul id="adminmenu">
		<li><a href="/admin">Products</a></li>
		<li><a href="/admin/add">Add Product</a></li>
		<li><a href="/admin/orders">Orders</a></li>
	</ul>
	<br />
	<br />
		
		<?php
			//display page content based on url
	if($path_info['call_parts'][1]=="add"){
		include $_SERVER['DOCUMENT_ROOT'] . "/business/forms/addproducts.php";
	}elseif($path_info['call_parts'][1]=="edit"){
		include $_SERVER['DOCUMENT_ROOT'] . "/business/forms/editproducts.php";
	}elseif($path_info['call_parts'][1]=="delete"){
		include $_SERVER['DOCUMENT_ROOT'] . "/business/forms/deleteproducts.php";
	}elseif($path_info['call_parts'][1]=="orders"&&empty($path_info['call_parts'][2])){
		include $_SERVER['DOCUMENT_ROOT'] . "/business/forms/adminorders.php";
	}elseif($path_info['call_parts'][1]=="orders"&&!empty($path_info['call_parts'][2])){
		include $_SERVER['DOCUMENT_ROOT'] . "/business/forms/adminorder.php";
	}else{
		
	
		include $_SERVER['DOCUMENT_ROOT'] . "/business/forms/products.php";
			
	}
	
		
	}else{
		//send customer to error page and state error below
		$_SESSION["error"]="You do not have access to this page!";
		header("Location: /error");
		exit();
	}
	}else{
		//redirect to login page
		header("Location: /login");
		exit();
	}
			
			?>