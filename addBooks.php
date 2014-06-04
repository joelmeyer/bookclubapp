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
        <a href="index.php">Goshen Summer Book Club</a>
    </div>
</div>

<div id="navbar">
		<a class="navbarbutton" href="index.php">home</a>
		<a class="navbarbutton" href="addbooks.php">add book</a>
		<a class="navbarbutton" href="pendingbooks.php">pending books</a>
</div>

<div id="booksearch">
	<form>Find book by Name or ISBN: <input name="searchText" id="searchText1" type="text"/>
   <input name="buttonExecute" onclick="newTest(document.getElementById('searchText1').value)" type="button" value="Go" />
   </form>
</div>

<div id="filter">
<select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select>
<select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select>
<select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select>
<select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select>
</div>

<div id="results">
<form id="formBookRadio">
    <table id="searchTxt" class='form'>

    </table>
</form>
</div>
</div>
</body>
</html>
