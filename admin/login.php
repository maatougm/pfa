<?php
session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once '../assets/config.php'; // Connexion DB via $pdo

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Rechercher l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification
    if ($admin && $admin['password'] === $password) {
        $_SESSION['admin'] = [
            'id' => $admin['id'],
            'username' => $admin['username'],
            'permission' => $admin['permission']
        ];
        header("Location: ../admin/panel.php");
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Connexion Admin | EST</title>
    <link rel="stylesheet" href="../css/hearderfooter.css" />
    <link rel="stylesheet" href="../css/login.css" />
    <link rel="icon" href="../img/logo.png" />
    
</head>
<body>
    <?php include '../assets/header.php'; ?>

    <div class="login-container">
        <h2>Connexion Administrateur</h2>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" required />

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required />

            <input type="submit" value="Se connecter" />
        </form>
    </div>

    <?php include '../assets/footer.php'; ?>
</body>
</html>
