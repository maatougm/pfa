<?php
session_start();
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
?>
<?php include('includes/header.php'); ?>

<header class="text-center text-white mb-12">
  <h1 class="text-4xl font-extrabold drop-shadow-lg">❤️ Tableau de bord - Espérance ST</h1>
  <p class="text-lg text-gray-100 mt-2">Bienvenue, <?php echo ucfirst($_SESSION['user']); ?></p>
</header>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
  <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition">
    <h2 class="text-2xl font-bold text-red-600 mb-2">👥 Joueurs</h2>
    <p class="text-gray-600 mb-4">Ajouter ou modifier les joueurs</p>
    <a href="forms/players.php" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">Gérer</a>
  </div>

  <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition">
    <h2 class="text-2xl font-bold text-red-600 mb-2">🏆 Palmarès</h2>
    <p class="text-gray-600 mb-4">Modifier les titres remportés</p>
    <a href="forms/honours.php" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">Gérer</a>
  </div>

  <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition">
    <h2 class="text-2xl font-bold text-red-600 mb-2">📊 Scores</h2>
    <p class="text-gray-600 mb-4">Enregistrer les derniers résultats</p>
    <a href="forms/scores.php" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">Gérer</a>
  </div>

  <?php if ($_SESSION['user'] === 'god'): ?>
  <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition col-span-full">
    <h2 class="text-2xl font-bold text-red-600 mb-2">🛡️ Admins</h2>
    <p class="text-gray-600 mb-4">Gérer les utilisateurs administrateurs</p>
    <a href="admins.php" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">Gérer les admins</a>
  </div>
  <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
