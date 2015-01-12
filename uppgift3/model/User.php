<?php

class User {



	/**
	 *Saves the user 
	 * @param $controller The controller
	 */
	function save($controller) {
		$controller->save($this);
	}

	function getAllUsers() {
			$sqlQuery = "SELECT * FROM Users";
			return $this->dbh->query($sqlQuery);
		}

}

?>