<?php

namespace Modules\Faq\Contracts;

interface FaqServiceRepository
{
    public function getAll();

    public function create($data);

    public function findById($id);

    public function delete($id);

    public function update($id, $data);
}
