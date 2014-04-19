<?

function UpdateGroup($groupid, $name, $description, $giftdate)
{
	$query = 
		"UPDATE 
			`GiftGroups`
		SET
			`GroupName` = '$name',
			`Description` = '$description',
			`GiftDate` = '$giftdate'
		WHERE
			`GroupId` = '$groupid'";

	$result = mysql_query($query);

	return $result;
}

function ChangeStatus($groupid, $status)
{
	$query = 
		"UPDATE 
			`GiftGroups`
		SET
			`Status` = '$status'
		WHERE
			`GroupId` = '$groupid'";

	$result = mysql_query($query);

	return $result;
}

?>