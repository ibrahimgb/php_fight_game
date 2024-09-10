<?php

class Player {
    public $name;
    public $hp;
    public $attack;
    public $defense;

    public function __construct($name, $hp, $attack, $defense) {
        $this->name = $name;
        $this->hp = (int) $hp;
        $this->attack = (int) $attack;
        $this->defense = (int) $defense;
    }

    public function takeDamage($damage) {
        $this->hp -= $damage;
        if ($this->hp < 0) {
            $this->hp = 0; // Ensure HP doesn't drop below zero
        }
    }

    public function isAlive() {
        return $this->hp > 0;
    }
}

class Game {
    private $playerA;
    private $playerB;

    public function __construct($input) {
        // Parse the input to create two Player objects
        $lines = explode("\n", trim($input));

        // Create playerA
        $playerA_info = explode(" ", trim($lines[0]));
        $this->playerA = new Player($playerA_info[0], $playerA_info[1], $playerA_info[2], $playerA_info[3]);

        // Create playerB
        $playerB_info = explode(" ", trim($lines[1]));
        $this->playerB = new Player($playerB_info[0], $playerB_info[1], $playerB_info[2], $playerB_info[3]);
    }

    public function run() {
        // Continue the battle until one player's HP reaches 0
        while ($this->playerA->isAlive() && $this->playerB->isAlive()) {
            // Player A attacks Player B
            $damageToB = max(0, $this->playerA->attack - $this->playerB->defense);
            $this->playerB->takeDamage($damageToB);

            // Check if Player B is still alive after the attack
            if (!$this->playerB->isAlive()) {
                break;  // End the game if Player B is defeated
            }

            // Player B attacks Player A
            $damageToA = max(0, $this->playerB->attack - $this->playerA->defense);
            $this->playerA->takeDamage($damageToA);

            // Display the current health of both players after the round
            print $this->playerA->hp . " " . $this->playerB->hp . "\n";
        }

        // Declare the winner
        if ($this->playerA->isAlive()) {
            // Player A wins
            print $this->playerA->name . " " . $this->playerA->hp . "\n";
        } else {
            // Player B wins
            print $this->playerB->name . " " . $this->playerB->hp . "\n";
        }
    }
}

// Example usage
$data = "Bob 30 7 4\nAlice 20 9 2";
$game = new Game($data);
$game->run();

?>
