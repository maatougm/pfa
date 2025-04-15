<?php
require_once '../assets/config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$scores = $pdo->query("SELECT * FROM scores ORDER BY date DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Espérance Sportive de Tunis</title>
  <link rel="icon" href="../img/logo.png" />
  <link rel="stylesheet" href="../css/hearderfooter.css" />
  <link rel="stylesheet" href="../css/score.css" />
  <style>
    .score-card {
      border: 1px solid #ddd;
      margin: 15px 0;
      padding: 15px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .score-card.win {
      background-color: #d4edda;
      border-left: 5px solid #28a745;
    }
    .score-card.draw {
      background-color: #fff3cd;
      border-left: 5px solid #ffc107;
    }
    .score-card.lose {
      background-color: #f8d7da;
      border-left: 5px solid #dc3545;
    }
    .score-match {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
      margin-bottom: 10px;
    }
    .score-match-score {
      font-size: 24px;
      font-weight: bold;
    }
    .score-team-logo {
      width: 50px;
      height: 50px;
      object-fit: contain;
    }
    .score-match-info {
      text-align: center;
      font-style: italic;
      color: #555;
    }
  </style>
</head>
<body>
  <?php include '../assets/header.php'; ?>
  <main>
    <div class="score-container">
      <h1 class="score-page-title">Espérance Sportive de Tunis - Scores</h1>
      <p class="score-subtitle">Latest Match Results</p>

      <div class="score-results">
        <?php foreach ($scores as $score):
          $estHome = strtolower($score['home_team']) === 'espérance sportive de tunis';
          $estAway = strtolower($score['away_team']) === 'espérance sportive de tunis';
          $resultClass = '';
          if ($estHome || $estAway) {
              $estScore = $estHome ? $score['home_score'] : $score['away_score'];
              $opponentScore = $estHome ? $score['away_score'] : $score['home_score'];
              $resultClass = $estScore > $opponentScore ? 'win' : ($estScore === $opponentScore ? 'draw' : 'lose');
          }
        ?>
        <div class="score-card <?= $resultClass ?>">
          <div class="score-match">
            <img src="<?= htmlspecialchars($score['home_logo']) ?>" alt="Home Logo" class="score-team-logo">
            <div class="score-match-score"><?= $score['home_score'] ?> - <?= $score['away_score'] ?></div>
            <img src="<?= htmlspecialchars($score['away_logo']) ?>" alt="Away Logo" class="score-team-logo">
          </div>
          <div class="score-match-info"><?= htmlspecialchars($score['date']) ?> | <?= htmlspecialchars($score['sport']) ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </main>
  <?php include '../assets/footer.php'; ?>
</body>
</html>
