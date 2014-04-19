<?

function RemoveGroupRestriction($groupid, $userid1, $userid2)
{
	$query = 
	"DELETE FROM
		`GGRestrictions`
	WHERE
		`GroupId` = '$groupid'
		AND((`UserOneId` = '$userid1' AND `UserTwoId` = '$userid2')
			OR(`UserOneId` = '$userid2' AND `UserTwoId` = '$userid1'))";

	$result = mysql_query($query);

	return $result;
}

function RemoveAllGroupRestrictions($groupid, $userid1)
{
	$query = 
	"DELETE FROM
		`GGRestrictions`
	WHERE
		`GroupId` = '$groupid'
		AND((`UserOneId` = '$userid1') OR (`UserTwoId` = '$userid1'))";

	$result = mysql_query($query);

	return $result;
}

?>