<?php
    // Dodaj konsultanta

    $name = 'Dodaj konsultanta';
    include_once __DIR__ . '/../components/header.php';
?>
    <header class="container">
        <h1>Dodaj konsultanta</h1>
        <a href="/consultant/index">Powrót do listy konsultantów</a>
    </header>
    <main class="container">
        <?php
            include_once __DIR__ . '/../components/validate_form.php';
        ?>
        <form action="/consultant/create" method="POST">
            <input type="hidden" name="action" value="create_consultant">
            <div class="form-group">
                <label for="first_name">Imię:</label>
                <input type="text" name="first_name" id="first_name" value="" required>
            </div>
            <div class="form-group">
                <label for="last_name">Nazwisko:</label>
                <input type="text" name="last_name" id="last_name" value="" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="" required>
            </div>
            <div class="form-group">
                <label for="phone">Telefon:</label>
                <input type="text" name="phone" id="phone" value="" required>
            </div>
            <button type="submit">Zapisz zmiany</button>
        </form>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>