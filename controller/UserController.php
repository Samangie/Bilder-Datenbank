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

    public function doCreate()
    {
        if ($_POST['send']) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confpassword = $_POST['confpassword'];

            $userValidation = new Validation();

            $userValidation->validateText($username, 'ValidUsername');
            $userValidation->existText($username, 'Username');

            $userValidation->validateEmail($email, 'ValidEmail');
            $userValidation->existEmail($email, 'Email');

            $userValidation->validatePassword($password, 'Password');
            $userValidation->checkPassword($password, $confpassword, 'SamePassword');

            $userRepository = new UserRepository();
            $userRepository->create($username, $email, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
