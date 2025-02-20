<?php
require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class TestimonialController extends RestController
{
    public function testimonials_get()
    {
        $this->load->model('TestimonialModel');
        $testimonial = new TestimonialModel();
        $result = $testimonial->getTestimonials();
        $this->response($result,200);
    }
}
?>