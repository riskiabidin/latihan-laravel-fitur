<?php

use Illuminate\Database\Seeder;
use App\Produk;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Produk::insert([
            ['nama_barang'=>'sabun mandi', 'harga_jual'=>'2000'],
            ['nama_barang'=>'sabun mandi2', 'harga_jual'=>'2000'],
            ['nama_barang'=>'sabun mandi3', 'harga_jual'=>'2000'],
            
        ]);

        // factory(App\Produk::class,50)->create()->each(function($p){
        //     $p->posts()->save(factory(App\Produk::class)->make());
        // });

        Produk::factory()
            ->count(50)
            ->hasPosts(1)
            ->create();
    }                                                       
}
