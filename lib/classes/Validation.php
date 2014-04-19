<?
require_once("/home/a2590979/lib/sql/GetUserPassword.php");
require_once("/home/a2590979/lib/sql/RegisterNewUser.php");
require_once("/home/a2590979/lib/sql/RegisterNewExistingUser.php");
require_once("/home/a2590979/lib/sql/AddUnregisteredUser.php");
require_once("/home/a2590979/lib/sql/GetUserIdFromEmail.php");

function LogIn($email, $password)
{
	$login = mysql_query("SELECT * FROM `Users` WHERE LOWER(`Email`) = LOWER('" . $email . "') AND `Password` = '" . md5($password) . "'");

	if (mysql_num_rows($login) == 1) 
	{
		// Set username session variable
		$row = mysql_fetch_array($login);
		$_SESSION['Email'] = $email;
		$_SESSION['UserId'] = $row['UserId'];
	}
	else
	{
		$_SESSION['LoginError'] = "Username and password does not match";
	}
	header('Location: www.google.ca');
}

function SignedIn()
{
	if(isset($_SESSION['Email']) && isset($_SESSION['UserId']))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function GetRegistrationStatus($email)
{
	$password = GetUserPassword($email);

	if(mysql_num_rows($password) > 0)
	{
		$row = mysql_fetch_array($password);
		if(!is_null($row['Password']))
		{
			return "REGISTERED";
		}
		else
		{
			return "EXISTS";
		}

	}

	return "UNREGISTERED";

}

function RegisterUser($firstname, $lastname, $email, $password)
{
	$result = RegisterNewUser($firstname, $lastname, $email, $password);
	if($result)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function RegisterExistingUser($firstname, $lastname, $email, $password)
{
	$result = RegisterNewExistingUser($firstname, $lastname, $email, $password);
	if($result)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function RegisterTempUser($email)
{
	$result = AddUnregisteredUser($email);
	if($result)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function GetUserId($email)
{
	$result = GetUserIdFromEmail($email);
	if($result)
	{
		$row = mysql_fetch_array($result);
		return $row['UserId'];
	}
	else
	{
		return 1;
	}
}

?>