<?php

require ('make_array_fn.php');
require('arr.php');
require('html_elements.php');

//                                              validation of data                                              
$errs=array();

$parsed_dir=$_GET['parsed_dir'];
unset ($_GET['parsed_dir']);
$book=$_GET['book'];
unset ($_GET['book']);
foreach ($_GET as $key=>$value)
    {
        $$key=$value;

    if(($$key) and !is_numeric($$key) ) 
        {
       $errs[]='error > field '. $key.' is '. $value.' and  is not numeric';
        }
    else 
        {
            $$key=($$key)*1;
            echo "<br> $key";
            echo gettype($$key).$$key;
        }
        
    if (($$key) and !is_numeric($$key) and $$key<0)
        {
        $errs[]=" error >value of field $key is $value and negative number ";
        }
    }
    
    
if ($lower_limit>$upper_limit and is_numeric($lower_limit) and is_numeric($upper_limit))
    {
    $errs[]="error > upper_limit  $upper_limit is lesser lower_limit $lower_limit";
    }
    
    
   
//main regulator
if (count($errs)==0)
    {
    $file_to_read='sorted_stat';
    $sorted=true;
    make_array_fn('sorted_stat',true,$parsed_dir.'/');
    $book_number=$flipped[$book];
    require ('filter.php');
    }
else 
    {
        echo " <br>wrong input:<br>";
    foreach($errs as $value)
        {
        echo "<br> $value";
        }
    echo "<br> $link_all";
    }   

?>
