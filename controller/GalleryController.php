<?php
require_once '../repository/GalleryCategoryRepository.php';

class GalleryController
{
    public function index()
    {
        $view = new View('gallery_index');
        $view->title = 'Gallery';
        $view->heading = 'Gallery';
        $galleryRepository = new GalleryCategoryRepository();
        $view->gallery = $galleryRepository->readAll();
        $view->display();
    }

    public function create()
    {
        $view = new View('gallery_create');
        $view->title = 'Create Gallery';
        $view->heading = 'Create Gallery';
        $view->display();
    }

    public function doCreate()
    {
        if ($_POST['send']) {
            $title = $_POST['title'];
            $user = $_SESSION['userid'];

            $galleryCategoryRepository = new GalleryCategoryRepository();
            $galleryCategoryRepository->createGallery($title, $user);

            header("Location: /gallery");
        }

    }

}