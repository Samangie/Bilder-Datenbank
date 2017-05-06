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
        $userid = $_SESSION['userid'];
        $galleryCategoryRepository = new GalleryCategoryRepository();
        $view->gallery = $galleryCategoryRepository->readByUserId($userid);
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
            $title = htmlspecialchars($_POST['title']);
            $user = $_SESSION['userid'];
            $description = htmlspecialchars($_POST['description']);
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
        $view->gallery = $galleryCategoryRepository->readByUserId($_SESSION['userid']);
        $view->display();
    }

    public function doUpload()
    {
        if ($_POST['post']) {
            $title = htmlspecialchars($_POST['title']);
            $org_image_name = htmlspecialchars($_FILES['image']['name']);
            $filesize=$_FILES['image']['size'];
            $image_path = $_FILES['image']['tmp_name'];
            $galler_id = $_POST['galleryid'];
            $username = htmlspecialchars($_SESSION['username']);
            $galleryimageRepository = new GalleryImageRepository();
            $image_name = $org_image_name;

            $validate = new Validate();
            $mistakeTitle = $validate->validateText($title, 'Title');
            if($mistakeTitle == false){
                header('Location: /gallery/upload');
                return false;
            }
            $mistakeSize = $validate->validateImageSize($filesize);
            if($mistakeSize == false){
                header('Location: /gallery/upload');
                return false;
            }

            $imageFileType = pathinfo($org_image_name,PATHINFO_EXTENSION);

            if (!$galleryimageRepository->uploadImage($title,$image_name, $image_path, $imageFileType, $galler_id, $username )){
                header("Location: /gallery/upload");
            }else {
                header("Location: /");
            }
        }
    }

    public function editImage(){
        $view = new View('gallery_editImage');
        $view->title = 'Gallery';
        $view->heading = 'Gallery';
        $galleryImageRepository = new GalleryImageRepository();
        $galleryCategoryRepository = new GalleryCategoryRepository();
        $gallery_id = $_GET['galleryid'];
        $view->gallery = $galleryCategoryRepository->readById($gallery_id);
        $view->images = $galleryImageRepository->readyByGalleryId($gallery_id);
        $view->display();
    }

    public function deleteImage(){
        $galleryimageRepository = new GalleryImageRepository();
        $galleryimageRepository->deleteImage($_SESSION['username'], $_GET['imagename']);
        header("Location:  ". $_SERVER['HTTP_REFERER']);
    }

    public function deleteCategory(){
        $galleryCategoryRepository = new GalleryCategoryRepository();
        $galleryimageRepository = new GalleryImageRepository();
        $galleryid = $_GET['galleryid'];

        if($galleryid != $_SESSION['userid']) header("Location: /gallery");
        $galleryimageRepository->deleteByGalleryId($galleryid);
        $galleryCategoryRepository->deleteById($galleryid);

        header("Location: /gallery");
    }


}