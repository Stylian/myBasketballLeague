<?php

require_once "logger.php";

class ConnectionManager {

	private $conn;
	
	static function createSchema($season) {
		Logger::info("attempting to create database schema...");
		$mysqli = new mysqli("localhost","root","");

		if($mysqli->query("CREATE DATABASE IF NOT EXISTS season" . $season)){
			Logger::info("successfully created schema.");			
		}else {
			Logger::error("Failed creating new database: ".$mysqli->connect_errno());
			die();
		}
		$mysqli->close();
	}
	
	// Singleton
	private static $instance;
	static function getInstance() {
		Logger::info("grabbing instance");
		if(self::$instance == null) {
			self::$instance = new ConnectionManager($GLOBALS["season"]);
		}
		return self::$instance;
	}
	
	static function createDbInstance($season) {
		self::$instance = new ConnectionManager($season);
		return self::$instance;
	}
	
	function __construct($season) {
		Logger::info("preparing to access the season schema");
		
		$this->conn = new mysqli("localhost","root","", "season" . $season);
		if ($this->conn->connect_error) {
			Logger::error("connection failed. error number: 0b5f02d7");
			die("Connection failed: " . $this->conn->connect_error);
		}	
	}
	
	function __destruct() {
		$this->conn->close();
	}

	function createTables() {
		Logger::info("preparing to run install.sql");
		$sql = file_get_contents("../install.sql");
		mysqli_multi_query($this->conn, $sql);
		while ($this->conn->next_result()) {;}
		Logger::info("install.sql script has finished!");
	}
	
	function getTeamSQL($team_id, $away_score, $home_score, $modif) {
		
		$team = $this->getTeamById($team_id, $modif);
		
		$W = $team->W;
		$L = $team->L;
		$PS = $team->PS + $home_score;
		$PC = $team->PC + $away_score;
		if($away_score > $home_score)
			$L ++;
		else
			$W ++;
		
		$sql= "UPDATE stats SET " 
			. "W='" . $W
			. "',L='" .$L
			. "',PS='" . $PS
			. "',PC='" . $PC
			. "' WHERE id=" . ($team->id + $modif);
		
		return $sql;
	}
	
	function updateTeam($team_id, $away_score, $home_score, $modif) {
		
		switch($modif) {
			
			case 100:
				$sql = $this->getTeamSQL($team_id, $away_score, $home_score, 100);
				mysqli_query($this->conn, $sql);
				// falls through
			case 1000:
				$sql = $this->getTeamSQL($team_id, $away_score, $home_score, 1000);
				mysqli_query($this->conn, $sql);
				break;
			case 10000:
				$sql = $this->getTeamSQL($team_id, $away_score, $home_score, 10000);
				mysqli_query($this->conn, $sql);	
				break;
			case 100000:
				$sql = $this->getTeamSQL($team_id, $away_score, $home_score, 100000);
				mysqli_query($this->conn, $sql);
				break;
			case 1000000:
				$sql = $this->getTeamSQL($team_id, $away_score, $home_score, 1000000);
				mysqli_query($this->conn, $sql);
				break;
				
		}
		$sql = $this->getTeamSQL($team_id, $away_score, $home_score, 0);
		mysqli_query($this->conn, $sql);
		Logger::debug("updated team " . $team_id);
	}
		
	function getPlayoffWinnerTeam($pos1, $pos2, $modif) {
			
		$sql= "SELECT * FROM playoff_positions WHERE pos=" . $pos1 . " OR pos=" . $pos2;
		$result = $this->conn->query($sql);
	
		$teams = array();
		
		while($row = $result->fetch_assoc()) {
			$teams[] = $this->getTeamById($row["tid"], $modif);	
		}

		usort($teams, "sortTeams");
		
		return $teams[0];
	}
	
