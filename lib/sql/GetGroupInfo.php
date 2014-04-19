<?
function GetGroupInfo($groupId)
{
	$groupInfo = mysql_query("
									SELECT  
										`Groups`.`GroupName` ,  
										`Groups`.`Description` ,  
										`Groups`.`GiftDate` ,  
										`Groups`.`Status` 
									FROM  
										`GiftGroups` AS  `Groups` 
									WHERE  
										`Groups`.`GroupId` =  '".$groupId."'");
										
	return $groupInfo;							
}
?>