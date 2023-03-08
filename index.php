<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mon blog</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<!--<link href="forum.css" rel="stylesheet" /> -->
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
        <p>Derniers billets du blog :</p>
 
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

        // On récupère les 5 derniers billets
        $req = $bdd->query('SELECT id, titre, contenue, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

        while ($donnees = $req->fetch())
        {
            include("affichage_billet.php");
        ?>
            <div class="news">
            <p> 
            <em><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em>
            </p>
            </div>
        <?php
        } // Fin de la boucle des billets
        $req->closeCursor();
        ?>

       <!-- <form action="contenue_post.php" method="post">
                <p>
                <label for="titre">Titre de l'article</label> : <input type="text" name="titre" id="titre" /><br /><br/>
                <label for="contenue">Contenue</label> :  <input type="text" name="contenue" id="contenue" size="45" style=" height:60px""/><br />

                <input type="submit" value="Envoyer" />
            </p>
        </form>       -->

    </body>
</html> 