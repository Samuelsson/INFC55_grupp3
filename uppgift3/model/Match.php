<?php

class Match {
	function save($controller) {
		$controller->matchDal->save($this);
	}
}

?>