<?php
    // Edytuj klienta

    $name = 'Edytuj klienta';
    include_once __DIR__ . '/../components/header.php';
    $client_name = $client->name ?? 'null';
?>
    <header class="container">
        <h1>Edytuj klienta: <?= $client_name; ?></h1>
        <a href="/client/create" class="button">Dodaj nowego klienta</a>
        <a href="/client/index" class="button-alt">Powrót do listy klientów</a>
    </header>
    <main class="container content">
        <?php if ($client) : ?>
            <?php
                include_once __DIR__ . '/../components/validate_form.php';
            ?>
            <form action="/client/edit/<?= $client->id; ?>" method="POST">
                <input type="hidden" name="action" value="update_client">
                <div class="form-group">
                    <label for="name">Nazwa:</label>
                    <input type="text" name="name" id="name" value="<?= $client->name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?= $client->email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefon:</label>
                    <input type="text" name="phone" id="phone" value="<?= $client->phone; ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Adres:</label>
                    <input type="text" name="address" id="address" value="<?= $client->address; ?>" required>
                </div>
                <div class="form-group">
                    <label for="postal_code">Kod pocztowy:</label>
                    <input type="text" name="postal_code" id="postal_code" value="<?= $client->postal_code; ?>" required>
                </div>
                <div class="form-group">
                    <label for="city">Miasto:</label>
                    <input type="text" name="city" id="city" value="<?= $client->city; ?>" required>
                </div>
                <div class="form-group">
                    <label for="country">Kraj:</label>
                    <input type="text" name="country" id="country" value="<?= $client->country; ?>" required>
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
                                <option value="<?= $consultant->id; ?>" <?= (in_array($consultant->id, $selected_consultant_ids)) ? 'selected' : ''; ?>>
                                    <?= $consultant->first_name . ' ' . $consultant->last_name; ?>
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
                                <option value="<?= $package->id; ?>" <?= ($package->id === $selected_package) ? 'selected' : ''; ?>>
                                    <?= $package->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="inputs-group">
                    <label>Osoby kontaktowe:</label>
                    <div id="js-contact-list">
                        <?php if (isset($contacts) && $contacts) : ?>
                            <?php foreach ($contacts as $key => $contact) : ?>
                                <div class="contact-item">
                                    <input type="text" name="contacts[<?= $key; ?>][name]" value="<?= $contact['name']; ?>" placeholder="Imię i nazwisko" required>
                                    <input type="email" name="contacts[<?= $key; ?>][email]" value="<?= $contact['email']; ?>" placeholder="Email" required>
                                    <input type="text" name="contacts[<?= $key; ?>][phone]" value="<?= $contact['phone']; ?>" placeholder="Telefon">
                                    <button type="button" class="button-alt" class="js-remove-contact">Usuń</button>
                                </div>
                            <?php endforeach;  ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="button-alt" id="js-add-contact">Dodaj osobę kontaktową</button>
                </div>

                <button type="submit" class="button">Zapisz zmiany</button>
            </form>
            <hr />
            <form action="/client/edit/<?= $client->id; ?>" method="POST" class="js-delete-form">
                <input type="hidden" name="action" value="delete_client">
                <button type="submit" class="button-alt">Usuń klienta</button>
            </form>
        <?php else : ?>
            <p>Brak klientów do edycji.</p>
        <?php endif; ?>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>