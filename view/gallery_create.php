<?php
/**
 * Created by PhpStorm.
 * User: sonny
 * Date: 27.04.2017
 * Time: 14:48
 */

$form = new Form('/gallery/doCreate');
echo $form->text()->placeholder('Titel')->name('title')->type('text');
echo $form->submit()->label('Kategorie anlegen')->name('send');
$form->end();
