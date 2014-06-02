!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Students</title>
</head>
<body>
<div id="header">
    <div class="headfont">
<a class="head" href="tstudents.php"> Goshen College</a>
    </div>
</div>
    <div id="headform">
<form action="index.php" method="get">
<table class='form'>
<tr>
   <td> Find book by Name or ISBN:</td>
   <td> <input type="text" name="booksearch"</td>
 <td> <input type=submit value="Go"></td>
</tr>
</table>
</form>
</div>

<div class="left">
 <?php
    include("findBooks.php");
    $uby= $_GET['booksearch'];
    $by=mysql_real_escape_string($uby);
    $results = findBooks($by, 1, 20, 'none');
    echo" <table border='1'>";
    echo "<tr><td><font face='Arial' size='2'>Google Books results " .
     "for: <b>$by</b>:<br /><br /><td><tr>";
    if (!$result[0]) echo "No books found for $search.";
    else
    {
      foreach($result[1] as $book)
      {
      echo "<tr><td><img src='$book[5]' align='left' border='1'>";
      echo "<a href='$book[6]'>$book[0]</a> ($book[2], " .
           "$book[3])<br />$book[4]";
      if ($book[7]) echo " (<a href='$book[7]'>preview</a>)";
      echo "<br clear='left'/><br /><td><tr>";
      }
    }
    echo"</table>";
?>
</div>
    </body>
        </html>
