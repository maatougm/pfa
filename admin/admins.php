
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
    <link rel="icon" href="../img/logo.png" />
    <style>
        body {
            font-size: 17px;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #fcdb03, #d90429);
        }
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        .admin-main {
            flex-grow: 1;
            padding: 40px 30px;
            background-color: #f2f2f2;
        }
        .admin-main form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        input, select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"] {
            grid-column: span 2;
            background-color: #d90429;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #fcdb03;
            color: black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background-color: #d90429;
            color: white;
        }
        .delete-btn {
            background: #c0392b;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
        }
        .delete-btn:hover {
            background-color: #e74c3c;
        }
        .message {
            text-align: center;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php include '../assets/header.php'; ?>

<div class="admin-wrapper">
    <?php include 'sidebar.php'; ?>

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
