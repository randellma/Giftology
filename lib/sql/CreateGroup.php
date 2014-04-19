<?

function CreateGroup($name, $description, $giftdate, $userid, $usersname)
{
	$query = 
		"INSERT INTO 
			`GiftGroups`
			(`GroupName`, `Description`, `GiftDate`, `Status`)
		VALUES
			('$name', '$description', '$giftdate', 'Undrawn')";


	$result = mysql_query($query);
	$ret = mysql_insert_id();

	$query = 
	"
	INSERT INTO 
		`GGParticipants`
	VALUES 
		('$ret', '$userid', '$usersname', '', '1', 'Added')";

	$result = mysql_query($query);

	return $ret;
}

?>