<?php

// Inialize session
session_start();
unset($_SESSION['Email']);
header('Location: ../default.php');

?>