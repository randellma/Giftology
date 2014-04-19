<?
	require_once("../../lib/config.php");
	require_once("../../lib/classes/Validation.php");
	$_SESSION['RegError'] = "";
	$email = $_POST['Email'];
	$firstname = $_POST['FirstName'];
	$lastname = $lastname;
	$password = $_POST['Password'];
	
	//Check all fiels exist
	 if(empty($email) || empty($password) || !$email || !$password)
	 {
		//No email or password inputted
		$_SESSION['RegError'] = "You must enter an email and password";
		header('Location: ../default.php');
		exit();
	 }
	 if($password != $_POST['RetypedPassword'])
	 {
		//Send back to default since passwords don't match
		$_SESSION['RegError'] = "Passwords do not match";
		header('Location: ../default.php');
		exit();
	 }
	 
	 $status = GetRegistrationStatus($email);

	 switch($status)
	 {
	 	case "UNREGISTERED":
	 		if(RegisterUser($firstname, $lastname, $email, $password))
	 		{
	 			LogIn($email, $password);
	 		}
	 		else
	 		{	
	 			$_SESSION['RegError'] = "Unable to register";
	 		}
	 		break;
	 	case "EXISTS":
	 		if(RegisterExistingUser($firstname, $lastname, $email, $password))
	 		{
	 			LogIn($email, $password);
	 		}
	 		else
 			{	
	 			$_SESSION['RegError'] = "Unable to register";
	 		}
	 		break;
	 	case "REGISTERED":
			$_SESSION['RegError'] = "That email is already registered";
	 		break;
	 	default:
	 		$_SESSION['RegError'] = "Unable to register";
	 		break;
	 }

	header('Location: ../default.php');
?>