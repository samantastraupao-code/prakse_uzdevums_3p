<?php
session_start();
include 'includes/CONFIG.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vards = mysqli_real_escape_string($con, $_POST["vards"]);
    $telefons = mysqli_real_escape_string($con, $_POST["telefons"]);
    $apraksts = mysqli_real_escape_string($con, $_POST["apraksts"]);

    // Pakalpojums ir optional
    $pakalpojums_id = !empty($_POST["pakalpojums_id"]) ? intval($_POST["pakalpojums_id"]) : "NULL";

    // Ievieto datubāzē
    $sql = "INSERT INTO pieraksti (vards, telefons, pakalpojums_id, apraksts, datums)
            VALUES ('$vards', '$telefons', $pakalpojums_id, '$apraksts', NOW())";

    if (mysqli_query($con, $sql)) {
        $success = "Pieteikums veiksmīgi iesniegts! Ar Jums mēs sazināsimies drīzumā!";
    } else {
        $error = "Kļūda saglabājot datus: " . mysqli_error($con);
    }
}

// pakalpojumi dropdownā
$pakalpojumi = mysqli_query($con, "SELECT id, nosaukums FROM pakalpojumi");
?>
<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <title>Pieteikuma forma</title>
  <link rel="stylesheet" href="css/style_login.css">
</head>
<body>

<div class="container">
    <h2>Pieteikt pakalpojumu</h2>

    <div class="topnav">
        <a href="index.php">Sākums</a>
        <a href="pieraksts.php" class="active">Pieteikties</a>
        <a href="kontakti.php">Kontakti</a>
        <a href="pakalpojumi.php">Pakalpojumi</a>

    </div>

    <?php if (isset($success)): ?>
        <div class="success"><p><?= htmlspecialchars($success) ?></p></div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="error"><p><?= htmlspecialchars($error) ?></p></div>
    <?php endif; ?>

    <form method="post" action="pieraksts.php" novalidate>
        <input type="text" name="vards" placeholder="Vārds" required>

        <input type="text" name="telefons" placeholder="Telefona numurs" required>

        <select name="pakalpojums_id">
            <option value=""> Izvēlies pakalpojumu (nav obligāti) </option>
            <?php while ($row = mysqli_fetch_assoc($pakalpojumi)): ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nosaukums']) ?></option>
            <?php endwhile; ?>
        </select>

        <textarea name="apraksts" placeholder="Problēmas apraksts" required></textarea>

        <input type="submit" value="Iesniegt">
        <a href="index.php" class="button_link">Back</a>
    </form>
</div>

</body>
</html>