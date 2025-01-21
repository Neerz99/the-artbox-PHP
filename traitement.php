<?php

if(empty($_POST['titre'])
    || empty($_POST['description'])
    || empty($_POST['artiste'])
    || empty($_POST['image'])
    || strlen($_POST['description']) < 3
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
    // redirige vers la page 'ajouter.php'
    header('Location: ajouter.php');
} else {
    // protection contre les failles XSS
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $image = htmlspecialchars($_POST['image']);

    // insere l'oeuvre dans la bdd
    include("bdd.php");
    $bdd = connexion();

    $requete = $bdd->prepare('INSERT INTO oeuvres (titre, description, artiste, image) VALUES (?, ?, ?, ?)');
    $requete->execute([$titre, $description, $artiste, $image]);

    // redirige vers la derniere oeuvre crée
    header('Location: oeuvre.php?id='. $bdd->lastInsertId());
}