<?php

class TeamDal {

	private $dbh;

	function __construct($dbh) {
		$this->dbh = $dbh;
	}

	function getAllTeams() {
		$sqlQuery = "SELECT * FROM Teams";
		$query = $this->dbh->query($sqlQuery);
		$query->setFetchMode(\PDO::FETCH_CLASS, 'Team');
		return $query->fetchAll();
	}


	function getTeamsForCup($cupId) {
		$query = $this->dbh->query(
			"SELECT * FROM Teams WHERE teamId IN ( 
				SELECT teamId FROM DivisionTeam WHERE divisionId IN ( 
					SELECT divisionId FROM Divisions WHERE cupId = '$cupId' 
					) 
				)");
		$query->setFetchMode(\PDO::FETCH_CLASS, 'Team');
		return $query->fetchAll();
	}

	function getTeamsForDivision($divisionId) {
		$query = $this->dbh->query("SELECT * FROM Teams WHERE teamId IN 
			(SELECT teamId FROM DivisionTeam WHERE divisionId = '$divisionId')");
		$query->setFetchMode(\PDO::FETCH_CLASS, 'Team');

		return $query->fetchAll();
	}

	function getTeam($teamId) {
		$query = $this->dbh->query("SELECT * FROM Teams WHERE teamId = '$teamId'");
		$query->setFetchMode(\PDO::FETCH_CLASS, 'Team');
		return $query->fetch();		
	}

	function getAllTeamsNotInCup($cid) {
		$sql = "SELECT * 
				FROM Teams
				WHERE teamId NOT IN (
					SELECT teamId 
				    FROM DivisionTeam
					WHERE divisionId IN (
						SELECT divisionId 
						FROM Divisions
						WHERE cupId = $cid
				        )
				   	);";
		$query = $this->dbh->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS, 'Team');
		return $query->fetchAll();
	}
}

?>