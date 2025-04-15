
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../html_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin | Espérance ST</title>
    <link rel="stylesheet" href="../css/hearderfooter.css">
    <link rel="stylesheet" href="../css/panel.css">
    <link rel="icon" href="../img/logo.png">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #fcdb03, #d90429);
            margin: 0;
            padding: 0;
        }
        .panel-container {
            max-width: 1100px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        .panel-title {
            text-align: center;
            color: #d90429;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .panel-subtitle {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .panel-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .panel-card {
            background-color: #fcdb03;
            border-left: 6px solid #d90429;
            border-radius: 10px;
            padding: 20px;
            width: 280px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .panel-card:hover {
            transform: scale(1.03);
        }
        .panel-card h2 {
            font-size: 1.6rem;
            color: #d90429;
            margin-bottom: 10px;
        }
        .panel-card p {
            font-size: 1rem;
            color: #333;
        }
        .panel-card a {
            display: inline-block;
            margin-top: 15px;
            background-color: #d90429;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }
        .panel-card a:hover {
            background-color: #fff;
            color: #d90429;
            border: 2px solid #d90429;
        }
    </style>
</head>
<body>
    <?php include '../assets/header.php'; ?>

    <div class="panel-container">
        <h1 class="panel-title">❤️ Panneau d'administration - EST</h1>
        <p class="panel-subtitle">Bienvenue, <?= ucfirst($_SESSION['admin']['username']) ?></p>

        <div class="panel-grid">
            <div class="panel-card">
                <h2>👥 Joueurs</h2>
                <p>Ajouter ou modifier les joueurs</p>
                <a href="players.php">Gérer</a>
            </div>
            <div class="panel-card">
                <h2>🏆 Palmarès</h2>
                <p>Modifier les titres remportés</p>
                <a href="honours.php">Gérer</a>
            </div>
            <div class="panel-card">
                <h2>📊 Scores</h2>
                <p>Enregistrer les résultats</p>
                <a href="scores.php">Gérer</a>
            </div>
            <?php if ($_SESSION['admin']['permission'] === 'god'): ?>
            <div class="panel-card">
                <h2>🛡️ Admins</h2>
                <p>Gérer les utilisateurs admin</p>
                <a href="admins.php">Gérer</a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include '../assets/footer.php'; ?>
</body>
</html>
