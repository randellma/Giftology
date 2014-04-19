<?
require_once('config.php');
require_once('classes/Validation.php');

if (!SignedIn())
	{
		header("Location: public_html/default.php");
		exit();
	}
?>