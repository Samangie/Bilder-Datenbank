<?php if (!Security::isLoggedIn()) header("Location: /access/register");
?>

<h1>Übersicht alle Galerien</h1>
<hr/>
<?php echo '<a href="/gallery/create"><button class="btn btn-primary">Galerie erstellen</button></a>';?>
<?php if (empty($gallery)): ?>
    <div class="no-data">
        <h3>Keine Galerien gefunden!</h3>
    </div>
<?php else: ?>
    <?php foreach ($gallery as $category): ?>
        <?php echo '<div class="gallery row">
                        <div class="col-md-10 col-sm-9 col-xs-12">
                        <a href="/gallery/detail?galleryid='. $category->id . '">
                            <button class="btn btn-primary">' . $category->title . '</button>
                        </a>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12 icon-box">
                            <a href="/gallery/editCategory?galleryid='. $category->id . '">
                                Bearbeiten
                            </a>
                            |
                            <a href="/gallery/deleteCategory?galleryid='. $category->id . '">
                                Löschen
                            </a>
                        </div>
                    </div>'
        ?>
    <?php endforeach ?>
<?php endif ?>