<?php

require_once('config.php');

//Var to hold maximum number of results per page
$per_page = 5;

//Var to indicate which page to show
$page = 1;

//Create a new Query
$q = new Query;

//Add some conditions to the Query
$q->add('status', 'active');

//Create a new QueryPager.  
//The last parameter is optional and indicates a class to be used when returning results.
$pager = new QueryPager($q, $per_page, $page, 'Drivers');

//Get the total number of pages this Query could return
$total_pages = $pager->getPageCount();

//Check if the current page is the last page.  Returns true or false.
$last = $pager->isLastPage();

//Check if the current page is the first page.  Returns true or false.
$first = $pager->isFirstPage();

//Get total number of records this Query could return
$total_records = $pager->getTotal();

/*
 * Get the records for the selected page.  Because we passed the string "Book" in the constructor,
 * the pager will load the results into an array of Book objects.  If you don't pass a string with the
 * class name, this will return a PDOStatement
 */
$books = $pager->fetchPage();

//Loop through Book objects and print their Title values
foreach($books as $b){
    echo $b->getName().'<br/>';
}

?>