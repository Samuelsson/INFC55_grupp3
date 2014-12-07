function login()
{
	//Create a prompt to get the user name
	var login_name = prompt("Enter login name");
	if (login_name.length > 0) 
	{
		document.cookie = "userName=" + login_name + "; path=/"; //Sets a session cookie with the login name
		checkLogin();
	}
}

function checkLogin()
{
	if (getCookie("userName"))
	document.getElementById("login_box").innerHTML = "Logged in User: " + getCookie("userName");
}

function logout()
{
	document.cookie = "userName=" + getCookie("userName") + "; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT";
	document.getElementById("login_box").innerHTML = "Login";
}

function getCookie(name)
{
	var cookies = "; " + document.cookie;
	var values = cookies.split("; " + name + "="); //Split the array in two right before the attr. value.
	if(values.length > 1) //Checks that the cookie can be found
	return values.pop().split(";").shift(); //Break out the last part of the array, split it to isolate the value, return the first part.
	else
	return false;
}


//Sets what formfields will be shown based on the referrer.
function formChoice()
{
	if(document.referrer.search("flight") != -1) //Show flight options if the string "flight" is in the referrer
	{
		document.getElementById("formAllergiesToggle").style.display = 'block';
		document.getElementById("formDiseaseToggle").style.display = 'block';
	}
	else if(document.referrer.search("boat") != -1) //Show boat options if the string "boat" is in the referrer
	{
		document.getElementById("formSwimToggle").style.display = 'block';
	}
}

//Kontrollerar att samtliga fält som krävs är ifylda korrekt.
function formCheck()
{
	if
	( 	
		document.getElementById("formInputName").value.length < 2 
		|| 
		document.getElementById("formInputEmail").value.length < 4 
		|| 
		document.getElementById("formInputDeparture").value.length < 4
		|| 
		document.getElementById("formInputReturn").value.length < 4
	)
	
	{
		alert("Ni måste fylla i samtliga fält markerade med *");
		return false;
	}
}

function getFormValue(name)
{
	var values = "&" + window.location.search.substring(1);
	var search = values.split("&" + name + "=")
	
	if(search.length > 1)
	return barToText(search.pop().split("&").shift()) // gets the right part of the array and fix and email-string
	else
	return "NULL";	
}

function barToText(text)
{
	text = text.replace(/%C3%A5/g, "å");
	text = text.replace(/%C3%A4/g, "ä");
	text = text.replace(/%C3%B6/g, "ö");
	text = text.replace(/%C3%85/g, "Å");
	text = text.replace(/%C3%84/g, "Ä");
	text = text.replace(/%C3%96/g, "Ö");
	text = text.replace(/%40/g, "@");
	text = text.replace(/\+/g, "")
	return text;
}

function toggleContrast()
{
	if(getCookie("highContrast")  == "true")
		document.cookie = "highContrast=false; path='/'";
	else
		document.cookie = "highContrast=true; path='/'";
	checkStyle();
}

function toggleTextSize()
{

	console.log(getCookie("textSize"));

	if(getCookie("textSize")  == "large")
		document.cookie = "textSize=small; path='/'";
	else //Default utan cookie
		document.cookie = "textSize=large; path='/'";
	checkStyle();
}

function checkStyle()
{
	if(getCookie("highContrast")  == "true")
	{
		document.body.style.background = "#ededed";
		document.querySelector("#jumbo").style.background = "#ededed";
		document.querySelector("footer").style.background = "#fafafa";
		changeTextContrast("#333333");
	}
	else
	{
		document.body.style.background = "white";
		document.querySelector("#jumbo").style.background = "white";
		document.querySelector("footer").style.background = "white";
		changeTextContrast("#000000");
	}

	if (getCookie("textSize")  == "small") 
		changeTextSize("14px");
	else
		changeTextSize("150%");
		
}

	

function changeTextContrast(color)
{
	var p = document.querySelectorAll("p, h1, h2, .top-logo");

	for (var i = p.length - 1; i >= 0; i--) 
		p[i].style.color = color;
}

function changeTextSize(sizeChange)
{
	var p = document.querySelectorAll("p, nav");

	
		for (var i = p.length - 1; i >= 0; i--) 
			p[i].style.fontSize = sizeChange;

	document.querySelector("#subtitle").style.fontSize= "21px";
}




