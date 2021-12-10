<!doctype html>
<html lang="fr">
<head>
	<?php include_once("head/head.php"); ?>
	<link rel="stylesheet" href="style/styleNav.css">
	<link rel="stylesheet" href="style/mainStyle.css">
	<link rel="stylesheet" href="style/styleGestionArticle.css">
	<script src="JavaScript/nav.js"></script>
</head>
<body>
	<?php include_once("nav/nav.php"); ?>

	<?php
		$domaines = ["informatique", "beaute"];
		$informatique = ["ordinateur", "portable", "imprimante"];
		$beaute = ["accessoire"];
	?>

	<h2>Gestion des Articles</h2>
	<div class="listeActionArticle">
		<ul>
			<li><a href="gestionArticle.php?AjoutArticle">Ajouter un article</a></li>
			<li><a href="#">Modifier un article</a></li>
			<li><a href="#">Supprimer un article</a></li>
			<li><a href="#">Rechercher un article</a></li>
			<li><a href="#">Modifier une promotion</a></li>
		</ul>
	</div>
	<?php
	if(isset($_GET['AjoutArticle'])){
		?>

		<div class="renduGestion border padding colorGrey">
			<h4>Ajouter un article</h4>
			<br>
			<form name="frm" action="gestionArticlePost.php?Ajout" method="POST">
				<label>Nom du produit : <input type="text" name="nom"/></label><br>
				<div class="select">
					<label>Domaine du produit : 
						<select name="domaine" onchange="affichageType();">
						<option value=""></option>
						<?php
						$compteur = 0;
						foreach($domaines as $i){
							?>
							<option value='<?= $compteur; ?>'><?= $i; ?></option>
							<?php
							// echo "<option value=".$compteur." onclick='affichageType('test');'>".$i."</option>";
							$compteur++;
						}
						?>
						</select>
					</label>
					<label id="select">Type du produit : 
						<select name="type">
							<option value="vraiment ?" id="resultat"></option>
						</select>
					</label>
				</div>
				<br>
				<label><span class="textarea">Description minimaliste : </span><textarea name="descriptionM" style="margin-left: 182px;"></textarea></label><br>
				<label><span class="textarea">Description détaillée : </span><textarea name="descriptionG" style="margin-left: 160px;"></textarea></label><br>
				<label>Prix du produit : <input type="number" name="prix" />€</label><br>
				<label>Image du produit : <input type="file" name="image" accept="image/png" class="file" multiple/><br>
				<input type="submit" class="submit" />
			</form>
		</div>

		<?php
	}
	else{

	?>
	<div class="renduGestion">
		<?php

		$bdd = new PDO('mysql:host=localhost;dbname=ProjetFac;charset=utf8','root','root');

		$reponse = $bdd->query('SELECT * FROM Produits');

		while ($donnees = $reponse->fetch()){
			?>
			<div class="row colorGrey">
					<div class="col-sm-3 center">
						<h5><?= $donnees['nom']; ?></h5>
						<img <?= "src=../donnees/img/".$donnees['photo']; ?> />
					</div>
					<div class="col-sm-4 description">
						<p><?= $donnees['descriptif']; ?></p>
					</div>
					<div class="col-sm-2 center prix">
						<p><?= $donnees['prix'] ?>€</p>
					</div>
					<div class="col-sm-3 button">
						<a href="#"><i class='bx bx-stats'></i></a>
						<a href="#"><i class='bx bx-wrench'></i></a>
						<a href="#"><i class='bx bx-trash'></i></a>
					</div>
				</div>
				<br>
			<?php
		}
	}

		?>
	</div>

</body>
</html>