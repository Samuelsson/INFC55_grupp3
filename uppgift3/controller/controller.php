<?

$path = dirname(dirname(__FILE__));
require ($path . '/model/config.php');
require (PATH . '/view/inc/functions.php');
require (PATH . '/dal/UserDal.php');
require (PATH . '/dal/CupDal.php');
require (PATH . '/dal/DivisionDal.php');
require (PATH . '/dal/TeamDal.php');
require (PATH . '/dal/MatchDal.php');
require (PATH . '/dal/Dal.php');
require (PATH . '/model/User.php');
require (PATH . '/model/Division.php');
require (PATH . '/model/Team.php');
require (PATH . '/model/Cup.php');
require (PATH . '/model/Match.php');
require (PATH . '/model/Helper.php');
require (PATH . '/bll/BusinessLogic.php');
require (PATH . '/model/Player.php');
require (PATH . '/dal/PlayerDal.php');

global $LOGGED_IN; //Global indicating user login state.
global $CURRENT_USER; //Global pointing at the current user object.
$LOGGED_IN = false;

class Controller
{
	public $viewFunc;
	public $dal;
	public $dbh;
	private $userDal;
	private $cupDal;
	private $divisionDal;
	private $teamDal;
	private $matchDal;
	private $helper;
	private $bll;
	private $playerDal;

	public function __construct() {
		$this->viewFunc = New ViewFunc;
		$this->dal = New Dal;
		$this->dbh = $this->dal->dbHandle();
		$this->userDal = New UserDal($this->dbh);
		$this->cupDal = New CupDal($this->dbh);
		$this->divisionDal = New DivisionDal($this->dbh);
		$this->teamDal = New TeamDal($this->dbh);
		$this->matchDal = New MatchDal($this->dbh);
		$this->helper = New Helper($this);
		$this->teamDal = New TeamDal($this->dbh);
		$this->playerDal = New PlayerDal($this->dbh);
		$this->bll = New BusinessLogic;
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
		return $this->viewFunc->getUrl($subDir);
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

	public function getCupMasters() {
		return $this->userDal->getCupMasters();
	}

	/*===================Cup======================*/
	public function getAllCups() {
		return $this->cupDal->getAllCups();
	}

	public function getCup($cid) {
		return $this->cupDal->getCup($cid);
	}

	public function getLatestCupForUser($uid) {
		$cup = $this->cupDal->getLatestCupForUser($uid);
		$cup->cupMaster = $this->getUser($uid);
		$cup->divisionList = $this->getDivisionsForCup($cup->cupId);
		foreach($cup->divisionList as $d){
			echo $d->name;
		}

		return $cup;
	}

	public function getLatestCup() {
		return $this->cupDal->getLatestCup();
	}

	public function createCupWithDivisions($cupArr, $divisionArr) {
		$userId = $cupArr['userId'];
		$this->create('Cups', $cupArr);
		$cup = $this->getLatestCupForUser($userId);


		$keys = array('name', 'matchDuration', 'cupId');
		foreach ($divisionArr as $old) {
			$old[] = $cup->cupId;
			$d = array_combine($keys, $old);
			$this->create('Divisions', $d);
		}
	}

	/* 
	Maybe change this functions. It is called from the cup_details-page,
	but at the moment it is only the divisionList which is used on that page.
	The foreach loop is useless at the monent.
	*/
	public function getCupEager($cupId) {
		$cup = $this->cupDal->getCup($cupId);
		$cup->cupMaster = $this->getUser($cup->userId);
		$cup->divisionList = $this->getDivisionsForCup($cup->cupId);

		/*
		foreach($cup->divisionList as $division) {
			$division->teamList = $this->teamDal->getTeamsForDivision($division->divisionId);	
			$division->matchList = $this->matchDal->getMatchesForDivision($division->divisionId);
		}
		*/
		
		return $cup;
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

	public function setSpecificAccess($levels) {
		return $this->helper->setSpecificAccess($levels);
	}

	public function accessLink($levels, $url, $text) {
		return $this->helper->accessLink($levels, $url, $text);
	}

	/**
	 * Returns a boolean indicating if the username and password combination was found and correct
	 * @param $email User email
	 * @param $pwd User password
	 */
	public function checkLogin($email, $pwd) {
		return $this->helper->checkLogin($email, $pwd);
	}

	//===================TEAMS=========================
	public function getAllTeams() {
		return $this->teamDal->getAllTeams();
	}

	public function getTeam($tid) {
		return $this->teamDal->getTeam($tid);
	}

	public function getTeamsForDivision($did) {
		return $this->teamDal->getTeamsForDivision($did);
	}

	function getAllTeamsNotInCup($cid) {
		return $this->teamDal->getAllTeamsNotInCup($cid);
	}

	//=================PLAYERS=======================
	public function getPlayersByTeam($tid) {
		return $this->playerDal->getPlayersByTeam($tid);
	}

	//================DIVISIONS======================
	public function getDivisionEager($did) {
	
		$division = $this->divisionDal->getDivision($did);

		$division->cup = $this->cupDal->getCup($division->cupId);
	
		$division->teamList = $this->getTeamsForDivision($division->divisionId);
		
		$division->matchList = $this->matchDal->getMatchesForDivision($division->divisionId);
		foreach($division->matchList as $match) {
				$match->homeTeam = $this->getTeam($match->homeTeamId);
				$match->awayTeam = $this->getTeam($match->awayTeamId);
		}

		$division = $this->bll->calculateGroup($division);
		$division->teamList = $this->sortResultByPoints($division->teamList);
		return $division;
	}

	public function getDivisionsForCup($cid) {
		return $this->divisionDal->getDivisionsForCup($cid);
	}

	public function getDivision($did) {
		return $this->divisionDal->getDivision($did);
	}

	public function generateScheduleForDivision($did) {
		$teams = $this->getTeamsForDivision($did);
		return $this->bll->generateSchedule($teams);

	}

	public function sortResultByPoints($teams) {
		return $this->bll->sortResultByPoints($teams);
	}

	//===================MATCHES===================
	public function getMatch($mid) {
		return $this->matchDal->getMatch($mid);
	}

	public function getMatchEager($mid) {
		$match = $this->getMatch($mid);

		$match->division = $this->getDivision($match->divisionId);
		$match->division->cup = $this->getCup($match->division->cupId);
		$match->homeTeam = $this->getTeam($match->homeTeamId);
		$match->awayTeam = $this->getTeam($match->awayTeamId);

		return $match;
	}
}


?>