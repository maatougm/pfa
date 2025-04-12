<?php session_start(); if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; } ?>
<?php include('includes/header.php'); ?>

<header class="text-center text-white mb-12">
  <h1 class="text-4xl font-extrabold drop-shadow-lg">❤️ Panneau Admin Espérance ST</h1>
  <p class="text-lg text-gray-100">Gérez vos joueurs, trophées et résultats facilement</p>
</header>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
    <h2 class="text-xl font-bold mb-2">👥 Joueurs</h2>
    <p class="text-sm text-gray-600 mb-4">Ajouter, modifier ou supprimer les joueurs</p>
    <a href="forms/players.php" class="inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">Gérer</a>
  </div>

  <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
    <h2 class="text-xl font-bold mb-2">🏆 Palmarès</h2>
    <p class="text-sm text-gray-600 mb-4">Consultez et mettez à jour les trophées</p>
    <a href="forms/honours.php" class="inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">Gérer</a>
  </div>

  <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
    <h2 class="text-xl font-bold mb-2">📊 Scores</h2>
    <p class="text-sm text-gray-600 mb-4">Ajoutez les derniers résultats de match</p>
    <a href="forms/scores.php" class="inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">Gérer</a>
  </div>
</div>

<?php include('includes/footer.php'); ?>
