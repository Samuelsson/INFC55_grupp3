function login()
{
	//Create a prompt to get the user name
	var login_name = prompt("Enter login name");
	if (login_name != null) 
		{
			document.getElementById("login_box").innerHTML = "User: " + login_name; //If a name have been entered, send it to #loginbox
		}