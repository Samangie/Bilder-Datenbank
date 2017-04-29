<?php
require_once '../lib/Repository.php';
class GalleryCategoryRepository extends Repository
{
    protected $tableName = 'gallery_category';

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