<?php
session_start();
session_destroy();
header("Location: index.php"); // Go back to login page
exit();
?>