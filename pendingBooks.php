<!doctype html>
<html>
<head>
<script  src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Book Club</title>
</head>
<body>
<script src="scripts/scripts.js"></script>
<div id="header">
    <div class="headfont">
        <a class="head" href="index.php">Goshen Summer Book Club</a>
    </div>
</div>
<div id="navbar">
		<div class="navbarfont">
<a class="navbarbutton" href="index.php">home</a>
<a class="navbarbutton" href="addbooks.php">add book</a>
<a class="navbarbutton" href="pendingbooks.php">pending books</a>
</div>
</div>
<div id="headform">
<form>

 Find book by Name or ISBN:<input name="searchText" id="searchText1" type="text"/>
   <input name="buttonExecute" onclick="bookSearch(document.getElementById('searchText1').value)" type="button" value="Go" />
    <input name="buttonExecute1" onclick="test(document.getElementById('searchText1').value)" type="button" value="test" />
    <table class='form'>
        <tr>
            <td id="searchTxt"> Results:
            </td>
        </tr>
    </table>
</form>
</div>
    </body>
        </html>
