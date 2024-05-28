<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_input extends Model
{
    use HasFactory;

    protected $table = 'product_input';
    protected $primaryKey = 'input_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'employee_id',
        'quantity',
        'status',
        'date',
    ];

    public function products(){
        return $this->belongsTo(Products::class,'product_id','product_id');
    }
    public function employees(){
        return $this->belongsTo(Employee::class,'employee_id','employee_id');
    }
}
