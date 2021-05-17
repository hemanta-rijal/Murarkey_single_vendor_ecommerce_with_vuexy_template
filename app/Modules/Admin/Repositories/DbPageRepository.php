<?php


namespace Modules\Admin\Repositories;


use App\Models\Page;
use Modules\Admin\Contracts\PageRepository;

class DbPageRepository implements PageRepository
{
    public function create($data) : Page
    {
        return Page::create($data);
    }

    public function findById($id)
    {
        return Page::findOrFail($id);
    }

    public function update($id, $data)
    {
        return ['status' => $this->findById($id)->update($data)];
    }

    public function delete($id)
    {
        return Page::destroy($id);
    }

    public function getPaginated(int $number)
    {
        return Page::paginate($number);
    }

    public function findBySlug($slug)
    {
        return Page::findBySlug($slug);
    }
}