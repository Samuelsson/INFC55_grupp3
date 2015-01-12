<?php

	class TeamDal
	{
		private $dbh;

		function __construct($dbh)	{
			$this->dbh = $dbh;
		}

		function getTeam($teamId) {
			
			$query = $this->dbh->query("SELECT * FROM Teams WHERE teamId = '$teamId'");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'Team');

			return $query->fetch();
		}

		function getAllTeams() {
			$query = $this->dbh->query("SELECT * FROM Teams");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'Team');

			return $query->fetchAll();
		}
	}

?>