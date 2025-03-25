<?php
// Widok do edycji danych opiekuna

// Zakładamy, że zmienna $caregiver zawiera dane opiekuna do edycji
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja Opiekuna</title>
</head>
<body>
    <h1>Edycja Opiekuna</h1>
    <form action="/caregivers/update/<?php echo $caregiver->id; ?>" method="POST">
        <label for="name">Imię i Nazwisko:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($caregiver->name); ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($caregiver->email); ?>" required>
        
        <button type="submit">Zapisz zmiany</button>
    </form>
    <a href="/caregivers">Powrót do listy opiekunów</a>
</body>
</html>