<div class="header">
    <?php
    $titluri = [
        'home' => 'Pagina Principală',
        'admin_adauga_antrenor' => 'Adăugare Antrenor',
        'admin_sterge_antrenor' => 'Ștergere Antrenor',
        'progresa_client' => 'Progres Clienți',
        'end_goals' => 'Progres Personal'
    ];
    echo $titluri[$page] ?? 'Pagina 21Gym';
    ?>
</div>
