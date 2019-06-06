<!DOCTYPE html>


<html>
<head>
	<meta charset="UTF-8">
	<title>Basketball League</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
		
	<script src="lib/jquery-2.1.4.min.js"></script>
	<script src="lib/jquery.dataTables.min.js"></script>
	<script src="lib/jquery.blockUI.js"></script>
		
	<script src="js/tests.js"></script>
</head>  

<body>
	<input type="hidden" id="season_num" value="<?php echo $_GET["season"] ?>" />
	
	<input type='button' id='test_league' value='test'/>

	
	<p id='report'></p>
	
</body>