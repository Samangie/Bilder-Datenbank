<?php

/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 16.03.2017
 * Time: 15:44
 */
class Validation
{

    private function validateText($value, $type) {

        if(preg_match('', $value)){
            return true;
        }

        $this->createErrorSession($type, 'Invalid');
        return false; 

    }

    private function validateEmail($value, $type) {

        if(preg_match('', $value)){
            return true;
        }
        $this->createErrorSession($type, 'Invalid');
        return false;
    }

    private function validatePassword($value, $type) {

        if(preg_match('', $value)){
            return true;
        }
        $this->createErrorSession($type, 'Invalid');
        return false;
    }

    private function existText($value, $type) {

        $query = "SELECT id FROM `user` WHERE $type = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $value);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        $result = $statement->get_result;

        if(mysqli_num_rows($result) == 0) {
            return true;
        }

        $this->createErrorSession($type, 'Invalid');
        return false;
    }

    private function createErrorSession($type, $errorType) {

        $errorMessage = 'errror' . $type;
        if($errorType == 'Exist'){
            $errorContent = '<p class="warning">Eingabe existiert bereits!</p>';
        }else {
            $errorContent = '<p class="warning">Invalide Eingabe!</p>';
        }
        $SESSION[$errorMessage] = $errorContent;

        header("location:javascript://history.go(-1)");
    }
}