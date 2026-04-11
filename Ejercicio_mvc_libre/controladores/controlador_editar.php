<?php

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../modelo_clase/modelo.php';

$player = new Player();
$dato = $player->editPlayer(intval($_GET['id']));

if (!$dato) {
    header('Location: controlador_inicial.php');
    exit;
}

require_once '../vistas/vista_editar.php';