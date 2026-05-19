<?php
include 'init.php';
?>

<h3>Top 5 Antrenori cu cei mai mulți clienți</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID Antrenor</th>
        <th>Nume</th>
        <th>Prenume</th>
        <th>Număr clienți</th>
    </tr>

<?php
// Top 5 Antrenori
$sql_antrenori = "
    SELECT a.ID_Antrenor, a.Nume, a.Prenume, COUNT(DISTINCT p.ID_Client) AS NumarClienti
    FROM antrenor a
    JOIN antrenament_specializat s ON a.ID_Antrenor = s.ID_Antrenor
    JOIN programare p ON p.ID_Antrenament = s.ID_Antrenament
    GROUP BY a.ID_Antrenor
    ORDER BY NumarClienti DESC, a.ID_Antrenor ASC
    LIMIT 5
";

$result = $conn->query($sql_antrenori);
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['ID_Antrenor']}</td>
        <td>{$row['Nume']}</td>
        <td>{$row['Prenume']}</td>
        <td>{$row['NumarClienti']}</td>
    </tr>";
}
?>
</table>

<br><br>

<h3>Top 5 Clienți cu cele mai multe antrenamente specializate</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID Client</th>
        <th>Nume</th>
        <th>Prenume</th>
        <th>Număr antrenamente</th>
    </tr>

<?php
// Top 5 Clienți
$sql_clienti = "
    SELECT c.ID_Client, c.Nume, c.Prenume, COUNT(p.ID_Programare) AS NrAntrenamente
    FROM client c
    JOIN programare p ON c.ID_Client = p.ID_Client
    GROUP BY c.ID_Client
    ORDER BY NrAntrenamente DESC, c.ID_Client ASC
    LIMIT 5
";

$result = $conn->query($sql_clienti);
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['ID_Client']}</td>
        <td>{$row['Nume']}</td>
        <td>{$row['Prenume']}</td>
        <td>{$row['NrAntrenamente']}</td>
    </tr>";
}
?>
</table>
