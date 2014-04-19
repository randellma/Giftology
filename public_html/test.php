<?

	require_once("../lib/config.php");
	require_once("../lib/classes/Validation.php");
	require_once("../lib/sql/GetParticipantRestrictions.php");



$restrictions = GetParticipantRestrictions('8', '1');
$row = mysql_fetch_array($restrictions);

if(CheckRestrictions($restrictions, '29'))
{
	echo "Bool";
}
else
{
	echo "Yaya";
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

?>