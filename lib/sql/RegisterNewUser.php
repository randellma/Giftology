<?

function RegisterNewUser($firstname, $lastname, $email, $password)
{
	$query = 
	"INSERT INTO 
		`Users` (`Email`, `Password`, `FirstName`, `LastName`)
	VALUES 
		(LOWER('".$email."'), '".md5($password)."','".$firstname."', '".$lastname."')";

	$result = mysql_query(($query));
	return $result;
}

?>