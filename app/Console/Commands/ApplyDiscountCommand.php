<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApplyDiscountCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apply:discount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply Discount';

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
        if (($handle = fopen(base_path('discount.csv'), "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                try {
                    $cat = Category::whereSlug($row[0])->firstOrFail();


                    $catIds = [$cat->id];

                    if ($cat->descendants)
                        foreach ($cat->descendants as $descendant)
                            $catIds[] = $descendant->id;

                    $p = 1 - $row[1] / 100;

                    Product::whereIn('category_id', $catIds)->update(['a_discount_price' => \DB::raw(" price * {$p} ")]);
                } catch (ModelNotFoundException $exception) {
                    // do nothing
                }

            }
            fclose($handle);
        }
    }
}
