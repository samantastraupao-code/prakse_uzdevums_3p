<?php
session_start();
include '../includes/CONFIG.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Atļaujam tikai admin lietotājvārdu
    if ($username !== "admin") {
        $error = "Lietotājs nav atrasts.";
    } else {
        // Meklējam adminu datubāzē
        $sql = "SELECT * FROM admin WHERE username='admin' LIMIT 1";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            // Pārbaudām paroli
            if (password_verify($password, $user["password"])) {

                // Saglabājam sesiju
                $_SESSION["admin"] = true;

                // Pārsūtām uz admin paneli
                header("Location: pieraksts/pieraksts_a.php");
                exit();

            } else {
                $error = "Wrong password.";
            }
        } else {
            $error = "Admin user missing in database.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin pierakstīšanās </title>
</head>
<body>

<div class="login-box">
    <h2>Admin pierakstīšanās</h2>

    <?php if (isset($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Lietotājvārds" required>
        <input type="password" name="password" placeholder="Parole" required>
        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
