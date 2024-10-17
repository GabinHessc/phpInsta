<?php
class UserReporitory{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getdb($row){
        $sql = "SELECT * From utilisateur";
        $stmt = $this->db->query($sql);
        echo $row['id'] . " - " . $row['nom'] . " - " . $row['email'] ."<br>";

    }

    public function getIDdb($email){
        $sql = "SELECT id FROM utilisateur WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            return $row['id'];
        }
    
        return null;
    }
    

    public function setdb($dbNew){
        $this->db = $dbNew;
    }

    public function supprdb($num){
        $sql = "DELETE FROM utilisateur WHERE id = $num";
        $stmt = $this->db -> prepare($sql);
        $stmt->execute();
    }

    public function updatedb($currentEmail, $nom, $email, $password = null) {
        if ($password) {
            $sql = "UPDATE utilisateur SET nom = :nom, email = :email, password = :password WHERE email = :currentEmail";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':nom' => $nom,
                ':email' => $email,
                ':password' => $password,
                ':currentEmail' => $currentEmail
            ]);
        } else {
            $sql = "UPDATE utilisateur SET nom = :nom, email = :email WHERE email = :currentEmail";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':nom' => $nom,
                ':email' => $email,
                ':currentEmail' => $currentEmail
            ]);
        }
    }
    

    public function ajoutdb($nom,$email,$password){
        $sql = "SELECT * FROM utilisateur WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        
        if ($stmt->rowCount() > 0) {
            // L'email existe déjà
            echo "L'email existe déjà.";
            return false;
        } else {
            // Ajouter l'utilisateur si l'email est unique
            $sql = "INSERT INTO utilisateur (nom, email, password) VALUES (:nom, :email, :password)";
            $stmt = $this->db->prepare($sql);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute(['nom' => $nom, 'email' => $email, 'password' => $hashed_password]);
            echo "Utilisateur ajouté avec succès.";
            return true;
        }
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM utilisateur";
        $stmt = $this->db->query($sql);
        return $stmt;
    }

    public function connexiondb($email, $password){
        $sql = "SELECT * FROM utilisateur WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        // Vérification si l'utilisateur existe
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Vérifier le mot de passe
            if (password_verify($password, $row['password'])) {
                return true; // Connexion réussie
            }
        }

        // Si l'utilisateur n'existe pas ou le mot de passe est incorrect
        return false;
        }
}
?>