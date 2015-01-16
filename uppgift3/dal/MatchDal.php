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

		function getMatch($mid) {
			$query = $this->dbh->query("SELECT * FROM Matches WHERE matchId = '$mid';");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'Match');
			return $query->fetch();	
		}

		function save($obj)	{
		//This part generates an SQL-string based on the attributes.
		 $vars = get_object_vars($obj);  	//Get all attributes
		 $firstKey = key($vars); 			//Save the primary key
		 $firstValue = array_shift($vars); 			//Save and remove the primary key value
		 $sqlQuery = "UPDATE " . get_class($obj) . "es SET "; 			//Generate the first part, gets the table name.
		 foreach ($vars as $key => $value) {			 //Add the attributes and attribute names to the string.
		 	$sqlQuery = $sqlQuery . "$key='$value', ";
		 }
		 $sqlQuery = trim($sqlQuery, ", ") . " WHERE $firstKey = $firstValue"; 			//Identify the row with the primary key
		 $query = $this->dbh->prepare($sqlQuery);
		 $query->execute();
		}
	}

	


?>