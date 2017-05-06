<?php if (!Security::isLoggedIn()) header("Location: /access/register");
?>

<h1>Übersicht alle Galerien</h1>
<hr/>
<?php if (empty($gallery)): ?>
        <h2>Keine Galerien gefunden!</h2>
<?php else: ?>
    <?php foreach ($gallery as $category): ?>
        <?php echo '<div class="gallery">
                        <a href="/gallery/detail?galleryid='. $category->id . '">
                            <button class="btn btn-primary">' . $category->title . '</button>
                        </a>
                        <div class="icon-box">
                            <a href="/gallery/deleteCategory?galleryid='. $category->id . '">
                                Löschen
                            </a>
                            <a href="/gallery/editCategory?galleryid='. $category->id . '">
                                Bearbeiten
                            </a>
                        </div>
                    </div>'
        ?>
    <?php endforeach ?>
<?php endif ?>