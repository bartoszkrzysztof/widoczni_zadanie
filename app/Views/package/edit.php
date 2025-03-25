<?php
    //Edycja pakietu

    $name = 'Edycja pakietu';
    include_once __DIR__ . '/../components/header.php';
?>
    <header class="container">
        <h1>Edycja pakietu</h1>
        <a href="/package">Wróć do listy pakietów</a>
        <a href="/package/create">Dodaj nowy pakiet</a>
    </header>
    <main class="container">
        <?php
            include_once __DIR__ . '/../components/validate_form.php';
        ?>
        <?php if ($package) : ?>
            <form action="/package/edit/<?= $package->id; ?>" method="POST">
                <input type="hidden" name="action" value="update_package">
                <input type="hidden" name="id" value="<?= $package->id; ?>">
                <div class="form-group">
                    <label for="name">Nazwa:</label>
                    <input type="text" name="name" id="name" value="<?= $package->name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Opis:</label>
                    <textarea name="description" id="description" required><?= $package->description; ?></textarea>
                </div>
                <button type="submit">Zapisz zmiany</button>
            </form>
            <form action="/package/edit/<?= $package->id; ?>" method="POST">
                <input type="hidden" name="action" value="delete_package">
                <input type="hidden" name="id" value="<?= $package->id; ?>">
                <button type="submit">Usuń pakiet</button>
            </form>
        <?php else : ?>
            <p>Brak pakietu do edycji.</p>     
        <?php endif; ?>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>