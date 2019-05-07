<?php
session_start();
include 'header.php';
session_destroy();

echo '<script type="text/javascript">',
		 'location.replace("listerFilms.php");;',
		 '</script>';

include 'footer.php';

?>


