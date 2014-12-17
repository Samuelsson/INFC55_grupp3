<?
require (basename(dirname($_SERVER['PHP_SELF'])) . '/model/config.php');
require ($_SERVER['DOCUMENT_ROOT'] . PATH . '/dal/Dbh.php');
require ($_SERVER['DOCUMENT_ROOT'] . PATH . '/view/inc/functions.php');


class Controller
{
	public $viewFunc;
	public $dbh;

	public function __construct()
	{
		$this->viewFunc = New ViewFunc;
		$this->dbh = New Dbh;
	}

	//---------------View functions--------------
	//  			( . Y . )

	public function getHeader()
	{
		return $this->viewFunc->getHeader();
	}

	public function getSidebarRight()
	{
		return $this->viewFunc->getSidebarRight();
	}

	function getFooter()
	{
		return $this->viewFunc->getFooter();
	}

	//----------------Database functions----------

	public function getDbh()
	{
		return $this->dbh->dbHandle();
	}


}


?>