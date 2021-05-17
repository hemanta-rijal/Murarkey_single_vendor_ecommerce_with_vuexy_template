<?php


namespace Modules\Categories\Repositories;


use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Modules\Categories\Contracts\CategoryRepository;

class DbCategoryRepository implements CategoryRepository
{
    public function create(array $data) : Category
    {
        return Category::create($data);
    }

    public function findById(int $id)
    {
        return Category::findOrFail($id);
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
        return Category::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

    public function lists()
    {
        return Category::withDepth()->having('depth', '<', 4)->pluck('name', 'id')->all();
    }

    public function getTree()
    {
        return Category::orderBy('_lft', 'ASC')->get()->toTree();
    }

    public function updateOrder($data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data as $item)
                DB::table('categories')->where('id', $item['id'])->update($item);
        });
    }

    public function insertMany($data)
    {
        Category::insert($data);
        Category::fixTree();
    }

    public function getAll()
    {
        return Category::all();
    }

    public function getRootCategories()
    {
        return Category::whereIsRoot()->get();
    }

    public function getChildren($id)
    {
        return Category::whereParentId($id)->get();
    }


    public function getCategoryBySlug($slug)
    {
        return Category::whereSlug($slug)->firstOrFail();
    }


    public function getCategoryAndDescendantBySlug($slug)
    {
        $category = $this->getCategoryBySlug($slug);

        return Category::whereDescendantOrSelf($category->id)->get();
    }

    public function getCategoryWithChildrenAndParent($category)
    {
        $category = Category::withDepth()->whereSlug($category)->firstOrFail();


        $categories = Category::whereAncestorOf($category->id)->orWhereDescendantOf($category->id)->get();

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
                throw  new ModelNotFoundException();
                break;
        }

        return compact('categories', 'searchIds');
    }

    public function getCategoryAndChildren($categoryId)
    {
        return Category::whereDescendantOrSelf($categoryId)->get();
    }

    public function alterProductCount($type, $categoryId)
    {

        return Category::whereIn('id', Category::ancestorsOf($categoryId)->pluck('id')->push($categoryId))->{$type}('product_count');
    }

    public function getCategoryParentAndChild($category)
    {
        $categories = Category::whereAncestorOf($category->id)->orWhereDescendantOf($category->id)->get();

        $categories->push($category);

        return $categories;
    }



}