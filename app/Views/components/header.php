<?php
    $name = (isset($name)) ? $name : '';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name ?></title>
    <link rel="stylesheet" href="/assets/styles.css">
    <script src="/assets/scripts.js"></script>
</head>
<body>
<nav class="container">
    <a href="/package">Pakiety</a>
    <a href="/package/create">Dodaj pakiet</a>
    <a href="/client">Klienci</a>
    <a href="/client/create">Dodaj klienta</a>
    <a href="/consultant">Konsultanci</a>
    <a href="/consultant/create">Dodaj konsultanta</a>
</nav>