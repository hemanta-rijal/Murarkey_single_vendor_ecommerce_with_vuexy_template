<?php

namespace Modules\Testimonial\Repositories;

use App\Models\Testimonial;
use Modules\Testimonial\Contracts\TestimonialRepository;

class DbTestimonialRepository implements TestimonialRepository
{
    public function create($data): Testimonial
    {
        return Testimonial::create($data);
    }

    public function findById($id)
    {
        return Testimonial::findOrFail($id);
    }
    public function findBySlug($slug)
    {
        return Testimonial::where('slug', $slug)->get();
    }

    public function getAll()
    {
        return Testimonial::all();
    }
    public function update($id, $data)
    {
        return $this->findById($id)->update($data);
    }

    public function delete($id)
    {
        $node = $this->findById($id);

        return $node->delete();
    }

    public function getPaginated($number)
    {
        return Category::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

}
