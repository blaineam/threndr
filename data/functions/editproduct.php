<?php
	
	
	//include site-wide dependencies
	include "../dependencies.php";
	//check if user is an admin
	if($admin){
		//extract clean passsed values
		extract($cleanpost);
		//check if values are not empty
		if(!empty($type)&&!empty($title)&&!empty($price)&&!empty($description)&&!empty($agegroup)&&!empty($gender)&&!empty($featured)&&!empty($productid)){
			//check if new file was uploaded
			if(isset($_FILES['graphic'])){
				//declare folder to save image
$path = "../../resources/products/images/";
//declare file name
$img = $_FILES['graphic']['tmp_name'];
//declare desired path and file name
$dst = $path . 'photo_'.substr(md5(rand()), 0, 20).'_'.time().'.jpg';
	//create mysql path relative to site root
	 $mysqlurl = substr($dst, 6);
//declare optional graphic updater
$mysqlgraphicvar=", graphic = '".$mysqlurl."'";

//check if uploaded file is not an image
if (($img_info = getimagesize($img)) === FALSE)
  //set optional graphic updaters to null values
$mysqlgraphicvar='';
$mysqlgraphicvarval="";
//get width and height from uploaded file
$width = $img_info[0];
$height = $img_info[1];
//process image based on original file type
switch ($img_info[2]) {
  case IMAGETYPE_GIF  : $src = imagecreatefromgif($img);  break;
  case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($img); break;
  case IMAGETYPE_PNG  : $src = imagecreatefrompng($img);  break;
  
  //set optional graphic updaters to null values
$mysqlgraphicvar='';
$mysqlgraphicvarval="";
}
//create placeholder image
$tmp = imagecreatetruecolor($width, $height);
//render uploaded image in placeholder image
imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
//save image to desired location and name
imagejpeg($tmp, $dst.".jpg");

			}else{
				
			}
				 
			//update product
	 
			$dbiq="UPDATE products SET type = '".$type."', title = '".$title."', price = '".$price."'$mysqlgraphicvar, description = '".$description."', agegroup = '".$agegroup."', gender = '".$gender."', featured = '".$featured."' WHERE id = ".$productid;
			$dbinserter = $mysqli->query($dbiq); 
			
						//check for inventory values
						if(!empty($extrasmall)||!empty($small)||!empty($medium)||!empty($large)||!empty($extralarge)){
						//update inventory values
			$dbiq="UPDATE productinventory SET XS = ".$extrasmall.", S = ".$small.", M = ".$medium.", L = ".$large.", XL = ".$extralarge." WHERE productid = ".$productid;
			$dbinserter = $mysqli->query($dbiq); 
			}
			//reload products list
			header("Location: /admin");
			exit();
	 
			
			
		}else{
			//display error to complete all fields
		$_SESSION["error"]="Please complete all fields.";
		header("Location: /admin/edit/$productid");
		exit();
		}
		
		
	}else{
		//display error of inaccess
		$_SESSION["error"]="You do not have access to this tool";
		header("Location: /error");
		exit();
	}
	
	
	
	?>