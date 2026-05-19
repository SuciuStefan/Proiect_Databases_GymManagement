<?php
include 'init.php';
$result = $conn->query("SELECT ID_Antrenor, Nume, Prenume FROM antrenor");
?>

<form method="get" action="index.php">
    <input type="hidden" name="pagina" value="edit_this_trainer.php">
    <input type="hidden" name="titlu" value="Modificare Antrenor">
    
    <select name="id">
        <?php while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['ID_Antrenor']}'>{$row['Nume']} {$row['Prenume']}</option>";
        } ?>
    </select>
    
    <input type="submit" value="Modifică Antrenor">
</form>
