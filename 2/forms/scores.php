<?php include('../includes/header.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panneau d'admin | EST</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-yellow-300 via-red-500 to-red-600 min-h-screen p-6 text-gray-800 font-sans">
<div class="max-w-5xl mx-auto">
  <div class="text-center text-white mb-8">
    <h1 class="text-4xl font-extrabold drop-shadow-lg">🎯 Espérance ST - Interface Admin</h1>
  </div>

  <div class="bg-white rounded-xl shadow-lg p-6 mb-10">
    <h2 class="text-2xl font-bold mb-4">📊 Résultats des matchs</h2>
    <table class="w-full text-sm table-auto border-collapse mb-6">
      <thead class="bg-yellow-300">
        <tr>
          <th class="p-2 text-left">Date</th><th>Sport</th><th>Adversaire</th><th>Score</th><th>Logo</th><th></th>
        </tr>
      </thead>
      <tbody>
        <tr class="bg-gray-50">
          <td class="p-2">2024-01-12</td><td>Football</td><td>CA</td><td>2 - 1</td>
          <td><img src="https://via.placeholder.com/40" class="w-10"></td>
          <td><button class="text-red-500 hover:text-red-700">🗑️</button></td>
        </tr>
      </tbody>
    </table>
    <h3 class="text-xl font-semibold mb-2">➕ Ajouter un score</h3>
    <form class="grid grid-cols-2 gap-4">
      <input type="date" class="input">
      <select class="input"><option>Football</option><option>Handball</option><option>Volleyball</option></select>
      <select class="input"><option>Domicile</option><option>Extérieur</option></select>
      <input type="text" placeholder="Adversaire" class="input">
      <input type="number" placeholder="Score EST" class="input">
      <input type="number" placeholder="Score Adversaire" class="input">
      <input type="url" placeholder="Logo adversaire" class="input col-span-2">
      <button class="bg-red-600 hover:bg-red-700 text-white py-2 rounded col-span-2">Ajouter</button>
    </form>
  </div>

</div>
</body>
</html>


<?php include('../includes/footer.php'); ?>