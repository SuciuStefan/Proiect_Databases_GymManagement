<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adaugă Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>

<?php
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $data_nastere = $_POST['data_nastere'];
    $status_abonament = 1;

    $stmt = $conn->prepare("INSERT INTO client (Nume, Prenume, Email, Telefon, Data_Nastere, Status_Abonament) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $nume, $prenume, $email, $telefon, $data_nastere, $status_abonament);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Client adăugat cu succes.</p>";
    } else {
        echo "<p style='color:red;'>Eroare la adăugare: " . $stmt->error . "</p>";
    }
}
?>

<form method="post">
    <label>Nume:</label><br>
    <input type="text" name="nume" required><br>

    <label>Prenume:</label><br>
    <input type="text" name="prenume" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br>

    <label>Telefon:</label><br>
    <input type="text" name="telefon" required><br>

    <label>Data Nașterii:</label><br>
    <input type="text" id="data_nastere" name="data_nastere" required><br><br>

    <input type="submit" value="Adaugă Client">
</form>

<script>
flatpickr("#data_nastere", {
    dateFormat: "Y-m-d", // Formatul exact YYYY-MM-DD
    maxDate: "today"
});
</script>

</body>
</html>
