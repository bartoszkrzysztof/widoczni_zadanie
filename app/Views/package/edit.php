<?php
    //Edycja pakietu

    $name = 'Edycja pakietu';
    include_once __DIR__ . '/../components/header.php';
?>
    <header class="container">
        <h1>Edycja pakietu</h1>
        <a href="/package" class="button">Wróć do listy pakietów</a>
        <a href="/package/create" class="button-alt">Dodaj nowy pakiet</a>
    </header>
    <main class="container content">
        <?php if ($package) : ?>
            <?php
                include_once __DIR__ . '/../components/validate_form.php';
            ?>
            <form action="/package/edit/<?= $package->id; ?>" method="POST">
                <input type="hidden" name="action" value="update_package">
                <div class="form-group">
                    <label for="name">Nazwa:</label>
                    <input type="text" name="name" id="name" value="<?= $package->name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Opis:</label>
                    <textarea name="description" id="description" required><?= $package->description; ?></textarea>
                </div>
                <button type="submit" class="button">Zapisz zmiany</button>
            </form>
            <hr />
            <form action="/package/edit/<?= $package->id; ?>" method="POST" class="js-delete-form">
                <input type="hidden" name="action" value="delete_package">
                <button type="submit" class="button-alt">Usuń pakiet</button>
            </form>
        <?php else : ?>
            <p>Brak pakietu do edycji.</p>     
        <?php endif; ?>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>