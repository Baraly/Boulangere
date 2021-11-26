<!doctype html>
<html lang="fr">
<head>
	<?php include_once("head/head.php"); ?>
	<link rel="stylesheet" href="style/styleNav.css">
	<link rel="stylesheet" href="style/mainStyle.css">
    <title>Recherche</title>
	<script src="nav/nav.js"></script>
</head>
<body>
	<?php

	include_once("nav/nav.php");

		if(!empty($_POST['recherche'])){
			?>

<h3>Résultats pour : <i><?php echo $_POST['recherche']; ?></i></h3>

			<?php

            include_once("bdd.php");

			$requete = $bdd->query('SELECT * FROM Produits');

			$aucunResultat = true;

			while ($donnees = $requete->fetch()){
				if(preg_match("%".$_POST['recherche']."%i", $donnees['nom']) or 
					preg_match("%".$_POST['recherche']."%i", $donnees['marque']) or 
					preg_match("%".$_POST['recherche']."%i", $donnees['categorie']) or
					preg_match("%".$_POST['recherche']."%i", $donnees['descriptif'])){
					$aucunResultat = false;
					?>
                    <a <?= "href='article.php?article=".$donnees['idProduit']."'" ?> class="contenu">
                        <div class="article row">
                            <div class="col-sm-3 centre">
                                <h5><?= $donnees['nom']; ?></h5>
                                <img <?= "src=../donnees/img/".$donnees['photo']; ?> class="recherche"/>
                            </div>
                            <div class="col-sm-6 description">
                                <p><?= $donnees['descriptif']; ?></p>
                            </div>
                            <div class="col-sm-3 centre prix">
                                <p>
                                    <?= $donnees['prix']; ?>€
                                    <a href="#" class="like"><i class='bx bxs-heart like'></i></a>
                                </p>
                            </div>
                        </div>
                    </a>

				<hr>

					<?php
				}
			}

			if($aucunResultat){
				?>

				<h4>Nous ne trouvons aucuns résultats :/</h4>

				<?php
			}
		}
		else
			header("location: index.php");
	?>
</body>
</html>