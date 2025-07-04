<?php
$host = '';
$dbname = '';
$user = '';
$pass = ''; // Standard XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}
?>



<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Admin Bereich</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <section class="login">
    <h2>Meme hochladen</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="meme" accept="image/*" required>
      <input type="text" name="description" placeholder="Beschreibung" required>
      <button type="submit">Hochladen</button>
    </form>
  </section>
    <a href="startseite.html">Zurück zur Startseite</a>
</body>
</html>
