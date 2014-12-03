function login()
{
	//Create a prompt to get the user name
	var login_name = prompt("Enter login name");
	if (login_name.length > 0) 
	{
		document.cookie = "userName=" + login_name + "; path=/";
		checkLogin();
	}
}

function checkLogin()
{
	if (getCookie("userName"))
	document.getElementById("login_box").innerHTML = "Logged in User: " + getCookie("userName"); 
}

function getCookie(name)
{
	var cookies = "; " + document.cookie;
	var values = cookies.split("; " + name + "="); //Split the array in two right before the attr. value.
	if(values.length > 1) //Checks that the cookie can be found
	return values.pop().split(";").shift(); //Return the second part of the array, split it to isolate the value, get the first value.
	else
	return false;
}


function formChoice()
{
	if(document.referrer.search("flight") != -1) //Show flight options
	{
		document.getElementById("formInputAllergies").setAttribute("type", "text");
		alert(document.referrer);
	}
	else if(document.referrer.search("boat") != -1) //Show boat options
	{

	}
}

function formCheck()
{

}