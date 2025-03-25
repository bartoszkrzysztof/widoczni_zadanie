<?php
// Widok do tworzenia nowego opiekuna

// Sprawdzenie, czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Walidacja danych formularza
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Można dodać więcej walidacji, np. sprawdzenie poprawności adresu e-mail

    // Jeśli dane są poprawne, można je zapisać w bazie danych
    // Tutaj powinno być wywołanie metody kontrolera do zapisania opiekuna
    // np. $caregiverController->create($name, $email);
}

?>

<h1>Dodaj nowego opiekuna</h1>

<form action="" method="post">
    <div>
        <label for="name">Imię i nazwisko:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="email">Adres e-mail:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <button type="submit">Zapisz</button>
    </div>
</form>

<a href="/caregivers/index">Powrót do listy opiekunów</a>