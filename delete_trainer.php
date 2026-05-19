<?php
include 'init.php';

$result = $conn->query("SELECT ID_Antrenor, Nume, Prenume FROM antrenor");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['trainer_id'];
    $conn->query("DELETE FROM antrenor WHERE ID_Antrenor = $id");
    echo "Antrenor sters.";
}
?>

<form method="post">
    <select name="trainer_id">
        <?php while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['ID_Antrenor']}'>{$row['Nume']} {$row['Prenume']}</option>";
        } ?>
    </select>
    <input type="submit" value="Sterge">
</form>
