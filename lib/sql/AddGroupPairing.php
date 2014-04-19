<?
function AddGroupPairing($groupid, $userid, $matcheduserid)
{
	$query = 
		"INSERT INTO
			`GGPairings`
		VALUES
			('$groupid', '$userid', '$matcheduserid')";
	$result = mysql_query($query);
	return $result;

}

?>