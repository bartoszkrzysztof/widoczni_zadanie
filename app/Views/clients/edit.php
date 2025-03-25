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
                <?php if ($consultants) : ?>
                    <?php
                        $selected_consultant_ids = (isset($client->consultant_ids)) ? $client->consultant_ids : [];
                    ?>
                    <div class="form-group">
                        <label for="consultant_id">Konsultant:</label>
                        <select multiple name="consultant_ids[]" id="consultant_id" required>
                            <option value="">Wybierz konsultanta</option>
                            <?php foreach ($consultants as $consultant) : ?>
                                <option value="<?php echo $consultant->id; ?>" <?php echo (in_array($consultant->id, $selected_consultant_ids)) ? 'selected' : ''; ?>>
                                    <?php echo $consultant->first_name . ' ' . $consultant->last_name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <?php if ($packages) : ?>
                    <?php
                        $selected_package = (isset($client->package_id)) ? $client->package_id : false;
                    ?>
                    <div class="form-group">
                        <label for="package_id">Pakiet:</label>
                        <select name="package_id" id="package_id" required>
                            <option value="">Wybierz pakiet</option>
                            <?php foreach ($packages as $package) : ?>
                                <option value="<?php echo $package->id; ?>" <?php echo ($package->id === $selected_package) ? 'selected' : ''; ?>>
                                    <?php echo $package->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label>Osoby kontaktowe:</label>
                    <div id="js-contact-list">
                        <?php if (isset($contacts) && $contacts) : ?>
                            <?php foreach ($contacts as $key => $contact) : ?>
                                <div class="contact-item">
                                    <input type="text" name="contacts[<?php echo $key; ?>][name]" value="<?php echo $contact['name']; ?>" placeholder="Imię i nazwisko" required>
                                    <input type="email" name="contacts[<?php echo $key; ?>][email]" value="<?php echo $contact['email']; ?>" placeholder="Email" required>
                                    <input type="text" name="contacts[<?php echo $key; ?>][phone]" value="<?php echo $contact['phone']; ?>" placeholder="Telefon">
                                    <button type="button" class="js-remove-contact">Usuń</button>
                                </div>
                            <?php endforeach;  ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" id="js-add-contact">Dodaj osobę kontaktową</button>
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