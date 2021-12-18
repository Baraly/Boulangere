DROP TABLE IF EXISTS LignesCommandes;
DROP TABLE IF EXISTS Commandes;
DROP TABLE IF EXISTS Produits;
DROP TABLE IF EXISTS Clients;


CREATE TABLE Clients(
	nom VARCHAR(20) NOT NULL,
	prenom VARCHAR(20) NOT NULL,
	email VARCHAR(50) PRIMARY KEY,
	motDePasse TEXT NOT NULL,
	vkey TEXT NOT NULL,
	compteVerifie BOOLEAN DEFAULT 0,
	ville VARCHAR(20),
	adresse TEXT,
	telephone INT,
	creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Produits(
	idProduit INT PRIMARY KEY AUTO_INCREMENT,
	nom VARCHAR(40) NOT NULL,
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


INSERT INTO Produits VALUES(0,'MacBook Pro 14"', "Apple", "ordinateur", "Le plus puissant des MacBook Pro est arrivé. Avec la puce M1 Pro, la première conçue par Apple pour les pros, vous bénéficiez de performances exceptionnelles et d’une incroyable autonomie. Ajoutez à cela un sublime écran Liquid Retina XDR.", "Puce Apple M1 Pro<br>CPU 8 coeurs avec 6 coeurs hautes performances et 2 coeurs à haute efficacité énergétique<br>GPU 14 coeurs<br>Neural Engine 16 coeurs<br>16 Go de mémoire unifiée<br>SSD de 512 Go<br>200 Go/s de bande passante mémoire", "ordinateur0.png", 2249, 12, 15);
INSERT INTO Produits VALUES(0,'MacBook Pro 16"', "Apple", "ordinateur", "Le plus puissant des MacBook Pro est arrivé. Avec la puce M1 Pro, la première conçue par Apple pour les pros, vous bénéficiez de performances exceptionnelles et d’une incroyable autonomie. Ajoutez à cela un sublime écran Liquid Retina XDR.", "Puce Apple M1 Pro<br>CPU 10 coeurs avec 8 coeurs hautes performances et 2 coeurs à haute efficacité énergétique<br>GPU 16 coeurs<br>Neural Engine 16 coeurs<br>16 Go de mémoire unifiée<br>SSD de 1 To<br>200 Go/s de bande passante mémoire", "ordinateur3.png", 2979, 17, 0);
INSERT INTO Produits VALUES(0,'MacBook Pro 13"', "Apple", "ordinateur", 'Avec la puce Apple M1, le MacBook Pro 13" atteint une vitesse et une puissance sidérantes. Il offre des performances de processeur jusqu’à 2,8 fois plus élevées. Des performances graphiques jusqu’à 5 fois plus rapides. Et jusqu’à 20 heures d’autonomie.', "Puce Apple M1<br>CPU 8 coeurs avec 4 coeurs hautes performances et 4 coeurs hautes efficacité énergétique<br>GPU 8 coeurs<br>Neural Engine 16 coeurs<br>8 Go de mémoire unifiée<br>SSD de 256 Go", "ordinateur1.png", 1449, 18, 0);
INSERT INTO Produits VALUES(0,'MacBook Air 13"', "Apple", "ordinateur", "Le portable le plus fin et le plus léger est métamorphosé par la puce Apple M1. Avec des performances de processeur jusqu’à 3,5 fois plus élevées. Un processeur graphique jusqu’à 5 fois plus rapide. Une autonomie record sur MacBook Air.", "Puce Apple M1<br>CPU 8 coeurs avec 4 coeurs hautes performanceset 4 coeurs hautes éfficacité énergétique<br>GPU 7 coeurs<br>Neural Engine 16 coeurs<br>8 Go de mémorie unifiée<br>SSD de 256 Go", "ordinateur2.png", 1129, 25, 0);
INSERT INTO Produits VALUES(0,"Microsoft Surface Pro 4", "Microsoft", "ordinateur", "Destiné au Pros, il est transportable, léger et puissant, il vous suivra par tout là où vous allez !", "Puce Intel Core i5 2,4 GHz<br>CPU 2 coeurs<br>GPU Intel HD Graphic 520<br>8 Go de mémoire<br>SSD de 128 Go<br>Ecran de 13,5 pouces", "ordinateur4.png", 559, 15, 0);
INSERT INTO Produits VALUES(0,"Microsoft Surface", "Microsoft", "ordinateur", "Transportable, léger et puissant, il vous suivra par tout là où vous allez !", "Puce Intel Core i7 2,5 GHz<br>CPU 2 coeurs<br>GPU Intel Iris Plus Graphics 640<br>8 Go de mémoire<br>SSD de 256 Go<br>Ecran de 13,5 pouces", "ordinateur5.png", 850, 45, 0);
INSERT INTO Produits VALUES(0,"Microsoft Surface Go", "Microsoft", "ordinateur", "Petit, léger et élégant, il saura prendre place dans votre lieu de travail", "Puce Intel Core i5 2,3 GHz<br>CPU 2 coeurs<br>GPU Intel UHD Graphics<br>8 Go de mémoire<br>SSD de 128 Go<br>Ecran de 12,4 pouces", "ordinateur6.png", 649, 3, 0);
INSERT INTO Produits VALUES(0,"HP 470 Home G7", "HP", "ordinateur", "Conçu pour favoriser la productivité, le HP 470 offre les performances et la mobilité indispensables aux travailleurs modernes.", "Puce Intel Core i3 2,1 GHz<br>CPU 2 coeurs<br>GPU AMD Radeon 530<br>8 Go de mémoire<br>SSD de 256 Go<br>Ecran de 17,3 pouces", "ordinateur7.png", 905, 17, 0);
INSERT INTO Produits VALUES(0,'ASUS VivoBook 17"', "Asus", "ordinateur", "Utile pour de la bureautique, le VivoBook 17 d'Asus vous permettra de réaliser des tâches simples et peu gourmandes.", "Puce Ryzen 3 3250U 2,3 GHz<br>CPU 2 coeurs<br>GPU Radeon Vega 3 Graphics<br>8 Go de mémoire<br>SSD de 512 Go<br>Ecran de 17,3 pouces", "ordinateur8.png", 539, 24, 0);
INSERT INTO Produits VALUES(0,'ASUS VivoBook 15"', "Asus", "ordinateur", "Utile pour de la bureautique, le VivoBook 15 d'Asus vous permettra de réaliser des tâches simples et peu gourmandes.", "Puce Intel Core i3 2,1 GHz<br>CPU 2 coeurs<br>GPU Intel UHD<br>8 Go de mémoire<br>SSD de 512 Go<br>Ecran de 15,6pouces", "ordinateur9.png", 540, 23, 0);

INSERT INTO Produits VALUES(0,"iPhone 13", "Apple", "telephone", "Le tout nouveau iPhone 13, encore plus rapide que jamais avec sa nouvelle puce A15 Bionique", 'Puce A15 Bionique<br>Ecran 6,1 Super Retina XDR Oled<br>Capacité de 128 Go<br>Autonomie de 19 heures<br>Capteurs : FaceId, Baromètre, Gyroscope, Accéléromètre, Capteur de luminosité<br>Système d\'exploitation : IOS 15', "telephone1.png", 909,52, 0);
INSERT INTO Produits VALUES(0,"iPhone 13 Mini", "Apple", "telephone", "Le tout nouveau iPhone 13 Mini, encore plus rapide que jamais avec sa nouvelle puce A15 Bionique", 'Puce A15 Bionique<br>Ecran 5,4 Super Retina XDR Oled<br>Capacité de 128 Go<br>Autonomie de 17 heures<br>Capteurs : FaceId, Baromètre, Gyroscope, Accéléromètre, Capteur de luminosité<br>Système d\'exploitation : IOS 15', "telephone2.png", 809, 49, 0);
INSERT INTO Produits VALUES(0,"iPhone 13 Pro", "Apple", "telephone", "Le tout nouveau iPhone 13 Pro, il est destiné aux plus exigeants et ceux qui veulent toutes les dernières nouveautés", 'Puce A15 Bionique<br>Ecran 6,1 Super Retina XDR Oled 120Hz<br>Capacité de 128 Go<br>Autonomie de 22 heures<br>Capteurs : FaceId, LIDAR, Baromètre, Gyroscope, Accéléromètre, Capteur de luminosité<br>Système d\'exploitation : IOS 15', "telephone0.png", 1159, 26, 0);
INSERT INTO Produits VALUES(0,"iPhone 13 Pro Max", "Apple", "telephone", "Le tout nouveau iPhone 13 Pro Max, il est destiné aux plus exigeants et ceux qui veulent toutes les dernières nouveautés dans le gros format", 'Puce A15 Bionique<br>Ecran 6,7 Super Retina XDR Oled 120Hz<br>Capacité de 128 Go<br>Autonomie de 28 heures<br>Capteurs : FaceId, LIDAR, Baromètre, Gyroscope, Accéléromètre, Capteur de luminosité<br>Système d\'exploitation : IOS 15', "telephone3.png", 1259, 27, 0);
INSERT INTO Produits VALUES(0,"Samsung Galaxy S21", "Samsung", "telephone", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "telephone4.png", 669, 23, 0);
INSERT INTO Produits VALUES(0,"Samsung Galaxy S21 Ultra", "Samsung", "telephone", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "telephone5.png", 999, 12, 0);
INSERT INTO Produits VALUES(0,"Samsung Galaxy Fold 5G", "Samsung", "telephone", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "telephone6.png", 868, 34, 0);
INSERT INTO Produits VALUES(0,"Samsung Galaxy ZFlip 3", "Samsung", "telephone", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "telephone7.png", 799, 56, 0);
INSERT INTO Produits VALUES(0,"One Plus 9", "OnePlus", "telephone", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "telephone8.png", 740, 23, 0);
INSERT INTO Produits VALUES(0,"Nokia 3310", "Nokia", "telephone", "Presque indémodable, le Nokia 3310 restera à jamais gravé dans l'histoire des téléphones mobiles", "Ceci est une grande description du produit", "telephone9.png", 59, 203, 0);

INSERT INTO Produits VALUES(0,'iPad Pro 11"', "Apple", "tablette", "Le tout nouveau iPad Pro avec la puissante puce M1", "Ceci est une grande description du produit", "tablette0.png", 899, 36, 8);
INSERT INTO Produits VALUES(0,'iPad Pro 12,9"', "Apple", "tablette", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "tablette2.png", 1219, 17, 0);
INSERT INTO Produits VALUES(0,"iPad Air (2020)", "Apple", "tablette", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "tablette1.png", 669, 27, 10);
INSERT INTO Produits VALUES(0,'iPad Mini',"Apple","tablette","Ceci est une description peu détaillée", "Ceci est une grande description du produit","tablette7.png",559,24,0);
INSERT INTO Produits VALUES(0,'iPad Pro 12,9" (2018)', "Apple", "tablette","Ceci est une description peu détaillée", "Ceci est une grande description du produit", "tablette3.png", 1099, 19, 0);
INSERT INTO Produits VALUES(0,'iPad Pro 11" (2018)', "Apple", "tablette", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "tablette4.png", 799, 10, 0);
INSERT INTO Produits VALUES(0,"Samsung Galaxy Tab S7","Samsung","tablette","Ceci est une description peu détaillée", "Ceci est une grande description du produit","tablette9.png",600,21,0);
INSERT INTO Produits VALUES(0,"Samsung galaxy Tab S7+","Samsung","tablette","Ceci est une description peu détaillée", "Ceci est une grande description du produit","tablette5.png",999,12,0);
INSERT INTO Produits VALUES(0,"Samsung Galaxy Tab 4","Samsung","tablette","Ceci est une description peu détaillée", "Ceci est une grande description du produit","tablette6.png",109,23,0);
INSERT INTO Produits VALUES(0,"Lenovo Tab M10","Lenovo","tablette","Ceci est une description peu détaillée", "Ceci est une grande description du produit","tablette8.png",200,31,0);

INSERT INTO Produits VALUES(0,"Canon MG3650S", "Canon", "imprimante", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "imprimante0.png", 60, 3, 0);
INSERT INTO Produits VALUES(0,"Canon TS3350", "Canon", "imprimante", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "imprimante1.png", 55, 29, 0);
INSERT INTO Produits VALUES(0,"Canon TS3150", "Canon", "imprimante", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "imprimante2.png", 59, 17, 0);
INSERT INTO Produits VALUES(0,"Canon MG2555S","Canon","imprimante","Ceci est une description peu détaillée", "Ceci est une grande description du produit","imprimante5.png",50,45,0);
INSERT INTO Produits VALUES(0,"Canon TR4550","Canon","imprimante","Ceci est une description peu détaillée", "Ceci est une grande description du produit","imprimante6.png",80,15,0);
INSERT INTO Produits VALUES(0,"Canon MF445DW","Canon","imprimante","Ceci est une description peu détaillée", "Ceci est une grande description du produit","imprimante7.png",479,3,0);
INSERT INTO Produits VALUES(0,"Brother MFC-J533ODW", "Brother", "imprimante", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "imprimante3.png", 49, 34, 0);
INSERT INTO Produits VALUES(0,"Epson Expression Home XP-2100","Epson","imprimante","Ceci est une description peu détaillée", "Ceci est une grande description du produit","imprimante4.png",50,23,0);
INSERT INTO Produits VALUES(0,"HP Laser 178NW","HP","imprimante","Ceci est une description peu détaillée", "Ceci est une grande description du produit","imprimante8.png",260,2,0);
INSERT INTO Produits VALUES(0,"HP Smart Tank 7305","HP","imprimante","Ceci est une description peu détaillée", "Ceci est une grande description du produit","imprimante9.png",350,24,0);

INSERT INTO Produits VALUES(0,"iRobot i7 Roomba", "iRobot", "aspirateur", "You're lazy like me ? Buy it !", "Ceci est une description très détaillé du produit", "aspirateur0.png", 700, 10, 2);
INSERT INTO Produits VALUES(0,"iRobot s9 Roomba", "iRobot", "aspirateur", "Mieux que votre femme de ménage !", "Ceci est une description très détaillé du produit", "aspirateur1.png", 1100, 16, 0);
INSERT INTO Produits VALUES(0,"Rowenta Explorer S80", "Rowenta", "aspirateur", "Hop hop pour les flemmards", "Ceci est une description très détaillé du produit", "aspirateur2.png", 500, 36, 0);
INSERT INTO Produits VALUES(0,"Laveur Roborock S7", "Roborock", "aspirateur", "Pour les flemmards ++", "Ceci est une description très détaillé du produit", "aspirateur3.png", 549, 25, 0);
INSERT INTO Produits VALUES(0,"iRobot Roomba 976","iRobot","aspirateur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","aspirateur4.png",500,12,0);
INSERT INTO Produits VALUES(0,"Rowenta X-Plorer série 95","Rowenta","aspirateur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","aspirateur5.png",550,0,0);
INSERT INTO Produits VALUES(0,"Shark RV1000SEU","Shark","aspirateur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","aspirateur6.png",499,24, 0);
INSERT INTO Produits VALUES(0,"Roborock S7","Roborock","aspirateur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","aspirateur7.png",688,10,0);
INSERT INTO Produits VALUES(0,"Xiaomi Viomi SE","Xiaomi","aspirateur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","aspirateur8.png",210,15,0);
INSERT INTO Produits VALUES(0,"Laveur My Little Robot","Senya","aspirateur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","aspirateur9.png",180,21,0);

INSERT INTO Produits VALUES(0,"Mx key", "Logitech", "clavier", "Sans doute l'un des meilleurs claviers sans fils", "Ceci est une description très détaillé du produit", "clavier0.png", 120, 34, 0);
INSERT INTO Produits VALUES(0,"Logitech Mx Keyx Mini","Logitech", "clavier", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "clavier8.png",109,15,0);
INSERT INTO Produits VALUES(0,"Logitech K380", "Logitech", "clavier", "Petit clavier sans fils passe par tout", "Ceci est une description très détaillé du produit", "clavier1.png", 25, 28, 0);
INSERT INTO Produits VALUES(0,"Logitech Craft", "Logitech", "clavier", "The must to have ! Clavier sans fils avec des touches responsives", "Ceci est une description très détaillé du produit", "clavier2.png", 275, 16, 0);
INSERT INTO Produits VALUES(0,"Corsair K57", "Corsair", "clavier", "Clavier sans fils rétro-éclairé RGB", "Ceci est une description très détaillé du produit", "clavier3.png", 130, 52, 0);
INSERT INTO Produits VALUES(0,"Logitech K280e","Logitech", "clavier", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "clavier4.png",24,51,0);
INSERT INTO Produits VALUES(0,"It Works WL FR2","ItWorks", "clavier", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "clavier5.png",11,3,0);
INSERT INTO Produits VALUES(0,"Apple Magic Keyboard","Apple", "clavier", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "clavier6.png",135,14,0);
INSERT INTO Produits VALUES(0,"Logitech G512 Carbon Lightsync","Logitech", "clavier", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "clavier7.png",90, 26,0);
INSERT INTO Produits VALUES(0,"Clavier Gaming Logitech G413","Logitech", "clavier", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "clavier9.png",65,6,0);

INSERT INTO Produits VALUES(0,"Mx Master 3", "Logitech", "souris", "Sans doute l'une des melleure souris sans fils", "Ceci est une description très détaillé du produit", "souris0.png", 95, 31, 0);
INSERT INTO Produits VALUES(0,"Mx Master 2S", "Logitech", "souris", "Souris sans fils très réactive et bon marché", "Ceci est une description très détaillé du produit", "souris1.png", 69, 25, 0);
INSERT INTO Produits VALUES(0,"Hero lightspeed", "Logitech", "souris", "Votre futur souris gaming", "Ceci est une description très détaillé du produit", "souris2.png", 99, 8, 0);
INSERT INTO Produits VALUES(0,"Apple Magic Mouse", "Apple", "souris", "La souris officiel de la marque à la pomme", "Ceci est une description très détaillé du produit", "souris3.png", 85, 26, 0);
INSERT INTO Produits VALUES(0,"Logitech M185","Logitech", "souris", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "souris4.png",12,0,0);
INSERT INTO Produits VALUES(0,"Logitech Pebble M350","Logitech", "souris", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "souris5.png",17,25,0);
INSERT INTO Produits VALUES(0,"Logitech Mx Vertical","Logitech", "souris", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "souris6.png",99,26,0);
INSERT INTO Produits VALUES(0,"Souris Gaming Logitech G703 Hero","Logitech", "souris", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "souris7.png",66,45,0);
INSERT INTO Produits VALUES(0,"Souris Gaming Logitech G903 Hero","Logitech", "souris", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "souris8.png",98,38,0);
INSERT INTO Produits VALUES(0,"Microsoft Modern","Microsoft", "souris", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "souris9.png",37,19,0);

INSERT INTO Produits VALUES(0,"AirPods Pro", "Apple", "ecouteurs", "Les nouveaux AirPods Pro, une douceur pour vos oreilles", "Ceci est une description très détaillé du produit", "ecouteurs0.png", 199, 15, 4);
INSERT INTO Produits VALUES(0,"AirPods", "Apple", "ecouteurs", "Les nouveaux AirPods, encore plus spectaculaire !", "Ceci est une description très détaillé du produit", "ecouteurs1.png", 180, 76, 0);
INSERT INTO Produits VALUES(0,"AirPods Max", "Apple", "ecouteurs", "Le nouveau casque sonore pour une immersion totale", "Ceci est une description très détaillé du produit", "ecouteurs2.png", 579, 29, 0);
INSERT INTO Produits VALUES(0,"EarPods Lightning","Apple", "ecouteurs", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "ecouteurs3.png",23,62,0);
INSERT INTO Produits VALUES(0,"JBL Intra-auriculaire Tune 225TWS","JBL", "ecouteurs", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "ecouteurs4.png",60,26,0);
INSERT INTO Produits VALUES(0,"Sony WI-C200","Sony", "ecouteurs", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "ecouteurs5.png",30,24,0);
INSERT INTO Produits VALUES(0,"Samsung Galaxy Buds+","Samsung", "ecouteurs", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "ecouteurs6.png",150,29,0);
INSERT INTO Produits VALUES(0,"Samsung Galaxy Buds2","Samsung", "ecouteurs", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "ecouteurs7.png",130,35,0);
INSERT INTO Produits VALUES(0,"Sony Intra-auriculaire MDR-XB55AP","Sony", "ecouteurs", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "ecouteurs8.png",40,21,0);
INSERT INTO Produits VALUES(0,"JBL Tune 710BT","JBL", "ecouteurs", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "ecouteurs9.png",50,42,0);

INSERT INTO Produits VALUES(0,"Hue Go", "Philips", "lampe", "Sans fils, portative et magnifie, c'est la nouvelle Hue Go de Philips", "Ceci est une description très détaillé du produit", "lampe0.png", 75, 45, 0);
INSERT INTO Produits VALUES(0,"Hue Play", "Philips", "lampe", "Posez la dans votre intérieur et une ambiance chaleureuse apparaitra", "Ceci est une description très détaillé du produit", "lampe1.png", 69, 65, 0);
INSERT INTO Produits VALUES(0,"Lampe à poser Iris", "Philips", "lampe", "Desing, élégante et éclaire votre intérieur", "Ceci est une description très détaillé du produit", "lampe2.png", 99, 16, 0);
INSERT INTO Produits VALUES(0,"Lampe à poser Wellness", "Philips", "lampe", "Parfait sur votre table de chevet", "Ceci est une description très détaillé du produit", "lampe3.png", 99, 45, 0);
INSERT INTO Produits VALUES(0,"Ampoule colorée E27","Philips", "lampe", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "lampe4.png",55,65,0);
INSERT INTO Produits VALUES(0,"Ampoule colorée GU10","Philips", "lampe", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "lampe5.png",60,68,0);
INSERT INTO Produits VALUES(0,"Ampoule E27","Philips", "lampe", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "lampe6.png",50,45,0);
INSERT INTO Produits VALUES(0,"Ampoule GU10","Philips", "lampe", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "lampe7.png",30,54,0);
INSERT INTO Produits VALUES(0,"LigthStrip extérieur","Philips", "lampe", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "lampe8.png",110,36,0);
INSERT INTO Produits VALUES(0,"Lampe à poser Wellner","Philips", "lampe", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "lampe9.png",100,35,0);

INSERT INTO Produits VALUES(0,"Apple watch serie 7", "Apple", "montre", "La nouvelle Apple Watch, encore plus grande et toujours plus rapide", "Ceci est une description très détaillé du produit", "montre0.png", 480, 24, 0);
INSERT INTO Produits VALUES(0,"Apple Watch SE", "Apple", "montre", "La montre à offrir pour votre famille !", "Ceci est une description très détaillé du produit", "montre1.png", 350, 27, 0);
INSERT INTO Produits VALUES(0,"Apple Watch serie 3", "Apple", "montre", "Toujours si utile pour votre poignet", "Ceci est une description très détaillé du produit", "montre2.png", 220, 8, 0);
INSERT INTO Produits VALUES(0,"Apple Watch serie 7 Hermes", "Apple", "montre", "Élégante, rafinée, et si utile !", "Ceci est une description très détaillé du produit", "montre3.png", 1480, 31, 0);
INSERT INTO Produits VALUES(0,"Xiaomi Mi Smart Band 5","Xiaomi", "montre", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "montre4.png",50,24,0);
INSERT INTO Produits VALUES(0,"Xiaomi Mi Watch","Xiaomi", "montre", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "montre5.png",150,45,0);
INSERT INTO Produits VALUES(0,"Huawei Watch GT2","Huawei", "montre", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "montre6.png",230,37,0);
INSERT INTO Produits VALUES(0,"Samsung Galaxy Watch4","Samsung", "montre", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "montre7.png",270,45,0);
INSERT INTO Produits VALUES(0,"Garmin Forerunner 45S","Garmin", "montre", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "montre8.png",200,18,0);
INSERT INTO Produits VALUES(0,"Garmin Collection Venu2","Garmin", "montre", "Ceci est une description peu détaillée", "Ceci est une grande description du produit", "montre9.png",330,25,0);

INSERT INTO Produits VALUES(0,'Ecran incurvé 32" 4K Samsung',"Samsung","ecran","Ceci est une description peu détaillée", "Ceci est une grande description du produit","ecran0.png",370,52,10);
INSERT INTO Produits VALUES(0,'Ecran incurvé 24" FHD Samsung',"Samsung","ecran","Ceci est une description peu détaillée", "Ceci est une grande description du produit","ecran1.png",160,24,0);
INSERT INTO Produits VALUES(0,'Ecran incurvé 27" FHD Samsung',"Samsung","ecran","Ceci est une description peu détaillée", "Ceci est une grande description du produit","ecran2.png",180,26,0);
INSERT INTO Produits VALUES(0,'Ecran incurvé 27" WQHD Samsung Odyseey G5',"Samsung","ecran","Ceci est une description peu détaillée", "Ceci est une grande description du produit","ecran3.png",320,41,0);
INSERT INTO Produits VALUES(0,'Ecran incurvé 32" QLED Samsung Odyssey G7',"Samsung","ecran","Ceci est une description peu détaillée", "Ceci est une grande description du produit","ecran4.png",630,39,0);
INSERT INTO Produits VALUES(0,'Ecran 24" FHD Samsung S24F350',"Samsung","ecran","Ceci est une description peu détaillée", "Ceci est une grande description du produit","ecran5.png",230,5,0);
INSERT INTO Produits VALUES(0,'Ecran 27" QHD Dell S2721D',"Dell","ecran","Ceci est une description peu détaillée", "Ceci est une grande description du produit","ecran6.png",270,26,0);
INSERT INTO Produits VALUES(0,'Ecran 32" UHD Samsung Smart Monitor M7',"Samsung","ecran","Ceci est une description peu détaillée", "Ceci est une grande description du produit","ecran7.png",385,29,0);
INSERT INTO Produits VALUES(0,'Ecran 27" FHD Dell S2721HGF',"Dell","ecran","Ceci est une description peu détaillée", "Ceci est une grande description du produit","ecran8.png",240,45,0);
INSERT INTO Produits VALUES(0,'Ecran 21.5" FHD HP M22F',"HP","ecran","Ceci est une description peu détaillée", "Ceci est une grande description du produit","ecran9.png",188,48,0);

INSERT INTO Produits VALUES(0,"HomePod Mini", "Apple", "haut-parleur", "Aussi petit mais tout aussi puissant, sortez l'alcool !", "Ceci est une description très détaillé du produit", "haut-parleur0.png", 99, 54, 0);
INSERT INTO Produits VALUES(0,"JBL Clip 4","JBL","haut-parleur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","haut-parleur1.png",50,26,0);
INSERT INTO Produits VALUES(0,"JBL Flip 6","JBL","haut-parleur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","haut-parleur2.png",153,51,0);
INSERT INTO Produits VALUES(0,"JBL Go 3","JBL","haut-parleur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","haut-parleur3.png",35,87,0);
INSERT INTO Produits VALUES(0,"JBL Charge 5","JBL","haut-parleur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","haut-parleur5.png",167,45,0);
INSERT INTO Produits VALUES(0,"JBL Boombox 2","JBL","haut-parleur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","haut-parleur6.png",549,18,0);
INSERT INTO Produits VALUES(0,"Devialet Phantom II","Devialet","haut-parleur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","haut-parleur4.png",1400,26,0);
INSERT INTO Produits VALUES(0,"Bose SoundLink II","Bose","haut-parleur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","haut-parleur7.png",125,47,0);
INSERT INTO Produits VALUES(0,"Bose SoundLink Revolve Plus","Bose","haut-parleur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","haut-parleur8.png",315,27,0);
INSERT INTO Produits VALUES(0,"Beats Pill","Beats","haut-parleur","Ceci est une description peu détaillée", "Ceci est une grande description du produit","haut-parleur9.png",152,51,0);





