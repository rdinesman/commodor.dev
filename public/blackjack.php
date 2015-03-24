<?php
// blackjack.php /////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
// GLOBAL VARIABLES //////////////////////////////////////////////////////////////
	// an array of all card suits
	$suits = ['♣', '♥', '♠', '♦'];
	// an array of all card values
	$cards = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
//                                                                             ///
// GLOBAL FUNCTIONS //////////////////////////////////////////////////////////////
	function buildDeck($suits, $cards) {
		// build a deck (array) of cards
		// card values should be "VALUE SUIT". ex: "7 H"
		// make sure to shuffle the deck before returning it
	  $newDeck = [];
	  foreach($suits as $s){
	  	foreach($cards as $c){
	  		array_push($newDeck, [$c, $s]);
	  	}
	  }
	  shuffle($newDeck);
	  return $newDeck;
	}

	function cardIsAce($card) {
		// determine if a card is an ace
		// return true for ace, false for anything else
	  if ($card[1] == 'A'){
	  	return true;
	  }
	  else{
	  	return false;
	  }
	}

	function getCardValue($card) {
		// determine the value of an individual card (string)
		// aces are worth 11
		// face cards are worth 10
		// numeric cards are worth their value
	  $val = $card[0];
	  if (is_numeric($val)){
	  	return (int)$val;
	  }
	  elseif($val != 'A'){
	  	return 10;
	  }
	  else{
	  	return 11;
	  }
	}

	function getHandTotal($hand) {
		// get total value for a hand of cards
		// keeps track of all aces, and if you're over 21 it'll compensate
		$tot = 0;
		$numAces = 0;
	  foreach($hand as $card){
	  	$tot += getCardValue($card);
	  	if (getCardValue($card) == 11){
	  		$numAces++;
	  	}
	  }
	  if ($tot <= 21){
	  	return $tot;
	  }
	  else{
	  	while ($tot > 21 && $numAces > 0){
	  		$tot -= 10;
	  		$numAces--;
	  	}
	  	return $tot;
	  }
	}

	function drawCard(&$hand, &$deck) {
		// draw a card from the deck into a hand
	 	array_push($hand, $deck[0]);
	 	array_shift($deck);
	}

	function echoHand($hand, $name, $hidden = false, $line = 0) {
		// print out a hand of cards
		// if hidden is true, it will hide every card after the first one

		$hide = 0;
	  	foreach ($hand as $card) {
	  		
		  	switch ($line){
		  		case(0):
		  			echo " _____  ";
		  			$hide = 1;
		  			break;
			  	case(1):
				  	if ($hidden && $hide == 1)
					  	echo "|     | ";
			  		else{
			  			if (!is_numeric($card[0]) && $card[0] != 'A'){
					  		echo "|{$card[0]}  WW| ";
					  	}
					  	elseif ($card[0] == 'A'){
					  		if ($card[1] == '♠')
						  		echo "|A .  | ";
						  	if ($card[1] == '♣')
						  		echo "|A _  | ";
						  	if ($card[1] == '♥')
						  		echo "|A_ _ | ";
						  	if ($card[1] == '♦')
						  		echo "|A ^  | ";
					  	}
					  	elseif ($card[0] == 10)
					  		echo "|{$card[0]} {$card[1]} | ";
					  	elseif ($card[0] < 10)
					  		echo "|{$card[0]}    | ";
					  }
			  		$hide = 1;
			  		break;
			  	case(2):
			  		if ($hidden && $hide == 1)
						echo "|\\\\\\\\\\| ";
				  	else{
				  		if ($card[0] == 'A') {
					  		if ($card[1] == '♠')
					  			echo "| /.\ | ";
					  		if ($card[1] == '♣')
					  			echo "| ( ) | ";
					  		if ($card[1] == '♥')
						  		echo "|( v )| ";
						  	if ($card[1] == '♦')
						  		echo "| / \\ | ";
					  	}
					  	elseif ($card[0] == 'J' || $card[0] == 'K') {
					  		if ($card[1] == '♠')
						  		echo "| ^ {)| ";
							if ($card[1] == '♣')
								echo "| o {)| ";
							if ($card[1] == '♥')
								echo "|   {)| ";
							if ($card[1] == '♦')
								echo "| /\\{)| ";
					  	}
					  	elseif ($card[0] == 'Q') {
					  		if ($card[1] == '♠')
						  		echo "| ^ {(| ";
						  	if ($card[1] == '♣')
						  		echo "| o {(| ";
						  	if ($card[1] == '♥')
						  		echo "|   {(| ";
						  	if ($card[1] == '♦')
						  		echo '| /\\{(| ';
					  	}
					  	elseif ($card[0] == 2){
				  			echo "|  {$card[1]}  | ";
				  		}
				  		elseif ($card[0] < 8){
					  		echo "| {$card[1]} {$card[1]} | ";
					  	}
					  	elseif ($card[0] == 8 || $card[0] == 9 || $card[0] == 10){
					  		echo "|{$card[1]} {$card[1]} {$card[1]}| ";
					  	}
					  	
					  }
			  		$hide = 1;
			  		break;
			  	case(3):
			  		if ($hidden && $hide == 1)
						echo "|/////| ";
				  	else{
				  		if ($card[0] == 'J') {
					  		if ($card[1] == '♠')
						  		echo "|(.)% | ";
						  	if ($card[1] == '♣')
						  		echo "|o o% | ";
						  	if ($card[1] == '♥')
						  		echo "|(v)% | ";
						  	if ($card[1] == '♦')
						  		echo "| \\/% | ";
					  	}
					  	elseif ($card[0] == 'Q' || $card[0] == 'K') {
					  		if ($card[1] == '♠')
						  		echo "|(.)%%| ";
						  	if ($card[1] == '♣')
						  		echo "|o o%%| ";
						  	if ($card[1] == '♥')
						  		echo "|(v)%%| ";
						  	if ($card[1] == '♦')
						  		echo "| \\/$$| ";
					  	}
					  	elseif ($card[0] == 'A') {
					  		if ($card[1] == '♠')
						  		echo "|(_._)| ";
						  	if ($card[1] == '♣')
						  		echo "|(_'_)| ";
						  	if ($card[1] == '♥' || $card[1] == '♦')
						  		echo '| \\ / | ';
					  	}
					  	elseif ($card[0] < 5){
				  			echo "|     | ";
				  		}
				  		elseif ($card[0] == 5){
				  			echo "|  {$card[1]}  | ";
				  		}
				  		elseif ($card[0] == 6 || $card[0] == 8){
					  		echo "| {$card[1]} {$card[1]} | ";
					  	}
					  	elseif ($card[0] == 7 || $card[0] == 9 || $card[0] == 10){
					  		echo "|{$card[1]} {$card[1]} {$card[1]}| ";
					  	}
					  	
					  }
			  		$hide = 1;
			  		break;
			  	case(4):
				  	if ($hidden && $hide == 1)
						echo "|\\\\\\\\\\| ";
				  	else{
				  		if ($card[0] == 'J') {
					  		if ($card[1] == '♠' || $card[1] == '♣')
						  		echo "| | % | ";
						  	if ($card[1] == '♥')
						  		echo '| v % | ';
						  	if ($card[1] == '♦')
						  		echo "|  %  | ";
					  	}
					  	elseif ($card[0] == 'Q' || $card[0] == 'K') {
					  		if ($card[1] == '♠' || $card[1] == '♣')
						  		echo "| |%%%| ";
						  	if ($card[1] == '♥')
						  		echo '| v%%%| ';
						  	if ($card[1] == '♦')
						  		echo '|  %%%| ';
					  	}
					  	elseif ($card[0] == 'A') {
					  		if ($card[1] == '♠' || $card[1] == '♣')
						  		echo "|  |  | ";
						  	if ($card[1] == '♥' || $card[1] == '♦')
						  		echo '|  v  | ';
					  	}
					  	elseif ($card[0] < 4){
				  			echo "|  {$card[1]}  | ";
				  		}
				  		elseif ($card[0] < 8){
					  		echo "| {$card[1]} {$card[1]} | ";
					  	}
					  	elseif ($card[0] == 8 || $card[0] == 9 || $card[0] == 10){
					  		echo "|{$card[1]} {$card[1]} {$card[1]}| ";
					  	}
					  	
					  }
			  		$hide = 1;
			  		break;
			  	default:
			  		if ($hidden && $hide == 1)
				  		echo "|_____| ";

				  	else{
				  		if ($card[0] == "J")
				  			echo "|__&&J| ";
				  		elseif($card[0] == "Q" || $card[0] == "K")
				  			echo "|_%%%{$card[0]}| ";
				  		elseif ($card[0] == "A")
				  			echo "|____A| ";
				  		elseif ($card[0] < 10)
				  			echo "|____{$card[0]}| ";
				  		elseif ($card[0] == 10)
				  			echo "|___{$card[0]}| ";
				  		
				  	}

			  		$hide = 1;
			  		break;
			}
	  	}	
	  	echo "\n";
	  	if ($line == 5){
	  		if (!$hidden)
	  			echo "Total: ".getHandTotal($hand)."\n";
	  	}
	  	else
		  	return echoHand($hand, $name, $hidden, ++$line);
	}

	function printTable($dealerHand, $playerHand, $dealerHide = true){
		// prints the current boardstate
		echo "Dealer :\n";
		echoHand($dealerHand, "Dealer", $dealerHide);

		echo "\n\n\n\n\n\n\n\n\n\n";
		echo "Player 1: \n";
		echoHand($playerHand, "Player");
	}

	function turns(&$turns, &$deck){
		// main game function. 
		// handles the turns until each player stays, or busts
		// it then hits the dealer until the dealer won, bust, or hit 17
		if (getHandTotal($turns["Dealer"]) == 21){
			printTable($turns["Dealer"], $turns["Player 1"]);
		}
		else{
			$numPlayers = count($turns)-1;
			for($i = 1; $i <= $numPlayers; $i++){
				do{
					$done = false;
					$resp;
					// If a player is dealt a blackjack, notify them.
					if (getHandTotal($turns["Player $i"]) == 21 && count($turns["Player $i"]) == 2){
							printTable($turns["Dealer"], $turns["Player 1"]);
							echo "Blackjack! Hit enter to continue. ";
							fgets(STDIN);
							$done = true;
						}
					else{
						do{
							printTable($turns["Dealer"], $turns["Player 1"]);
							echo "Player $i, would you like to hit, or stay? ";
							$resp = strtolower(trim(fgets(STDIN)));
						}
						while ($resp != 'h' && $resp != 's' && $resp != 'hit' && $resp != 'stay');
						if ($resp == 'stay' || $resp == 's'){
							$done = true;
						}
						else{
							drawCard($turns["Player $i"], $deck);
							printTable($turns["Dealer"], $turns["Player 1"]);
							if (getHandTotal($turns["Player $i"]) > 21){
								echo "You busted. Hit enter to continue. ";
								fgets(STDIN);
								$done = true;
							}
						}
					}
				}
				while(!$done);
			}

			do{
				$done = false;
				printTable($turns["Dealer"], $turns["Player 1"], false);
				if (getHandTotal($turns["Dealer"]) >= 17){
					$done = true;
					if (getHandTotal($turns["Dealer"]) > 21){
						echo "The Dealer busted!\n";
					}
				}
				else{
					echo "Dealer drawing...";
					drawCard($turns["Dealer"], $deck);
					sleep(1);
				}

			}
			while(!$done);
		}
	}

	function findWinner($players){
		// finds the result of each player's hand, in regards to the dealer
		$results = [];
		$dealer = getHandTotal($players["Dealer"]);
		for ($i = 1; $i <= count($players) -1; $i++){
			$playerTot = getHandTotal($players["Player $i"]);
			if (($playerTot > $dealer && $playerTot < 22) || ($playerTot < $dealer && $dealer > 21) || ($playerTot == 21 && count($player["Player $1"]) == 2)){
				$results ["Player $i"] = "won";
			}
			else if ($playerTot > 21 || $playerTot < $dealer){
				$results ["Player $i"] = "lost";
			}
			else
				$results["Player $i"] = "pushed";
		}
		return $results;
	}

	function checkBlackJack(){
		// checks if a player has blackjack
		$dealerBJ = false;
		foreach ($turn as $key => $val){
			if (getHandTotal($val) == 21){
				$printTable($turn["Dealer"], $turn["Player 1"]);
				echo "$key, you have a blackjack! Hit enter to continue. ";
				fgets(STDIN);
				if ($key == "Dealer"){
					$dealerBJ = true;
				}
			}
		}
		return $dealerBJ;
	}

	function printResults($results){
		// prints each player's results.
		echo "Player 1 {$results['Player 1']}";
		if (count($results) >= 3){
			for ($i = 2; $i <= count($results); $i++){
				echo ", Player $i {$results['Player $i']}";
			}
		}
		echo ". ";
	}
//                                                                              //
// MAIN //////////////////////////////////////////////////////////////////////////
	do{

		$dealer = [];
		$player = [];
		$deck = buildDeck($suits, $cards);

		

		drawCard($player, $deck);
		drawCard($dealer, $deck);

		drawCard($player, $deck);
		drawCard($dealer, $deck);	

		$turn = ["Player 1" => $player, "Dealer" => $dealer];
		$play = false;

		
		if (checkBlackJack()){
			$printTable($turn["Dealer"], $turn["Player 1"]);
			echo "Dealer had blackjack.";
		}
		else
			turns($turn, $deck);
		printResults(findWinner($turn));
		echo "Would you like to play again? ";
		$resp = strtoupper(trim(fgets(STDIN)));
		if ($resp == 'Y' || $resp == 'YES'){
			$play = true;
		}
		else{
			$play = false;
		}
	}
	while($play);
//////////////////////////////////////////////////////////////////////////////////