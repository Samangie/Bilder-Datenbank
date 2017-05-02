<?php
$form = new Form('/gallery/doUpload');
echo "<select name='galleryid'>";
foreach ($gallery as $cat) {
    echo "<option value='$cat->id'>$cat->title</option>";
}
echo "</select>";
if(isset($_SESSION["errorTitle"])){
    echo $_SESSION["errorTitle"];
    unset($_SESSION['errorTitle']);
}
echo '<p style="font-style:italic;">The title can in maximum contain 10 chars!</p>';
echo $form->text()->name('title')->placeholder('title')->type('text');
if(isset($_SESSION["errorImage"])){
    echo $_SESSION["errorImage"];
    unset($_SESSION['errorImage']);
}
echo '<p style="font-style:italic;">The filetype must be: png, jpg, jpeg!</p>';
echo $form->text()->name('image')->placeholder('image')->type('file');
echo $form->submit()->label('Post')->name('post');
$form->end();
?>