<?php
require_once("../../includes/CONFIG.php");

// Fetch all services
$query = "SELECT * FROM pakalpojumi ORDER BY id DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="lv">
<head>
<meta charset="UTF-8">
<title>Pakalpojumi</title>
</head>
<body>

<h1>Pakalpojumu saraksts</h1>

<a href="../pieraksts/pieraksts.php">Pieraksti</a> 
<a href="pakalpojumi_admin.php">Pakalpojumi</a> 
<a href="add_pakalpojums.php">Pievienot pakalpojumu</a>
<a href="../logout.php">Logout</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nosaukums</th>
            <th>Pievienot pakalpojumu</th>
            <th>Dzēst</th>
        </tr>
    </thead>

    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['nosaukums']); ?></td>
            <td>

            <a href="add_pakalpojums.php"> Pievienot</a>
                <a href="delete_pakalpojums.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Vai tiešām dzēst šo pakalpojumu?')">
                   Dzēst
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
