<?php

class article{
	public $id;
	public $type;
	public $nom;
	public $image;
	public $descriptionM;
	public $descriptionG;
	public $prix;

	public function __construct($type, $nom, $image, $descriptionM, $descriptionG, $prix){
		$json = file_get_contents('fichier.json');

		$objet = json_decode($json);

		$compteur = 0;

		if($type == "informatique")


		$this->id = 
		$this->type = $type;
		$this->nom = $nom;
		$this->image = $image;
		$this->descriptionM = $descriptionM;
		$this->descriptionG = $descriptionG;
		$this->prix = $prix;
	}
}


	if($_GET['Ajout'] and empty($_POST['nom']) or empty($_POST['domaine']) or empty($_POST['descriptionM']) or empty($_POST['descriptionG']) or empty($_POST['prix']) or empty($_POST['image'])){
		header("location: gestionArticle.php?AjoutArticle");
	}
	else{

	}


?>