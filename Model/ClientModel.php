<?php

namespace Model;

use \Helper\Model;
use \PDO;

/**
 * Class ClientModel
 * @package Controller
 */
class ClientModel extends Model
{
    /**
     * @param null $id
     * @param null $limit
     * @return array | bool
     * @throws \Exception
     * Suivant les cas, la méthode va :
     * - sélectionner toutes les entrées de la table revues
     * - sélectionner une entrée correspondant à l'id passée en paramètre
     */
    public function select($id = Null){
        if($id == Null){
            $sql = 'SELECT 
                      id, 
                      numero, 
                      img, 
                      region, 
                      zone, 
                      datepub 
                    FROM revues';
            $requete = self::$db->query($sql);
            return $requete->fetchAll(PDO::FETCH_OBJ);
        } else {
            $sql = 'SELECT 
                  id, 
                  numero, 
                  img, 
                  region, 
                  zone, 
                  datepub 
                FROM revues
                WHERE id = :id';
            $requete = self::$db->prepare($sql);
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();
            if ($requete->errorCode() !== "00000") {
               throw new \Exception('Argh database');
            }
            return $requete->fetch(PDO::FETCH_OBJ);
        }
    }

}

