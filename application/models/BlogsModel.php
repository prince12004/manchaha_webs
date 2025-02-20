<?php
class BlogsModel extends CI_Model
{
    public function getAllBlogs()
    {
        $query = $this->db->get('blogs');
        return $query->result();
    }
}

?>