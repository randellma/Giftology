<?

function GetGroupParticipants($groupId)
{
	$grouplist = mysql_query("
								SELECT 
									`GGPar`.`Name`
									, `GGPar`.`ShippingInfo`
									, `Groups`.`GiftDate`
									, `GGPar`.`Status`
									, `Users`.`Email`
									, `Users`.`UserId`
								FROM  
									`GiftGroups` AS  `Groups` 
									INNER JOIN  `GGParticipants` AS  `GGPar` ON (`Groups`.`GroupId` =  `GGPar`.`GroupId`) 
									INNER JOIN `Users` ON( `Users`.`UserId` = `GGPar`.`UserId`)
								WHERE  
									`Groups`.`GroupId` =  '".$_GET['GroupId']."'
								ORDER BY `Groups`.`GiftDate`");
	
	return $grouplist;
}

?>