<?

function GetUserIdFromEmail($email)
{
	$query = 
	"SELECT 
		`UserId`
	FROM 
		`Users`
	WHERE
		`Email` = '".$email."'";	

	$result = mysql_query($query);

	return $result;
}

?>