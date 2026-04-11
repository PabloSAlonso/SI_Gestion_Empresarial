<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roster — Lakers Players</title>
    <meta name="description" content="View the full Lakers roster with player stats and management options.">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="page-wrapper">

        <header class="page-header">
            <h1><i class="fas fa-basketball-ball"></i> Lakers Roster</h1>
            <p class="subtitle">Current Player Lineup</p>
        </header>

        <?php if (isset($message)): ?>
            <div class="alert <?php echo isset($msgType) && $msgType === 'error' ? 'alert-error' : 'alert-success'; ?>">
                <i class="fas fa-<?php echo isset($msgType) && $msgType === 'error' ? 'exclamation-circle' : 'check-circle'; ?>"></i>
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($result)): ?>
            <div class="data-table-wrapper">
                <table class="data-table" id="rosterTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user"></i> Name</th>
                            <th><i class="fas fa-calendar-alt"></i> Age</th>
                            <th><i class="fas fa-globe-americas"></i> Nationality</th>
                            <th><i class="fas fa-clock"></i> Exp.</th>
                            <th><i class="fas fa-people-group"></i> Teams</th>
                            <th><i class="fas fa-star"></i> All-Star</th>
                            <th><i class="fas fa-trophy"></i> MVP</th>
                            <th><i class="fas fa-image"></i> Photo</th>
                            <th><i class="fas fa-cog"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $index => $player): ?>
                            <tr style="animation-delay: <?php echo $index * 0.05; ?>s;" class="fade-row">
                                <td><strong><?php echo htmlspecialchars($player['player_name']); ?></strong></td>
                                <td><span class="stat-badge"><?php echo htmlspecialchars($player['player_age']); ?></span></td>
                                <td><?php echo htmlspecialchars($player['player_nationality']); ?></td>
                                <td><span class="stat-badge"><?php echo htmlspecialchars($player['player_experience']); ?></span></td>
                                <td><span class="stat-badge"><?php echo htmlspecialchars($player['player_teams']); ?></span></td>
                                <td><span class="stat-badge"><?php echo htmlspecialchars($player['player_allstar']); ?></span></td>
                                <td><span class="stat-badge"><?php echo htmlspecialchars($player['player_mvp']); ?></span></td>
                                <td>
                                    <?php if (!empty($player['player_image'])): ?>
                                        <img src="../<?php echo htmlspecialchars($player['player_image']); ?>" alt="<?php echo htmlspecialchars($player['player_name']); ?>" class="player-img">
                                    <?php else: ?>
                                        <div class="player-img" style="display:flex;align-items:center;justify-content:center;background:var(--bg-input);font-size:1.2rem;color:var(--text-secondary);">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="../controladores/controlador_editar.php?id=<?php echo intval($player['id']); ?>" class="btn btn-secondary" title="Edit">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <a href="../controladores/controlador_borrar.php?id=<?php echo intval($player['id']); ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this player?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="glass-card empty-state">
                <i class="fas fa-users-slash"></i>
                <p>No players in the roster yet. Add your first player!</p>
            </div>
        <?php endif; ?>

        <div class="nav-actions">
            <a href="../index.php" class="btn btn-primary" id="addPlayerBtn">
                <i class="fas fa-plus-circle"></i> Add New Player
            </a>
        </div>

    </div>

    <style>
        .fade-row {
            animation: fadeSlideUp 0.4s ease-out both;
        }
    </style>

</body>

</html>