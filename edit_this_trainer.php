<?php
include 'init.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Preluare date antrenor
    $stmt = $conn->prepare("SELECT * FROM antrenor WHERE ID_Antrenor = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($trainer = $result->fetch_assoc()) {
        $mesaj = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nume = $_POST['nume'];
            $prenume = $_POST['prenume'];
            $specializare = $_POST['specializare'];

            $update = $conn->prepare("UPDATE antrenor SET Nume=?, Prenume=?, Specializare=? WHERE ID_Antrenor=?");
            if (!$update) {
                die("Eroare la pregătirea interogării: " . $conn->error);
            }
            $update->bind_param("sssi", $nume, $prenume, $specializare, $id);

            if ($update->execute()) {
                $mesaj = "<p style='color:green;'>Antrenorul a fost actualizat cu succes.</p>";
                // Actualizează și datele din formular
                $trainer['Nume'] = $nume;
                $trainer['Prenume'] = $prenume;
                $trainer['Specializare'] = $specializare;
            } else {
                $mesaj = "<p style='color:red;'>Eroare la actualizarea antrenorului: " . $update->error . "</p>";
            }
        }
        ?>

        <h3>Modifică datele antrenorului</h3>
        <?php echo $mesaj; ?>
        <form method="post">
            <label>Nume:</label><br>
            <input type="text" name="nume" value="<?php echo htmlspecialchars($trainer['Nume']); ?>"><br><br>

            <label>Prenume:</label><br>
            <input type="text" name="prenume" value="<?php echo htmlspecialchars($trainer['Prenume']); ?>"><br><br>

            <label>Specializare:</label><br>
            <input type="text" name="specializare" value="<?php echo htmlspecialchars($trainer['Specializare']); ?>"><br><br>

            <input type="submit" value="Salvează modificările">
        </form>

        <?php
    } else {
        echo "<p style='color:red;'>Antrenorul nu a fost găsit.</p>";
    }

    $stmt->close();
} else {
    echo "<p style='color:red;'>ID-ul antrenorului nu a fost specificat.</p>";
}
?>
