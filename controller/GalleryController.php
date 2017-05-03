<?php
require_once '../repository/GalleryCategoryRepository.php';
require_once '../repository/GalleryImageRepository.php';

class GalleryController
{
    public function index()
    {
        $view = new View('gallery_index');
        $view->title = 'Gallery';
        $view->heading = 'Gallery';
        $galleryCategoryRepository = new GalleryCategoryRepository();
        $view->gallery = $galleryCategoryRepository->readAll();
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
            $description = $_POST['description'];
            $galleryCategoryRepository = new GalleryCategoryRepository();
            $galleryCategoryRepository->createGallery($title, $user, $description);

            header("Location: /gallery");
        }

    }

    public function detail()
    {
        $view = new View('gallery_detail');
        $view->title = 'Gallery';
        $view->heading = 'Gallery';
        $galleryImageRepository = new GalleryImageRepository();
        $galleryCategoryRepository = new GalleryCategoryRepository();
        $gallery_id = $_GET['galleryid'];
        $view->gallery = $galleryCategoryRepository->readById($gallery_id);
        $view->images = $galleryImageRepository->readyByGalleryId($gallery_id);
        $view->display();
    }

    public function upload()
    {
        $imageRepository = new GalleryImageRepository();
        $view = new View('gallery_upload');
        $view->title = 'Upload';
        $view->heading = 'Upload';
        $view->image = $imageRepository->readAll();
        $galleryCategoryRepository = new GalleryCategoryRepository();
        $view->gallery = $galleryCategoryRepository->readAll();
        $view->display();
    }

    public function doUpload()
    {
        if ($_POST['post']) {
            $title = $_POST['title'];
            $org_image_name = $_FILES['image']['name'];
            $image_path = $_FILES['image']['tmp_name'];
            $galler_id = $_POST['galleryid'];
            $username = $_SESSION['username'];
            $userid = $_SESSION['userid'];
            $galleryimageRepository = new GalleryImageRepository();

            $image_name = $org_image_name;

            /**
             *
             * Validations Funktionen werden aufgerufen, falls nicht valide wird eine Session Variable erstellt welche
             * im image_upload.php aufgerufen wird.
             *
             */
            $validate = new Validate();
            $mistakeTitle = $validate->validateImageTitle($title);
            if($mistakeTitle == false){
                header('Location: /image/upload');
                return false;
            }
            /**
             *
             * Validiert ob File ein jpg, jpeg, png oder gif ist
             * Falls dies der Fall ist wird ein Cookie gesetzt welches im image_upload.php aufgerufen wird.
             *
             */
            $imageFileType = pathinfo($org_image_name,PATHINFO_EXTENSION);

            if (!$galleryimageRepository->uploadImage($title,$image_name, $image_path, $imageFileType, $galler_id, $username )){
                header("Location: /gallery/upload");
            }else {
                header("Location: /");
            }
        }
    }


}