<?php if (!Security::isLoggedIn()) header("Location: /access/register");
?>
<?php if (empty($gallery)): ?>
        <h2>Oops! No posts found!</h2>
<?php else: ?>
    <?php foreach ($gallery as $category): ?>
        <?php echo '<a href="/gallery/detail?galleryid='. $category->id . '">' . $category->title . '</a>'?>
    <?php endforeach ?>
<?php endif ?>