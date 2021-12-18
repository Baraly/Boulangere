<nav>
	<div class="cacherText"></div>
		<div class="row nav">
			<div class="col-sm-3">
				<a href="index.php"><div  class="logo"><img src="../donnees/img/logo.jpg" alt="boulangère" style="height: 90%"></div></a>
			</div>
			<div class="col-sm-2 barre">
				<p><a href="categories.php" class="animation">Catégories<i class='bx bxs-category'></i></a></p>
			</div>
			<div class="col-sm-2 barre">
				<p><a href="#" class="animation">Favori<i class='bx bxs-heart'></i></a></p>
			</div>
			<div class="col-sm-2 barre">
				<p><a href="panier.php" class="animation">Mon panier<i class='bx bxs-basket'></i></a></p>
			</div>
			<div class="col-sm-2 barre">
				<p><a href="compte.php" class="animation">Mon compte<i class='bx bxs-user'></i></a></p>
			</div>
			<div class="col-sm-1 barre">
				<p><a href="#" onclick="searching()" class="animation"><i class='bx bx-search-alt searching'></i></a></p>
			</div>
		</div>
</nav>
<div class="espace"></div>
<div id="searchingBox">
	<form action="recherche.php" method="get">
		<label>Recherche : <input class="recherche" type="text" name="recherche" id="recherche"/></label>
		<input type="submit" value="" class="envoyer"/>
	</form>
</div>