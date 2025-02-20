<?php
require APPPATH . 'libraries/RestController.php';
// use Restserver\Libraries\REST_Controller;
use chriskacerguis\RestServer\RestController;
class CategoryController extends RestController{
 public function catrgory_get()
 {
    $this->load->model('CategoryModel');
    $category = new CategoryModel();
    $result = $category->getCategories();
    $this->response($result,200);
 }

 public function AddCategory_post()
 {
    $this->load->model('CategoryModel');
    $category = new CategoryModel();
    $result = $category->addCategories();
    
    $this->response($result,200);
 }

}
?>