<?php

namespace Modules\JoinMurarkey\Contracts;

interface JoinMurarkeyService
{
    public function findById($id);
    public function getAll();
    public function getAllFeatured();
    public function create($data);
    public function update($id, $data);
    public function delete($id);

}
