<?php
class posteReporitory {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getdb($row) {
        echo $row['id'] . " - " . $row['descriptions'] . " - " . $row['id_utilisateur'] . " - " . "<br>";
    }

    public function getImagedb($row){
        echo $row['image'];
    }

    public function getIDdb($row){
        echo $row['id'];
    }

    public function setdb($dbNew) {
        $this->db = $dbNew;
    }

    public function supprdb($num) {
        $sql = "DELETE FROM posteInsta WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $num]);
    }

    public function ajoutdb($image, $descriptions, $id_utilisateur) {
        $sql = "INSERT INTO posteInsta (image, descriptions, id_utilisateur) VALUES (:image, :descriptions, :id_utilisateur)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'image' => $image,
            'descriptions' => $descriptions,
            'id_utilisateur' => $id_utilisateur
        ]);
        echo "Poste ajouté avec succès.";
    }

    public function getAllPosts() {
        $sql = "SELECT * FROM posteInsta";
        $stmt = $this->db->query($sql);
        return $stmt;
    }

    public function countLikes($poste_id) {
        $sql = "SELECT COUNT(*) AS total_likes FROM aime WHERE id_posteInsta = :poste_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['poste_id' => $poste_id]);
        $row = $stmt->fetch();
        return $row['total_likes'];
    }

    public function getPostOwnerName($poste_id) {
        // Requête SQL avec jointure pour obtenir le nom de l'utilisateur ayant créé le poste
        $sql = "SELECT utilisateur.nom 
                FROM posteInsta 
                INNER JOIN utilisateur ON posteInsta.id_utilisateur = utilisateur.id 
                WHERE posteInsta.id = :poste_id";
    
        // Préparation et exécution de la requête
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['poste_id' => $poste_id]);
    
        // Vérifier si un résultat a été trouvé
        if ($row = $stmt->fetch()) {
            // Retourner le nom de l'utilisateur
            return $row['nom'];
        } else {
            // Si aucun utilisateur trouvé pour ce poste, renvoyer une chaîne vide ou un message
            return "Utilisateur inconnu";
        }
    }

    public function ajouterCommentaire($commentaire, $user_id, $poste_id) {
        $sql = "INSERT INTO commentaire (comentaire, id_utilisateur, id_posteInsta) 
                VALUES (:commentaire, :user_id, :poste_id)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'commentaire' => $commentaire,
            'user_id' => $user_id,
            'poste_id' => $poste_id
        ]);
        
        echo "Commentaire ajouté avec succès.";
    }

    public function getCommentairesByPost($poste_id) {
        $sql = "SELECT commentaire.comentaire, utilisateur.nom 
                FROM commentaire 
                INNER JOIN utilisateur ON commentaire.id_utilisateur = utilisateur.id
                WHERE commentaire.id_posteInsta = :poste_id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['poste_id' => $poste_id]);
    
        return $stmt->fetchAll();
    }
    
    
    

}

?>