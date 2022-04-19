<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Storage::cleanDirectory('product');
        //Storage::makeDirectory('products');
        User::factory(60)->create();
        Category::factory(10)->create();
        Product::factory(14)->create();
        CategoryProduct::factory(10)->create();
        Sale::factory(15)->create();
        $this->call(RolesAndPermissionsSeeder::class);
        user::create([
            'names' => 'Admin',
            'document' => '1005752434',
            'phone' => '',
            'email' => 'admin@onlyGames.com',
            'password' => hash::make('123456789')
        ])->assignRole('admin');
    }
}
