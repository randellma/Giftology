<?
require_once("../../../lib/config.php");
require_once("../../../lib/classes/GroupUtilities.php");
require_once("../../../lib/classes/Validation.php");
require_once("../../../lib/sql/AddGroupRestriction.php");

$groupid = $_POST['GroupId'];
$userid1 = $_POST['UserId1'];
$userid2 = $_POST['UserId2'];

if(!empty($userid2) && !empty($userid1) && !empty($groupid))
{
	if(!AddGroupRestriction($groupid, $userid1, $userid2))
	{
		$_SESSION['GenError'] = "Could not add restriction";
	}
}

	header('Location: ../../groupview.php?GroupId='.$groupid."&Tab=restrictions");

?>