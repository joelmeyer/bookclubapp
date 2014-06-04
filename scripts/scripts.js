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
	$.ajax({
	    dataType: "jsonp",
	    url: 'https://www.googleapis.com/books/v1/volumes',
	    data: {q: searchterm},
	    crossDomain: true,
	    success: function(data){
	        console.info('Google Books API retrieved:');
	        console.info(data);
	    },
	    error: function(){
	        console.log(arguments)
    }
});
	xmlhttp.open("GET", "/scripts/test.php?searchText="+searchterm, true);
	xmlhttp.send();
}

function newTest(searchterm)
{
	var googleAPI = "https://www.googleapis.com/books/v1/volumes?q="+searchterm;

$.getJSON(googleAPI, function (response) {
    console.log("JSON Data: " + response.items);
    
    for (var i = 0; i < response.items.length; i++) {
        var item = response.items[i];
        // in production code, item.text should have the HTML entities escaped.
        document.getElementById("searchTxt").innerHTML += "<tr><td><input type='radio' value='"+i+"' name='bookRadio'></td><td id='book"+i+"'>" + item.volumeInfo.title +"</td>";
        document.getElementById("searchTxt").innerHTML += "<td><img src=" + item.volumeInfo.imageLinks.smallThumbnail+ "></td></tr>";
      }
      document.getElementById("searchTxt").innerHTML += "<tr><td><input name='addBookButtonExecute' onclick='findChecked()' type='button' value='Add Book'></td></tr>";
});



}

function findChecked()
{

 	var selectedValue = $('input[name="bookRadio"]:checked').val();
     /*var form = document.getElementById('formBookRadio'); 
     for(var i = 0; i < form.bookRadio.length; i++)
     {
          if(form.bookRadio[i].checked)
          {
          var selectedValue = form.bookRadio[i].id;
          }
 
     }
 	
 */
 	var bookSelected = $('td[id="book'+selectedValue+'"]').text();
     alert(selectedValue +"and the book is" +bookSelected);
     /*if(selectedValue != null)
     {
     	document.getElementById();

     }
     */
}



