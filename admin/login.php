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
    <link rel="icon" href="../img/logo.png" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #fcdb03, #d90429);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        .login-container h2 {
            text-align: center;
            color: #d90429;
            margin-bottom: 20px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .login-container input[type="submit"] {
            background-color: #d90429;
            color: #fff;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #fcdb03;
            color: #000;
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
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
