<?php
// ------------------  arrays
require ('arr.php');

//-----------------------variables
$i=0;
$stat=array();
$error=0;
$cwd='';

                                            
                                            
                                            //---------------------create function seizure_hard_cases-------------
   function seizure_hard_cases($pattern, $file_log_name, $copy_to_mhi_fn)

   
    {
        global $copy_to_mhi_fn, $source_name;
        $m = preg_match_all($pattern, $copy_to_mhi_fn, $matches);


        foreach ($matches[0] as $key => $value)
        {
        file_put_contents($file_log_name, $matches['seizure'][$key] . ' ' . $source_name . "\n", FILE_APPEND);
        $copy_to_mhi_fn = str_replace($matches['seizure'][$key], '', $copy_to_mhi_fn);
        }
    }
        
        
// -----READING of 'list' last string and send it to $source_name
// if ($manage_list_special===true){$fcwd=}

$list = fopen($fcwd.'list', 'r+');
$size = filesize($fcwd.'list');
echo "$size".' '.$fcwd.'list';

while ($size > 0)//-----------------MAIN LOOP begins----------------------------------------
{
    $cursor=$size-1;
    $symbol = '';
    $source_name = '';
    $counter = 0;//counts  readen bytes
    do //---------reading $source_name from  'list' file---------------------------
    {
        fseek($list, $cursor);


        $symbol = fgetc($list);
        $counter++;

        if ($symbol == chr(10))//replace symbol of line feed
        {
            $symbol = '';
        }

        $cursor--;
//             echo $cursor;
        $source_name = $symbol.$source_name;
    } while ($symbol !==' ' and $cursor >= 0);


    $source_name=trim($source_name);
    //------------------------------------------------------------------------------------------------
//                                  READING FILE

    $text_html = file_get_contents($source_dir.$source_name);
$text_html=strtolower($text_html);


    //- -   -   -   -   -   -   -   -   -   extraction of <table> ... </table>    
    $pattern='#<table>.*?</table>#s';

    preg_match_all($pattern,$text_html,$resul);


if (count($resul[0])>0)
    { 

        foreach($resul[0] as $key => $value)
        {
        $text_html=str_replace($value,'',$text_html);
        }

    file_put_contents($fcwd.'table',$source_name,FILE_APPEND);
    }



    
    //------------------------------------------------------------------------------------------------
//                                  EXTRACTION FROM HTML

    $pattern = '#class="b">(<strong>)?(?<bible_links>(.*?))(</strong)?</a>#su';
    preg_match_all($pattern, $text_html, $results);



//--------------------------------------------------------------------------------------------------
//                                FIRST-HAND HANDLING
    $copy_to_mhi_fn = '';
    foreach ($results['bible_links'] as $key => $value) 
    {
// pre_handling($value);
$value = strtolower($value);
$value=' '.$value.' ';
$value=preg_replace('#</?em>#','',$value);// remove <(/)em>
// $value=preg_replace('#^(\s*[a-z]\s*)$#','',$value);//remove  expressions kind of  "b"> I. </a> 
$value=preg_replace('#^\s{1,2}([123])\s([a-z]{2,15})#su',' \1 \2 ',$value); // problem 4



// echo "*$value*<br>";
$value=preg_replace('#</?strong>#','',$value);// remove <(/)strong>
$value=preg_replace('#</?em>#','',$value);// remove <(/)em>
$value=preg_replace('/<span.*?<\\/span>/',' ',$value);// remove <span>...</span>
$value=preg_replace('#</?sup>#',' ',$value);// remove <(/)em>

$value=preg_replace('/\s(the|see\salso|and|compare|reread|opening)\s/su',' ',$value);


$value=preg_replace('/[.,+;()]/',' ',$value);
$value=preg_replace('#(\]|\[|\))#su',' ',$value);

$value=preg_replace('/\s+jonas\s/su',' jonah ',$value);
$value=preg_replace('/\s+ezechiel\s/su',' ezekiel ',$value);
$value=preg_replace('/\s+osee\s/su',' hoseah ',$value);
$value=preg_replace('/\s+micheas\s/su',' micah',$value);
$value=preg_replace('/\s+isaias\s/su',' isaiah ',$value);
$value=preg_replace('/\s+ezech\s/su',' ezekiel ',$value);
$value=preg_replace('/\s+sophonias\s/su',' zephaniah ',$value);
$value=preg_replace('/\s+hoseah\s/su',' hosea ',$value);
$value=preg_replace('/\s+pss\s/su',' psalms ',$value);

$value=preg_replace('/\s+(first\s|1st\s|i\s)/su',' 1 ',$value);
$value=preg_replace('/\s+(second\s|2nd\s|ii\s)/su',' 2 ',$value);
$value=preg_replace('/\s+(third\s|3rd\s|iii\s)/su',' 3 ',$value);

$value=preg_replace('/(\d{1,3})\s+(through|to)\s/su',' \1- ',$value);
$value=preg_replace('/\s+of\s+?apostles/su',' ',$value);
$value=preg_replace('/\sof\s+?solomon/su',' ',$value);
$value=preg_replace('/\sof\ssol/su',' ',$value);
$value=preg_replace('/\sbook\sof\s/su',' ',$value); 
 

$value=preg_replace('/\s+(chapters|chapter|chaps|chap|chpts|chpt|chs|ch)(\s|[.])/su',' CCC ',$value);

$value=preg_replace('/[-—–−]/u','-',$value);
$value = preg_replace('/([123]) ([a-z]{1,16})/u', ' \1\2 ', $value);
$value=str_replace(':',': ',$value);
$value=str_replace('-','- ',$value);
$value=preg_replace('/(\s*\d{1,3})([abc]\s+)/s','\1 ',$value);


$value=preg_replace('/\s(verses|verse|vers|ver|vss|vs)\s/su','',$value);// remove vs
$value=preg_replace('/\sand\s/su',' ',$value);
$value=preg_replace('/\sone\s/su',' ',$value);
$value=preg_replace('/\s*?superscription\s*?/',' S ',$value);
$value=preg_replace('/\s*?sup\s*?/',' S ',$value);


$value=str_replace(' ',' ',$value);

// $value=preg_replace('#</?span>#','',$value);// remove <span>...</span>

$value=preg_replace('/\s{2,}/su',' ',$value);



$crushed=explode(' ',trim($value));
// /*var_d*/ump($crushed);
// echo "<br > $value <br>";
$tmp_value='';
foreach ($crushed as $piece)
{
$piece_is_bible_name=false;
if(preg_match_all('/^([a-z])$/',$piece))
    {
    $piece=' NB'.$piece.'NE ';//not bible book name begins/ends 
    
    }
if (preg_match_all('/^([123]?[a-z]{2,15})$/',$piece))
    {
    foreach ($handled_name as $handled)
        {
        if(strpos($handled,$piece)===0) 
            {

            $piece_is_bible_name=true;
            $piece=' b'.$flipped[$combined[$handled]].'b ';
            break;
            }
        
        }
        
        if ($piece_is_bible_name===false)
            {

            $piece=' NB'.$piece.'NE ';//not bible book name begins/ends
            }
    }
$tmp_value=$tmp_value.' '.$piece;    
} 
$value=$tmp_value;


$value=preg_replace('/\s*(b(\d|[1-6]\d)b)\s*/',' XX\1YY ', $value);



 $value=preg_replace('/\s{2,}/su',' ',$value);
       
        $copy_to_mhi_fn = $copy_to_mhi_fn . $value;
        
        
        
    }
        $copy_to_mhi_fn=preg_replace('/\s{2,}/su',' ',$copy_to_mhi_fn);
        $copy_to_mhi_fn='BOS '.$copy_to_mhi_fn.' EOS';
        file_put_contents($fcwd.'copy',$source_name.$copy_to_mhi_fn,FILE_APPEND);
    


    

//     $pattern = '/(?<seizure>(b\d{1,2}b(YY)[^XYOEBS]*?CCC.[^XOEBS]*?))(XX|EOS)/s';
    $pattern = '/(?<seizure>(b\d{1,2}b(YY)[^XY]*?CCC.[^X]*?))(XX|EOS)/s';
    $file_log_name = $fcwd . 'chapters';

    seizure_hard_cases($pattern, $file_log_name, $copy_to_mhi_fn); //calling seizure_hard_casesecho "<br>------------------------------------------------------------------------------";
//  echo "<br> after chapters exeption $copy_to_mhi_fn";
    
   $pattern='/(?<seizure>(b\d{1,2}bYY\s\d{1,3}:\s\d{1,3}-\s\d{1,3}:\s\d{1,3}\s).*?(XX|EOS))/s';
   $file_log_name = $fcwd . 'unknown_intervals';
//  echo "<br> after  unknown_intervals  $copy_to_mhi_fn";   
    

    seizure_hard_cases($pattern, $file_log_name, $copy_to_mhi_fn); //calling seizure_hard_cases

    $pattern='/(?<seizure>(b\d{1,2}bYY[^NBEYX]*?NB[a-z]*?NE.*?(XX|EOS)))/s';

    $file_log_name=$fcwd.'hard_cases_words';
    
//      echo "<br> after  no book $copy_to_mhi_fn";   

    seizure_hard_cases($pattern, $file_log_name, $copy_to_mhi_fn); //
    
    //expanding expressions kind of 45- 49   to  45 46 47 48 49
    
    
    $pattern = '/\s(?<b>(\d{1,3}))[-]\s(?<a>(\d{1,3}))/su';
    preg_match_all($pattern, $copy_to_mhi_fn, $matches);
    foreach ($matches['a'] as $key => $value)
    {

        $string = '';

        for ($i = $matches['b'][$key]; $i <= $matches['a'][$key]; $i++)
        {
            $string = $string .' '. $i . ' ';
        }

        $copy_to_mhi_fn = str_replace($matches[0][$key], $string, $copy_to_mhi_fn);
    }
    
//      echo "<br> after  expanding $copy_to_mhi_fn";   
    $copy_to_mhi_fn = str_replace('  ', ' ', $copy_to_mhi_fn);
   
   
   
   //--    -   -   -   -   -   -   -   -   -   -   -complete jude phm philemon  2john 3 john etc 
    if (preg_match_all('/(XX)(b64b|b63b|b57b|b31b|b65b)(YY)([^XYEOSb]*?XX)/',$copy_to_mhi_fn,$matches))
        {
        foreach ($matches[0] as $one_chapter)
            {
            file_put_contents($fcwd.'one_chapter',"$one_chapter $source_name \n",FILE_APPEND);
            }
        }
        
    $pattern='/(b64b|b63b|b57b|b31b|b65b)/';
    $replace='\1 1: ';
    $copy_to_mhi_fn=preg_replace($pattern,$replace,$copy_to_mhi_fn);
   
   
   

    $copy_to_mhi_fn=preg_replace('/\s{2,}/su',' ',$copy_to_mhi_fn);
    $copy_to_mhi_fn = str_replace('XX', '', $copy_to_mhi_fn);
    $copy_to_mhi_fn = str_replace('YY', '', $copy_to_mhi_fn);
$copy_to_mhi_fn = str_replace('BOS', '', $copy_to_mhi_fn);    
$copy_to_mhi_fn = str_replace('EOS', '', $copy_to_mhi_fn);


$copy_to_mhi_fn=preg_replace('/\s{2,}/su',' ',$copy_to_mhi_fn);
// file_put_contents($fcwd.'text',$source_name.'   '.$copy_to_mhi_fn,FILE_APPEND);
// echo $source_name.$copy_to_mhi_fn;
    //------------------------crusher------------------------------------------------
    $crushed = explode(' ', $copy_to_mhi_fn);

    //----------------------------analize and record to statistick array----------------------
    
    
    unset($curr_name,$curr_chapter,$curr_verse);
    $founded_book_name=false;$founded_chapter=false;$founded_verse=false;
//     $c=0;
    $string_to_stat='';
    $string_to_no_book='';
    
foreach ($crushed as $key => $value)
{

if (preg_match_all('/^(b\d{1,2}b)$/', $value,$match))
{
                
                $value=trim($value);
                $curr_name=str_replace('b','',$value);

                settype($curr_name,"integer");

                
                $founded_book_name=true;
                $founded_chapter=false;
                $founded_verse=false;
                continue;
            
}//find books
if (preg_match_all('/^(\d{1,3}[:])$/', $value)) 
                {//f.ch

                    $value = str_replace(':', '', $value);
                    $curr_chapter = $value*1;
                    if ($curr_chapter>$chapters_array[$curr_name] and $founded_book_name===true)//catch if bad chapters, to log
                    {
                    file_put_contents($fcwd.'wrong_identified_books',"book"."b$curr_name b"." $curr_chapter  $source_name \n",FILE_APPEND);
                    $string_to_stat='';//$source_name contain wrong chapters and excepted from main loop";
                    break ;
                    }
                    
                    $founded_chapter=true;$founded_verse=false;
                    
                    
                    if($founded_chapter===true and $founded_book_name===false)
                    {
//                     file_put_contents($fcwd.'un_identified_books',"book"."b$curr_name b"." $curr_chapter  $source_name \n",FILE_APPEND);
                    $string_to_no_book.="$curr_chapter: ";
                    }
                    continue;
                }//f.ch
              
if (preg_match_all('/^(\d{1,3}|S)$/', $value)) 
                {//f.verse
                    if ($value==='S')
                        {
                        $curr_verse=1000;
                        $founded_verse=true;
                        if ($founded_book_name and $founded_chapter) 
                            {
                            file_put_contents($fcwd."superscriptions"," b$curr_name b c$curr_chapter c $curr_verse $source_name \n",FILE_APPEND);
                            }
                        }    
                  else {$curr_verse = $value*1;}
                    $founded_verse=true;
                    
                    if($founded_book_name===false or $founded_chapter===false)
                        {
                        $string_to_no_book.="$curr_verse ";
                        }
//                     if($founded_book_name===false and $founded_chapter===false)
//                         {
//                         $string_to_errors=
//                         }
                        
        
                } //f.verse
                    
if ($founded_book_name and $founded_chapter and $founded_verse) 
                { 

                    $string_to_stat=$string_to_stat.$curr_name.' '.$curr_chapter.' '.$curr_verse.' ';

                    $founded_verse=false;
                }

}//ends foreach

//-------------------------------output statistic to stat file-----------------------------------------
$string_to_no_book=trim($string_to_no_book);
if($string_to_no_book)
    {
     file_put_contents($fcwd.'no_book',"$string_to_no_book $source_name \n",FILE_APPEND);
    }

$string_to_stat=preg_replace('/^(\s{1,})$/','',$string_to_stat);
$string_to_stat=preg_replace('/\s{2,}/su',' ',$string_to_stat);
    file_put_contents($fcwd . 'stat', $string_to_stat,FILE_APPEND);//append content of 'stat' file by new                               //                                          $string_to_stat

$string_to_stat = '';
    
    

    $stat = array();
    $error_log=array();
    $string_to_errors='';
    
    
//---------$------------------deleting $source_name from file 'list'-----------------------------
    
    
    $size = $size - $counter;
    ftruncate($list, $size);
  

}                                   // Ending main loop

echo " <br>all files of directory $source_dir  completely handled";

require('make_array_fn.php');

$sorted=false;

$mixed_stat=make_array_fn ('stat',false,$fcwd);//write result of make_array_fn to array $mixed_stat

require('stat_ksorted_stat.php');



make_array_fn('sorted_stat',true,$fcwd);


require ('html_elements.php');
echo $link_all;
    ?>


  


  
  
