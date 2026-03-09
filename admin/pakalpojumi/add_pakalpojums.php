<?php
require_once("../../includes/CONFIG.php");

if (isset($_POST['submit'])) {

    if (empty($_POST['nosaukums'])) {
        $error = "Lūdzu ievadiet pakalpojuma nosaukumu.";
    } else {

        $nosaukums = mysqli_real_escape_string($con, $_POST['nosaukums']);

        // Ievietošana datubāzē
        $query = "INSERT INTO pakalpojumi (nosaukums) VALUES ('$nosaukums')";
        $result = mysqli_query($con, $query);

        if ($result) {
            header("Location: pakalpojumi_admin.php");
            exit();
        } else {
            $error = "Kļūda saglabājot datubāzē.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
<meta charset="UTF-8">
<title>Pievienot pakalpojumu</title>
</head>
<body>

<h1>Pievienot jaunu pakalpojumu</h1>

<?php if (isset($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="add_pakalpojums.php" method="post">

    <label>Pakalpojuma nosaukums:</label><br>
    <input type="text" name="nosaukums" required><br><br>

    <button type="submit" name="submit">Pievienot</button>
</form>

<br>
<a href="pakalpojumi_admin.php">Atpakaļ uz pakalpojumu sarakstu</a>

</body>
</html>
