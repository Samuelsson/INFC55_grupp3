<?php

require_once(PATH . '/model/Team.php');
require_once(PATH . '/model/Division.php');
require_once(PATH . '/model/Match.php');

class BusinessLogic {
	public function calculateGroup($division) {
		$teams = $division->teamList;
		$matches = $division->matchList;

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
				if($m->type === 'Group') {
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
						} elseif($tie === true && $m->status === 'finished') {
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
				} elseif ($m->type === 'Final') {
					if($m->homeScore > $m->awayScore){
						$division->firstPlace = $m->homeTeam;
						$division->secondPlace = $m->awayTeam;
					} elseif($m->awayScore > $m->homeScore) {
						
						$division->firstPlace = $m->awayTeam;
						$division->secondPlace = $m->homeTeam;
					}
				} elseif ($m->type === 'ThirdPlace') {
					if($m->homeScore > $m->awayScore){
						$division->thirdPlace = $m->homeTeam;
					} elseif($m->awayScore > $m->homeScore) {
						
						$division->thirdPlace = $m->awayTeam;
					}
				}
			}

		}
		$division->matchList = $matches;
		$division->teamList = $teams;
		return $division;
	}

	public function generateSchedule($teams){
		shuffle($teams);
		if(count($teams) % 2 == 0) {
			return $this->generateEven($teams);
		} elseif(count($teams)) {
			return $this->generateUneven($teams);
		}
			
	}

	public function generateEven($teams) {
		$matchList = array(); // the list that will contain all the matches.
		$nrOfRounds = (count($teams) -1);
		$nrOfMatchesPerRound = (count($teams) / 2);
		$roundNr = 1;

		// Begin X for-loop
		for($x = 0 ; $x < $nrOfRounds ; $x++){
		
			$firstPos = 0;
			$lastPos = $nrOfRounds; /* $nrOfRounds is essentially the last position since it is assigned count($teams) - 1 in the beginning of the function */
		
			// Begin Y for-loop
			for($y = 0 ; $y < $nrOfMatchesPerRound ; $y++) {		

				$matchList[] = $this->createMatch($teams[$firstPos], $teams[$lastPos], $roundNr);

				$firstPos += 1;
				$lastPos -= 1;
			} // End Y for-loop
			$roundNr++;
			

			$temp = $teams[$nrOfRounds]; /* Again, nrOfRounds is essentially last value in the array */
			for($z = count($teams) -2 ; $z > 0; $z--) {
				$teams[$z+1] = $teams[$z];
			}
			$teams[1] = $temp;
		} //End  X-for loop

		return $matchList;
	} // end function

	public function generateUneven($teams) {
		$matchList = array(); // the list that will contain all the matches.
		$nrOfRounds = (count($teams) -1);
		$nrOfMatchesPerRound = (count($teams) / 2);
		$roundNr = 1;

		// Begin X for-loop
		for($x = 0 ; $x < $nrOfRounds ; $x++){
		
			$firstPos = 0;
			$lastPos = $nrOfRounds; /* $nrOfRounds is essentially the last position since it is assigned count($teams) - 1 in the beginning of the function */
		
			// Begin Y for-loop
			for($y = 0 ; $y < $nrOfMatchesPerRound ; $y++) {		

				$matchList[] = $this->createMatch($teams[$firstPos], $teams[$lastPos], $roundNr);

				$firstPos += 1;
				$lastPos -= 1;
			} // End Y for-loop
			$roundNr++;
			

			$temp = $teams[$nrOfRounds]; /* Again, nrOfRounds is essentially last value in the array */
			for($z = count($teams) -2 ; $z > 0; $z--) {
				$teams[$z+1] = $teams[$z];
			}
			$teams[1] = $temp;
		} //End  X-for loop
	}

	public function createMatch($firstTeam, $secondTeam, $roundNr) {
		$match = new Match;
		$match->round = $roundNr;
		$match->type = 'Group';

		$everydayImShuffling = array($firstTeam, $secondTeam);
		shuffle($everydayImShuffling);
		
		$match->homeTeam = $everydayImShuffling[0];
		$match->awayTeam = $everydayImShuffling[1];

		return $match;
	}

	/* Sorting function using bubble-algorithm */
	public function sortResultByPoints($teams) {

		$size = count($teams);

		for($i = 0 ; $i < $size ; $i++) {
			for($j = 0 ; $j < $size; $j++){
				if($teams[$i]->points > $teams[$j]->points){
					$temp = $teams[$i];
					$teams[$i] = $teams[$j];
					$teams[$j] = $temp;
				}
			}
		}

		for($x = 0; $x < $size; $x++){
			$teams[$x]->position = $x+1;
		}
		
		return $teams;
	}

	public function calculateSemifinals($matchList){
		$semifinals = array();
		$first = $matchList[0];
		$second = $matchList[1];
		$third = $matchList[2];
		$forth = $matchList[3];

		$match1->homeTeam = $first;
		$match1->awayTeam = $forth;
		$match1->type = 'Semifinal';


		$match2->homeTeam = $second;
		$match2->awayTeam = $third;
		$match2->type = 'Semifinal';

		$semifinals[] = $match1;
		$semifinals[] = $match2;

		return $semifinals;
	}
	public function calculateFinals($match1, $match2){
		if($match1->homeScore > $match1->awayScore) {
			$finalist1 = $match1->homeTeam;
			$bronze1 = $match1->awayTeam;
		} else {
			$finalist1 = $match1->awayTeam;
			$bronze1 = $match1->homeTeam;
		}

		if($match2->homeScore > $match2->awayScore) {
			$finalist2 = $match2->homeTeam;
			$bronze2 = $match2->awayTeam;
		} else {
			$finalist2 = $match2->awayTeam;
			$bronze2 = $match2->homeTeam;
		}

		$final->homeTeam = $finalist1;
		$final->awayTeam = $finalist2;
		$final->type = 'Final';

		$bronze->homeTeam = $bronze1;
		$bronze->awayTeam = $bronze2;
		$bronze->type = 'ThirdPlace';

		$finals = array("Final" => $final, "Bronze" => $bronze);
		return $finals;
	}
}


?>