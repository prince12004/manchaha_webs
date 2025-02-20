<?php
class TestimonialModel extends CI_Model
{
    public function getTestimonials()
    {
        $query = $this->db->get('testimonials');
        return $query->result();
    }
}
?>