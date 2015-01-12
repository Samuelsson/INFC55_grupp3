<?php

class User {


	/**
	 *Saves the user 
	 * @param $controller The controller
	 */
	function save($controller) {
		$controller->save($this);
	}

}

?>