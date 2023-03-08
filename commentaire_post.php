<?php
// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=Tests;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO commentaires (id_billets, auteur, commentaire, date_commentaire) VALUES(?, ?, ?, NOW())');
$req->execute(array($_POST['billet'], $_POST['auteur'], $_POST['commentaire']));

// Redirection du visiteur vers la page du minichat
header('Location: commentaires.php?billet='.$_POST['billet']);
?>