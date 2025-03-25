<?php
    // Szczegóły klienta

    $name = 'Szczegóły klienta';
    include_once __DIR__ . '/../components/header.php';
?>
<header class="container">
    <h1>Szczegóły klienta: <?php echo $client->name; ?></h1>
    <a href="/client/edit/<?php echo $client->id; ?>">Edytuj klienta</a>
    <a href="/client/index">Powrót do listy klientów</a>
</header>
<main class="container">
    <section>
        <h2>Informacje o kliencie</h2>
        <table>
            <tbody>
                <tr>
                    <th>ID</th>
                    <td><?php echo $client->id; ?></td>
                </tr>
                <tr>
                    <th>Nazwa</th>
                    <td><?php echo $client->name; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $client->email; ?></td>
                </tr>
                <tr>
                    <th>Telefon</th>
                    <td><?php echo $client->phone; ?></td>
                </tr>
                <tr>
                    <th>Adres</th>
                    <td><?php echo $client->address_formatted; ?></td>
                </tr>
            </tbody>
        </table>
    </section>
    <section>
        <h2>Osoby kontaktowe</h2>
        <table>
            <tbody>
                <!-- <tr>
                    <th>ID</th>
                    <td></td>
                </tr> -->
            </tbody>
        </table>
    </section>
    <section>
        <h2>Powiązani konsultanci</h2>
        <table>
            <tbody>
                <!-- <tr>
                    <th>ID</th>
                    <td></td>
                </tr> -->
            </tbody>
        </table>
    </section>
</main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>