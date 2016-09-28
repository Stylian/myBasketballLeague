
<?php

function displayPlayoffs($conMan) { ?>


<table id="playoffs_table" border="0" cellpadding="0" cellspacing="0" >
	<tbody style="background-color:#fff;">
		<tr>
			<td height="0"></td>
			<td width="250">&nbsp;</td>
			<td width="100">&nbsp;</td>
			<td width="70">&nbsp;</td>
			<td width="70">&nbsp;</td>
			<td width="250">&nbsp;</td>
			<td width="100">&nbsp;</td>
			<td width="70">&nbsp;</td>
			<td width="70">&nbsp;</td>
			<td width="250">&nbsp;</td>
			<td width="100">&nbsp;</td>
		</tr>
		<tr>
			<td height="0"></td>
			<td colspan="2" rowspan="2"></td>
			<td rowspan="4" style="border-width:0 0 1px 0; border-style: solid;border-color:black;">&nbsp;</td>
			<td rowspan="7" style="border-width:0 0 1px 0; border-style: solid;border-color:black;">&nbsp;</td>
			<td colspan="2" rowspan="3"></td>
			<td rowspan="7" style="border-width:0 0 1px 0; border-style: solid;border-color:black;">&nbsp;</td>
			<td rowspan="13" style="border-width:0 0 1px 0; border-style: solid;border-color:black;">&nbsp;</td>
			<td colspan="2" rowspan="9"></td>
		</tr>
		<tr>
			<td height="0"></td>
		</tr>
		
		<?php $team1 = $conMan->getPlayoffEntry(1, 10000); ?>
		<?php $team8 = $conMan->getPlayoffEntry(8, 10000); ?>
		<?php $team4 = $conMan->getPlayoffEntry(4, 10000); ?>
		<?php $team5 = $conMan->getPlayoffEntry(5, 10000); ?>
		<?php $team2 = $conMan->getPlayoffEntry(2, 10000); ?>
		<?php $team7 = $conMan->getPlayoffEntry(7, 10000); ?>
		<?php $team3 = $conMan->getPlayoffEntry(3, 10000); ?>
		<?php $team6 = $conMan->getPlayoffEntry(6, 10000); ?>

		<tr>
			<td height="20"></td>
			<td rowspan="2" class="playoff_block" ><?php echo $team8->name ?></td>
			<td rowspan="2" class="playoff_block" >
				<span style="float: left; margin-left: 10px;" ><?php echo $team8->W + $team1->L ?></span>
				<span style="float: right; margin-right: 10px;" ><?php echo ($team8->PS - $team8->PC > 0 ? "+" : "") . ($team8->PS - $team8->PC) ?></span>
			</td>
		</tr>
		<tr>
			<td height="20"></td>
			<td colspan="2" rowspan="2"></td>
		</tr>
		<tr>
			<td height="20"></td>
			<td rowspan="2" class="playoff_block" ><?php echo $team1->name ?></td>
			<td rowspan="2" class="playoff_block" >
				<span style="float: left; margin-left: 10px;" ><?php echo $team1->W + $team8->L ?></span>
				<span style="float: right; margin-right: 10px;" ><?php echo ($team1->PS - $team1->PC > 0 ? "+" : "") . ($team1->PS - $team1->PC) ?></span>
			</td>
			<td rowspan="3" style="border-width:2px 3px 0 0; border-style: solid;border-color:black;">&nbsp;</td>
		</tr>
				<tr>
					<td height="20"></td>	
					<?php if($conMan->isPlayoffEntry(11, 100000)) { ?>
						<?php $team11 = $conMan->getPlayoffEntry(11, 100000); ?>
						<?php $team14 = $conMan->getPlayoffEntry(14, 100000); ?>
						<td rowspan="2" class="playoff_block" ><?php echo $team14->name ?></td>
						<td rowspan="2" class="playoff_block" >
							<span style="float: left; margin-left: 10px;" ><?php echo $team14->W + $team11->L ?></span>
							<span style="float: right; margin-right: 10px;" ><?php echo ($team14->PS - $team14->PC > 0 ? "+" : "") . ($team14->PS - $team14->PC) ?></span>
						</td>
					<?php }else { ?>
						<td rowspan="2" class="playoff_block" ></td>
						<td rowspan="2" class="playoff_block" ></td>
					<?php } ?>
				</tr>
				<tr>
					<td height="20"></td>
					<td colspan="2" rowspan="2"></td>
				</tr>
				<tr>
					<td height="20"></td>
					<td rowspan="3" style="border-width:0 3px 1px 0; border-style: solid;border-color:black;">&nbsp;</td>
					<td rowspan="5" style="border-width:2px 0 0 0; border-style: solid;border-color:black;">&nbsp;</td>
					<?php if($conMan->isPlayoffEntry(11, 100000)) { ?>
						<?php $team11 = $conMan->getPlayoffEntry(11, 100000); ?>
						<?php $team14 = $conMan->getPlayoffEntry(14, 100000); ?>
						<td rowspan="2" class="playoff_block" ><?php echo $team11->name ?></td>
						<td rowspan="2" class="playoff_block" >
							<span style="float: left; margin-left: 10px;" ><?php echo $team11->W + $team14->L ?></span>
							<span style="float: right; margin-right: 10px;" ><?php echo ($team11->PS - $team11->PC > 0 ? "+" : "") . ($team11->PS - $team11->PC) ?></span>
						</td>
					<?php }else { ?>
						<td rowspan="2" class="playoff_block" ></td>
						<td rowspan="2" class="playoff_block" ></td>
					<?php } ?>
					<td rowspan="12" style="border-width:2px 3px 1px 0; border-style: solid;border-color:black;">&nbsp;</td>
				</tr>
		<tr>
			<td height="20"></td>
			<td rowspan="2" class="playoff_block" ><?php echo $team5->name ?></td>
			<td rowspan="2" class="playoff_block" >
				<span style="float: left; margin-left: 10px;" ><?php echo $team5->W + $team4->L ?></span>
				<span style="float: right; margin-right: 10px;" ><?php echo ($team5->PS - $team5->PC > 0 ? "+" : "") . ($team5->PS - $team5->PC) ?></span>
			</td>
		</tr>
		<tr>
			<td height="20"></td>
			<td colspan="2" rowspan="6"></td>
			<td colspan="2" rowspan="2"></td>
		</tr>
		<tr>
			<td height="20"></td>
			<td rowspan="2" class="playoff_block" ><?php echo $team4->name ?></td>
			<td rowspan="2" class="playoff_block" >
				<span style="float: left; margin-left: 10px;" ><?php echo $team4->W + $team5->L ?></span>
				<span style="float: right; margin-right: 10px;" ><?php echo ($team4->PS - $team4->PC > 0 ? "+" : "") . ($team4->PS - $team4->PC) ?></span>
			</td>
			<td rowspan="2" style="border-width:2px 0 0 0; border-style: solid;border-color:black;">&nbsp;</td>
		</tr>
						<tr>
							<td height="20"></td>
								<?php if($conMan->isPlayoffEntry(21, 1000000)) { ?>
									<?php $team21 = $conMan->getPlayoffEntry(21, 1000000); ?>
									<?php $team22 = $conMan->getPlayoffEntry(22, 1000000); ?>
									<td rowspan="2" class="playoff_block" ><?php echo $team22->name ?></td>
									<td rowspan="2" class="playoff_block" >
										<span style="float: left; margin-left: 10px;" ><?php echo $team22->W + $team21->L ?></span>
										<span style="float: right; margin-right: 10px;" ><?php echo ($team22->PS - $team22->PC > 0 ? "+" : "") . ($team22->PS - $team22->PC) ?></span>
									</td>
								<?php }else { ?>
									<td rowspan="2" class="playoff_block" ></td>
									<td rowspan="2" class="playoff_block" ></td>
								<?php } ?>
						</tr>
						<tr>
							<td height="20"></td>
							<td colspan="2" rowspan="2"></td>
							<td rowspan="4" style="border-width:0 0 1px 0; border-style: solid;border-color:black;">&nbsp;</td>
							<td rowspan="7" style="border-width:0 0 1px 0; border-style: solid;border-color:black;">&nbsp;</td>
						</tr>
						<tr>
							<td height="20"></td>
							<td rowspan="12" style="border-width:2px 0 0 0; border-style: solid;border-color:black;">&nbsp;</td>
								<?php if($conMan->isPlayoffEntry(21, 1000000)) { ?>
									<?php $team21 = $conMan->getPlayoffEntry(21, 1000000); ?>
									<?php $team22 = $conMan->getPlayoffEntry(22, 1000000); ?>
									<td rowspan="2" class="playoff_block" ><?php echo $team21->name ?></td>
									<td rowspan="2" class="playoff_block" >
										<span style="float: left; margin-left: 10px;" ><?php echo $team21->W + $team22->L ?></span>
										<span style="float: right; margin-right: 10px;" ><?php echo ($team21->PS - $team21->PC > 0 ? "+" : "") . ($team21->PS - $team21->PC) ?></span>
									</td>
								<?php }else { ?>
									<td rowspan="2" class="playoff_block" ></td>
									<td rowspan="2" class="playoff_block" ></td>
								<?php } ?>
						</tr>
		<tr>
			<td height="20"></td>
			<td rowspan="2" class="playoff_block" ><?php echo $team7->name ?></td>
			<td rowspan="2" class="playoff_block" >
				<span style="float: left; margin-left: 10px;" ><?php echo $team7->W + $team2->L ?></span>
				<span style="float: right; margin-right: 10px;" ><?php echo ($team7->PS - $team7->PC > 0 ? "+" : "") . ($team7->PS - $team7->PC) ?></span>
			</td>
		</tr>
		<tr>
			<td height="20"></td>
			<td colspan="2" rowspan="2"></td>
			<td colspan="2" rowspan="2"></td>
		</tr>
		<tr>
			<td height="20"></td>
			<td rowspan="2" class="playoff_block" ><?php echo $team2->name ?></td>
			<td rowspan="2" class="playoff_block" >
				<span style="float: left; margin-left: 10px;" ><?php echo $team2->W + $team7->L ?></span>
				<span style="float: right; margin-right: 10px;" ><?php echo ($team2->PS - $team2->PC > 0 ? "+" : "") . ($team2->PS - $team2->PC) ?></span>
			</td>
			<td rowspan="3" style="border-width:2px 3px 0 0; border-style: solid;border-color:black;">&nbsp;</td>
		</tr>
				<tr>
					<td height="20"></td>
					<?php if($conMan->isPlayoffEntry(12, 100000)) { ?>
						<?php $team12 = $conMan->getPlayoffEntry(12, 100000); ?>
						<?php $team13 = $conMan->getPlayoffEntry(13, 100000); ?>
						<td rowspan="2" class="playoff_block" ><?php echo $team13->name ?></td>
						<td rowspan="2" class="playoff_block" >
							<span style="float: left; margin-left: 10px;" ><?php echo $team13->W + $team12->L ?></span>
							<span style="float: right; margin-right: 10px;" ><?php echo ($team13->PS - $team13->PC > 0 ? "+" : "") . ($team13->PS - $team13->PC) ?></span>
						</td>
					<?php }else { ?>
						<td rowspan="2" class="playoff_block" ></td>
						<td rowspan="2" class="playoff_block" ></td>
					<?php } ?>
				</tr>
				<tr>
					<td height="20"></td>
					<td colspan="2" rowspan="2"></td>
				</tr>
				<tr>
					<td height="20"></td>
					<td rowspan="3" style="border-width:0 3px 1px 0; border-style: solid;border-color:black;">&nbsp;</td>
					<td rowspan="6" style="border-width:2px 0 0 0; border-style: solid;border-color:black;">&nbsp;</td>
					<?php if($conMan->isPlayoffEntry(12, 100000)) { ?>
						<?php $team12 = $conMan->getPlayoffEntry(12, 100000); ?>
						<?php $team13 = $conMan->getPlayoffEntry(13, 100000); ?>
						<td rowspan="2" class="playoff_block" ><?php echo $team12->name ?></td>
						<td rowspan="2" class="playoff_block" >
							<span style="float: left; margin-left: 10px;" ><?php echo $team12->W + $team13->L ?></span>
							<span style="float: right; margin-right: 10px;" ><?php echo ($team12->PS - $team12->PC > 0 ? "+" : "") . ($team12->PS - $team12->PC) ?></span>
						</td>
					<?php }else { ?>
						<td rowspan="2" class="playoff_block" ></td>
						<td rowspan="2" class="playoff_block" ></td>
					<?php } ?>
					<td rowspan="6" style="border-width:2px 0 0 0; border-style: solid;border-color:black;">&nbsp;</td>
				</tr>
		<tr>
			<td height="20"></td>
			<td rowspan="2" class="playoff_block" ><?php echo $team6->name ?></td>
			<td rowspan="2" class="playoff_block" >
				<span style="float: left; margin-left: 10px;" ><?php echo $team6->W + $team3->L ?></span>
				<span style="float: right; margin-right: 10px;" ><?php echo ($team6->PS - $team6->PC > 0 ? "+" : "") . ($team6->PS - $team6->PC) ?></span>
			</td>
		</tr>
		<tr>
			<td height="20"></td>
			<td colspan="2" rowspan="4"></td>
		</tr>
		<tr>
			<td height="20"></td>
			<td rowspan="2" class="playoff_block" ><?php echo $team3->name ?></td>
			<td rowspan="2" class="playoff_block" >
				<span style="float: left; margin-left: 10px;" ><?php echo $team3->W + $team6->L ?></span>
				<span style="float: right; margin-right: 10px;" ><?php echo ($team3->PS - $team3->PC > 0 ? "+" : "") . ($team3->PS - $team3->PC) ?></span>
			</td>
			<td rowspan="2" style="border-width:2px 0 0 0; border-style: solid;border-color:black;">&nbsp;</td>
		</tr>
		<tr>
			<td height="20"></td>
		</tr>
		<tr>
			<td height="0"></td>
			<td colspan="3">&nbsp;</td>
		</tr>
	</tbody>
</table>



<?php } ?>