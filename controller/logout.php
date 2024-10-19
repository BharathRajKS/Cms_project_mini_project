<?php
session_start();
session_destroy(); 
header("Location: ../view/Home_view.php"); 
exit(); 
?>
