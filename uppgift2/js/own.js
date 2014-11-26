function login()
{
	var login_name = prompt("Enter login name");
	if (login_name != null) 
		{
			document.getElementById("login_box").innerHTML = "User: " + login_name;
		}
}