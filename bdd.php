<?php

function connexion() {
    return new PDO('mysql:host=localhost;dbname=artbox;charset=utf8', 'root', '');
}