<?php

$form = new Form('/user/doLogin');
if(isset($_SESSION["errorLogin"])){
    echo $_SESSION["errorLogin"];
    unset($_SESSION['errorLogin']);
}
echo $form->text()->placeholder('Benutzername')->name('username')->type('text');
echo $form->text()->placeholder('Passwort')->name('password')->type('password');
echo $form->submit()->label('Registrieren')->name('send');

?>