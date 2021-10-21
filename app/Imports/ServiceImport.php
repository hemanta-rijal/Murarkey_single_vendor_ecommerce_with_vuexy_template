<?php

namespace App\Imports;

use App\Models\Service;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ServiceImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $icon_image = getImageContent($row['icon_image']);
        $service = Service::create([
            'title' => strip_tags($row['title']),
            'slug' => Str::slug($row['title'], '-'),
            'about' => htmlspecialchars($row['about']),
            'min_duration' => $row['min_duration'],
            'min_duration_unit' => $row['min_duration_unit'],
            'max_duration' => $row['max_duration'],
            'max_duration_unit' => $row['max_duration_unit'],
            'category_id' => $row['category_id'],
            'short_description' => $row['short_description'],
            'icon_image' => $icon_image ?? null,
            'description' => $row['description'],
            'popular' => $row['popular'],
            'service_charge' => $row['service_charge'],
            'discount_type' => $row['discount_type'],
            'a_discount_price' => $row['a_discount_price'],
        ]);
        // dd($service);
        return $service;

        // for feature images
    }
}
