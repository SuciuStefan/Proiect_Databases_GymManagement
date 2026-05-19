<?php
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_client = $_POST['id_client'];
    $id_antrenament = $_POST['id_antrenament'];
    $data_programare = $_POST['data_programare'];
    $ora = $_POST['ora'];

    $stmt = $conn->prepare("INSERT INTO Programare (ID_Client, ID_Antrenament, Data_Programare, Ora) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $id_client, $id_antrenament, $data_programare, $ora);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Antrenamentul a fost programat cu succes.</p>";
    } else {
        echo "<p style='color:red;'>Eroare la programare: " . $stmt->error . "</p>";
    }
}
?>


<h3>Adaugă Antrenament</h3>
<form method="post">
    <label>Selectează clientul:</label><br>
    <select name="id_client">
        <?php
        $res = $conn->query("SELECT ID_Client, Nume, Prenume FROM client WHERE Status_Abonament = 1");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['ID_Client']}'>{$row['Nume']} {$row['Prenume']}</option>";
        }
        ?>
    </select><br><br>

    <label>Selectează antrenamentul:</label><br>
    <select name="id_antrenament">
        <?php
        $res2 = $conn->query("SELECT ID_Antrenament, Denumire FROM Antrenament_specializat");
        while ($row = $res2->fetch_assoc()) {
            echo "<option value='{$row['ID_Antrenament']}'>{$row['Denumire']}</option>";
        }
        ?>
    </select><br><br>

    <label>Alege data:</label><br>
    <input type="date" name="data_programare" required><br><br>

    <label>Alege ora:</label><br>
    <input type="time" name="ora" required><br><br>

    <input type="submit" value="Programează">
</form>
