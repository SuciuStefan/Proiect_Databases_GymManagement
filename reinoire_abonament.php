<?php
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_client = $_POST['id_client'];

    $stmt = $conn->prepare("UPDATE client SET Status_Abonament = 1 WHERE ID_Client = ?");
    $stmt->bind_param("i", $id_client);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Abonamentul a fost reînnoit cu succes.</p>";
    } else {
        echo "<p style='color:red;'>Eroare la reînnoirea abonamentului: " . $stmt->error . "</p>";
    }
}
?>

<h3>Reînnoiește Abonament</h3>
<form method="post">
    <label>Selectează clientul:</label><br>
    <select name="id_client">
        <?php
        $res = $conn->query("SELECT ID_Client, Nume, Prenume FROM client WHERE Status_Abonament = 0");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['ID_Client']}'>{$row['Nume']} {$row['Prenume']}</option>";
        }
        ?>
    </select><br><br>
    <input type="submit" value="Reînnoiește">
</form>
