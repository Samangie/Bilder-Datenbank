<?php
require_once '../repository/AccessRepository.php';

class Validate
{

    /**
     * Check if the text is not 0
     *
     * @param $text the value to be checked
     * @param $type the type of the value e.g 'Username'
     * @return bool true if valdiation is successful
     */
    public function validateText($text, $type)
    {
        if(strlen($text) > 0){
            return true;
        }
        $errorTitle = "error" . $type;
        $_SESSION[$errorTitle] = '<p style="color:red;">Invalider ' . $type .'!</p>';
        return false;
    }

    /**
     * Check the value with the password-pattern
     *
     * @param $password the value to be checked
     * @return bool true if valdiation is successful
     */
    public function validatePw($password)
    {
        if(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $password)){
            return true;
        }
        $_SESSION["errorPw"] = '<p style="color:red;">Invalides Passwort!</p>';
        return false;
    }

    /**
     * Check if the value is the same as $password
     *
     * @param $password the value wich check with the variable $confpassword
     * @param $confpassword the value wich check with the variable $password
     * @return bool true if valdiation is successful
     */
    public function confirmPw($confpassword, $password)
    {
        if($confpassword == $password){
            return true;
        }
        $_SESSION["errorconfPw"] = '<p style="color:red;">Nicht das selbe Passwort!</p>';
        return false;
    }

    /**
     * Check if the value exist
     *
     * @param $type attribute which is to be checked
     * @param $value value which is checked
     * @return bool true if value not exists
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
        $_SESSION[$errorTitle] = '<p style="color:red;">'. $type .  ' exsitiert bereits!</p>';
        return false;

    }

    /**
     * Check if the value exist
     *
     * @param $size size of the file
     * @return bool true if value not higher than 4MB
     */

    public function validateImageSize($size){
        if($size < 4000000){
            return true;
        }

        $_SESSION["errorSize"] = '<p style="color:red;">Das Bild darf nicht grösser als 4MB sein </p>';
        return false;
    }
}