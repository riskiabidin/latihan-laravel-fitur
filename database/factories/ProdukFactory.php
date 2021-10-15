<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produk;
use Faker\Generator as Faker;
// use Illuminate\Support\Str;

$factory->define(Produk::class, function (Faker $faker) {
    return [
        'nama_barang'=>str_random(10),
        'harga_jual'=>rand(1, 300).'000'
    ];
});
