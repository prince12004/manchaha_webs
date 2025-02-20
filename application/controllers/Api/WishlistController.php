<?php
require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class WishlistController extends RestController
{
    public function wishlist_get()
    {
        $this->load->model('WishlistModel');
        $wishlist = new WishlistModel();

        $id = $this->get('id'); 

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'No ID was provided'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            $result = $wishlist->getWishlist($id);
            if ($result) {
                $this->response($result, RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No wishlist found for the provided ID'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }
}
?>
