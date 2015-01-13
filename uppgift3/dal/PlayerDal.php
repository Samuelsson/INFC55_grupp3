<?php

	class PlayerDal {

		private $dbh;

		function __construct($dbh) {
			$this->dbh = $dbh;
		}

		function getPlayersByTeam($tid) {
			$sqlquery = "SELECT * FROM Players WHERE teamId = '$tid'";
			return $this->dbh->query($sqlquery);
		}

	}

?>