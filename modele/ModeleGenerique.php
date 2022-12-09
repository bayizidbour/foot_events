<?php
abstract class ModeleGenerique
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=foot_events", "root", "", [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ] );
        
    }
    
    public function executer(?String $query, array $params = null) {
    
        $statement = $this->pdo->prepare($query);
        
        if( !empty($params) ){
            foreach ($params as $key => $value) {
                $params[$key] = htmlentities( $value );
            }
        }
        
        $statement->execute($params);
        
        return $statement;
    }
    
    abstract function getOne($identifiant);
    abstract function getAll();
}
