<?php

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../modelo_clase/modelo.php';

$player = new Player();
$player->deletePlayer(intval($_GET['id']));

// Redirect back to the player list
header('Location: controlador_inicial.php');
exit;
