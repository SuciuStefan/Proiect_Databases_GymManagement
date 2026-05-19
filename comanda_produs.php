<?php
session_start();
include 'init.php';

// Detect user role and client ID
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'client';
$id_client = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

if ($role === 'admin') {
    $id_client = 101;
} elseif ($role === 'antrenor') {
    $id_client = 99;
}

echo "<h2>Comandă produse de la recepție</h2>";

// ---------------------------------
// HANDLE RESTOCK (admin only)
// ---------------------------------
if ($role === 'admin' && isset($_GET['restocare'])) {
    $sql = "UPDATE produs SET Stoc = LEAST(Stoc + 50, 100)";
    if ($conn->query($sql)) {
        echo "<p style='color:green;'>✔️ Produsele au fost restocate cu succes.</p>";
    } else {
        echo "<p style='color:red;'>Eroare la restocare: " . $conn->error . "</p>";
    }
}

// Display restock button (admin only)
if ($role === 'admin') {
    echo "<form method='get' action='index.php'>
            <input type='hidden' name='pagina' value='comanda_produs.php'>
            <input type='hidden' name='titlu' value='Comandă produse'>
            <input type='submit' name='restocare' value='Restocare Produse'>
          </form><br>";
}

// ---------------------------------
// HANDLE PRODUCT ORDER
// ---------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produs = isset($_POST['produs']) ? (int)$_POST['produs'] : 0;
    $cantitate = isset($_POST['cantitate']) ? (int)$_POST['cantitate'] : 0;

    // Check product details
    $stmt = $conn->prepare("SELECT Denumire, Pret, Stoc FROM produs WHERE ID_Produs = ?");
    $stmt->bind_param("i", $id_produs);
    $stmt->execute();
    $stmt->bind_result($denumire, $pret, $stoc);
    $stmt->fetch();
    $stmt->close();

    if (!$denumire) {
        echo "<p style='color:red;'>Produsul nu a fost găsit.</p>";
    } elseif ($cantitate <= 0 || $cantitate > $stoc) {
        echo "<p style='color:red;'>Cantitate invalidă sau stoc insuficient.</p>";
    } else {
        // Scade stocul
        $stmt = $conn->prepare("UPDATE produs SET Stoc = Stoc - ? WHERE ID_Produs = ?");
        $stmt->bind_param("ii", $cantitate, $id_produs);
        $stmt->execute();
        $stmt->close();

        // Calculează total
        $total = $cantitate * $pret;
        $tip_tranzactie = strtoupper($role);

        // Înregistrează comanda
        $stmt = $conn->prepare("INSERT INTO receptie (ID_Client, Data, Total, Tip_Tranzactie) VALUES (?, NOW(), ?, ?)");
        $stmt->bind_param("ids", $id_client, $total, $tip_tranzactie);
        if ($stmt->execute()) {
            echo "<p style='color:green;'>Comandă reușită: $cantitate x $denumire pentru $total RON.</p>";
        } else {
            echo "<p style='color:red;'>Eroare la înregistrarea comenzii.</p>";
        }
        $stmt->close();
    }
}

// ---------------------------------
// DISPLAY ORDER FORM
// ---------------------------------
$sql = "SELECT ID_Produs, Denumire, Pret, Stoc FROM produs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form method='post'>
            <label for='produs'>Selectează produs:</label>
            <select name='produs' id='produs'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['ID_Produs'] . "'>" .
             htmlspecialchars($row['Denumire']) . " - " . $row['Pret'] . " RON (" . $row['Stoc'] . " în stoc)</option>";
    }
    echo "</select><br><br>
          <label>Cantitate:</label>
          <input type='number' name='cantitate' min='1' value='1'><br><br>
          <input type='submit' value='Comandă'>
          </form>";
} else {
    echo "<p>Nu există produse disponibile.</p>";
}

$conn->close();
?>
