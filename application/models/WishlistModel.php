<?php
class WishlistModel extends CI_Model
{
    public function getWishlist($id)
{
    $query = $this->db->where('userID', $id)
                      ->get('wishlist');
                      
    return $query->result();
}

}


?>