
<?php

function displayGroup($teamsArray, $groupName, $clazz) { ?>
	
<div class="group_title" ><?php echo $groupName ?></div>

<table class="group_table" 
<?php if($groupName == "League Standings") { ?>
	echo style="width: 500px";
<?php } ?>
>

	<thead>
		
		<tr>
			<th class="group_header" >Pos</th>
			<th class="group_header" >Team</th>
			<th class="group_header" >GP</th>
			<th class="group_header" >W</th>
			<th class="group_header" >L</th>
			<th class="group_header" >PS</th>
			<th class="group_header" >PC</th>
			
			<?php if($groupName == "League Standings") { ?>
			<th class="group_header" >PS/G</th>
			<th class="group_header" >PC/G</th>				
			<?php } ?>
			
			<th class="group_header" >+/-</th>
		</tr>
	</thead>
	
	<tbody>
		
		<?php 
			$pos = 1;
			foreach($teamsArray as $team) { 
			$diff = $team->PS - $team->PC;
		?>
			<tr class='
				<?php if ($groupName != "League Standings") {
					echo $pos < 3 ? "promotion" : "elimination";
				} ?>' >
				<td class="group_item" ><?php echo $pos++ ?></td>
				<td class="group_item <?php echo $clazz ?>" ><?php echo $team->name ?></td>
				<td class="group_item" ><?php echo ($team->W + $team->L) ?></td>
				<td class="group_item" ><?php echo $team->W ?></td>
				<td class="group_item" ><?php echo $team->L ?></td>
				<td class="group_item" ><?php echo $team->PS ?></td>
				<td class="group_item" ><?php echo $team->PC ?></td>
				
				<?php if($groupName == "League Standings") { ?>
				<td class="group_item" ><?php echo number_format((float)(($team->W + $team->L == 0) ? 0 : $team->PS/($team->W + $team->L)), 1, '.', '') ?></td>
				<td class="group_item" ><?php echo number_format((float)(($team->W + $team->L == 0) ? 0 : $team->PC/($team->W + $team->L)), 1, '.', '') ?></td>				
				<?php } ?>
			
				<td class="group_item" ><?php echo ($diff > 0) ? "+".$diff : $diff ?></td>
			</tr>
		<?php 
			}
		?>
		
		
	</tbody>

</table>

<?php

}

?>