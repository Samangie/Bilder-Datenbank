<?php

$form = new Form('/user/doCreate');

echo $form->text()->placeholder('Benutzername')->name('username')->type('text');
echo $form->text()->placeholder('Mail')->name('email')->type('email');
echo $form->text()->placeholder('Passwort')->name('password')->type('password');
echo $form->submit()->label('Registrieren')->name('send');

$form->end();
