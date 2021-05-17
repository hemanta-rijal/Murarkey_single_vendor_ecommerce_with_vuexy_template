<?php

use Illuminate\Database\Seeder;

class CategoryKeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = get_categories_tree();

        foreach ($categories as $category) {
            $keywords1 = strtolower($category->name);
            if ($category->children) {
                foreach ($category->children as $category1) {
                    $keywords2 = strtolower($category1->name);

                    if ($category1->children) {
                        foreach ($category1->children as $category2) {
                            $keywords3 = strtolower($category2->name);
                            $this->saveForCategory($category2, [$keywords1, $keywords2, $keywords3]);
                        }
                    }

                    $this->saveForCategory($category1, [$keywords1, $keywords2]);
                }
            }

            $this->saveForCategory($category, $keywords1);

        }

    }

    public function saveForCategory($category, $keywords)
    {
        if (!is_array($keywords)) {
            $keywords = [$keywords];
        }

        $clonedKeywords = [];
        foreach ($keywords as $keyword) {
            $clonedKeywords[] = new \App\Models\CategoryKeyword(['keyword' => $keyword]);
        }

        $category->keywords()->saveMany($clonedKeywords);
    }
}
