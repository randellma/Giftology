<?
require_once("../../../lib/config.php");
require_once("../../../lib/classes/GroupUtilities.php");
require_once("../../../lib/classes/Validation.php");

//Set variables

$name = $_POST['GroupName'];
$description = $_POST['GroupDescription'];
$date = $_POST['GiftDate'];


if(isset($_GET['GroupId'])) //Is an update request
{

	$groupid = $_GET['GroupId'];
	if(IsUserAdmin($groupid))
	{
		if(UpdateExistingGroup($groupid, $name, $description, $date))
		{
			header('Location: ../../groupview.php?GroupId='.$groupid);
		}
		else
		{
			$_SESSION['GenError'] = "Could not update group";
			header('Location: ../../groupview.php?GroupId='.$groupid);
		}
	}
}
else //Is a create group request
{
	$groupid = CreateNewGroup($name, $description, $date, $_SESSION['UserId']);
	if(!empty($groupid))
	{
		//Forward to new group
		header('Location: ../../groupview.php?GroupId='.$groupid);
	}
	else
	{
		$_SESSION['GenError'] = "Could not create group";
		header('Location: ../../grouplist.php=');
	}
}



?>