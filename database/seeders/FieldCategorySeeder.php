<?php

namespace Database\Seeders;

use App\Models\FieldCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldCategorySeeder extends Seeder
{
    const FIELD_CATEGORIES = [
        'Первотелки',
        'Сухостой 1',
        'Сухостой 2',
        'ПРП',
        'Раздой',
        'Разгар',
        'Двойня',
        'Предзапуск',
        'Нетели',
        'Тёлки старше года',
        'Тёлки 3-6 мес.',
        'Тёлки 6-12 мес.',
        'Телята 0-1 мес.',
        'Телята 1-3 мес.',
        'Быки старше года',
        'Быки до года',

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (static::FIELD_CATEGORIES as $category) {
            FieldCategory::firstOrCreate(['name' => $category]);
        }
    }
}
