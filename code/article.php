<?php
session_start();
include_once("bdd.php");

if(isset($_POST['nbProduit'])) {
    $nbProduit = 0;
    if(!empty($_POST['grosNombre']))
        $nbProduit = $_POST['grosNombre'];
    else
        $nbProduit = $_POST['nbProduit'];

    $donnees = $bdd->query("select stock from Produits where idProduit=" . $_GET['article'])->fetch();

    // Cas où le client demande plus de produits que ce qu'il y a en stock
    if ($donnees['stock'] < $nbProduit) {
        header("location: article.php?article=".$_GET['article']."&error=stock");
    }
    else if(isset($_SESSION['email'])){
        // Cas où le client ne possède pas de Panier
        if (!($bdd->query("select * from Commandes where email='" . $_SESSION['email'] . "' and etat='Panier'")->fetch())) {
            $insert = $bdd->prepare("insert into Commandes values (0, now(), :email, 'Panier')");
            $insert->execute(array(
                'email' => $_SESSION['email']
            ));
        }

        $id = $bdd->query("select idCommande from Commandes where email='" . $_SESSION['email'] . "' and etat='Panier'")->fetch();
        $prix = $bdd->query("select prix, promotion from Produits where idProduit=" . $_GET['article'])->fetch();
        $total = ($prix['prix'] * (100 - $prix['promotion']) / 100) * $nbProduit;

        if (!($bdd->query("select * from LignesCommandes where idCommande=" . $id['idCommande'] . " and idProduit=" . $_GET['article'])->fetch())) {
            $insert = $bdd->prepare("insert into LignesCommandes values (0, :idCommande, :idArticle, :nbProduit, :total)");
            $insert->execute(array(
                'idCommande' => $id['idCommande'],
                'idArticle' => $_GET['article'],
                'nbProduit' => $nbProduit,
                'total' => $total
            ));
        }
        else {
            $donneesPanier = $bdd->query("select montant, quantite from LignesCommandes where idCommande=" . $id['idCommande'] . " and idProduit=" . $_GET['article'])->fetch();
            $montantTotal = $total + $donneesPanier['montant'];
            $nbArticle = $nbProduit + $donneesPanier['quantite'];
            $bdd->exec("update LignesCommandes set montant=" . $montantTotal . " where idCommande=" . $id['idCommande'] . " and idProduit=" . $_GET['article']);
            $bdd->exec("update LignesCommandes set quantite=" . $nbArticle . " where idCommande=" . $id['idCommande'] . " and idProduit=" . $_GET['article']);
        }
        header("location: article.php?article=". $_GET['article']."&addPanier=success");
    }
    else{
        header("location: article.php?article=".$_GET['article']."&addPanier=failed");
    }
}

?>

<!doctype html>
<html lang="fr">
<head>
    <?php include_once("head/head.php"); ?>
    <title>Article</title>
</head>
<body>
    <?php include_once("nav/nav.php"); ?>

    <?php

        if(!empty($_GET['article'])){

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
                                    <p class="bold" style="font-size: 20px"><?= $donnees['prix']; ?>€</p>
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
                                <?php $url = "article.php?article=".$_GET['article']; ?>
                                <form action=<?= $url ?> method="POST">
                                    <select name="nbProduit"  id="autre">
                                        <?php for($i = 1; $i <= 10; $i++){
                                            echo "<option>".$i."</option>";
                                        }?>
                                        <option>Autre</option>
                                    </select>
                                    <input id="input" type="number" name="grosNombre" placeholder="Quantité" style="display: none; width: 70%; margin: 10px 10px"><br>
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
            if(isset($_GET['error']) && $_GET['error'] = 'stock'){
                echo "<center class='bottom' style='width: 95%'><h3 class='error colle'>Nous n'avons pas assez de stock pour cet article</h3></center>";
            }
            if(isset($_GET['addPanier']) && $_GET['addPanier'] == "success"){
                echo "<center class='bottom' style='width: 95%'><h3 class='colle good'>Cet article a été ajouté dans votre Panier !</h3></center>";
            }
            if(isset($_GET['addPanier']) && $_GET['addPanier'] == "failed"){
                echo "<center class='bottom' style='width: 95%'><h3 class='error colle'>Veuillez avoir un compte afin de pouvoir ajouter des articles dans votre Panier</h3></center>";
            }
        }
        else{
            ?>
            <h4>Il n'y a rien à voir ici, veuillez retourner sur <a href="index.php">la page principale</a></h4>
            <?php
        }
    $bdd = null;
    ?>

<script>
    document.getElementById('autre').addEventListener("change", function(event){ // on regarde les changements sur le sélecteur
        if(document.getElementById('autre').value == "Autre"){
            document.getElementById("input").style.display = "inline";
        }
        else
            document.getElementById("input").style.display = "none";
    });
</script>

</body>
</html>