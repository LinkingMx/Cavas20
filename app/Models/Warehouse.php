<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'building_id', 'customer_name', 'customer_email', 'customer_rfc', 'comments'
    ];

    public function Building()
    {
        return $this->belongsTo(Building::class);
    }
}
