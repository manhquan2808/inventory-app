<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_output extends Model
{
    use HasFactory;
    protected $table = 'product_output';
    protected $primaryKey = 'output_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'quantity',
        'date',
        'destination',
    ];

    protected $guarded = ['output_id'];

    public function products(){
        return $this->belongsTo(Products::class, 'product_id','product_id');
    }
}
