<html>
<head> 
<title>FORM</title>
<meta charset=utf-8>
</head>
<body>
<?php $cwd=getcwd(); ?>
<FORM  ACTION="create_list_fn.php" METHOD=get>
<!-- <input type=file name='directory' multiple accept=text/html> <br> -->
<input type=text name='source_dir' required> set directory for scanning </input> <br>
<input type=text name='directory' required> give name for directory with statistic in <?php echo $cwd; ?> </input> <br>

 <?php 
require ('html_elements.php');
echo $btn_send,$btn_clear;
echo '</FORM>';
// require('new_html_parser.php');
echo $link_all;
?>



</body>
</html> 
