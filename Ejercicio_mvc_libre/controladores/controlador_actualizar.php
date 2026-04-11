<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

require_once '../modelo_clase/modelo.php';

$id          = intval($_POST['id'] ?? 0);
$name        = trim($_POST['player_name'] ?? '');
$age         = intval($_POST['player_age'] ?? 0);
$nationality = trim($_POST['player_nationality'] ?? '');
$experience  = intval($_POST['player_experience'] ?? 0);
$teams       = intval($_POST['player_teams'] ?? 0);
$allstar     = intval($_POST['player_allstar'] ?? 0);
$mvp         = intval($_POST['player_mvp'] ?? 0);

// Validate required fields
if ($name === '' || $age <= 0 || $id <= 0) {
    header('Location: controlador_inicial.php');
    exit;
}

$player = new Player();

// Handle image: use new upload or keep existing
$imagePath = trim($_POST['current_image'] ?? '');

if (isset($_FILES['player_image']) && $_FILES['player_image']['error'] === UPLOAD_ERR_OK && $_FILES['player_image']['size'] > 0) {
    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $ext      = pathinfo($_FILES['player_image']['name'], PATHINFO_EXTENSION);
    $filename = uniqid('player_') . '.' . $ext;
    $dest     = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['player_image']['tmp_name'], $dest)) {
        // Remove old image if a new one was uploaded
        if ($imagePath !== '' && file_exists(__DIR__ . '/../' . $imagePath)) {
            unlink(__DIR__ . '/../' . $imagePath);
        }
        $imagePath = 'uploads/' . $filename;
    }
}

$result = $player->updatePlayer($name, $age, $nationality, $teams, $allstar, $mvp, $imagePath, $id);

// Redirect back to the roster list
header('Location: controlador_inicial.php');
exit;
