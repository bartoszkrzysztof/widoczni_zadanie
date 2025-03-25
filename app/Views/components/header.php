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
<div class="container">
    <nav>
        <a href="/client">Klienci</a>
        <a href="/consultant">Konsultanci</a>
        <a href="/package">Pakiety</a>
    </nav>
</div>