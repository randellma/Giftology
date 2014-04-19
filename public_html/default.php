<?php
	//Initialize components
	require_once("../lib/config.php");
	require_once("../lib/classes/Validation.php");
	require_once("../lib/templates/header.php");
	
	if (SignedIn())
	{
		header("Location: grouplist.php");
		exit();
	}
?>
		
<div id="Content">
	<div id="MainPanel">
		<div id="MainPanelContent">
			<h2 class="mainpage">Create events and invite friends to participate in secret gift exchanges. Easy to set up and manage!</h2>
		</div>
		<div id="MainPanelControl">

			<h2>Sign In</h2>
			<form method="POST" name="input" action="/post/verifylogin.php" method="get">
				<h3>Email:</h3>
					<input type="email" name="Email" /><br />
				<h3>Password:</h3> 
					<input type="password" name="Password" /> <br />
				<input type="submit" value="Sign In!" />
			</form>
			
			<p><?echo $_SESSION['LoginError'];unset($_SESSION['LoginError']);?></p>
			
			<br />
			
			<h2>Sign Up</h2>
			<form method="POST" name="input" action="/post/register.php" method="get">
			<h3>First Name:</h3> 
				<input type="text" name="FirstName" /> <br />
			<h3>Last Name:</h3> 
				<input type="text" name="LastName" /> <br />
			<h3>Email:</h3>
				<input type="text" name="Email" /><br />
			<h3>Password:</h3> 
				<input type="password" name="Password" /> <br />
			<h3>Retype Password:</h3> 
				<input type="password" name="RetypedPassword" /> <br />
			<input type="submit" value="Sign Up!" />
			</form>
			<br />
			<p><?echo $_SESSION['RegError'];unset($_SESSION['RegError']);?></p>

		</div>		
	</div>
			
<?
	require_once("../lib/templates/footer.php");
?>