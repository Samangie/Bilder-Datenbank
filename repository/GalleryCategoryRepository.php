<?php
require_once '../lib/Repository.php';
class GalleryCategoryRepository extends Repository
{
    protected $tableName = 'gallery_category';

    public function createGallery($title, $user, $description)
    {
        $query = "INSERT INTO $this->tableName (title, user_id, description) VALUES (?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sis', $title, $user, $description);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function readByUserId($userid){

        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE user_id = ?  ";


        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('i', $userid);

        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;
    }
}