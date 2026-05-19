<?php
include 'init.php';
$result = $conn->query("SELECT ID_Client, Nume, Prenume FROM client");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['client_id'];
    $conn->query("DELETE FROM client WHERE ID_Client = $id");
    echo "Client sters.";
}
?>

<form method="post">
    <select name="client_id">
        <?php while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['ID_Client']}'>{$row['Nume']} {$row['Prenume']}</option>";
        } ?>
    </select>
    <input type="submit" value="Sterge Client">
</form>
