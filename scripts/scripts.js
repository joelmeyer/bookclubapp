function bookSearch(searchterm)
{
	alert(searchterm);
	if(searchterm=="")
	{
		document.getElementById("searchTxt").innerHTML="";
		return;
	}
	if(window.XMLHttpRequest)
	{
	 	var xmlhttp = new XMLHttpRequest();
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
			document.getElementById("searchTxt").innerHTML=xmlhttp.responseText;
	}
	xmlhttp.open("GET", "/scripts/findBooks.php?searchText="+searchterm, true);
	xmlhttp.send();
}

function test()
{
	var x = 5;
	alert("is this working?" + x);

}