<?php
require_once "../classes/ConnectionManager.php";
require_once "../classes/Team.php";
require_once "../classes/Game.php";
require "../functions.php";

$conMan = ConnectionManager::createDbInstance($_GET["season"]);
		
$game = $conMan->getNextGame();
	
$modif = 0;	
	
switch($game->day) {
	
	case 1:
	case 2:
	case 3:
		$modif = 100;
		break;
	case 4:
	case 5:
	case 6:
		$modif = 1000;
		break;
	case 7:
		$modif = 10000;
		break;
	case 8:	
		$modif = 100000;
		break;
	case 9:
		$modif = 1000000;
		break;
	default:
		$modif = 0;
}
	
	
$away_score = $_GET['away'];
$home_score = $_GET['home'];	

$conMan->updateGame($game->id, $away_score, $home_score);

if($away_score == " ") {
	
}else{
	$conMan->updateTeam($game->teamHome->id, $away_score, $home_score, $modif);
}

if($conMan->getNextGame() == null) {
	
	if($modif == 100) {
		$conMan->updatePersist("r12", "tostart");
	}elseif($modif == 1000) {
		$conMan->updatePersist("rpl", "tostart");
	}elseif($modif == 10000) {
		
		$team18 = $conMan->getPlayoffWinnerTeam(1, 8, $modif);
		$team45 = $conMan->getPlayoffWinnerTeam(4, 5, $modif);
		$team27 = $conMan->getPlayoffWinnerTeam(2, 7, $modif);
		$team36 = $conMan->getPlayoffWinnerTeam(3, 6, $modif);		
		
		$conMan->addPlayoffEntry(11, $team18);
		$conMan->addPlayoffEntry(12, $team27);
		$conMan->addPlayoffEntry(13, $team36);		
		$conMan->addPlayoffEntry(14, $team45);
		
		// create matches
		$conMan->createGame($team18, $team45, 8);
		$conMan->createGame($team27, $team36, 8);
		$conMan->createGame($team45, $team18, 8);
		$conMan->createGame($team36, $team27, 8);
		$conMan->createGame($team18, $team45, 8);
		$conMan->createGame($team27, $team36, 8);
		$conMan->createGame($team45, $team18, 8);
		$conMan->createGame($team36, $team27, 8);
		
	}elseif($modif == 100000) {
	
		$team14 = $conMan->getPlayoffWinnerTeam(11, 14, $modif);
		$team23 = $conMan->getPlayoffWinnerTeam(12, 13, $modif);	
	
		$conMan->addPlayoffEntry(21, $team14);
		$conMan->addPlayoffEntry(22, $team23);	
	
		// create matches
		$conMan->createGame($team14, $team23, 9);
		$conMan->createGame($team14, $team23, 9);		
		$conMan->createGame($team23, $team14, 9);	
		$conMan->createGame($team23, $team14, 9);	
		$conMan->createGame($team14, $team23, 9);	
		$conMan->createGame($team23, $team14, 9);	
	
	}elseif($modif == 1000000) {
	// the end
	}
}
	
echo "{ }";
?>