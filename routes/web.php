<?php

use Illuminate\Support\Facades\Route;

// query builder (QB)
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('coba', function(){
    echo "mulai focus";

});

// dengan parameter
Route::get('dengan_parameter/{id}', function($id){
    echo $id;

});

// dengan regular expression
Route::get('regular_expression/{nama}', function($nama){
    echo $nama;
})->where('nama','[A-Za-z]+');

Route::get('regular_expression/{id}/{nama}', function($id, $nama){})    ;


// dengan aksi controller

Route::get('contoh/tambah', 'ContohController@tambah');


// menampilkan data menggunakan route

Route::get('produk/semua', function(){
    $produk = App\Produk::all();
    foreach($produk as $data){
        echo $data->id. ". ".
            "nama barang: ".$data->nama_barang." | ".
            "harga jual: ".$data->harga_jual. "<br>";
    }
});

// Jika tanpa eloquent model, maka skripnya menjadi sebagai berikut, menggunakan QB.

Route::get('produk/semua2', function(){
    $produk = DB::table('produk')->get();
    foreach($produk as $data){
        echo $data->id. ". ".
            "nama barang: ".$data->nama_barang." | ".
            "harga jual: ".$data->harga_jual. "<br>";
    }


});

// menggunakan count = menampilkan jumlah data

Route::get('produk/jumlah', function(){
    $produk = DB::table('produk')->count();

    echo $produk;
});


// menampiilkan nilai maxsimal harga_jual tanpa eloquent

Route::get('produk/max', function(){
    $produk = DB::table('produk')->max('harga_jual');
    
    echo $produk;
});

// menampiilkan nilai maxsimal harga_jual dengan eloquent

Route::get('produk/max2', function(){
    $produk = App\Produk::max('harga_jual');
    
    echo $produk;
});
//menampilkan nilai minimal harga jual tanpa eloquent

Route::get('produk/min', function(){
    $produk = DB::table('produk')->min('harga_jual');
    
    echo $produk;
});

//menampilkan nilai minimal harga jual dengan eloquent

Route::get('produk/min2', function(){
    $produk = App\Produk::min('harga_jual');
    
    echo $produk;
});

// menampilkan nilai sum harga jual tanpa eloquent

Route::get('produk/sum', function(){
    $produk = DB::table('produk')->sum('harga_jual');

    echo $produk;
});

// menampilkan nilai sum harga jual dengan eloquent

Route::get('produk/sum2', function(){
    $produk = App\Produk::sum('harga_jual');

    echo $produk;
});

//menggunakan select tanpa eloquent(memilih beberapa kolom dan membuat alias untuk kolom)

Route::get('produk/select1',  function(){
    $produk = DB::table('produk')->select('nama_barang ', 'harga_jual as harga')->get();

    //menampilkan menggunakan foreach
    // foreach($produk as $data){
    //     echo $data->nama_barang ." "."harga: ".
    //     $data->harga . "<br>";
    // }


    // menampilkan array dari variable produk
    echo $produk;
});

//menggunakan select tanpa eloquent(memilih beberapa kolom dan membuat alias untuk kolom)

Route::get('produk/select2',  function(){
    $produk = App\Produk::select('nama_barang', 'harga_jual as harga')->get();

    //menampilkan menggunakan foreach
    foreach($produk as $data){
        echo $data->nama_barang ." "."harga: ".
        $data->harga . "<br>";
    }


    // menampilkan array dari variable produk
    // echo $produk;
});
 
// menggunakan raw expression tanpa eloquent

Route::get('produk/rawexpression1', function(){
    $produk = DB::table('produk')->select(DB::raw('count(*) as total, sum(harga_jual) as harga'))->get();

    echo $produk;
});

// menggunakan raw expression dengan eloquent
Route::get('produk/rawexpression2', function(){
    $produk = App\Produk::select(DB::raw('count(*) as total, sum(harga_jual) as harga'))->get();

    echo $produk;
});

// menampilikan data dengan kondisi tertentu(where1) tanpa eloquent

Route::get('produk/where1-1', function(){
    $produk = DB::table('produk')->where('harga_jual','=', 2000)->get();
    echo $produk;
});

// menampilikan data dengan kondisi tertentu(where1) dengan eloquent

Route::get('produk/where1-2', function(){
    $produk = App\Produk::where('harga_jual','=', 2000)->get();
    echo $produk;
});

//menampilkan data beberapa kondisi(where2) tanpa eloquent

Route::get('produk/where2-1', function(){
    $produk = DB::table('produk')->where([
        ['harga_jual', '<=', 2000],
        ['id','>=', 3]
    ])->get();

    echo $produk;
});

// menampilkan data beberapa kondisi(where2) dengan eloquent

Route::get('produk/where2-2', function(){
    $produk = App\Produk::where([
        ['harga_jual', '<=', 2000],
        ['id', '>=', 3]
    ])->get();

    echo $produk;
});

// menampilkan data beberapa kondisi menggunakan OR tanpa eloquent

Route::get('produk/whereOR1', function(){
    $produk = DB::table('produk')->where('id', '<=', 3)->orWhere('nama_barang', '=', 'sabun mandi')->get();

    echo $produk;
});

// menampilkan data beberapa kondisi menggunakan OR dengan eloquent

Route::get('produk/whereOR2', function(){
    $produk = App\Produk::where('id', '<=', 3)->orWhere('nama_barang', '!=', 'sabun mandi')->get();
    
    echo $produk;
});

// menampilkan data diantara 2 batas nilai(whereBetween) tanpa eloquent

Route::get('produk/whereBetween1', function(){
    $produk = DB::table('produk')->whereBetween('id', [3, 5])->get();

    echo $produk;
});

//menampilkan data diantara 2 batas nilai(whereBetween) dengan eloquent

Route::get('produk/whereBetween2', function(){
    $produk = App\Produk::whereBetween('id', [1, 3])->get();

    echo $produk;
});

// menampilkan data tidak diantara 2 batas nilai(whereNotBetween) tanpa eloquent`

Route::get('produk/whereNotBetween1', function(){
    $produk = DB::table('produk')->whereNotBetween('id', [1, 3])->get();

    echo $produk;
});

//menampilkan data tidak diantara 2 batas nilai(whereNotBetween) dengan eloquent

Route::get('produk/whereNotBetween2', function(){
    $produk = App\Produk::whereNotBetween('id', [3, 5])->get();

    echo $produk;
});

// menmpilkan data sesuai dengan yang disebutkan(whereIn) tanpa eloquent

Route::get('produk/whereIn1', function(){
    $produk = DB::table('produk')->whereIn('id', [1, 3, 5])->get();

    echo $produk;
});

//menampilkan data sesuai dengan yang disebutkan(whereIn) dengan eloquent

Route::get('produk/whereIn2', function(){
    $produk = App\Produk::whereIn('id', [4, 5])->get();

    echo $produk;
});

// menampilkan data selain yang disebutkan tanpa eloquent

Route::get('produk/whereNotIn1', function(){
    $produk = DB::table('produk')->whereNotIn('id', [1, 2, 3])->get();

    echo $produk;
});

// menampilkan data selain yang disebutkan dengan eloquent

Route::get('produk/whereNotIn2', function(){
    $produk = App\Produk::whereNotIn('id', [4, 5])->get();

    echo $produk;
});

