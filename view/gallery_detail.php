<div id="gallery">
    <h1>Gallery <?= $gallery->title ?></h1>
    <p>
        <?= $gallery->description ?>
    </p>
    <hr />
<?php if (empty($images)): ?>
    <div class="no-data">
        <h3>Oops! No Images found!</h3>
    </div>
<?php else: ?>
    <div class="row" id="lightgallery">
    <?php foreach ($images as $image): ?>
        <div class="col-md-4 col-sm-6 col-xs-12 image">
            <?php
                echo '<h3>' . $image->title .'</h3>';
                echo '<a href="/data/images/'. $_SESSION["username"] . "/" . $image->image_name .'">';
                echo '<img src="/data/thumbnails/'. $_SESSION["username"] . "/" . $image->image_name .'"/>';
                echo '</a>';
            ?>
        </div>
    <?php endforeach ?>
    </div>
<?php endif ?>
</div>