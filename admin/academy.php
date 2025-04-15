<?php
require_once '../assets/config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$candidats = $pdo->query("SELECT * FROM inscriptions_academie ORDER BY date_inscription DESC")->fetchAll(PDO::FETCH_ASSOC);
$total = count($candidats);
$total_male = $pdo->query("SELECT COUNT(*) FROM inscriptions_academie WHERE gender = 'male'")->fetchColumn();
$total_female = $pdo->query("SELECT COUNT(*) FROM inscriptions_academie WHERE gender = 'female'")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Inscriptions</title>
    <link rel="stylesheet" href="../css/hearderfooter.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #d90429;
        }
        .stats {
            text-align: center;
            margin-bottom: 20px;
        }
        .candidat {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .candidat h3 {
            color: #d90429;
        }
        .candidat p {
            margin: 4px 0;
        }
        img.photo {
            max-height: 80px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<?php include '../assets/header.php'; ?>
<div class='admin-wrapper'>
<?php include '../assets/sidebar.php'; ?>
<div class='admin-main'>

<div class="container">
    <h1>Liste des Inscriptions</h1>

    <div class="stats">
        <strong>Total inscrits :</strong> <?= $total ?> |
        <strong>Hommes :</strong> <?= $total_male ?> |
        <strong>Femmes :</strong> <?= $total_female ?>
    </div>

    <?php foreach ($candidats as $c): ?>
    <div class="candidat">
        <h3><?= htmlspecialchars($c['first_name'] . ' ' . $c['last_name']) ?> (<?= $c['age'] ?> ans)</h3>
        <p><strong>Sport :</strong> <?= htmlspecialchars($c['sport']) ?> | <strong>Sexe :</strong> <?= $c['gender'] ?></p>
        <p><strong>Téléphone :</strong> <?= $c['contact'] ?> | <strong>Email :</strong> <?= $c['email'] ?></p>
        <p><strong>Adresse :</strong> <?= $c['address'] ?></p>
        <p><strong>Tuteur :</strong> <?= $c['tuteur_nom'] ?? '—' ?> (CIN: <?= $c['cin_tuteur'] ?? '—' ?>)</p>
        <p><strong>Expérience :</strong> <?= $c['experience'] ?></p>
        <p><strong>Taille / Poids :</strong> <?= $c['height'] ?> cm / <?= $c['weight'] ?> kg</p>
        <p><strong>Date :</strong> <?= $c['date_inscription'] ?></p>
        <?php if ($c['photo']): ?>
            <p><img class="photo" src="../<?= $c['photo'] ?>" alt="Photo"></p>
        <?php endif; ?>
        <?php if ($c['payment_receipt']): ?>
            <p><a href="../<?= $c['payment_receipt'] ?>" target="_blank">🧾 Voir preuve de paiement</a></p>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>

</div>
</div>
<?php include '../assets/footer.php'; ?>
</body>
</html>