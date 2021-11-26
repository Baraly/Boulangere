DROP TABLE IF EXISTS LignesCommandes;
DROP TABLE IF EXISTS Commandes;
DROP TABLE IF EXISTS Produits;
DROP TABLE IF EXISTS Clients;


CREATE TABLE Clients(
	nom VARCHAR(20) NOT NULL,
	prenom VARCHAR(20) NOT NULL,
	email VARCHAR(50) PRIMARY KEY,
	motDePasse TEXT NOT NULL,
	vkey INT NOT NULL,
	compteVerifie BOOLEAN NOT NULL DEFAULT 0,
	ville VARCHAR(20),
	adresse TEXT,
	telephone INT,
	creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Produits(
	idProduit INT PRIMARY KEY AUTO_INCREMENT,
	nom VARCHAR(20) NOT NULL,
	marque VARCHAR(20) NOT NULL,
	categorie VARCHAr(20) NOT NULL,
	descriptif TEXT NOT NULL,
	description TEXT NOt NULL,
	photo VARCHAR(20) NOT NULL,
	prix INT NOT NULL,
	stock INT NOT NULL,
	promotion INT NOT NULL
);

CREATE TABLE Commandes(
	idCommande INT PRIMARY KEY AUTO_INCREMENT,
	date_ DATETIME DEFAULT CURRENT_TIMESTAMP,
	email VARCHAR(50) NOT NULL,
	etat VARCHAR(10) NOT NULL,
	FOREIGN KEY (email) REFERENCES Clients(email)
);

CREATE TABLE LignesCommandes(
	idLigneCommande INT PRIMARY KEY AUTO_INCREMENT,
	idCommande INT NOT NULL,
	idProduit INT NOT NULL,
	quantite INT NOT NULL,
	montant DECIMAL NOT NULL,
	FOREIGN KEY (idCommande) REFERENCES Commandes(idCommande),
	FOREIGN KEY (idProduit) REFERENCES Produits(idProduit)
);


INSERT INTO Produits VALUES(0,"MacBook Pro 14", "Apple", "ordinateur", "Tout neuf, tout propre et surpuissant !", "Ceci est une description très détaillé du produit", "ordinateur0.png", 2249, 12, 15);
INSERT INTO Produits VALUES(0,"iPhone 13Pro", "Apple", "telephone", "Une petite description de votre futur téléphone", "Ceci est une description très détaillé du produit", "telephone0.png", 1099, 26, 0);
INSERT INTO Produits VALUES(0,"iPad Pro 11", "Apple", "tablette", "Le tout nouveau iPad Pro avec la puissante puce M1", "Ceci est une description très détaillé du produit", "tablette0.png", 859, 36, 8);
INSERT INTO Produits VALUES(0,"Canon MG350", "Canon", "imprimante", "Une petite description de votre futur imprimante", "Ceci est une description très détaillé du produit", "imprimante0.png", 259, 3, 0);
INSERT INTO Produits VALUES(0,"iRobot i7 Roomba", "iRobot", "aspirateur", "You're lazy like me ? Buy it !", "Ceci est une description très détaillé du produit", "aspirateur0.png", 700, 10, 2);
INSERT INTO Produits VALUES(0,"Mx key", "Logitech", "clavier", "Sans doute l'un des meilleurs claviers sans fils", "Ceci est une description très détaillé du produit", "clavier0.png", 99, 34, 0);
INSERT INTO Produits VALUES(0,"Mx Master 3", "Logitech", "souris", "Sans doute l'une des melleure souris sans fils", "Ceci est une description très détaillé du produit", "souris0.png", 95, 31, 0);
INSERT INTO Produits VALUES(0,"AirPods Pro", "Apple", "ecouteurs", "Les nouveaux AirPods Pro, une douceur pour vos oreilles", "Ceci est une description très détaillé du produit", "ecouteurs0.png", 199, 15, 4);
INSERT INTO Produits VALUES(0,"Hue Go", "Philips", "lampe", "Sans fils, portative et magnifie, c'est la nouvelle Hue Go de Philips", "Ceci est une description très détaillé du produit", "lampe0.png", 75, 45, 0);
INSERT INTO Produits VALUES(0,"Apple watch serie 7", "Apple", "montre", "La nouvelle Apple Watch, encore plus grande et toujours plus rapide", "Ceci est une description très détaillé du produit", "montre0.png", 480, 24, 0);







