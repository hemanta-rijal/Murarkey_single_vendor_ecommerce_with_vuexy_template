<?php


namespace Modules\Companies\Contracts;


interface CompanyRepository
{
    public function create($company);

    public function lists();

    public function findById($id);

    public function findBySlug($slug);

    public function getPaginated($type = null);

    public function getCompanyCountByStatus($key);

    public function getTrashedItemById($id);

    public function getTrashItems();

    public function search($keywords);

    public function findBySlugAndApproved($slug);
}