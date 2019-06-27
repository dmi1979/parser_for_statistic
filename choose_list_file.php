<html>
<head> 
<title>FORM</title>
<meta charset=utf-8>
</head>
<body>
<?php $cwd=getcwd(); ?>
<FORM  ACTION="choose_list_file.php" METHOD=get>
<!-- <input type=file name='directory' multiple accept=text/html> <br> -->
<input type=text name='source_dir_list' required> choose file with list of files </input> <br>
<input type=text name='directory_name' required> give name for directory with statistic in <?php echo $cwd; 

?> </input> <br>
<input type=text name='source_dir' required> choose source directory </input> <br>
 <?php 
$source_dir_list=$_GET['source_dir_list'];
$directory_name=$_GET['directory_name'];
$source_dir=$_GET['source_dir'];
 if ($source_dir_list and $directory_name)
    {
        $fcwd=$cwd.'/parsed_list:'.$directory_name.'/';
    mkdir($fcwd);
    copy ($source_dir_list,$fcwd.'list');
    }
    
require ('html_elements.php');
echo $btn_send,$btn_clear;
echo '</FORM>';
require('new_html_parser.php');
echo $link_all;



?>



</body>
</html> 
