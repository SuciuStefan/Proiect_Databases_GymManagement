<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];
$titlu = isset($_GET['titlu']) ? $_GET['titlu'] : 'Pagina principala';
$content = isset($_GET['pagina']) ? $_GET['pagina'] : 'home.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>21Gym - <?php echo htmlspecialchars($titlu); ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- Wrap everything in page-container -->
    <div class="page-container">

        <div class="left-panel">
            <div class="logo">
                <img src="21_GYM_logo.png" width="110px" height="110px">
            </div>
            <ul>
                <a>Bine ai venit,</a>
                <?php if ($role === 'admin') { ?>
                    <a>ADMIN<br><br><br></a>
                    <a href="index.php?pagina=add_trainer.php&titlu=Adăugare%20Antrenor">⚪Adăugare Antrenor Personal</a><br>
                    <a href="index.php?pagina=delete_trainer.php&titlu=Ștergere%20Antrenor">⚪Ștergere Antrenor Personal</a><br>
                    <a href="index.php?pagina=edit_trainer.php&titlu=Modificare%20Antrenor">⚪Modificare Antrenor Personal</a><br>
                    <a href="index.php?pagina=add_client.php&titlu=Adăugare%20Client">⚪Adăugare Client Nou</a><br>
                    <a href="index.php?pagina=delete_client.php&titlu=Ștergere%20Client">⚪Ștergere/Ban Client</a><br>
                    <a href="index.php?pagina=edit_client.php&titlu=Modificare%20Client">⚪Modificare Client</a><br>
                    <a href="index.php?pagina=filtre.php&titlu=Filtre">⚪Filtre</a><br>
                    <a href="index.php?pagina=top5.php&titlu=Top%205">⚪Top 5 Performanțe</a><br>
                    <a href="logout.php">⚪Logout</a><br>
                <?php } elseif ($role === 'antrenor') { ?>
                    <a>ANTRENOR<br><br><br></a>
                    <a href="index.php?pagina=add_client.php&titlu=Adăugare%20Client">⚪Adăugare Client Nou</a><br>
                    <a href="index.php?pagina=delete_client.php&titlu=Ștergere%20Client">⚪Ștergere/Ban Client</a><br>
                    <a href="index.php?pagina=edit_client.php&titlu=Modificare%20Client">⚪Modificare Client</a><br>
                    <a href="index.php?pagina=top5.php&titlu=Top%205">⚪Top 5 Performanțe</a><br>
                    <a href="logout.php">⚪Logout</a>
                <?php } elseif ($role === 'client') { ?>
                    <a>CLIENT<br><br><br></a>
                    <a href="index.php?pagina=reinoire_abonament.php&titlu=Reînnoire%20Abonament">⚪Reînnoire Abonament</a><br>
                    <a href="index.php?pagina=adauga_antrenament.php&titlu=Adăugare%20Antrenament">⚪Adăugare Antrenament</a><br>
                    <a href="logout.php">⚪Logout</a>
                <?php } ?>
            </ul>
        </div>

        <!-- Right-side Content Area -->
        <div class="right-content">

            <div class="top-bar">
                <div class="title"><?php echo htmlspecialchars($titlu); ?></div>
            </div>

            <div class="menu-bar">
                <a href="index.php?pagina=home.php&titlu=Pagina%20principala" class="menu-item">Home</a>
                <a href="index.php?pagina=comanda_produs.php&titlu=Comanda" class="menu-item">Comanda</a>
                <a href="index.php?pagina=info_sala.php&titlu=Info%20Sala" class="menu-item">Info Sala</a>
            </div>

            <div class="main-content">
                <?php include($content); ?>
            </div>
        </div>

    </div>
</body>
</html>
