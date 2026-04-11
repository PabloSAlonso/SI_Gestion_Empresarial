<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Player — Lakers Roster</title>
    <meta name="description" content="Edit player stats and information in the Lakers roster.">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="page-wrapper">

        <header class="page-header">
            <h1><i class="fas fa-pen-to-square"></i> Edit Player</h1>
            <p class="subtitle">Update player information</p>
        </header>

        <div class="glass-card form-container">

            <form action="../controladores/controlador_actualizar.php" method="post" enctype="multipart/form-data" id="editPlayerForm">

                <input type="hidden" name="id" value="<?php echo intval($_GET['id']); ?>">

                <div class="form-group">
                    <label for="player_name"><i class="fas fa-user"></i> Name</label>
                    <input type="text" name="player_name" id="player_name"
                        value="<?php echo htmlspecialchars($dato['player_name'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="player_age"><i class="fas fa-calendar-alt"></i> Age</label>
                    <input type="number" name="player_age" id="player_age"
                        value="<?php echo intval($dato['player_age'] ?? 0); ?>" min="16" max="50" required>
                </div>

                <div class="form-group">
                    <label for="player_nationality"><i class="fas fa-globe-americas"></i> Nationality</label>
                    <input type="text" name="player_nationality" id="player_nationality"
                        value="<?php echo htmlspecialchars($dato['player_nationality'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="player_experience"><i class="fas fa-clock"></i> Experience (Years)</label>
                    <input type="number" name="player_experience" id="player_experience"
                        value="<?php echo intval($dato['player_experience'] ?? 0); ?>" min="0">
                </div>

                <div class="form-group">
                    <label for="player_teams"><i class="fas fa-people-group"></i> Teams Played For</label>
                    <input type="number" name="player_teams" id="player_teams"
                        value="<?php echo intval($dato['player_teams'] ?? 0); ?>" min="0">
                </div>

                <div class="form-group">
                    <label for="player_allstar"><i class="fas fa-star"></i> All-Star Appearances</label>
                    <input type="number" name="player_allstar" id="player_allstar"
                        value="<?php echo intval($dato['player_allstar'] ?? 0); ?>" min="0">
                </div>

                <div class="form-group">
                    <label for="player_mvp"><i class="fas fa-trophy"></i> MVP Awards</label>
                    <input type="number" name="player_mvp" id="player_mvp"
                        value="<?php echo intval($dato['player_mvp'] ?? 0); ?>" min="0">
                </div>

                <?php if (!empty($dato['player_image'])): ?>
                    <div style="text-align:center; margin: 16px 0;">
                        <p style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 8px;">Current Photo</p>
                        <img src="../<?php echo htmlspecialchars($dato['player_image']); ?>"
                            alt="<?php echo htmlspecialchars($dato['player_name'] ?? 'Player'); ?>"
                            class="img-preview">
                        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($dato['player_image']); ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="player_image"><i class="fas fa-camera"></i> New Image (optional)</label>
                    <input type="file" name="player_image" id="player_image" accept="image/*">
                </div>

                <div class="btn-group">
                    <button type="submit" name="actualizar" class="btn btn-primary" id="updateBtn">
                        <i class="fas fa-save"></i> Update Player
                    </button>
                    <a href="controlador_inicial.php" class="btn btn-secondary" id="cancelBtn">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>

            </form>
        </div>

    </div>

</body>

</html>