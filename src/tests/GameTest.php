<?php

require_once __DIR__ . '/../Game.php';
require_once __DIR__ . '/../Player.php'; // Ensure Player is included

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase {

    public function testPlayerInitialization() {
        $input = "Bob 30 7 4\nAlice 20 9 2";
        $game = new Game($input);

        $playerA = $game->getPlayerA();
        $playerB = $game->getPlayerB();

        $this->assertInstanceOf(Player::class, $playerA);
        $this->assertInstanceOf(Player::class, $playerB);

        $this->assertPlayer($playerA, 'Bob', 30, 7, 4);
        $this->assertPlayer($playerB, 'Alice', 20, 9, 2);
    }

    private function assertPlayer($player, $expectedName, $expectedHp, $expectedAttack, $expectedDefense) {
        $this->assertEquals($expectedName, $player->name);
        $this->assertEquals($expectedHp, $player->hp);
        $this->assertEquals($expectedAttack, $player->attack);
        $this->assertEquals($expectedDefense, $player->defense);
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
        $game->startGame(); // Ensure you are testing the correct method
        $output = ob_get_clean();

        $this->assertStringContainsString("Bob wins", $output);
    }

    public function testGameDisplay() {
        $data = "Bob 30 7 4\nAlice 20 9 2";
        $game = new Game($data);

        ob_start();
        $game->startGame();
        $output = ob_get_clean();

        // Adjust expected output based on actual formatting
        $this->assertStringContainsString("Bob - HP: 30, Attack: 7, Defense: 4", $output);
        $this->assertStringContainsString("Alice - HP: 20, Attack: 9, Defense: 2", $output);
        $this->assertStringContainsString("Bob wins with 15 HP left", $output);
    }
}

?>
