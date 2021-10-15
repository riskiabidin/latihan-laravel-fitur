<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UbahTabelProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::rename('produk','barang');//merubah nama tabel produk ke tabel barang
        Schema::table('produk', function(Blueprint $table){
            $table->renameColumn('nama_produk','nama_barang');
            $table->dropColumn('harga_beli');
            $table->integer('diskon')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
        
    }
}
