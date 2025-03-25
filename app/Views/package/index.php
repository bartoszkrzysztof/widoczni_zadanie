<?php
    //Lista pakietów

    $name = 'Lista pakietów';
    include_once __DIR__ . '/../components/header.php';
?>
    <header class="container">
        <h1>Lista pakietów</h1>
        <a href="/package/create" class="button">Dodaj nowy pakiet</a>
    </header>
    <main class="container content">
        <?php if ($packages) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Opis</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($packages as $package): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($package->name); ?></td>
                            <td><?php echo htmlspecialchars($package->description); ?></td>
                            <td>
                                <a href="/package/edit/<?php echo htmlspecialchars($package->id); ?>" class="button-alt">Edytuj</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Brak pakietów do wyświetlenia.</p>     
        <?php endif; ?>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>