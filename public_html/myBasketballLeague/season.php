
<?php 	
	$conMan = ConnectionManager::getInstance(); 
?>

<input id="current_phase" type="hidden" value="leag_stand" />
<input id="current_day" type="hidden" 
	value="day_<?php echo $conMan->getNextGame()->day ?>" />

<div id="wrapper">
	
	<div id="header" >
		<h1>Basketball League</h1>
	</div>
	
	<div id="inner_wrapper" >
	
		<div id="tabs_menu">
			<div class="tab" id="leag_stand" >Standings & Fixtures</div>
			<div class="tab" id="r_18" >Round of 18</div>
			<div class="tab" id="r_12" >Round of 12</div>
			<div class="tab" id="r_pl" >Playoffs</div>
		</div>

		<div id="main_panel" >
		
			<div id="main_leag_stand" class="inner_main" >
				<?php echo displayTabContent($conMan, "leag_stand") ?>
			</div>
			
			<div id="main_r_18" class="inner_main" >
				<?php echo displayTabContent($conMan, "r_18") ?>
			</div>
			
			<div id="main_r_12" class="inner_main" >
				<?php echo displayTabContent($conMan, "r_12") ?>
			</div>
			
			<div id="main_r_pl" class="inner_main" >
				<?php echo displayTabContent($conMan, "r_pl") ?>
			</div>
			
		</div>

	</div>

</div>

<?php $nextGame = $conMan->getNextGame(); 
if($nextGame != null) { ?>

<div id="matchmaker" >

	<div id="match" >
		<div class="match_div team_div away_team" >
			<?php echo $nextGame->teamAway->name; ?>
		</div>
		<div class="match_div" >
			<input id="away_score" class="match_field" type="textfield" />
		</div>
		<div class="match_div" >
			<img id="save_img" src="images/save.png" width="32px" height="32px"></img>
		</div>
		<div class="match_div" >
			<input id="home_score" class="match_field" type="textfield" />
		</div>
		<div class="match_div team_div home_team" >
			<?php echo $nextGame->teamHome->name; ?>
		</div>

	</div>

</div>
		
<?php } ?>	