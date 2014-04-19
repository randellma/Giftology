<?
require_once("/home/a2590979/lib/config.php");
require_once("/home/a2590979/lib/sql/GetGroupAdmins.php");
require_once("/home/a2590979/lib/sql/RemoveGroupParticipant.php");
require_once("/home/a2590979/lib/sql/AddGroupParticipant.php");
require_once("/home/a2590979/lib/sql/CreateGroup.php");
require_once("/home/a2590979/lib/sql/UpdateGroup.php");
require_once("/home/a2590979/lib/sql/GetGroupParticipants.php");
require_once("/home/a2590979/lib/sql/AddGroupPairing.php");
require_once("/home/a2590979/lib/sql/GetUserInfo.php");
require_once("/home/a2590979/lib/sql/GetUsersName.php");


function IsUserAdmin($groupid)
{
	$admins = GetGroupAdmins($groupid);
	if($admins)
	{
		while($row = mysql_fetch_array($admins))
		{
			if($row['UserId'] == $_SESSION['UserId'])
			{
				return true;
			}
		}
	}

	return false;
}

function IsUserMember($groupid)
{
	$grouplist = GetGroupParticipants($groupid); 

	while($row = mysql_fetch_array($grouplist))
	{
		if($row['UserId'] = $_SESSION['UserId'])
		{
			return true;
		}
	}
	return false;
}

function AddParticipant($groupid, $name, $userid, $shipping, $admin)
{

	//If user not already in group	echo "GroupUtils";
	return AddGroupParticipant($groupid, $userid, $name, $shipping, $admin);

}

function RemoveParticipant($groupid, $userid)
{
	return RemoveGroupParticipant($_GET['GroupId'], $_GET['UserId']);
}

function CreateNewGroup($name, $description, $giftdate, $userid)
{
	return CreateGroup($name, $description, $giftdate, $userid, GetUsersName($userid));
	//return mysql_insert_id();
}

function UpdateExistingGroup($groupid, $name, $description, $giftdate)
{
	return UpdateGroup($groupid, $name, $description, $giftdate);
}

function AddPairing($groupid, $picker, $pair)
{
	//Add the pairing
	AddGroupPairing($groupid, $picker, $pair);

	//Send the email
	$pickerinfo = mysql_fetch_array(GetUserInfo($groupid, $picker));
	$pairinfo = mysql_fetch_array(GetUserInfo($groupid, $pair));
	if($pickerinfo && $pair)
	{
		//Send Email
		//echo $pickerinfo['Name'] . " has " . $pairinfo['Name'];
		//echo "<br />";
		mail($pickerinfo['Email'], 
			"Your Gifting Group Match", 
			"Your match for gifting group \"".$pickerinfo['GroupName']."\" is ".$pairinfo['Name'].". Good Luck!");
	}
	
}

function GetUsersNameFromEmail($UserId)
{
	$result = GetUsersName($UserId);
	if($result)
	{
		$row = mysql_fetch_array($result);
		return $row['FirstName'];
	}
	else return null;
}


?>