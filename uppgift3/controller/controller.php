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

	/*===================Cup======================*/
	public function getAllCups() {
		return $this->cupDal->getAllCups();
	}

	public function getCupEager($cupId) {
		$cup = $this->cupDal->getCup($cupId);

		$cup->divisionList = $this->divisionDal->getDivisionsForCup($cup->cupId);

		foreach($cup->divisionList as $division) {
			
			$division->teamList = $this->teamDal->getTeamsForDivision($division->divisionId);	
			$division->matchList = $this->matchDal->getMatchesForDivision($division->divisionId);
			
			foreach($division->matchList as $match) {
				$match->homeTeam = $this->teamDal->getTeam($match->homeTeamId);
				$match->awayTeam = $this->teamDal->getTeam($match->awayTeamId);
			}

			$division->teamList = $this->calculateGroup($division->teamList, $division->matchList);
		}

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


	//=============OTHER STUFF============

	public function calculateGroup($teams, $matches ) {
		foreach ($teams as $t) {
			$t->points = 0;
			$t->wins = 0;
			$t->ties = 0;
			$t->losses = 0;
			$t->goalsScored = 0;
			$t->goalsConceded = 0;
		}

		if(isset($matches) && !empty($teams) && isset($teams) && !empty($teams)){
			foreach($matches as $m){
				if($m->type === 'Group'){
					$tie = false;
					$winner = new Team;
					$loser = new Team;

					$winner->goalsScored = 0;
					$winner->goalsConceded = 0;
					$loser->goalsScored = 0;
					$loser->goalsConceded = 0;
					
					if($m->homeScore === $m->awayScore){
						
						$tie = true;
						$winner = $m->homeTeam;
						$winner->goalsScored = $m->homeScore;
						$winner->goalsConceded = $m->awayScore;

						$loser = $m->awayTeam;
						$loser->goalsScored = $m->awayScore;
						$loser->goalsConceded = $m->homeScore;

					} elseif($m->homeScore > $m->awayScore){
					
						$winner = $m->homeTeam;
						$winner->goalsScored = $m->homeScore;
						$winner->goalsConceded = $m->awayScore;

						$loser = $m->awayTeam;
						$loser->goalsScored = $m->awayScore;
						$loser->goalsConceded = $m->homeScore;

					} elseif($m->awayScore > $m->homeScore) {
						
						$winner = $m->awayTeam;
						$winner->goalsScored = $m->awayScore;
						$winner->goalsConceded = $m->homeScore;

						$loser = $m->homeTeam;
						$loser->goalsScored = $m->homeScore;
						$loser->goalsConceded = $m->awayScore;
					}

					foreach($teams as $t) {
						if($tie === false) {
							if($t->teamId === $winner->teamId){
								$t->points +=3;
								$t->wins +=1;

								$t->goalsScored += $winner->goalsScored;
								$t->goalsConceded += $winner->goalsConceded;

							} elseif($t->teamId === $loser->teamId){
								$t->losses +=1;
								$t->goalsScored += $loser->goalsScored;
								$t->goalsConceded += $loser->goalsConceded;

							}
						} elseif($tie === true) {
							if($t->teamId === $winner->teamId) {
								$t->ties +=1;
								$t->points +=1;
								$winner->goalsScored = $m->homeScore;
								$winner->goalsConceded = $m->awayScore;
							} elseif($t->teamId === $loser->teamId) {
								$t->ties +=1;
								$t->points +=1;
								$loser->goalsScored = $m->awayScore;
								$loser->goalsConceded = $m->homeScore;
							}
						}
					}
				}
			}

		} 
		return $teams;
	}
}


?>