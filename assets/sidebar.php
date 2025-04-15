<link rel="stylesheet" href="../css/sidebar.css" />
<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<div class="admin-nav">
    <h2>EST Admin</h2>
    <ul>
        <li><a href="panel.php">🏠 Tableau de bord</a></li>
        <li><a href="players.php">👥 Joueurs</a></li>
        <li><a href="honours.php">🏆 Palmarès</a></li>
        <li><a href="scores.php">📊 Scores</a></li>
        <?php if (isset($_SESSION['admin']['permission']) && $_SESSION['admin']['permission'] === 'god'): ?>
            <li><a href="admins.php">🛡️ Admins</a></li>
        <?php endif; ?>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>
</div>
