<?

function GetUserInfo($groupid, $userid)
{
	$query = 
		"SELECT 
			`Email`,
			`Name`,
			`GroupName`
		FROM
			`GGParticipants` AS `Par`
			INNER JOIN `Users` ON (`Par`.`UserId` = `Users`.`UserId`)
			INNER JOIN `GiftGroups` AS `Group` ON (`Par`.`GroupId` = `Group`.`GroupId`)
		WHERE
			`Par`.`UserId` = '$userid'
			AND `Par`.`GroupId` = '$groupid'";

	$result = mysql_query($query);

	return $result;
}

?>