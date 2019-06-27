<?php
require ('arr.php');
echo '<form method=get action=form_handler.php> 
            <select size=5 name=book >';
    echo    "<option>  $empty </option> ";
foreach ($restrored_name as $value)
    {
    echo "<option> $value </option> ";//list of bible books in <select>
    
    }
    echo "<option> $empty </option> ";
echo '</select>  

<input type=text size=1 name=chapter> chapter </input>
<input type=text  size=1 name=verse >  verse </input> 
<input type=text  size=1  name=lower_limit  >  lower limit of frequency </input>
<input type=text  size=1 name=upper_limit > upper limit of frequency </input>

<input type=text size = 1   name=top > top X </input>'; 
require ('html_elements.php');

require('parsed_dir_list_select.php');
echo $btn_send,$btn_clear;
echo '</form>';
echo $link_all;

    ?>
