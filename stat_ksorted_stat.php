<?php
$string_sorted_stat='';

ksort ($mixed_stat,SORT_NUMERIC);

foreach($mixed_stat as $book_number=>$ch_vs_fr) 
    {


ksort($ch_vs_fr,SORT_NUMERIC);
    
    foreach($ch_vs_fr as $chapter=>$vs_fr)
        {
        ksort($vs_fr,SORT_NUMERIC);
        foreach ($vs_fr as $verse=>$freq)
            {

                $string_sorted_stat=$string_sorted_stat.' '.$book_number.' '.$chapter.' '.$verse.' '.$freq.' ';

                
            }
        }
    }
    $string_sorted_stat=preg_replace('/\s{2,}/su',' ',$string_sorted_stat);
    file_put_contents($fcwd.'sorted_stat',trim($string_sorted_stat).' ');
?>
