<?php
require ('arr.php');
 echo "<br>  book-$book, chapter-$chapter,verse-$verse,lower_limit-$lower_limit,upper_limit-$upper_limit,top-$top,  statfile in - $parsed_dir <br>";   

 $res=$stat_books;

    
    
if ($book_number)
    

    {
    $res=array_filter($res,function ($arg){global $book_number;return $arg===$book_number;});
    }
    
    $res=array_intersect_key($stat_chapters,$res);
    

if ($chapter)
    {
    $res=array_filter($res,function ($arg){global $chapter;return $arg===$chapter;});
    }
    
    $res=array_intersect_key($stat_verse,$res);

    
if ($verse)
    {
    $res=array_filter($res,function ($arg){global $verse;return $arg===$verse;});
    }
 
    $res=array_intersect_key($stat_freq,$res);




if ($lower_limit )
    {
    $res=array_filter($res,function ($arg){global $lower_limit;return $arg>=$lower_limit;});
    }
    
if ($upper_limit )
    {
    $res=array_filter($res,function ($arg){global $upper_limit;return $arg<=$upper_limit;});
    }

   //                                                   'top' 
    
if ($top)
    {
    $res_freq=array_count_values ($res);// counts every value  $freq  of $res($verse=>$freq) and put     results to array $res_freq ($value=>frequency))

    krsort($res_freq);//array of frequencies 


    $res_freq=array_slice($res_freq,0,$top,true);

    $res_freq=array_keys($res_freq);


    $res=array_intersect($res,$res_freq);

    
    }

//------------------sorting by frequency----------------------------    
$res_arsorted=$res;
    arsort($res_arsorted);

unset($chapters_array[0]);
    
    //                                                  OUTPUT
function output($array_output)
{
global $stat_books,$book_number,$restrored_name,$stat_chapters,$stat_verse,$chapters_array;

foreach ($array_output as $pos=>$freq)
    { 
    $book_number=$stat_books[$pos];
    if ($chapters_array[$book_number]<$stat_chapters[$pos])
        {
        echo ">>ERROR,chapter wrong,must be". $chapters_array[$book_number];
        }
    
    echo '|'.$restrored_name[$book_number].'|'.$stat_chapters[$pos].'|'.$stat_verse[$pos].'|'.$freq.'|   ';
    
    }

}

output($res);
echo "<br>by frequency >>>> <br>";
output($res_arsorted);    



    
    
?>

