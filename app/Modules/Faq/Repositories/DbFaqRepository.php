<?php

namespace Modules\Faq\Repositories;

use App\Models\Faq;
use Modules\Faq\Contracts\FaqRepository;

class DbFaqRepository implements FaqRepository
{
    public function getAll()
    {
        return Faq::paginate(15);
    }
    public function create($data)
    {
        return Faq::create($data);
    }
    public function findById($id)
    {
        return Faq::findOrFail($id);
    }
    public function update($id, $data)
    {
        return Faq::where('id', $id)->update($data);
    }
    public function delete($id)
    {
        $obj = $this->findById($id);
        return $obj->delete();
    }

}
