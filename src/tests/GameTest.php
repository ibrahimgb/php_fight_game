<?php
require_once __DIR__ . '/../Game.php';

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase {
    
    public function testPlayerInitialization() {
    $input = "Bob 30 7 4\nAlice 20 9 2";
    $game = new Game($input);

    $playerA = $game->getPlayerA();
    $playerB = $game->getPlayerB();

    $this->assertInstanceOf(Player::class, $playerA);
    $this->assertInstanceOf(Player::class, $playerB);

    $this->assertEquals('Bob', $playerA->name);
    $this->assertEquals(30, $playerA->hp);
    $this->assertEquals(7, $playerA->attack);
    $this->assertEquals(4, $playerA->defense);

    $this->assertEquals('Alice', $playerB->name);
    $this->assertEquals(20, $playerB->hp);
    $this->assertEquals(9, $playerB->attack);
    $this->assertEquals(2, $playerB->defense);
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