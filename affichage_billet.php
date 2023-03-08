<div class="news">
            <h3>
                <?php echo htmlspecialchars($donnees['titre']); ?>
                <em>le <?php echo $donnees['date_creation_fr']; ?></em>
            </h3>
            
            <p>
            <?php
             echo nl2br(htmlspecialchars($donnees['contenue']));
            ?>
            <br />
        </p>
</div>