<?php
require_once '../assets/config.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $experience = $_POST['experience'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $emergency_contact = $_POST['emergency_contact'];
    $address = $_POST['address'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    // Uploads
    $photo_path = null;
    if (!empty($_FILES['photo']['name'])) {
        $photo_path = 'uploads/photos/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $photo_path);
    }

    $receipt_path = null;
    if (!empty($_FILES['payment_receipt']['name'])) {
        $receipt_path = 'uploads/receipts/' . basename($_FILES['payment_receipt']['name']);
        move_uploaded_file($_FILES['payment_receipt']['tmp_name'], '../' . $receipt_path);
    }

    // Insertion en base
    $stmt = $pdo->prepare("INSERT INTO inscriptions_academie
        (first_name, last_name, age, gender, experience, photo, contact, email, emergency_contact, address, height, weight, payment_receipt)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $first_name, $last_name, $age, $gender, $experience, $photo_path,
        $contact, $email, $emergency_contact, $address, $height, $weight, $receipt_path
    ]);

    $success_message = "✅ Inscription enregistrée avec succès !";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Esperance Sportive de Tunis</title>
    <link rel="icon" href="../img/logo.png" />
    <link rel="stylesheet" href="../css/form.css" />
    <link rel="stylesheet" href="../css/hearderfooter.css" />
  </head>

  <body>
  <?php include '../assets/header.php'; ?> 
    
    <div class="main">
      <h1 class="player-page-title">Espérance Sportive de Tunis Academie</h1>
      <h2 class="player-subtitle">Become a Champion Join Now</h2>
      <?php if (isset($success_message)): ?>
        <p style="color: green; font-weight: bold;"><?= $success_message ?></p>
      <?php endif; ?>

      <form action="submit" method="post" enctype="multipart/form-data">
        <label for="first_name">Prénom :</label>
        <input id="first_name" name="first_name" required="" type="text" />
        <label for="last_name">Nom :</label>
        <input id="last_name" name="last_name" required="" type="text" />
        <label for="age">Âge :</label>
        <input id="age" name="age" required="" type="number" />
        <label for="gender">Genre :</label>
        <select id="gender" name="gender" required="">
          <option value="">--Sélectionner--</option>
          <option value="male">Homme</option>
          <option value="female">Femme</option>
        </select>
        <label for="experience">Expérience précédente (optionnel) :</label>
        <textarea
          id="experience"
          name="experience"
          rows="4"
          placeholder="Décrivez votre expérience"
        ></textarea>
        <label for="photo">Télécharger votre photo :</label>
        <input
          id="photo"
          name="photo"
          
          type="file"
        />  
        <label for="contact">Numéro de téléphone :</label>
        <input id="contact" name="contact" required="" type="tel" />
        <label for="email">Adresse e-mail :</label>
        <input id="email" name="email" required="" type="email" />
        <label for="emergency_contact">Contact d'urgence :</label>
        <input
          id="emergency_contact"
          name="emergency_contact"
          required=""
          type="tel"
        />
        <label for="address">Adresse :</label>
        <textarea
          id="address"
          name="address"
          rows="3"
          placeholder="Entrez votre adresse"
          
        ></textarea>
        <label for="height">Taille (en cm) :</label>
        <input id="height" name="height" required="" type="number" />
        <label for="weight">Poids (en kg) :</label>
        <input id="weight" name="weight" required="" type="number" />
        <label for="payment_receipt">Télécharger le reçu de paiement :</label>
        <input
          id="payment_receipt"
          name="payment_receipt"
          accept="image/*,application/pdf"
          required=""
          type="file"
        />

        <button type="submit">Soumettre l'inscription</button>
      </form>
    </div>
    <script src="../js/form.js"></script>
    <script src="../js/nav.js"></script>
    <?php include '../assets/footer.php'; ?> 
  </body>
</html>
