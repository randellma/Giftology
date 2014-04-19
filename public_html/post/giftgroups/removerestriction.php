<?
require_once("../../../lib/config.php");
require_once("../../../lib/classes/GroupUtilities.php");
require_once("../../../lib/classes/Validation.php");
require_once("../../../lib/sql/RemoveGroupRestriction.php");

$groupid = $_GET['GroupId'];
$userid1 = $_GET['UserOneId'];
$userid2 = $_GET['UserTwoId'];

if(isset($_GET['UserTwoId']))
{
	if(!empty($userid2) && !empty($userid1) && !empty($groupid))
	{
		if(!RemoveGroupRestriction($groupid, $userid1, $userid2))
		{
			$_SESSION['GenError'] = "Could not remove restriction";
		}
	}
}
else
{
	if(!empty($userid1) && !empty($groupid))
	{
		if(!RemoveAllGroupRestrictions($groupid, $userid1))
		{
			$_SESSION['GenError'] = "Could not remove restriction";
		}
	}
}

	header('Location: ../../groupview.php?GroupId='.$groupid."&Tab=restrictions");

?>