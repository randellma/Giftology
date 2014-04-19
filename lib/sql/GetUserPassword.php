<?

function GetUserPassword($email)
{
	$query = 
	"SELECT 
		`Password` 
	FROM 
		`Users` 
	WHERE 
		LOWER(`Email`) = LOWER('$email')";

	$password = mysql_query($query);
	
	return $password;
	
}

?>