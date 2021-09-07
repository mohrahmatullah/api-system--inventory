<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'category_id'     => '1',
                'nama'    => 'Ayam Mentah',
                'harga' => '1800',
                'image'	=> '/upload/products/ayam-mentah.jpg',
                'qty'	=> '0'
            ]
        ]);

        DB::table('products')->insert([
            [
                'category_id'     => '3',
                'nama'    => 'Cake coklat',
                'harga' => '2800',
                'image'	=> '/upload/products/cake-coklat.jpg',
                'qty'	=> '0'
            ]
        ]);

        DB::table('products')->insert([
            [
                'category_id'     => '2',
                'nama'    => 'Cendol',
                'harga' => '20000',
                'image'	=> '/upload/products/cendol.jpg',
                'qty'	=> '0'
            ]
        ]);

        DB::table('products')->insert([
            [
                'category_id'     => '1',
                'nama'    => 'Donut Manis',
                'harga' => '3800',
                'image'	=> '/upload/products/donut-manis.jpg',
                'qty'	=> '0'
            ]
        ]);
    }
}
