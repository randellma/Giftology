<?php
	//Initialize components
	require_once("../lib/config.php");
	require_once("../lib/classes/Validation.php");
	require_once("../lib/sql/GetGiftGroupList.php");
	
	
	require_once("../lib/templates/header.php");
	
	//Verify signed in to view this page
	if (!SignedIn())
	{
		header("Location: default.php");
		exit();
	}
?>
		
<div id="Content">
	<div id="MainPanel">
		<div id="MainPanelContent">
			<h2>Your Gift Groups</h2>
			<br /><br />
			<?
				$grouplist = GetGiftGroupList($_SESSION['UserId']); 
				
				echo "<table class=\"GroupListTable\">
						<tr>
						<th>Group Name</th>
						<th>Description</th>
						<th>Gift Date</th>
						<th>Status</th>
						</tr>";	
				if(mysql_num_rows($grouplist) > 0)	
				{
					while($row = mysql_fetch_array($grouplist))
					  {
						  echo "<tr onclick=\"document.location = 'groupview.php?GroupId=".$row['GroupId']."';\">";
						  echo "<td>" . $row['GroupName'] . "</td>";
						  echo "<td>" . $row['Description'] . "</td>";
						  echo "<td>" . $row['GiftDate'] . "</td>";		
						  echo "<td>" . $row['Status'] . "</td>";					
						  echo "</tr>";
					  }
					echo "</table>";
				}
				else
				{

					echo "</table>";
					echo "<br /><p>You are not part of any groups. Why don't you go ahead and create one?</p>";
				}
			?>	
			
		</div>
		<div id="MainPanelControl">
			<a href="/groupcreate.php">Create Group</a>
		</div>		
	</div>
			
<?
	require_once("../lib/templates/footer.php");
?>