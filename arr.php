<?php

$restrored_name = array(1 => "Genesis", 'Exodus', 'Leviticus', 'Numbers', 'Deuteronomy', 'Joshua', 'Judges', 'Ruth', '1_Samuel', '2_Samuel', '1_Kings', '2_Kings', '1_Chronicles', '2_Chronicles', 'Ezra', 'Nehemiah', 'Esther', 'Job', 'Psalms', 'Proverbs', 'Ecclesiastes', 'Song_of_Solomon', 'Isaiah', 'Jeremiah', 'Lamentations', 'Ezekiel', 'Daniel', 'Hosea', 'Joel', 'Amos', 'Obadiah', 'Jonah', 'Micah', 'Nahum', 'Habakkuk', 'Zephaniah', 'Haggai', 'Zechariah', 'Malachi', 'Matthew', 'Mark', 'Luke', 'John', 'Acts', 'Romans', '1_Corinthians', '2_Corinthians', 'Galatians', 'Ephesians', 'Philippians', 'Colossians', '1_Thessalonians', '2_Thessalonians', '1_Timothy', '2_Timothy', 'Titus', 'Philemon', 'Hebrews', 'James', '1_Peter', '2_Peter', '1_John', '2_John', '3_John', 'Jude', 'Revelation');

$chapters_array=array(1=>50,40,27,36,34,24,21,4,31,24,22,25,29,36,10,13,10,42,150,31,12,8,66,52,5,48,12,14,3,9,1,4,7,3,3,3,2,14,4,28,16,24,21,28,16,16,13,6,6,4,4,5,3,6,4,3,1,13,5,5,3,5,1,1,1,22);
// var_dump($chapters_array);




foreach ($restrored_name as $key => $value) 
    {
//     echo gettype($key);
    $value = str_replace(' ', ' ', $value);
    $restrored_name[$key] = $value;
//         echo " $value ";

//     $value = str_replace(' ', '', $value);
    $value = strtolower($value);
    $value = str_replace('_', '', $value);
    $handled_name[$key] = $value;
    }

$flipped=array_flip($restrored_name);
// $book_chapters=array_combine($flipped,);


$flipped['Canticles']=22;
$flipped['Apocalypse']=66;
$combined = array_combine($handled_name, $restrored_name);//create array of twoarrays values:keys=>values
$combined['canticles'] = 'Song_of_Solomon';
$combined['apocalypse'] = 'Revelation';
$combined['jg']='Judges';
$combined['mr']='Mark';
$combined['mt']='Matthew';
$combined['jas']='James';
$combined['php']='Philippians';
$combined['phm']='Philemon';
$combined['jn']='John';
$combined['lk']='Luke';
$combined['mk']='Mark';

$handled_name[67] = 'canticles';

$handled_name[68]='jg';
$handled_name[69]='mt';
$handled_name[70]='mr';
$handled_name[71]='jas';
$handled_name[72]='php';
$handled_name[73]='phm';
$handled_name[74] = 'apocalypse';
$handled_name[75]='jn';
$handled_name[76]='lk';
$handled_name[77]='mk';

$number_of_handled_names=count($handled_name);
$empty=null; 
// echo $number_of_handled_names;
// var_dump($_++flipped);
// var_dump($handled_name);
?>
