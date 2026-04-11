<?php

class Player
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO(
                'mysql:host=localhost;dbname=mvc_libre;charset=utf8mb4',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    /**
     * Get all players from the roster
     */
    public function getPlayer()
    {
        $stmt = $this->db->query("SELECT * FROM plantilla_lakers ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    /**
     * Insert a new player
     */
    public function setPlayer($name, $age, $nationality, $experience, $teams, $allstar, $mvp, $image)
    {
        $sql = "INSERT INTO plantilla_lakers 
            (player_name, player_age, player_nationality, player_experience, player_teams, player_allstar, player_mvp, player_image)
            VALUES 
            (:name, :age, :nation, :exp, :teams, :allstar, :mvp, :image)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name'    => $name,
            ':age'     => $age,
            ':nation'  => $nationality,
            ':exp'     => $experience,
            ':teams'   => $teams,
            ':allstar' => $allstar,
            ':mvp'     => $mvp,
            ':image'   => $image,
        ]);
    }

    /**
     * Get a single player by ID for editing
     */
    public function editPlayer($id)
    {
        $sql = "SELECT * FROM plantilla_lakers WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => intval($id)]);
        return $stmt->fetch();
    }

    /**
     * Update an existing player
     */
    public function updatePlayer($name, $age, $nation, $teams, $allstar, $mvp, $image, $id)
    {
        $sql = "UPDATE plantilla_lakers SET
            player_name = :name,
            player_age = :age,
            player_nationality = :nation,
            player_teams = :teams,
            player_allstar = :allstar,
            player_mvp = :mvp,
            player_image = :image
            WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name'    => $name,
            ':age'     => $age,
            ':nation'  => $nation,
            ':teams'   => $teams,
            ':allstar' => $allstar,
            ':mvp'     => $mvp,
            ':image'   => $image,
            ':id'      => intval($id),
        ]);
    }

    /**
     * Delete a player by ID
     */
    public function deletePlayer($id)
    {
        // Get player image before deleting to clean up the file
        $player = $this->editPlayer($id);

        $sql = "DELETE FROM plantilla_lakers WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([':id' => intval($id)]);

        // Remove image file if exists
        if ($result && $player && !empty($player['player_image'])) {
            $imagePath = __DIR__ . '/../' . $player['player_image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        return $result;
    }
}
