<?php

namespace Modules\JoinMurarkey\Contracts;

interface JoinMurarkeyRepository
{
    public function findById($id);
    public function getAll();
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
