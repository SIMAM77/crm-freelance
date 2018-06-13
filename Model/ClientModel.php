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
     *
     */
    public function getAllClients(){

        $sql = 'SELECT id, firstname
                FROM clients';

        $requete = self::$db->query($sql);

        return $requete->fetchAll(PDO::FETCH_OBJ);

    }
}

