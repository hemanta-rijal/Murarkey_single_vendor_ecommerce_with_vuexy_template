<?php

namespace App\Imports;

use App\Models\ParlourListing;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParlourListingImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row['name']);
        // $img = getImageContent($row['feature_image']);

        return new ParlourListing([
            'name' => strip_tags($row['name']),
            'slug' => Str::slug($row['slug'], '-'),
            'about' => htmlspecialchars($row['about']),
            'category_id' => $row['category_id'],
            'feature_image' => null, //$img,
            'featured' => $row['featured'],
        ]);
    }
}
