<?php
header('Content-Type: application/json');

// ✅ Corrected path to your config file
require_once('../assets/config.php');

try {
    $stmt = $pdo->query("SELECT name, position, number, nationality, sport, image_url FROM players ORDER BY sport, number");
    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($players);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de récupération des joueurs']);
}
?>
