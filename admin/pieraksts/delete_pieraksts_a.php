<?php
require_once("../../includes/CONFIG.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($con, "DELETE FROM pieraksti WHERE id = $id");
}

header("Location: pieraksts.php");
exit();
