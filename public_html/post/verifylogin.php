<?php

require_once("../../lib/config.php");
require_once("../../lib/classes/Validation.php");

$email = strtoLOWER($_POST['Email']);
$password = $_POST['Password'];

LogIn($email, $password);

// Jump to login page
header('Location: ../grouplist.php');


?>