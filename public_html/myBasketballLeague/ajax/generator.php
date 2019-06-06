<?php
require_once "../classes/logger.php";
require_once "../classes/ConnectionManager.php";
require_once "../classes/Team.php";
require "../functions.php";

$type = $_GET['type'];

$conMan = ConnectionManager::createDbInstance($_GET["season"]);

switch ($type) {
	
	case "r18":
		generateRound18();
		break;
	case "r12":
		generateRound12();
		break;	
	case "rpl":
		generateRoundPL();
		break;		
	default:
		echo "{ }";
}


function generateRound18() {
	Logger::info("preparing to generate round of 18.");
		
	$conMan = ConnectionManager::createDbInstance($_GET["season"]);
	
	$teams = $conMan->getAllTeamsRanked();
	shuffle($teams);
	
	Logger::info("shuffled teams and preparing to build season.");
	
	for($i=0; $i<6; $i++) {

		// create groups
		for($j=1; $j<4; $j++) {
			Logger::info("creating group by adding teams to");
			$conMan->insertTeamToGroup($i+1, $teams[$i*3 + $j - 1]->id);
		}
		
		Logger::info("creating group matches");
		// create matches
		$groupTeams = $conMan->getTeamsfromGroupId($i+1);
		$conMan->createGame($groupTeams[0], $groupTeams[1], 1);
		$conMan->createGame($groupTeams[1], $groupTeams[2], 1);
		$conMan->createGame($groupTeams[2], $groupTeams[0], 2);
		$conMan->createGame($groupTeams[0], $groupTeams[2], 2);
		$conMan->createGame($groupTeams[1], $groupTeams[0], 3);
		$conMan->createGame($groupTeams[2], $groupTeams[1], 3);
	}

	Logger::info("Completed round of 18 creation!");
	
	$conMan->updatePersist("r18", "active");
	
	echo "{ }";
}

function generateRound12() {
	$conMan = ConnectionManager::createDbInstance($_GET["season"]);

	$teams = array();
	
	for($i=1; $i<7; $i++) {
		$gTeams = $conMan->getTeamsfromGroupId($i);
		usort($gTeams, "sortTeams");
		$teams[] = $gTeams[0];
		$teams[] = $gTeams[1];
	}
	shuffle($teams);
	
	for($i=0; $i<4; $i++) {

		// create groups
		for($j=1; $j<4; $j++) {
			$conMan->insertTeamToGroup($i+7, $teams[$i*3 + $j - 1]->id);
		}
		
		// create matches
		$groupTeams = $conMan->getTeamsfromGroupId($i+7);
		$conMan->createGame($groupTeams[0], $groupTeams[1], 4);
		$conMan->createGame($groupTeams[1], $groupTeams[2], 4);
		$conMan->createGame($groupTeams[2], $groupTeams[0], 5);
		$conMan->createGame($groupTeams[0], $groupTeams[2], 5);
		$conMan->createGame($groupTeams[1], $groupTeams[0], 6);
		$conMan->createGame($groupTeams[2], $groupTeams[1], 6);
	}

	$conMan->updatePersist("r12", "active");
	
	echo "{ }";
}

function generateRoundPL() {
	$conMan = ConnectionManager::createDbInstance($_GET["season"]);

	$teamsStrong = array();
	$teamsWeak = array();
	
	for($i=7; $i<11; $i++) {
		$gTeams = $conMan->getTeamsfromGroupId($i);
		usort($gTeams, "sortTeams");
		$teamsStrong[] = $gTeams[0];
		$teamsWeak[] = $gTeams[1];
	}

	usort($teamsStrong, "sortTeams");
	usort($teamsWeak, "sortTeams");
	
	$conMan->addPlayoffEntry(1, $teamsStrong[0]);
	$conMan->addPlayoffEntry(2, $teamsStrong[1]);
	$conMan->addPlayoffEntry(3, $teamsStrong[2]);
	$conMan->addPlayoffEntry(4, $teamsStrong[3]);
	$conMan->addPlayoffEntry(5, $teamsWeak[0]);
	$conMan->addPlayoffEntry(6, $teamsWeak[1]);
	$conMan->addPlayoffEntry(7, $teamsWeak[2]);
	$conMan->addPlayoffEntry(8, $teamsWeak[3]);	
	
	// create matches
	$conMan->createGameflip($teamsStrong[0], $teamsWeak[3], 7);
	$conMan->createGameflip($teamsStrong[1], $teamsWeak[2], 7);		
	$conMan->createGameflip($teamsStrong[2], $teamsWeak[1], 7);
	$conMan->createGameflip($teamsStrong[3], $teamsWeak[0], 7);
	$conMan->createGameflip($teamsWeak[3], $teamsStrong[0], 7);			
	$conMan->createGameflip($teamsWeak[2], $teamsStrong[1], 7);		
	$conMan->createGameflip($teamsWeak[1], $teamsStrong[2], 7);
	$conMan->createGameflip($teamsWeak[0], $teamsStrong[3], 7);
	$conMan->createGameflip($teamsStrong[0], $teamsWeak[3], 7);	
	$conMan->createGameflip($teamsStrong[1], $teamsWeak[2], 7);		
	$conMan->createGameflip($teamsStrong[2], $teamsWeak[1], 7);
	$conMan->createGameflip($teamsStrong[3], $teamsWeak[0], 7);
	
	$conMan->updatePersist("rpl", "active");
	
	echo "{ }";
}
?>