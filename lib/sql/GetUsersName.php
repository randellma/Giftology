<?

function GetUsersName($UserId)
{
	$query = 
	"SELECT 
		`FirstName` 
	FROM 
		`Users` 
	WHERE 
		`UserId` = '$UserId'";

	$FirstName = mysql_query($query);
	$row = mysql_fetch_array($FirstName);
	return $row['FirstName'];
	
}

?>