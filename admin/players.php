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

// Add player
if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO players (name, position, sport, number, nationality, image_url)
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['position'],
        $_POST['sport'],
        $_POST['number'],
        $_POST['nationality'],
        $_POST['image_url']
    ]);
    $_SESSION['success'] = "Joueur ajouté avec succès.";
    header("Location: players.php");
    exit;
}

// Delete player
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM players WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    $_SESSION['success'] = "Joueur supprimé.";
    header("Location: players.php");
    exit;
}

$players = $pdo->query("SELECT * FROM players ORDER BY sport, number")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion</title>
    <link rel="stylesheet" href="../css/hearderfooter.css" />
    <link rel="icon" href="../img/logo.png" />
    <link rel="stylesheet" href="../css/playerspanel.css" />
</head>
<body>
<?php include '../assets/header.php'; ?>

<div class="admin-wrapper">
    <?php include '../assets/sidebar.php'; ?>

    <div class="admin-main">
        <h1>Gestion des Joueurs</h1>

        <?php if ($success): ?>
            <p class="message"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST">
                <input type="text" name="name" placeholder="Nom du joueur" required>
                <input type="text" name="position" placeholder="Poste" required>
                <select name="sport" required>
                    <option value="football">Football</option>
                    <option value="handball">Handball</option>
                    <option value="volleyball">Volleyball</option>
                </select>
                <input type="number" name="number" placeholder="Numéro" required>
                <input type="text" name="nationality" placeholder="Nationalité" required>
                <input type="text" name="image_url" placeholder="URL de la photo" required>
                <input type="submit" name="add" value="Ajouter le joueur">
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Poste</th>
                        <th>Sport</th>
                        <th>Numéro</th>
                        <th>Nationalité</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($players as $player): ?>
                    <tr>
                        <td><?= htmlspecialchars($player['name']) ?></td>
                        <td><?= htmlspecialchars($player['position']) ?></td>
                        <td><?= htmlspecialchars($player['sport']) ?></td>
                        <td><?= htmlspecialchars($player['number']) ?></td>
                        <td><?= htmlspecialchars($player['nationality']) ?></td>
                        <td><img src="<?= htmlspecialchars($player['image_url']) ?>" style="max-height: 50px;"></td>
                        <td><a href="?delete=<?= $player['id'] ?>" class="delete" onclick="return confirm('Supprimer ce joueur ?')">Supprimer</a></td>
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
