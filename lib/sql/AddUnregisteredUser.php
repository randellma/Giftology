<?

function AddUnregisteredUser($email)
{
	$query = 
	"INSERT INTO 
		`Users` (`Email`)
	VALUES
		('".$email."')";

	$result = mysql_query($query);

	return $result;
}

?>