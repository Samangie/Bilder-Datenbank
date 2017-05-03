<?php
$form = new Form('/gallery/doUpload');
echo "<div class='form-group'><div class=\"col-md-12\">";
echo "<select name='galleryid'>";
foreach ($gallery as $cat) {
    echo "<option value='$cat->id'>$cat->title</option>";
}
echo "</select></div></div>";
if(isset($_SESSION["errorTitle"])){
    echo $_SESSION["errorTitle"];
    unset($_SESSION['errorTitle']);
}
echo $form->text()->name('title')->placeholder('title')->type('text');
if(isset($_SESSION["errorImage"])){
    echo $_SESSION["errorImage"];
    unset($_SESSION['errorImage']);
}
echo '<p style="font-style:italic;">The filetype must be: png, jpg, jpeg!</p>';
//echo '<input type="file" class="filestyle" data-classButton="btn btn-primary" data-input="false" data-classIcon="icon-plus" data-buttonText="Your label here.">';
echo $form->text()->name('image')->placeholder('image')->type('file');
echo $form->submit()->label('Post')->name('post');
$form->end();
?>