<?php
function connexionBDD() {
    require "../config.php";
    $pdo=new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    return $pdo;
};