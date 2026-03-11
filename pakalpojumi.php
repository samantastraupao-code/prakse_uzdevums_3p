<?php
session_start();
require_once("includes/CONFIG.php");

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query = "
    SELECT id, nosaukums
    FROM pakalpojumi
    ORDER BY nosaukums ASC
";

$result = mysqli_query($con, $query);

$pakalpojumi = [];
while ($row = mysqli_fetch_assoc($result)) {
    $pakalpojumi[] = $row;
}
?>
<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pakalpojumi</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="topnav">
        <nav>
            <ul>
                <li><a href="index.php">Sākumlapa</a></li>
                <li><a href="pakalpojumi.php">Pakalpojumi</a></li>
                <li><a href="kontakti.php">Kontakti</a></li>
                <li><a href="pieraksts.php">Pieraksts</a></li>
            </ul>
        </nav>
    </div>

    <div class="container_service">

        <h1>Mūsu pakalpojumi</h1>

        <div class="offers">
            <?php foreach ($pakalpojumi as $p): ?>
                <div class="offer_box">
                    <h3><?php echo htmlspecialchars($p['nosaukums']); ?></h3>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>
</html>
