<?php
	
	//connect to database
	include "data/connect.php";
//get dommain name
$domain = "https://".$_SERVER['SERVER_NAME'];
	
	//set file type header
	header( 'Content-Type: application/xml' );
	//output begining of file
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
  
  //output static urls
  echo '<url>
    <loc>'.$domain.'/home</loc> 
  </url>
  <url>
    <loc>'.$domain.'/contact</loc> 
  </url>
  <url>
    <loc>'.$domain.'/grid/men</loc> 
  </url>
  <url>
    <loc>'.$domain.'/grid/womens</loc> 
  </url>
  <url>
    <loc>'.$domain.'/login</loc> 
  </url>';
    
  //select product id's from database
  $fq="SELECT id FROM `products`";
$fresult = $mysqli->query($fq);

while($row = mysqli_fetch_array($fresult)) {

  
  //for each row in database create new url
 echo '<url>
    <loc>'.$domain.'/product/'.$row['id'].'</loc> 
  </url>';
  
  
  }
  
  
echo '</urlset>';

?>