<?php

require_once 'Player.php';
require_once 'FightDisplay.php';

class Fight {
    private $playerA;
    private $playerB;
    private $display;

    public function __construct(Player $playerA, Player $playerB) {
        $this->playerA = $playerA;
        $this->playerB = $playerB;
        $this->display = new FightDisplay($this->playerA, $this->playerB);
    }

    public function run($turn = 1) {
        if ($this->playerA->isAlive() && $this->playerB->isAlive()) {
            if ($turn == 1) {
                $this->playerB->takeDamage($this->playerA->attack);
                $this->display->printScore();
                $this->run(0);
            } else {
                $this->playerA->takeDamage($this->playerB->attack);
                $this->display->printScore();
                $this->run(1);
            }
        } else {
            $this->display->printFinalResult();
        }
    }
}

?>
