<?php

class BusinessLogic {
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