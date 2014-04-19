<?php
	//Initialize components
	require_once("../lib/config.php");
	require_once("../lib/classes/Validation.php");
	require_once("../lib/templates/header.php");

	if (!SignedIn())
	{
		header("Location: default.php");
		exit();
	}
	if (isset($_GET['GroupId']))
	{
		$groupid = $_GET['GrouId'];
	}

?>
		
<div id="Content">
	<div id="MainPanel">
		<div id="MainPanelContent">
			<h2>Create Group</h2>
			<br />
			<?require_once("../lib/templates/creategrouptemplate.php");?>	
		</div>
		<div id="MainPanelControl">
			<a href="/grouplist.php">Cancel</a>
		</div>		
	</div>
			
<?
	require_once("../lib/templates/footer.php");
?>