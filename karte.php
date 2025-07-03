<?php
$host = 'localhost';
$dbname = 'karteikarten';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}

// Kategorie und Index holen
$selectedCategory = $_GET['category'] ?? '';
$currentIndex = isset($_GET['index']) ? (int)$_GET['index'] : 0;

// Kategorien für Dropdown laden
$categories = $pdo->query("SELECT DISTINCT category FROM karten")->fetchAll(PDO::FETCH_COLUMN);

// Karten aus gewählter Kategorie holen (geordnet nach ID)
if ($selectedCategory) {
    $stmt = $pdo->prepare("SELECT * FROM karten WHERE category = :category ORDER BY id ASC");
    $stmt->execute(['category' => $selectedCategory]);
} else {
    $stmt = $pdo->query("SELECT * FROM karten ORDER BY id ASC");
}
$karten = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Karte zur aktuellen Position holen
$karte = $karten[$currentIndex] ?? null;
$totalKarten = count($karten);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Karteikarten Lernen</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        .card { background: gold; padding: 30px; border-radius: 10px; box-shadow: 0 0 100px #ccc; display: inline-block; }
        .answer { display: none; margin-top: 20px; font-weight: bold; }
        button, select { margin: 10px; padding: 10px 20px; font-size: 16px; cursor: pointer; }
    </style>
    <script>
        function showAnswer() {
            document.getElementById("answer").style.display = "block";
        }
    </script>
</head>
<body>

    <form method="get" action="karte.php">
        <label for="category">Kategorie wählen:</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="">-- Alle Kategorien --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= htmlspecialchars($cat) ?>" <?= $cat == $selectedCategory ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if ($karte): ?>
        <div class="card">
            <h2>Kategorie: <?= htmlspecialchars($karte['category']) ?></h2>
            <p><strong>Frage (<?= $currentIndex + 1 ?>/<?= $totalKarten ?>) / ID : <?= htmlspecialchars($karte['id']) ?></strong> <br> <?= htmlspecialchars($karte['questen']) ?></p>
            
            <div id="answer" class="answer">
                <p><strong>Antwort:</strong><br><?= htmlspecialchars($karte['answer']) ?></p>
            </div>

            <button onclick="showAnswer()">Antwort sehen</button>

            <?php if ($currentIndex + 1 < $totalKarten): ?>
                <a href="karte.php?category=<?= urlencode($selectedCategory) ?>&index=<?= $currentIndex + 1 ?>">
                    <button>Nächste Frage</button>
                </a>
            <?php else: ?>
                <p>Du hast alle Karten in dieser Kategorie gesehen 🎉</p>
                <a href="karte.php?category=<?= urlencode($selectedCategory) ?>"><button>Nochmal von vorne</button></a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p>Keine Karte gefunden.</p>
    <?php endif; ?>

</body>
</html>
