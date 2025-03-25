<?php
    //Lista konsultantów

    $name = 'Lista konsultantów';
    include_once __DIR__ . '/../components/header.php';
?>
    <header class="container">
        <h1>Lista konsultantów</h1>
        <a href="/consultant/create">Dodaj nowego konsultanta</a>
    </header>
    <main class="container">
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
                            <td><?php echo htmlspecialchars($consultant->id); ?></td>
                            <td><?php echo htmlspecialchars($consultant->first_name); ?></td>
                            <td><?php echo htmlspecialchars($consultant->last_name); ?></td>
                            <td><?php echo htmlspecialchars($consultant->email); ?></td>
                            <td><?php echo htmlspecialchars($consultant->phone); ?></td>
                            <td>
                                <a href="/consultant/show/<?php echo htmlspecialchars($consultant->id); ?>">Szczegóły</a>
                                <a href="/consultant/edit/<?php echo htmlspecialchars($consultant->id); ?>">Edytuj</a>
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