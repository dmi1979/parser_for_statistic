<?php


//TODO avoid appendindig to sorted_stat and text in case user hadn't changed name of result dir

$btn=null;
$parsed_dir=null;
require('html_elements.php');
echo ' <body><form action="remove.php" method=GET>';
require ('parsed_dir_list_select.php');
echo '<br><input type=checkbox name=continue value=w > continue unfinished ?</input>';
echo '<br> <button name=btn value=remove require> remove/continue </button>';
echo '</form>';

$btn=$_GET['btn'];
$parsed_dir=$_GET['parsed_dir'];
$continue=$_GET['continue'];
if ($continue=='w')
{
$fcwd=$parsed_dir.'/';
$source_dir=file_get_contents($parsed_dir.'/info');


echo "$parsed_dir <br> $fcwd" ;
echo $source_dir;
require('new_html_parser.php');

}
else

{
if ($parsed_dir!='')
    {

 array_map('unlink', glob($parsed_dir.'/*'));
 rmdir ($parsed_dir);
    }
}
echo $_GET['continue'];
// echo $btn,$parsed_dir;
echo $link_all;
echo '</body>';

?>
