<?php

class Controller
{
	private $id = "Hello world";

	function setId($id)
	{
    	$this->id = $id;
	}

	function getId()
	{
		return $this->id;
	}
}


?>