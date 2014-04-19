<?

function GetGiftGroupList($userId)
{
	$grouplist = mysql_query("
								SELECT 
									`Groups`.`GroupName`
									, `Groups`.`Description`
									, `Groups`.`GiftDate`
									, `Groups`.`Status`
									, `Groups`.`GroupId`
								FROM  
									`GiftGroups` AS  `Groups` 
									INNER JOIN  `GGParticipants` AS  `GGPar` ON (  `Groups`.`GroupId` =  `GGPar`.`GroupId` ) 
								WHERE  
									`GGPar`.`UserId` =  '".$_SESSION['UserId']."'
								ORDER BY `Groups`.`GiftDate` DESC");
								
	return $grouplist;
}

?>