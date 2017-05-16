<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert([
        	[
            'name' => 'Laptop',
            'parent_id' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
            'name' => 'Dien thoai',
            'parent_id' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
            'name' => 'Asus',
            'parent_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
            'name' => 'Dell',
            'parent_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
            'name' => 'Lennovo',
            'parent_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
            'name' => 'Iphone',
            'parent_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
            'name' => 'SamSung',
            'parent_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
            'name' => 'HTC',
            'parent_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
