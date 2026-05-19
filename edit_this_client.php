<?php
include 'init.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Preluare date client
    $stmt = $conn->prepare("SELECT * FROM client WHERE ID_Client = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($client = $result->fetch_assoc()) {
        $mesaj = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nume = $_POST['nume'];
            $prenume = $_POST['prenume'];
            $email = $_POST['email'];
            $telefon = $_POST['telefon'];
            $data_nastere = $_POST['data_nastere'];
            $status = $_POST['status_abonament'];

            $update = $conn->prepare("UPDATE client SET Nume=?, Prenume=?, Email=?, Telefon=?, Data_Nastere=?, Status_Abonament=? WHERE ID_Client=?");
            if (!$update) {
                die("Eroare la pregătirea interogării: " . $conn->error);
            }
            $update->bind_param("ssssssi", $nume, $prenume, $email, $telefon, $data_nastere, $status, $id);

            if ($update->execute()) {
                $mesaj = "<p style='color:green;'>Clientul a fost actualizat cu succes.</p>";
                // Actualizează și datele din formular
                $client['Nume'] = $nume;
                $client['Prenume'] = $prenume;
                $client['Email'] = $email;
                $client['Telefon'] = $telefon;
                $client['Data_Nastere'] = $data_nastere;
                $client['Status_Abonament'] = $status;
            } else {
                $mesaj = "<p style='color:red;'>Eroare la actualizarea clientului: " . $update->error . "</p>";
            }
        }
        ?>

        <!DOCTYPE html>
        <html lang="ro">
        <head>
            <meta charset="UTF-8">
            <title>Editare Client</title>

            <!-- Flatpickr CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        </head>
        <body>
        <h3>Modifică datele clientului</h3>
        <?php echo $mesaj; ?>
        <form method="post">
            <label>Nume:</label><br>
            <input type="text" name="nume" value="<?php echo htmlspecialchars($client['Nume']); ?>"><br><br>

            <label>Prenume:</label><br>
            <input type="text" name="prenume" value="<?php echo htmlspecialchars($client['Prenume']); ?>"><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($client['Email']); ?>"><br><br>

            <label>Telefon:</label><br>
            <input type="text" name="telefon" value="<?php echo htmlspecialchars($client['Telefon']); ?>"><br><br>

            <label>Data Nașterii:</label><br>
            <input type="text" id="data_nastere" name="data_nastere" value="<?php echo htmlspecialchars($client['Data_Nastere']); ?>" required><br><br>

            <label>Status Abonament:</label><br>
            <input type="text" name="status_abonament" value="<?php echo htmlspecialchars($client['Status_Abonament']); ?>"><br><br>

            <input type="submit" value="Salvează modificările">
        </form>

        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("#data_nastere", {
                dateFormat: "Y-m-d",
                maxDate: "today"
            });
        </script>
        </body>
        </html>

        <?php
    } else {
        echo "<p style='color:red;'>Clientul nu a fost găsit.</p>";
    }

    $stmt->close();
} else {
    echo "<p style='color:red;'>ID-ul clientului nu a fost specificat.</p>";
}
?>
