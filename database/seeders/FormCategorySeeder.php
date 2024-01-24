<?php

namespace Database\Seeders;

use App\Models\FormCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormCategorySeeder extends Seeder
{
    const FORM_CATEGORIES = [
        'Основная',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (static::FORM_CATEGORIES as $category) {
            FormCategory::firstOrCreate(['name' => $category]);
        }
    }
}

