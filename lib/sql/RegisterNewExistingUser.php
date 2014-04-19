<?

function RegisterNewExistingUser($firstname, $lastname, $email, $password)
{
	$password = md5($password);
	$query = 
	"UPDATE 
		`Users` 
	SET
		`Password` = '$password',
		`FirstName` = '$firstname',
		`LastName` = '$lastname'
	WHERE
		`Email` = LOWER('$email')
	";

	$result = mysql_query($query);
	return $result;
}

?>