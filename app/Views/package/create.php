<?php
    //Dodaj pakiet

    $name = 'Edycja pakietu';
    include_once __DIR__ . '/../components/header.php';
?>
    <header class="container">
        <h1>Dodaj pakiet</h1>
        <a href="/package" class="button-alt">Wróć do listy pakietów</a>
    </header>
    <main class="container content">
        <?php
            include_once __DIR__ . '/../components/validate_form.php';
        ?>
        <form action="/package/create/" method="POST">
            <input type="hidden" name="action" value="create_package">
            <div class="form-group">
                <label for="name">Nazwa:</label>
                <input type="text" name="name" id="name" value="" required>
            </div>
            <div class="form-group">
                <label for="description">Opis:</label>
                <textarea name="description" id="description" required></textarea>
            </div>
            <button type="submit" class="button">Zapisz zmiany</button>
        </form>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>