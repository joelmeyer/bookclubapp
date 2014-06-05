<?php


    $title = $_REQUEST['title'];
    $author = $_REQUEST['author'];
    $date = $_REQUEST['pubDate'];
    $description = $_REQUEST['desc'];
    $isbn = $_REQUEST['isbn'];
    /* $insertResult = insertBooks($title, $author, $date, $description, $isbn);
    echo" <table border='1'>";
    echo "<tr><td>";
    if($insertResult == false) echo "Book add Failed!";
    else    echo "Book added successfully!!!";
    echo"</td></tr></table>";*/

function insertBooks($title, $author, $date, $description, $isbn)
{


	//Book query
	$checkBookQuery= "SELECT book_title, book_isbn FROM bc_book WHERE book_title= '$title' AND book_isbn='$isbn'";
	$checkBook= mysql_query($checkBookQuery);
	if(!$checkBook)
	{
	    die('book query failed to execute');
	}

	if(mysql_num_rows($checkBook)>0)
	{
        echo "Book already exists";
        $u = mysql_fetch_array($checkBook);
        print_r($u);
	}
	else
	{
	    $bookq= "INSERT INTO bc_book (book_title, book_date, book_desc, status_id) VALUES('$title','$date','$description', '1')";

        mysql_query($bookq);
    }

    //author query
    $authorArray = str_word_count($author,1);
    $checkAuthorQuery= "SELECT author_fname, author_lname FROM bc_author WHERE author_fname= '$authorArray[0]' AND author_lname='$authorArray[2]'";
	$checkAuthor = mysql_query($checkAuthorQuery);
	if(!$checkAuthor)
	{
	    die('author query failed to execute');
	}

	if(mysql_num_rows($checkAuthor)>0)
	{
        echo "Author already exists";
        $u = mysql_fetch_array($checkAuthor);
        print_r($u);
	}
	else
	{
	    $authorq= "INSERT INTO bc_author (author_fname, author_lname) VALUES('$authorArray[0]','$authorArray[1]')";

        mysql_query($authorq);
    }
    $checkAuthBook= mysql_query("SELECT author_id, book_id FROM bc_auth_book WHERE author_id NOT IN ($checkAuthorQuery) AND book_id NOT IN ($checkBookQuery)");
	if(!$checkAuthBook)
	{
	    die('author query failed to execute');
	}

	if(mysql_num_rows($checkAuthBook)>0)
	{
        echo "Book and Author already exists";
        $u = mysql_fetch_array($checkAuthBook);
        print_r($u);
	}
	else
	{
	    $authorq= "INSERT INTO bc_auth_book (author_id, book_id) VALUES(($checkAuthorQuery),($checkBookQuery))";

        mysql_query($authorq);
    }

}

function openConnection()
{
    include("/var/www/app/config.php");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("bookclub", $con);
    return $con;
}
function queryToArray($q)
{
    $result = $q;
    $rows = array();
    $row = mysql_fetch_assoc($result);
    while($row) {
        $rows[]=$row;
        $row = mysql_fetch_assoc($result);
    }
    return $rows;
}
function query($sql) {
    global $Log;
    $Log->query(preg_replace("/\s+/", ' ', $sql));

    return mysql_query($sql);
}

