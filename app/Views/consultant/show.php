<?php
    // Szczegóły klienta

    $name = 'Szczegóły klienta';
    include_once __DIR__ . '/../components/header.php';
?>
<header class="container">
    <h1>Szczegóły konsultanta: <?php echo $consultant->full_name; ?></h1>
    <a href="/consultant/edit/<?php echo $consultant->id; ?>">Edytuj konsultanta</a>
    <a href="/consultant/index">Powrót do listy konsultantów</a>
</header>
<main class="container">
    <section>
        <h2>Informacje o konsultancie</h2>
        <table>
            <tbody>
                <tr>
                    <th>ID</th>
                    <td><?php echo $consultant->id; ?></td>
                </tr>
                <tr>
                    <th>Imię i nazwisko</th>
                    <td><?php echo $consultant->full_name; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $consultant->email; ?></td>
                </tr>
                <tr>
                    <th>Telefon</th>
                    <td><?php echo $consultant->phone; ?></td>
                </tr>
            </tbody>
        </table>
    </section>
    <section>
        <h2>Powiązani klienci</h2>
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