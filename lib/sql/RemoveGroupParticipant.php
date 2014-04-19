<?

function RemoveGroupParticipant($groupid, $userid)
{

	$query = 
	"DELETE FROM 
		`GGParticipants` 
	WHERE 
		`UserId` = ".$userid." 
		AND `GroupId` = ".$groupid." ";

	mysql_query($query);
								
	return;
}


?>