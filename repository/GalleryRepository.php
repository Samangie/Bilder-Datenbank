<?php
require_once '../lib/Repository.php';
class GalleryRepository extends Repository
{
    protected $tableName = 'gallery';

    public function createGallery($title, $user)
    {
        $query = "INSERT INTO $this->tableName (title, user_id) VALUES (?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $title, $user);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }
}