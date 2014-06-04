<?php
    ini_set("log_errors", 1);
    ini_set("error_log", "/Users/Joel/bookclubapp/scripts/errors/php-error.log");
   // Plug-in 79: Search Google Books
   //
   // This plug-in takes a search query and returns matching
   // books from books.google.com. Upon success it returns
   // a two elemet array, the first being the number of books
   // returned and the second is an array whose elements are
   // each sub-arrays containing these details: 1) Title, 2)
   // Author, 3) Publisher, 4)Date, 5) Description, 6) Info
   // URL, 7) Preview URL. on failure it returns a single
   // element array with the value FALSE. It requires these
   // arguments:
   //
   //    $search: A search query
   //    $start:  The first result to return
   //    $count:  The maximum number of results to return
   //    $type:   If 'none' return all books, if 'partial'
   //             return books with partial previews, if
   //             'full' only return books where the entire
   //             book can be read
   error_log("Hello, errors!");
   $search = $_GET['searchText'];
    $results = findBooks($search, 1, 20, 'none');
    echo" <table border='1'>";
    echo "<tr><td><font face='Arial' size='2'>Google Books results " .
     "for: <b>$search</b>:<br /><br /><td><tr>";
    if (count($results)== null && count($results) == 0) echo "No books found for $search.";
    else
    {
      foreach($results as list($title, $isbn))
      {
      echo "<tr><td>";
      echo "$title, $isbn";
      echo "</td></tr>";
      }
    }
    echo"</table>";


function findBooks($search, $start, $count, $type)
{
   $results = array();
   $url     = 'http://books.google.com/books/feeds/volumes?' .
              'q=' . rawurlencode($search) . '&start-index=' .
              "$start&max-results=$count&min-viewability=" .
              "$type";
   $xml     = @file_get_contents($url);
   if (!strlen($xml)) return array(FALSE);

   $xml  = str_replace('dc:', 'dc', $xml);
   $sxml = simplexml_load_string($xml);

   foreach($sxml->entry as $item)
   {
      $title   = $item->title;
      $isbn    = $item->dcidentifier[1];

      if($isbn == null)
      {
        $isbn = 'null value';
      }

      $results[] = array($title,$isbn);
   }

   return $results;
}

?>
