<?php

namespace Modules\Categories\Services;

use App\Models\Category;
use Modules\Categories\Contracts\CategoryRepository;
use Modules\Categories\Contracts\CategoryService as CategoryServiceContract;

class CategoryService implements CategoryServiceContract
{

    const DEFAULT_PAGINATION = 10;
    private $categoryRepository;

    public function __construct(CategoryRepository $repository)
    {
        $this->categoryRepository = $repository;
    }
    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function create(array $data): Category
    {

        return $this->categoryRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function findById(int $id)
    {
        return $this->categoryRepository->findById($id);
    }
    public function getFeaturedCategories()
    {
        return $this->categoryRepository->getFeaturedCategories();
    }

    public function delete(int $id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function getPaginated(int $number = null)
    {
        return $this->categoryRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

    public function getTree()
    {
        return $this->categoryRepository->getTree();
    }

    public function updateOrder($data)
    {
        set_time_limit(10000);
        $newData = array_map(function ($item) {
            $newItem['id'] = $item['item_id'];
            $newItem['parent_id'] = $item['parent_id'];
            $newItem['_lft'] = $item['left'];
            $newItem['_rgt'] = $item['right'];

            return $newItem;
        }, $data);

        return $this->categoryRepository->updateOrder($newData);
    }

    public function isSlugUnique($dataBaseCategories, $categories, $slug)
    {
        $dbCategory = $dataBaseCategories->where('slug', $slug)->first();

        $category = $categories->where('slug', $slug)->first();

        return !$dbCategory && !$category;
    }

    public function getChildren($id)
    {
        return $this->categoryRepository->getChildren($id);
    }

    public function extractCategoriesForSearch($products, $withProductCount = false)
    {
        $categories = $products->pluck('category_id')->toArray();

        $categoriesWithCount = array_count_values($categories);

        arsort($categoriesWithCount, true);

        $categoriesIds = array_keys($categoriesWithCount);

        $allCategories = Category::all();

        $categories = $allCategories->whereIn('id', $categoriesIds);

        //        $categoriesCollection = new Collection();
        foreach ($categories as $category) {
            $categoriesIds = array_merge($categoriesIds, $this->extractCategory($category, $allCategories));
        }

        $categoriesIds = array_unique($categoriesIds);

        $categoriesCollection = $allCategories->whereIn('id', $categoriesIds);

        $categoriesCollection->map(function ($category) use ($categoriesIds, $categoriesWithCount) {
            $category->_product_count = isset($categoriesWithCount[$category->id]) ? $categoriesWithCount[$category->id] : 0;
            $category->active = $category->slug == request()->get('category');
        });

        $categoriesCollection = $categoriesCollection->unique('id');

        $categoriesCollection = $categoriesCollection->toTree();

        if ($withProductCount) {
            $categoriesCollection = $this->transverseCollection($categoriesCollection);
        }

        return $categoriesCollection;
    }

    private function extractCategory($category, $allCategories)
    {
        if ($category) {
            $ids = [$category->id];
            if ($category->parent_id) {
                return array_merge($ids, $this->extractCategory($allCategories->where('id', $category->parent_id)->first(), $allCategories));
            }
            return $ids;
        }
        return [null];

    }

    private function transverseCollection($categoriesCollection)
    {
        $categoriesCollection->map(function ($category) {

            if ($category->getRelation('children')->count() > 0) {
                $category->children = $this->transverseCollection($category->getRelation('children'));

                $category->_product_count = $category->children->sum('_product_count');
            }

            if (!$category->_product_count) {
                $category->_product_count = 0;
            }

        });

        return $categoriesCollection;
    }

    public function getBySlug($category)
    {
        return $this->categoryRepository->getCategoryBySlug($category);
    }

    public function findBy($column, $data)
    {
        return $this->categoryRepository->findBy($column, $data);
    }

}
