<?php
	//Initialize components
	require_once("../lib/config.php");
	require_once("../lib/classes/Validation.php");
	require_once("../lib/sql/GetGroupInfo.php");
	require_once("../lib/sql/GetGroupParticipants.php");
	require_once("../lib/sql/GetParticipantRestrictions.php");
	
	require_once("../lib/templates/header.php");
	
	
	//Verify signed in to view this page
	if (!SignedIn())
	{
		header("Location: default.php");
		exit();
	}
?>

<script>
function PageLoad()
{

	<?
	if(isset($_GET['Tab']))
	{
		$tab = $_GET['Tab'];
		switch ($tab) {
			case 'participants':
				echo "ParticipantsTab()";
				break;
			case 'invite':
				echo "InviteTab()";
				break;
			case 'restrictions':
				echo "RestrictionsTab()";
				break;
			case 'edit':
				echo "EditTab()";
				break;
			default:
				echo "ParticipantsTab()";
				break;
		}
	}
	else
	{
		echo "ParticipantsTab()";
	}
	?>
}

function ParticipantsTab()
{
	document.getElementById("ParticipantsTable").style.display = 'block';
	document.getElementById("InviteTable").style.display = 'none';
	document.getElementById("EditTable").style.display = 'none';
	document.getElementById("RestrictionsTable").style.display = 'none';
	document.getElementById("ParticipantsTab").className = 'SelectedTab';
	document.getElementById("InviteTab").className = '';
	document.getElementById("EditTab").className = '';
	document.getElementById("RestrictionsTab").className = '';
	
}

function InviteTab()
{
	document.getElementById("ParticipantsTable").style.display = 'none';
	document.getElementById("InviteTable").style.display = 'block';
	document.getElementById("EditTable").style.display = 'none';
	document.getElementById("RestrictionsTable").style.display = 'none';
	document.getElementById("ParticipantsTab").className = '';
	document.getElementById("InviteTab").className = 'SelectedTab';
	document.getElementById("EditTab").className = '';
	document.getElementById("RestrictionsTab").className = '';
}

function EditTab()
{
	document.getElementById("ParticipantsTable").style.display = 'none';
	document.getElementById("InviteTable").style.display = 'none';
	document.getElementById("EditTable").style.display = 'block';
	document.getElementById("RestrictionsTable").style.display = 'none';
	document.getElementById("ParticipantsTab").className = '';
	document.getElementById("InviteTab").className = '';
	document.getElementById("EditTab").className = 'SelectedTab';
	document.getElementById("RestrictionsTab").className = '';
}

function RestrictionsTab()
{
	document.getElementById("ParticipantsTable").style.display = 'none';
	document.getElementById("InviteTable").style.display = 'none';
	document.getElementById("EditTable").style.display = 'none';
	document.getElementById("RestrictionsTable").style.display = 'block';
	document.getElementById("ParticipantsTab").className = '';
	document.getElementById("InviteTab").className = '';
	document.getElementById("EditTab").className = '';
	document.getElementById("RestrictionsTab").className = 'SelectedTab';
}

</script>
		
