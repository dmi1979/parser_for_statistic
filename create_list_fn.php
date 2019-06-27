<?php
require('html_elements.php');
$cwd=getcwd();
$source_dir=$_GET['source_dir'];
$source_dir=str_replace('file://','',$source_dir);
$directory=$_GET['directory'];
if (!strpos($directory,'/',-1)){$directory=$directory.'/';}
// if (!strpos($source_dir,'/',-1)){$source_dir=$source_dir.'/';}
if (strpos($source_dir,'.html'))
    {
    if (!strpos($directory,'/',-1)){$directory=$directory.'/';}
    $fcwd=$cwd.'/parsed:'.$directory;
    mkdir($fcwd);
    file_put_contents($fcwd.'info',dirname($source_dir));
    file_put_contents($fcwd.'list',basename($source_dir));
    file_put_contents($fcwd.'file_name',basename($source_dir));
    $source_dir=dirname($source_dir);
//     echo "**$source_dir**";
    if (!strpos($source_dir,'/',-1)){$source_dir=$source_dir.'/';}
    }

    else
    {
    if (!strpos($source_dir,'/',-1)){$source_dir=$source_dir.'/';}
    $fcwd=$cwd.'/parsed:'.$directory;
    mkdir($fcwd);
    file_put_contents($fcwd.'info',$source_dir);
    $list_array = glob($source_dir.'*html');
//     var_dump($list_array);
    foreach ($list_array as $filename) 
        {
//         echo "$filename  ";
//         echo "<br>M1<br>";
        file_put_contents($fcwd.'list', basename($filename) . ' ', FILE_APPEND);
        }
    echo "created list of files(file 'list' in  $fcwd  directory)";
    }  

require ('new_html_parser.php');
echo $link_all;


?>
