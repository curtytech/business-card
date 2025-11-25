<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            'Default',
            'Minimal',
            'Modern',
            'Elegant',
            'FullBackground',
        ];

        foreach ($templates as $name) {
            Template::firstOrCreate(['name' => $name]);
        }
    }
}