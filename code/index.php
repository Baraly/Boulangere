<!doctype html>
<html lang="fr">
<head>
    <?php include_once("head/head.php"); ?>
    <title>Index</title>
</head>
<body>
<?php include_once("nav/nav.php"); ?>

<h2>Promotions !</h2>
<h5>Vivez un réveillon de Noël magique</h5>

<?php
include_once("bdd.php");

$requete = $bdd->query('SELECT * FROM Produits');

while ($donnees = $requete->fetch()){
    if($donnees['promotion'] != 0){
        ?>
        <a <?= "href='article.php?article=".$donnees['idProduit']."'" ?> class="contenu">
            <div class="article row">
                <div class="col-sm-3 centre">
                    <h5><?= $donnees['nom']; ?></h5>
                    <img <?php echo "src='../donnees/img/". $donnees['photo']."'"; ?> class="recherche"/>
                </div>
                <div class="col-sm-5 description">
                    <p><?= $donnees['descriptif']; ?></p>
                </div>
                <div class="col-sm-2 centre prix">
                    <p>
                        <span class="texteBarre"><?= $donnees['prix']; ?></span>€
                        <br>
                        <span style="font-weight:bold"><?= $donnees['prix']*(100 - $donnees['promotion'])/100; ?>€</span>
                    </p>
                    <p>
                        <a href="#"><i class='bx bxs-heart like'></i></a>
                    </p>
                </div>
                <div class="col-sm-2 centre promotion">
                    <p>
                        <span class="pourcentage">-<?= $donnees['promotion']; ?>%</span>
                    </p>
                </div>
            </div>
        </a>
        <hr>
        <?php
    }
}
$bdd = null;
?>

</body>
</html>