<?require_once("../lib/config.php");?>
<div id="MainPanelFooter">
					<a href="post/logout.php">Logout</a>
					<?
						if($_SESSION['GenError'] != "")
						{?>
							<br />
							<p><?echo $_SESSION['GenError'];?></p>
						<?}
						unset($_SESSION['GenError']);
					?>
			</div>
		</div>
	</body>
</html>