<?

$path = dirname(dirname(__FILE__));
require ($path . '/model/config.php');
require (PATH . '/view/inc/functions.php');
require (PATH . '/dal/UserDal.php');
require (PATH . '/dal/Dal.php');
require (PATH . '/model/User.php');
require (PATH . '/model/Helper.php');
global $LOGGED_IN;
global $CURRENT_USER; //Den inloggade användarens objekt.
$LOGGED_IN = false;


class Controller
{
	public $viewFunc;
	public $dal;
	public $dbh;
	private $userDal;
	private $helper;

	public function __construct() {
		$this->viewFunc = New ViewFunc;
		$this->dal = New Dal;
		$this->dbh = $this->dal->dbHandle();
		$this->userDal = New UserDal($this->dbh);
		$this->helper = New Helper($this);
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

	public function save($obj) {
		$this->dal->save($obj, $this->dbh);
	}

	public function create($tableName, $arr) {
		$this->dal->create($tableName, $arr);
	}

	/*==================User======================*/
	public function getUser($userId) {
		return $this->userDal->getUser($userId);
	}

	//Use foreach($controller->getAllUsers() as $user)
	public function getAllUsers() {
		return $this->userDal->getAllUsers();
	}

	//==================HELPER========================
	public function checkLoggedInCookie() {
		$this->helper->checkLoggedInCookie();
	}

	public function login($email, $pwd) {
		$this->helper->login($email, $pwd);
	}

	public function logout() {
		$this->helper->logout();
	}

	public function setAccessLevel($lvl) {
		$this->helper->setAccessLevel($lvl);
	}

	/**
	 * Returns a boolean indicating if the username and password combination was found and correct
	 * @param $email User email
	 * @param $pwd User password
	 */
	public function checkLogin($email, $pwd) {
		return $this->helper->checkLogin($email, $pwd);
	}

}


?>