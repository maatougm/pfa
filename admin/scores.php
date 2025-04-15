
<?php
require_once '../assets/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$success = '';
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

// Add score
if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO scores (sport, date, home_team, away_team, home_score, away_score, home_logo, away_logo)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['sport'],
        $_POST['date'],
        $_POST['home_team'],
        $_POST['away_team'],
        $_POST['home_score'],
        $_POST['away_score'],
        $_POST['home_logo'],
        $_POST['away_logo']
    ]);
    $_SESSION['success'] = "Score ajouté avec succès.";
    header("Location: scores.php");
    exit;
}

// Delete score
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM scores WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    $_SESSION['success'] = "Score supprimé.";
    header("Location: scores.php");
    exit;
}

$scores = $pdo->query("SELECT * FROM scores ORDER BY date DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Scores</title>
    <link rel="stylesheet" href="../css/hearderfooter.css" />
    <link rel="icon" href="../img/logo.png" />
    <link rel="stylesheet" href="../css/scoreadmin.css" />
</head>
<body>
<?php include '../assets/header.php'; ?>

<div class="admin-wrapper">
    <?php include '../assets/sidebar.php'; ?>

    <div class="admin-main">
        <h1>Gestion des Scores</h1>

        <?php if ($success): ?>
            <p class="message"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST">
                <select name="sport" required>
                    <option value="">-- Sport --</option>
                    <option value="football">Football</option>
                    <option value="handball">Handball</option>
                    <option value="volleyball">Volleyball</option>
                </select>
                <input type="date" name="date" required>
                <input type="text" name="home_team" placeholder="Équipe Domicile" required>
                <input type="text" name="home_logo" placeholder="Logo Domicile (URL)" required>
                <input type="text" name="away_team" placeholder="Équipe Extérieure" required>
                <input type="text" name="away_logo" placeholder="Logo Extérieure (URL)" required>
                <input type="number" name="home_score" placeholder="Score Domicile" required>
                <input type="number" name="away_score" placeholder="Score Extérieure" required>
                <input type="submit" name="add" value="Ajouter le score">
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Sport</th>
                        <th>Équipe Domicile</th>
                        <th>Logo</th>
                        <th>Score</th>
                        <th>Équipe Extérieure</th>
                        <th>Logo</th>
                        <th>Score</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($scores as $score): ?>
                    <tr>
                        <td><?= htmlspecialchars($score['date']) ?></td>
                        <td><?= htmlspecialchars($score['sport']) ?></td>
                        <td><?= htmlspecialchars($score['home_team']) ?></td>
                        <td><img src="<?= htmlspecialchars($score['home_logo']) ?>" class="logo"></td>
                        <td><?= htmlspecialchars($score['home_score']) ?></td>
                        <td><?= htmlspecialchars($score['away_team']) ?></td>
                        <td><img src="<?= htmlspecialchars($score['away_logo']) ?>" class="logo"></td>
                        <td><?= htmlspecialchars($score['away_score']) ?></td>
                        <td><a href="?delete=<?= $score['id'] ?>" class="delete" onclick="return confirm('Supprimer ce score ?')">Supprimer</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../assets/footer.php'; ?>
</body>
</html>
