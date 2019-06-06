
<?php

function displayFixtures($gamesArray) { ?>

<table class="fixtures_table" >

	<thead>
		
		<tr>
			<th class="fixtures_header" >Away</th>
			<th class="fixtures_header" ></th>
			<th class="fixtures_header" ></th>
			<th class="fixtures_header" ></th>
			<th class="fixtures_header" >Home</th>
		</tr>
	</thead>
	
	<tbody>
		
		<?php foreach($gamesArray as $game) { ?>
		
			<?php $at = $game->pointsAway > $game->pointsHome 
				? "winning_team" : "" ?>
			<?php $ht = $game->pointsAway < $game->pointsHome 
				? "winning_team" : "" ?>				
			<tr>
				<td class="fixtures_item <?php echo $at ?>" >
					<?php echo $game->teamAway->name ?>
				</td>
				<td class="fixtures_item <?php echo $at ?>" >
					<?php echo ($game->pointsAway == 0 && $game->pointsAway != null) ? "---" : $game->pointsAway ?>
				</td>
				<td class="fixtures_item" > - </td>
				<td class="fixtures_item <?php echo $ht ?>" >
					<?php echo ($game->pointsHome == 0 && $game->pointsHome != null) ? "---" : $game->pointsHome ?>
				</td>
				<td class="fixtures_item <?php echo $ht ?>" >
					<?php echo $game->teamHome->name  ?>
				</td>
			</tr>
		<?php } ?>
		
	</tbody>

</table>

<?php

}

?>