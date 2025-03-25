<?php
    // Szczegóły klienta

    $name = 'Szczegóły klienta';
    include_once __DIR__ . '/../components/header.php';
?>
<header class="container">
    <h1>Szczegóły klienta: <?= $client->name; ?></h1>
    <a href="/client/edit/<?= $client->id; ?>" class="button">Edytuj klienta</a>
    <a href="/client/index" class="button-alt">Powrót do listy klientów</a>
</header>
<main class="container content">
    <section>
        <h2>Informacje o kliencie</h2>
        <table>
            <tbody>
                <tr>
                    <th>Nazwa</th>
                    <td><?= $client->name; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $client->email; ?></td>
                </tr>
                <tr>
                    <th>Telefon</th>
                    <td><?= $client->phone; ?></td>
                </tr>
                <tr>
                    <th>Adres</th>
                    <td><?= $client->address_formatted; ?></td>
                </tr>
            </tbody>
        </table>
    </section>
    <section>
        <h2>Pakiet</h2>
        <?php if ($package) : ?>
            <table>
                <tbody>
                    <tr>
                        <th><?= $package['name']; ?></th>
                        <td><?= $package['description']; ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <p>Brak pakietu przypisanego do klienta.</p>
        <?php endif; ?>
    </section>
    <section>
        <h2>Osoby kontaktowe</h2>
        <?php if ($contacts) : ?>     
            <table>
                <tbody>
                    <tr>
                        <th>Imię i Nazwisko</th>
                        <th>Email</th>
                        <th>Telefon</th>
                    </tr>
                    <?php foreach ($contacts as $contact) : ?>
                         <tr>
                            <td><?= $contact['name']; ?></td>
                            <td><?= $contact['email']; ?></td>
                            <td><?= $contact['phone']; ?></td>
                         </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
    <section>
        <h2>Powiązani konsultanci</h2>
        <?php if ($consultants) : ?>
            <table>
                <tbody>
                    <tr>
                        <th>Imię i Nazwisko</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Akcje</th>
                    </tr>
                    <?php foreach ($consultants as $consultant) : ?>
                        <tr>
                            <td><?= $consultant['first_name'] . ' ' . $consultant['last_name']; ?></td>
                            <td><?= $consultant['email']; ?></td>
                            <td><?= $consultant['phone']; ?></td>
                            <td>
                                <a href="/consultant/show/<?= htmlspecialchars($consultant['id']); ?>" class="button">Szczegóły</a>
                                <a href="/consultant/edit/<?= htmlspecialchars($consultant['id']); ?>" class="button-alt">Edytuj</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Brak konsultantów przypisanych do klienta.</p>
        <?php endif; ?>
    </section>
</main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>