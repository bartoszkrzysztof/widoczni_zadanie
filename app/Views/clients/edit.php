<?php
    // Edytuj klienta

    $name = 'Edytuj klienta';
    include_once __DIR__ . '/../components/header.php';
    $client_name = $client->name ?? 'null';
?>
    <header class="container">
        <h1>Edytuj klienta: <?php echo $client_name; ?></h1>
        <a href="/client/create">Dodaj nowego klienta</a>
        <a href="/client/index">Powrót do listy klientów</a>
    </header>
    <main class="container">
        <?php if ($client) : ?>
            <?php
                include_once __DIR__ . '/../components/validate_form.php';
            ?>
            <form action="/client/edit/<?php echo $client->id; ?>" method="POST">
                <input type="hidden" name="action" value="update_client">
                <div class="form-group">
                    <label for="name">Nazwa:</label>
                    <input type="text" name="name" id="name" value="<?php echo $client->name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $client->email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefon:</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $client->phone; ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Adres:</label>
                    <input type="text" name="address" id="address" value="<?php echo $client->address; ?>" required>
                </div>
                <div class="form-group">
                    <label for="postal_code">Kod pocztowy:</label>
                    <input type="text" name="postal_code" id="postal_code" value="<?php echo $client->postal_code; ?>" required>
                </div>
                <div class="form-group">
                    <label for="city">Miasto:</label>
                    <input type="text" name="city" id="city" value="<?php echo $client->city; ?>" required>
                </div>
                <div class="form-group">
                    <label for="country">Kraj:</label>
                    <input type="text" name="country" id="country" value="<?php echo $client->country; ?>" required>
                </div>
                <button type="submit">Zapisz zmiany</button>
            </form>
            <form action="/client/edit/<?php echo $client->id; ?>" method="POST" class="js-delete-form">
                <input type="hidden" name="action" value="delete_client">
                <button type="submit">Usuń klienta</button>
            </form>
        <?php else : ?>
            <p>Brak klientów do edycji.</p>
        <?php endif; ?>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>