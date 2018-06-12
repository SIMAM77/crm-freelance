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
     * @return array | bool
     * @throws \Exception
     */
    public function getListClient(){
        $sql = 'SELECT id, firstname, lastname, company, last_happiness 
                FROM client';

        $requete = self::$db->query($sql);

        return $requete->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * @param $id
     * @return array | bool
     * @throws \Exception
     */
    public function getClient($id)
    {
        
       $sql = 'SELECT id, firstname, lastname, company, picture, date_of_birth, `address`, email, phone_number, budget, date_create, notes, last_happiness 
                FROM client
                WHERE id = :id';

        $requete = self::$db->prepare($sql);
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        $requete->execute();

        if ($requete->errorCode() !== "00000") {
            throw new \Exception('pbm database');
        }
        return $requete->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param $statement
     * @return string id elem added
     * @throws \Exception
     */
    public function addClient($statement)
    {
        if(is_array($statement)){

            $dNow = new \DateTime();

            $sql = 'INSERT INTO client(
                      id, 
                      firstname, 
                      lastname, 
                      picture, 
                      company,
                      date_create, 
                    )                 
                    VALUES(
                      NULL, 
                      :firstname, 
                      :lastname, 
                      :picture,
                      :company, 
                      :date_create, 
                    )';

            $requete = self::$db->prepare($sql);

            $requete->bindValue(':firstname', $statement['firstname'], PDO::PARAM_INT);
            $requete->bindValue(':lastname', $statement['lastname'], PDO::PARAM_STR);
            $requete->bindValue(':picture', $statement['picture'], PDO::PARAM_STR);
            $requete->bindValue(':date_create', $dNow);

            $requete->execute();

            if ($requete->errorCode() !== "00000") {
                throw new \Exception('pbm database');
            }

            return (int) self::$db->lastInsertId();

        } else {
            throw new \Exception('statement is not an array');
        }
    }

    /**
     * @param $id
     * @return null
     * @throws \Exception
     */
    public function removeClient($id)
    {
        if(is_int($id)){
            $sql = 'DELETE FROM client WHERE id = :id';

            $requete = self::$db->prepare($sql);

            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();

            if ($requete->errorCode() !== "00000") {
                throw new \Exception('Arg database');
            }

            return 'suppression effectuée.';

        } else {
            throw new \Exception('param is not int');
        }
    }

    /**
     * @param $statement
     * @param $id
     * @throws \Exception
     */
    public function updateClient($statement, $id)
    {
        if(is_array($statement) && is_int($id)){
            $sql = 'UPDATE client 
                    SET 
                        firstname = :firstname, 
                        lastname = :lastname, 
                        company = :company, 
                        picture = :picture, 
                        date_of_birth = :date_of_birth,
                        address = :address,
                        email = :email,
                        phone_number = :phone_number,
                        budget = :budget,
                        notes = :notes,
                        last_happiness = :last_happiness
                    WHERE id = :id';

            $requete = self::$db->prepare($sql);

            $requete->bindValue(':id', $id, PDO::PARAM_INT);

            $requete->bindValue(':firstname', $statement['firstname'], PDO::PARAM_INT);
            $requete->bindValue(':lastname', $statement['lastname'], PDO::PARAM_STR);
            $requete->bindValue(':company', $statement['company'], PDO::PARAM_STR);
            $requete->bindValue(':picture', $statement['picture'], PDO::PARAM_STR);
            $requete->bindValue(':date_of_birth', $statement['date_of_birth']);
            $requete->bindValue(':address', $statement['address'], PDO::PARAM_STR);
            $requete->bindValue(':email', $statement['email'], PDO::PARAM_STR);
            $requete->bindValue(':phone_number', $statement['phone_number'], PDO::PARAM_STR);
            $requete->bindValue(':budget', $statement['budget'], PDO::PARAM_STR);
            $requete->bindValue(':notes', $statement['notes'], PDO::PARAM_STR);
            $requete->bindValue(':last_happiness', $statement['last_happiness'], PDO::PARAM_INT);

            $requete->execute();

            if ($requete->errorCode() !== "00000") {
                throw new \Exception('Argh database');
            }
        } else {
            throw new \Exception('statement is not an array or id not int');
        }
    }
}

