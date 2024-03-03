<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Product::factory(500)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' =>'123456',
            'role' => 0,
        ]);
        \App\Models\CategoriesProduct::factory()->create([
            'name' => 'Category Unsign',
            'slug' => Str::slug('Category Unsign'),
        ]);
        \App\Models\CategoriesNews::factory()->create([
            'name' => 'Category Unsign',
            'slug' => Str::slug('Category Unsign'),
        ]);
        \App\Models\Brands::factory()->create([
            'name' => 'Brands Unsign',
            'country' =>'None',
            'slug' => Str::slug('Brands Unsign'),
        ]);
        \App\Models\Tag::factory()->create([
            'name' => 'Tags Unsign',
            'slug' => Str::slug('Tags Unsign'),
        ]);
        $variable =['admin','guest','editor_product','views'];
        foreach ($variable as $key => $value) {
            \App\Models\Role::factory()->create([
                'role_name' => $value,
            ]);
        }
    }
}
