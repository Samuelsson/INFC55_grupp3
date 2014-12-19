<?

$path = dirname(dirname(__FILE__));
require ($path . '/model/config.php');
require (PATH . '/view/inc/functions.php');
require (PATH . '/dal/UserDal.php');
require (PATH . '/dal/Dal.php');
require (PATH . '/model/User.php');


class Controller
{
	public $viewFunc;
	public $dal;
	private $dbh;
	private $userDal;

	public function __construct() {
		$this->viewFunc = New ViewFunc;
		$this->dal = New Dal;
		$this->dbh = $this->dal->dbHandle();
		$this->userDal = New UserDal($this->dbh);

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

	/*==================User======================*/
	public function getUser($userId) {
		return $this->userDal->getUser($userId);
	}

	public function saveUser($usr) {
		$this->dal->save($usr, $this->dbh);
	}

}


?>