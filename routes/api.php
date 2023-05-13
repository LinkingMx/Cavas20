<?php

use App\Models\Building;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/warehouses', function (Request $request) {

    $search = $request->search;
    
    $wa = Warehouse::where('code', 'like', "%{$search}%")
        ->OrWhere('comments', 'like', "%{$search}%")
        ->OrWhere('customer_name', 'like', "%{$search}%")
        ->get();

    //method values() quit de index of the array in result of method Get()
    return $wa->where('building_id', 1)->values();
    
    
    })->name('api.warehouses.index');
    


Route::get('/products', function (Request $request) {

    $search = $request->search;

    return Product::where('sap', 'like', "%{$search}%")
        ->OrWhere('name', 'like', "%{$search}%")
        ->get();
})->name('api.products.index');
