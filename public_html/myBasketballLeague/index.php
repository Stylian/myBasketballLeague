<!DOCTYPE html>

<?php require "functions.php" ?>

<?php require "group_display.php" ?>
<?php require "fixtures_display.php" ?>
<?php require "tab_content_display.php" ?>
<?php require "playoffs_display.php" ?>

<?php require "classes/Logger.php" ?>
<?php require "classes/Team.php" ?>
<?php require "classes/Game.php" ?>
<?php require "classes/ConnectionManager.php" ?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Basketball League</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
		
	<script src="lib/jquery-2.1.4.min.js"></script>
	<script src="lib/jquery.dataTables.min.js"></script>
	<script src="lib/jquery.blockUI.js"></script>
	<script src="lib/notify.min.js"></script>
		
	<script src="js/functions.js"></script>
	<script src="js/actions.js"></script>
</head>  
<body>

	<?php 
		$GLOBALS["season"] = $_GET["season"];
	?>
	
	<input type="hidden" id="season_num" value="<?php echo $_GET["season"] ?>" />

	<?php if(isset ($_GET["install"])) { ?>
			
	<div id="season_selector" >
		<div style="color: white" >click to generate new season here</div>
		
		<img id="create_season_btn" src="images/button_plus_blue.png" title="generate season" width="24px" height="24px"></img>
	</div>
	
	<?php 
		}else {
			require "season.php" ;
		}
	?>
	
</body>

</html>