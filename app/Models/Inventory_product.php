<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory_product extends Model
{
    use HasFactory;

    protected $table = 'inventory_product';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'inventory_id',
        'product_input_id',
        'last_updated',
        'sequence',
        'is_scanned',
        'reason',
        'status'
    ];
    protected $guarded = ['id '];


    /**
     * Get the inventory that owns the product.
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'inventory_id');
    }
    public function productInput()
    {
        return $this->belongsTo(Product_input::class, 'product_input_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_updated' => 'datetime',
    ];



}
