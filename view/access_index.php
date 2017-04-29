<div id="content">
    <div class="image-row">
        <div class="image-wrapper">
            <h1 id="login">Login to WatchMeUp</h1>

            <?php

            $form = new Form('/access/doLogin');
            if(isset($_SESSION["errorLogin"])){
                echo $_SESSION["errorLogin"];
                unset($_SESSION['errorLogin']);
            }
            echo $form->text()->name('username')->placeholder('name')->type('text');
            echo $form->text()->name('password')->placeholder('password')->type('password');
            echo "<input type=\"button\" value=\"No Login yet?\" onclick=\"window.location='/access/register';\">";
            echo $form->submit()->label('Login')->name('send');

            $form->end();

            ?>
            <br/>
            <br/>
            <p class="warning">Dieser User exisitert nicht oder das falsche Passwort wurde eingegeben.</p>
        </div>
    </div>
</div>
