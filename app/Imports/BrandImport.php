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

        $image = importImageContent($row['image'], 'public/brands/');
        $data = [
            'name' => e($row['name']),
            'slug' => Str::slug(e($row['name'])),
            'image' => $image,
            'description' => $row['description'],
        ];

        $brandExist = $this->brandService->findBySlug(Str::slug(e($row['name'])));
        if (!$brandExist) {
            $brand = Brand::create($data);
            return $brand;
        } else {
            $this->brandService->update($brandExist->id, $data);
            return $brandExist;
        }

    }
}