	function getPlayoffLoserTeam($pos1, $pos2, $modif) {
			
		$sql= "SELECT * FROM playoff_positions WHERE pos=" . $pos1 . " OR pos=" . $pos2;
		$result = $this->conn->query($sql);
	
		$teams = array();
		
		while($row = $result->fetch_assoc()) {
			$teams[] = $this->getTeamById($row["tid"], $modif);	
		}

		usort($teams, "sortTeams");
		
		return $teams[1];
	}
	
	function isPlayoffEntry($pos, $modif) {
		$sql = "SELECT tid FROM playoff_positions WHERE pos=" . $pos;
		$result = $this->conn->query($sql);
	
		$team = new Team();
		
		if($row = $result->fetch_assoc()) {
			return true;
		}
		return false;
	}
	
	function getPlayoffEntry($pos, $modif) {
		$sql = "SELECT tid FROM playoff_positions WHERE pos=" . $pos;
		$result = $this->conn->query($sql);
	
		$team = new Team();
		
		if($row = $result->fetch_assoc()) {
			$team = $this->getTeamById($row["tid"], $modif);
		}
		return $team;
	}
	
	function addPlayoffEntry($pos, $team) {
		$sql= "INSERT INTO playoff_positions (
				pos,
				tid
			)VALUES (
				'" . $pos . "',
				'" . $team->id . "'
			)";
		mysqli_query($this->conn, $sql);	
		Logger::debug("added playoff entry!");
	}
	
	function createGameflip($teamStrong, $teamWeak, $num) {
		$this->createGame($teamWeak, $teamStrong, $num); 
	}
	
	function updateGame($gid, $away_score, $home_score) {
		$sql= "UPDATE games SET points_away='" . $away_score
			. "',points_home='" .$home_score
			."' WHERE id='" . $gid . "' ";
		mysqli_query($this->conn, $sql);
	}
	
	
	function getNextGame() {
				
		$sql= "SELECT * FROM games WHERE points_home IS NULL
			 ORDER BY fixtures_day,id ASC";
		$result = $this->conn->query($sql);
	
		$game = new Game();
		
		if($row = $result->fetch_assoc()) {
			$game->id = $row["id"];
			$game->teamAway = $this->getTeamById($row["team_away_id"], 0);
			$game->teamHome = $this->getTeamById($row["team_home_id"], 0);
			$game->pointsAway = $row["points_away"];
			$game->pointsHome = $row["points_home"];
			$game->day = $row["fixtures_day"];
		}else {
			return null;
		}
		
		return $game;
	}
	
	function createGame($team1, $team2, $day) {
		$sql= "INSERT INTO games (
				team_away_id,
				team_home_id,
				fixtures_day
			)VALUES (
				'" . $team1->id . "',
				'" . $team2->id . "',
				'" . $day . "'
			)";
		mysqli_query($this->conn, $sql);
		Logger::debug("created game " . $team1->name . " vs " . $team2->name);
	}
		
	function insertTeamToGroup($gid, $tid) {
		$sql= "INSERT INTO groups (gid, tid) VALUES ('" . $gid . "', '" . $tid . "')";
		mysqli_query($this->conn, $sql);
		Logger::debug("inserted team into group");
	}
	
	function updatePersist($key, $value) {
		Logger::info("changing persist value");
		$sql= "UPDATE persist SET thevalue='" . $value . "' WHERE thekey='" . $key . "' ";
		mysqli_query($this->conn, $sql);
		Logger::info("changed persist value!");
	}

	function getPersist($key) {
		
		$sql= "SELECT * FROM persist WHERE thekey='" . $key . "' ";
		$result = $this->conn->query($sql);
		
		if($row = $result->fetch_assoc()) {
			return $row["thevalue"];	
		}
		return "null";
	}
	
	function getGamesByFixtureDay($day) {
			
		$sql= "SELECT * FROM games WHERE fixtures_day=" . $day;
		$result = $this->conn->query($sql);
	
		$games = array();
		
		while($row = $result->fetch_assoc()) {
			$games[] = $this->getGameById($row["id"]);	
		}

		return $games;
	}
	
	function getGameById($game_id) {
		
		$sql= "SELECT * FROM games WHERE id=" . $game_id;
		$result = $this->conn->query($sql);
	
		$game = new Game();
		
		if($row = $result->fetch_assoc()) {
			$game->id = $row["id"];
			$game->teamAway = $this->getTeamById($row["team_away_id"], 0);
			$game->teamHome = $this->getTeamById($row["team_home_id"], 0);
			$game->pointsAway = $row["points_away"];
			$game->pointsHome = $row["points_home"];
		}
		return $game;
	}
	
	function getTeamsfromGroupId($gid) {
		
		$sql= "SELECT * FROM GROUPS WHERE gid=" . $gid;
		$result = $this->conn->query($sql);
		
		if($gid < 7){
			$modif = 100;
		}elseif($gid < 11) {
			$modif = 1000;
		}else {
			$modif = 0;
		}		
		
		$teams = array();
		
		while($row = $result->fetch_assoc()) {
			$teams[] = $this->getTeamById($row["tid"], $modif);	
		}
		
		usort($teams, "sortTeams");
		return $teams;
	}
	
	function getTeamById($id, $modif) {
	
		$sql= "SELECT * FROM teams 
			INNER JOIN stats
			ON stats.id=teams.id+" . $modif.
			" WHERE teams.id=" . $id;
		$result = $this->conn->query($sql);
	
		$team = new Team();
		
		if($row = $result->fetch_assoc()) {
			$team->id = $row["id"] % 100;
			$team->name = $row["name"];
			$team->W = $row["W"];
			$team->L = $row["L"];
			$team->PS = $row["PS"];
			$team->PC = $row["PC"];
		}
		return $team;
	}
	
	function getAllTeamsRanked() {

		$sql= "SELECT * FROM teams ";
		$result = $this->conn->query($sql);
	
		$teamsAll = array();
		$teams18 = array();
		$teams12 = array();
		$teams8 = array();
		$teams4 = array();
		$teams2 = array();
		$teams1 = array();
	
		while($row = $result->fetch_assoc()) {
			$teamsAll[] = $this->getTeamById($row["id"], 100);
		}	
	
		foreach($teamsAll as $team) {

			if($this->getTeamById($team->id, 10000000)->PS != 0) {
				$teams1[] = $this->getTeamById($team->id, 0);
				continue;
			}
			
			if($this->getTeamById($team->id, 1000000)->PS != 0) {
				$teams2[] = $this->getTeamById($team->id, 0);
				continue;
			}

			if($this->getTeamById($team->id, 100000)->PS != 0) {
				$teams4[] = $this->getTeamById($team->id, 0);
				continue;
			}
			
			if($this->getTeamById($team->id, 10000)->PS != 0) {
				$teams8[] = $this->getTeamById($team->id, 0);
				continue;
			}
	
			if($this->getTeamById($team->id, 1000)->PS != 
				$this->getTeamById($team->id, 100)->PS
			) {
				$teams12[] = $this->getTeamById($team->id, 1000);
				continue;
			}
			
			$teams18[] = $team;
			
		}
		
		usort($teams18, "sortTeams");
		usort($teams12, "sortTeams");
		usort($teams8, "sortTeams");
		usort($teams4, "sortTeams");
		usort($teams2, "sortTeams");		
		usort($teams1, "sortTeams");
			
		$teams = array();

		foreach($teams1 as $team) {		
			$teams[] = $team;	
		}
		
		foreach($teams2 as $team) {		
			$teams[] = $team;	
		}

		foreach($teams4 as $team) {		
			$teams[] = $team;	
		}

		foreach($teams8 as $team) {		
			$teams[] = $team;	
		}
		
		foreach($teams12 as $team) {		
			$teams[] = $team;	
		}
	
		foreach($teams18 as $team) {		
			$teams[] = $team;	
		}
		
		return $teams;
	}
}

?>
