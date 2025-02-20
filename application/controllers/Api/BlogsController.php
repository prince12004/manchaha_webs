<?php
require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class BlogsController extends RestController{
    public function blogs_get()
    {
        $this->load->model('BlogsModel');
        $blogs = new BlogsModel();
        $result = $blogs->getAllBlogs();
        return $this->response($result,200);
    }
}
?>