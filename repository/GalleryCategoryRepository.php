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
}