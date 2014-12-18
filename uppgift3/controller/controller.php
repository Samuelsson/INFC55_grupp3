<?

$path = dirname(dirname(__FILE__));
require ($path . '/model/config.php');
require (PATH . '/dal/Dbh.php');
require (PATH . '/view/inc/functions.php');
require (PATH . '/dal/Dal.php');


class Controller
{
	public $viewFunc;
	public $dal;

	public function __construct() {
		$this->viewFunc = New ViewFunc;
		$this->dal = New Dal;
	}

	//---------------View functions--------------
	//  			( . Y . )

	public function getHeader() {
		return $this->viewFunc->getHeader();
	}

	public function getSidebarRight() {
		return $this->viewFunc->getSidebarRight();
	}

	public function getFooter() {
		return $this->viewFunc->getFooter();
	}

	/**
	*Echos the path given based on webserver root
	*@param $subdir Path to document from site root.
	*/
	public function getURL($subDir) {
		echo $this->viewFunc->getUrl($subDir);
	}

	//----------------Database functions----------

	public function getDbh() {
		return $this->dal->dbHandle();
	}

}


?>