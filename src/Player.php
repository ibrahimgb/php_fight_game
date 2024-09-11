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