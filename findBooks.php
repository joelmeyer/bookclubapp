<?php

function findBooks($search, $start, $count, $type)
{
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
      $author  = $item->dccreator;
      $pub     = $item->dcpublisher;
      $date    = $item->dcdate;
      $desc    = $item->dcdescription;
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
         $thumb, $info, $preview);
   }

   return array(count($results), $results);
}

?>
