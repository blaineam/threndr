<?php
	//go through each POST type values and save the mysql escaped values to new array
	foreach(array_keys($_POST) as $key)
		{
			$cleanpost[$key] = $mysqli->real_escape_string($_POST[$key]);
		}
	//go through each GET type values and save the mysql escaped values to new array
	foreach(array_keys($_GET) as $key)
		{
			$cleanget[$key] = $mysqli->real_escape_string($_GET[$key]);
		}

?>