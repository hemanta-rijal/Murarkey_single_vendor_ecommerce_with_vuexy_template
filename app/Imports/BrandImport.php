<?php

namespace App\Imports;

use App\Models\Brand;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Brand\Services\BrandService;

class BrandImport implements ToModel, WithHeadingRow
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;

    }
    public function model(array $row)
    {
        $brandExist = $this->brandService->findBySlug(Str::slug($row['name']));
        if (!$brandExist) {
            $image = importImageContent($row['image'], 'public/brands/');
            if ($image) {
                $brand = Brand::create([
                    'name' => $row['name'],
                    'slug' => Str::slug($row['name']),
                    'image' => $image,
                    'description' => $row['description'],
                ]);
                return $brand;
            }
        }
    }
}
