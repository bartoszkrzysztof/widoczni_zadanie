<?php
// Widok do edycji danych klienta

// Zakładamy, że zmienna $client zawiera dane klienta do edycji
// oraz zmienna $caregivers zawiera listę opiekunów

?>

<h1>Edytuj klienta: <?php echo htmlspecialchars($client->name); ?></h1>

<form action="/clients/update/<?php echo $client->id; ?>" method="POST">
    <label for="name">Imię i nazwisko:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($client->name); ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($client->email); ?>" required>

    <label for="caregiver">Opiekun:</label>
    <select id="caregiver" name="caregiver_id">
        <?php foreach ($caregivers as $caregiver): ?>
            <option value="<?php echo $caregiver->id; ?>" <?php echo ($caregiver->id == $client->caregiver_id) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($caregiver->name); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Zapisz zmiany</button>
</form>

<a href="/clients">Powrót do listy klientów</a>