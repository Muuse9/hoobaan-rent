<?php
require "../../config/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("UPDATE props SET is_leased = 1 WHERE id = :id");
    $stmt->execute([':id' => $id]);

    header("Location: index.php");
    exit();
}
?>
