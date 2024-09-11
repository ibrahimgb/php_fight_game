<?php

require_once 'Game.php';

$data = "Bob 30 7 4\nAlice 20 9 2";
$game = new Game($data);
$game->start_game();

?>
