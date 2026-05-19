<img src="logo.png" alt="Logo" width="100%">
<ul>
    <li><a href="index.php?page=home">Acasă</a></li>
    <?php if ($rol === 'admin'): ?>
        <li><a href="index.php?page=admin_adauga_antrenor">Adaugă Antrenor</a></li>
        <li><a href="index.php?page=admin_sterge_antrenor">Șterge Antrenor</a></li>
    <?php elseif ($rol === 'antrenor'): ?>
        <li><a href="index.php?page=progresa_client">Vezi Progres Clienți</a></li>
    <?php elseif ($rol === 'client'): ?>
        <li><a href="index.php?page=end_goals">Vezi Progres Personal</a></li>
    <?php endif; ?>
    <li><a href="logout.php">Deconectare</a></li>
</ul>
