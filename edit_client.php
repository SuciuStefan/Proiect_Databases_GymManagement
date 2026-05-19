<?php
include 'init.php';
$result = $conn->query("SELECT ID_Client, Nume, Prenume FROM client");
?>

<form method="get" action="index.php">
    <input type="hidden" name="pagina" value="edit_this_client.php">
    <input type="hidden" name="titlu" value="Modificare Client">
    
    <select name="id">
        <?php while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['ID_Client']}'>{$row['Nume']} {$row['Prenume']}</option>";
        } ?>
    </select>
    
    <input type="submit" value="Modifică Client">
</form>
