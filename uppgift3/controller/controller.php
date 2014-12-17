<?php
namespace "test";


class Controller
{
	private $id;

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