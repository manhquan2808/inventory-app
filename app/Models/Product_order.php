<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_order extends Model
{
    use HasFactory;

    protected $table = 'product_order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'quantity',
        'status',
        'start_date',
        'end_date',
    ];
    // protected $attributes =[
    // ];

    protected $guarded = ['order_id'];

    public function products(){
        return $this->belongsTo(Products::class, 'product_id','product_id');
    }
}
