<?php

require_once '../repository/UserRepository.php';
require_once '../lib/Validation.php';

class UserController
{
    public function index()
    {
        $view = new View('user_index');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function create()
    {
        $view = new View('user_create');
        $view->title = 'Registrieren';
        $view->heading = 'Registrieren';
        $view->display();
    }

    public function logout()
    {
        $view = new View('user_logout');
        $view->title = 'Logout';
        $view->heading = 'Logout';

        unset($_SESSION['loggedin']);
        session_destroy();
        header('Location: /');
        exit ('Sie konnten nicht Abgemeldet werden. Versuchen Sie es erneut.');
    }

    public function doCreate()
    {
        if ($_POST['send']) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confpassword = $_POST['confpassword'];

            $userRepository = new UserRepository();
            $userRepository->create($username, $email, $password);

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                header('Location: /');
            }

        }

    }

    public function doLogin()
    {
        if ($_POST['send']) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userRepository = new UserRepository();
            $userRepository->login($username, $password);
            header('Location: /user');
        }
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            header('Location: /');
        }
        else{
            $_SESSION["errorLogin"] = '<p style="color:red;">Wrong username or password!</p>';
            header('Location: /user');
        }
    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
