<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['user'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $error = "Identifiants invalides.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion | EST</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-yellow-300 via-red-500 to-red-600 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md text-center">
    <h1 class="text-3xl font-bold mb-6 text-red-600">🔐 Connexion Admin</h1>
    <?php if (!empty($error)) echo "<p class='text-red-600 mb-4'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-input w-full mb-4 border px-4 py-2 rounded">
      <input type="password" name="password" placeholder="Mot de passe" class="form-input w-full mb-4 border px-4 py-2 rounded">
      <button class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded w-full">Se connecter</button>
    </form>
  </div>
</body>
</html>
