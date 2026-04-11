<?php

require_once '../modelo_clase/modelo.php';

$player = new Player();
$result = $player->getPlayer();

require_once '../vistas/vista.php';
