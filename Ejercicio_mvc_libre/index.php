<?php
// Process the form submission before any HTML output
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'modelo_clase/modelo.php';
    $player = new Player();

    $name        = trim($_POST['player_name'] ?? '');
    $age         = intval($_POST['player_age'] ?? 0);
    $nationality = trim($_POST['player_nationality'] ?? '');
    $experience  = intval($_POST['player_experience'] ?? 0);
    $teams       = intval($_POST['player_teams'] ?? 0);
    $allstar     = intval($_POST['player_allstar'] ?? 0);
    $mvp         = intval($_POST['player_mvp'] ?? 0);

    // Handle image upload
    $imagePath = '';
    if (isset($_FILES['player_image']) && $_FILES['player_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $ext      = pathinfo($_FILES['player_image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('player_') . '.' . $ext;
        $dest     = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['player_image']['tmp_name'], $dest)) {
            $imagePath = 'uploads/' . $filename;
        }
    }

    if ($name !== '' && $age > 0) {
        $player->setPlayer($name, $age, $nationality, $experience, $teams, $allstar, $mvp, $imagePath);
        $success = true;
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player — Lakers Roster</title>
    <meta name="description" content="Add a new player to the Lakers roster management system.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="page-wrapper">

        <header class="page-header">
            <h1><i class="fas fa-basketball-ball"></i> Lakers Roster</h1>
            <p class="subtitle">Player Management System</p>
        </header>

        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> Player added successfully!
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> Please fill in at least the player name and age.
            </div>
        <?php endif; ?>

        <div class="glass-card form-container">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" id="addPlayerForm">

                <div class="form-group">
                    <label for="player_name"><i class="fas fa-user"></i> Name</label>
                    <input type="text" name="player_name" id="player_name" placeholder="e.g. LeBron James" required>
                </div>

                <div class="form-group">
                    <label for="player_age"><i class="fas fa-calendar-alt"></i> Age</label>
                    <input type="number" name="player_age" id="player_age" placeholder="e.g. 39" min="16" max="50" required>
                </div>

                <div class="form-group">
                    <label for="player_nationality"><i class="fas fa-globe-americas"></i> Nationality</label>
                    <input type="text" name="player_nationality" id="player_nationality" placeholder="e.g. USA">
                </div>

                <div class="form-group">
                    <label for="player_experience"><i class="fas fa-clock"></i> Experience (Years)</label>
                    <input type="number" name="player_experience" id="player_experience" placeholder="e.g. 21" min="0">
                </div>

                <div class="form-group">
                    <label for="player_teams"><i class="fas fa-people-group"></i> Teams Played For</label>
                    <input type="number" name="player_teams" id="player_teams" placeholder="e.g. 3" min="0">
                </div>

                <div class="form-group">
                    <label for="player_allstar"><i class="fas fa-star"></i> All-Star Appearances</label>
                    <input type="number" name="player_allstar" id="player_allstar" placeholder="e.g. 20" min="0">
                </div>

                <div class="form-group">
                    <label for="player_mvp"><i class="fas fa-trophy"></i> MVP Awards</label>
                    <input type="number" name="player_mvp" id="player_mvp" placeholder="e.g. 4" min="0">
                </div>

                <div class="form-group">
                    <label for="player_image"><i class="fas fa-camera"></i> Player Image</label>
                    <input type="file" name="player_image" id="player_image" accept="image/*">
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
                        <i class="fas fa-plus-circle"></i> Add Player
                    </button>
                </div>

                <div class="nav-actions">
                    <a href="controladores/controlador_inicial.php" class="btn btn-secondary" id="viewRosterBtn">
                        <i class="fas fa-list"></i> View Roster
                    </a>
                </div>

            </form>
        </div>

    </div>

</body>

</html>