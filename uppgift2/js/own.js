//Author: Eric Nordlund

function login()
{
	//Create a prompt to get the user name and save the login status to a cookie.
	var login_name = prompt("Enter login name"); //Promt that saves entered text to login_name
	if (login_name.length > 0) 
	{
		document.cookie = "userName=" + login_name + "; path=/"; //Sets a session cookie with the login name
		checkLogin();
	}
}


//Checks the login cookie and chanes the login status.
function checkLogin()
{
	if (getCookie("userName"))
	document.getElementById("login_box").innerHTML = "Logged in User: " + getCookie("userName");
}

//Removes the login cookie
function logout()
{
	document.cookie = "userName=" + getCookie("userName") + "; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT"; //Change the exp.date to way earlier than todays date.
	document.getElementById("login_box").innerHTML = "Login"; //Change the login status.
}

//Gets a certain cookies value
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

//Kontrollerar att samtliga fält som krävs är ifylda tillräckligt mycket. (Görs även genom HTML5)
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
		alert("Ni måste fylla i samtliga fält markerade med *"); //Meddelande om att det är dåligt ifyllt.
		return false;
	}
}

//Hämtar ett GET-value baserat på dess namn.
function getFormValue(name)
{
	var values = "&" + window.location.search.substring(1); //Hämta strängen
	var search = values.split("&" + name + "=") //Gör till array
	
	if(search.length > 1) //Kontrollerar att det fanns värden i strängen.
	return barToText(search.pop().split("&").shift()) // gets the right part of the array and fix and email-string
	else
	return "NULL";	
}

//Funktion för att konvertera tecken till rätt typ av text i GET-värden
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

//Ändrar kontrasten på sidan genom att byta ut cookies.
function toggleContrast()
{
	if(getCookie("highContrast")  == "true") //Kontrollera nuvarande cookie
		document.cookie = "highContrast=false; path=/";
	else
		document.cookie = "highContrast=true; path=/";
	checkStyle(); //Byt stil på sidan.
}

//Ändrar textstorlekescookies.
function toggleTextSize()
{
	if(getCookie("textSize")  == "large")
		document.cookie = "textSize=small; path=/";
	else //Default utan cookie
		document.cookie = "textSize=large; path=/";
	checkStyle();
}

//Byter storlek på typsnittet och färger
function checkStyle()
{
	if(getCookie("highContrast")  == "true") //kontrollerar cookiestatus
	{
		document.body.style.background = "#ededed";
		var obje = document.querySelector("#jumbo"); //Specialobjekt på framsidan
		if(obje != null) //Kontrollerar om användaren befinner sig på hemsidan.
			document.querySelector(".jumbotron").style.background = "#ededed";
		document.querySelector("footer").style.background = "#fafafa";
		changeTextContrast("#333333");
	}
	else //Samma funktion som ovan fast åt andra hållet.
	{
		document.body.style.background = "#FFFFFF";
		var obje = document.querySelector("#jumbo");
		if(obje != null)
		document.querySelector("#jumbo").style.background = "#FFFFFF";
		document.querySelector("footer").style.background = "#FFFFFF";
		changeTextContrast("#000000");
	}

	if (getCookie("textSize")  == "small") 
		changeTextSize("14px");
	else
		changeTextSize("150%");
		
}

	
//Byter färg på texten
function changeTextContrast(color)
{
	var p = document.querySelectorAll("p, h1, h2, .top-logo"); //Hämtar samtliga element som listas till en array

	for (var i = p.length - 1; i >= 0; i--) //Går igenom samtliga element i p och byter färg.
		p[i].style.color = color;
}

//Byter textstorlek
function changeTextSize(sizeChange)
{
	var p = document.querySelectorAll("p, nav"); //Hämtar relevanta element
	
		for (var i = p.length - 1; i >= 0; i--) //Byter textstorlek
			p[i].style.fontSize = sizeChange;

	//Specialföränding av objekt i relation till objekt på framsidan
	var obje = document.querySelector("#subtitle");
		if(obje != null)
	document.querySelector("#subtitle").style.fontSize= "21px";
}

//Komprimerar en textsträng
function truncateText(text)
{
	if(text.length > 200) //Maxlängden på texten
	{
		document.write("<div id='truncated'>" + text.substring(0, 200) + "... <br /> <a href='#' onclick='expandText()'>More</a></div>"); //Skapar en div med kortversionen.
		document.write("<div id='truncatedOriginal' style='display: none;'>" + text + "</div>"); //Skapar en gömd div med orginalversionen
	}
	else
		document.write(text); //Om texten redan är kort skrivs den helt enkelt ut.
}

//Gömmer kortversinen av en text och skriver ut hela.
function expandText()
{
	document.querySelector("#truncated").style.display = "none";
	document.querySelector("#truncatedOriginal").style.display = "block";
}