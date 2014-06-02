<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Book Club</title>
</head>
<body>
<div id="header">
    <div class="headfont">
<a class="head" href="tstudents.php"> Goshen Summer Book Club</a>
    </div>
</div>
    <div id="headform">
<form action="index.php" method="get">
<table class='form'>
<tr>
     <td> Find book by Name or ISBN:</td>
     <td> <input type="text" name="booksearch"</td>
     <td> <input type=submit value="Go"></td>
     <td> <?php
        $uby= $_GET['booksearch'];
        $by=mysql_real_escape_string($uby);
        echo "$by";
        ?>
    </td>
</tr>
</table>
</form>
</div>

<div class="left">
 <?php
    include("/var/www/bookclubapp/scripts/findBooks.php");
    $uby= $_GET['booksearch'];
    $results = findBooks($by, 1, 20, 'none');
    echo" <table border='1'>";
    echo "<tr><td><font face='Arial' size='2'>Google Books results " .
     "for: <b>$uby</b>:<br /><br /><td><tr>";
    if (count($results)== null || count($results) == 0) echo "No books found for $search.";
    else
    {
      foreach($results as list($title, $author, $pub, $date, $desc, $thumb, $info, $preview))
      {
      echo "<tr><td><img src='$thumb' align='left' border='1'>";
      echo "<a href='$info'>$title</a> ($author, " .
           "$date)<br />$desc";
      if ($preview) echo " (<a href='$preview'>preview</a>)";
      echo "<br clear='left'/><br /><td><tr>";
      }
    }
    echo"</table>";
?>
</div>
    </body>
        </html>
