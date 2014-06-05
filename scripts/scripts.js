function bookSearchold(searchterm)
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

function bookSearch(searchterm)
{
	var googleAPI = "https://www.googleapis.com/books/v1/volumes?q="+searchterm;

$.getJSON(googleAPI, function (response) {
    console.log("JSON Data: " + response.items);
    
    for (var i = 0; i < response.items.length; i++) {
        var item = response.items[i];
        // in production code, item.text should have the HTML entities escaped.
        document.getElementById("searchTxt").innerHTML += "<tr><td class='radio'><input type='radio' value='"+i+"' name='bookRadio'>" +
        	"</td><td id='title"+i+"'>" + item.volumeInfo.title + 
        	"</td><td id='author"+i+"'>" + item.volumeInfo.authors + 
        	"</td><td id='pub"+i+"'>" + item.volumeInfo.publisher + 
        	"</td><td id='pudDate"+i+"'>" + item.volumeInfo.publishedDate + 
        	"</td><td id='pageCount"+i+"'>" + item.volumeInfo.pageCount + 
        	"</td><td id='printType"+i+"'>" + item.volumeInfo.printType + 
        	"</td><td id='isbn"+i+"'>" + item.volumeInfo.industryIdentifiers[0].identifier +
        	"</td><td id='desc"+i+"'>" + item.volumeInfo.description + 
        	"</td><td><img src=" + item.volumeInfo.imageLinks.smallThumbnail+ "></td></tr>";

      }
      document.getElementById("searchTxt").innerHTML += "<tr><td><input name='addBookButtonExecute' onclick='findChecked()' type='button' value='Add Book'></td></tr>";
});



}

function findChecked()
{
 	var selectedValue = $('input[name="bookRadio"]:checked').val();
  	
  	if(selectedValue != null)
  	{
  		addBook(selectedValue);
  		/*var bookAdded = 
  		if(bookAdded)
  		{
  			//navigate to home page
  		}
  		else
  		{
  			alert("Book could not be added!")
  		}*/
  	}
    else
    {
    	alert("No book is selected!");
    } 
}
function addBook(selectedValue)
{
	var title = $('td[id="title'+selectedValue+'"]').text();
	var author = $('td[id="author'+selectedValue+'"]').text();
	var pub = $('td[id="pub'+selectedValue+'"]').text();
	var pubDate = $('td[id="pubDate'+selectedValue+'"]').text();
	var pageCount = $('td[id="pageCount'+selectedValue+'"]').text();
	var printType = $('td[id="printType'+selectedValue+'"]').text();
	var isbn = $('td[id="isbn'+selectedValue+'"]').text();
	var desc = $('td[id="desc'+selectedValue+'"]').text();
    var dataString = 'pub=' + pub + '&title=' + title + '&author=' + author + '&pubDate=' + pubDate + '&pageCount=' + pageCount + '&printType=' + printType + '&isbn=' + isbn + '&desc=' + desc;
    alert(encodeURI(dataString));
	$.ajax({
        type: "POST",
        url: "scripts/insertBook.php",
        data: dataString,
        dataType: "json",
        success: function (result, status, xResponse) {
            var message = result.msg;
            var err = result.err;
            var now = new Date();
            if (message != null) {
                if (autosaveMode) {
                    $('#submit_btn').attr({
                        'value': 'Yadda saxlanıldı ' + now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds()
                    });
                } else {
                    $.notifyBar({
                        cls: "success",
                        html: message + ' ' + now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds()
                    });
                }
            }
            if (err != null) {
                $.notifyBar({
                    cls: "error",
                    html: err
                });
            }
        }
    });
}


