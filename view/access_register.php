<?php if (Security::isLoggedIn()) header("Location: /gallery") ?>

<h1>Registrieren</h1>
<hr/>
<?php
$form = new Form('/access/doRegister');
if(isset($_SESSION["errorUsername"])){
    echo $_SESSION["errorUsername"];
    unset($_SESSION['errorUsername']);
}
if(isset($_SESSION["errorexistUsername"])){
    echo $_SESSION["errorexistUsername"];
    unset($_SESSION['errorexistUsername']);
}
echo $form->text()->name('username')->placeholder('name')->type('text');
if(isset($_SESSION["errorEmail"])){
    echo $_SESSION["errorEmail"];
    unset($_SESSION['errorEmail']);
}
if(isset($_SESSION["errorexistEmail"])){
    echo $_SESSION["errorexistEmail"];
    unset($_SESSION['errorexistEmail']);
}
echo $form->text()->name('email')->placeholder('email')->type('email');
if(isset($_SESSION["errorPw"])){
    echo $_SESSION["errorPw"];
    unset($_SESSION['errorPw']);
}
echo '<p style="font-style:italic;">mindestes 8 Zeichen, 1 Grossbuchstabe, 1 Zahl und 1 Spezialzeichen</p>';
echo $form->text()->name('password')->placeholder('password')->type('password');
if(isset($_SESSION["errorconfPw"])){
    echo $_SESSION["errorconfPw"];
    unset($_SESSION['errorconfPw']);
}
echo $form->text()->name('confpassword')->placeholder('confirm password')->type('password');
echo $form->submit()->label('Register')->name('send');
$form->end();
?>
