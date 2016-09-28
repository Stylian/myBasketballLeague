<?php

function sortTeams($team1, $team2) {
	
	// order by ratio W/W+L
	if($team1->W + $team1->L == 0)
		$ratio1 = 0.5;
	else
		$ratio1 = $team1->W / ($team1->W + $team1->L);
	
	if($team2->W + $team2->L == 0)
		$ratio2 = 0.5;
	else
		$ratio2 = $team2->W / ($team2->W + $team2->L);
	
	if($ratio1 != $ratio2)
		return $ratio2 > $ratio1;
	
	// sort by wins
	if($team2->W != $team1->W)
		return $team2->W > $team1->W;
	
	// sort by losses
	if($team2->L != $team1->L)
		return $team2->L < $team1->L;
		
	// sort by +/-	
	if( ($team2->PS - $team2->PC) != ($team1->PS - $team1->PC) )
		return $team2->PS - $team2->PC > $team1->PS - $team1->PC;
	
	// sort by ps
	if( $team2->PS != $team1->PS )
		return $team2->PS > $team1->PS;
	
	
	return 1;
}

?>