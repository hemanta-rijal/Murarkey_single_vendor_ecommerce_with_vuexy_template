<?php

namespace Modules\Faq\Contracts;

interface FaqRepository
{
    public function getAll();

    public function create($data);

    public function findById($id);

    public function update($id, $data);

    public function delete($id);
}
