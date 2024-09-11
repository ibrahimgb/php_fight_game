<?php
require_once __DIR__ . '/../Game.php';

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase {
    
    public function testPlayerInitialization() {
        $player = new Player('Bob', 30, 7, 4);

        $this->assertEquals('Bob', $player->name);
        $this->assertEquals(30, $player->hp);
        $this->assertEquals(7, $player->attack);
        $this->assertEquals(4, $player->defense);
    }

    public function testPlayerTakesDamage() {
        $player = new Player('Alice', 20, 9, 2);

        $player->takeDamage(10);

        $this->assertEquals(12, $player->hp);  // 20 - (10 - 2)
    }

    public function testPlayerDiesWhenHpReachesZero() {
        $player = new Player('Alice', 5, 9, 2);

        $player->takeDamage(10);

        $this->assertEquals(0, $player->hp);
        $this->assertFalse($player->isAlive());
    }

    public function testGameInitialization() {
        $data = "Bob 30 7 4\nAlice 20 9 2";
        $game = new Game($data);

        $this->assertEquals('Bob', $game->playerA->name);
        $this->assertEquals(30, $game->playerA->hp);
        $this->assertEquals('Alice', $game->playerB->name);
        $this->assertEquals(20, $game->playerB->hp);
    }

    public function testGameRun() {
        $data = "Bob 30 7 4\nAlice 20 9 2";
        $game = new Game($data);

        ob_start();
        $game->run();
        $output = ob_get_clean();

        $this->assertStringContainsString("Bob wins", $output);
    }
}

?>