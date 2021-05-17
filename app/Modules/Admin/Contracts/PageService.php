<?php


namespace Modules\Admin\Contracts;


interface PageService
{

    public function getPaginated();

    public function create($data);

    public function findById($id);

    public function update($id, $data);

    public function delete($id);

    public function findBySlug($slug);

    public function processContactForm($data);

    public function getContactUsList();

    public function updateContactUsStatus($id, $status);

    public function getContactUsById($id);
}