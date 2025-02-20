<?php
class ContactModel extends CI_Model
{
    public function getContact()
    {
        $query = $this->db->get('contacts');
        return $query->result();
    }
}
?>