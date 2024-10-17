<?php
class data_Base{

    private $host;
    private $dbname;
    private $username;
    private $passworld;
    private PDO $pdo;

    public function __construct(string $host, string $dbname, string $username,  string $passworld){
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->passworld = $passworld;
        $this->pdo = new PDO('mysql:host='.$host . ';dbname='. $dbname,$username,$passworld);
    }

    public function gethost(){ return $this->host;}
    public function getdbname(){ return $this->dbname;}
    public function getusername(){ return $this->username;}
    public function getPassworld(){ return $this->passworld;}
    public function getpdo(){ return $this->pdo;}

    public function sethost($value){$this->host = $value;}
    public function setpdo($value){$this->pdo = $value;}

    public function getConnexion() {
        // Si PDO est bien instancié, cela signifie que la connexion a réussi
        if ($this->pdo) {
            return "Connexion réussie.<br>";
        } else {
            return "Erreur de connexion.<br>";
        }
    }
    
}

?>