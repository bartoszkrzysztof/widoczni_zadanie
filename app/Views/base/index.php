<?php
    //Home

    $name = 'Home';
    include_once __DIR__ . '/../components/header.php';
?>
    <header class="container">
        <h1>Dashboard</h1>
    </header>
    <main class="container content">
        <table>
            <tbody>
                <tr>
                    <th>Lista klientów</th>
                    <td>
                        <a href="/client/index" class="button">Przejdź do listy klientów</a>
                        <a href="/client/create" class="button-alt">Dodaj klienta</a>
                    </td>
                </tr>
                <tr>
                    <th>Lista konsultantów</th>
                    <td>
                        <a href="/consultant/index" class="button">Przejdź do listy konsultantów</a>
                        <a href="/consultant/create" class="button-alt">Dodaj konsultanta</a>
                    </td>
                </tr>
                <tr>
                    <th>Lista pakietów</th>
                    <td>
                        <a href="/package/index" class="button">Przejdź do listy pakietów</a>
                        <a href="/package/create" class="button-alt">Dodaj pakiet</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>