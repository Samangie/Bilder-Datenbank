<?php

require_once '../repository/AccessRepository.php';
require_once '../lib/Validate.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class AccessController
{
    public function index()
    {
        $view = new View('access_index');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function register()
    {
        $view = new View('access_register');
        $view->title = 'Registration';
        $view->heading = 'Registration';
        $view->display();
    }

    public function logout()
    {
        $view = new View('access_logout');
        $view->title = 'Logout';
        $view->heading = 'Logout';
        session_start();
        unset($_SESSION['loggedin']);
        session_destroy();
        header('Location: /');
        exit ('Sie konnten nicht Abgemeldet werden. Versuchen Sie es erneut.');
    }

    public function doRegister()
    {
        if ($_POST['send']) {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password  = htmlspecialchars($_POST['password']);
            $confpassword = htmlspecialchars($_POST['confpassword']);

            $validate = new Validate();

            $mistakeName = $validate->validateText($username, "Username");
            $existUsername = $validate->uniqueValue($username, "Username");

            $mistakeEmail = $validate->validateText($email, "Email");
            $existEmail = $validate->uniqueValue($email, "Email");

            $mistakePw = $validate->validatePw($password);
            $mistakeconfPw = $validate->confirmPw($confpassword, $password);

            if($mistakeName == false || $existUsername == false || $mistakeEmail == false || $existEmail == false
                || $mistakePw == false || $mistakeconfPw == false){
                header('Location: /access/register');
                return;
            }

            $userRepository = new AccessRepository();
            $userRepository->register($username, $email, $password);

        }
        // Anfrage an die URI /user weiterleiten (HTTP 302)
        if ($_SESSION['loggedin'] == true){
            header('Location: /');
        }
    }

    public function doLogin()
    {
        if ($_POST['send']) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $userRepository = new AccessRepository();
            $userRepository->login($username, $password);
        }
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            header('Location: /');
        }
        else{
            $_SESSION["errorLogin"] = '<p style="color:red;">Wrong username or password!</p>';
            header('Location: /access');
        }
        // Anfrage an die URI /user weiterleiten (HTTP 302)
    }

    public function delete()
    {
        $userRepository = new AccessRepository();
        $userRepository->deleteById($_SESSION['userid']);
        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /access/logout');
    }

    public function profil(){
        $view = new View('access_profil');
        $view->title = 'Profil';
        $view->heading = 'Profil';
        $user_id = $_SESSION['userid'];
        $userRepository = new AccessRepository();
        $view->userinfo = $userRepository->readById($user_id);
        $view->display();
    }

}