<?php
    // Edytuj konsultanta

    $name = 'Edytuj konsultanta';
    include_once __DIR__ . '/../components/header.php';
    $consultant_name = $consultant->full_name ?? 'null';
?>
    <header class="container">
        <h1>Edytuj konsultanta: <?php echo $consultant_name; ?></h1>
        <a href="/consultant/create">Dodaj nowego konsultanta</a>
        <a href="/consultant/index">Powrót do listy konsultantów</a>
    </header>
    <main class="container">
        <?php if ($consultant) : ?>
            <?php
                include_once __DIR__ . '/../components/validate_form.php';
            ?>
            <form action="/consultant/edit/<?php echo $consultant->id; ?>" method="POST">
                <input type="hidden" name="action" value="update_consultant">
                <div class="form-group">
                    <label for="first_name">Imię:</label>
                    <input type="text" name="first_name" id="first_name" value="<?php echo $consultant->first_name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Nazwisko:</label>
                    <input type="text" name="last_name" id="last_name" value="<?php echo $consultant->last_name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $consultant->email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefon:</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $consultant->phone; ?>" required>
                </div>
                <button type="submit">Zapisz zmiany</button>
            </form>
            <form action="/consultant/edit/<?php echo $consultant->id; ?>" method="POST">
                <input type="hidden" name="action" value="delete_consultant">
                <button type="submit">Usuń konsultanta</button>
            </form>
        <?php else : ?>
            <p>Brak konsultanta do edycji.</p>
        <?php endif; ?>
    </main>
<?php
    include_once __DIR__ . '/../components/footer.php';
?>