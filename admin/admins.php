
<?php 
session_start();
require_once '../assets/config.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin']['permission'] !== 'god') {
    header("Location: login.php");
    exit;
}

$message = '';

// ADD admin
if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO admins (username, password, permission) VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST['username'],
        $_POST['password'],
        $_POST['permission']
    ]);
    $message = "Nouvel admin ajouté.";
}

// DELETE admin
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM admins WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: admins.php");
    exit;
}

$admins = $pdo->query("SELECT * FROM admins")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Admins</title>
    <link rel="stylesheet" href="../css/hearderfooter.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="icon" href="../img/logo.png" />
    
</head>
<body>
<?php include '../assets/header.php'; ?>

<div class="admin-wrapper">
    <?php include '../assets/sidebar.php'; ?>

    <div class="admin-main">
        <h1>Gestion des Admins</h1>

        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="text" name="password" placeholder="Mot de passe" required>
            <select name="permission" required>
                <option value="">-- Permission --</option>
                <option value="editor">Éditeur</option>
                <option value="god">God</option>
            </select>
            <input type="submit" name="add" value="Ajouter Admin">
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Permission</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td><?= $admin['id'] ?></td>
                        <td><?= htmlspecialchars($admin['username']) ?></td>
                        <td><?= htmlspecialchars($admin['permission']) ?></td>
                        <td>
                            <?php if ($_SESSION['admin']['id'] != $admin['id']): ?>
                                <a class="delete-btn" href="?delete=<?= $admin['id'] ?>" onclick="return confirm('Supprimer cet admin ?')">Supprimer</a>
                            <?php else: ?>
                                <em>Connecté</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../assets/footer.php'; ?>
</body>
</html>
