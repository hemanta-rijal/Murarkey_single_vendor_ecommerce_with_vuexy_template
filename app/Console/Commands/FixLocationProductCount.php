<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class FixLocationProductCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:location-product-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix location product count';

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
        $repo = app(\Modules\Location\Contracts\LocationRepository::class);
        \DB::table('location_countries')->update(['product_count' => 0]);
        \DB::table('location_states')->update(['product_count' => 0]);
        \DB::table('location_cities')->update(['product_count' => 0]);

        $products = Product::with('company')->get();

        foreach ($products as $product)
            $repo->alterProductCount('increment', $product->company->city);

    }
}
