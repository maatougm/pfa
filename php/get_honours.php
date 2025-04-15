
<?php
header('Content-Type: application/json');
require_once('../assets/config.php');

try {
    $stmt = $pdo->query("SELECT category, years, image_url, sport FROM honours ORDER BY sport, category");
    $honours = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($honours);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de récupération des palmarès']);
}
?>
