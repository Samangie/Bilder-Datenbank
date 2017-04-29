<?php
require_once '../repository/AccessRepository.php';
/**
 * Created by PhpStorm.
 * User: bhawks
 * Date: 15.03.2017
 * Time: 11:15
 */
class Validate
{

    /**
     * Überprüft den mitgegebenen Wert länger als 0 ist.
     *
     * @param $text die Eingabe welche überprüft wird
     * @param $type Typ der Eingabe zb Username
     * @return bool true wenn die Validation erfolgreich war
     */
    public function validateText($text, $type)
    {
        if(strlen($text) > 0){
            return true;
        }
        $errorTitle = "error" . $type;
        $_SESSION[$errorTitle] = '<p style="color:red;">Invalid ' . $type .'!</p>';
        return false;
    }

    /**
     * Überprüft den mitgegebenen Wert dem Password-Pattern entspricht
     *
     * @param $password die Eingabe welche überprüft wird
     * @return bool true wenn die Validation erfolgreich war
     */
    public function validatePw($password)
    {
        if(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $password)){
            return true;
        }
        $_SESSION["errorPw"] = '<p style="color:red;">Invalid password!</p>';
        return false;
    }

    /**
     * Überprüft den mitgegebenen Wert der selbe Wert ist wie $password
     *
     * @param $password die Eingabe welche mit der Variable $confpassword verglichen wird
     * @param $confpassword die Eingabe welche mit der Variable $password verglichen wird
     * @return bool true wenn die Validation erfolgreich war
     */
    public function confirmPw($confpassword, $password)
    {
        if($confpassword == $password){
            return true;
        }
        $_SESSION["errorconfPw"] = '<p style="color:red;">Not the same password!</p>';
        return false;
    }

    /**
     * Überprüft den mitgegebenen Wert ob dieser bereits exisitiert
     *
     * @param $type Spaltenname welche überprüft werden soll
     * @param $value die Eingabe welche überprüft wird
     * @return bool true wenn die Eingabe noch nicht existiert
     */
    public function uniqueValue($value, $type) {
        $query = "SELECT `id` FROM `access_user` WHERE `$type` = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (!$statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }

        $statement->bind_param('s', $value);

        if(!$statement->execute()) {
            throw new Exception($statement->error);
        };

        $result = $statement->get_result();
        $user = $result->fetch_assoc();
        if($user['id'] == 0){
            return true;
        }
        $errorTitle = "error" . $type;
        $_SESSION[$errorTitle] = '<p style="color:red;">'. $type .  ' exists already!</p>';
        return false;

    }

    /**
     * Überprüft den mitgegebenen Wert länger als 0 ist und nicht länger als 10.
     *
     * @param $title die Eingabe welche überprüft wird
     * @return bool true wenn die Validation erfolgreich war
     */
    public function validateImageTitle($title)
    {
        if(strlen($title) > 0 && strlen($title)<= 10){
            return true;
        }
        $_SESSION["errorTitle"] = '<p style="color:red;">Invalid title!</p>';
        return false;
    }

}