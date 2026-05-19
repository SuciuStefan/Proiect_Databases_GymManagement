<?php
include("init.php"); // Conexiunea la baza de date
?>

<!DOCTYPE html>
<html>
<head>
    <title>Filtrare date</title>
    <style>
        /* Doar tabelul este stilizat, nu toată pagina */
        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #999;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        select, input[type="submit"] {
            padding: 6px 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Selectează un filtru:</h2>

<form method="post">
    <select name="filtru">
        <option value="antrenor_putini_clienti">Antrenorul cu cei mai putini clienti</option>
        <option value="clienti_abonament_expirat">Clienti cu abonamentul expirat</option>
        <option value="clienti_putine_antrenamente">Clienti cu cele mai putine antrenamente</option>
        <option value="clienti_multe_achizitii">Clientii cu cele mai multe achizitii</option>
        <option value="produse_populare">Cele mai cumparate Produse</option>
    </select>
    <input type="submit" name="filtreaza" value="Filtrează">
</form>

<?php
if (isset($_POST['filtreaza'])) {
    $filtru = $_POST['filtru'];
    $query = "";
    $titlu = "";

    switch ($filtru) {
        case "antrenor_putini_clienti":
            $titlu = "Top 3 antrenori cu cei mai puțini clienți";
            $query = "
                SELECT A.ID_Antrenor, A.Nume, A.Prenume, COUNT(DISTINCT P.ID_Client) AS NrClienti
                FROM antrenor A
                JOIN antrenament_specializat S ON A.ID_Antrenor = S.ID_Antrenor
                JOIN programare P ON S.ID_Antrenament = P.ID_Antrenament
                GROUP BY A.ID_Antrenor
                ORDER BY NrClienti ASC, A.ID_Antrenor
                LIMIT 3;
            ";
            break;

        case "clienti_abonament_expirat":
            $titlu = "Clienți cu abonamentul expirat";
            $query = "
                SELECT ID_Client, Nume, Prenume
                FROM client
                WHERE Status_Abonament = 0
                LIMIT 3;
            ";
            break;

        case "clienti_putine_antrenamente":
            $titlu = "Top 3 clienți cu cele mai puține antrenamente";
            $query = "
                SELECT C.ID_Client, C.Nume, C.Prenume, COUNT(P.ID_Antrenament) AS NrAntrenamente
                FROM client C
                LEFT JOIN programare P ON C.ID_Client = P.ID_Client
                GROUP BY C.ID_Client
                ORDER BY NrAntrenamente ASC, C.ID_Client
                LIMIT 3;
            ";
            break;

        case "clienti_multe_achizitii":
            $titlu = "Top 3 clienți cu cele mai multe achiziții";
            $query = "
                SELECT R.ID_Client, C.Nume, C.Prenume, COUNT(R.ID_Tranzactie) AS NrAchizitii
                FROM receptie R
                JOIN client C ON R.ID_Client = C.ID_Client
                WHERE R.ID_Client NOT IN (99, 100)
                GROUP BY R.ID_Client
                ORDER BY NrAchizitii DESC, R.ID_Client
                LIMIT 3;
            ";
            break;

        case "produse_populare":
            $titlu = "Top 3 cele mai cumpărate produse";
            $query = "
                SELECT P.Denumire, SUM(D.Cantitate) AS NrCumparari
                FROM detalii_receptie D
                JOIN produs P ON D.ID_Produs = P.ID_Produs
                GROUP BY P.ID_Produs
                ORDER BY NrCumparari DESC, P.ID_Produs
                LIMIT 3;
            ";
            break;
    }

    if ($query !== "") {
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<h3>$titlu</h3>";
            echo "<table>";
            echo "<tr>";
            while ($fieldinfo = mysqli_fetch_field($result)) {
                echo "<th>{$fieldinfo->name}</th>";
            }
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $val) {
                    echo "<td>$val</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nu există rezultate pentru filtrul selectat.</p>";
        }
    }
}
?>

</body>
</html>
