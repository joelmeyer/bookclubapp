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
function addBook(title, author, date, description, isbn)
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
	xmlhttp.open("GET", "/scripts/insertBook.php?title="+title+"&author="+author+"&date="+date+"&description="+description+"&isbn="+isbn, true);
	xmlhttp.send();



}
function test(searchterm)
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
	xmlhttp.open("GET", "/scripts/test.php?searchText="+searchterm, true);
	xmlhttp.send();

}