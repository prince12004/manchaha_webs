<?php
require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class ContactController extends RestController
{
    public function contactRequest_get()
    {
        $this->load->model('ContactModel');
        $contact = new ContactModel();
        $result = $contact->getContact();
        return $this->response($result,200);
    }
}
?>