<?php

$form = new Form('/user/doCreate');

if(isset($_SESSION["errorValidUsername"])){
    echo $_SESSION["errorValidUsername"];
    unset($_SESSION['errorValidUsername']);
}

if(isset($_SESSION["errorUsername"])){
    echo $_SESSION["errorUsername"];
    unset($_SESSION['errorUsername']);
}

echo $form->text()->placeholder('Benutzername')->name('username')->type('text');

if(isset($_SESSION["errorValidEmail"])){
    echo $_SESSION["errorValidEmail"];
    unset($_SESSION['errorValidEmail']);
}

if(isset($_SESSION["errorEmail"])){
    echo $_SESSION["errorEmail"];
    unset($_SESSION['errorEmail']);
}
echo $form->text()->placeholder('Mail')->name('email')->type('email');

if(isset($_SESSION["errorSamePassword"])){
    echo $_SESSION["errorSamePassword"];
    unset($_SESSION['errorSamePassword']);
}
if(isset($_SESSION["errorPassword"])){
    echo $_SESSION["errorPassword"];
    unset($_SESSION['errorPassword']);
}
echo $form->text()->placeholder('Passwort')->name('password')->type('password');
echo $form->text()->placeholder('Passwort wiederholen')->name('confpassword')->type('password');
echo $form->submit()->label('Registrieren')->name('send');

$form->end();
