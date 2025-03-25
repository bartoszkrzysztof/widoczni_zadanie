<?php
    // Edytuj konsultanta

    $name = 'Edytuj konsultanta';
    include_once __DIR__ . '/../components/header.php';
    $consultant_name = $consultant->full_name ?? 'null';
?>
    <header class="container">
        <h1>Edytuj konsultanta: <?= $consultant_name; ?></h1>
        <a href="/consultant/create" class="button">Dodaj nowego konsultanta</a>
        <a href="/consultant/index" class="button-alt">Powrót do listy konsultantów</a>
    </header>
    <main class="container content">
        <?php if ($consultant) : ?>
            <?php
                include_once __DIR__ . '/../components/validate_form.php';
            ?>
            <form action="/consultant/edit/<?= $consultant->id; ?>" method="POST">
                <input type="hidden" name="action" value="update_consultant">
                <div class="form-group">
                    <label for="first_name">Imię:</label>
                    <input type="text" name="first_name" id="first_name" value="<?= $consultant->first_name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Nazwisko:</label>
                    <input type="text" name="last_name" id="last_name" value="<?= $consultant->last_name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?= $consultant->email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefon:</label>
                    <input type="text" name="phone" id="phone" value="<?= $consultant->phone; ?>" required>
                </div>
                <button type="submit" class="button">Zapisz zmiany</button>
            </form>
            <hr />
            <form action="/consultant/edit/<?= $consultant->id; ?>" method="POST" class="js-delete-form">
                <input type="hidden" name="action" value="delete_consultant">
                <button type="submit" class="button-alt">Usuń konsultanta</button>
            </form>
        <?php else : ?>
            <p>Brak konsultanta do edycji.</p>
        <?php endif; ?>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>