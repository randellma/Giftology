<?
	
require_once("../../../lib/config.php");
require_once("../../../lib/classes/GroupUtilities.php");

if(IsUserAdmin($_GET['GroupId']))
{
	RemoveParticipant($_GET['GroupId'], $_GET['UserId']);
	header('Location: ../../groupview.php?GroupId='.$_GET['GroupId']);
}
else
{
	$_SESSION['GenError'] = "User does not have sufficient privleges to perform that action";
	header('Location: ../../groupview.php?GroupId='.$_GET['GroupId']);
}

?>