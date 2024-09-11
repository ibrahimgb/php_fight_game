<?php

require_once 'Player.php';
require_once 'Fight.php';

class Game {
    private $playerA;
    private $playerB;
    private $combat;

    public function __construct($input) {
        $lines = explode("\n", trim($input));

        $playerA_info = explode(" ", trim($lines[0]));
        $this->playerA = new Player($playerA_info[0], $playerA_info[1], $playerA_info[2], $playerA_info[3]);

        $playerB_info = explode(" ", trim($lines[1]));
        $this->playerB = new Player($playerB_info[0], $playerB_info[1], $playerB_info[2], $playerB_info[3]);

        $this->combat = new Fight($this->playerA, $this->playerB);
    }

    public function startGame() {
        echo "<br>" . $this->playerA->name . " - HP: " . $this->playerA->hp . ", Attack: " . $this->playerA->attack . ", Defense: " . $this->playerA->defense . "<br>";
        echo "<br>" . $this->playerB->name . " - HP: " . $this->playerB->hp . ", Attack: " . $this->playerB->attack . ", Defense: " . $this->playerB->defense . "<br>";
        $this->combat->run(1);
    }
}

?>
