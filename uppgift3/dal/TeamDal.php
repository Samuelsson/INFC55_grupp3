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
}

?>