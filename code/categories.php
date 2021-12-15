<!doctype html>
<html lang="fr">
<head>
    <?php include_once("head/head.php"); ?>
    <title>Catégories</title>
</head>
<body>
<?php include_once("nav/nav.php"); ?>
<h2>Catégories</h2>

<div class="collectionDiv">
    <?php
    include_once("bdd.php");

    $nbCategories = $bdd->query("select COUNT(distinct categorie) as nbCategories from Produits")->fetch();
    $request = $bdd->query("select distinct categorie from Produits");

    for($i = 1; $i <= $nbCategories['nbCategories']; $i++){
        $donnees = $request->fetch();
        $request1 = $bdd->query("select photo from Produits where categorie='".$donnees['categorie']."' order by RAND()");
        $photo1 = $request1->fetch();
        $photo2 = $request1->fetch();
        $photo3 = $request1->fetch();
        $photo4 = $request1->fetch();
    ?>
    <a href="recherche.php?recherche=<?= $donnees['categorie'] ?>">
        <div class="type centre">
            <div class="collectionImg">
                <div class="col"><img src="../donnees/img/<?= $photo1['photo'] ?>"></div>
                <div class="col"><img src="../donnees/img/<?= $photo2['photo'] ?>"></div>
                <div class="col"><img src="../donnees/img/<?= $photo3['photo'] ?>"></div>
                <div class="col"><img src="../donnees/img/<?= $photo4['photo'] ?>"></div>
            </div>
            <h4 class="nomType"><?= ucwords($donnees['categorie']) ?></h4>
        </div>
    </a>
    <?php }
    $bdd = null;
    ?>
</div>
</body>
</html>