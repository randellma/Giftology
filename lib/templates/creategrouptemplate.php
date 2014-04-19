<?
	require_once("../lib/sql/GetGroupInfo.php");
	require_once("../lib/classes/GroupUtilities.php");

	//Set defaults when no groupid named
	$postlink = "/post/giftgroups/createupdategroup.php";
	$groupname = "";
	$groupdescription = "";
	$giftdate = "2012-12-25";

	//If want to pre-populate with a groups info
	if(isset($_GET['GroupId']))
	{
		$groupid = $_GET['GroupId'];
		if(IsUserAdmin($groupid)) //If user is an admin, continue
		{
			$groupdetails = GetGroupInfo($groupid); 
			$groupdata = mysql_fetch_array($groupdetails);

			$groupname = $groupdata['GroupName'];
			$groupdescription = $groupdata['Description'];
			$giftdate = $groupdata['GiftDate'];

			$postlink = $postlink."?GroupId=".$groupid;
		}
		else
		{
			$_SESSION['GenError'] = "You are unauthorized to view that page";
			return;
		}
	}
?>

<link rel="stylesheet" type="text/css" href="src/stylesheets/creategroup.css" />

<div class="creategroupform">
<form method="POST" name="input" action=<?echo "\"".$postlink."\""?> method="get">
				<h3>Group Name:</h3>
					<input type="text" name="GroupName" size="84" value=<?echo "\"".$groupname."\""?> /><br /><br />

				<h3>Group Description:</h3> 
					<textarea cols="60" rows="5" name="GroupDescription" ><?echo $groupdescription ?></textarea><br /><br />

				<h3>Gift Date</h3>
					<input type="date" name="GiftDate" value=<?echo "\"".$giftdate."\""?>><br /><br />

				<!--<h3>Privacy</h3>
					<input type="radio" name="Privacy" value="Invite" checked="checked"> Invite Only (Invite required to join)<br />
					<input type="radio" name="Privacy" value="Open"> Open (Anyone can join)<br />
					<input type="radio" name="Privacy" value="Closed"> Closed (Must be invited to view)<br />
				<br />

				<h3>Options</h3>
					<input type="checkbox" name="VerifyInvite">Require --> 


				<input type="submit" value="Submit" />
</form>
</div>