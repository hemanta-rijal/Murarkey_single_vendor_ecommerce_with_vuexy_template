<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;

class FixCategoryCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:category-product-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fix product count of existing categories';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $products = Product::select('category_id')->get();
        \DB::table('categories')->update(['product_count' => 0]);

        $categoryRepo = app(\Modules\Categories\Contracts\CategoryRepository::class);

        foreach ($products as $product)
            $categoryRepo->alterProductCount('increment', $product->category_id);

    }
}
