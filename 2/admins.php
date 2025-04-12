<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'god') {
    header('Location: index.php');
    exit;
}
?>
<?php include('includes/header.php'); ?>

<div class="bg-white rounded-xl shadow-lg p-6 mb-10">
  <h2 class="text-2xl font-bold mb-4">🛡️ Gestion des Admins</h2>

  <table class="w-full text-sm table-auto border-collapse mb-6">
    <thead class="bg-yellow-300">
      <tr>
        <th class="p-2 text-left">Nom</th><th>Rôle</th><th>Email</th><th></th>
      </tr>
    </thead>
    <tbody>
      <tr class="bg-gray-50">
        <td class="p-2">Ayoub</td><td>god</td><td>ayoub@example.com</td>
        <td><button class="text-red-500 hover:text-red-700">🗑️</button></td>
      </tr>
      <tr class="bg-gray-100">
        <td class="p-2">Modar</td><td>editor</td><td>modar@site.com</td>
        <td><button class="text-red-500 hover:text-red-700">🗑️</button></td>
      </tr>
    </tbody>
  </table>

  <h3 class="text-xl font-semibold mb-2">➕ Ajouter un Admin</h3>
  <form class="grid grid-cols-2 gap-4">
    <input type="text" placeholder="Nom d'utilisateur" class="input">
    <input type="email" placeholder="Email" class="input">
    <select class="input"><option>editor</option><option>moderator</option></select>
    <input type="password" placeholder="Mot de passe" class="input">
    <button class="bg-red-600 hover:bg-red-700 text-white py-2 rounded col-span-2">Ajouter</button>
  </form>
</div>

<?php include('includes/footer.php'); ?>
