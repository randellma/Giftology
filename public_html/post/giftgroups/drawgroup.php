<?
require_once("../../../lib/config.php");
require_once("../../../lib/classes/GroupUtilities.php");
require_once("../../../lib/classes/Validation.php");
require_once("../../../lib/sql/GetGroupParticipants.php");
require_once("../../../lib/sql/GetParticipantRestrictions.php");
require_once("../../../lib/sql/AddGroupPairing.php");


if(!isset($_GET['GroupId']))
{
	$_SESSION['GenError'] = "Could not draw group";
	header('Location: ../../default.php');
	exit();
}

$groupid = $_GET['GroupId'];

if(!IsUserAdmin($groupid))
{
	$_SESSION['GenError'] = "User does not have sufficient privleges to perform that action";
	header('Location: ../../groupview.php?GroupId='.$groupid);
	exit();
}

$participants = GetGroupParticipants($groupid);

for($i=0; $i<10; $i++)
{
	//Get the array of participants
	mysql_data_seek($participants, 0);
	$i = 0;
	while($row = mysql_fetch_array($participants))
  	{
  		$par[$i] = $row['UserId'];
  		$i++;
	}

	$p1 = array_values($par);
	$p2 = array_values($par);
	shuffle($p1); //Shuffle the hat
	shuffle($p2); //Shuffle the pickers


	$matchable = true;
	while(count($p1) > 0)
	{
		$picker = array_shift($p2); //Choose first picker
		$restrictions = GetParticipantRestrictions($groupid, $picker);

		$draw = $first = array_shift($p1); //Choose first draw
		if($draw == $picker || CheckRestrictions($restrictions, $draw)) 
		{ //If the match is no good, loop through more
			do
			{
				array_push($p1, $draw); //put the last draw back in
				$draw = array_shift($p1); //Draw a new one

				if($draw == $first) //If you reach the first draw again then it's not matchable
				{
					$matchable = false;
					break;
				}
			}while($draw == $picker || CheckRestrictions($restrictions, $draw));
		}	//Loop as long as it's still potentially matchable, not pickers name is drawn and 
			//drawn name is not in pickers restrictions

		if($matchable) //If it's still potentially matchable add the pairing just found
		{
			$pair[$picker] = $draw;
		}
		else //If it't matchable break and try again
		{
			echo "Ball";
			break;
		}
	}
	//Save pairs to database
	if (is_array($pair))
	{
		foreach($pair as $key => $value)
		{
			AddPairing($groupid, $key, $value);
		}
		break;
	}
}

function CheckRestrictions($r, $uid)
{
	while($row = mysql_fetch_array($r))
	{
		if($row['UserId'] == $uid)
		{
			return true;
		}
	}
	return false;
}


header('Location: ../../groupview.php?GroupId='.$groupid);

?>