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
        $damageTaken = $damage - $this->defense;
        if ($damageTaken < 0) $damageTaken = 0;
        $this->hp -= $damageTaken;
        if ($this->hp < 0) {
            $this->hp = 0; 
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
        $lines = explode("\n", trim($input));

        $playerA_info = explode(" ", trim($lines[0]));
        $this->playerA = new Player($playerA_info[0], $playerA_info[1], $playerA_info[2], $playerA_info[3]);

        $playerB_info = explode(" ", trim($lines[1]));
        $this->playerB = new Player($playerB_info[0], $playerB_info[1], $playerB_info[2], $playerB_info[3]);
    }

    public function run($turn = 1) {
        if ($this->playerA->isAlive() && $this->playerB->isAlive()) {
            if ($turn == 1) {
                $this->playerB->takeDamage($this->playerA->attack);
                $this->print_score();
                $this->run(0);
            } else {
                $this->playerA->takeDamage($this->playerB->attack);
                $this->print_score();
                $this->run(1);
            }
        } else {
            $this->print_final_result();
        }
    }

    private function print_final_result() {
        $playerA_alive = $this->playerA->isAlive();
        $playerB_alive = $this->playerB->isAlive();


        switch (true) {
            case $playerA_alive:

                echo "<br>" . $this->playerA->name . " wins with " . $this->playerA->hp . " HP left.\n" . "<br>" ;
                break;
            case $playerB_alive:
                echo "<br>" . $this->playerB->name . " wins with " . $this->playerB->hp . " HP left.\n". "<br>" ;
                break;
            default:
                echo "It's a draw! Neither player is alive.\n";
                break;
        }
    }

    private function print_score() {
        echo "<br>" . $this->playerA->hp . "        " . $this->playerB->hp . " HP\n" . "<br>" ;
    }

    public function start_game() {
        echo "<br>" . $this->playerA->name . " - HP: " . $this->playerA->hp . ", Attack: " . $this->playerA->attack . ", Defense: " . $this->playerA->defense . "\n" , "<br>";
        echo "<br>" . $this->playerB->name . " - HP: " . $this->playerB->hp . ", Attack: " . $this->playerB->attack . ", Defense: " . $this->playerB->defense . "\n" , "<br>";
        $this->run(1);
    }
}

$data = "Bob 30 7 4\nAlice 20 9 2";
$game = new Game($data);
$game->start_game();

?>
