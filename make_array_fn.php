<?php

function make_array_fn ($file_to_read,$sorted,$fcwd)
    {
    $array_to_create=array();
//     global $fcwd;


    if($sorted!=true) 
        {
        $step=3;
        $array_to_create=array();
        }
    else
        {
        global $stat_books,$stat_chapters,$stat_verse,$stat_freq;
        $step=4;
        $stat_books[0]=0;
        $stat_chapters[0]=0;
        $stat_verse[0]=0;
        $stat_freq[0]=0;
        } // this boolean redirects to other branch of script,to create 4 different one-dimensional arrays
    
    
    $string_from_file_to_read=file_get_contents($fcwd.$file_to_read);
    $string_from_file_to_read=preg_replace('#\s{1,5}#',' ',$string_from_file_to_read);
    $string_from_file_to_read=trim($string_from_file_to_read);
//     file_put_contents($fcwd.'test',$string_from_file_to_read,FILE_APPEND);
    //*/check previous operations 
    $crushed_readen=explode(' ',$string_from_file_to_read);
//     if ($sorted!==true) {echo "<br> from make_array_fn :";var_dump($crushed_readen);}



    $crushed_readen=array_filter($crushed_readen,'strlen');
     $count=count($crushed_readen);

    for ($key=0;$key<=$count-1;$key=$key+$step)
        {
$book_number=$crushed_readen[$key];
// echo "*$book_number* ";
        $book_number=$crushed_readen[$key];settype($book_number,"integer");
// echo "-$book_number";        
        $chapter=$crushed_readen[$key+1];settype($chapter,"integer");
        $verse=$crushed_readen[$key+2];settype($verse,"integer");
        if($sorted==true) 
            {
                $freq=$crushed_readen[$key+3];settype($freq,"integer");
            

        
            
                $stat_books[]=$book_number;
                $stat_chapters[]=$chapter;
                $stat_verse[]=$verse;
                $stat_freq[]=$freq;
            }
            else 
        {
        if (!isset($array_to_create[$book_number][$chapter][$verse]))
            {
            $array_to_create[$book_number][$chapter][$verse]=0;
            }
        $array_to_create[$book_number][$chapter][$verse]++;
        }
    

        }
        if ($sorted!=true) {unset ($array_to_create[0][0][0]);}
        else
        {
        unset($stat_books[0]);
        unset($stat_chapters[0]);
        unset($stat_verse[0]);
        unset($stat_freq[0]);
        }
        echo "created  array<br>--------------------------------------<br>";

 
    return $array_to_create;
    }
    ?>
