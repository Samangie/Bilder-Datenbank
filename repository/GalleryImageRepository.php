<?php

/**
 * Created by PhpStorm.
 * User: sonny
 * Date: 01.05.2017
 * Time: 11:32
 */
require_once '../lib/Repository.php';
require_once '../lib/Validate.php';

class GalleryImageRepository extends Repository
{
    protected $tableName = 'gallery_image';

    public function uploadImage($titel, $image_name, $image_path, $imageFileType, $gallery_id, $username)
    {
        $uploadfolder = 'data/images/' . strtolower($username) . '/';
        $target = $uploadfolder . $image_name;

        if (!file_exists($uploadfolder)) {
            mkdir($uploadfolder, 0777, true);
        }

        move_uploaded_file($image_path, $target);

        $width_thumbnail = '500';
        $dest_path = 'data/thumbnails/' . strtolower($username) . '/';
        if (!file_exists($dest_path)) {
            mkdir($dest_path, 0777, true);
        }
        $destination = $dest_path . $image_name;

        if(!$this->make_thumb($target, $destination, $width_thumbnail, $imageFileType)){
            $_SESSION["errorImage"] = '<p style="color:red;">Fehler ist aufgetreten</p>';
            header('Location: /gallery/upload');
            return false;
        };


        $query = "INSERT INTO $this->tableName (title, image_name, gallery_id ) VALUES (?, ?, ?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('ssi', $titel, $image_name, $gallery_id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;

    }

    /**
     *  Code from https://davidwalsh.name/create-image-thumbnail-php
     *  Add generate proccess for png and gif.
     */

    function make_thumb($src, $destination, $desired_width, $imageFileType) {

        /* read the source image */
        if($imageFileType == "jpg" || $imageFileType == "jpeg") {
            $source_image = imagecreatefromjpeg($src);

        }else if ($imageFileType == "png" ) {

            $source_image = imagecreatefrompng($src);

        }else if ($imageFileType == "gif") {

            $source_image = imagecreatefromgif($src);

        }else {
            $_SESSION["errorImage"] = '<p style="color:red;">Invalid filetype (filetype must be: jpg, png, jpeg)!</p>';
            header('Location: /gallery/upload');
            return false;
        }
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        /* find the "desired height" of this thumbnail, relative to the desired width  */
        $desired_height = floor($height * ($desired_width / $width));

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        /* create the physical thumbnail image to its destination */
        if($imageFileType == "jpg" || $imageFileType == "jpeg") {
            imagejpeg($virtual_image, $destination);

        }else if ($imageFileType == "png" ) {

            imagepng($virtual_image, $destination);

        }else if ($imageFileType == "gif") {

            imagegif($virtual_image, $destination);

        }else {
            $_SESSION["errorImage"] = '<p style="color:red;">Invalid filetype (filetype must be: jpg, png, jpeg)!</p>';
            header('Location: /gallery/upload');
            return false;
        }

        return true;

    }

    public function countImagesByUser($userid){

        $query = "SELECT COUNT(`gc`.`user_id`) AS `countId` FROM `gallery_image` AS `gi`
                  LEFT JOIN `gallery_category` AS `gc` ON `gi`.`gallery_id` = `gc`.`id`
                  WHERE `user_id` = ?;";

        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('i', $userid);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        $result = $statement->get_result();
        $countId = $result->fetch_assoc();
        $test = $countId['countId'];
        var_dump($test);
    }

    public function readyByGalleryId($gallery_id){

        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE gallery_id = ?  ";


        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('i', $gallery_id);

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

    public function deleteByGalleryId($galleryid)
    {
        $query = "DELETE FROM {$this->tableName} WHERE gallery_id=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $galleryid);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function deleteImage($username, $imagename){

        unlink('data/images/' . strtolower($username) . '/'. $imagename);
        unlink('data/thumbnails/' . strtolower($username) . '/'. $imagename);

        $query = "DELETE FROM {$this->tableName} WHERE image_name=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $imagename);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

    }
}