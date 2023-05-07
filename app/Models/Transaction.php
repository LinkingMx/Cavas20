<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [ 'warehouse_id', 'product_id', 'qty'];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
