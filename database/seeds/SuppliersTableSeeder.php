<?php

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'nama'     => 'PT. Indofood Tbk',
                'alamat'    => 'Pandelang',
                'email' => 'test@email.com',
                'telepon'	=> '083876854003'
            ]
        ]);

        DB::table('suppliers')->insert([
            [
                'nama'     => 'PT. Daridanke Tbk',
                'alamat'    => 'Pandelang',
                'email' => 'test@email.com',
                'telepon'	=> '083876854003'
            ]
        ]);

        DB::table('suppliers')->insert([
            [
                'nama'     => 'PT. ABC Tbk',
                'alamat'    => 'Pandelang',
                'email' => 'test@email.com',
                'telepon'	=> '083876854003'
            ]
        ]);

        DB::table('suppliers')->insert([
            [
                'nama'     => 'PT. Jartawi Tbk',
                'alamat'    => 'Pandelang',
                'email' => 'test@email.com',
                'telepon'	=> '083876854003'
            ]
        ]);
    }
}
