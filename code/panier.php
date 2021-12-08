<?php session_start();
include_once("bdd.php");

if(isset($_GET['suppProd'])){
    $bdd->exec("delete from LignesCommandes where idCommande=".$_GET['idCommande']." and idProduit=".$_GET['suppProd']);
    if(!($bdd->query("select * from LignesCommandes where idCommande=".$_GET['idCommande'])->fetch())){
        $bdd->exec("delete from Commandes where idCommande=".$_GET['idCommande']);
    }
}

?>
<!doctype html>
<html lang="fr">
<head>
    <?php include_once("head/head.php"); ?>
    <link rel="stylesheet" href="style/styleNav.css">
    <link rel="stylesheet" href="style/mainStyle.css">
    <script src="nav/nav.js"></script>
</head>
<body>
<?php include_once("nav/nav.php"); ?>

<h2>Panier</h2>
<?php
    if(!isset($_SESSION['email'])){
        echo "<center style='margin-top: 50px'><h4>Veuillez vous connecter afin d'ajouter du contenu dans votre panier<br><a href='compte.php'>Me connecter</a></h4></center>";
    }
    else{
        ?>
        <a href="commande.php" class="button right" style="font-size: 18px">Commandes en cours</a>
        <h3 class="underline" style="margin-top: 30px">Votre panier actuel</h3>
        <?php

        if($id = $bdd->query("select idCommande, email, etat from Commandes where email='".$_SESSION['email']."' and etat='Panier'")->fetch()){
            $total = $bdd->query("select SUM(montant) as total from LignesCommandes, Produits where LignesCommandes.idProduit = Produits.idProduit and idCommande=".$id['idCommande'])->fetch();
            echo "<h3 style='margin-top: 30px'>Montant total du panier : ".$total['total']."€</h3>";
            $request = $bdd->query("select * from LignesCommandes, Produits where LignesCommandes.idProduit = Produits.idProduit and idCommande=".$id['idCommande']);
            while($donnees = $request->fetch()){
                ?>
                <a <?= "href='article.php?article=".$donnees['idProduit']."'" ?> class="contenu">
                    <div class="article row">
                        <div class="col-sm-3 centre">
                            <h5><?= $donnees['nom']; ?></h5>
                            <img <?= "src=../donnees/img/".$donnees['photo']; ?> class="recherche"/>
                        </div>
                        <div class="col-sm-3 prix centre">
                            <?php if($donnees['promotion'] != 0){
                                ?>
                                <p>Prix à l'unité : <span class="texteBarre"><?= $donnees['prix']; ?></span>€<br>
                                Promotion : <span style="font-weight:bold"><?= $donnees['prix']*(100 - $donnees['promotion'])/100; ?>€</span></p>
                                <?php
                            }else{
                                ?>
                                <p>Prix à l'unité : <?= $donnees['prix'] ?>€</p>
                                <?php
                            } ?>
                        </div>
                        <div class="col-sm-3 centre prix">
                            <p>Quantité : <?= $donnees['quantite'] ?>
                                <?php
                                $stock = $bdd->query("select stock from Produits where idProduit=".$donnees['idProduit'])->fetch();
                                    if($stock['stock'] <  $donnees['quantite']){
                                        echo "<br><span style='color: red'>Problème de stock !</span>";
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="col-sm-3 centre prix">
                            <p>
                                <?php $url = "panier.php?suppProd=".$donnees['idProduit']."&idCommande=".$id['idCommande']; ?>
                                <a href=<?= $url ?>>Supprimer du panier</a>
                            </p>
                        </div>
                    </div>
                </a>
                <hr>
                <?php
            }
        }
        else{
            echo "<center style='margin-top: 50px'><h4>Vous n'avez actuellement rien dans votre panier</h4></center>";
        }
    }
?>
</body>
</html>