<div id="Content">
	<div id="MainPanel">
		<div id="MainPanelContent">
			<?
				$groupdetails = GetGroupInfo($_GET['GroupId']); 
				
				$groupdata = mysql_fetch_array($groupdetails);
				
				echo 	"<h2>".$groupdata['GroupName']."</h2>
						<br />
						<p>".$groupdata['Description']."</p>
						<br />";
						
				
				echo "<br />";
				
				echo "<div class=\"ViewTab\">
					<a href=\"#\" id=\"ParticipantsTab\" onclick=\"ParticipantsTab()\";>Participants</a>
					<a href=\"#\" id=\"InviteTab\" onclick=\"InviteTab()\";>Add Members</a>
					<a href=\"#\" id=\"RestrictionsTab\" onclick=\"RestrictionsTab()\";>Restrictions</a>
					<a href=\"#\" id=\"EditTab\" onclick=\"EditTab()\";>Edit Group</a>
				</div>";

				echo "<div id = \"ParticipantsTable\">
					<table class=\"GroupParticipantsTable\">
						<tr>
						<th>Participant Name</th>
						<th>Email</th>
						<th>Status</th>
						<th></th>
						</tr>";				

				$grouplist = GetGroupParticipants($_GET['GroupId']); 	
				while($row = mysql_fetch_array($grouplist))
				  {
					  echo "<tr>";
					  echo "<td>" . $row['Name'] ."</td>";
					  echo "<td>" . $row['Email'] . "</td>";		
					  echo "<td>" . $row['Status'] . "</td>";
					  echo "<td>
					  			<a href='/post/giftgroups/removemember.php?GroupId=".$_GET['GroupId']."&UserId=".$row['UserId']."'>Remove</a>
				  			</td>";
					  echo "</tr>";
				  }
				
				echo "</table></div>";
				
				echo "<div id = \"InviteTable\" style=\"display=none;\">
						<form method=\"POST\" name=\"input\" action=\"/post/giftgroups/addmembers.php?GroupId=".$_GET['GroupId']."\" method=\"get\">";
				
					echo "<table class=\"GroupAddTable\">
						<tr>
						<th>Participant Name</th>
						<th>Email</th>
						<th>Shipping Info</th>
						<th>Admin</th>
						</tr>";					
						for ($i=1; $i<=10; $i++)
						{
						echo"<tr>
							<td><input type=\"text\" name=\"Name".$i."\" /></td>
							<td><input type=\"text\" name=\"Email".$i."\" /></td>
							<td><input type=\"text\" name=\"Shipping".$i."\" /></td>
							<td><input type=\"checkbox\" name=\"Admin".$i."\" value=\"1\" /></td>
							</tr>";
						}
				
					echo "</table> <br />";
				echo "<input type=\"submit\" value=\"Add!\" />
						</form>
					</div>";

				echo "<div id=\"EditTable\">";
					echo 	"<table class=\"GroupEditTable\">
								<tr>
									<th></th>
								</tr>
							</table><br />";

					require_once("../lib/templates/creategrouptemplate.php");
				echo "</div>";

				echo "<div id=\"RestrictionsTable\">";
					echo "<table class=\"GroupRestrictionsTable\">
								<table class=\"GroupRestrictionsTable\">
					 	<tr>
							<th>Participant Name</th>
							<th>Restrictions</th>
							<th></th>
						</tr>";				
				
				$grouplist1 = GetGroupParticipants($_GET['GroupId']);
				$grouplist2 = GetGroupParticipants($_GET['GroupId']);
				while($row = mysql_fetch_array($grouplist1))
				  {
			  		$name1 = $row['Name'];
	  				$userid1 = $row['UserId'];
				  	echo "<tr>";
				 	echo "<td>" . $name1 ."</td>";

				  	echo 
					  	"<td>";
				 	$restrictions = GetParticipantRestrictions($_GET['GroupId'], $userid1);
				 	if($restrictions)
				 	{
				 		while($resrow = mysql_fetch_array($restrictions))
				 		{
				 			$resname = $resrow['UserName'];//($resrow['UserOneId'] == $userid1 ? $resrow['UserTwoName'] : $resrow['UserOneName']);
				 			$resuserid = $resrow['UserId'];// ($resrow['UserOneId'] == $userid1 ? $resrow['UserTwoId'] : $resrow['UserOneId']);
				 			echo "<p>".$resname." 
				 					<a class=\"removerestriction\" 
				 						href=\"/post/giftgroups/removerestriction.php?GroupId=".$_GET['GroupId']."&UserOneId=".$userid1."&UserTwoId=".$resuserid."\">
				 							Remove
		 							</a>
	 							</p>";
				 		}
				 	}
				  	echo
					  		"<form method=\"POST\" name=\"input\" action=\"/post/giftgroups/addrestriction.php\" method=\"get\">
				  				<input type=\"hidden\" name=\"UserId1\" value=\"".$userid1."\">
					  			<input type=\"hidden\" name=\"GroupId\" value=\"".$_GET['GroupId']."\">

						  		<select name=\"UserId2\">";
								  	mysql_data_seek($grouplist2, 0);
								  	echo "<option value=\"\">Select Restriction</option>";
								  	while($row2 = mysql_fetch_array($grouplist2))
								  	{
								  		$userid2 = $row2['UserId'];
								  		$name2 = $row2['Name'];
								  		$email2 = $row2['Email'];
								  		if($userid1 != $userid2) 
								  		{
								  			echo "<option value=\"".$userid2."\">".$name2." - ".$email2."</option>";
								  		}
							  		}
				  			echo "</select>
				  			<input type=\"submit\" value=\"Add\" />
				  		</form>
				  	</td>";		

				  	echo "<td>
				  			<a href='/post/giftgroups/removerestriction.php?GroupId=".$_GET['GroupId']."&UserOneId=".$userid1."'>Remove All</a>
			  		      </td>";
				  	echo "</tr>";
				  }

				echo "</table></div>";
			?>
			
		</div>
		<div id="MainPanelControl">
			<?
			echo "<a href='/post/giftgroups/drawgroup.php?GroupId=".$_GET['GroupId']."''>Draw Pairings</a>";
			echo "<br />";
			echo "<a href='/post/giftgroups/deletegroup.php?GroupId=".$_GET['GroupId']."''>Delete Group</a>";
			?>
		</div>		
	</div>
			
<?
	require_once("../lib/templates/footer.php");
?>