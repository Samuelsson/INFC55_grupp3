function login()
{
	//Create a prompt to get the user name
	var login_name = prompt("Enter login name");
	if (login_name.length > 0) 
		{
			document.getElementById("login_box").innerHTML = "Logged in User: " + login_name; //If a name have been entered, send it to #loginbox
		}
}

function formCheck()

{
	
}