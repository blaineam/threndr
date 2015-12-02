<div id="menu">
<div id="logo">
</div>
<div id="mainmenu">
	<ul id="nav">
		<li class="selected"><a href="/home">Home</a></li>
		<li>
			<a href="/grid/mens">Mens</a>
			<ul>
				<li><a href="/grid/mens/shirts">Shirts</a></li>
				<li><a href="/grid/mens/shorts">Shorts</a></li>
				<li><a href="/grid/mens/pants">Pants</a></li>
				<li><a href="/grid/mens/jackets">Jackets</a></li>
			</ul>
		</li>
		<li>
			<a href="/grid/womens">Womens</a>
			<ul>
				<li><a href="/grid/womens/shirts">Shirts</a></li>
				<li><a href="/grid/womens/skirts">Skirts</a></li>
				<li><a href="/grid/womens/dresses">Dresses</a></li>
				<li><a href="/grid/womens/pants">Pants</a></li>
				<li><a href="/grid/womens/jackets">Jackets</a></li>
			</ul>
		</li>
		<li>
			<a href="/grid/childrens">Childrens</a>
			<ul>
				<li><a href="/grid/childrens/shirts">Shirts</a></li>
				<li><a href="/grid/childrens/skirts">Skirts</a></li>
				<li><a href="/grid/childrens/dresses">Dresses</a></li>
				<li><a href="/grid/childrens/shorts">Shorts</a></li>
				<li><a href="/grid/childrens/pants">Pants</a></li>
				<li><a href="/grid/childrens/jackets">Jackets</a></li>
			</ul>
		</li>
		<li><a href="/cart">Cart</a></li>
		<li><?php //check if user is logged in
			if($login){ ?><a href="/logout">Logout</a><ul><li><a href="/orders">Orders</a></li><?php //check if user is admin
				if($admin){ ?>  <li><a href="/admin">Admin</a></li> <?php } ?></ul><?php }else{ ?><a href="/login">Login</a><?php } ?></li>
		<li><a href="/contact">Contact</a></li>
		<li><a id="searchtoggle">Search</a></li>
	</ul>
</div>
<div id="search">
	<form action="/results" method="get">
		<input type="search" name="q" placeholder="Search our store!" />
		<input type="submit" value="🔎" />
	</form>
</div>
</div>