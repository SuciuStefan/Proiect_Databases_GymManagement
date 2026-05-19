<?php
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $specializare = $_POST['specializare'];

    $stmt = $conn->prepare("INSERT INTO antrenor (Nume, Prenume, Specializare) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nume, $prenume, $specializare);
    $stmt->execute();
    echo "Antrenor adaugat cu succes.";
}
?>

<form method="post">
    <label>Nume:</label><input type="text" name="nume"><br>
    <label>Prenume:</label><input type="text" name="prenume"><br>
    <label>Specializare:</label><input type="text" name="specializare"><br>
    <input type="submit" value="Adauga Antrenor">
</form>
