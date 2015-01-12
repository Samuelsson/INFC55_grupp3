<?php

	class MatchDal
	{
		private $dbh;

		function __construct($dbh)	{
			$this->dbh = $dbh;
		}

		function getMatchesForDivision($divisionId) {
			$query = $this->dbh->query("SELECT * FROM Matches WHERE divisionId = '$divisionId';");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'Match');
			return $query->fetchAll();		
		}
	}


?>