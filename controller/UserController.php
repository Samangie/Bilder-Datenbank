<?php

require_once '../repository/UserRepository.php';

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
            $password = 'password';

            $userValidation = new Validate();


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
