<?php
	//unset all login values;
    session_unset();
    session_destroy();
    session_write_close();
	$login = false;
	$admin = false;
	//redirect to home page
	echo "<script> window.location.href = '/home';</script>";
	exit();	