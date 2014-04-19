<?

function AddGroupRestriction($groupid, $userid1, $userid2)
{
	$query = 
	"INSERT INTO
		`GGRestrictions`
	SELECT
		`GiftGroups`.`GroupId`, '$userid1', '$userid2', '0'
	FROM
		`GiftGroups`
	WHERE
		`GiftGroups`.`GroupId` = '$groupid'
		AND NOT EXISTS(
			SELECT 
				null
			FROM 
				`GGRestrictions`
			WHERE
				`GGRestrictions`.`GroupId` = '$groupid'
				AND((`UserOneId` = $userid1 AND `UserTwoId` = $userid2)
					OR (`UserOneId` = $userid2 AND `UserTwoId` = $userid1))";
	$query = 
	"INSERT INTO
		`GGRestrictions`
	VALUES
		('$groupid', '$userid1', '$userid2', '0')";

	$result = mysql_query($query);

	return $result;
}

?>