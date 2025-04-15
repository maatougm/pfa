<?php
header('Content-Type: application/json');
require_once('../assets/config.php');

try {
    $stmt = $pdo->query("
        SELECT 
            sport,
            date,
            home_team,
            away_team,
            home_score,
            away_score,
            home_logo,
            away_logo
        FROM scores
        ORDER BY date DESC
    ");

    $scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($scores);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
