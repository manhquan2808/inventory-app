<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'unit',
        'production_cost',
    ];

    protected $guarded = ['product_id'];
    // public function inventory_product()
    // {
    //     return $this->hasMany(Inventory_product::class, 'product_id', 'product_id');
    // }
    public function material_product()
    {
        return $this->hasMany(Material_product::class, 'product_id', 'product_id');
    }
    public function product_output()
    {
        return $this->hasMany(Product_output::class, 'product_id', 'product_id');
    }
    public function product_order()
    {
        return $this->hasMany(Product_order::class, 'product_id', 'product_id');
    }

    public function product_input()
    {
        return $this->hasMany(Product_input::class, 'product_id', 'product_id');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('products.product_id', 'like', "%{$value}%")
            ->orWhere('products.product_name', 'like', "%{$value}%")
            ->orWhere('products.unit', 'like', "%{$value}%")
            ->orWhere('products.production_cost', 'like', "%{$value}%");
    }

    public $product;

}
