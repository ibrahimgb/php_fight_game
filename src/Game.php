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

    private $players =  [$this->playerA, $this->playerB ];

    public function __construct($input) {
        $lines = explode("\n", trim($input));

        $playerA_info = explode(" ", trim($lines[0]));
        $this->playerA = new Player($playerA_info[0], $playerA_info[1], $playerA_info[2], $playerA_info[3]);

        $playerB_info = explode(" ", trim($lines[1]));
        $this->playerB = new Player($playerB_info[0], $playerB_info[1], $playerB_info[2], $playerB_info[3]);
    }


    private function run( $x = 1) {

        if($x==1){
            $this->players[0]->takeDamage($this->players[1]->attack);
            $this->print_score();
            $this->run(0);
        }
        if($x==1){
            $this->players[1]->takeDamage($this->players[0]->attack);
            $this->print_score();
            $this->run(1);
        }

        if($this->playerA->isAlive() ||  $this->playerB->isAlive()){
            
            return;
        } 
    }


    private function print_score(){
        echo($this->playerA->hp + " " * $this->playerB->hp );
        echo($this->playerA->hp + " " * $this->playerB->hp );
    }

    public function start_game(){
        echo($this->playerA->name + " " * $this->playerA->hp + " " + $this->playerA->attack + " " + $this->playerA->defense );
        echo($this->playerB->name + " " * $this->playerB->hp + " " + $this->playerB->attack + " " + $this->playerB->defense );
        $this->run(0);
    }
}

// Example usage
$data = "Bob 30 7 4\nAlice 20 9 2";
$game = new Game($data);
$game->start_game();

?>
