<?php 
	//check if user is logged in
	if($login){ 
	echo "<h1> You are already logged in.</h1>";
	}else{
		//display login form
		?>
<div id="login">
	<form method="post" action="/login">
		<input type="text" name="email" placeholder="email" />
		<input type="password" name="password" placeholder="password" />
		<input type="submit" value="Login" />
	</form>
</div>
<?php
	}
	?>