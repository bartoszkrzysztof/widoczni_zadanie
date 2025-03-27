<?php
    // Szczegóły konsultanta

    $name = 'Szczegóły konsultanta';
    include_once __DIR__ . '/../components/header.php';
?>
<header class="container">
    <h1>Szczegóły konsultanta: <?= $consultant->full_name; ?></h1>
    <a href="/consultant/edit/<?= $consultant->id; ?>" class="button">Edytuj konsultanta</a>
    <a href="/consultant/index" class="button-alt">Powrót do listy konsultantów</a>
</header>
<main class="container content">
    <section>
        <h2>Informacje o konsultancie</h2>
        <table>
            <tbody>
                <tr>
                    <th>Imię i nazwisko</th>
                    <td><?= $consultant->full_name; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $consultant->email; ?></td>
                </tr>
                <tr>
                    <th>Telefon</th>
                    <td><?= $consultant->phone; ?></td>
                </tr>
            </tbody>
        </table>
    </section>
    <section>
        <h2>Powiązani klienci</h2>
        <?php if ($clients) : ?>
            <table>
                <tbody>
                    <tr>
                        <th>Nazwa</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Akcje</th>
                    </tr>
                    <?php foreach ($clients as $client) : ?>
                        <tr>
                            <td><?= $client['name'] ?></td>
                            <td><?= $client['email']; ?></td>
                            <td><?= $client['phone']; ?></td>
                            <td>
                                <a href="/client/show/<?= htmlspecialchars($client['id']); ?>" class="button">Szczegóły</a>
                                <a href="/client/edit/<?= htmlspecialchars($client['id']); ?>" class="button-alt">Edytuj</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Brak klientów przypisanych do konsultanta.</p>
        <?php endif; ?>
    </section>
</main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>