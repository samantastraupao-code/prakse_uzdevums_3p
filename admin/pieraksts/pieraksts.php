<?php
require_once("../../includes/CONFIG.php");

// Fetch pieraksti un pakalpojuma nosaukumu
$query = "
    SELECT p.id, p.vards, p.telefons, p.apraksts, p.datums,
           pk.nosaukums AS pakalpojums
    FROM pieraksti p
    LEFT JOIN pakalpojumi pk ON p.pakalpojums_id = pk.id
    ORDER BY p.datums DESC
";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="lv">
<head>
<meta charset="UTF-8">
<title>Pierakstu saraksts</title>
</head>
<body>

<h1>Pierakstu saraksts</h1>

<a href="../pakalpojumi/pakalpojumi_admin.php">Pakalpojumi</a> 
<a href="pieraksts.php">Pieraksti</a> 
<a href="../../logout.php">Izrakstīties</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Vārds</th>
            <th>Telefons</th>
            <th>Pakalpojums</th>
            <th>Apraksts</th>
            <th>Datums</th>
            <th>Dzēst</th>
        </tr>
    </thead>

    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['vards']); ?></td>
            <td><?php echo htmlspecialchars($row['telefons']); ?></td>
            <td>
                <?php echo $row['pakalpojums'] ? htmlspecialchars($row['pakalpojums']) : "Nav norādīts"; ?>
            </td>
            <td><?php echo nl2br(htmlspecialchars($row['apraksts'])); ?></td>
            <td><?php echo $row['datums']; ?></td>
            <td>
                <a href="delete_pieraksts_a.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Vai tiešām dzēst šo pierakstu?')">
                   Dzēst
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
