<?php
    //Lista klientów

    $name = 'Lista klientów';
    include_once __DIR__ . '/../components/header.php';
?>
<header class="container">
    <h1>Lista klientów</h1>
    <a href="/client/create" class="button">Dodaj nowego klienta</a>
</header>
<?php if ($clients) : ?>
    <main class="container content">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imię</th>
                    <th>Email</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= $client->id; ?></td>
                        <td><?= $client->name; ?></td>
                        <td><?= $client->email; ?></td>
                        <td>
                            <a href="/client/show/<?= $client->id; ?>" class="button">Szczegóły</a>
                            <a href="/client/edit/<?= $client->id; ?>" class="button-alt">Edytuj</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
<?php else : ?>
    <p>Brak klientów do wyświetlenia.</p>
<?php endif; ?>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>