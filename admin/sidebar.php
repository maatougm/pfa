
<style>
    .admin-wrapper {
        display: flex;
        min-height: 100vh;
    }
    .admin-nav {
        width: 220px;
        background-color: #1c1c1c;
        padding: 30px 15px;
        color: white;
        flex-shrink: 0;
    }
    .admin-nav h2 {
        color: #fcdb03;
        font-size: 24px;
        margin-bottom: 30px;
    }
    .admin-nav a {
        display: block;
        color: white;
        text-decoration: none;
        margin-bottom: 15px;
        font-size: 18px;
    }
    .admin-nav a:hover {
        color: #fcdb03;
    }
</style>
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
