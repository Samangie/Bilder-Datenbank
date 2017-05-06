<?php

if (!Security::isLoggedIn()) header("Location: /gallery");

$form = new Form('/gallery/doCreate');
echo $form->text()->placeholder('Titel')->name('title')->type('text');
echo $form->textarea()->placeholder('Beschreibung')->name('description');
echo $form->submit()->label('Kategorie anlegen')->name('send');
$form->end();
