CREATE TABLE `utilisateur` (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nom VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255)
);

CREATE TABLE `posteInsta` (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    image VARCHAR(255),
    descriptions VARCHAR(255),
    id_utilisateur INT, 
    
    CONSTRAINT fk_utilisateur
        FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
        ON DELETE CASCADE
);

CREATE TABLE `commentaire` (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    comentaire TEXT,
    id_utilisateur INT,
    id_posteInsta INT,
    CONSTRAINT fk_utilisateur_commentaire 
        FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_posteInsta_commentaire
        FOREIGN KEY (id_posteInsta) REFERENCES posteInsta(id)
        ON DELETE CASCADE
);


CREATE TABLE `aime` (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_utilisateur INT,
    id_posteInsta INT,
    CONSTRAINT fk_utilisateur_aime
        FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_posteInsta_aime 
        FOREIGN KEY (id_posteInsta) REFERENCES posteInsta(id)
        ON DELETE CASCADE
);
