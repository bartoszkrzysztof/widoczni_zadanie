<?php
    //Lista konsultantów

    $name = 'Lista konsultantów';
    include_once __DIR__ . '/../components/header.php';
?>
    <header class="container">
        <h1>Lista konsultantów</h1>
        <a href="/consultant/create" class="button">Dodaj nowego konsultanta</a>
    </header>
    <main class="container content">
        <?php if ($consultants) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultants as $consultant): ?>
                        <tr>
                            <td><?= htmlspecialchars($consultant->id); ?></td>
                            <td><?= htmlspecialchars($consultant->first_name); ?></td>
                            <td><?= htmlspecialchars($consultant->last_name); ?></td>
                            <td><?= htmlspecialchars($consultant->email); ?></td>
                            <td><?= htmlspecialchars($consultant->phone); ?></td>
                            <td>
                                <a href="/consultant/show/<?= htmlspecialchars($consultant->id); ?>" class="button">Szczegóły</a>
                                <a href="/consultant/edit/<?= htmlspecialchars($consultant->id); ?>" class="button-alt">Edytuj</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Brak konsultantów do wyświetlenia.</p>     
        <?php endif; ?>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>