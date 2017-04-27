<?php if (empty($gallery)): ?>
        <h2>Oops! No posts found!</h2>
<?php else: ?>
    <?php foreach ($gallery as $onegallery): ?>
        <?= $onegallery->title;?>
    <?php endforeach ?>
<?php endif ?>