<?php

class TeamDal {

	private $dbh;

	function __construct($dbh) {
		$this->dbh = $dbh;
	}

	function getAllTeams() {
		$sqlQuery = "SELECT * FROM Teams";
		return $this->dbh->query($sqlQuery);
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
}

?>