<?php

class Security
{
    /* *
     *
     * Check if SESSION "loggedin" exists
     *
     * */
    public static function isLoggedIn() {
        return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['userid']) );
    }
    /* *
    *
    * Check if SESSION "user" exists
    *
    * */
    public static function getUsername() {
        return (isset($_SESSION['user'])) ? $_SESSION['user'] : "NOT LOGGED IN";
    }
}