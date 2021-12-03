<!doctype html>
<html lang="fr">
<head>
    <?php include_once("head/head.php"); ?>
    <link rel="stylesheet" href="style/styleNav.css">
    <link rel="stylesheet" href="style/mainStyle.css">
    <title>Article</title>
    <script src="nav/nav.js"></script>
</head>
<body>
    <?php include_once("nav/nav.php"); ?>

    <?php

        if(!empty($_GET['article'])){
            include_once("bdd.php");

            $requeteSQL = "SELECT * FROM Produits WHERE idProduit = ".$_GET['article'];

            $requete = $bdd->query($requeteSQL);

            $donnees = $requete->fetch();
                    ?>

                    <a <?= "href='../donnees/img/".$donnees['photo']."'"; ?>>
                        <img <?= "src='../donnees/img/".$donnees['photo']."'"; ?> class="article"/>
                    </a>
                    <div class="row contenu">
                        <div class="col-sm-9">
                            <div class="infos">
                                <h3><?= $donnees['nom']; ?></h3>
                                <div>
                                    <p><?= $donnees['description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="bandeauPrix">
                                <div class="row">
                                    <div class="col-sm-5"><h4>Prix</h4></div>
                                    <div class="col-sm-7"><p class="bold" style="font-size: 20px"><?= $donnees['prix']; ?>€</p></div>
                                </div>

                                <?php if($donnees['promotion'] != 0){
                                    ?>
                                    <p class="bold">Profitez de -<?= $donnees['promotion'] ?>%</p>
                                    <?php
                                }
                                if($donnees['stock'] > 10){
                                    echo "<p style='color: green'>Il reste ".$donnees['stock']." produits en stock</p>";
                                }
                                else if($donnees['stock'] > 5){
                                    echo "<p style='color: darkorange'>Il reste ".$donnees['stock']." produits en stock</p>";
                                }
                                else if($donnees['stock'] > 1){
                                    echo "<p style='color: red'>Il reste ".$donnees['stock']." produits en stock !</p>";
                                }
                                else if($donnees['stock'] == 1){
                                    echo "<p style='color: red'>Il reste ".$donnees['stock']." produit en stock !</p>";
                                }
                                else{
                                    echo "<p style='color: red'>Rupture de stock !</p>";
                                }
                                ?>
                                <p>Livraison : 3-4 jours</p>
                                <form action="" method="">
                                    <select name="nbProduit">
                                        <?php for($i = 1; $i <= 10; $i++){
                                            echo "<option>".$i."</option>";
                                        }?>
                                        <option onclick="formAutre()";>Autre</option>
                                    </select><br>
                                    <div class="submit">
                                        <input type="submit" class="submit" value="Ajouter au panier"/>
                                    </div>
                                </form>
                                <div class="espace">
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
        }
        else{
            ?>
            <h4>Il n'y a rien à voir ici, veuilliez retourner sur <a href="index.php">la page principale</a></h4>
            <?php
        }
    $bdd = null;
    ?>

<script>
    function formAutre(){
        console.log("Vous avez sélectionné la catégorie 'Autre'");
    }
</script>

</body>
</html>