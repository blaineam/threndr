<?php
	
	//set file type header
header('Content-type: application/javascript');
//declare javscript files folder path
$base = "../../resources/theme/js/";
//output javscript files into merged file
echo file_get_contents($base."jquery-min.js");
echo file_get_contents($base."jquery-slider.min.js");
echo file_get_contents($base."responsive-nav.min.js");
echo file_get_contents($base."jquery.creditCardValidator.js");
echo file_get_contents($base."custom.js");

?>