<?php

class Security
{
    /* *
     *
     * Überprüft ob SESSION "loggedin" existiert
     *
     * */
    public static function isLoggedIn() {
        return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['userid']) );
    }
    /* *
    *
    * Überprüft ob SESSION "user" existiert
    *
    * */
    public static function getUsername() {
        return (isset($_SESSION['user'])) ? $_SESSION['user'] : "NOT LOGGED IN";
    }
    /* *
    *
    * Überprüft ob SESSION "isAdmin/loggedin" existiert (Wert 1 = Admin)
    *
    * */
    public static function isAdmin(){
        return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1);
    }

}