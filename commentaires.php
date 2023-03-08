<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
	<link href="forum.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>
 
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

    // Récupération du billet
    $req = $bdd->prepare('SELECT id, titre, contenue, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
    $req->execute(array($_GET['billet']));
    $donnees = $req->fetch();

        include("affichage_billet.php");
?>
    <h2>Commentaires</h2>

<?php
    $req->closeCursor(); // Important : on libère le curseur pour la prochaine requête
?>


<?php
    // Récupération des commentaires
    $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billets = ? ORDER BY date_commentaire');
    $req->execute(array($_GET['billet']));

    while ($donnees = $req->fetch())
    {
?>
    <p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
    <p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
<?php
    } // Fin de la boucle des commentaires
    $req->closeCursor();
?>

<form action="commentaire_post.php" method="post">
        <p>
        <label for="auteur">Pseudo</label> : <input type="text" name="auteur" id="auteur" /><br /><br/>
        <label for="commentaire">commentaire</label> :  <input type="text" name="commentaire" id="commentaire" size="45" style=" height:60px""/><br />
        <input type="hidden" name="billet" value= "<?php echo $_GET['billet'] ?>"/>

        <input type="submit" value="Envoyer" />
	</p>
    </form>
</body>
</html>