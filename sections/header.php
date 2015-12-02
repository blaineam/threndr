<?php
	//declare default meta data
	$title="Threndr - Trend Setting Threads";
	$content="https://threndr.com/resources/theme/images/favicon.png";
	$description="Threndr is a new online store featuring the coolest threads sure to make every trend setter happy.";
	$tags="Clothing, Shoes, Store, Online, accessories, trend, setter, setting, threads";
	?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<meta charset="utf-8">
		<meta property="og:title" content="<?php echo $title; ?>">
		<meta property="og:type" content="website">
		<meta property="og:image" content="<?php echo $content; ?>">
		<meta property="og:description" content="<?php echo $description; ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="<?php echo $tags; ?>">
		<meta name="description" content="<?php echo $description; ?>">
		<link rel="icon" type="image/png" href="/resources/theme/images/favicon.png">
		<link rel="apple-touch-icon-precomposed" href="/resources/theme/images/favicon.png">
		<link href='https://fonts.googleapis.com/css?family=Merriweather:400,400italic,900,900italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/resources/theme/css/styles.css">
		<script type="text/javascript">
			//defer javascript loading
			function downloadJSAtOnload() {
				var element = document.createElement("script");
				element.id = "the_script";
				element.src = "/business/functions/jssystem.php";
				document.body.appendChild(element);
			}
			if (window.addEventListener)
				window.addEventListener("load", downloadJSAtOnload, false);
			else if (window.attachEvent)
				window.attachEvent("onload", downloadJSAtOnload);
			else window.onload = downloadJSAtOnload;
		</script>
	</head>
<body class="<?php //add class with the page name of current visited page 
	if(file_exists("pages/".$path_info['call_parts'][0].".php")){
		echo " ".$path_info['call_parts'][0]; 
	}elseif(!empty($path_info['call_parts'][0])){ 
		echo " error";
	}else{
		echo " home";
	}
			?>">
	