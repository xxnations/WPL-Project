<?php

session_start();

session_unset();
/* Redirect browser */
header("Location: index.php");
exit;
?>