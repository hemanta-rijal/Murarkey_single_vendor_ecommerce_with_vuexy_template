<?php

namespace Modules\ServiceCategories\Repositories;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Modules\ServiceCategories\Contracts\ServiceCategoryRepository;

class DbServiceCategoryRepository implements ServiceCategoryRepository
{
    public function create(array $data): ServiceCategory
    {
        return ServiceCategory::create($data);

    }

    public function findById(int $id)
    {
        return ServiceCategory::findOrFail($id);
    }
    public function findBySlug($slug)
    {
        return ServiceCategory::whereSlug($slug)->first();
    }
    public function getFeaturedCategories()
    {
        return ServiceCategory::where('featured', true)->where('parent_id', null)->get();
    }

    public function update(int $id, array $data)
    {
        return ['status' => $this->findById($id)->update($data)];
    }

    public function delete(int $id)
    {
        $node = $this->findById($id);

        return $node->delete();
    }

    public function getPaginated(int $number)
    {
        return ServiceCategory::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

    public function lists()
    {
        return ServiceCategory::withDepth()->having('depth', '<', 4)->pluck('name', 'id')->all();
    }

    public function getTree()
    {
        return ServiceCategory::orderBy('_lft', 'ASC')->get()->where('featured', true)->toTree();
    }

    public function updateOrder($data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data as $item) {
                DB::table('categories')->where('id', $item['id'])->update($item);
            }

        });
    }

    public function insertMany($data)
    {
        ServiceCategory::insert($data);
        ServiceCategory::fixTree();
    }

    public function getAll()
    {
        return ServiceCategory::all();
    }

    public function getRootCategories()
    {
        return ServiceCategory::whereIsRoot()->get();
    }

    public function getChildren($id)
    {
        return ServiceCategory::whereParentId($id)->get();
    }

    public function getCategoryBySlug($slug)
    {
        return ServiceCategory::where('slug', $slug)->first();
    }

    public function getCategoryAndDescendantBySlug($slug)
    {
        $category = $this->getCategoryBySlug($slug);
        if ($category) {
            return ServiceCategory::whereDescendantOrSelf($category->id)->get();
        }

    }

    public function getCategoryWithChildrenAndParent($category)
    {
        $category = ServiceCategory::withDepth()->whereSlug($category)->first();

        $categories = ServiceCategory::whereAncestorOf($category->id)->orWhereDescendantOf($category->id)->get();

        $categories->push($category);

        $categories = $categories->toTree();

        switch ($category->depth) {
            case 1:
                $searchIds = $categories[0]->where('id', $category->id)->first()->children->pluck('id');

                break;
            case 2:
                $searchIds = [$category->id];
                break;
            default:
                throw new ModelNotFoundException();
                break;
        }

        return compact('categories', 'searchIds');
    }

    public function getCategoryAndChildren($categoryId)
    {
        return ServiceCategory::whereDescendantOrSelf($categoryId)->get();
    }

    public function alterProductCount($type, $categoryId)
    {

        return ServiceCategory::whereIn('id', ServiceCategory::ancestorsOf($categoryId)->pluck('id')->push($categoryId))->{$type}('product_count');
    }

    public function getCategoryParentAndChild($category)
    {
        $categories = ServiceCategory::whereAncestorOf($category->id)->orWhereDescendantOf($category->id)->get();

        $categories->push($category);

        return $categories;
    }
    public function getParentCategoryOnly()
    {
        return ServiceCategory::where('parent_id', null)->get();
    }

    public function getSibling($categoryId)
    {
        $category = $this->findById($categoryId);
        return ServiceCategory::where('parent_id', $category->parent_id)->get();
    }

    public function getChildCategoryOnly()
    {
        return ServiceCategory::where('parent_id', '=!', null)->get();
    }

}
