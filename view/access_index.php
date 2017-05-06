<?php if (Security::isLoggedIn()) header("Location: /gallery") ?>
<h1>Login</h1>
    <hr/>
<?php

$form = new Form('/access/doLogin');
if(isset($_SESSION["errorLogin"])){
    echo $_SESSION["errorLogin"];
    unset($_SESSION['errorLogin']);
}
echo $form->text()->name('username')->placeholder('name')->type('text');
echo $form->text()->name('password')->placeholder('password')->type('password');
echo $form->submit()->label('Login')->name('send');

$form->end();

?>