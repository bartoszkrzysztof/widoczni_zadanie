<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj nowego klienta</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Dodaj nowego klienta</h1>
        <form action="/clients/store" method="POST">
            <div class="form-group">
                <label for="name">Imię i nazwisko:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <button type="submit">Zapisz klienta</button>
            </div>
        </form>
        <a href="/clients">Powrót do listy klientów</a>
    </div>
</body>
</html>