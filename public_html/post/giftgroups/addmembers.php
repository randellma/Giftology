<?
	
require_once("../../../lib/config.php");
require_once("../../../lib/classes/GroupUtilities.php");
require_once("../../../lib/classes/Validation.php");


$groupid = $_GET['GroupId'];

if(!IsUserAdmin($groupid))
{
	$_SESSION['GenError'] = "User does not have sufficient privleges to perform that action";
	header('Location: ../../groupview.php?GroupId='.$groupid);
	exit();
}
	$i = 1;
	while(isset($_POST['Email'.$i])) //While there are posted variabls to use
	{
		//Set row Variabls
		$email = $_POST['Email'.$i];
		$name = $_POST['Name'.$i];
		$shipping = $_POST['Shipping'.$i];
		$admin = (isset($_POST['Admin'.$i]) ? 1:0);

		if(!empty($email)) //Only add if email is not empty
		{
			//Check if email has a userid associated
			$regStatus = GetRegistrationStatus($email);
			switch ($regStatus) 
			{
				case 'UNREGISTERED':
					RegisterTempUser($email);
				default:
					$userid = GetUserId($email);
					AddParticipant($groupid, $name, $userid, $shipping, $admin);
					mail($email, 
						"Gift Group Invitation", 
						"Hey, you've been invited to participate in a Giftology exchange group! \n \n Visit gifter.comli.com and register with this email address to view the group");
					break;
			}
		}
		$i++;
	}
	header('Location: ../../groupview.php?GroupId='.$groupid);



?>