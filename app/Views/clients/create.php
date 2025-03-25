<?php
    // Dodaj klienta

    $name = 'Dodaj klienta';
    include_once __DIR__ . '/../components/header.php';
?>
    <header class="container">
        <h1>Dodaj klienta</h1>
        <a href="/client/index" class="button-alt">Powrót do listy klientów</a>
    </header>
    <main class="container content">
        <?php
            include_once __DIR__ . '/../components/validate_form.php';
        ?>
        <form action="/client/create" method="POST">
            <input type="hidden" name="action" value="create_client">
            <div class="form-group">
                <label for="name">Nazwa:</label>
                <input type="text" name="name" id="name" value="" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="" required>
            </div>
            <div class="form-group">
                <label for="phone">Telefon:</label>
                <input type="text" name="phone" id="phone" value="" required>
            </div>
            <div class="form-group">
                <label for="address">Adres:</label>
                <input type="text" name="address" id="address" value="" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Kod pocztowy:</label>
                <input type="text" name="postal_code" id="postal_code" value="" required>
            </div>
            <div class="form-group">
                <label for="city">Miasto:</label>
                <input type="text" name="city" id="city" value="" required>
            </div>
            <div class="form-group">
                <label for="country">Kraj:</label>
                <input type="text" name="country" id="country" value="" required>
            </div>
            <button class="button" type="submit">Zapisz zmiany</button>
        </form>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>