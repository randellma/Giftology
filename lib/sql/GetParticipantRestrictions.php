<?

function GetParticipantRestrictions($groupid, $userid)
{
	$query = 
		"SELECT
			`User`.`Name` AS `UserName`,
			`Res`.`UserTwoId` AS `UserId`
		FROM
			`GGRestrictions` AS `Res`
			INNER JOIN `GGParticipants` AS `User` 
				ON (`User`.`UserId` = `Res`.`UserTwoId` AND `User`.`GroupId` = '$groupid')
		WHERE
			(`Res`.`UserOneId` = '$userid')
			AND `Res`.`GroupId` = '$groupid'";

	$result = mysql_query($query);

	return $result;
}

?>