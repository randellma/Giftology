<?
//Adds specified participant if they aren't already part of the group
function AddGroupParticipant($groupid, $userid, $name, $shippinginfo, $admin)
{
	$query = 
	"
	INSERT INTO 
		`GGParticipants`
	SELECT 
		`GroupId`, '$userid', '$name', '$shippinginfo', '$admin', 'Added'
	FROM
		`GGParticipants`
	WHERE
		`GroupId` =  '$groupid'
		AND NOT EXISTS(
			SELECT 
				null 
			FROM 
				`GGParticipants` 
			WHERE 
				`UserId` = '$userid' 
				AND `GroupId` = '$groupid')
	LIMIT 1";

	$result = mysql_query($query);

	return $result;
}

?>