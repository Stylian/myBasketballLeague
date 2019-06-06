
<?php

function displayTabContent($conMan, $rName) { 

if($rName == "leag_stand") { ?>

	<div class="goup_leag_stand" >
		<div class="group">
			<?php echo displayGroup($conMan->getAllTeamsRanked(),
				"League Standings", "l_stand_td") ?>
		</div>
		
		<div class="fixtures" >
			<div class="fixtures_title" >Fixtures</div>
			
			<div id="dayMenu">
				<div id="day_selector_1" class="daySelector">Day 1</div>
				<div id="day_selector_2" class="daySelector">Day 2</div>
				<div id="day_selector_3" class="daySelector">Day 3</div>
				<div id="day_selector_4" class="daySelector">Day 4</div>
				<div id="day_selector_5" class="daySelector">Day 5</div>
				<div id="day_selector_6" class="daySelector">Day 6</div>
				<div id="day_selector_7" class="daySelector">&#188 Finals</div>
				<div id="day_selector_8" class="daySelector">&#189 Finals</div>
				<div id="day_selector_9" class="daySelector">Finals</div>				
			</div>
			
			<div id="day_1" class="day" >
				<?php echo displayFixtures($conMan->getGamesByFixtureDay(1)) ?>
			</div>
			<div id="day_2" class="day" >
				<?php echo displayFixtures($conMan->getGamesByFixtureDay(2)) ?>
			</div>
			<div id="day_3" class="day" >
				<?php echo displayFixtures($conMan->getGamesByFixtureDay(3)) ?>
			</div>
			<div id="day_4" class="day" >
				<?php echo displayFixtures($conMan->getGamesByFixtureDay(4)) ?>
			</div>
			<div id="day_5" class="day" >
				<?php echo displayFixtures($conMan->getGamesByFixtureDay(5)) ?>
			</div>
			<div id="day_6" class="day" >
				<?php echo displayFixtures($conMan->getGamesByFixtureDay(6)) ?>
			</div>
			<div id="day_7" class="day" >
				<?php echo displayFixtures($conMan->getGamesByFixtureDay(7)) ?>
			</div>
			<div id="day_8" class="day" >
				<?php echo displayFixtures($conMan->getGamesByFixtureDay(8)) ?>
			</div>
			<div id="day_9" class="day" >
				<?php echo displayFixtures($conMan->getGamesByFixtureDay(9)) ?>
			</div>			
		</div>
	</div>

<?php }elseif($rName == "r_18") { 

	$value = $conMan->getPersist("r18");

	if ($value == "disabled") { ?>
		<div class="round_message" > This round has not yet started!</div>	
	<?php 
	}elseif ($value == "tostart") { ?>
		<div id="generator_r18" class="round_message generator" >click to draw</div>
	<?php 
	}elseif ($value == "active") {

?>

		<div class="group_row" >
			<div class="group_wrapper group_wrapper_r18" >
				<div class="group"><?php echo displayGroup($conMan->getTeamsfromGroupId(1), "GROUP A", "") ?></div>
			</div>
			<div class="group_wrapper group_wrapper_r18" >
				<div class="group"><?php echo displayGroup($conMan->getTeamsfromGroupId(2), "GROUP B", "") ?></div>
			</div>
			<div class="group_wrapper group_wrapper_r18" >
				<div class="group"><?php echo displayGroup($conMan->getTeamsfromGroupId(3), "GROUP C", "") ?></div>
			</div>		
		</div>

		<div class="group_row" >
			<div class="group_wrapper group_wrapper_r18" >
				<div class="group"><?php echo displayGroup($conMan->getTeamsfromGroupId(4), "GROUP D", "") ?></div>
			</div>
			<div class="group_wrapper group_wrapper_r18" >
				<div class="group"><?php echo displayGroup($conMan->getTeamsfromGroupId(5), "GROUP E", "") ?></div>
			</div>
			<div class="group_wrapper group_wrapper_r18" >
				<div class="group"><?php echo displayGroup($conMan->getTeamsfromGroupId(6), "GROUP F", "") ?></div>
			</div>		
		</div>
	<?php } ?>

<?php }elseif($rName == "r_12") {

	$value = $conMan->getPersist("r12");

	if ($value == "disabled") { ?>
		<div class="round_message" > This round has not yet started!</div>	
	<?php 
	}elseif ($value == "tostart") { ?>
		<div id="generator_r12" class="round_message generator" >click to draw</div>
	<?php 
	}elseif ($value == "active") {

	?>
		<div class="group_row" >
			<div class="group_wrapper group_wrapper_r12" >
				<div class="group"><?php echo displayGroup($conMan->getTeamsfromGroupId(7), "GROUP A", "") ?></div>
			</div>
			<div class="group_wrapper group_wrapper_r12" >
				<div class="group"><?php echo displayGroup($conMan->getTeamsfromGroupId(8), "GROUP B", "") ?></div>
			</div>
		</div>
			
		<div class="group_row" >
			<div class="group_wrapper group_wrapper_r12" >
				<div class="group"><?php echo displayGroup($conMan->getTeamsfromGroupId(9), "GROUP C", "") ?></div>
			</div>
			<div class="group_wrapper group_wrapper_r12" >
				<div class="group"><?php echo displayGroup($conMan->getTeamsfromGroupId(10), "GROUP D", "") ?></div>
			</div>
		</div>
	<?php } ?>
	
<?php }elseif($rName == "r_pl") {

	$value = $conMan->getPersist("rpl");

	if ($value == "disabled") { ?>
		<div class="round_message" > This round has not yet started!</div>	
	<?php 
	}elseif ($value == "tostart") { ?>
		<div id="generator_rpl" class="round_message generator" >click to draw</div>
	<?php 
	}elseif ($value == "active") {
		echo displayPlayoffs($conMan);
	} ?>

<?php } ?>
	
<?php } ?>