$.material.init();
if ($.cookie('name') === undefined)
{
	$("#login").html ("<a class='nav-link' href='/login.php'>Login</a>");
}
else
{
	$("#login").html("<a class='nav-link' href='/logout.php'>Logout</a>");
}
