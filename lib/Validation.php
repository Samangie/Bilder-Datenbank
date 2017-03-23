<?php

/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 16.03.2017
 * Time: 15:44
 */
class Validation
{

    public function validateText($value, $type) {

        if(isset($value) && strlen(trim($value))){
            return true;
        }

        $this->createErrorSession($type, 'Invalid');
        return false; 

    }

    public function validateEmail($value, $type) {

        if(preg_match("/FILTER_VALIDATE_EMAIL/", $value)){
            return true;
        }
        $this->createErrorSession($type, 'Invalid');
        return false;
    }

    public function validatePassword($value, $type) {

        if(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,}$/', $value)){
            return true;
        }
        $this->createErrorSession($type, 'Invalid');
        return false;
    }

    public function checkPassword($value, $valueToCheck, $type) {

        if($value == $valueToCheck) {
            return true;
        }
        $this->createErrorSession($type, 'Different');
        return false;
    }

    public function existText($value, $type) {

        $query = "SELECT id FROM `user` WHERE $type = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('s', $value);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        $result = $statement->get_result();

        if(mysqli_num_rows($result) == 0) {
            return true;
        }

        $this->createErrorSession($type, 'Invalid');
        return false;
    }

    function createErrorSession($type, $errorType) {
        $errorMessage = 'error' . $type;
        if($errorType == 'Exist'){
            $errorContent = '<p class="warning">Eingabe existiert bereits!</p>';
        }else if ($errorType == 'Different') {
            $errorContent = '<p class="warning">Nicht das selbe Passwort!</p>';
        }else {
            $errorContent = '<p class="warning">Invalide Eingabe!</p>';
        }

        $_SESSION[$errorMessage] = $errorContent;
    }
}