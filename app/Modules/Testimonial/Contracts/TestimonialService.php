<?php

namespace Modules\Testimonial\Contracts;

interface TestimonialService
{
    public function findById($id);
    public function getAll();
    public function create($data);
    public function update($id, $data);
    public function delete($id);

}
