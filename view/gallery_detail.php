<?php if($gallery->user_id != $_SESSION['userid']) header("Location: /gallery") ?>
<div id="gallery">
    <h1>Gallery <?= $gallery->title ?></h1>
    <p>
        <?= $gallery->description ?>
    </p>
    <hr />
    <?php echo '<a href="/gallery/upload"><button class="btn btn-primary">Bild hochladen</button></a>';?>
<?php if (empty($images)): ?>
    <div class="no-data">
        <h3>Keine Bilder gefunden!</h3>
    </div>
<?php else: ?>
    <?php echo '<a href="/gallery/editImage?galleryid='. $gallery->id .'"><button class="btn btn-primary"> Bilder bearbeiten</button></a>';?>
    <div class="row" id="lightgallery">
    <?php foreach ($images as $image): ?>
        <div class="col-md-4 col-sm-6 col-xs-12 image">
            <?php
                echo '<h3>' . $image->title .'</h3>';
                echo '<a href="/data/images/'. $_SESSION["username"] . "/" . $image->image_name .'" data-lightbox="'. $gallery->title .'">';
                echo '<img src="/data/thumbnails/'. $_SESSION["username"] . "/" . $image->image_name .'"/>';
                echo '</a>';
            ?>
        </div>
    <?php endforeach ?>
    </div>
<?php endif ?>
</div>
