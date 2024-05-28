<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_product extends Model
{
    use HasFactory;
    protected $table = ['material_product'];
    protected $primaryKey = ['id'];
    public $timestamps = false;

    protected $fillable = [
        'material_id',
        'product_id',
        'quantity_require',
    ];
    
    // 1:N - producto a materiales (inversa)
    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'product_id');
    }
    public function materials()
    {
        return $this->belongsTo(Materials::class, 'material_id', 'material_id');
    }
}
