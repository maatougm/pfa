<?php
require_once '../assets/config.php';
session_start();

$success = '';
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

if (isset($_POST['add_year'])) {
    $category = $_POST['category'];
    $year = trim($_POST['year']);
    $existing = $pdo->prepare("SELECT * FROM honours WHERE category = ?");
    $existing->execute([$category]);
    $h = $existing->fetch(PDO::FETCH_ASSOC);
    if ($h) {
        $years = explode(',', $h['years']);
        if (!in_array($year, $years)) {
            $years[] = $year;
            sort($years);
            $years_str = implode(',', $years);
            $stmt = $pdo->prepare("UPDATE honours SET years = ? WHERE id = ?");
            $stmt->execute([$years_str, $h['id']]);
            $_SESSION['success'] = "Année ajoutée avec succès.";
        }
    }
    header("Location: honours.php");
    exit;
}

if (isset($_POST['add_competition'])) {
    $stmt = $pdo->prepare("INSERT INTO honours (category, years, img, sport) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['new_category'],
        $_POST['years'],
        $_POST['img'],
        $_POST['sport']
    ]);
    $_SESSION['success'] = "Nouvelle compétition ajoutée.";
    header("Location: honours.php");
    exit;
}

if (isset($_GET['remove']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $year = $_GET['remove'];
    $stmt = $pdo->prepare("SELECT years FROM honours WHERE id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $years = explode(',', $result['years']);
        $years = array_filter($years, fn($y) => $y != $year);
        $new_years = implode(',', $years);
        $update = $pdo->prepare("UPDATE honours SET years = ? WHERE id = ?");
        $update->execute([$new_years, $id]);
        $_SESSION['success'] = "Année supprimée.";
    }
    header("Location: honours.php");
    exit;
}

$honours = $pdo->query("SELECT * FROM honours ORDER BY sport, category")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Palmarès</title>
    <link rel="stylesheet" href="../css/hearderfooter.css" />
    <link rel="icon" href="../img/logo.png" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            font-size: 16px;
        }
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        .admin-main {
            flex-grow: 1;
            padding: 30px;
            background-color: #f4f4f4;
        }
        h1, h3 {
            text-align: center;
            color: #d90429;
        }
        .form-container, .table-container {
            background: white;
            margin: 30px auto;
            padding: 25px;
            max-width: 1000px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        input, select {
            padding: 10px;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background: #d90429;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            grid-column: span 2;
        }
        input[type="submit"]:hover {
            background: #fcdb03;
            color: black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background: #d90429;
            color: white;
        }
        img {
            max-height: 50px;
        }
        .year-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            justify-content: center;
        }
        .year-tags span {
            background: #eee;
            padding: 5px 10px;
            border-radius: 12px;
            font-weight: bold;
        }
        .year-tags span a {
            color: red;
            margin-left: 5px;
            text-decoration: none;
        }
        .alert {
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
        <h1>Gestion des Palmarès</h1>

        <?php if ($success): ?>
            <p class="alert"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <div class="form-container">
            <h3>➕ Ajouter une nouvelle compétition</h3>
            <form method="POST">
                <input type="text" name="new_category" placeholder="Nom du trophée" required>
                <input type="text" name="years" placeholder="Années (séparées par des virgules)" required>
                <input type="text" name="img" placeholder="Chemin ou URL de l'image du trophée" required>
                <select name="sport" required>
                    <option value="">-- Sport --</option>
                    <option value="football">Football</option>
                    <option value="handball">Handball</option>
                    <option value="volleyball">Volleyball</option>
                </select>
                <input type="submit" name="add_competition" value="Créer le trophée">
            </form>
        </div>

        <div class="form-container">
            <h3>➕ Ajouter une année à une compétition existante</h3>
            <form method="POST">
                <select name="category" required>
                    <option value="">-- Sélectionner un trophée --</option>
                    <?php
                    $cats = $pdo->query("SELECT DISTINCT category FROM honours ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
                    foreach ($cats as $cat): ?>
                        <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="year" placeholder="Année à ajouter (ex: 2024)" required>
                <input type="submit" name="add_year" value="Ajouter l'année au palmarès">
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th>Années</th>
                        <th>Sport</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($honours as $h): ?>
                    <tr>
                        <td><?= htmlspecialchars($h['category']) ?></td>
                        <td>
                            <div class="year-tags">
                            <?php foreach (explode(',', $h['years']) as $y): ?>
                                <span><?= $y ?><a href="?remove=<?= $y ?>&id=<?= $h['id'] ?>">✕</a></span>
                            <?php endforeach; ?>
                            </div>
                        </td>
                        <td><?= htmlspecialchars($h['sport']) ?></td>
                        <td><img src="<?= htmlspecialchars($h['img']) ?>" alt="Trophée"></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../assets/footer.php'; ?>
</body>
</html>
