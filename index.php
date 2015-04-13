#!/usr/bin/php
<?php
/**
 * Game main script
 */
require_once __DIR__ . '/vendor/autoload.php';


function run() {
	
    // game classes as a hash table
    $games = [
        't' => "Solitaire\Towers\Towers",
        'f' => "Solitaire\FortyThieves\FortyThieves",
        's' => "Solitaire\Sixteens\Sixteens"
    ];
	

 
	echo "########## SOLITAIRE ###########" . PHP_EOL;
	echo "_________________________________" . PHP_EOL;
    echo "The game choices are:" . PHP_EOL;
    echo "\t 1. The Towers (t)" . PHP_EOL;
    echo "\t 2. Forty Thieves (f)" . PHP_EOL;
    echo "\t 3. Sixteens (s)" . PHP_EOL;

    // main loop begins
    while (TRUE) {
        echo "Chose one solitaire game and enjoy? ";
        $choice = strtolower(trim(fgets(STDIN))); // getting string from standard input stream
        if (!array_key_exists($choice, $games)) {
            echo "Choose between: t(tower), f(forty thieves), or s(sixteens)." . PHP_EOL;
            continue;
        } else if (execute(new $games[$choice]())) {
            continue;
        } else {
            echo "Bye!". PHP_EOL;
            break;
        }
    }
}

// function to execute each game
function execute($game) {
    $game->run();
    echo "Another game (Y/N)? ";
    $option = strtolower(trim(fgets(STDIN)));
    switch ($option) {
        case 'yes':
        case 'y':
            return TRUE;
        default:
            return FALSE;
    }
}

// run the game
run();
