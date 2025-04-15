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
                <h2>🎓 Inscriptions</h2>
                <p>Gérer les inscriptions académie</p>
                <a href="academy.php">Gérer</a>
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