<?php

namespace Model;

use \Helper\Model;
use \PDO;

/**
 * Class ProjectModel
 * @package Controller
 */
class ProjectModel extends Model
{

    // private $id = 1;

    /**
     * @return array | bool
     * @throws \Exception
     */
    public function getListProject(){
        $sql = 'SELECT id, title, description, id_user, negociation_status, milestone, status
                FROM project';
        $requete = self::$db->query($sql);
        return $requete->fetchAll(PDO::FETCH_OBJ);
    }

        /**
     * @param $id
     * @return array | bool
     * @throws \Exception
     */
    public function getProject($id)
    {
        $id = (int) $_GET['id'];
    // $id = 1;
       $sql = 'SELECT id, title, description, id_user, negociation_status, milestone, status
                FROM project
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
    public function addProject($statement)
    {
        if(is_array($statement)){
            $dNow = new \DateTime();
            $sql = 'INSERT INTO project(
                      id,
                      title,
                      description,
                      id_user,
                      negociation_status,
                      milestone,
                      status,
                    )
                    VALUES(
                      NULL,
                      :title,
                      :description,
                      :id_user,
                      :negociation_status,
                      :milestone,
                      status,
                    )';
            $requete = self::$db->prepare($sql);
            $requete->bindValue(':title', $statement['title'], PDO::PARAM_INT);
            $requete->bindValue(':description', $statement['description'], PDO::PARAM_STR);
            $requete->bindValue(':id_user', $statement['id_user'], PDO::PARAM_INT);
            $requete->bindValue(':negociation_status', $statement['negociation_status'], PDO::PARAM_INT);
            $requete->bindValue(':milestone', $statement['milestone'], PDO::PARAM_STR);
            $requete->bindValue(':status', $statement['status'], PDO::PARAM_STR);
            $requete->execute();
            if ($requete->errorCode() !== "00000") {
                throw new \Exception('error database');
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
    public function removeProject($id)
    {
        if(is_int($id)){
            $sql = 'DELETE FROM project WHERE id = :id';
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
    public function updateProject($statement, $id)
    {
        if(is_array($statement) && is_int($id)){
            $sql = 'UPDATE project
                    SET
                        title = :title,
                        description = :description,
                        id_user = :id_user,
                        negociation_status = :negociation_status,
                        milestone = :milestone,
                        status = :status,
                    WHERE id = :id';
            $requete = self::$db->prepare($sql);
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->bindValue(':title', $statement['title'], PDO::PARAM_INT);
            $requete->bindValue(':id_user', $statement['id_user'], PDO::PARAM_STR);
            $requete->bindValue(':negociation_status', $statement['negociation_status'], PDO::PARAM_STR);
            $requete->bindValue(':milestone', $statement['milestone'], PDO::PARAM_STR);
            $requete->bindValue(':status', $statement['status']);
            $requete->execute();
            if ($requete->errorCode() !== "00000") {
                throw new \Exception('Argh database');
            }
        } else {
            throw new \Exception('statement is not an array or id not int');
        }
    }
}

