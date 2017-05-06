<?php if (!Security::isLoggedIn()) header("Location: /access/register");
?>

    <h1>Profil</h1>
<hr/>
<?php if (empty($userinfo)): ?>
    <div class="no-data">
        <h3>Ein Fehler ist aufgetreten!</h3>
    </div>
<?php else: ?>
        <?php echo '<strong>Benutzername:</strong> ' . $userinfo->username . '<br/>
                    <strong>Email: </strong> '. $userinfo->email . '<br/><br/>';
        ?>
    <a href="/access/delete">
        <button class="btn btn-primary">Benutzer löschen</button></a>
    </a>
<?php endif ?>