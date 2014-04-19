<?

function GetGroupAdmins($groupid)
{

	$query = 
		"SELECT
			`participants`.`UserId`
		FROM
			`GiftGroups` AS `groups`
			INNER JOIN `GGParticipants` AS `participants` ON (`groups`.`GroupId` = `participants`.`GroupId`)
		WHERE
			`groups`.`GroupId` = ".$groupid."
			AND `participants`.`Admin` = '1'";

	$admins = mysql_query($query);
								
	return $admins;
}


?>