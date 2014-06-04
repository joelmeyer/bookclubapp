<?php
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
    include_once "base.php";

    set_include_path("/Users/Joel/google-api-php-client/src/" . PATH_SEPARATOR . get_include_path());
    require_once 'Google/Client.php';
    require_once 'Google/Service/Books.php';
   $search = $_GET['searchText'];
    $results = findBookTEST($search);//, 1, 20, 'none');
    //echo" <table border='1'>";
    //echo "<tr><td><font face='Arial' size='2'>Google Books results " .
     //"for: <b>$search</b>:<br /><br /><td><tr>";


    if (count($results)== null && count($results) == 0) echo "No books found for $search.";
    else
    {
        foreach ($results as $item)
        {
            echo $item['items']['volumeInfo']['title'], "<br /> \n<td><tr>";
        }
      //foreach($results as list($title, $author, $pub, $date, $desc, $thumb, $info, $preview, $isbn))
      //{
      //echo "<tr><td><input type='radio' name='bookRadio'><img src='$thumb' align='left' border='1'>";
      //echo "<a href='$info'>$title</a> ($author, " .
      //     "$date, $isbn)<br />$desc,";
      //if ($preview) echo " (<a href='$preview'>preview</a>)";
      //echo "<br clear='left'/><br /><td><tr>";
      //}
    }
    echo"<input name='addBookButtonExecute' onclick='test(document.getElementById('searchText1').value)' type='button' value='Add Book'></table>";


function findBooks($search, $start, $count, $type)
{

   $results = array();
   $key = 'AIzaSyB7tO_ZxdxCsUCbvgx32NhfAYpTJ5BUS4c';
   $url     = 'http://books.google.com/books/feeds/volumes?' .
              'q=' . rawurlencode($search) . '&start-index=' .
              "$start&max-results=$count&min-viewability=" .
              "$type";
   $newurl = 'https://www.googleapis.com/books/v1/volumes?q=$search&key=$key';
   $xml     = @file_get_contents($newurl);
   if (!strlen($xml)) return array(FALSE);

   $xml  = str_replace('dc:', 'dc', $xml);
   $sxml = simplexml_load_string($xml);

   foreach($sxml->entry as $item)
   {
      $title   = $item->title;
      $author  = $item->dccreator;
      $pub     = $item->dcpublisher;
      $date    = $item->dcdate;
      $desc    = $item->dcdescription;
      $isbn    = $item->dcidentifier[1];
      $thumb   = $item->link[0]['href'];
      $info    = $item->link[1]['href'];
      $preview = $item->link[2]['href'];

      if (!strlen($pub))
         $pub = $author;
      if ($preview ==
         'http://www.google.com/books/feeds/users/me/volumes')
         $preview = FALSE;
      if (!strlen($desc))
         $desc = '(No description)';
      if (!strstr($thumb, '&sig='))
         $thumb = 'http://books.google.com/googlebooks/' .
            'images/no_cover_thumb.gif';

      $results[] = array($title, $author, $pub, $date, $desc,
         $thumb, $info, $preview, $isbn);
   }

   return $results;
}
function findBookTESTf($search)
{

    $client = new Google_Client();
    $client->setApplicationName("Client_Library_Examples");
    $apiKey = "AIzaSyB7tO_ZxdxCsUCbvgx32NhfAYpTJ5BUS4c";
    if ($apiKey != 'AIzaSyB7tO_ZxdxCsUCbvgx32NhfAYpTJ5BUS4c') {
      echo missingApiKeyWarning();
    }
    $client->setDeveloperKey($apiKey);

    $service = new Google_Service_Books($client);
    echo $search;
    $optParams = array();//'maxResults' => '10');
    $results = $service->volumes->listVolumes('$search', $optParams);
    error_log(serialize($results));
    return $results;
}

function findBookTEST($search)
{

   $results = array();
   $key = 'AIzaSyB7tO_ZxdxCsUCbvgx32NhfAYpTJ5BUS4c';

   $newurl = "https://www.googleapis.com/books/v1/volumes?q=$search&key=$key";
   error_log($newurl);
   $xml     = json_decode(file_get_contents($newurl));
   //var_dump($xml);
   return $xml;
}
?>
