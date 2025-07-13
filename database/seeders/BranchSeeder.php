<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            ['name' => 'Nairobi',        'location' => 'Nairobi',        'latitude' => -1.2921,   'longitude' => 36.8219],
            ['name' => 'Mombasa',        'location' => 'Mombasa',        'latitude' => -4.0435,   'longitude' => 39.6682],
            ['name' => 'Kisumu',         'location' => 'Kisumu',         'latitude' => -0.0917,   'longitude' => 34.7680],
            ['name' => 'Eldoret',        'location' => 'Eldoret',        'latitude' => 0.5143,    'longitude' => 35.2698],
            ['name' => 'Nakuru',         'location' => 'Nakuru',         'latitude' => -0.3031,   'longitude' => 36.0800],
            ['name' => 'Thika',          'location' => 'Thika',          'latitude' => -1.0333,   'longitude' => 37.0693],
            ['name' => 'Naivasha',       'location' => 'Naivasha',       'latitude' => -0.7167,   'longitude' => 36.4310],
            ['name' => 'Meru',           'location' => 'Meru',           'latitude' => 0.0471,    'longitude' => 37.6498],
            ['name' => 'Nyeri',          'location' => 'Nyeri',          'latitude' => -0.4201,   'longitude' => 36.9476],
            ['name' => 'Machakos',       'location' => 'Machakos',       'latitude' => -1.5177,   'longitude' => 37.2634],
            ['name' => 'Kericho',        'location' => 'Kericho',        'latitude' => -0.3673,   'longitude' => 35.2831],
            ['name' => 'Kakamega',       'location' => 'Kakamega',       'latitude' => 0.2827,    'longitude' => 34.7519],
            ['name' => 'Kitale',         'location' => 'Kitale',         'latitude' => 1.0157,    'longitude' => 35.0065],
            ['name' => 'Bungoma',        'location' => 'Bungoma',        'latitude' => 0.5636,    'longitude' => 34.5600],
            ['name' => 'Garissa',        'location' => 'Garissa',        'latitude' => -0.4569,   'longitude' => 39.6583],
            ['name' => 'Lamu',           'location' => 'Lamu',           'latitude' => -2.2717,   'longitude' => 40.9020],
            ['name' => 'Embu',           'location' => 'Embu',           'latitude' => -0.5306,   'longitude' => 37.4575],
            ['name' => 'Isiolo',         'location' => 'Isiolo',         'latitude' => 0.3546,    'longitude' => 37.5822],
            ['name' => 'Narok',          'location' => 'Narok',          'latitude' => -1.0773,   'longitude' => 35.8711],
            ['name' => 'Kilifi',         'location' => 'Kilifi',         'latitude' => -3.6333,   'longitude' => 39.8500],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
