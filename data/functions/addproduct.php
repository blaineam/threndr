<?php
	
	
	//include site-wide dependencies
	include "../dependencies.php";
	//check if customer is admin
	if($admin){
		//extract passed values
		extract($cleanpost);
		//check if passed values are empty
		if(!empty($type)&&!empty($title)&&!empty($price)&&!empty($description)&&isset($_FILES['graphic'])&&!empty($agegroup)&&!empty($gender)&&!empty($featured)){
			
			//declare folder to save product image to
$path = "../../resources/products/images/";
//get uploaded file name
$img = $_FILES['graphic']['tmp_name'];
//declare desired destination and file name
$dst = $path . 'photo_'.substr(md5(rand()), 0, 20).'_'.time().'.jpg';
//check if image exists or if wrong type of file was uploaded
if (($img_info = getimagesize($img)) === FALSE)
  die("Image not found or not an image");

//set width and height from uploaded file
$width = $img_info[0];
$height = $img_info[1];
//process image based on origin file type
switch ($img_info[2]) {
  case IMAGETYPE_GIF  : $src = imagecreatefromgif($img);  break;
  case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($img); break;
  case IMAGETYPE_PNG  : $src = imagecreatefrompng($img);  break;
  default : die("Unknown filetype");
}
//create image placeholder
$tmp = imagecreatetruecolor($width, $height);
//copy processed image over to placeholder image
imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
//save image to desired destination with desired filename
imagejpeg($tmp, $dst.".jpg");
//build mysql relative path to file from site root
	 $mysqlurl = substr($dst, 6);
	 
	 		//insert data into product database table
	 
			$dbiq="INSERT INTO products (type, title, price, description, graphic, agegroup, gender, featured) VALUES('".$type."', '".$title."', '".$price."', '".$description."', '".$mysqlurl."', '".$agegroup."', '".$gender."', '".$featured."')";
			$dbinserter = $mysqli->query($dbiq); 
			$productid = $mysqli->insert_id;
						//check for inventory values
						if(!empty($extrasmall)||!empty($small)||!empty($medium)||!empty($large)||!empty($extralarge)){
							//insert inventory values into database
							$dbiq="INSERT INTO productinventory (productid, XS, S, M, L, XL) VALUES(".$productid.",".$extrasmall.",".$small.",".$medium.",".$large.",".$extralarge.")";
							$dbinserter = $mysqli->query($dbiq); 
						}

			
			//reload the products list
			header("Location: /admin");
			exit();
	 
			
			
		}else{
			//display error message about incomplete fielads
		$_SESSION["error"]="Please complete all fields.";
		header("Location: /admin/add");
		exit();
		}
		
		
	}else{
		//display error for invalid access
		$_SESSION["error"]="You do not have access to this tool";
		header("Location: /error");
		exit();
	}
	
	
	
	?>