<?php

class FightDisplay {
    private $playerA;
    private $playerB;

    public function __construct($playerA, $playerB) {
        $this->playerA = $playerA;
        $this->playerB = $playerB;
    }

    public function printFinalResult() {
        $playerA_alive = $this->playerA->isAlive();
        $playerB_alive = $this->playerB->isAlive();

        switch (true) {
            case $playerA_alive:
                echo "<br>" . $this->playerA->name . " wins with " . $this->playerA->hp . " HP left.<br>";
                break;
            case $playerB_alive:
                echo "<br>" . $this->playerB->name . " wins with " . $this->playerB->hp . " HP left.<br>";
                break;
            default:
                echo "It's a draw! Neither player is alive.<br>";
                break;
        }
    }

    public function printScore() {
        echo "<br>" . $this->playerA->hp . "        " . $this->playerB->hp . " HP<br>";
    }
}

?>
