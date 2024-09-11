<?php

require_once 'Player.php';

class Fight {
    private $playerA;
    private $playerB;

    public function __construct(Player $playerA, Player $playerB) {
        $this->playerA = $playerA;
        $this->playerB = $playerB;
    }

    public function run($turn = 1) {
        if ($this->playerA->isAlive() && $this->playerB->isAlive()) {
            if ($turn == 1) {
                $this->playerB->takeDamage($this->playerA->attack);
                $this->printScore();
                $this->run(0);
            } else {
                $this->playerA->takeDamage($this->playerB->attack);
                $this->printScore();
                $this->run(1);
            }
        } else {
            $this->printFinalResult();
        }
    }

    private function printFinalResult() {
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

    private function printScore() {
        echo "<br>" . $this->playerA->hp . "        " . $this->playerB->hp . " HP<br>";
    }
}

?>
