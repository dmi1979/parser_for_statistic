<?php
$options=array();
$options=glob(getcwd().'/parsed:*');

foreach ($options as $option)
    {
    echo "<br><input type=radio required name=parsed_dir value=$option> $option </input>  ";
    }    
?>
